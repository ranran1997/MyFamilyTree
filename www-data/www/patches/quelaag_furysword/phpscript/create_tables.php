<?php
if (!defined('puyuetian')) {
    exit('403');
}

$user_query = <<<EOF
ALTER TABLE `{$_G['MYSQL']['PREFIX']}user`
    ADD COLUMN (`cid` INT(11) COMMENT '家族码', `mid` INT(11) COMMENT '配偶码', `fid` INT(11) COMMENT '父亲码', `nsleft` INT(11) NOT NULL COMMENT '嵌套集左值', `nsright` INT(11) NOT NULL COMMENT '嵌套集右值', `name` TEXT COMMENT '姓名', `introduction` TEXT COMMENT '个人介绍', `locked` TINYINT(1) COMMENT '审核状态');
EOF;

$clan_query = <<<EOF
CREATE TABLE IF NOT EXISTS `{$_G['MYSQL']['PREFIX']}clan` (
    `id` INT(11) NOT NULL COMMENT '家族码',
    `clanname` TEXT NOT NULL COMMENT '家族名',
    `cradle` TEXT NOT NULL COMMENT '发源地',
    `introduction` TEXT COMMENT '家族介绍',
    `locked` TINYINT(1) NOT NULL COMMENT '审核状态'
) ENGINE = MyISAM CHARSET = 'utf8';
EOF;

$read_query = <<<EOF
ALTER TABLE `{$_G['MYSQL']['PREFIX']}read`
    ADD COLUMN `cid` INT(11) COMMENT '家族码';
EOF;

$admin_query = <<<EOF
CREATE TABLE IF NOT EXISTS `{$_G['MYSQL']['PREFIX']}admin` (
    `uid` INT(11) NOT NULL COMMENT '用户码',
    `cid` INT(11) NOT NULL COMMENT '家族码',
    `permission` TEXT NOT NULL COMMENT '权限',
    CONSTRAINT _ PRIMARY KEY (`uid`, `cid`)
) ENGINE = MyISAM CHARSET = 'utf8';
EOF;

if ($_G['USER']['ID'] == 1 && !$_G['TABLE']['CLAN']) {
    mysql_query($user_query);
    mysql_query($clan_query);
    mysql_query($read_query);
    mysql_query($admin_query);
}
