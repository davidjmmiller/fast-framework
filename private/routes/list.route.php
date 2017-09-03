<?php

component('navigation', 'global/navigation',array());
component('main-content','pages/list',array());
component('bottom-columns','utils/columns',array());
component('footer','global/footer',array());

// Layout
echo tpl('default',array(),0);
