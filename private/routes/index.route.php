<?php

component('navigation', 'global/navigation',array().'public',20);
component('main-content','pages/index',array());
component('bottom-columns','utils/columns',array());
component('footer','global/footer',array());

// Layout
$output = tpl('default',array(),0);

echo $output;