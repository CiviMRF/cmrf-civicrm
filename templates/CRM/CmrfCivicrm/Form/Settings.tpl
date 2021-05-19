{* HEADER *}
<div class="crm-section">
  <div class="label">{$form.cmrf_default_connection.label}</div>
  <div class="content">{$form.cmrf_default_connection.html}</div>
  <div class="clear"></div>
</div>
<h2>{ts}Production{/ts}</h2>
<div class="crm-section">
  <div class="label">{$form.cmrf_prod_rest_url.label}</div>
  <div class="content">{$form.cmrf_prod_rest_url.html}</div>
  <div class="clear"></div>
</div>
<div class="crm-section">
  <div class="label">{$form.cmrf_prod_api_key.label}</div>
  <div class="content">{$form.cmrf_prod_api_key.html}</div>
  <div class="clear"></div>
</div>
<div class="crm-section">
  <div class="label">{$form.cmrf_prod_sys_key.label}</div>
  <div class="content">{$form.cmrf_prod_sys_key.html}</div>
  <div class="clear"></div>
</div>
<h2>{ts}Test{/ts}</h2>
<div class="crm-section">
  <div class="label">{$form.cmrf_test_rest_url.label}</div>
  <div class="content">{$form.cmrf_test_rest_url.html}</div>
  <div class="clear"></div>
</div>
<div class="crm-section">
  <div class="label">{$form.cmrf_test_api_key.label}</div>
  <div class="content">{$form.cmrf_test_api_key.html}</div>
  <div class="clear"></div>
</div>
<div class="crm-section">
  <div class="label">{$form.cmrf_test_sys_key.label}</div>
  <div class="content">{$form.cmrf_test_sys_key.html}</div>
  <div class="clear"></div>
</div>



{* FOOTER *}
<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
  <a href={crmURL p='civicrm/cmrf/apicalls'} class="button"><span><i class="crm-i fa-list" aria-hidden="true"></i>&nbsp; {ts}CMRF Calls{/ts}</span></a>
</div>


<pre>
  $call = $core->createCall('default', 'Contact', 'get', ['id' => 1]);
</pre>

{if $call_status eq 'DONE'}
  <pre>{$call_status} : {$display_name}</pre>
{else}
<pre>{$call_status} : {$error_message}</pre>
{/if}




