var kytky = [
{foreach from=$kytky item=kytka name=kytky}
{literal}{{/literal}
  'id': '{$kytka.id}',
  'jmeno': '{$kytka.jmeno}',
   {if isset($kytka.trida)}'trida': '{$kytka.trida}',
  'tridaid': '{$kytka.tridaid}',{/if}
  'celedid': '{$kytka.celedid}',
  'celed': '{$kytka.celed}',
  'popis': '{$kytka.popis}'
{literal}}{/literal}
{if !$smarty.foreach.kytky.last}
,
{/if}
{/foreach}
]
