<a href="index.html" class="hlavicka"><h1>{$title}</h1></a>

<ul>
{foreach from=$kytky item=kytka}
<li><a href="{$kytka.id}.html" name="{$kytka.id}">{$kytka.lat}</a></li>
{/foreach}
</ul>
