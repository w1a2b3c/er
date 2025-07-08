<?php
	require ('./module.php');
	$t_url=$_GET['url'];
	if(!empty($t_url)) {
		preg_match('/(http|https):\/\//',$t_url,$matches);
		 if($matches){
			$url=$t_url;
			$title='页面跳转中，请稍候……';
		 }else{
			preg_match('/\./i',$t_url,$matche);
			if($matche){
				$url='http://'.$t_url;
				$title='页面跳转中，请稍候……';
			}else{
				$url='../';
				$title='链接错误，正在返回……';
			}
		}
	}else{
		$title='链接错误，正在返回……';
		$url='../';
	} ?>
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://www.x6d.com/static/css/bootstrap.min.css">
<title><?php echo $title;?></title>  

<style>  
body{width:100%;height:100vh}
.main{position:relative;width:100%;height:100%;background:#000;display:flex;justify-content:center;align-items:center}
.circle{display:flex;justify-content:center;align-items:center;width:200px;height:200px;background-image:linear-gradient(0deg,#2f66ff,#9940ff 30%,#ee37ff 60%,#ff004c 100%);border-radius:50%;animation:rotate 1s linear infinite}
.circle::before{content:"";position:absolute;width:200px;height:200px;background-image:linear-gradient(0deg,#2f66ff,#9940ff 30%,#ee37ff 60%,#ff004c 100%);border-radius:50%;filter:blur(35px)}
.circle::after{content:"";position:absolute;width:150px;height:150px;background:#000;border-radius:50%}
h1{position:absolute;color:#fff;font-weight:700}
.title{color:#fff;position:absolute;top:10%;text-shadow:0 0 30px #fff;text-align:center;font-size:2rem;font-weight:700}
.text{color:#fff;position:absolute;bottom:10%;text-shadow:0 0 30px #fff;font-weight:700;text-align:center}
@keyframes rotate{0%{transform:rotate(0)}
100%{transform:rotate(360deg)}
}
	@media screen and (max-device-width: 800px) { 
	
	}
</style>  
</head>  
	<body onload="time()">
	    <div class="main">
			<div class="circle"></div>
			<h1 id="second">3s</h1>
			<p class="title"><?php echo $title;?></p>
			<p class="text">网络交易请谨慎 如遇欺诈或纠纷 请投诉至邮箱：3370156773@qq.com</p>
		</div>
	</body>\

	<script>
		function cs(){
			var query = window.location.search.substring(1);
			       var vars = query.split("&");
			       for (var i=0;i<vars.length;i++) {
			               var pair = vars[i].split("=");
			               if(pair[0] == "url"){
							   return pair[1];
							}
			       }
			return("<?php echo $url;?>");//无指定跳转地址，将跳转此网页地址。
		}
		function time(){
			var sec = document.getElementById("second");
			 var i = 3;//设置定时时间
			 var timer = setInterval(function(){
			 i--;
			 sec.innerHTML = i+"s";
			 if(i==1){
			  window.location.href = cs();
			 }
			 },1000);
			  
			 function goBack(){ 
			 window.history.go(-1);
			 } 
		}
	</script>
</html>  