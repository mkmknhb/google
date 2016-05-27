<?

function get($key, $dval){
    return isset($_GET[$key]) ? $_GET[$key] : '';
}

$url = get('q');
if($url){
    header('Location: '.$url);
    exit();
}

