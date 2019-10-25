<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>测试stripe支付demo</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.bootcss.com/axios/0.16.0/axios.min.js"></script>
</head>
<body>
<div id="app"></div>
<!-- built files will be auto injected -->
<form action="<?php echo e(url('pay/edit')); ?>" method="POST">
    <?php echo e(csrf_field()); ?>

    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_gUwvnzSMDJ8FjYK2Q9gus2J6006rJarJaL"
            data-amount="605"
            data-name="Leoptique Inc."
            data-description="Widget"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
    </script>
</form>
</body>
</html>
<?php /**PATH D:\phpstudy_pro\WWW\test\resources\views/pay/pay.blade.php ENDPATH**/ ?>