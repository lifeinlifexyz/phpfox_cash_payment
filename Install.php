<?php
namespace Apps\CM_CashPayment;

use Core\App;
use Phpfox;
use Core\App\Install\Setting;

/**
 * Class Install
 * @author  Neil
 * @version 4.5.0
 * @package Apps\PHPfox_Core
 */
class Install extends App\App
{

    /**
     * @var array
     */
    private $_app_phrases = [];

    /**
     *
     */
    protected function setId()
    {
        $this->id = 'CM_CashPayment';
    }

    /**
     * Set start and end support version of your App.
     * @example   $this->start_support_version = 4.2.0
     * @example   $this->end_support_version = 4.5.0
     * @see       list of our verson at PF.Base/install/include/installer.class.php ($_aVersions)
     * @important You DO NOT ALLOW to set current version of phpFox for start_support_version and end_support_version. We will reject of app if you use current version of phpFox for these variable. These variables help clients know their sites is work with your app or not.
     */
    protected function setSupportVersion()
    {
        $this->start_support_version = Phpfox::getVersion();
        $this->end_support_version = Phpfox::getVersion();
    }


    /**
     *
     */
    protected function setAlias()
    {
        $this->alias = 'cashpayment';
    }

    /**
     *
     */
    protected function setName()
    {
        $this->name = 'Cash Payment';
    }

    /**
     *
     */
    protected function setVersion()
    {
        $this->version = '1.0.4';
    }

    /**
     *
     */
    protected function setSettings()
    {

    }

    /**
     *
     */
    protected function setUserGroupSettings()
    {
    }

    /**
     *
     */
    protected function setComponent()
    {
    }

    /**
     *
     */
    protected function setComponentBlock()
    {
    }

    /**
     *
     */
    protected function setPhrase()
    {
        $this->phrase = $this->_app_phrases;
    }

    /**
     *
     */
    protected function setOthers()
    {
        $this->_publisher = 'CodeMake IT';
        $this->_publisher_url = 'http://codemake.org/';
        $this->_apps_dir = 'CM_CashPayment';
        $this->admincp_route = '/admincp/cashpayment/payments';
        $this->admincp_menu = [
            _p("Settings") => "cashpayment.settings",
            _p("Payments") => "cashpayment.payments",
        ];
    }
}