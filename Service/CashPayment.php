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

}