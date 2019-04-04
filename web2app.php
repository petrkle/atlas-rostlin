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
$kvet = array();
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

	if(!is_file(WWWIMG.'/'.$foo['img'])){
		copy(TMP.'/'.$foo['img'], WWWIMG.'/'.$foo['img']);
	}

	if(isset($foo['kvetmesice'])){
		foreach($foo['kvetmesice'] as $mesic){
			if(isset($kvet[$mesic]['clenove'])){
				array_push($kvet[$mesic]['clenove'], $foo);
			}else{
				$kvet[$mesic]['clenove'] = array($foo);
			}
		}
	}
}

uasort($kytky, 'sort_by_jmeno');

$cislo = 0;
$seznamkytek = array();
foreach($kytky as $id => $kytka){
	$seznamkytek[$cislo] = array('id' => $id,
		'kytka' =>$kytka);
	$cislo++;
}

$cislo = 0;

foreach($kytky as $id => $foo){

	if($cislo == 0){
		$smarty->assign('prev', $seznamkytek[count($seznamkytek)-1]);
	}else{
		$smarty->assign('prev', $seznamkytek[$cislo-1]);
	}

	if($cislo == count($seznamkytek)-1){
		$smarty->assign('next', $seznamkytek[0]);
	}else{
		$smarty->assign('next', $seznamkytek[$cislo+1]);
	}

	$smarty->assign('title', $foo['jmeno']);
	$smarty->assign('kytka', $foo);
	$html = $smarty->fetch('hlavicka.tpl');
	$html .= $smarty->fetch('kytka.tpl');
	$html .= $smarty->fetch('paticka.tpl');
	file_put_contents(WWW.'/'.$foo['id'].'.html', $html);

	$cislo++;
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

$smarty->assign('title', 'Čeledi');
$smarty->assign('celedi', $celedi);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('celedi.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/celedi.html', $html);

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

$smarty->assign('title', 'Třídy');
$smarty->assign('tridy', $tridy);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('tridy.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/tridy.html', $html);

$mesicefl = array();
foreach(MESICE as $mesic => $nazev){
	$kvet[$mesic]['nazev'] = prvnivelke($nazev[0]);
	$mesicefl[$mesic] = $kvet[$mesic]['nazev'];
	uasort($kvet[$mesic]['clenove'], 'sort_by_jmeno');
	$smarty->assign('title', $kvet[$mesic]['nazev']);
	$smarty->assign('mesic', $kvet[$mesic]);
	$smarty->assign('mesicid', $mesic);
	$html = $smarty->fetch('hlavicka.tpl');
	$html .= $smarty->fetch('mesic.tpl');
	$html .= $smarty->fetch('paticka.tpl');
	file_put_contents(WWW."/".asciize($nazev[0]).".html", $html);
}

$smarty->assign('title', 'Rok');
$smarty->assign('mesice', $mesicefl);
$smarty->assign('mesicefiles', MESICEASCII);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('rok.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/rok.html', $html);

$smarty->assign('title', APPNAME);
$smarty->assign('celedi', $celedi);
$smarty->assign('tridy', $tridy);
$smarty->assign('kytky', $kytky);
$smarty->assign('mesice', MESICE);
$smarty->assign('mesiceascii', MESICEASCII);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('index.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/index.html', $html);

$smarty->assign('title', APPNAME);
$smarty->assign('VERSION', $VERSION);
$smarty->assign('pocet', count($kytky));
$smarty->assign('mesice', $mesicefl);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('about.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/about.html', $html);

$html = $smarty->fetch('kytky.js.tpl');
file_put_contents(WWW.'/kytky.js', $html);

uasort($kytky, 'sort_by_lat');
$smarty->assign('kytky', $kytky);
$smarty->assign('title', APPNAME);
$html = $smarty->fetch('hlavicka.tpl');
$html .= $smarty->fetch('lat.tpl');
$html .= $smarty->fetch('paticka.tpl');
file_put_contents(WWW.'/lat.html', $html);

copy('templates/kytky.css', WWW.'/kytky.css');
copy('templates/vyhledavani.js', WWW.'/vyhledavani.js');
copy('templates/zalozky.js', WWW.'/zalozky.js');
copy('templates/roboto-regular.ttf', WWW.'/roboto-regular.ttf');
copy('templates/s.svg', WWW.'/s.svg');
copy('kytka512.png', WWW.'/kytka512.png');
copy('templates/star.svg', WWW.'/star.svg');
copy('templates/star-bw.svg', WWW.'/star-bw.svg');
