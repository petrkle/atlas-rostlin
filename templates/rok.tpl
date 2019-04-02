<h1><a href="index.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$mesice item=mesic key=cislo}
<li><a href="{$mesicefiles[$cislo]}.html">{$mesic}</a></li>
{/foreach}
</ul>
