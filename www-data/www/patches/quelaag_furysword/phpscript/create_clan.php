<?php
if (!defined('puyuetian')) {
    exit('403');
}

$clanForm = template('quelaag_furysword:create-clan', true);
$_G['HTMLCODE']['OUTPUT'] .= $clanForm;
