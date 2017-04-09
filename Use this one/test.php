<?php
function calendar($url){
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$content = curl_exec($ch);
	curl_close($ch);
	$b = strpos($content,"<link rel=\"icon\" href=\"/Assets/clink/images/favicon.ico\" type=\"image/x-icon\">");
	//var_dump($b);
	$content = substr($content,$b+76);
	$c = strpos($content,"<no");
	$d = strpos($content,"function removeElementByID(id)");
	$content1 = substr($content,0,$c-2);
	$content = $content1 . substr($content,$d-12);
	$content = substr($content,1);
	$content = str_replace("<div class=\"button-bar clearfix\">
        
        <a target=\"_blank\" href=\"https://tamuk.collegiatelink.net/organization/acm/calendar\" class=\"btn\"><span class=\"icon-calendar\" aria-hidden=\"true\"></span>View Event Calendar</a>
		<div class=\"buttons\">
            
		</div>
	</div>
","",$content);
	$content = str_replace("https://cdn2.campuslabs.com/assets/core/v5.0/css/jqueryui/campuslabs.core.jquery.ui.v5.0.000.css","",$content);
	$content = str_replace("https://cdn2.campuslabs.com/assets/kendoui/v5.0/css/campuslabs.kendoui.v5.0.000.css","",$content);
	$content = str_replace("https://cdn2.campuslabs.com/assets/core.bootstrap3/v5.0/scss/core/core.v5.0.000.css","",$content);
	$content = str_replace("https://cdn1.campuslabs.com/assets/core.bootstrap3/v5.0/scss/core/core.v5.0.000.css","",$content);
	$content = str_replace("withoutdatecol\"","withoutdatecol\" style=\"list-style:none;padding:10px;\"",$content);
	$content = str_replace("<div>","<div style=\"background-color:#fff\">",$content);
	//$content = str_replace("<span class=\"icon-calendar\"","<span class=\"\"",$content);
	$content = str_replace("container-upcomingevents\">","container-upcomingevents\" style=\"margin:33px;background-color:#fff;\"><hr>",$content);
	$content = str_replace("</ul>","</ul><hr>",$content);
	$content = str_replace("body-container-spacing\"","body-container-spacing\" style=\"background-color:#fff;padding:5px;\"",$content);
	$content = str_replace("btn btn-link underline","underline",$content);
	$content = str_replace("Events RSS","",$content);
	$content = str_replace("iCal","",$content);
	$content = str_replace("btn btn-default","btn",$content);
	$content = str_replace(">Events"," style=\"background-color:#fff;\" >Events",$content);
	$content = str_replace("<h4>","<h4 style=\"color:black;background-color:white;\" >",$content);
	$content = str_replace("href=\"/organization","target=\"_blank\" href=\"https://tamuk.collegiatelink.net/organization",$content);
	$content = str_replace("tabContainerOpenBottom\"","tabContainerOpenBottom\" style=\"border-top:none;\" ",$content);
	$content = str_replace("<div class='gridTable-footer clearfix pager'>","<div style='background-color:#fff;' class='gridTable-footer clearfix pager'>",$content);
	$content1 = substr($content,0,strpos($content,"<div class='pagination'>"));
	$content = substr($content,strpos($content,"last</a>")+21);
	$content1 .= '<a target="_blank" style="color:#000;" href="https://tamuk.collegiatelink.net/organization/acm/calendar" class="btn">View Event Calendar</a>';
	$content = $content1 . $content;

	
	$content = str_replace("<footer class=\"container-fluid section-footer\" role=\"contentinfo\">
		<div class=\"row\">
			<div class=\"col-xs-12 col-sm-5 col-sm-push-7 footer-signin\">
				
                    <a href=\"/account/logon\" class=\"btn btn-primary btn-lg\">Sign In</a>
                
                    <a href=\"/privacy\" class=\"footer-privacy\">Privacy Policy</a> 
                
			</div>
			<div class=\"col-xs-12 col-sm-7 col-sm-pull-5 footer-copyright\">
				<p><strong>Powered by <a target=\"_blank\" href=\"http://www.collegiatelink.net/\">CollegiateLink</a>.</strong> CollegiateLink is part of <a target=\"_blank\" href=\"http://www.campuslabs.com\">Campus Labs</a>. &copy; Copyright 2017 Campus Labs.</p>
			</div>
		</div>
    </footer>","",$content);
	$content = str_replace("Past</a>
			</li>
		</ul><hr>","Past</a>
			</li>
		</ul>",$content);
	$content = str_replace("<div class=\"pageTabs clearfix\">
		<ul class=\"nav\">
			<li  class=\"activeTab\" >
				<a id=\"current\" href='/organization/acm/events?onlyCurrent=True'>Upcoming</a>
			</li>
			<li >
				<a id=\"pending\" href='/organization/acm/events?onlyCurrent=False'>Past</a>
			</li>
		</ul>
	</div>
",'',$content);
	echo $content;
}
?>

