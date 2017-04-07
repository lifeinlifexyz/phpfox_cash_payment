<?php

namespace Apps\CM_CashPayment\Controller;


use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

class Profile extends \Phpfox_Component
{

    public function process()
    {
        Phpfox::isUser(true);

        $aSearchFields = array(
            'type' => 'cashpayment',
            'field' => 'cp.payment_id',
            'search_tool' => [
                'table_alias' => 'cp',
                'search' => [
                    'action' => $this->url()->makeUrl('profile.cashpayment'),
                    'default_value' => _p('Search payments'),
                    'name' => 'search',
                    'field' => ['`cp`.`item_name`', '`cp`.`item_number`', '`cp`.`payment_id`', '`cp`.`status`', '`cp`.`amount`']
                ],
                'sort' => [
                    'latest' => ['cp.payment_id', _p('Latest')],
                ],
                'show' => [12, 15, 18, 21]
            ]
        );

        $this->search()->set($aSearchFields);

        $aBrowseParams = [
            'module_id' => 'cashpayment',
            'alias' => 'cp',
            'field' => 'payment_id',
            'table' => Phpfox::getT('cashpayment_payments'),
            'hide_view' => []
        ];

        $this->search()->setCondition(' AND `cp`.`seller_id` = ' . Phpfox::getUserId());

        $this->search()->setContinueSearch(true);
        $this->search()->browse()->params($aBrowseParams)->execute();

        $this->template()
            ->setTitle(_p('Payments'))
            ->setBreadCrumb(_p('Payments'))
            ->assign([
            'aPayments' => $this->search()->browse()->getRows()
        ]);


    }

    /**
     * Garbage collector. Is executed after this class has completed
     * its job and the template has also been displayed.
     */
    public function clean()
    {
        (($sPlugin = Phpfox_Plugin::get('api.component_controller_admincp_cashpayment_payments_clean')) ? eval($sPlugin) : false);
    }
}