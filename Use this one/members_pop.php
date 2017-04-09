<?php
	$myfile = fopen("images/members/member_names.txt", "r") or die("Unable to open file!");
	$name_string = fread($myfile,filesize("images/members/member_names.txt"));
	fclose($myfile);
	$member_name_arr = explode("/,", $name_string);
	$num = $_GET['mem'];
	for($i=0;$i<count($member_name_arr);$i++)
	{
		$member_name_arr_exp[$i] = explode(" - ", $member_name_arr[$i]);
		if($member_name_arr_exp[$i][0]==$num)
		{
			$member_name=$member_name_arr_exp[$i][1];
			$member_text1=substr($member_name_arr_exp[$i][2],0,18);
			$member_text2=substr($member_name_arr_exp[$i][2],18);
			
			
		}
	}
	
	
 ?>
 <br />
 <h4 style="color:white;"><?php echo $member_name ?></h4>
 <br />
 <input type="button" id="close_x" class="close_x" value="X" style="visibility:visible;" onClick="closer()" />
  <a id="members_img_link_1" style="cursor:pointer" onclick="members_img_open(1)" ><img id="members_img_1" class="member2" style="height:160px;width:auto;z-index:9999999999999999999999999999;" src='<?php if(isset($_GET['mem'])){echo "images/members/" . $num;}else{echo "images/faculty/" . $num;} ?>.jpg' alt='<?php echo $member_name ?>' title='Click to Enlarge'></a>
 <p style="position:relative;text-align:left;text-indent:15px;" >
 <?php
	print $member_text1 . "<p style='position:relative;' >"; 
	print $member_text2 . "</p>";
 ?>
 </p>

 <br />
 