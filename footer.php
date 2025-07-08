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
</ul>

<footer class="footer">



	<p>Copyright © 2018 - 2021	<a href="../"><?php echo $conf['name'];?></a>. All Rights Reserved.</p>
	<p></a>
	</p>
	<p><?php echo $conf['info'];?></p>
</footer>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/layer/layer.js"></script>
<script src="templates/antidote/js/main.js"></script>
<div style="display:none;">
</div>﻿
</body>
</html>

<!-- 二次元页脚装饰：Q版吉祥物、泡泡、像素小人 -->
<div style="position:absolute;left:12px;bottom:12px;z-index:2;">
  <svg width="56" height="56" viewBox="0 0 56 56"><ellipse cx="28" cy="28" rx="28" ry="28" fill="#aee2ff" fill-opacity="0.18"/><ellipse cx="28" cy="36" rx="18" ry="12" fill="#fff"/><ellipse cx="28" cy="20" rx="12" ry="12" fill="#ffb6ec"/><ellipse cx="24" cy="18" rx="2" ry="3" fill="#fff"/><ellipse cx="32" cy="18" rx="2" ry="3" fill="#fff"/><ellipse cx="28" cy="26" rx="5" ry="3" fill="#fff"/><ellipse cx="28" cy="29" rx="3" ry="2" fill="#ffb6ec"/><ellipse cx="28" cy="28" rx="11" ry="11" fill="none" stroke="#aee2ff" stroke-width="1.5"/></svg>
  <div style="font-size:0.9em;color:#ff8ae2;text-align:center;">Q萌吉祥物</div>
</div>
<div style="position:absolute;right:24px;bottom:18px;z-index:2;">
  <div class="bubble" style="width:24px;height:24px;animation-delay:2s;"></div>
  <div class="bubble" style="width:18px;height:18px;animation-delay:3.5s;"></div>
</div>