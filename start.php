<?php

//\Phpfox_Module::instance()
//    ->addServiceNames([
////        'gradeservice.process' => '\Apps\CM_GradeService\Service\Process',
////        'gradeservice' => '\Apps\CM_GradeService\Service\GradeService',
//    ])
//    ->addComponentNames('controller', [
////        'gradeservice.admincp.add-question' => 'Apps\CM_GradeService\Controller\Admin\AddQuestion',
////        'gradeservice.admincp.questions' => 'Apps\CM_GradeService\Controller\Admin\Questions',
////        'gradeservice.admincp.statistics' => 'Apps\CM_GradeService\Controller\Admin\Statistics',
//    ])
//    ->addComponentNames('block', [
////        'gradeservice.statistics' =>  '\Apps\CM_GradeService\Block\Statistics'
//    ])
//    ->addAliasNames('cashpayment', 'CM_GradeService')
//    ->addTemplateDirs([
//        'cashpayment' => PHPFOX_DIR_SITE_APPS . 'CM_GradeService' . PHPFOX_DS . 'views',
//    ]);
//
//event('app_settings', function ($settings){
//    if (isset($settings['cm_cashpayment_enabled'])) {
//        \Phpfox::getService('admincp.module.process')->updateActivity('CM_GradeService', $settings['cm_cashpayment_enabled']);
//    }
//});
