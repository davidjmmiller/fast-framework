<?php

$region['left-bar'] .= component('utils/date',array());
$region['main'] .= component('page/index',array());
$region['footer'] .= component('utils/date',array());
$params['region'] = $region;

// Layout
tpl('default',$params,0);
