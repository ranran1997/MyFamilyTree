<?php
if (!defined('puyuetian')) {
    exit('403');
}

$userQuery = <<<EOF
ALTER TABLE `{$_G['MYSQL']['PREFIX']}user`
    ADD COLUMN (`cid` INT(11) COMMENT '家族码', `mid` INT(11) COMMENT '配偶码', `fid` INT(11) COMMENT '父亲码', `nsleft` INT(11) NOT NULL COMMENT '嵌套集左值', `nsright` INT(11) NOT NULL COMMENT '嵌套集右值', `name` TEXT COMMENT '姓名', `introduction` TEXT COMMENT '个人介绍', `locked` TINYINT(1) COMMENT '审核状态');
EOF;

$clanQuery = <<<EOF
CREATE TABLE IF NOT EXISTS `{$_G['MYSQL']['PREFIX']}clan` (
    `id` INT(11) NOT NULL COMMENT '家族码',
    `clanname` TEXT NOT NULL COMMENT '家族名',
    `cradle` TEXT NOT NULL COMMENT '发源地',
    `introduction` TEXT COMMENT '家族介绍',
    `locked` TINYINT(1) NOT NULL COMMENT '审核状态'
) ENGINE = MyISAM CHARSET = 'utf8';
EOF;

$readQuery = <<<EOF
ALTER TABLE `{$_G['MYSQL']['PREFIX']}read`
    ADD COLUMN `cid` INT(11) COMMENT '家族码';
EOF;

$adminQuery = <<<EOF
CREATE TABLE IF NOT EXISTS `{$_G['MYSQL']['PREFIX']}admin` (
    `uid` INT(11) NOT NULL COMMENT '用户码',
    `cid` INT(11) NOT NULL COMMENT '家族码',
    `permission` TEXT NOT NULL COMMENT '权限',
    CONSTRAINT _ PRIMARY KEY (`uid`, `cid`)
) ENGINE = MyISAM CHARSET = 'utf8';
EOF;

$webnameQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBNAME']}`
WHERE 'setname'='WEBNAME';
EOF;

$webtitleQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBTITLE']}`
WHERE 'setname'='WEBTITLE';
EOF;

if ($_G['USER']['ID'] == 1 && !$_G['TABLE']['CLAN']) {
    // 初始化克拉格魔剑相关表
    mysql_query($userQuery);
    mysql_query($clanQuery);
    mysql_query($readQuery);
    mysql_query($adminQuery);
    // 根据克拉格魔剑设置页面选项
    // 修改系统默认设置
    mysql_query($webnameQuery);
    mysql_query($webtitleQuery);
}
