<?php

set_error_handler (
    function($errno, $errstr, $errfile, $errline) {
        global $g_log;
        $g_log[] = array(
            '#' => $errno,
            'msg' => $errstr,
            'file' => $errfile,
            'line' => $errline
        );
    }
);

$path = array();
$path['route'] = '../private/routes/';
$path['lib'] = '../private/lib/';
$path['config'] = '../private/config/';
$path['templates'] = '../private/templates/';
$path['components'] = '../private/templates/components/';
$path['layout'] = '../private/templates/layout/';


$g_path = trim(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']:'');
if (substr($g_path,0,1) == '/') $g_path = substr($g_path,1);
if (substr($g_path,-1,1) == '/') $g_path = substr($g_path,0,-1);

// Routes definition
$routes = array();
$routes['index'] = 'index';
$routes['404'] = '404';
$routes['list'] = 'list';
$routes['admin'] = 'admin/index';


if ($g_path == '' || $g_path == '/'){
    require $path['route'].$routes['index'].'.route.php';
}
else {
    if (array_key_exists($g_path,$routes)){
        $filename = $path['route'].$routes[$g_path].'.route.php';
        require $filename;
    }
    else{
        require $path['route'].$routes['404'].'.route.php';
    }
}

// Showing errors
if (is_array($g_log) && count($g_log) > 0){
    pre($g_log);
}

