<?php
	require ('./inc/common.php');
	require ('./inc/lang.php');
	$db = mysql_connect("{$dbconfig['host']}", "{$dbconfig['user']}", "{$dbconfig['pwd']}");
	mysql_select_db("{$dbconfig['dbname']}", $db);

	mysql_query("set names utf8");
    $id = $_GET['id'];
    $alias = $_GET['alias'];

	if(empty($alias)){
		$sql = 'select * from zzdh_sort where id = "'.$id.'"';
		$result = mysql_query($sql);
		$row_sort = mysql_fetch_array($result);
		$sql = 'select * from zzdh_list where id = "'.$id.'"';
		$result = mysql_query($sql);
		$row_list = mysql_fetch_array($result);
    }else{
		$sql = 'select * from zzdh_sort where alias = "'.$alias.'"';
		$result = mysql_query($sql);
		$row_sort = mysql_fetch_array($result);
		$sql = 'select * from zzdh_list where alias = "'.$alias.'"';
		$result = mysql_query($sql);
		$row_list = mysql_fetch_array($result);
    }

	$sql = 'select * from zzdh_sort where sortname = "'.$row_list['sortname'].'"';
	$result = mysql_query($sql);
	$rows_sort = mysql_fetch_array($result);
	$sql='SELECT COUNT(*) FROM zzdh_sort';
	$res=mysql_query($sql);
	list($cntsort)=mysql_fetch_row($res);
	$sql='SELECT COUNT(*) FROM zzdh_list';
	$res=mysql_query($sql);
	list($cntlist)=mysql_fetch_row($res);
	$sql='SELECT COUNT(*) FROM zzdh_apply';
	$res=mysql_query($sql);
	list($cntapply)=mysql_fetch_row($res);	
	/* $sql='SELECT COUNT(*) FROM zzdh_notice'; */
	/* $res=mysql_query($sql); */
	/* list($cntnotice)=mysql_fetch_row($res); */
?>
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<!--技术导航:www.jocat.cn 自动秒收录!!!-->
<?php
function top($a,$b){
	mysql_query("set names utf8");
	if(!$b){
	$result = mysql_query('select * from zzdh_list order by '.$a.' desc limit 1');
	while($row = mysql_fetch_array($result)){echo '<a href="'.$row['url'].'" target="_blank">'.mb_strimwidth($row['name'],0,15,'…').'</a>';}
	}else{
	mysql_query("set names utf8");
	$res = mysql_query('select COUNT(*) from zzdh_list WHERE '.$a.' > 1');
	$mun=mysql_result($res,0);
	$result = mysql_query('select * from zzdh_list WHERE '.$a.' > 1');
	while($row = mysql_fetch_array($result)){$s = $s + $row[$a];}
	echo ' '.$mun.' 个站点被点击 '.$s.' 次';}
 }?>

<?php
function nav(){
	mysql_query("set names utf8");
	$result = mysql_query("SELECT * FROM zzdh_nav order by nid asc");
	while($row = mysql_fetch_array($result))
    {
?>
	<li><a href="<?php echo $row['url'];?>"><i class="fa <?php echo $row['icon'];?>" aria-hidden="true"></i> <span><?php echo $row['name'];?></span></a></li>
<?php } }?>

<?php
function websort(){
	mysql_query("set names utf8");
	$result = mysql_query("SELECT * FROM zzdh_sort order by sid asc");
	while($row = mysql_fetch_array($result))
    {
?>
<li><a href="#<?php echo $row['sortname'];?>" class="move"><span><?php echo $row['sortname'];?></span> <i class="fa <?php echo $row['icon'];?> fa-fw"></i></a></li>
<?php } }?>
<?php
function nwebsort(){
	mysql_query("set names utf8");
	$result = mysql_query("SELECT * FROM zzdh_sort order by sid asc");
	while($row = mysql_fetch_array($result))
    {
?>
<li><a href="sort<?php echo $row['id'];?>.html" class="ok"><span><?php echo $row['sortname'];?></span> <i class="fa <?php echo $row['icon'];?> fa-fw"></i></a></li>
<?php } }?>
<?php
function notice($i='1'){
	mysql_query("set names utf8");
	$result = mysql_query("SELECT * FROM zzdh_notice where id = $i limit 1");
	while($row = mysql_fetch_array($result))
    {
?><?php echo $row['content'];?><?php } }?>