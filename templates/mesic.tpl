<h1><a href="rok.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$mesic.clenove item=kytka}
<li><a href="{$kytka.id}.html">{$kytka.jmeno}</a></li>
{/foreach}
</ul>
