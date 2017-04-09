<?php
SESSION_START();
if($_SESSION['admin']=="yes"){
	if (!empty($_GET["mem"]))
	{
		$new_st = "";
		$mem_num = $_GET["mem"];
		rename("../images/members/$mem_num.jpg","images/members/$mem_num-DEL.jpg");
		$myfile = fopen("../images/members/member_names.txt", "r") or die("Unable to open file!");
		if(filesize("../images/members/member_names.txt")>0){
			$name_string = fread($myfile,filesize("../images/members/member_names.txt"));
		}else
		{
			$name_string="";
		}
		fclose($myfile);
		$member_name_arr = explode("/,", $name_string);
		for($i=0;$i<count($member_name_arr);$i++)
		{
			$member_name_arr_exp[$i] = explode(" - ", $member_name_arr[$i]);
		}
		for($j=0;$j<count($member_name_arr_exp)-1;$j++)
		{
			if($member_name_arr_exp[$j][0] !== $mem_num)
			{
				$new_st .= $member_name_arr_exp[$j][0] . " - " . $member_name_arr_exp[$j][1] . " - " . $member_name_arr_exp[$j][2] . "/,";
			}
		}
		$file = "../images/members/member_names.txt";
		file_put_contents($file,$new_st);
		header('Location: admin.php');
	}
}else
 {
	header('Location: ../index.php#members');
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Texas A &amp; M-Kingsville ACM</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" / >
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/js.js"></script>
<script type="text/javascript" src="../js/jquery.stellar.min.js"></script>
<script type="text/javascript" src="../js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
</head>

<body>
<!-- Facebook plugin javascript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!--Search Bar-->
 <div id="search_bar" >
 <br />
 <span style="color:#3d4a96;padding-right:0px">Search&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
 <div id="search_bar_hidden">
 <form method="post" action="../search_results.php" style="height:14px">
 <input size="22.5"style="height:23px;padding-top:2px;" name="search" placeholder="Look up a member here" type="text"/>
 <input style="cursor:pointer;height:19px;width:19px;font-size:small;margin-bottom:1px;background-image:url('images/mag.png')" type="submit" value=""/>
 </form>
 </div>
 <br />
 </div>  

<!--Main Body-->
 <div class="main_body" id="main-body">

 
<!--Join Now Slide-->
 <div class="slide" id="slide5" data-slide="5" data-stellar-background-ratio="0.0"> 
 <div class="screen"></div>

 <br />
 <h4 style="color:white;">Admin: Remove a Member</h4>
 <br />
 <?php
	$myfile = fopen("../images/members/member_names.txt", "r") or die("Unable to open file!");
	if(filesize("../images/members/member_names.txt")>0){
		$name_string = fread($myfile,filesize("../images/members/member_names.txt"));
	}else
	{
		$name_string="";
	}
	fclose($myfile);
	$member_name_arr = explode("/,", $name_string);
	for($i=0;$i<count($member_name_arr);$i++)
	{
		$member_name_arr_exp[$i] = explode(" - ", $member_name_arr[$i]);
	}
	$directory = '../images/members/';
	$n = count($member_name_arr_exp);
	//var_dump($member_name_arr_exp);die();
		for($j=0;$j<$n;$j++)
		{
			if($j==$n-1){
				$newest_num = $member_name_arr_exp[$j-1][0];
				
			}
		}
	
	for($i=0;$i<$newest_num;$i++)
	{	$f=$i+1;
		for($j=0;$j<count($member_name_arr);$j++)
		{
			if(($f) == $member_name_arr_exp[$j][0]&&file_exists("../images/members/$f.jpg"))
			{
				$member_num = $member_name_arr_exp[$j][0];
				$member_name = $member_name_arr_exp[$j][1];
				print "<a class='mem_link' href='remove_member.php?mem=$member_num' style='position:inherit;' onClick='return confirm(\"Are you sure you wish to delete this member?\")' >
				<div style='background-image:url(../images/members/$f.jpg)' class='r_member'><div class='x_pic' ><img src='../images/x_pic.png' \></div><p class='names' >$member_name</p></div></a>";
				
			}
		}
				
	}
	
	?>
<br />
 </div> 
 <p class="copyright" >&copy; 2016 | Texas A &amp; M University-Kingsville Association for Computing Machinery</p>
<!--Button Overlays-->
 </div>
 <!--Beginning of Side Bar-->
 <div id="side-bar">
<!--Home-->
 <a href="../index.php" class="buttonsy" data-slide="" title="">   
 <span><img src="../images/house.png" alt=""/></span><span class="spain" style="text-align:inherit;" >Home</span>
 </a>
<!--About-->
 <a href="../index.php#about" class="buttonsy" data-slide="2" title="">
 <span><img src="../images/About.png" alt=""/></span><span class="spain" style="text-align:inherit;" >About</span>
 </a>
<!--Members-->
 <a href="../index.php#members" class="buttonsy" data-slide="3" title="">
 <span><img src="../images/Members.png" alt=""/></span><span class="spain" style="text-align:inherit;" >Members</span>
 </a>
<!--Projects-->
 <a href="../index.php#projects" class="buttonsy" data-slide="4" title=""> 
 <span><img src="../images/Projects.png" alt=""/></span><span class="spain" style="text-align:inherit;" >Projects</span>
 </a> 
<!--Join Now-->
  <a href="../index.php#join_us" class="buttonsy" data-slide="5" title=""> 
  <span><img src="../images/JoinNow.png" alt=""/></span><span class="spain" style="text-align:inherit;" >Join&nbsp;&nbsp;</span>
  </a> 
<!--Follow Us-->
  <a class="buttons" title=""><span id="FU"data-slide="6" title="">
  <b>Follow Us</b></span></a>
  <!--Calendar-->
  <a id="spain" onMouseOver="calendar_open()"  target="_blank" class="buttonsy" > 
  <span><img src="../images/c_link.png" alt=""/></span><span class="spain" >Events
  </span>
  </a>
<div id="twitterFeed" style="width:100%;">
  <a href="https://twitter.com/ACM_TAMUK" class="buttons" style="height:101%" data-slide="8" title=""> 
  <span><img src="images/Twitter.png" alt=""/></span><span style="text-align:inherit;" class="spain" >Twitter</span>
  </a> <div class="twitter-timeline">
  <a class="twitter-timeline" data-width="265" data-height="400"  href="https://twitter.com/ACM_TAMUK">Tweets by ACM_TAMUK</a> 
 
  <script async src="//platform.twitter.com/widgets.js" charset="utf-8" ></script>
  </div>
  </div>
<!--Facebook-->
<div id="facebookFeed" style="width:100%;">
  <a href="https://www.facebook.com/acmtamuk" target="_blank" style="height:101%" class="buttons" data-slide="9" title="">
  <span><img src="images/facebook.png" alt=""/></span><span class="spain" style="text-align:inherit;" >Facebook</span>
  </a>
  <div class="fb-page" data-href="https://www.facebook.com/acmtamuk" data-tabs="timeline" data-width="270px" data-height="400" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
  <blockquote cite="https://www.facebook.com/acmtamuk" class="fb-xfbml-parse-ignore">
  <a href="https://www.facebook.com/acmtamuk">TAMUK-ACM</a></blockquote>
  </div></div>
 <!--Empty Space-->
  <div class="buttons" data-slide="10" title=""> 
  &nbsp;
  </div>
  </div>

 </div>
<div class="side_bar_overlay" >
<a style="cursor:pointer;" class="buttony"  id="small_icon_1" onclick="small_tab(1)" title=""><img class="imgButton" src="../images/house.png" alt=""/>
<div onclick='re_direct("https://acm-tamuk.com/index.php")' class="popouts" id="small_tab_1" >
Home
</div>
</a>
<a style="cursor:pointer;" class="buttony"  id="small_icon_2" onclick="small_tab(2)" title=""><img class="imgButton" src="../images/About.png"  alt=""/>
<div onclick='re_direct("https://acm-tamuk.com/index.php#about")' class="popouts" id="small_tab_2" >
About Us
</div></a>
<a style="cursor:pointer;" class="buttony"  id="small_icon_3" onclick="small_tab(3)" title=""><img class="imgButton" src="../images/Members.png" alt=""/>
<div onclick='re_direct("https://acm-tamuk.com/index.php#members")' class="popouts" id="small_tab_3" >
Members
</div></a>
<a style="cursor:pointer;" class="buttony" id="small_icon_4" onclick="small_tab(4)" title=""><img class="imgButton" src="../images/Projects.png" alt=""/>
<div onclick='re_direct("https://acm-tamuk.com/index.php#projects")' class="popouts" id="small_tab_4" >
Projects
</div></a>
<a style="cursor:pointer;" class="buttony" id="small_icon_5" onclick="small_tab(5)" title=""><img  class="imgButton" src="../images/JoinNow.png" alt=""/>
<div onclick='re_direct("https://acm-tamuk.com/index.php#join_us")' class="popouts" id="small_tab_5" >
Join Now
</div>
</a>
<img id="FUsmall" src="../images/FU.png" alt=""/>
<a id="spain" onmouseover="calendar_open()" target="_blank" class="buttonsy" data-slide="9" title=""><img class="imgButton" src="../images/c_link.png" alt=""/></a>
<div id="twitterFeed" style="width:100%;">
  <a href="#" class="buttony" data-slide="7" title="" style="height:100%;" ><img class="imgButton" src="../images/Twitter.png" alt=""/></a> 
 
  </a> <div class="twitter-timeline">
  <a class="twitter-timeline" data-width="265" data-height="400"  href="https://twitter.com/ACM_TAMUK">Tweets by ACM_TAMUK</a> 
 
  <script async src="//platform.twitter.com/widgets.js" charset="utf-8" ></script>
  </div>
  </div>


<div id="facebookFeed" style="height:10%">
<a href="#" style="height:100%" class="buttony" data-slide="8" title="" ><img class="imgButton" src="../images/facebook.png" alt=""/></a>
<div class="fb-page" data-href="https://www.facebook.com/acmtamuk" data-tabs="timeline" data-width="270px" data-height="400" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">

  <blockquote cite="https://www.facebook.com/acmtamuk" class="fb-xfbml-parse-ignore">
  <a href="https://www.facebook.com/acmtamuk">TAMUK-ACM</a></blockquote>
  </div>
  </div>
<div class="buttony" data-slide="9" title=""><img class="imgButton" src="../images/Blank.png" alt=""/></div>
</div>
 <div id="calendar_click_off" class="calendar_click_off"  ></div>
<div class="events_pop" id="events_pop" >
<?php include_once("../test.php"); calendar("https://tamuk.collegiatelink.net/organization/acm/events"); ?>
</div>
<script type="text/javascript" >
a = document.getElementById("spain");
b = document.getElementById("FU");
a.style.textDecoration = "none";
a.style.textAlign = "inherit";
b.style.textAlign = "-webkit-center";
b.style.textDecoration = "none";
</script>
 </body>
 </html>
