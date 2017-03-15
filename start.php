<?php

\Phpfox_Module::instance()
    ->addServiceNames([
        'cashpayment.proccess' => '\Apps\CM_CashPayment\Service\Process',
        'cashpayment' => '\Apps\CM_CashPayment\Service\CashPayment',
        'cashpayment.browse' => '\Apps\CM_CashPayment\Service\Browse',
        'cashpayment.callback' => '\Apps\CM_CashPayment\Service\Callback',
    ])
    ->addComponentNames('controller', [
        'cashpayment.admincp.settings' => 'Apps\CM_CashPayment\Controller\Admin\Settings',
        'cashpayment.admincp.payments' => 'Apps\CM_CashPayment\Controller\Admin\Payments',
        'cashpayment.buy' => 'Apps\CM_CashPayment\Controller\Buy',
        'cashpayment.endorse' => 'Apps\CM_CashPayment\Controller\Endorse',
        'cashpayment.decline' => 'Apps\CM_CashPayment\Controller\Decline',
        'cashpayment.profile' => 'Apps\CM_CashPayment\Controller\Profile',
    ])
    ->addAliasNames('cashpayment', 'CM_CashPayment')
    ->addTemplateDirs([
        'cashpayment' => PHPFOX_DIR_SITE_APPS . 'CM_CashPayment' . PHPFOX_DS . 'views',
    ]);

group('/admincp/cashpayment/', function(){
    route('settings', 'cashpayment.admincp.settings');
    route('payments', 'cashpayment.admincp.payments');
});

defined('CM_CASH_PAYMENT_ACTIVE') or define('CM_CASH_PAYMENT_ACTIVE', Phpfox::getService('cashpayment')->isActive());

group('/cashpayment/', function(){
    route('setting/save', 'cashpayment.admincp.settings');
    route('endorse', 'cashpayment.endorse');
    route('decline', 'cashpayment.decline');

    if (CM_CASH_PAYMENT_ACTIVE) {
        route('buy', 'cashpayment.buy');
        route('info', 'cashpayment.buy');
        route('endorse/profile', 'cashpayment.endorse');
        route('decline/profile', 'cashpayment.decline');
        route('profile', 'cashpayment.profile');
    }

});
