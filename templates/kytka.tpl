<h1><a href="index.html" class="hlavicka">{$title}</a></h1>
<a href="img/{$kytka.img}.html"><img src="img/{$kytka.img}{$smarty.const.IMGEXT}" style="width:100%;max-width:{$kytka.imgwidth}px;" class="obr"></a>
<p>{$kytka.popis}</p>
<ul class="kytkainfo">
{if isset($kytka.kvet)}
<li><span>Doba květu: {$kytka.kvet}</span></li>
{/if}
{if isset($kytka.trida)}
<li><a href="{$kytka.tridaid}.html">Třída: {$kytka.trida}</a></li>
{/if}
{if isset($kytka.celed)}
<li><a href="{$kytka.celedid}.html">Čeleď: {$kytka.celed}</a></li>
{/if}
{if isset($kytka.lat)}
<li><a href="lat.html#{$kytka.id}">Latinský název: {$kytka.lat}</a></li>
{/if}
</ul>
