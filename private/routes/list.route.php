<?php

$region['left-bar'] = component('utils/date',array());
$region['main'] = component('pages/list',array());
$region['footer'] = component('utils/date',array());
$params['region'] = $region;

tpl('default',$params,0);
