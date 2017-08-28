<?php

/* Functions */


function component($name, $params, $expiration = 0, $type = 0, $crc = NULL){
    global $path;
    
    /* Checking cache files
    $file_path = $path['cache'].($type == 0 ? 'public/' : 'private/'.session_id().'/').$name.'/'.abs(crc32(serialize($params)));

    if (file_exists($file_path)){
        $output = file_get_contents($file_path.'/component.cache.php');
        
    }*/

    ob_start();
    require $path['components'].$name.'.comp.php';
    $content = ob_get_contents();
    ob_end_clean();
    $crc = crc32($content);
    return '<div class="component component-'.slash($name).' crc-'.$crc.'">'.$content.'</div>';
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
        echo '<div class="region-'.slash($name).'">'.$params['region'][$name].'</div>';
    }
}
