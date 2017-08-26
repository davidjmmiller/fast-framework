<?php

// Routes definition
$routes = array();
$routes['index'] = 'index';
$routes['404'] = '404';
$routes['list'] = 'list';
$routes['admin'] = 'admin/index';

// Configurations
$config['database'] = array();
$config['database']['name'] = 'fast';
$config['database']['host'] = 'localhost';
$config['database']['port'] = '3306';
$config['database']['username'] = 'root';
$config['database']['password'] = 'David88';

// Paths
$path = array();
$path['route'] = '../private/routes/';
$path['components'] = '../private/components/';
$path['templates'] = '../private/templates/';
$path['layout'] = '../private/templates/layout/';
$path['pages'] = '../private/templates/pages/';


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
if (is_array($g_log) && count($g_log) > 0){
    pre($g_log);
}



/* Functions */

// Utils
function pre($var){
    echo '<pre>'.print_r($g_log,true).'</pre>';
}

// Database
function db_connect(){
    global $config;
    static $link;
    if (isset($link)) {
        // Connection already exists
        return $link;
    }
    $link = mysqli_connect(
        $config['database']['host'], 
        $config['database']['username'], 
        $config['database']['password'], 
        $config['database']['name'],
        $config['database']['port']
    );

    if (!$link) {
        return false;
    }

    // New connection
    return $link;
}

function db_query($sql){
    $link = db_connect();
    if ($result = mysqli_query($link, $sql)){
        return $result;
    }
    elog(mysqli_error($link));
    return false;
}

function db_fetch($result){
    return mysqli_fetch_assoc($result);
}

function db_free($result){
    mysqli_free_result($result);
}

function db_num_rows($result){
    return mysqli_num_rows($result);
}

function component($name, $params){
    global $path;
    ob_start();
    require $path['components'].$name.'.comp.php';
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function tpl($name,$params, $type = 1){
    global $path;
    $types = array();
    $types[] = 'layout';
    $types[] = 'components';
    require $path['templates'].$types[$type].'/'.$name.'.tpl.php';
}

function region($name)
{
    global $params;
    if (isset($params['region'][$name])) {
        echo $params['region'][$name];
    }
}