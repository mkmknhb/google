<?php
function get($key, $dval){
    return isset($_GET[$key]) ? $_GET[$key] : '';
}

$url = get('q');
if($url){ //find location url
    header('Location: '.$url);
    exit();
}

var_dump($_GET);
