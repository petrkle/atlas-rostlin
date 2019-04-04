<h1><a href="index.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$tridy item=trida key=id}
<li><a href="{$id}.html">{$trida.nazev}</a></li>
{/foreach}
</ul>
