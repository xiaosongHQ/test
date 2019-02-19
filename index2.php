<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxeb8503aed05a2c1a", "052836c4dde956a0644acf0607c8934d");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  
</body>
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
</html>
