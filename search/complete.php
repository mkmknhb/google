<?php
include 'functions.php';

function main(){
    $keyword = isset($_GET['q']) ? $_GET['q'] : '';
    if(!$keyword){
        return ;
    }

    $ua = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0";
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n".
                  "Cookie: foo=bar\r\n".
                  "Content-type: application/x-www-form-urlencoded\r\n".
                  "User-Agent: ".$ua."\r\n"
      )
    );
    $context = stream_context_create($opts);
    
    $url = 'http://www.google.com.tw/complete/search?ie=utf-8&client=hp&hl=zh-CN&gs_rn=48&gs_ri=hp&cp=2&gs_id=4n&xhr=t&q='.$keyword;
    echo file_get_contents($url, false, $context);
}

main();