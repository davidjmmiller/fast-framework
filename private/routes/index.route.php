<?php


// Components
ob_start();
require $path['pages'].'index/index.tpl.php';
$content_main = ob_get_contents();
ob_end_clean();

ob_start();
require $path['components'].'date.tpl.php';
$component['date'] = ob_get_contents();
ob_end_clean();



// Layout
require $path['layout'].'default.tpl.php';
