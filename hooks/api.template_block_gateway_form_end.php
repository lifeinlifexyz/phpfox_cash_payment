<?php
/**
 * [PHPFOX_HEADER]
 *
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: form.html.php 7119 2014-02-18 13:55:48Z Fern $
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<script type="text/javascript">
    $Behavior.init_cache_payment_pay = function () {
        $('form[action$="/cashpayment/buy/"]')
            .attr('onsubmit', "$(this).ajaxCall('cashpayment.buy'); return false;");
    }
</script>
