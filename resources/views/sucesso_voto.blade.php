<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Immutable Vote</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/ethers@6.9.2/dist/ethers.umd.min.js"></script>


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename"><img src="assets/img/logo.png" alt="Hero Image" class="img-fluid"> Immutable Vote</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">How It Works</a></li>
          <li><a href="#services">Open Votes</a></li>
          <li><a href="#pricing">Pricing</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- Botão Connect Wallet -->
      <button id="connectWalletBtn" class="btn-getstarted me-3">Connect Wallet</button>

      <!-- Mostra saldo depois de conectar -->
      <span id="walletBalance" class="fw-bold me-3" style="display:none; color: #000000"></span>

    </div>
  </header>

  <main class="main">

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title mt-20" data-aos="fade-up">
        <br><br><br>
        <h2>Your Vote</h2>
        <p>Look below at the vote you cast.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <div class="col-md-12">
            <div class="card p-4 shadow-sm h-100">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-people-fill display-6 text-primary me-3"></i>
                <h4 class="mb-0">General Elections 2026 in Brazil</h4>
              </div>
              <p>Project Name:: {{ $project_name }}</p>
              <p>Vote For: {{ $vote_for }}</p>
              <p>Contract: {{ $contract }}</p>
              <p>Your Address: {{ $address }}</p>
              <p>Transaction Hash: {{ $txHash }}</p>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Services Section -->


  </main>

  <footer id="footer" class="footer">
    <div class="container copyright text-center mt-4">
      <p> <strong class="px-1 sitename">Immutable Vote</strong> <span>All Rights Reserved</span>
   
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>