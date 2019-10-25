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

    <input type="submit" value="提交订单">
</form>
</body>
</html>
<?php /**PATH D:\phpstudy_pro\WWW\test\resources\views/Pay/index.blade.php ENDPATH**/ ?>