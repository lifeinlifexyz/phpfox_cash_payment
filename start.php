<?php

\Phpfox_Module::instance()
    ->addServiceNames([
        'cashpayment.settings' => '\Apps\CM_CashPayment\Service\Process',
        'cashpayment' => '\Apps\CM_CashPayment\Service\cashpayment',
    ])
    ->addComponentNames('controller', [
        'cashpayment.admincp.settings' => 'Apps\CM_CashPayment\Controller\Admin\Settings',
    ])
    ->addAliasNames('cashpayment', 'CM_CashPayment')
    ->addTemplateDirs([
        'cashpayment' => PHPFOX_DIR_SITE_APPS . 'CM_CashPayment' . PHPFOX_DS . 'views',
    ]);

//event('app_settings', function ($settings){
//    if (isset($settings['CM_CashPayment_enabled'])) {
//        \Phpfox::getService('admincp.module.process')->updateActivity('CM_CashPayment', $settings['CM_CashPayment_enabled']);
//    }
//});

group('/admincp/cashpayment/', function(){
    route('settings', 'cashpayment.admincp.settings');
});

group('/cashpayment/', function(){
    route('setting/save', 'cashpayment.admincp.settings');
});
