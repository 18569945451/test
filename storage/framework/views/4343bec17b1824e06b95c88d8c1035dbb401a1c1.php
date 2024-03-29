<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title data-i18n="title"></title>
    <meta name="description" content="A demo of Stripe Payment Intents" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo e(asset('wy/css/normalize.css')); ?>" />
    <link rel="stylesheet" href=" <?php echo e(asset('wy/css/global.css')); ?>" />
    <!-- Load Stripe.js on your website. -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?php echo e(asset('wy/script.js')); ?>}" defer></script>
    <!-- Load translation files and libraries. -->
    <script src="https://unpkg.com/i18next/i18next.js"></script>
    <script src="https://unpkg.com/i18next-xhr-backend/i18nextXHRBackend.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.js"></script>
    <script src="<?php echo e(asset('wy/translation.js')); ?>" defer></script>
  </head>

  <body>
    <div class="sr-root">
      <div class="sr-main">
        <header class="sr-header">
          <div class="sr-header__logo"></div>
        </header>
        <section class="container">
          <div>
            <h1 data-i18n="headline"></h1>
            <h4 data-i18n="subline"></h4>
            <div class="pasha-image">
              <img
                src="https://picsum.photos/280/320?random=4"
                width="140"
                height="160"
              />
            </div>
          </div>
          <div class="quantity-setter">
            <button class="increment-btn" id="subtract" disabled>
              -
            </button>
            <input type="number" id="quantity-input" min="1" value="1" />
            <button class="increment-btn" id="add">+</button>
          </div>
          <p class="sr-legal-text" data-i18n="sr-legal-text"></p>

          <button
            id="submit"
            data-i18n="button.submit"
            i18n-options="{ "total": "0" }"
          ></button>
        </section>
        <div id="error-message"></div>
      </div>
    </div>
  </body>
</html>
<?php /**PATH D:\phpstudy_pro\WWW\test\resources\views/pay/index1.blade.php ENDPATH**/ ?>