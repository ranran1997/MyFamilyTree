<?php
if (!defined('puyuetian')) {
    exit('403');
}

require 'template/puyuetian_fly/phpscript/head.php';
$_G['TEMP']['GPSHTML'] = template('quelaag_furysword:gps', true);
