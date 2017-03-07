<?php

namespace Apps\CM_CashPayment\Service;

use Phpfox;

class Process extends \Phpfox_Service
{
    protected $_sTable = 'cashpayment_payments';

    public function setStatus($sStatus, $iId)
    {
        return $this->database()->update(\Phpfox::getT($this->_sTable),
            ['`status`' => $sStatus], '`tr_number` = ' . (int) $iId);
    }

    public function delete($iId)
    {
        $this->database()->delete(\Phpfox::getT($this->_sTable),  '`tr_number` = ' . (int)$iId);
    }

    public function add($aVal)
    {
        $oClean = \Phpfox_Parse_Input::instance();
        return $this->database()
            ->insert(Phpfox::getT($this->_sTable), [
                'seller_id' => (int) $aVal['seller_id'],
                'buyer_id' => (int) $aVal['buyer_id'],
                'item_name' => $oClean->clean($aVal['item_name'], 300),
                'item_number' => $oClean->clean($aVal['item_number'], 300),
                'currency_code' => $oClean->clean($aVal['currency_code'], 3),
                'return_url' => $oClean->clean($aVal['return'], 200),
                'amount' => $oClean->clean($aVal['amount'], 15),
            ]);
    }


}