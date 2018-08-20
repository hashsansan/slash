<?php

$fbphoto = "http://localhost/fb_parser/noprofile.gifxx";
$img = addslashes(file_get_contents($fbphoto));

if(strpos($img,"request failed") > 0){
	echo "error url";
}else{
	echo $img;
}

echo $img;

?>