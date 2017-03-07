<?php

namespace Apps\CM_CashPayment\Controller;


use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

class Buy extends \Phpfox_Component
{
    public function process()
    {
        $aValidation =  [
            'seller_id' => _p('Seller Id is required'),
            'buyer_id' => _p('Buyer Id is required'),
            'item_name' => _p('Item name is required'),
            'item_number' => _p('Item number is required'),
            'currency_code' => _p('Currency code is required'),
            'return' => _p('Return url is required'),
            'amount' => _p('Amount is required'),
        ];

        $aVals  =  [
            'seller_id' => $this->request()->getInt('seller_id'),
            'buyer_id' => $this->request()->getInt('buyer_id'),
            'item_name' => $this->request()->get('item_name'),
            'item_number' => $this->request()->get('item_number'),
            'currency_code' => $this->request()->get('currency_code'),
            'return' => $this->request()->get('return'),
            'amount' => $this->request()->get('amount'),
        ];
        /**
         * @var $oValidator \Phpfox_Validator
         */
        $oValidator  = \Phpfox_Validator::instance()->set([
            'sFormName' => 'js_cash_payment',
            'aParams' => $aValidation,
        ]);

        if ($_POST) {
            if ($oValidator->isValid($aVals)) {
                $iId = Phpfox::getService('cashpayment.proccess')->add($aVals);
                $this->url()->send('cashpayment.info', ['id' => $iId]);
            } else {
                $this->url()->send($this->request()->getServer('HTTP_REFERER'), [], _p('Failed'));
            }
        } else {

            if (!($aPayment = Phpfox::getService('cashpayment')->get($this->request()->getInt('id')))) {
                return Phpfox_Error::display(_p('Payment is not found'));
            }

            $this->template()
                ->setTitle(_p('Transaction information'))
                ->setBreadCrumb(_p('Transaction information'))
                ->assign('aPayment', $aPayment);
        }

        return null;
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