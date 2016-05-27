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

function get_counter(){
    return '<div style="display:none" ><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=\'cnzz_stat_icon_1656292\'%3E%3C/span%3E%3Cscript src=\'" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1656292\' type=\'text/javascript\'%3E%3C/script%3E"));</script>
</div>';
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
        $con = file_get_contents($url, false, $ctx);
    }else{
        header('Content-Type:text/html;charset=gbk');
        $con = file_get_contents($url);
    }

    return $con.get_counter();
    //return str_replace('google.com.hk', 'axx.com.cn', $con);
}



$url = get_google_url();
echo get_content($url);
