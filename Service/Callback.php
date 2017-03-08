<?php
namespace Apps\CM_CashPayment\Service;

use Phpfox;
use Phpfox_Error;
use Phpfox_Plugin;

/**
 * Class Callback
 *
 * @package Apps\PHPfox_Groups\Service
 */
class Callback extends \Phpfox_Service
{

    public function getProfileLink()
    {
        if(!CM_CASH_PAYMENT_ACTIVE) {
            return false;
        }
        return 'profile.cashpayment';
    }

    public function getProfileMenu($aUser)
    {
        if(!CM_CASH_PAYMENT_ACTIVE) {
            return false;
        }

        if (!($aUser['user_id'] == Phpfox::getUserId())) {
            return false;
        }


        $aMenus[] = [
            'phrase' => _p('Cash Payments'),
            'url' => 'profile.cashpayment',
            'total' => null,
            'icon' => 'feed/blog.png'
        ];

        return $aMenus;
    }

    public function onDeleteUser($iUser)
    {
       $this->database()->delete(Phpfox::getT($this->_sTable), 'seller_id = ' . (int) $iUser);
    }

    /**
     * If a call is made to an unknown method attempt to connect
     * it to a specific plug-in with the same name thus allowing
     * plug-in developers the ability to extend classes.
     *
     * @param string $sMethod is the name of the method
     * @param array $aArguments is the array of arguments of being passed
     */
    public function __call($sMethod, $aArguments)
    {
        /**
         * Check if such a plug-in exists and if it does call it.
         */
        if ($sPlugin = Phpfox_Plugin::get('cashpayment.service_callback__call')) {
            eval($sPlugin);
            return;
        }

        /**
         * No method or plug-in found we must throw a error.
         */
        Phpfox_Error::trigger('Call to undefined method ' . __CLASS__ . '::' . $sMethod . '()', E_USER_ERROR);
    }
}