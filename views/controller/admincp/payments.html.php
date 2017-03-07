<?php 
defined('PHPFOX') or exit('NO DICE!');
?>
<div id="payments-page">
    <div class="table_header">
        {template file='cashpayment.controller.admincp.filter'}
        <h1>{_p('Payments')}</h1>
    </div>

    {if count($aPayments)}
    {if !PHPFOX_IS_AJAX}
    <table>
        <thead>
        <tr>
            <th>{_p('ID')}</th>
            <th>{_p('Updated')}</th>
            <th>{_p('Item name')}</th>
            <th>{_p('Item number')}</th>
            <th>{_p('Amount')}</th>
            <th>{_p('User')}</th>
            <th>{_p('Status')}</th>
            <th>{_p('Action')}</th>
        </tr>
        </thead>
        <tbody>
        {/if}
        {foreach from=$aPayments item=aItem}
        <tr>
            <td>{$aItem.payment_id}</td>
            <td>{$aItem.time_stamp|convert_time}</td>
            <td>{$aItem.item_name}</td>
            <td>{$aItem.item_number}</td>
            <td>{$aItem.currency_code|currency_symbol}{$aItem.amount|number_format:2}</td>
            <td>{$aItem|user:'':'':30}</td>
            <td>{$aItem.status}</td>
            <td>
                {if $aItem.status != 'completed'}
                <a href="{url link='cashpayment.endorse' id=$aItem.payment_id}" class="btn btn-small btn-success" title="{_p('Endorse')}">
                    <i class="fa fa-check"></i>
                </a>
                {/if}
            </td>
        </tr>
        {/foreach}
        {if !PHPFOX_IS_AJAX}
        </tbody>
    </table>
    {/if}
    {pager}
    {else}
    <hr>
    <p class="table">{_p('No payments found')}</p>
    {/if}
    {literal}
    <script type="text/javascript">
        $Behavior.cm_cp_filter = function() {

            $('#cm-filter-admin-block a.ajax_link, #cm-filter-admin-block a.is_default').off('click').on('click', function(e) {
                e.preventDefault();
                $Core.processing();
                $.ajax({
                    url: $(this).attr('href'),
                    contentType: 'application/json',
                    success: function(e) {
                        $('#payments-page').replaceWith(e.content).show();
                        $('.ajax_processing').remove();
                        $Core.loadInit();
                    }
                });
                return false;
            });

            $('#cm-filter-admin-block form').submit(function(e){
                e.preventDefault();
                var form = this;
                $Core.processing();
                $.ajax({
                    url: $(form).attr('action'),
                    data: $(form).serialize(), // serializes the form's elements.
                    contentType: 'application/json',
                    success: function(data)
                    {
                        $('#payments-page').replaceWith(data.content).show();
                        $('.ajax_processing').remove();
                        $Core.loadInit();
                    }
                });
                return false;
            });
        }
    </script>
    {/literal}
</div>
