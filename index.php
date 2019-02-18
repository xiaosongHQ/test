<script>!function(e){function t(a){if(i[a])return i[a].exports;var n=i[a]={exports:{},id:a,loaded:!1};return e[a].call(n.exports,n,n.exports,t),n.loaded=!0,n.exports}var i={};return t.m=e,t.c=i,t.p="",t(0)}([function(e,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var i=window;t["default"]=i.flex=function(normal,e,t){var a=e||100,n=t||1,r=i.document,o=navigator.userAgent,d=o.match(/Android[\S\s]+AppleWebkit\/(\d{3})/i),l=o.match(/U3\/((\d+|\.){5,})/i),c=l&&parseInt(l[1].split(".").join(""),10)>=80,p=navigator.appVersion.match(/(iphone|ipad|ipod)/gi),s=i.devicePixelRatio||1;p||d&&d[1]>534||c||(s=1);var u=normal?1:1/s,m=r.querySelector('meta[name="viewport"]');m||(m=r.createElement("meta"),m.setAttribute("name","viewport"),r.head.appendChild(m)),m.setAttribute("content","width=device-width,user-scalable=no,initial-scale="+u+",maximum-scale="+u+",minimum-scale="+u),r.documentElement.style.fontSize=normal?"50px": a/2*s*n+"px"},e.exports=t["default"]}]);  flex(false,100, 1);</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
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

$baseJson = $app->jssdk->buildConfig(array('onMenuShareQQ', 'onMenuShareWeibo'), true);

//ar_dump($baseJson);

?>
<button id="share">分享测试</button>
<script>
wx.ready(function(){
	var baseJson = (<?php echo $baseJson; ?>);
	console.log(baseJson);
	wx.config(baseJson);
	wx.onMenuShareAppMessage({
    title: '微信分享测试', // 分享标题
    desc: '这是一个微信的分享测试', // 分享描述
    link: 'http://www.xiaosonghq.com', // 分享链接，该链接域名必须与当前企业的可信域名一致
    imgUrl: 'http://www.xiaosonghq.com/app/uploads/20190116/PVyRNAELlzqWHzBs3kLoBYT9col9V3l2FwgW7n1B.png', // 分享图标
    type: 'link', // 分享类型,music、video或link，不填默认为link
    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
    success: function () {
        // 用户确认分享后执行的回调函数
        alert('分享成功');
    },
    cancel: function () {
        // 用户取消分享后执行的回调函数
        alert('分享取消');
    }
});

	wx.onMenuShareTimeline({
            title: '测试', // 分享标题
            link: 'http://www.xiaosonghq.com', // 分享链接
            imgUrl: 'http://www.xiaosonghq.com/app/uploads/20190116/PVyRNAELlzqWHzBs3kLoBYT9col9V3l2FwgW7n1B.png',
            success: function (res) {
                alert('已分享');
            },
            cancel: function (res) {
                alert('已取消');
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });   

});
</script>