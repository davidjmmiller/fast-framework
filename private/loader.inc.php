<?php

// Loading configurations
require '../private/config/general.conf.php';
require '../private/config/database.conf.php';
require '../private/config/path.conf.php';
require '../private/config/routes.conf.php';

// Loading libs
require '../private/libs/utils.lib.php';
require '../private/libs/templates.lib.php';
require '../private/libs/database.lib.php';

session_start();

global $g_log;
global $g_components;
$g_components = array();
$g_log = array();
$g_crc = array();

// Error handler
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

$g_path = trim(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']:'');
if (substr($g_path,0,1) == '/') $g_path = substr($g_path,1);
if (substr($g_path,-1,1) == '/') $g_path = substr($g_path,0,-1);

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
global $g_log;
if (is_array($g_log) && count($g_log) > 0){
    pre($g_log);
}
