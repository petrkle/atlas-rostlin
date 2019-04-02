var kytky = {
{foreach from=$kytky item=kytka name=kytky}
{$kytka.id|replace:'-':'_'}:{literal}{{/literal}c:'{$kytka.jmeno}',l:'{$kytka.lat}'{literal}}{/literal},
{/foreach}
{foreach from=$celedi item=celed name=c key=key}
{$key|replace:'-':'_'}:{literal}{{/literal}c:'{$celed.nazev}'{literal}}{/literal},
{/foreach}
{foreach from=$tridy item=trida name=t key=key}
{$key|replace:'-':'_'}:{literal}{{/literal}c:'{$trida.nazev}'{literal}}{/literal},
{/foreach}
{foreach from=$mesice item=mesic name=m key=key}
{$mesiceascii[$key]}:{literal}{{/literal}c:'{$mesic}'{literal}}{/literal}{if !$smarty.foreach.m.last},{/if}

{/foreach}
}
