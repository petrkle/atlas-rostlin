<?php

require('config.php');
require('func.php');

foreach(PISMENA as $pismeno){
	$url = ROZHLAS."/rostliny/rejstrik?letter=$pismeno";
	print "$url\n";
	savefile($url, TMP."/$pismeno.htm");
	foreach(get_detail_links(TMP."/$pismeno.htm") as $rostlina){
		print "$rostlina\n";
		savefile(ROZHLAS.$rostlina, TMP.'/'.basename($rostlina).'.html');
		$img = get_img_url(TMP.'/'.basename($rostlina).'.html');
		print "$img\n";
		savefile($img, TMP.'/'.basename($img));
	}
}
