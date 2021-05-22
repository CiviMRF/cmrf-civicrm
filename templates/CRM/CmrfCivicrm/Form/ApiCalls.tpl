{* HEADER *}

  <div class="crm-section">
    <div class="label">{$form.status.label}</div>
    <div class="content">{$form.status.html}</div>
    <div class="clear"></div>
  </div>
<div class="crm-section">
  <div class="label">{$form.connector_id.label}</div>
  <div class="content">{$form.connector_id.html}</div>
  <div class="clear"></div>
</div>


<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

<table class="selector row-highlight">
  <thead class="sticky">
  <tr>
    <th>CID</th>
    <th>{ts}Status{/ts}</th>
    <th>Connector</th>
    <th>Request</th>
    <th>Reply</th>
    <th>Create Date</th>
  </tr>
  </thead>

  {foreach from=$rows item=row}
    <tr  class='{cycle values="odd-row,even-row"}'>
      <td>{$row.cid}</td>
      <td>{$row.status}</td>
      <td>{$row.connector_id}</td>
      <td><a class='crm-popup' href='{$row.url}'>{$row.request}</a></td>
      <td>{$row.reply}</td>
      <td>{$row.create_date}</td>
    </tr>
  {/foreach}
</table>


