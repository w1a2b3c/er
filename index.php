<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $index = 'active';
    require('./header.php');
?>
<!-- 引入全新美化样式 -->
<link rel="stylesheet" href="assets/css/main.css?v=1">
<!-- 引入二次元风格样式 -->
<link rel="stylesheet" href="assets/css/erciyuan.css?v=1">



<script src="assets/js/jquery.min.js"></script>




        <div class="card">
			<?php echo notice('2');?>
            </div>
            
            <div class="card q-card">
                <div class="card-head q-card-head">
                    <i class="fa fa-link fa-fw"></i><span style="font-size:1.1em;">最新点入：</span>做上本站友情链接,在您站上点击一次,即可自动收录并自动排在本站第一位!<a href="apply.html" class="more q-btn"><i class="fa fa-plus-square" aria-hidden="true"></i>申请收录</a>
                </div>
                <div class="card-body q-card-body">
			<?php
				$results = $DB->query("SELECT * FROM zzdh_list order by addtime desc limit 35");
				while($rows = $DB->fetch($results))
				{ ?><a href="<?php echo "../site_{$rows['id']}.html";?>" target="_blank" class="item" title="<?php echo $rows['name'];?>" data-id="<?php echo $rows['id'];?>">
                            <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php
                                preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $rows['url'], $rowurl);
                                $domain = $rowurl[2];
                                if (!empty($rows['img'])) {
                                    echo $rows['img'];
                                } else {
                                    echo $conf['ico_api'] . $domain;
                                }
                            ?>" onerror="this.onerror=null;this.src='assets/images/default_ico.png';"></span>
                            <span class="name"><?php echo $rows['name'];?></span>
                        </a><?php }?>
                 </div>
            </div>
	<?php
		$result = $DB->query("SELECT * FROM zzdh_sort order by sid asc");
		while($row = $DB->fetch($result))
		{ ?>
			<div class="card q-card" id="<?php echo $row['sortname'];?>">
                <div class="card-head q-card-head">
                    <i class="fa <?php echo $row['icon'];?> fa-fw"></i><span style="font-size:1.1em;"><?php echo $row['sortname'];?></span><a href="<?php echo "../sort{$row['id']}.html";?>" class="more q-btn"><i class="fa fa-ellipsis-h fa-fw"></i></a>
                </div>
                <div class="card-body q-card-body">
			<?php
				$results = $DB->query("SELECT * FROM zzdh_list where sortname = '".$row['sortname']."' order by view_date desc limit 16");
				while($rows = $DB->fetch($results))
				{
		    ?><a href="<?php echo "../site_{$rows['id']}.html";?>" target="_blank" class="item" title="<?php echo $rows['name'];?>" data-id="<?php echo $rows['id'];?>">
                <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php
                    preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $rows['url'], $rowurl);
                    $domain = $rowurl[2];
                    if (!empty($rows['img'])) {
                        echo $rows['img'];
                    } else {
                        echo $conf['ico_api'] . $domain;
                    }
                ?>" onerror="this.onerror=null;this.src='assets/images/default_ico.png';"></span>
                <span class="name"><?php echo $rows['name'];?></span>
            </a>
						<?php }?>
                 </div>
            </div>
			<?php }?>
			<div class="card">
                <div class="card-head"><i class="fa fa-ellipsis-h fa-fw"></i>审核中的站点</div>
                <div class="card-body">
			<?php
				$results = $DB->query("SELECT * FROM zzdh_apply");
				while($rows = $DB->fetch($results))
				{
		    ?><a target="_blank" class="item" title="<?php echo $rows['name'];?>" data-id="<?php echo $rows['id'];?>">
                <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php
                    preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $rows['url'], $rowurl);
                    $domain = $rowurl[2];
                    if (!empty($rows['img'])) {
                        echo $rows['img'];
                    } else {
                        echo $conf['ico_api'] . $domain;
                    }
                ?>" onerror="this.onerror=null;this.src='assets/images/default_ico.png';"></span>
                <span class="name"><?php echo $rows['name'];?></span>
            </a>
						<?php }?>
				</div>
            </div>
            <div class="card">
			<?php echo notice('3');?>
            </div>
        </div>
    <div class="side">
        <div class="card">
			<a style="display: block;  position: relative; height: 60px;  line-height: 60px; margin-top: 0px; padding: 0 20px; text-align: center; font-size: 16px;font-weight: 300;color: #535b5f;background-color: #ffffff;">共计收录：<font color="#03f"><?php echo $cntlist?></font> - 待审网站：<font color="#03f"><?php echo $cntapply?></font></a>
        </div>
