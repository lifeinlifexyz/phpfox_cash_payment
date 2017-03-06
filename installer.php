<?php

$oInstaller = new \Core\App\Installer();
$oInstaller->onInstall(function() use ($oInstaller){

//    $oInstaller->db->query('CREATE TABLE IF NOT EXISTS `' . Phpfox::getT('cashpayment_payments') . '` (
//      `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
//      `max_rate` int(2) unsigned NOT NULL,
//      `m_connection` varchar(75) NOT NULL DEFAULT \'\',
//      `question` varchar(500) NOT NULL,
//      `rating` varchar(10) NOT NULL DEFAULT \'0\',
//      `count` varchar(10) NOT NULL DEFAULT \'0\',
//      `is_active` tinyint(1) NOT NULL DEFAULT \'0\',
//      PRIMARY KEY `question_id` (`question_id`),
//      KEY `is_active` (`is_active`)
//    )');

    if (!$oInstaller->db->select('count(*)')->from(Phpfox::getT('api_gateway'))->count()) {
        $oInstaller->db->insert(Phpfox::getT('api_gateway'), [
            'gateway_id' => 'cashpayment',
            'title' => 'Cash payment',
            'description' => 'Some information about cash payment...',
            'is_active' => '0',
            'is_test' => '0',
            'setting' => serialize([])
        ]);

    }

    copy(PHPFOX_DIR_SITE_APPS . 'CM_CashPayment' . PHPFOX_DS . 'gateway' . PHPFOX_DS . 'cashpayment.class.php',
        PHPFOX_DIR_LIB_CORE . 'gateway' . PHPFOX_DS . 'api' . PHPFOX_DS  . 'cashpayment.class.php');

});
