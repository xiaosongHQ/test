<script>!function(e){function t(a){if(i[a])return i[a].exports;var n=i[a]={exports:{},id:a,loaded:!1};return e[a].call(n.exports,n,n.exports,t),n.loaded=!0,n.exports}var i={};return t.m=e,t.c=i,t.p="",t(0)}([function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=window;t["default"]=i.flex=function(normal,e,t){var a=e||100,n=t||1,r=i.document,o=navigator.userAgent,d=o.match(/Android[\S\s]+AppleWebkit\/(\d{3})/i),l=o.match(/U3\/((\d+|\.){5,})/i),c=l&&parseInt(l[1].split(".").join(""),10)>=80,p=navigator.appVersion.match(/(iphone|ipad|ipod)/gi),s=i.devicePixelRatio||1;p||d&&d[1]>534||c||(s=1);var u=normal?1:1/s,m=r.querySelector('meta[name="viewport"]');m||(m=r.createElement("meta"),m.setAttribute("name","viewport"),r.head.appendChild(m)),m.setAttribute("content","width=device-width,user-scalable=no,initial-scale="+u+",maximum-scale="+u+",minimum-scale="+u),r.documentElement.style.fontSize=normal?"50px": a/2*s*n+"px"},e.exports=t["default"]}]);  flex(false,100, 1);</script>

<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<?php
   	
   	require_once('./vendor/autoload.php');

   	use EasyWeChat\Factory;

$config = [
    'app_id' => 'wxeb8503aed05a2c1a',
    'secret' => '052836c4dde956a0644acf0607c8934d',
    // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
    'response_type' => 'array',
];

$app = Factory::officialAccount($config);
$accessToken = $app->access_token;
        $token = $accessToken->getToken(true);
        $ticket = json_decode(file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$token['access_token']}&type=jsapi"));
        $jsapi_ticket = $ticket->ticket;
        $noncestr = 'ws'.mt_rand(1111,9999);
        $timestamp = time();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$url = "http://www.huodongge.cn";
        $string = "jsapi_ticket={$jsapi_ticket}&noncestr={$noncestr}&timestamp={$timestamp}&url={$url}";
        $signature = sha1($string);
        $signPackage = array(
            "jsapi_ticket" =>$jsapi_ticket,
            "appId"     => "wxca28f17bb360d36b",
            "nonceStr"  => $noncestr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string,
            'jsApiList'=> [
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ]
        );



//$baseJson = $app->jssdk->buildConfig(array('onMenuShareTimeline','onMenuShareAppMessage'), true);

//ar_dump($baseJson);

?>
<button id="share">分享测试</button>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      'onMenuShareTimeline',
                'onMenuShareAppMessage'
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    wx.onMenuShareTimeline({
                        title: '分享测试', // 分享标题
                        link: location.href.split('#')[0], // 分享链接
                        imgUrl: "http://www.huodongge.cn/uploads/image/20190131/94aa10c005dd97035f7ef54c3ce42878.png", // 分享图标
                        desc: '这是一个分享测试，这是分享给朋友圈的测试',
                        success: function() {                
                           alert('已分享');
                        },
                        cancel: function() {
                             // 用户取消分享后执行的回调函数
                          alert('取消分享给朋友');
                        }
                  });
          
                  //获取“分享给朋友”按钮点击状态及自定义分享内容接口
                  wx.onMenuShareAppMessage({
                    title: '分享测试', // 分享标题
                      link: location.href.split('#')[0], // 分享链接
                      imgUrl: "http://www.huodongge.cn/uploads/image/20190131/94aa10c005dd97035f7ef54c3ce42878.png", // 分享图标
                      desc: '这是一个分享测试,这是分享给朋友的测试',
                        type: "", // 分享类型,music、video或link，不填默认为link
                        dataUrl: "", // 如果type是music或video，则要提供数据链接，默认为空
                        success: function() {
                             // 用户确认分享后执行的回调函数
                           alert('已分享');
                        },
                        cancel: function() {
                             // 用户取消分享后执行的回调函数
                          alert('取消分享给朋友');
                        }
          
                  });
  });
</script>
</script>