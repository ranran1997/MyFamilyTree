<?php
if (!defined('puyuetian')) {
    exit('403');
}

if ($_GET['id'] == null) {
    exit(0);
}

$cid = Cnum($_GET['id']);

global $clanData;
$clanData = $_G['TABLE']['CLAN']->getData($cid);
$clanData['logourl'] = $_G['TABLE']['READSORT']->getData($clanData['id'] + $logicid)['logourl'];

$clanHead = template('quelaag_furysword:clan-map-1', true);
$_G['HTMLCODE']['OUTPUT'] .= $clanHead;