<div class="card q-card" style="border: 1px solid #ddd; border-radius: 8px; background-color: #fff; margin: 20px 0; padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="card-head q-card-head" style="background-color: #f5f5f5; padding: 10px; font-size: 16px; font-weight: bold; color: #333; border-bottom: 1px solid #ddd; display: flex; align-items: center;">
        <i class="fa fa-coffee fa-fw" style="margin-right: 8px; color: #4CAF50;"></i> 自动收录方法
    </div>
    <div class="card-body q-card-body" style="padding: 15px; font-size: 14px; line-height: 1.6;">
        <p style="margin-bottom: 15px; color: #555;">首页做好友情链接，点击链接，自动收录，每次来访排首位！</p>
        <div style="margin-bottom: 10px;">
            <strong>小Z自动秒收录：</strong> <a href="https://zibovip.cn" target="_blank" style="color: #007BFF; text-decoration: none;">hhttps://zibovip.cn</a>
        </div>
        <div style="margin-bottom: 10px;">
            <strong>复制下方链接代码：</strong>
            <pre style="background-color: #f8f8f8; border: 1px solid #ddd; padding: 10px; font-size: 14px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word;">
<code>&lt;a href='https://zibovip.cn/' target='_blank'&gt;小Z自动秒收录&lt;/a&gt;</code>
            </pre>
        </div>
        <div style="margin-bottom: 10px;">
            <strong>HTTPS网站需要在head头部中加入：</strong>
            <pre style="background-color: #f8f8f8; border: 1px solid #ddd; padding: 10px; font-size: 14px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word;">
<code>&lt;meta content='referrer' name='always'&gt;</code>
            </pre>
        </div>
    </div>
</div>

		
        <div class="card">
            <div class="card-head"><i class="fa fa-coffee fa-fw"></i>最新收录</div>
            <div class="card-body">
                <div class="side-latest oz-timeline">
<?php $result=$DB->query("select * from zzdh_list order by time desc limit 10");
while($rs=$DB->fetch($result)) {
?>
                <a href="<?php echo "../site_{$rs['id']}.html";?>" data-id="<?php echo $rs['id'];?>" data-id="<?php echo $rs['id'];?>" class="oz-timeline-item">
                <div class="oz-timeline-time"><?php echo date("Y-m-d h:i:s", $rs['time']);?></div>
                <div class="oz-timeline-main">
                    <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php
                        preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $rs['url'], $rowurl);
                        $domain = $rowurl[2];
                        if (!empty($rs['img'])) {
                            echo $rs['img'];
                        } else {
                            echo $conf['ico_api'] . $domain;
                        }
                    ?>" onerror="this.onerror=null;this.src='assets/images/default_ico.png';"></span>
                    <span class="name"><?php echo $rs['name'];?></span>
                </div>
            </a><?php }?>
                </div>
            </div>
        
</div>
<div class="card">
    <div class="card-head"><i class="fa fa-line-chart fa-fw"></i>本周TOP</div>
    <div class="card-body">
        <div class="view-list">
