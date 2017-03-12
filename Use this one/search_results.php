<?php
	
	if(isset($_POST["search"])){
		$mem_num="";
		$mem_search_results = "";
		$search_array = explode(" ",addslashes($_POST["search"]));
		// retrieving member names to check against
		$myfile = fopen("images/members/member_names.txt", "r") or die("Unable to open file!");
		if(filesize("images/members/member_names.txt")>0){
			$name_string = fread($myfile,filesize("images/members/member_names.txt"));
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
		$n = count($member_name_arr_exp)-1;
		for($j=0;$j<$n;$j++)
		{
			$newest_num[$j] = explode(" ",$member_name_arr_exp[$j][1]);
			$pattern = ltrim($newest_num[$j][0]," ");// member fist name
			$pattern2 = ltrim($newest_num[$j][1]," ");// member last name
			// This is where we go word by word.
			for($m=0;$m<count($search_array);$m++){
				$subject=$search_array[$m];
				// First: we check members for a match
				if (strcasecmp($pattern, $subject) == 0 || strpos($pattern,$subject)==true) {
					$mem_num = $member_name_arr_exp[$j][0];
					$mem_name = $member_name_arr_exp[$j][1];
							$mem_text = substr($member_name_arr_exp[$j][2],18,100) . "...";
							if(strpos($mem_search_results,$mem_name)==false){
								$mem_search_results  .= "&bull;<a class='search_links' href='members.php?mem=" . $mem_num . "' >" . $mem_name . ": " . $mem_text . "</a></br></br>";
							}
					if(isset($search_array[$m+1])){
						$subject2=$search_array[$m+1];
						if (strcasecmp($pattern2, $subject2) == 0 || strpos($pattern2,$subject2)==true) {
							$mem_num = $member_name_arr_exp[$j][0];
							header("Location: members.php?mem=" . $mem_num);
						}else{
							$mem_num = $member_name_arr_exp[$j][0];
							$mem_name = $member_name_arr_exp[$j][1];
							$mem_text = substr($member_name_arr_exp[$j][2],18,100) . "...";
							if(strpos($mem_search_results,$mem_name)==false){
								$mem_search_results  .= "&bull;<a class='search_links' href='members.php?mem=" . $mem_num . "' >" . $mem_name . ": " . $mem_text . "</a></br></br>";
							}
						}
					}
					
				}else{
					if(strcasecmp($pattern2, $subject) == 0 || strpos($pattern2,$subject)==true) 
					{
						$mem_num = $member_name_arr_exp[$j][0];
						$mem_name = $member_name_arr_exp[$j][1];
						$mem_text = substr($member_name_arr_exp[$j][2],18,100) . "...";	
						if(strpos($mem_search_results,$mem_name)==false){
								$mem_search_results  .= "&bull;<a class='search_links' href='members.php?mem=" . $mem_num . "' >" . $mem_name . ": " . $mem_text . "</a></br></br>";
							}
					}
				}				
				// endo of searching by member
				//Start Search of individual page text.
				$directory = '/';
				$filtes = array();
				if (glob('*.php') != false)
				{
					foreach (glob('*.php') as $file) {
					  //search each page with the ".php" extension.  THIS IS WHY ALL ADMIN PAGES MUST BE IN THE ADMIN FOLDER
					  // WE DO NOT WANT THEM SEARCHED.
					  
					}
				}else
				{
					$filecount=0;
				}
				
				
			}
				
				
			
		}
	}
	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Texas A &amp; M-Kingsville ACM</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" / >
<link rel="stylesheet" type="text/css" href="css/cssreset-min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/main_body.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/jquery.stellar.min.js"></script>
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
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


 <div id="search_bar" >
 <br />
 <span style="color:#3d4a96;padding-right:0px">Search&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
 <div id="search_bar_hidden">
 <form method="post" action="search_results.php" style="height:14px">
 <input size="22.5"style="height:16px;padding-top:2px;" name="search" type="text"/>
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
 <h4 style="color:white;">Search Results</h4>
 <br />
 <div class="results" target="_blank" >
<?php
	if(isset($mem_search_results)&&$mem_search_results!==""){
		print "<h3 style='color:#fff' ><u>Members</u></h3></br>";
		print $mem_search_results;
	}else{
		print "<div class='search_null' >There were no results found.</div>";
	}
?>
 </div>
 <br />
 </div> 
<!--Button Overlays-->
 </div>
 <!--Beginning of Side Bar-->
 <div id="side-bar">
<!--Home-->
 <a href="index.php" class="buttonsy" data-slide="" title="">   
 <span><img src="images/house.png" alt=""/></span><span>Home</span>
 </a>
<!--About-->
 <a href="index.php#about" class="buttonsy" data-slide="2" title="">
 <span><img src="images/About.png" alt=""/></span><span>About</span>
 </a>
<!--Members-->
 <a href="index.php#members" class="buttonsy" data-slide="3" title="">
 <span><img src="images/Members.png" alt=""/></span><span>Members</span>
 </a>
<!--Projects-->
 <a href="index.php#projects" class="buttonsy" data-slide="4" title=""> 
 <span><img src="images/Projects.png" alt=""/></span><span>Projects</span>
 </a> 
<!--Join Now-->
  <a href="index.php#join_us" class="buttonsy" data-slide="5" title=""> 
  <span><img src="images/JoinNow.png" alt=""/></span><span>Join Now</span>
  </a> 
<!--Follow Us-->
  <a class="buttons" title=""><span id="FU"data-slide="6" title="">
  <b>Follow Us</b></span></a>
  <!--Youtube-->
  <a href="#" class="buttons" data-slide="10" title=""> 
  <span><img src="images/Youtube.png" alt=""/></span><span>Youtube</span>
  </a>
<!--Twitter-->
<div id="twitterFeed" style="width:100%;">
  <a href="https://twitter.com/ACM_TAMUK" class="buttons" style="height:100%" data-slide="8" title=""> 
  <span><img src="images/Twitter.png" alt=""/></span><span>Twitter</span>
  </a> <div class="twitter-timeline">
  <a class="twitter-timeline" data-width="265" data-height="400"  href="https://twitter.com/ACM_TAMUK">Tweets by ACM_TAMUK</a> 
 
  <script async src="//platform.twitter.com/widgets.js" charset="utf-8" ></script>
  </div>
  </div>
<!--Facebook-->
<div id="facebookFeed" style="width:100%;">
  <a href="https://www.facebook.com/acmtamuk" target="_blank" style="height:100%" class="buttons" data-slide="9" title="">
  <span><img src="images/facebook.png" alt=""/></span><span>Facebook</span>
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
<a href="#" class="buttony" data-slide="1" title=""><img class="imgButton" src="images/house.png" alt=""/>
<div class="popout1" >
Home
</div>
</a>
<a href="#" class="buttony" data-slide="2" title=""><img class="imgButton" src="images/About.png"  alt=""/>
<div class="popout2" >
About Us
</div></a>
<a href="#" class="buttony" data-slide="3" title=""><img class="imgButton" src="images/Members.png" alt=""/>
<div class="popout3" >
Members
</div></a>
<a href="#" class="buttony" data-slide="4" title=""><img class="imgButton" src="images/Projects.png" alt=""/>
<div class="popout4" >
Projects
</div></a>
<a href="#" class="buttony" data-slide="5" title=""><img  class="imgButton" src="images/JoinNow.png" alt=""/>
<div class="popout5" >
Join Now
</div>
</a>
<img id="FUsmall" src="images/FU.png" alt=""/>
<a href="#" class="buttony" data-slide="9" title=""><img class="imgButton" src="images/Youtube.png" alt=""/></a>
<div id="twitterFeed" style="width:100%;">
  <a href="#" class="buttony" data-slide="7" title="" style="height:100%;" ><img class="imgButton" src="images/Twitter.png" alt=""/></a> 
 
  </a> <div class="twitter-timeline">
  <a class="twitter-timeline" data-width="265" data-height="400"  href="https://twitter.com/ACM_TAMUK">Tweets by ACM_TAMUK</a> 
 
  <script async src="//platform.twitter.com/widgets.js" charset="utf-8" ></script>
  </div>
  </div>


<div id="facebookFeed" style="height:10%">
<a href="#" style="height:100%" class="buttony" data-slide="8" title="" ><img class="imgButton" src="images/facebook.png" alt=""/></a>
<div class="fb-page" data-href="https://www.facebook.com/acmtamuk" data-tabs="timeline" data-width="270px" data-height="400" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">

  <blockquote cite="https://www.facebook.com/acmtamuk" class="fb-xfbml-parse-ignore">
  <a href="https://www.facebook.com/acmtamuk">TAMUK-ACM</a></blockquote>
  </div>
  </div>
<div class="buttony" data-slide="9" title=""><img class="imgButton" src="images/Blank.png" alt=""/></div>
</div>
<p class="copyright" >&copy; 2016 | Texas A &amp; M University-Kingsville Association for Computing Machinery</p>
 
 </body>
 </html>
