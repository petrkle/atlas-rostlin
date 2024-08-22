<?php

require('config.php');
require('func.php');

foreach(PISMENA as $pismeno) {
    $url = ROZHLAS."/rostliny/rejstrik?letter=".urlencode($pismeno);
    savefile($url, TMP."/$pismeno.htm");
    foreach(get_detail_links(TMP."/$pismeno.htm") as $rostlina) {
        savefile(ROZHLAS.$rostlina, TMP.'/'.basename($rostlina).'.html');
        $img = get_img_url(TMP.'/'.basename($rostlina).'.html');
        savefile($img, TMP.'/'.basename($img));
    }
}
