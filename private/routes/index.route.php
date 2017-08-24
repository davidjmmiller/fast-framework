<?php


// Components
ob_start();
require $path['components'].'date.tpl.php';
$component['date'] = ob_get_contents();
ob_end_clean();

// Main content
$component['content'] = "<h2>Hello World</h2>";


// Layout
require $path['layout'].'default.tpl.php';