<?php 
$result = $DB->query("SELECT * FROM zzdh_list ORDER BY view_week DESC LIMIT 10");
$pai = 0;
// 获取当前是星期几（1=星期一，7=星期日）
$day_of_week = date('N');
$week_increment = $day_of_week * 84; // 星期一88，星期二176，...，星期日616
while ($rs = $DB->fetch($result)) {
    $pai = $pai + 1;
    // 本周点击按照星期几递增
    $adjusted_view_week = $rs['view_week'] + $week_increment;
?>
                <a href="<?php echo "../site_{$rs['id']}.html";?>" data-id="<?php echo $rs['id'];?>">
                    <span class="rank"><?php echo $pai;?></span>
                    <span class="icon"><img class="lazy-load" src="assets/images/loading.gif" data-src="<?php
                        preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $rs['url'], $rowurl);
                        $domain = $rowurl[2];
                        if (!empty($rs['img'])) {
                            echo $rs['img'];
                        } else {
                            echo $conf['ico_api'] . $domain;
                        }
                    ?>" onerror="this.onerror=null;this.src='assets/images/default_ico.png';"></span>
                    <span class="name"><?php echo $rs['name'];?></span>
                    <span class="view"><?php echo $adjusted_view_week;?></span>
                </a>
<?php } ?>
        </div>
    </div>
</div>
		<div class="card">
            <div class="card-head"><i class="fa fa-folder-open fa-fw"></i>导航分类</div>
            <div class="card-body">
                <div class="side-sort">
	<?php
		$result = $DB->query("SELECT * FROM zzdh_sort order by sid asc");
		while($row = $DB->fetch($result))
		{ ?><a href="<?php echo "../sort{$row['id']}.html";?>"><i class="fa <?php echo $row['icon'];?> fa-fw"></i><?php echo $row['sortname'];?></a>
                  <?php }?></div>
            </div>
        </div>
        
	<!--	<div class="card">
		  <div class="card-head"><i class="fa fa-pie-chart fa-fw"></i>热度统计</div>
            <div class="card-body">
            <div class="side-common">
			<p>今日有<?php echo top('view_day','1');?></p>
			<p>今日最受欢迎的站点是：<?php echo top('view_day','');?></p>
			<p>周月有<?php echo top('view_week','1');?></p>
			<p>周月最受欢迎的站点是：<?php echo top('view_week','');?></p>
			<p>本月有<?php echo top('view_month','1');?></p>
			<p>本月最受欢迎的站点是：<?php echo top('view_month','');?></p>
			<p>累计有<?php echo top('view','1');?></p>
			<p>总共最受欢迎的站点是：<?php echo top('view','');?></p>
			</div></div>
		</div>-->
        <div class="card">
            <div class="card-head"><i class="fa fa-pie-chart fa-fw"></i>本站统计</div>
            <div class="card-body">
                <div class="side-common">
				<p>已开设分类：<b><?php echo $cntsort?></b> 个</p>
				<p>已收录站点：<b><?php echo $cntlist?></b> 个</p>
	            <p>正申请站点：<b><?php echo $cntapply?></b> 个</p>
				<p>本站已稳定运行了 <b><script language="JavaScript" type="text/javascript">var urodz = new Date("<?php echo $conf['time'];?>");var now = new Date();var ile = now.getTime() - urodz.getTime();var dni = Math.floor(ile / (1000 * 60 * 60 * 24));document.write( + dni)</script></b> 天。</p>
		</div>
            </div>
        </div>

    </div>
			<div class="card links q-card">
			<div class="card-head q-card-head"><i class="fa fa-link fa-fw"></i>友情链接</div>

			<div class="card-body q-card-body">
				<?php echo notice('5');?>
			</div>
		</div>
</div>

