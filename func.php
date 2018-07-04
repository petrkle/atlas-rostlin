<?php

function get_img_url($filename){
	$img = '';
	$dom = new DOMDocument();
	$dom->loadHTML(file_get_contents($filename));
	$xpath = new DOMXPath($dom);
	$odkazy = $xpath->query("//meta[@name='twitter:image']");
	foreach($odkazy as $odkaz){
		$img = $odkaz->getAttribute("content");
	}
	return $img;
}

function get_detail_links($filename){
	$linky = array();
	$dom = new DOMDocument();
	$dom->loadHTML(file_get_contents($filename));
	$xpath = new DOMXPath($dom);
	$odkazy = $xpath->query("//li[@class='item']/h3/a");
	foreach($odkazy as $odkaz){
		array_push($linky, $odkaz->getAttribute("href"));
	}
	return $linky;
}

function savefile($url, $filename){
	if(!is_file($filename)){
		print "$url\n";
		if(!is_dir(dirname($filename))){
			mkdir(dirname($filename), 0755, true);
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_REFERER, ROZHLAS);
		curl_setopt($ch, CURLOPT_USERAGENT, 'php '.phpversion());
		curl_setopt($ch,CURLOPT_ENCODING, '');
		file_put_contents($filename, curl_exec($ch));
		curl_close($ch);
	}
}

function get_kytka_info($filename){
	$info = array();

	$dom = new DOMDocument();
	$dom->loadHTML(file_get_contents($filename));
	$xpath = new DOMXPath($dom);

	$info['id'] = preg_replace('/--.*/', '', basename($filename, '.html'));

	$img = $xpath->query("//meta[@name='twitter:image']");
	$info['img'] = basename($img[0]->getAttribute("content"));

	$size = getimagesize(TMP.'/'.$info['img']);
	$info['imgwidth'] = $size[0];

	$jmeno = $xpath->query("//div[@id='article']/h1");
	$info['jmeno'] = $jmeno[0]->nodeValue;

	$popis = $xpath->query("//p[@class='perex']/text()[following-sibling::br]");
	$info['popis'] = $popis[0]->nodeValue;

	foreach($popis as $node){
		if(preg_match('/^Doba květu: (.*)$/', trim($node->nodeValue), $m)){
			$info['kvet'] = $m[1];
			$info['kvetid'] = asciize($m[1]);
		}
		if(preg_match('/^Třída: (.*)$/', trim($node->nodeValue), $m)){
			$info['trida'] = $m[1];
			$info['tridaid'] = asciize($m[1]);
		}
		if(preg_match('/^Čeleď: (.*)$/', trim($node->nodeValue), $m)){
			$info['celed'] = $m[1];
			$info['celedid'] = asciize($m[1]);
		}
	}

	$lat = $xpath->query("//p[@class='perex']/em[last()]");
	$info['lat'] = $lat[0]->nodeValue;

	return $info;
}

function asciize($str) {
    $str = strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $str));
    $str = preg_replace('/[^a-z0-9.]/', ' ', $str);
    $str = preg_replace('/\s\s+/', ' ', $str);
    $str = str_replace(' ', '-', trim($str));
    return $str;
}

function sort_by_jmeno($a, $b)
{
	$coll = collator_create( 'cs_CZ.UTF-8' );
	return collator_compare($coll, $a['nazev'], $b['nazev']);
}
