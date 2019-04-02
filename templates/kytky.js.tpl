var kytky = {
{foreach from=$kytky item=kytka name=kytky}
{$kytka.id|replace:'-':'_'}:{literal}{{/literal}c:'{$kytka.jmeno}',l:'{$kytka.lat}'{literal}}{/literal}{if !$smarty.foreach.kytky.last},{/if}

{/foreach}
}