<ul class="suspend">
	<li class="back-top" onclick="backTop()">
		<i class="fa fa-chevron-up"></i>
		<span class="more">返回顶部</span>
	</li>
	<li>
		<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq'];?>&site=qq&menu=yes">
			<i class="fa fa-qq"></i>
			<span class="more"><?php echo $conf['qq'];?></span>
		</a>
	</li>
	<li>
		<a href="mailto:<?php echo $conf['qq'];?>@qq.com">
			<i class="fa fa-envelope"></i>
			<span class="more"><?php echo $conf['qq'];?>@qq.com</span>
		</a>
	</li>
	<li>
		<i class="fa fa-weixin"></i>
		<span class="more weixin"><img src="assets/images/weixin.png" alt="微信二维码"></span>
	</li>
	<li>
	
	</li>
</ul>

<!-- 1. 顶部梦幻星星、泡泡、樱花瓣SVG装饰 -->
<div class="erciyuan-decor-top" style="position:fixed;top:0;left:0;width:100vw;height:0;z-index:1000;pointer-events:none;">
  <svg width="120" height="60" style="position:absolute;left:24px;top:8px;" viewBox="0 0 120 60"><circle cx="60" cy="30" r="28" fill="#ffb6ec" fill-opacity="0.18"/><polygon points="60,10 65,30 85,35 70,50 75,70 60,60 45,70 50,50 35,35 55,30" fill="#fff" fill-opacity="0.18"/></svg>
  <svg width="60" height="60" style="position:absolute;right:32px;top:16px;" viewBox="0 0 60 60"><ellipse cx="30" cy="30" rx="28" ry="18" fill="#aee2ff" fill-opacity="0.18"/></svg>
</div>
<!-- 2. 侧边梦幻泡泡动画 -->
<div class="erciyuan-bubbles" style="position:fixed;right:0;top:30vh;width:60px;height:300px;z-index:1000;pointer-events:none;">
  <div class="bubble" style="left:10px;top:40px;animation-delay:0s;"></div>
  <div class="bubble" style="left:30px;top:120px;animation-delay:1.5s;"></div>
  <div class="bubble" style="left:20px;top:200px;animation-delay:3s;"></div>
