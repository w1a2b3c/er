<?php
	ini_set("display_errors", 0);
	require ('./inc/lang.php');
	require ('./module.php');
	preg_match("/^(http:\/\/|https:\/\/)?([^\/]+)/i", $_SERVER['HTTP_REFERER'], $laiyuan); //获取该网站域名
	$zhandian = $laiyuan[2];
	if($zhandian!='' && $zhandian!=$_SERVER['HTTP_HOST']){
		mysql_query("set names utf8");
		$sql = "update zzdh_list set addtime = '".time()."' where url LIKE '%//".$zhandian."%'";
		$result = mysql_query($sql);
	}
?>
<!DOCTYPE html>
<html>

    <head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1,maximum-scale=1,user-scalable=no">
        <title><?php if($tid==1){echo "{$row_sort['sortname']} - {$conf['name']}";}elseif($tid==2){echo "{$row_list['name']} - {$row_list['sortname']} - {$conf['name']}";}elseif($tid==3){echo "{$lang->index->about} - {$conf['name']}";}elseif($tid==4){echo "{$lang->index->nofound} - {$conf['name']}";}elseif($tid==5){echo "{$lang->index->search} - {$conf['name']}";}elseif($tid==6){echo "{$lang->index->apply} - {$conf['name']}";}else{echo "{$conf['title']}";};?></title>
        <meta name="keywords" content="<?php echo $conf['keywords'];?>">
        <meta name="description" content="<?php echo $conf['description'];?>">
	    <link rel="shortcut icon" type="images/x-icon" href="./favicon.ico"/>
	    <link rel="stylesheet" type="text/css" href="./assets/css/font-awesome-4.7.0/css/font-awesome.css"/>
	    <link rel="stylesheet" type="text/css" href="./assets/css/ozui.min.css"/>
	    <link rel="stylesheet" type="text/css" href="./templates/antidote/css/style.css"/>
