<?php

\Phpfox_Module::instance()
    ->addServiceNames([
        'cashpayment.proccess' => '\Apps\CM_CashPayment\Service\Process',
        'cashpayment' => '\Apps\CM_CashPayment\Service\CashPayment',
        'cashpayment.browse' => '\Apps\CM_CashPayment\Service\Browse',
    ])
    ->addComponentNames('controller', [
        'cashpayment.admincp.settings' => 'Apps\CM_CashPayment\Controller\Admin\Settings',
        'cashpayment.admincp.payments' => 'Apps\CM_CashPayment\Controller\Admin\Payments',
        'cashpayment.buy' => 'Apps\CM_CashPayment\Controller\Buy',
    ])
    ->addAliasNames('cashpayment', 'CM_CashPayment')
    ->addTemplateDirs([
        'cashpayment' => PHPFOX_DIR_SITE_APPS . 'CM_CashPayment' . PHPFOX_DS . 'views',
    ]);

group('/admincp/cashpayment/', function(){
    route('settings', 'cashpayment.admincp.settings');
    route('payments', 'cashpayment.admincp.payments');
});

group('/cashpayment/', function(){
    route('setting/save', 'cashpayment.admincp.settings');
    route('buy', 'cashpayment.buy');
    route('info', 'cashpayment.buy');
});
