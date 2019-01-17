<a href="rok.html" class="hlavicka"><h1>{$title}</h1></a>

<ul>
{foreach from=$mesic.clenove item=kytka}
<li><a href="{$kytka.id}.html">{$kytka.jmeno}</a></li>
{/foreach}
</ul>
