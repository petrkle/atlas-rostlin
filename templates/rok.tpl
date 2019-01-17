<a href="index.html" class="hlavicka"><h1>{$title}</h1></a>

<ul>
{foreach from=$mesice item=mesic key=cislo}
<li><a href="{$cislo}.html">{$mesic}</a></li>
{/foreach}
</ul>
