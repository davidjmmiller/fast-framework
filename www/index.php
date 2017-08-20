<?php

$path_route = '../private/routes/';

$g_path = trim(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']:'');
if (substr($g_path,0,1) == '/'){
    $g_path = substr($g_path,1);
}
if (substr($g_path,-1,1) == '/'){
    $g_path = substr($g_path,0,-1);
}

if ($g_path == '' || $g_path == '/'){
    require $path_route.'index.route.php';
}
else {

    $routes = array();
    $routes['index'] = 'index';
    $routes['list'] = 'index';
    $routes['go'] = 'index';
    $routes['admin/admin/test'] = 'admin/index';
    
    if (array_key_exists($g_path,$routes)){
        $filename = $path_route.$routes[$g_path].'.route.php';
        require $filename;
    }
    else{
        require $path_route.'404.route.php';
    }
}
