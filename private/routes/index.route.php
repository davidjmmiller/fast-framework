<?php

component('navigation', 'global/navigation',array(),0,10);
component('main-content','pages/index',array());
component('bottom-columns','utils/columns',array());
component('footer','global/footer',array());

// Layout
$output = tpl('default',array(),0);

echo $output;