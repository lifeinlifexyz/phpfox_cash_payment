<?php 
defined('PHPFOX') or exit('NO DICE!');
?>
{if count($aPayments)}
    {if !PHPFOX_IS_AJAX}
        <div class="cm-table-row cm-table-head">
            <div class="cm-table-cell">{_p('ID')}</div>
            <div class="cm-table-cell">{_p('Updated')}</div>
            <div class="cm-table-cell">{_p('Item name')}</div>
            <div class="cm-table-cell">{_p('Item number')}</div>
            <div class="cm-table-cell">{_p('Amount')}</div>
            <div class="cm-table-cell">{_p('User')}</div>
            <div class="cm-table-cell">{_p('Status')}</div>
            <div class="cm-table-cell">{_p('Action')}</div>
        </div>
    {/if}
        {foreach from=$aPayments item=aItem}
        <div class="cm-table-row">
            <div class="cm-table-cell">{$aItem.payment_id}</div>
            <div class="cm-table-cell">{$aItem.time_stamp|convert_time}</div>
            <div class="cm-table-cell">{$aItem.item_name}</div>
            <div class="cm-table-cell">{$aItem.item_number}</div>
            <div class="cm-table-cell">{$aItem.currency_code|currency_symbol}{$aItem.amount|number_format:2}</div>
            <div class="cm-table-cell">{$aItem|user:'':'':30}</div>
            <div class="cm-table-cell">{$aItem.status}</div>
            <div class="cm-table-cell">
                {if $aItem.status != 'completed'}
                <a href="{url link='cashpayment.endorse' id=$aItem.payment_id}" class="btn btn-small btn-success" title="{_p('Endorse')}">
                    <i class="fa fa-check"></i>
                </a>
                {/if}
            </div>
        </div>
        {/foreach}
    {pager}
{else}
    <div class="extra_info">
        {_p('You do not have any payments')}
    </div>
{/if}
