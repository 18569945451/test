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
<form action="{{url('checkout')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="sessionID" value="{{$sessionID}}">
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
