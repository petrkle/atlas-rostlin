<h1><a href="tridy.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$trida.clenove item=kytka}
<li><a href="{$kytka.id}.html">{$kytka.jmeno}</a></li>
{/foreach}
</ul>
