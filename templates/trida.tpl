<a href="index.html" class="hlavicka"><h1>{$title}</h1></a>

<ul>
{foreach from=$trida.clenove item=kytka}
<li><a href="{$kytka}.html">{$kytky[$kytka].jmeno}</a></li>
{/foreach}
</ul>