<!-- 二次元挂件样式开始 -->
<style>
    @media only screen and (max-width: 760px) {
        .erciyuan-hang-left, .erciyuan-hang-right {
            display:none;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .right {
            float: left!important;
        }
    }
    .erciyuan-hang-left {
        position: fixed;
        top: 20px;
        left: 10px;
        z-index: 3;
        animation: hang-swing-left 4s infinite ease-in-out;
        transform-origin: top center;
    }
    .erciyuan-hang-right {
        position: fixed;
        top: 20px;
        right: 10px;
        z-index: 3;
        animation: hang-swing-right 4s infinite ease-in-out;
        transform-origin: top center;
    }
    .erciyuan-hang {
        position: relative;
        width: 80px;
        height: 100px;
        margin: 20px;
        filter: drop-shadow(0 4px 8px rgba(255,182,236,0.3));
    }
    .erciyuan-hang-string {
        position: absolute;
        top: -15px;
        left: 50%;
        width: 2px;
        height: 20px;
        background: linear-gradient(to bottom, #aee2ff, #ffb6ec);
        transform: translateX(-50%);
        border-radius: 1px;
    }
    .erciyuan-hang-body {
        position: relative;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ffb6ec 0%, #aee2ff 100%);
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 4px 16px rgba(255,182,236,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'ZCOOL XiaoWei', '微软雅黑', sans-serif;
        font-size: 14px;
        color: #fff;
        font-weight: bold;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }
    .erciyuan-hang-body::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #ffb6ec, #aee2ff, #ffe066, #ffb6ec);
        border-radius: 50%;
        z-index: -1;
        animation: hang-glow 3s infinite;
    }
    .erciyuan-hang-tassel {
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 12px;
        background: linear-gradient(to bottom, #ffe066, #ffb6ec);
        border-radius: 2px;
    }
    .erciyuan-hang-tassel::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        width: 8px;
        height: 8px;
        background: #ffb6ec;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(255,182,236,0.6);
    }
    @keyframes hang-swing-left {
        0%, 100% { transform: rotate(-8deg); }
        50% { transform: rotate(8deg); }
    }
    @keyframes hang-swing-right {
        0%, 100% { transform: rotate(8deg); }
        50% { transform: rotate(-8deg); }
    }
    @keyframes hang-glow {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; }
    }
    .night .erciyuan-hang-left,
    .night .erciyuan-hang-right {
        filter: brightness(0.8);
    }
    
    /* 手机端隐藏二次元装饰元素 */
    @media only screen and (max-width: 768px) {
        .erciyuan-avatar {
            display: none !important;
        }
        .navbar-links {
            display: none !important;
        }
        .erciyuan-decor-top {
            display: none !important;
        }
        .erciyuan-hang-left,
        .erciyuan-hang-right {
            display: none !important;
        }
    }
    
    /* 导航栏滚动隐藏/显示效果 */
    .q-navbar {
        transition: transform 0.3s ease-in-out;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(255, 182, 236, 0.2);
    }
    
    .q-navbar.navbar-hidden {
        transform: translateY(-100%);
    }
    
    .q-navbar.navbar-visible {
        transform: translateY(0);
    }
</style>
<div class="erciyuan-hang-left">
    <div class="erciyuan-hang">
        <div class="erciyuan-hang-string"></div>
        <div class="erciyuan-hang-body">萌</div>
        <div class="erciyuan-hang-tassel"></div>
    </div>
</div>
<div class="erciyuan-hang-right">
    <div class="erciyuan-hang">
        <div class="erciyuan-hang-string"></div>
        <div class="erciyuan-hang-body">爱</div>
        <div class="erciyuan-hang-tassel"></div>
    </div>
</div>
<!-- 二次元挂件样式结束 -->

<!-- 导航栏滚动隐藏/显示JavaScript -->
<script>
(function() {
    let lastScrollTop = 0;
    let navbar = document.querySelector('.q-navbar');
    let scrollThreshold = 50; // 滚动阈值
    let isScrolling = false;
    
    if (!navbar) return;
    
    // 初始化导航栏状态
    navbar.classList.add('navbar-visible');
    
    function handleScroll() {
        if (isScrolling) return;
        
        isScrolling = true;
        setTimeout(() => { isScrolling = false; }, 100);
        
        let currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // 如果滚动距离小于阈值，显示导航栏
        if (currentScrollTop < scrollThreshold) {
            navbar.classList.remove('navbar-hidden');
            navbar.classList.add('navbar-visible');
            return;
        }
        
        // 向上滚动时显示导航栏
        if (currentScrollTop < lastScrollTop) {
            navbar.classList.remove('navbar-hidden');
            navbar.classList.add('navbar-visible');
        }
        // 向下滚动时隐藏导航栏
        else if (currentScrollTop > lastScrollTop) {
            navbar.classList.remove('navbar-visible');
            navbar.classList.add('navbar-hidden');
        }
        
        lastScrollTop = currentScrollTop;
    }
    
    // 添加滚动监听
    window.addEventListener('scroll', handleScroll, { passive: true });
    
    // 添加触摸事件支持（移动端）
    let touchStartY = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartY = e.touches[0].clientY;
    }, { passive: true });
    
    document.addEventListener('touchend', function(e) {
        touchEndY = e.changedTouches[0].clientY;
        let touchDiff = touchStartY - touchEndY;
        
        // 向上滑动显示导航栏，向下滑动隐藏导航栏
        if (Math.abs(touchDiff) > 30) { // 最小滑动距离
            if (touchDiff > 0) { // 向上滑动
                navbar.classList.remove('navbar-hidden');
                navbar.classList.add('navbar-visible');
            } else { // 向下滑动
                navbar.classList.remove('navbar-visible');
                navbar.classList.add('navbar-hidden');
            }
        }
    }, { passive: true });
    
})();
</script>
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
    </head>
    <body>
<!-- 二次元梦幻装饰：顶部星星、泡泡、樱花瓣SVG -->
<div class="erciyuan-decor-top" style="position:fixed;top:0;left:0;width:100vw;height:0;z-index:1000;pointer-events:none;">
  <svg width="120" height="60" style="position:absolute;left:24px;top:8px;" viewBox="0 0 120 60"><circle cx="60" cy="30" r="28" fill="#ffb6ec" fill-opacity="0.18"/><polygon points="60,10 65,30 85,35 70,50 75,70 60,60 45,70 50,50 35,35 55,30" fill="#fff" fill-opacity="0.18"/></svg>
  <svg width="60" height="60" style="position:absolute;right:32px;top:16px;" viewBox="0 0 60 60"><ellipse cx="30" cy="30" rx="28" ry="18" fill="#aee2ff" fill-opacity="0.18"/></svg>
