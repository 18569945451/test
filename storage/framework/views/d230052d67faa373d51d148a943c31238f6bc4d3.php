<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Checkout Sample</title>
    <meta name="description" content="A demo of Stripe Payment Intents" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo e(asset('wy/css/normalize.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('wy/css/global.css')); ?>" />
  </head>

  <body>
    <div class="sr-root">
      <div class="sr-main">
        <header class="sr-header">
          <div class="sr-header__logo"></div>
        </header>
        <div class="sr-payment-summary completed-view">
            <h1>Your payment succeeded</h1>
            <h4>
              View CheckoutSession response:</a>
            </h4>
          </div>
          <div class="sr-section completed-view">
            <div class="sr-callout">
              <pre>
    
              </pre>
            </div>
            <button onclick="window.location.href = '/';">Restart demo</button>
          </div> 
        </div> 
        <div class="sr-content">
        <div class="pasha-image-stack">
          <img
            src="https://picsum.photos/280/320?random=1"
            width="140"
            height="160"
          />
          <img
            src="https://picsum.photos/280/320?random=2"
            width="140"
            height="160"
          />
          <img
            src="https://picsum.photos/280/320?random=3"
            width="140"
            height="160"
          />
          <img
            src="https://picsum.photos/280/320?random=4"
            width="140"
            height="160"
          />
        </div>
      </div>
    </div>
    <script>

    </script>
    <script>
      var urlParams = new URLSearchParams(window.location.search);
      var sessionId = urlParams.get("session_id");
      if (sessionId) {
        fetch("/checkout/"+sessionId).then(function(result){
          return result.json()
        }).then(function(session){
          var sessionJSON = JSON.stringify(session, null, 2);
          document.querySelector("pre").textContent = sessionJSON;
        }).catch(function(err){
          console.log('Error when fetching Checkout session', err);
        });
      }
    </script>
  </body>
</html>
<?php /**PATH D:\phpstudy_pro\WWW\test\resources\views/pay/success.blade.php ENDPATH**/ ?>