<?php
namespace Apps\CM_CashPayment\Ajax;

use Phpfox;
use Phpfox_Ajax;

class Ajax extends Phpfox_Ajax
{
    public function buy()
    {
        Phpfox::isUser(true);
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
            'seller_id' => (int)$this->get('seller_id'),
            'buyer_id' => (int)$this->get('buyer_id'),
            'item_name' => $this->get('item_name'),
            'item_number' => $this->get('item_number'),
            'currency_code' => $this->get('currency_code'),
            'return' => $this->get('return'),
            'amount' => $this->get('amount'),
        ];
        /**
         * @var $oValidator \Phpfox_Validator
         */
        $oValidator  = \Phpfox_Validator::instance()->set([
            'sFormName' => 'js_cash_payment',
            'aParams' => $aValidation,
        ]);

        if ($oValidator->isValid($aVals)) {
            $iId = Phpfox::getService('cashpayment.proccess')->add($aVals);
            Phpfox::getBlock('cashpayment.info', ['id' => $iId]);
            $this->html('form[action$="/cashpayment/buy/"]', $this->getContent());
            $this->call('$(\'form[action$="/cashpayment/buy/"]\').siblings().remove();');
        } else {
            $this->error(true);
        }

    }
}