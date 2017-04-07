<?php

namespace Apps\CM_CashPayment\Controller;


use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

class Decline extends \Phpfox_Component
{
    public function process()
    {
        Phpfox::isUser(true);

        $iId = $this->request()->getInt('id');

        if (!($aPayment = Phpfox::getService('cashpayment')->get($iId))) {
            return Phpfox_Error::display(_p('Payment is not found'));
        }

        if ($aPayment['seller_id'] != Phpfox::getUserId() && !Phpfox::isAdmin()) {
            return Phpfox_Error::display(_p('You do not have permission to access'));
        }

        Phpfox::getService('cashpayment.proccess')->setStatus($aPayment['payment_id'], 'declined');
        $aPayment['status'] = 'declined';
        $this->request()->send(Phpfox::getLib('gateway')->url('cashpayment'), $aPayment);

        if ($this->request()->get('req3') == 'profile') {
            $this->url()->send('profile.cashpayment' , [], _p('Payment Declined'));
        } else {
            $this->url()->send('admincp.app' , ['id' => 'CM_CashPayment'], _p('Payment Declined'));
        }
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