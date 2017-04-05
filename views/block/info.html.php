<?php
defined('PHPFOX') or exit('NO DICE!');
?>

<p>{_p('Please send us a payment')}</p>
<p>{_p('Amount')}: <strong> {$aPayment.currency_code|currency_symbol}{$aPayment.amount|number_format:2}</strong></p>
<p>{_p('Your transaction reference number')}: <strong>{$aPayment.payment_id}</strong></p>
<p>{_p('Thank you!')}</p>
