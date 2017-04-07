<?php

namespace Apps\CM_CashPayment\Controller\Admin;


use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

class Settings extends \Phpfox_Component
{
    public function process()
    {
        if (!($aGateway = Phpfox::getService('api.gateway')->getForEdit('cashpayment')))
        {
            return Phpfox_Error::display(Phpfox::getPhrase('api.unable_to_find_the_payment_gateway'));
        }

        if (($aVals = $this->request()->getArray('val')))
        {
            if (Phpfox::getService('api.gateway.process')->update($aGateway['gateway_id'], $aVals))
            {
                cache()->del('cashpayment_data');
                $this->url()->send('admincp.app',
                    [
                        'id' => 'CM_CashPayment',
                    ], Phpfox::getPhrase('api.gateway_successfully_updated'));
            }
        }

        $this->template()->setTitle(Phpfox::getPhrase('api.payment_gateways'))
            ->assign(array(
                    'aForms' => $aGateway
                )
            );
        return null;
    }

    /**
     * Garbage collector. Is executed after this class has completed
     * its job and the template has also been displayed.
     */
    public function clean()
    {
        (($sPlugin = Phpfox_Plugin::get('api.component_controller_admincp_cashpayment_settings_clean')) ? eval($sPlugin) : false);
    }
}