</div>
<!-- 全局二次元CSS -->
<link rel="stylesheet" href="assets/css/erciyuan.css?v=1">
<!-- 二次元梦幻美化头部组件 -->
<div class="header q-header">
  <nav class="navbar q-navbar">
    <div class="navbar-logo erciyuan-logo" style="display:flex;align-items:center;gap:10px;position:relative;">
      <img src="assets/images/logo.png" alt="logo" style="height:56px;border-radius:50%;box-shadow:0 2px 12px #ffb6ec77;border:4px solid #fff;background:#fff;">
      <span class="navbar-title erciyuan-title" style="font-size:2rem;font-weight:bold;letter-spacing:2px;color:#ff8ae2;text-shadow:1px 2px 0 #fff,0 2px 8px #aee2ff;font-family:'ZCOOL KuaiLe','Smiley Sans','幼圆','微软雅黑',Arial,sans-serif;">站长技术导航</span>
      <span style="position:absolute;left:-36px;top:-18px;z-index:1;">
        <!-- 二次元风格星星SVG装饰 -->
        <svg width="60" height="36" viewBox="0 0 60 36" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="30" cy="18" rx="30" ry="18" fill="#aee2ff" opacity="0.5"/><ellipse cx="45" cy="12" rx="10" ry="6" fill="#fff" opacity="0.7"/><ellipse cx="15" cy="24" rx="8" ry="5" fill="#fff" opacity="0.7"/><polygon points="30,6 33,16 44,18 36,25 38,34 30,29 22,34 24,25 16,18 27,16" fill="#ffb6ec" opacity="0.7"/></svg>
      </span>
      <span class="erciyuan-avatar" style="margin-left:10px;display:none;">
        <!-- 免费无版权二次元人物SVG，来自OpenDoodles（https://www.opendoodles.com/） -->
        <svg width="56" height="56" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;">
          <ellipse cx="100" cy="100" rx="100" ry="100" fill="#aee2ff" fill-opacity="0.18"/>
          <ellipse cx="100" cy="120" rx="40" ry="50" fill="#fff"/>
          <ellipse cx="100" cy="90" rx="30" ry="30" fill="#ffb6ec"/>
          <ellipse cx="90" cy="85" rx="5" ry="8" fill="#fff"/>
          <ellipse cx="110" cy="85" rx="5" ry="8" fill="#fff"/>
          <ellipse cx="100" cy="110" rx="12" ry="8" fill="#fff"/>
          <ellipse cx="100" cy="115" rx="8" ry="4" fill="#ffb6ec"/>
          <ellipse cx="100" cy="100" rx="28" ry="28" fill="none" stroke="#aee2ff" stroke-width="2"/>
        </svg>
      </span>
    </div>
    <div class="navbar-links" style="display:flex;align-items:center;gap:8px;margin-left:auto;">
      <a href="/" class="nav-item q-btn"><i class="fa fa-home"></i> 首页</a>
      <a href="/apply.php" class="nav-item q-btn"><i class="fa fa-plus-square"></i> 申请收录</a>
      <a href="/about.php" class="nav-item q-btn"><i class="fa fa-info-circle"></i> 关于本站</a>
    </div>
  </nav>
</div>
<!-- /二次元梦幻美化头部组件 -->
<div class="banner" data-src="https://static.zibovip.top/imgs/2025/03/c8e6174c15c69019.jpg" 
         data-fallback="./assets/images/banner.jpg">
    <ul class="search-type">
        <span class="title">搜索</span>
        <li data-type="this" class="active">本站</li>
        <li data-type="baidu">百度</li>
        <li data-type="sogou">搜狗</li>
        <li data-type="360">360</li>
        <li data-type="bing">必应</li>
    </ul>
    <form class="search-main" action="./search.html" method="get">
        <input class="search-input" placeholder="请输入关键词..." name="keyword" required="required">
        <button type="submit" class="search-btn" >本站搜索</button>
    </form>
    
    <!-- 广告位展示区域 -->
    <div class="ad-banner-container" style="margin-top: 20px; padding: 0 20px;">
        <div class="ad-banner-grid" style="display: grid; grid-template-columns: repeat(10, 1fr); gap: 8px; max-width: 1200px; margin: 0 auto;">
            <?php
            // 简单的广告位展示，避免内存问题
            $ad_count = 0;
            try {
                // 检查表是否存在
                $table_check = $DB->query("SHOW TABLES LIKE 'zzdh_ads'");
                if($table_check && $DB->fetch($table_check)) {
                    $ad_results = $DB->query("SELECT name, url, img FROM zzdh_ads WHERE status = 1 ORDER BY sort_order ASC, id ASC LIMIT 10");
                    if($ad_results) {
                        while($ad_row = $DB->fetch($ad_results)) {
                            $ad_count++;
                            $ad_url = $ad_row['url'];
                            $ad_name = $ad_row['name'];
                            $ad_img = $ad_row['img'];
                            
                            if (empty($ad_img)) {
                                preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $ad_url, $url_parts);
                                $domain = isset($url_parts[2]) ? $url_parts[2] : '';
                                $ad_img = $conf['ico_api'] . $domain;
                            }
            ?>
            <div class="ad-banner-item" style="background: linear-gradient(135deg, #ffb6ec 0%, #aee2ff 100%); border-radius: 8px; padding: 8px; text-align: center; box-shadow: 0 2px 8px rgba(255,182,236,0.3); transition: all 0.3s ease; cursor: pointer;" 
                 onclick="window.open('<?php echo htmlspecialchars($ad_url); ?>', '_blank')" 
                 title="<?php echo htmlspecialchars($ad_name); ?>">
                <div class="ad-icon" style="margin-bottom: 4px;">
                    <img src="<?php echo htmlspecialchars($ad_img); ?>" 
                         alt="<?php echo htmlspecialchars($ad_name); ?>" 
                         style="width: 24px; height: 24px; border-radius: 4px; object-fit: cover;"
                         onerror="this.src='assets/images/default_ico.png';">
                </div>
                <div class="ad-name" style="font-size: 10px; color: #fff; font-weight: bold; text-shadow: 0 1px 2px rgba(0,0,0,0.3); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <?php echo htmlspecialchars($ad_name); ?>
                </div>
            </div>
            <?php 
                        }
                    }
                }
            } catch (Exception $e) {
                // 静默处理错误
            }
            ?>
            
            <!-- 如果广告位不足10个，用空白占位 -->
            <?php for($i = $ad_count; $i < 10; $i++) { ?>
            <div class="ad-banner-item" style="background: rgba(255,255,255,0.1); border-radius: 8px; padding: 8px; text-align: center; border: 2px dashed rgba(255,182,236,0.3);">
                <div class="ad-icon" style="margin-bottom: 4px;">
                    <div style="width: 24px; height: 24px; border-radius: 4px; background: rgba(255,255,255,0.2); margin: 0 auto;"></div>
                </div>
                <div class="ad-name" style="font-size: 10px; color: rgba(255,255,255,0.5);">
                    广告位<?php echo $i + 1; ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <style>
    .ad-banner-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(255,182,236,0.5);
    }
    
    @media (max-width: 768px) {
        .ad-banner-grid {
            grid-template-columns: repeat(5, 1fr) !important;
            gap: 4px !important;
        }
        .ad-banner-item {
            padding: 6px !important;
        }
        .ad-name {
            font-size: 8px !important;
        }
    }
    </style>