</div>
<style>
.bubble {
  position: absolute;
  width: 32px; height: 32px;
  background: radial-gradient(circle at 30% 30%, #fff 60%, #aee2ff 100%);
  border-radius: 50%;
  opacity: 0.5;
  animation: float 6s infinite linear;
}
@keyframes float {
  0% { transform: translateY(0);}
  100% { transform: translateY(-120px);}
}
</style>
<!-- 3. 分类区加入热门二次元标签和SVG点缀 -->
<div class="card q-card" style="margin-top:18px;">
  <div class="card-head q-card-head">
    <span style="font-size:1.2em;">热门二次元类型</span>
    <span class="erciyuan-magic"></span>
  </div>
  <div class="card-body q-card-body" style="display:flex;flex-wrap:wrap;gap:12px;">
    <span class="q-btn" style="background:#ffb6ec;">梦可爱</span>
    <span class="q-btn" style="background:#aee2ff;">古风</span>
    <span class="q-btn" style="background:#ffe066;color:#ff8ae2;">像素风</span>
    <span class="q-btn" style="background:#fff6fa;color:#ff8ae2;">萌系</span>
    <span class="q-btn" style="background:#fff0fa;color:#aee2ff;">魔法少女</span>
    <span class="q-btn" style="background:#e0c3fc;color:#fff;">傲娇</span>
    <span class="q-btn" style="background:#b2f7ef;color:#ff8ae2;">治愈系</span>
    <span class="q-btn" style="background:#f8e1ff;color:#aee2ff;">Q版</span>
    <span class="q-btn" style="background:#fff;color:#ffb6ec;">兽耳</span>
    <span class="q-btn" style="background:#fff;color:#aee2ff;">双马尾</span>
  </div>
</div>
<!-- 4. 卡片区加入猫爪、像素小人SVG点缀 -->
<div class="erciyuan-paw" style="position:absolute;top:80px;left:0;z-index:10;"><svg width="38" height="38"><ellipse cx="19" cy="28" rx="12" ry="8" fill="#fff"/><ellipse cx="10" cy="20" rx="4" ry="5" fill="#fff"/><ellipse cx="28" cy="20" rx="4" ry="5" fill="#fff"/><ellipse cx="19" cy="16" rx="3" ry="3.5" fill="#fff"/></svg></div>
<div class="erciyuan-pixel" style="position:absolute;right:0;top:180px;z-index:10;"><svg width="32" height="32" viewBox="0 0 32 32"><rect x="8" y="8" width="16" height="16" fill="#ffe066" stroke="#ffb6ec" stroke-width="2"/><rect x="12" y="12" width="4" height="4" fill="#ffb6ec"/><rect x="16" y="16" width="4" height="4" fill="#aee2ff"/></svg></div>
<!-- 5. 页脚加入Q版吉祥物和泡泡动画 -->
<footer class="footer q-footer" style="position:relative;">
  <div style="position:absolute;left:12px;bottom:12px;z-index:2;">
    <svg width="56" height="56" viewBox="0 0 56 56"><ellipse cx="28" cy="28" rx="28" ry="28" fill="#aee2ff" fill-opacity="0.18"/><ellipse cx="28" cy="36" rx="18" ry="12" fill="#fff"/><ellipse cx="28" cy="20" rx="12" ry="12" fill="#ffb6ec"/><ellipse cx="24" cy="18" rx="2" ry="3" fill="#fff"/><ellipse cx="32" cy="18" rx="2" ry="3" fill="#fff"/><ellipse cx="28" cy="26" rx="5" ry="3" fill="#fff"/><ellipse cx="28" cy="29" rx="3" ry="2" fill="#ffb6ec"/><ellipse cx="28" cy="28" rx="11" ry="11" fill="none" stroke="#aee2ff" stroke-width="1.5"/></svg>
    <div style="font-size:0.9em;color:#ff8ae2;text-align:center;">Q萌吉祥物</div>
  </div>
  <div style="position:absolute;right:24px;bottom:18px;z-index:2;">
    <div class="bubble" style="width:24px;height:24px;animation-delay:2s;"></div>
    <div class="bubble" style="width:18px;height:18px;animation-delay:3.5s;"></div>
  </div>
  <p>Copyright © 2018 - 2021 <a href="../"><?php echo $conf['name'];?></a>. All Rights Reserved.</p>
  <p><?php echo $conf['info'];?></p>
  <center>今天:<span><script language=Javascript type=text/Javascript> 
var day=""; 
var month=""; 
var ampm=""; 
var ampmhour=""; 
var myweekday=""; 
var year=""; 
mydate=new Date(); 
myweekday=mydate.getDay(); 
mymonth=mydate.getMonth()+1; 
myday= mydate.getDate(); 
myyear= mydate.getYear(); 
year=(myyear > 200) ? myyear : 1900 + myyear; 
if(myweekday == 0) 
weekday=" 星期日 "; 
else if(myweekday == 1) 
weekday=" 星期一 "; 
else if(myweekday == 2) 
weekday=" 星期二 "; 
else if(myweekday == 3) 
weekday=" 星期三 "; 
else if(myweekday == 4) 
weekday=" 星期四 "; 
else if(myweekday == 5) 
weekday=" 星期五 "; 
else if(myweekday == 6) 
weekday=" 星期六 "; 
document.write(year+"年"+mymonth+"月"+myday+"日 "+weekday); 
</script><br>
<span id="showsectime" style="color:#FF0000;">
<script type="text/javascript">
function NewDate(str) { 
str = str.split('-'); 
var date = new Date(); 
date.setUTCFullYear(str[0], str[1] - 1, str[2]); 
date.setUTCHours(0, 0, 0, 0, 0); 
return date; 
} 
function showsectime() {
var birthDay =NewDate("<?php echo $conf['time'];?>");//这里是建站时间
var today=new Date();
var timeold=today.getTime()-birthDay.getTime();
var sectimeold=timeold/1000
var secondsold=Math.floor(sectimeold);
var msPerDay=24*60*60*1000; var e_daysold=timeold/msPerDay;
var daysold=Math.floor(e_daysold);
var e_hrsold=(daysold-e_daysold)*-24;
var hrsold=Math.floor(e_hrsold);
var e_minsold=(hrsold-e_hrsold)*-60;
var minsold=Math.floor((hrsold-e_hrsold)*-60); var seconds=Math.floor((minsold-e_minsold)*-60).toString();
document.getElementById("showsectime").innerHTML = "本站已安全运行"+daysold+"天"+hrsold+"小时"+minsold+"分"+seconds+"秒";
setTimeout(showsectime, 1000);
}showsectime();
</script>
</footer>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/layer/layer.js"></script>
<script src="templates/antidote/js/main.js"></script>
<div id="j-fish-skip" style="background: #ffffff;"></div>
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->

<!-- ====== 二次元樱花瓣动画容器 ====== -->
<div class="sakura"></div>
<script>
// 动态生成樱花瓣
(function(){
  var sakuraCount = 18;
  for(var i=0;i<sakuraCount;i++){
    var petal = document.createElement('div');
    petal.className = 'sakura-petal';
    petal.style.left = Math.random()*100+'vw';
    petal.style.animationDelay = (Math.random()*6)+'s';
    petal.style.top = '-40px';
    document.querySelector('.sakura').appendChild(petal);
  }
})();
</script>

<!-- ====== Q版吉祥物SVG（猫娘） ====== -->
<div class="q-mascot">
  <svg width="90" height="110" viewBox="0 0 90 110">
    <ellipse cx="45" cy="80" rx="32" ry="18" fill="#fff6fa"/>
    <ellipse cx="45" cy="60" rx="28" ry="32" fill="#ffb6ec"/>
    <ellipse cx="30" cy="40" rx="8" ry="12" fill="#fff"/>
    <ellipse cx="60" cy="40" rx="8" ry="12" fill="#fff"/>
    <ellipse cx="45" cy="70" rx="12" ry="8" fill="#fff"/>
    <ellipse cx="45" cy="90" rx="18" ry="6" fill="#aee2ff" fill-opacity="0.18"/>
    <polygon points="20,20 30,10 35,30" fill="#ffb6ec"/>
    <polygon points="70,20 60,10 55,30" fill="#ffb6ec"/>
    <ellipse cx="38" cy="60" rx="3" ry="5" fill="#fff"/>
    <ellipse cx="52" cy="60" rx="3" ry="5" fill="#fff"/>
    <ellipse cx="45" cy="75" rx="5" ry="3" fill="#fff"/>
    <ellipse cx="45" cy="78" rx="3" ry="2" fill="#ffb6ec"/>
    <ellipse cx="45" cy="60" rx="18" ry="22" fill="none" stroke="#aee2ff" stroke-width="2"/>
  </svg>
</div>



<!-- ====== 背景音乐按钮和audio ====== -->
<div id="music-btn" title="点击播放/暂停BGM">
  <svg viewBox="0 0 32 32"><path d="M8 28a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm12-2V6h8V4h-10v20.18A6 6 0 1 0 20 24zm-2 2a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/></svg>
</div>
<audio id="bgm-audio" src="https://cdn.jsdelivr.net/gh/Chion82/musicbox@master/music/二次元/ClariS%20-%20Connect.mp3" loop preload="auto"></audio>
<script>
var musicBtn = document.getElementById('music-btn');
var audio = document.getElementById('bgm-audio');
var isPlaying = false;
musicBtn.onclick = function(){
  if(isPlaying){
    audio.pause();
    isPlaying = false;
    musicBtn.style.filter = '';
  }else{
    audio.play();
    isPlaying = true;
    musicBtn.style.filter = 'drop-shadow(0 0 8px #ffb6ec)';
  }
};
audio.onended = function(){ isPlaying = false; musicBtn.style.filter = ''; };
</script>
<!-- ====== 二次元美化END ====== -->
</body>
</html>