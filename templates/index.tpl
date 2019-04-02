<h1><a href="about.html" class="hlavicka">{$title}</a></h1>

<ul>
{foreach from=$kytky key=filename item=kytka}
<li><a href="{$filename}.html">{$kytka.jmeno}</a></li>
{/foreach}
</ul>
