<?php
if (!defined('puyuetian')) {
    exit('403');
}

// 开始渲染家族主页
$clanHead = template('quelaag_furysword:clan-1', true);
$_G['HTMLCODE']['OUTPUT'] .= $clanHead;

// 获取家族信息
$allClans = $_G['TABLE']['CLAN']->getDatas(0, 0, 'locked', 0);
$clanCount = $_G['TABLE']['CLAN']->getCount('locked', 0);
// 获取家族版块偏移量
$logicid = $_G['SET']['APP_QUELAAG_FURYSWORD_LOGICID'];

// 渲染家族主页主体
global $clanData;
for ($i = 0; $i < $clanCount; $i++) {
    $clanData = $allClans[$i];
    $clanData['logourl'] = $_G['TABLE']['READSORT']->getData($clanData['id'] + $logicid)['logourl'];
    $clanData['mapurl'] = 'index.php?c=app&a=quelaag_furysword:index&s=clan_map&id=' . (string) $clanData['id'];
    $clanData['clanurl'] = 'index.php?c=list&sortid=' . (string) ($clanData['id'] + $logicid) . '&page=1';
    $clanBody = template('quelaag_furysword:clan-2', true);
    $_G['HTMLCODE']['OUTPUT'] .= $clanBody;
}

// 结束渲染家族主页
$clanTail = template('quelaag_furysword:clan-3', true);
$_G['HTMLCODE']['OUTPUT'] .= $clanTail;
