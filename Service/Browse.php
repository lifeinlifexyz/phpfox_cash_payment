<?php

namespace Apps\CM_CashPayment\Service;

use Phpfox;

class Browse extends \Phpfox_Service
{
    protected $_sTable = 'cashpayment_payments';

    public function getQueryJoins($bIsCount = false, $bNoQueryFriend = false)
    {
    }

    public function query()
    {
    }

}