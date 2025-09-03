<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>County Name Elections</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root{
      --brand-blue:#123f7a; /* deep banner blue */
      --brand-accent:#e4573d; /* CTA coral */
      --tile-border:#dfe6ef;
    }
    body{ font-smooth:always; -webkit-font-smoothing:antialiased; }

    /* Navbar */
    .navbar { border-bottom: 1px solid #eef2f7; }
    .brand-badge{ width:40px; height:40px; border-radius:50%; display:inline-grid; place-items:center; background:#0f2f5e; color:#fff; font-weight:700; font-size:.9rem; }

    /* Hero */
    .hero{ background:var(--brand-blue); color:#fff; padding:64px 0; }
    .hero h1{ font-weight:700; }
    .hero p{ opacity:.9; }
    .btn-accent{ background:var(--brand-accent); border:none; }
    .btn-accent:hover{ filter:brightness(.95); }
    .hero-illustration{ width:100%; max-width:520px; height:auto; }

    /* Tiles */
    .tiles{ padding:48px 0; }
    .tile-card{ border:1px solid var(--tile-border); border-radius:.75rem; transition:transform .12s ease, box-shadow .12s ease; height:100%; }
    .tile-card:hover{ transform:translateY(-2px); box-shadow:0 6px 20px rgba(18,63,122,.08); }
    .tile-card .icon{ font-size:2rem; color:var(--brand-blue); }
    .tile-card h5{ color:#0f2f5e; margin-top:.75rem; }

    /* Footer */
    .footer{ border-top:1px solid #eef2f7; color:#6c7a90; padding:36px 0; }

    @media (max-width: 991.98px){
      .hero{ padding:48px 0; }
    }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-white">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <span class="brand-badge">★</span>
        <span class="fw-semibold">County Name Elections</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#ways">Ways to Vote</a></li>
          <li class="nav-item"><a class="nav-link" href="#faqs">FAQs</a></li>
          <li class="nav-item"><a class="nav-link" href="#news">News</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-7">
          <h1 class="display-6 mb-3">Can't make it to the polls? You can vote absentee.</h1>
          <p class="lead mb-4">Missouri allows any voter who can't vote in person to vote by absentee ballot.</p>
          <a href="#learn" class="btn btn-accent btn-lg px-4">Learn more</a>
        </div>
        <div class="col-lg-5 text-center">
          <!-- Simple mailbox illustration (SVG) -->
          <svg class="hero-illustration" viewBox="0 0 640 360" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Mailbox illustration">
            <defs>
              <linearGradient id="g1" x1="0" x2="1" y1="0" y2="1">
                <stop offset="0%" stop-color="#6bd1f0"/>
                <stop offset="100%" stop-color="#4bb8e8"/>
              </linearGradient>
            </defs>
            <rect x="0" y="280" width="640" height="8" fill="#2a66b1" opacity=".3"/>
            <g transform="translate(120,40)">
              <rect x="170" y="200" width="24" height="80" fill="#f1c48f"/>
              <rect x="0" y="80" rx="20" ry="20" width="360" height="160" fill="url(#g1)"/>
              <rect x="260" y="80" width="16" height="160" fill="#2a66b1" opacity=".25"/>
              <rect x="280" y="40" width="40" height="24" fill="#f45a3c"/>
              <circle cx="300" cy="72" r="8" fill="#e23f28"/>
              <!-- ballot -->
              <g transform="translate(40,100)">
                <rect width="120" height="80" rx="4" fill="#fff"/>
                <text x="12" y="24" font-size="12" fill="#2a66b1" font-weight="700">VOTE BY MAIL</text>
                <g transform="translate(12,36)" fill="#ff5a4c"><circle cx="8" cy="8" r="6"/><circle cx="28" cy="8" r="6"/><circle cx="48" cy="8" r="6"/><circle cx="68" cy="8" r="6"/><circle cx="88" cy="8" r="6"/></g>
              </g>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- TILES -->
  <section class="tiles">
    <div class="container">
      <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <!-- Tile 1 -->
        <div class="col">
          <a href="#registration" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-journal-text"></i></div>
              <h5 class="mt-3">Registration</h5>
              <p class="mb-0 text-body-secondary">Check your registration status or register to vote.</p>
            </div>
          </a>
        </div>
        <!-- Tile 2 -->
        <div class="col">
          <a href="#absentee" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-envelope-paper"></i></div>
              <h5 class="mt-3">How to Vote by Mail (Absentee)</h5>
              <p class="mb-0 text-body-secondary">Request and return your absentee ballot.</p>
            </div>
          </a>
        </div>
        <!-- Tile 3 -->
        <div class="col">
          <a href="#results" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-graph-up"></i></div>
              <h5 class="mt-3">View Election Results</h5>
              <p class="mb-0 text-body-secondary">See live and historical election results.</p>
            </div>
          </a>
        </div>
        <!-- Tile 4 -->
        <div class="col">
          <a href="#ballot" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-clipboard-check"></i></div>
              <h5 class="mt-3">What's on the Ballot</h5>
              <p class="mb-0 text-body-secondary">Preview candidates and measures before you vote.</p>
            </div>
          </a>
        </div>
      </div>

      <!-- Optional second row of tiles -->
      <div class="row g-4 mt-1 row-cols-1 row-cols-sm-2 row-cols-lg-4">
        <div class="col">
          <a href="#polling" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-geo-alt"></i></div>
              <h5 class="mt-3">Find Your Polling Place</h5>
              <p class="mb-0 text-body-secondary">Locate where to vote in person.</p>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#id" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-person-vcard"></i></div>
              <h5 class="mt-3">Voter ID Requirements</h5>
              <p class="mb-0 text-body-secondary">What you need to bring to vote.</p>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#calendar" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-calendar-event"></i></div>
              <h5 class="mt-3">Election Calendar</h5>
              <p class="mb-0 text-body-secondary">Deadlines and important dates.</p>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#help" class="text-decoration-none">
            <div class="p-4 tile-card h-100">
              <div class="icon"><i class="bi bi-life-preserver"></i></div>
              <h5 class="mt-3">Get Help</h5>
              <p class="mb-0 text-body-secondary">Contact your local election office.</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">
      <div class="small">© <span id="year"></span> County Name Elections</div>
      <ul class="nav small">
        <li class="nav-item"><a class="nav-link px-2 text-body-secondary" href="#privacy">Privacy</a></li>
        <li class="nav-item"><a class="nav-link px-2 text-body-secondary" href="#terms">Terms</a></li>
        <li class="nav-item"><a class="nav-link px-2 text-body-secondary" href="#accessibility">Accessibility</a></li>
      </ul>
    </div>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>