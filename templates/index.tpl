<a href="about.html" class="hlavicka"><h1>{$title}</h1></a>

<h3>Vyhledávání</h3>
<ul>
<li><input type="text" name="q" id="q"></li>
</ul>

<ul id="vysledky">
</ul>

<h3>Třída</h3>
<ul>
{foreach from=$tridy key=tridaid item=trida}
<li><a href="{$tridaid}.html">{$trida.nazev}</a></li>
{/foreach}
</ul>

<h3>Čeled</h3>
<ul>
{foreach from=$celedi key=celedid item=celed}
<li><a href="{$celedid}.html">{$celed.nazev}</a></li>
{/foreach}
</ul>

<script src="lunr.js"></script>
<script src="kytky.js"></script>
<script src="vyhledavani.js"></script>
