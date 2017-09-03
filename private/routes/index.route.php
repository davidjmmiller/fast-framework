<?php

component('navigation', 'global/navigation',array());
component('main-content','pages/index',array());
component('bottom-columns','utils/columns',array());
component('bottom-columns','global/footer',array());
component('footer','global/footer',array());
component('footer','pages/index',array());
component('footer','utils/columns',array());



// Layout
$output = tpl('default',array(),0);

setcookie('page_information', json_encode($g_crc), time() + (86400 * 30), "/"); // 86400 = 1 day

//pre($g_crc);
//exit;

echo $output;