<?php

$aTables = [
    Phpfox::getT('cashpayment_payments'),
];
db()->dropTables($aTables);