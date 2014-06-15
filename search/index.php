<?php
include 'functions.php';

/**
 * get google query url
 * @return string url
 */
function get_google_url(){
    $keyword = isset($_GET['q']) ? $_GET['q'] : 'fuck';
    $ukey = urlencode($keyword);

    $host = 'http://www.google.com.tw';
    $url = $host.'/search?ie=utf-8&hl=zh-CN&gl=cn&source=hp&source=android-unknown&q='.$ukey;
    if(isset($_GET['hl'])){
        $query = http_build_query($_GET);
        $url = $host.'/search?'.$query;
    }
    return $url;
}

/**
 * get google content
 * @param  string $url url
 * @return string content
 */
function get_content($url){
    if(is_mobile()){
        header('Content-Type:text/html;charset=utf-8');
        $ctx = get_mobile_context();
        return file_get_contents($url, false, $ctx);
    }else{
        header('Content-Type:text/html;charset=gbk');
        return file_get_contents($url);
    }
}

$url = get_google_url();
echo get_content($url);
