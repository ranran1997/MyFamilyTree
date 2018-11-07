<?php
if (!defined('puyuetian')) {
    exit('403');
}

$userQuery = <<<EOF
ALTER TABLE `{$_G['MYSQL']['PREFIX']}user`
    ADD COLUMN (
        `cid` INT(11) COMMENT '家族码',
        `mid` INT(11) COMMENT '配偶码',
        `fid` INT(11) COMMENT '父亲码',
        `nsleft` INT(11) NOT NULL COMMENT '嵌套集左值',
        `nsright` INT(11) NOT NULL COMMENT '嵌套集右值',
        `name` TEXT COMMENT '姓名',
        `introduction` TEXT COMMENT '个人介绍',
        `locked` TINYINT(1) COMMENT '审核状态'
    );
EOF;

$clanQuery = <<<EOF
CREATE TABLE IF NOT EXISTS `{$_G['MYSQL']['PREFIX']}clan` (
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT '家族码',
    `clanname` VARCHAR(255) UNIQUE NOT NULL COMMENT '家族名',
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

// 文字LOGO
$logotextQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_LOGOTEXT']}`
WHERE 'setname'='logotext';
EOF;

// 图片LOGO
$weblogoQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBLOGO']}`
WHERE 'setname'='weblogo';
EOF;

// 站长寄语
$quotesQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_QUOTES']}`
WHERE 'setname'='quotes';
EOF;

// 备案号
$beianhaoQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_BEIANHAO']}`
WHERE 'setname'='beianhao';
EOF;

// 头部HTML代码
$headerhtmlcodeQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_HEADERHTMLCODE']}`
WHERE 'setname'='headerhtmlcode';
EOF;

// 导航HTML代码
$navhtmlcodeQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_NAVHTMLCODE']}`
WHERE 'setname'='navhtmlcode';
EOF;

// 页脚HTML代码
$footerhtmlcodeQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_FOOTERHTMLCODE']}`
WHERE 'setname'='footerhtmlcode';
EOF;

// 友情链接
$friendlinksQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_FRIENDLINKS']}`
WHERE 'setname'='friendlinks';
EOF;

// head嵌入
$embed_headmarksQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_EMBED_HEADMARKS']}`
WHERE 'setname'='embed_headmarks';
EOF;

// 模板加载前嵌入
$embed_headQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_EMBED_HEAD']}`
WHERE 'setname'='embed_head';
EOF;

// 模板加载后嵌入
$embed_footQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_EMBED_FOOT']}`
WHERE 'setname'='embed_foot';
EOF;

// 动态显示的标签
$defaultlabelQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_DEFAULTLABEL']}`
WHERE 'setname'='defaultlabel';
EOF;

// 网站名
$webnameQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBNAME']}`
WHERE 'setname'='WEBNAME';
EOF;

// 网站标题
$webtitleQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBTITLE']}`
WHERE 'setname'='WEBTITLE';
EOF;

// 网站关键词
$webaddedwordsQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBADDEDWORDS']}`
WHERE 'setname'='webaddedwords';
EOF;

// 网站优化追加词
$webkeywordsQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBKEYWORDS']}`
WHERE 'setname'='webkeywords';
EOF;

// 网站文字介绍
$webdescriptionQuery = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_WEBDESCRIPTION']}`
WHERE 'setname'='webdescription';
EOF;

// 右侧广告位1
$template_puyuetian_fly_ad_yc1Query = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_TEMPLATE_PUYUETIAN_FLY_AD_YC1']}`
WHERE 'setname'='template_puyuetian_fly_ad_yc1';
EOF;

// 右侧广告位2
$template_puyuetian_fly_ad_yc2Query = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_TEMPLATE_PUYUETIAN_FLY_AD_YC2']}`
WHERE 'setname'='template_puyuetian_fly_ad_yc2';
EOF;

// 右侧广告位3
$template_puyuetian_fly_ad_yc3Query = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_TEMPLATE_PUYUETIAN_FLY_AD_YC3']}`
WHERE 'setname'='template_puyuetian_fly_ad_yc3';
EOF;

// 右侧广告位4
$template_puyuetian_fly_ad_yc4Query = <<<EOF
UPDATE TABLE `{$_G['MYSQL']['PREFIX']}set`
SET 'setvalue'=`{$_G['SET']['APP_QUELAAG_FURYSWORD_TEMPLATE_PUYUETIAN_FLY_AD_YC4']}`
WHERE 'setname'='template_puyuetian_fly_ad_yc4';
EOF;

if ($_G['USER']['ID'] == 1 && !$_G['TABLE']['CLAN']) {
    // 初始化克拉格的魔剑相关表
    mysql_query($userQuery);
    mysql_query($clanQuery);
    mysql_query($readQuery);
    mysql_query($adminQuery);
    // 根据克拉格的魔剑设置页面选项
    // 修改系统默认设置
    mysql_query($logotextQuery);
    mysql_query($weblogoQuery);
    mysql_query($quotesQuery);
    mysql_query($beianhaoQuery);
    mysql_query($headerhtmlcodeQuery);
    mysql_query($navhtmlcodeQuery);
    mysql_query($footerhtmlcodeQuery);
    mysql_query($friendlinksQuery);
    mysql_query($embed_headmarksQuery);
    mysql_query($embed_headQuery);
    mysql_query($embed_footQuery);
    mysql_query($defaultlabelQuery);
    mysql_query($webnameQuery);
    mysql_query($webtitleQuery);
    mysql_query($webaddedwordsQuery);
    mysql_query($webkeywordsQuery);
    mysql_query($webdescriptionQuery);
    mysql_query($template_puyuetian_fly_ad_yc1Query);
    mysql_query($template_puyuetian_fly_ad_yc2Query);
    mysql_query($template_puyuetian_fly_ad_yc3Query);
    mysql_query($template_puyuetian_fly_ad_yc4Query);
}
