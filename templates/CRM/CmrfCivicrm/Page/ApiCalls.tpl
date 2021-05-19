<h3>API Calls</h3>

{include file="CRM/common/pager.tpl" location="top"}
<table class="selector row-highlight">
  <thead class="sticky">
    <tr>
      <th>cid</th>
      <th>{ts}Status{/ts}</th>
      <th>connector_id</th>
    </tr>
  </thead>
  {foreach from=$rows item=row}
    <tr  class="{cycle values="odd-row,even-row"}">
      <td>{$row.cid}</td>
      <td>{$row.status}</td>
      <td>{$row.connector_id}</td>
    </tr>
  {/foreach}
</table>
{include file="CRM/common/pager.tpl" location="bottom"}
