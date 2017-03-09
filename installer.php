<?php

$oInstaller = new \Core\App\Installer();
$oInstaller->onInstall(function() use ($oInstaller){

    $oInstaller->db->query('CREATE TABLE IF NOT EXISTS `' . Phpfox::getT('cashpayment_payments') . '` (
      `payment_id` bigint(30) NOT NULL AUTO_INCREMENT,
      `seller_id` int(11) NOT NULL,
      `user_id` int(11) NOT NULL,
      `item_name` varchar(300) NOT NULL,
      `item_number` varchar(300) NOT NULL,
      `currency_code` varchar(5) NOT NULL,
      `return_url` varchar(200) NOT NULL,
      `amount` int(15) NOT NULL,
      `time_stamp` INT( 12 ) NULL DEFAULT NULL ,
      `status` VARCHAR( 5 ) NOT DEFAULT \'pending\'
      PRIMARY KEY (`payment_id`),
      KEY `seller_id` (`seller_id`,`buyer_id`)
      KEY  `status` (`status`)
    ) AUTO_INCREMENT=10000 ;');

    if (!$oInstaller->db->select('count(*)')->from(Phpfox::getT('api_gateway'))->where('gateway_id = \'cashpayment\'')->count()) {
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
