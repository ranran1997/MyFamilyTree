<?php
if (!defined('puyuetian')) {
    exit('403');
}

global $forumdata;
$logicid = $_G['SET']['APP_QUELAAG_FURYSWORD_LOGICID'];
global $editMode;
global $clanData;
global $readonly;

// 当请求方式为 POST 时，脚本用于更新数据库记录
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 数据预处理
    // 包括安全性检查和类型转换
    // $_POST['clanname'] = mysqlstr($_POST['clanname'], false);
    // $_POST['cradle'] = mysqlstr($_POST['cradle'], false);
    // $_POST['introduction'] = mysqlstr($_POST['introduction'], false);
    $locked = Cnum($_POST['locked'], 0);
    // $_POST['permission'] = mysqlstr($_POST['permission'], false);
    // 更新家族表
    $clanQuery = <<<EOF
INSERT INTO `{$_G['MYSQL']['PREFIX']}clan` (`clanname`, `cradle`, `introduction`, `locked`)
VALUES ('{$_POST['clanname']}', '{$_POST['cradle']}', '{$_POST['introduction']}', 0)
ON DUPLICATE KEY UPDATE `cradle`='{$_POST['cradle']}', `introduction`='{$_POST['introduction']}', `locked`={$locked};
EOF;
    mysql_query($clanQuery);
    // 更新板块表
    $cid = $_G['TABLE']['CLAN']->getID('clanname', $_POST['clanname']);
    $rid = $cid + $logicid;
    $forumQuery = <<<EOF
INSERT INTO `{$_G['MYSQL']['PREFIX']}readsort` (`id`, `title`, `logourl`, `show`, `banpostread`)
VALUES ({$rid}, '{$_POST['clanname']}', '{$_POST['logourl']}', 0, 0)
ON DUPLICATE KEY UPDATE `logourl`='{$_POST['logourl']}';
EOF;
    mysql_query($forumQuery);
    // 更新家族管理员表
    $adminQuery = <<<EOF
INSERT INTO `{$_G['MYSQL']['PREFIX']}admin` (`uid`, `cid`, `permission`)
VALUES ('{$_G['USER']['ID']}', '{$cid}', 'admin')
ON DUPLICATE KEY UPDATE `uid`='{$_G['USER']['ID']}', `cid`='{$cid}', `permission`='{$_POST['permission']}';
EOF;
    mysql_query($adminQuery);
    // 整理链接格式，去除 CSRF 校验值参数
    header("Location:index.php?c=app&a=quelaag_furysword:index&s=edit_clan&id={$cid}");
    exit();
}

// 如果链接包含 id 参数，则编辑对应家族，否则新建家族
if ($_GET['id']) {
    $forumdata = $_G['TABLE']['READSORT']->getData(Cnum($_GET['id']) + $logicid);
    $clanData = $_G['TABLE']['CLAN']->getData(Cnum($_GET['id']));
    $editMode = '编辑家族';
    $readonly = 'readonly';
} else {
    $editMode = '新建家族';
}

// 渲染表单标题
$title = template('quelaag_furysword:edit-clan-1', true);
$_G['HTMLCODE']['OUTPUT'] .= $title;

// 加载（家族对应的）板块表单
// $forum = template('quelaag_furysword:edit-clan-2', true);
// $_G['HTMLCODE']['OUTPUT'] .= $forum;

// 渲染家族表单
$clan = template('quelaag_furysword:edit-clan-3', true);
$_G['HTMLCODE']['OUTPUT'] .= $clan;
