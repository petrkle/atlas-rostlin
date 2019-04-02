<h1><a href="index.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$kytky item=kytka}
<li><a href="{$kytka.id}.html" name="{$kytka.id}">{$kytka.lat}</a></li>
{/foreach}
</ul>
