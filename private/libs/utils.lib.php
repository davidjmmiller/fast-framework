<?php

// Utils
function pre($var){
    echo '<pre>'.print_r($var,true).'</pre>';
}


function slash($t){
    return str_replace('/','-',$t);
}
