<?php
	ini_set("display_errors", 0);
	require ('./inc/lang.php');
	require ('./module.php');
	require('./header.php'); // 只保留这一句
?>
<!-- 页面主体内容开始 -->
<div class="container">
    <ul class="sort">
        <li><a href="./"><span>返回首页</span> <i class="fa fa-reply fa-fw"></i></a></li>
<?php
	mysql_query("set names utf8");
	$result = mysql_query("SELECT * FROM zzdh_sort order by sid asc");
	while($row = mysql_fetch_array($result))
    {
?>
<li><a href="sort<?php echo $row['id'];?>.html" class="<?php if($row_list['sortname']==$row['sortname']){echo "active";}else{echo "";};?>"><span><?php echo $row['sortname'];?></span> <i class="fa <?php echo $row['icon'];?> fa-fw"></i></a></li>
<?php  }?>
                </ul>
	<div class="card board">
		<span class="icon"><i class="fa fa-map-signs fa-fw"></i></span>
		<a href="./">导航首页</a>&nbsp;»&nbsp;<span>关于本站</span>	</div>
	<div class="card">
		<div class="card-head"><i class="fa fa-info-circle fa-fw"></i>本站简介</div>
		<div class="card-body">
			<div class="content">
				<p>本站名称：<?php echo $conf['name'];?></p>
				<p>本站标题：<?php echo $conf['title'];?></p>
				<p>本站关键词：<?php echo $conf['keywords'];?></p>
				<p>本站描述：<?php echo $conf['description']?></p>
				<p>本站域名：<?php echo $_SERVER['HTTP_HOST'];?></p>
				<!-- 其他内容可继续补充 -->
			</div>
		</div>
	</div>
</div>
<!-- 页面主体内容结束 -->