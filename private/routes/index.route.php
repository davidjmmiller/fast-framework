<?php

$region['navigation'] = component('global/navigation',array());
$region['main'] = component('pages/index',array());
$region['bottom-columns'] = component('utils/columns',array());
$region['footer'] = component('global/footer',array());
$params['region'] = $region;

// Layout
tpl('default',$params,0);
