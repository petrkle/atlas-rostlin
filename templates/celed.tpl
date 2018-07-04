<a href="index.html" class="hlavicka"><h1>{$title}</h1></a>

<ul>
{foreach from=$celed.clenove item=kytka}
<li><a href="{$kytka.id}.html">{$kytka.jmeno}</a></li>
{/foreach}
</ul>
