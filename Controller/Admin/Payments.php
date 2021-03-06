<?php

namespace Apps\CM_CashPayment\Controller\Admin;


use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

class Payments extends \Phpfox_Component
{

    public function process()
    {
        Phpfox::isAdmin(true);

        $aSearchFields = array(
            'type' => 'cashpayment',
            'field' => 'cp.payment_id',
            'search_tool' => [
                'table_alias' => 'cp',
                'search' => [
                    'action' => $this->url()->makeUrl('admincp.cashpayment.payments'),
                    'default_value' => _p('Search payments'),
                    'name' => 'search',
                    'field' => ['cp.item_name', 'cp.item_number', 'cp.payment_id', 'cp.status', '`cp`.`amount`']
                ],
                'sort' => [
                    'latest' => ['cp.payment_id', _p('Latest')],
                ],
                'show' => [21, 45, 100, 150, 255, 500]
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

        $this->search()->setContinueSearch(true);
        $this->search()->browse()->params($aBrowseParams)->execute();

        Phpfox::getLib('pager')->set([
            'page' => $this->search()->getPage(),
            'size' => $this->search()->getDisplay(),
            'count' => $this->search()->getCount()
        ]);


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