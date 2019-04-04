<h1><a href="celedi.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$celed.clenove item=kytka}
<li><a href="{$kytka.id}.html">{$kytka.jmeno}</a></li>
{/foreach}
</ul>
