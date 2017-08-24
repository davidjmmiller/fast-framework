<?php

// require $path['config'].'database.conf.php';
require $path['lib'].'util.lib.php';
// require $path['lib'].'database.lib.php';


// Components
ob_start();
require $path['components'].'date.tpl.php';
$component['date'] = ob_get_contents();
ob_end_clean();

$component['content'] = "<h2>Hello World</h2>";


// Layout
require $path['layout'].'default.tpl.php';