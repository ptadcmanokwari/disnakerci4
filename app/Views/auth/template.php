<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Disnakertrans Manokwari</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>frontend/assets/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= base_url(); ?>frontend/assets/img/favicon/site.webmanifest">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/dist/css/adminlte.min.css">
  <style>
    body {
      color: #000;
      overflow-x: hidden;
      height: 100%;
      background-color: #B0BEC5 !important;
      background-repeat: no-repeat;
    }

    .card.card-outline {
      box-shadow: 0px 4px 8px 0px #757575;
      border-radius: 0px;
    }

    .login-box,
    .register-box {
      width: 400px;
    }

    .login-box-msg,
    .register-box-msg {
      margin: 0;
      padding: 0 20px 20px;
      text-align: center;
      font-size: 14px;
    }

    button.btn.btn-primary.btn-block {
      background-color: #116db6;
    }
  </style>

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline">

      <?= $this->renderSection('content') ?>
    </div>
  </div>

  <script src="<?= base_url(); ?>adminltev31/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>adminltev31/dist/js/adminlte.min.js"></script>
</body>

</html>