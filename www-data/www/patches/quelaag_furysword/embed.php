<?php
if (!defined('puyuetian')) {
    exit('403');
}

// 去除标题连字符
$_G['SET']['EMBED_HEADMARKS'] .= <<<EOF
<script>
    document.title = document.title.replace(/\s-$/, "");
</script>
EOF;

// 修改网站名
// 不能在 embed.php 文件中操作数据库
// $_G['TABLE']['SET']['WEBNAME'] = $_G['SET']['APP_QUELAAG_FURYSWORD_WEBNAME'];
// $_G['TABLE']['SET']['WEBTITLE'] = $_G['SET']['APP_QUELAAG_FURYSWORD_WEBTITLE'];

// 修改一些样式
$_G['SET']['EMBED_HEAD'] .= <<<EOF
<style type="text/css">
.layui-nav-item > a {color: #8590A6 !important;}
.readcontent {text-align: justify;}
p {text-align: justify;}
pre {overflow: auto; white-space: pre !important; width: 100% !important; word-wrap: break-word;}
.fly-footer > p {text-align: center;}
.fly-footer > p > a{padding:0 6px; font-weight: 400; color: #737573;}
</style>
EOF;

// 添加切换版式选项
// $_G['SET']['FOOTERHTMLCODE'] .= <<<EOF
// EOF;
