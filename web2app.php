<?php

require('config.php');
require('func.php');

if(!is_dir(WWW)){
	mkdir(WWW, 0755, true);
}

if(!is_dir(WWWIMG)){
	mkdir(WWWIMG);
}

$VERSION = `TERM=xterm-color gradle -q printVersionName 2>/dev/null`;

$kytky = array();
$tridy = array();
$celedi = array();
$lat = array();

foreach(glob(TMP.'/*.html') as $file){
	$foo = get_kytka_info($file);
	$kytky[$foo['id']] = $foo;

	if(isset($foo['celed'])){
		$id = asciize($foo['celed']);
		if(!isset($celedi[$id])){
			$celedi[$id] = array(
				'nazev' => $foo['celed'],
				'clenove' => array($foo),
			);
		}else{
			array_push($celedi[$id]['clenove'], $foo);
		}
	}

	if(isset($foo['trida'])){
		$id = asciize($foo['trida']);
		if(!isset($tridy[$id])){
			$tridy[$id] = array(
				'nazev' => $foo['trida'],
				'clenove' => array($foo),
			);
		}else{
			array_push($tridy[$id]['clenove'], $foo);
		}
	}

	$smarty->assign('title', $foo['jmeno']);
	$smarty->assign('kytka', $foo);
	$html = $smarty->fetch('hlavicka.tpl');
	$html .= $smarty->fetch('kytka.tpl');
	$html .= $smarty->fetch('paticka.tpl');
	file_put_contents(WWW.'/'.$foo['id'].'.html', $html);

	if(!is_file(WWWIMG.'/'.$foo['img'])){
		copy(TMP.'/'.$foo['img'], WWWIMG.'/'.$foo['img']);
	}

}

$smarty->assign('kytky', $kytky);

uasort($celedi, 'sort_by_nazev');

foreach($celedi as $id => $celed){
	uasort($celed['clenove'], 'sort_by_jmeno');
	$smarty->assign('title', $celed['nazev']);
	$smarty->assign('celed', $celed);
	$smarty->assign('celedid', $id);
	$html = $smarty->fetch('hlavicka.tpl');
	$html .= $smarty->fetch('celed.tpl');
	$html .= $smarty->fetch('paticka.tpl');
	file_put_contents(WWW."/$id.html", $html);

}

foreach($tridy as $id => $trida){
	uasort($trida['clenove'], 'sort_by_jmeno');
	$smarty->assign('title', $trida['nazev']);
	$smarty->assign('trida', $trida);
	$smarty->assign('tridaid', $id);
	$html = $smarty->fetch('hlavicka.tpl');
	$html .= $smarty->fetch('trida.tpl');
	$html .= $smarty->fetch('paticka.tpl');
	file_put_contents(WWW."/$id.html", $html);

}

$smarty->assign('title', 'Atlas rostlin');
$smarty->assign('celedi', $celedi);
$smarty->assign('tridy', $tridy);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('index.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/index.html', $html);

$smarty->assign('title', 'Atlas rostlin');
$smarty->assign('VERSION', $VERSION);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('about.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/about.html', $html);

$html = $smarty->fetch('kytky.js.tpl');
file_put_contents(WWW.'/kytky.js', $html);

uasort($kytky, 'sort_by_lat');
$smarty->assign('kytky', $kytky);
$smarty->assign('title', 'Atlas rostlin');
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('lat.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/lat.html', $html);

copy('templates/kytky.css', WWW.'/kytky.css');
copy('templates/vyhledavani.js', WWW.'/vyhledavani.js');
copy('templates/lunr.js', WWW.'/lunr.js');
copy('kytka512.png', WWW.'/kytka512.png');
