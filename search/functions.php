<?

function get_mobile_context(){
    $ua = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_0 like Mac OS X; en-us) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8A293 Safari/6531.22.7";
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Host: www.google.com.hk\r\n".
                  "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n".
                  "Cookie: PREF=ID=50de7b4edeb386a9:U=0f2e91c4aedc306d:FF=1:LD=zh-CN\r\n".
                  "Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3\r\n".
                  "Connection: keep-alive\r\n".
                  "Cache-Control: max-age=0\r\n".
                  "User-Agent: ".$ua."\r\n"
      )
    );
    $ctx = stream_context_create($opts);
    return $ctx;
}

function get_common_context(){
    $ua = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0";
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Host: www.google.com.hk\r\n".
                  "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n".
                  "Cookie: PREF=ID=50de7b4edeb386a9:U=0f2e91c4aedc306d:FF=1:LD=zh-CN\r\n".
                  "Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3\r\n".
                  "Connection: keep-alive\r\n".
                  "Cache-Control: max-age=0\r\n".
                  "User-Agent: ".$ua."\r\n"
      )
    );
    $ctx = stream_context_create($opts);
    return $ctx;
}

function is_mobile(){
    switch(true){
        // Apple/iPhone browser renders as mobile
        case (preg_match('/(apple|iphone|ipod)/i', $_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile/i', $_SERVER['HTTP_USER_AGENT'])):
            return true;
            break;
            
        // Other mobile browsers render as mobile
        case (preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera     mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i',$_SERVER['HTTP_USER_AGENT'])):
            return true;
            break;
        
        // Wap browser
        case (isset($_SERVER['HTTP_ACCEPT']) && (((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'text/vnd.wap.wml') > 0) || (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0)) || ((isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))))):
            return true;
            break;
            
        // Shortend user agents
        case (in_array(strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,3)),array('lg '=>'lg ','lg-'=>'lg-','lg_'=>'lg_','lge'=>'lge')));
            return true;
            break;
            
        // More shortend user agents    
        case(in_array(strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4)),array('acs-'=>'acs-','amoi'=>'amoi','doco'=>'doco','eric'=>'eric','huaw'=>'huaw','lct_'=>'lct_','leno'=>'leno','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','nec-'=>'nec-','phil'=>'phil','sams'=>'sams','sch-'=>'sch-','shar'=>'shar','sie-'=>'sie-','wap_'=>'wap_','zte-'=>'zte-')));
            return true;
            break;
        
        // Render mobile site for mobile search engines
        case (preg_match('/Googlebot-Mobile/i', $_SERVER['HTTP_USER_AGENT']) || preg_match('/YahooSeeker\/M1A1-R2D2/i', $_SERVER['HTTP_USER_AGENT'])):
            return true;
            break;
    }
    return false;
}