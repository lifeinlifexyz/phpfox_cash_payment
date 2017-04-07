<?php

namespace Apps\CM_CashPayment\Block;


use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

class Info extends \Phpfox_Component
{
    public function process()
    {
        Phpfox::isUser(true);
        $iId = $this->getParam('id');
        if (!($aPayment = Phpfox::getService('cashpayment')->get($iId))) {
            return Phpfox_Error::display(_p('Payment is not found'));
        }

        $this->template()
            ->setTitle(_p('Transaction information'))
            ->setBreadCrumb(_p('Transaction information'))
            ->assign('aPayment', $aPayment);
    }

    /**
     * Garbage collector. Is executed after this class has completed
     * its job and the template has also been displayed.
     */
    public function clean()
    {
        (($sPlugin = Phpfox_Plugin::get('api.component_controller_admincp_cashpayment_buy_clean')) ? eval($sPlugin) : false);
    }
}