</div>
<div class="container">
    <ul class="sort q-sort">
        <li class="q-sort-item q-top-item">
            <a href="#置顶站点" class="move">
                <span class="q-icon crown">
                    <svg width="22" height="22" viewBox="0 0 22 22"><circle cx="11" cy="11" r="10" fill="#ffe066"/><path d="M3 15L7 7L11 13L15 7L19 15Z" fill="#ffd700" stroke="#ffb300" stroke-width="1.5"/></svg>
                </span>
                <span class="q-title">置顶推荐</span>
            </a>
        </li>
        <li class="q-sort-item"><a href="#资源博客" class="move"><span class="q-icon"><i class="fa fa-slideshare fa-fw"></i></span><span class="q-title">资源博客</span></a></li>
        <li class="q-sort-item"><a href="#影视大全" class="move"><span class="q-icon"><i class="fa fa-youtube-play fa-fw"></i></span><span class="q-title">影视大全</span></a></li>
        <li class="q-sort-item"><a href="#实用工具" class="move"><span class="q-icon"><i class="fa fa-graduation-cap fa-fw"></i></span><span class="q-title">实用工具</span></a></li>
        <li class="q-sort-item"><a href="#各类导航" class="move"><span class="q-icon"><i class="fa fa-cloud fa-fw"></i></span><span class="q-title">各类导航</span></a></li>
        <li class="q-sort-item"><a href="#论坛门户" class="move"><span class="q-icon"><i class="fa fa-file-text fa-fw"></i></span><span class="q-title">论坛门户</span></a></li>
        <li class="q-sort-item"><a href="#域名防红" class="move"><span class="q-icon"><i class="fa fa-bandcamp fa-fw"></i></span><span class="q-title">域名防红</span></a></li>
        <li class="q-sort-item"><a href="#主机空间" class="move"><span class="q-icon"><i class="fa fa-heartbeat fa-fw"></i></span><span class="q-title">主机空间</span></a></li>
        <li class="q-sort-item"><a href="#行业机构" class="move"><span class="q-icon"><i class="fa fa-ravelry fa-fw"></i></span><span class="q-title">行业机构</span></a></li>
        <li class="q-sort-item"><a href="#其他站点" class="move"><span class="q-icon"><i class="fa fa-paper-plane fa-fw"></i></span><span class="q-title">其他站点</span></a></li>
    </ul>
    <div class="main">
        <div class="card board">
            <span class="icon"><i class="fa fa-bullhorn fa-fw"></i></span>
            <marquee scrollamount="4" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()"><span class="board-notice"><?php echo notice();?></span></marquee>        </div>