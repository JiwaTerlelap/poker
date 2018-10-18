<?php 
	session_start(); 
	$width = 70; //Ukuran lebar 
	$height = 30; //Tinggi 
	$im = imagecreate($width, $height); 
	$bg = imagecolorallocate($im, 0, 0, 0); 
	
	
	
	//menambahkan titik2 gambar / noise 
	$bgR = mt_rand(100, 200); 
	$bgG = mt_rand(100, 200); 
	$bgB = mt_rand(100, 200); 
	$noise_color = imagecolorallocate($im, abs(255 - $bgR), abs(255 - $bgG), abs(255 - $bgB)); 
	for($i = 0; $i < ($width*$height) / 3; $i++) {
		imagefilledellipse($im, mt_rand(0,$width), mt_rand(0,$height), 3, rand(2,5), $noise_color); 
	} 
	// proses membuat tulisan 
	$text_color = imagecolorallocate($im, 240, 240, 240); 
	$rand_x = rand(0, $width - 50); 
	$rand_y = rand(0, $height - 15); 
	
	
	
	imagestring($im, 12, $rand_x, $rand_y, $_COOKIE["validasicode"], $text_color);
	// echo $_SESSION['acakacak'].'aaa';exit();
	header ("Content-type: image/png"); //Output format gambar 
	imagepng($im); 
?> 