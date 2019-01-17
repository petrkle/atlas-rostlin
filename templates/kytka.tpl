<script src="jquery.js"></script>
<script src="ts.js"></script>
<a href="index.html" class="hlavicka"><h1>{$title}</h1></a>
<a href="img/{$kytka.img}"><img src="img/{$kytka.img}" style="width:100%;max-width:{$kytka.imgwidth}px;" class="obr"></a>
<p>{$kytka.popis}</p>
<ul>
{if isset($kytka.kvet)}
<li><span>Doba květu: {$kytka.kvet}</span></li>
{/if}
{if isset($kytka.trida)}
<li><a href="{$kytka.tridaid}.html">Třída: {$kytka.trida}</a></li>
{/if}
{if isset($kytka.celed)}
<li><a href="{$kytka.celedid}.html">Čeleď: {$kytka.celed}</a></li>
{/if}
{if isset($kytka.lat)}
<li><a href="lat.html#{$kytka.id}">Latinský název: {$kytka.lat}</a></li>
{/if}
</ul>

<script>
{literal}
$(document).ready(function () {
			$(".obr").swipe( {
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
{/literal}
					window.location = "{$next.id}.html";
{literal}
        },
        threshold: 100
      });
{/literal}
{literal}
			$(".obr").swipe( {
        swipeRight:function(event, direction, distance, duration, fingerCount) {
{/literal}
					window.location = "{$prev.id}.html";
{literal}
        },
        threshold: 100
      });
{/literal}

});
</script>
