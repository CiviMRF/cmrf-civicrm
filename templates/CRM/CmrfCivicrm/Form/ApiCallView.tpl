{* HEADER *}

<div class="crm-submit-buttons">
   {include file="CRM/common/formButtons.tpl" location="top"}
</div>
<table>
  <tr>
    <td>CID</td>
    <td>{$cid}</td>
  </tr>
  <tr>
    <td>{ts}Status{/ts}</td>
    <td>{$status}</td>
  </tr>
  <tr>
    <td>{ts}Request{/ts}</td>
    <td><pre>{$request}</pre></td>
  </tr>
  <tr>
    <td>{ts}Reply{/ts}</td>
    <td><pre>{$reply}</pre></td>
  </tr>
</table>
<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
