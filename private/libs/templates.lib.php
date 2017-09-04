<?php

/* Functions */


function component($region,$name, $params, $expiration = 0, $type = 0, $crc = NULL){
    global $path;
    global $g_components;
    global $g_crc;

    ob_start();
    require $path['components'].$name.'.comp.php';
    $content = ob_get_contents();
    ob_end_clean();
    $crc = crc32($content);
    if (!isset($g_components[$region])){
        $g_components[$region] = array();
        $g_crc[$region] = array();
    }
    $g_components[$region][slash($name)] = '<div class="component component-'.slash($name).'">'.$content.'</div>';
    $g_crc[$region][slash($name)] = $crc;
    // return $g_components[$region][slash($name)];
}

function tpl($name,$params, $type = 1){
    global $path;
    global $g_components;
    global $g_crc;

    // Types definition
    $types = array();
    $types[0] = 'layout';
    $types[1] = 'components';

    if ($type == 0 && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        echo json_encode($g_components);
        exit;
    }

    if ($type == 0){
        ob_start();
        require $path['templates'].$types[$type].'/'.$name.'.tpl.php';
        $content = ob_get_contents();
        ob_end_clean();
        $tmp = $g_crc;
        $g_crc = array();
        $g_crc[$name] = $tmp;
        $g_crc[$name]['_crc'] = crc32($content);

        // Setting the cookie master value
        setcookie('page_information', json_encode($g_crc), time() + (86400 * 30), "/"); // 86400 = 1 day
        
        return $content;
    }
    else {
        require $path['templates'].$types[$type].'/'.$name.'.tpl.php';
    }
 
}

function region($name)
{
    global $g_components;
    global $g_crc;


    $output = '';
    $crc = 0;
    if (isset($g_components[$name])) {
        if (isset($g_components[$name]) && count($g_components[$name]) > 0){
            foreach($g_components[$name] as $block_name => $block){
                $output .= $block;
            }
        }
        $crc = crc32($output);
        $g_crc[$name]['_crc'] = $crc;
        echo '<div class="region region-'.slash($name).'">';
        echo $output;
        echo '</div>';
    }
}
