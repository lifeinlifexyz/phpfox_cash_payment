<?php
$js = <<<EOF
    <script type="text/javascript">
    \$Behavior.init_cache_payment_pay = function () {
        $('form[action$="/cashpayment/buy/"]')
            .attr('onsubmit', "$(this).ajaxCall('cashpayment.buy'); return false;");
    }
</script>
EOF;
echo $js;
