<?php
include "phpqrcode.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>二维码在线生成工具</title>
	<link rel="stylesheet" href="images/base.css">
	<link rel="stylesheet" href="images/QRcode.css">
	<style type="text/css">
	body,td,th {
	font-family: "宋体", tahoma, arial;
}
body {
	background-image: url(bg.jpg);
}
    </style>
</head>

<body >
	<div class="container">
		<div class="clearfix mb20">
			<h1 class="fl">二维码在线生成工具</h1>
		    
	  </div>
		
		<div class="QRcode clearfix">
		
			<div class="QRcode-editor fl pr">
				<ul class="QRcode-class clearfix">
					<li class="active" name="text">输入内容</li>
					
				</ul>
							<div class="QRcode-classContent">
					<div class="urlORText">
						<p class="explain">网址/文本生成二维码</p>
						<p class="pr">
							
							<form id="iform" name="iform" method="post" action=""><textarea name="content" id="content"><?php 
							error_reporting(E_ALL ^ E_NOTICE);
							echo $_POST['content']; ?></textarea>
						</p>
						<div class="none" id="bookmarkShell">
							
							</p>
						</div>
					</div>
					
				</div>
					<div class="quick">
									<input name="go" type="submit" id="go" onclick="" value="输入内容后，点击这里就可以生成QR" />
									<input name="done" type="hidden" value="done" />  

</form></div>

			</div>
			<div class="QRcode-show fr">
				<p class="tc"></p>
				<div class="pr zoom">
					<p class="tc" id="QRcode-showBox">
					<?php					
					error_reporting(E_ALL ^ E_NOTICE);  //屏蔽报错
					$errorCorrectionLevel = 'H';//容错级别   
					$matrixPointSize = 10;//生成图片大小   
					if ($_POST['done']){    //获得点击事件
					   if($_POST['content']){  //获得内容
						$c = $_POST['content'];

						$len = strlen($c);
						   if ($len <= 360){
						    $file = fopen("t.txt","r+");
						    flock($file,LOCK_EX);
						      if($file) {
						       $get_file = fgetss($file);
						       $t = $get_file+1;
						       $file2 = fopen("t.txt","w+");
						       fwrite($file2,$t);	
						       }
						    flock($file,LOCK_UN);
						    fclose($file);
						    fclose($file2);
						
						   QRcode::png($c, 'png/'.$t.'.png', $errorCorrectionLevel, $matrixPointSize, 2);	//初始二维码保存到本地
						   $sc = urlencode($c);
						   //加logo

						   $a=rand(1,3);  //1-3的随机整数
						   switch ($a) {
						   	case 1:
						   		# code...
						   	   	$logo = 'MichaelJackson.png';
						   		break;
						   	case 2:
						   		# code...
						   	   	$logo = 'logo2.jpg';
						   		break;
						   	case 3:
						   		# code...
						   	   	$logo = 'logo3.JPG';
						   		break;
						   	default:
						   		# code...
						   		$logo = 'logo3.JPG';
						   		break;
						   }
						    
						   $QR = "png/".$t.".png";   //调用保存的二维码，嵌入logo
						   if($logo !== FALSE) 
							{
							$QR = imagecreatefromstring(file_get_contents($QR)); 
							$logo = imagecreatefromstring(file_get_contents($logo)); 
							$QR_width = imagesx($QR); 
							$QR_height = imagesy($QR); 
							$logo_width = imagesx($logo); 
							$logo_height = imagesy($logo); 
							$logo_qr_width = $QR_width / 5;   //logo的大小
							$scale = $logo_width / $logo_qr_width; 
							$logo_qr_height = $logo_height / $scale; 
							$from_width = ($QR_width - $logo_qr_width) / 2;   //控制logo的位置居中
							imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);    //生成嵌入logo的二维码
							} 
							imagepng($QR,'png/'.'QR.png');  //保存本地
							$logo = 'png/'.'QR.png';
						   //加外圈

						    $a=rand(1,3);
						   switch ($a) {
						   	case 1:
						   		# code...
						   	   $QR = "bg2.jpg";;
						   		break;
						   	case 2:
						   		# code...
						   	   	$QR = "bg3.jpg";
						   		break;
						   	case 3:
						   		# code...
						   	   	$QR = "bg4.jpg";
						   		break;
						   	default:
						   		# code...
						   	$QR = "bg4.jpg";
						   		break;
						   }
						   if($logo !== FALSE) 
							{
							$QR = imagecreatefromstring(file_get_contents($QR)); 
							$logo = imagecreatefromstring(file_get_contents($logo));   //此时logo是之前生成的图片
							$QR_width = imagesx($QR); 
							$QR_height = imagesy($QR); 
							$logo_width = imagesx($logo); 
							$logo_height = imagesy($logo); 
							$logo_qr_width = $QR_width / 1.2; 
							$scale = $logo_width / $logo_qr_width; 
							$logo_qr_height = $logo_height / $scale; 
							$from_width = ($QR_width - $logo_qr_width) / 2; 
							imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height); 
							} 
							imagepng($QR,'png/'.'QR.png');
						   echo '<img src="png/'.'QR.png" /><br />'.$c;  //输出最终图片
						   }
						   else {
						     echo '亲！信息量过大。';
						   }	
					    }
					    else {
					     echo '亲！你没有输入内容。';
					    }
					}	
					else {
					  echo '二维码将会出现在这里。';
					}
						?></p>
					
				</div>
			</div>
		</div>

		<div class="qrIntro f14 mt10">
			<p class="t2">二维码生成工具</p>
			<p class="mt5 t2">作者：孙晨昊</p>
			<p class="mt5 t2">2016/5/15</p>
		</div>
		<div id="footer" class="tc mt20">
		<p>Copyright @ 2016 二维码在线生成工具. All Rights Reserved. </p>
		</div>
	</div>
</body></html>
