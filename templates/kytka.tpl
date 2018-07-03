<a href="index.html" class="hlavicka"><h1>{$title}</h1></a>
<p>{$kytka.popis}</p>
<a href="img/{$kytka.img}"><img src="img/{$kytka.img}" style="width:100%;max-width:{$kytka.imgwidth}px;"></a>
<ul>
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
<li><span>Latinský název: {$kytka.lat}</span></li>
{/if}
</ul>
