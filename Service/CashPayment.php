<?php

namespace Apps\CM_CashPayment\Service;

use Phpfox;

class CashPayment extends \Phpfox_Service
{
    protected $_sTable = 'cashpayment_payments';

    public function get($iId)
    {
       return $this->database()
           ->select('*')
           ->from(Phpfox::getT($this->_sTable))
           ->where('payment_id = ' . (int) $iId)
           ->get();
    }

    public function isActive()
    {

        $aData = cache()->get('cashpayment_data');

        if (empty($aData)) {
            $aData = $this->database()->select('*')->from(Phpfox::getT('api_gateway'))->where('gateway_id = \'cashpayment\'')->get();
            cache()->set('cashpayment_data', $aData);
        }

        return $aData['is_active'];
    }

}