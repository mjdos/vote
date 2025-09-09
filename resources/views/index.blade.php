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

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">

              <h1 class="mb-4">
                Create secure, <br>
                transparent, and <br>
                <span class="accent-text">verifiable voting</span><br>
                projects for any purpose
              </h1>

              <p class="mb-4 mb-md-5">
                Create your project, open it for voting, and let SONIC blockchain secure every vote with transparency and trust.
              </p>

              <div class="hero-buttons">
                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Start new Project</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/vote-home.png" alt="Hero Image" class="img-fluid">
            </div>
          </div>
        </div>

        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-people-fill display-4"></i>
              </div>
              <div class="stat-content">
                <h4>General Elections</h4>
                <p class="mb-0">Organize elections with candidates for public or private positions.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-building display-4"></i>
              </div>
              <div class="stat-content">
                <h4>Condominiums</h4>
                <p class="mb-0">Vote on condominium decisions such as budgets, projects, and rules.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-bank display-4"></i>
              </div>
              <div class="stat-content">
                <h4>Law Projects</h4>
                <p class="mb-0">Propose and vote on legislative initiatives or policy ideas.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-award"></i>
              </div>
              <div class="stat-content">
                <h4>Institution</h4>
                <p class="mb-0">Vote on proposals within public or private institutions.</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

          <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
            <span class="about-meta">MORE ABOUT US</span>
            <h2 class="about-title">Immutable voting on SONIC blockchain</h2>
            <p class="about-description">
            Immutable Vote was created with a simple mission: to make voting more secure, transparent, and accessible for everyone. We believe that decisions — whether in elections, communities, or organizations — should be trusted, verifiable, and impossible to manipulate.
            </p>
            <p class="about-description">
            Our platform allows anyone to create a voting project, open it for participation, and ensure every vote is permanently recorded on the SONIC blockchain. By combining ease of use with blockchain technology, we bring trust and accountability to decision-making processes of any scale.
            </p>
            <p class="about-description">
            This project was built to participate in the Sonic S-Tier Hackathon on DoraHacks, where we aim to showcase how decentralized technologies can solve real-world governance challenges.
            </p>

            <div class="info-wrapper">
              <div class="row gy-4">
                <div class="col-lg-5">
                  <div class="profile d-flex align-items-center gap-3">
                    <img src="assets/img/marcelo.jpg" alt="CEO Profile" class="profile-image">
                    <div>
                      <h4 class="profile-name">Marcelo Santos</h4>
                      <p class="profile-position">CEO &amp; Founder</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="contact-info d-flex align-items-center gap-2">
                    <i class="bi bi-telephone-fill"></i>
                    <div>
                      <p class="contact-label">Contact us anytime</p>
                      <p class="contact-number">mjdos.2014@gmail.com</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="image-wrapper">
              <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                <img src="assets/img/block.jpg" alt="Business Meeting" class="img-fluid main-image rounded-4">
                <img src="assets/img/sonic-logo.jpg" alt="Team Discussion" class="img-fluid small-image rounded-4">
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title mb-2" data-aos="fade-up">
        <h2>How It Works</h2>
        <p>With Immutable Vote, you can easily set up and manage secure voting projects in just a few steps:</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="features-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                
                <ul>
                    <h4>Create Your Project</h4>
                    <li><i class="bi bi-check2-all"></i> Start by defining what you want people to vote on. It can be a general election, a condominium decision, a law project, a company initiative, or an institutional proposal.
                  </li>
                </ul>
                <ul>
                    <h4>Open for Voting</h4>
                    <li><i class="bi bi-check2-all"></i> Once your project is created, open it for participation. Share the link with your community, colleagues, or organization members.
                  </li>
                </ul>
                <ul>
                    <h4>Cast and Record Votes</h4>
                    <li><i class="bi bi-check2-all"></i>Participants vote securely and anonymously. Every vote is automatically recorded on the SONIC blockchain, ensuring transparency, immutability, and verifiability.
                  </li>
                </ul>
                <ul>
                    <h4>Get Trusted Results</h4>
                    <li><i class="bi bi-check2-all"></i>Results cannot be altered or tampered with, providing full trust and accountability for everyone involved.
                  </li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/features-illustration-1.webp" alt="" class="img-fluid">
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Features Section -->




    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Open Votes</h2>
        <p>Choose a category and cast your vote in ongoing projects.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <div class="col-md-3">
            <div class="card p-4 shadow-sm h-100 text-center d-flex flex-column align-items-center justify-content-center">
              <img src="assets/img/lula.png" alt="Lula" 
                  style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin-bottom:15px; ">
              <div style="font-weight:bold; font-size:1.2rem;">Lula</div>
              <div class="text-muted mb-2">Workers' Party</div>
              <form action="{{ route('vote.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="project_name" value="General Elections 2026">
                <input type="hidden" name="vote_for" value="Lula">
                <button class="btn btn-outline-primary btn-sm">Vote Now</button>
              </form>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card p-4 shadow-sm h-100 text-center d-flex flex-column align-items-center justify-content-center">
              <img src="assets/img/tarcisio.png" alt="Tarcisio" 
                  style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin-bottom:15px;">
              <div style="font-weight:bold; font-size:1.2rem;">Tarcisio</div>
              <div class="text-muted mb-2">Republicans</div>
              <form action="{{ route('vote.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="project_name" value="General Elections 2026">
                <input type="hidden" name="vote_for" value="Tarcisio">
                <button class="btn btn-outline-primary btn-sm">Vote Now</button>
              </form>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card p-4 shadow-sm h-100 text-center d-flex flex-column align-items-center justify-content-center">
              <img src="assets/img/bolsonaro.png" alt="Bolsonaro" 
                  style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin-bottom:15px;">
              <div style="font-weight:bold; font-size:1.2rem;">Bolsonaro</div>
              <div class="text-muted mb-2">Liberal Party</div>
              <form action="{{ route('vote.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="project_name" value="General Elections 2026">
                <input type="hidden" name="vote_for" value="Bolsonaro">
                <button class="btn btn-outline-primary btn-sm">Vote Now</button>
              </form>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card p-4 shadow-sm h-100 text-center d-flex flex-column align-items-center justify-content-center">
              <img src="assets/img/alckmin.png" alt="Alckmin" 
                  style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin-bottom:15px;">
              <div style="font-weight:bold; font-size:1.2rem;">Alckmin</div>
              <div class="text-muted mb-2">Social Democrats</div>
              <form action="{{ route('vote.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="project_name" value="General Elections 2026">
                <input type="hidden" name="vote_for" value="Alckmin">
                <button class="btn btn-outline-primary btn-sm">Vote Now</button>
              </form>
            </div>
          </div>
        </div>


      </div>

    </section><!-- /Services Section -->



    <!-- Call To Action 2 Section -->
    <section id="call-to-action-2" class="call-to-action-2 section dark-background">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Start Now</h3>
              <p>Create your project, open it for voting, and let SONIC blockchain secure every vote with transparency and trust.</p>
              <a class="cta-btn" href="#">Create Project</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action 2 Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Your message is important to us, send questions, suggestions, tips, complaints, etc.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
          <div class="col-lg-5">
            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
              <h3>Contact Info</h3>
              <p>Send us a message.</p>

              <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="content">
                  <h4>Email Address</h4>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
              <h3>Get In Touch</h3>
              <p>Send us a message.</p>

              <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">

                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                  </div>

                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                  </div>

                  <div class="col-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                  </div>

                  <div class="col-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                  </div>

                  <div class="col-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>

                    <button type="submit" class="btn">Send Message</button>
                  </div>

                </div>
              </form>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">
    <div class="container copyright text-center mt-4">
      <p> <strong class="px-1 sitename">Immutable Vote</strong> <span>All Rights Reserved</span>
    <button onclick="showVoteCostRobusto()">Ver Custo do Voto</button><pre id="out"></pre>
  </p>
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

  <script>
    const connectBtn = document.getElementById("connectWalletBtn");
    const balanceSpan = document.getElementById("walletBalance");

     // Função para converter Wei (BigInt) em SONIC com precisão
    function formatWeiToEth(weiBigInt, decimals = 6) {
      const weiPerEth = 10n ** 18n; // 1 ETH/SONIC = 1e18 Wei
      const whole = weiBigInt / weiPerEth; // parte inteira
      const fraction = weiBigInt % weiPerEth; // parte fracionária

      // Pega apenas os primeiros "decimals" dígitos da parte fracionária
      const fractionStr = (fraction.toString().padStart(18, "0")).slice(0, decimals);

      return `${whole.toString()}.${fractionStr}`;
    }
    
    async function connectWallet() {
      if (typeof window.ethereum !== "undefined") {
        try {
          // Solicita acesso às contas do MetaMask
          const accounts = await ethereum.request({ method: "eth_requestAccounts" });
          const account = accounts[0];

          // Obtém saldo da conta em Wei (hexadecimal)
          const balanceWei = await ethereum.request({
            method: "eth_getBalance",
            params: [account, "latest"]
          });

          const balanceBigInt = BigInt(balanceWei);
          const balanceFormatted = formatWeiToEth(balanceBigInt, 6);

          // Encurta endereço para exibir
          const shortAccount = account.substring(0, 6) + "..." + account.substring(account.length - 4);

          // Atualiza interface
          connectBtn.style.display = "none";
          balanceSpan.style.display = "inline";
         
          //balanceSpan.innerText = `${balanceEth} SONIC | ${shortAccount}`;
          balanceSpan.innerHTML = `<img src="assets/img/sonic-small-logo.jpeg" alt="Sonic Logo" style="height:30px; margin-right:6px;"> ${balanceFormatted} SONIC`;

        } catch (err) {
          console.error("Wallet connection failed:", err);
          alert("Connection to MetaMask was rejected or failed.");
        }
      } else {
        alert("MetaMask not detected! Please install MetaMask.");
      }
    }

    connectBtn.addEventListener("click", connectWallet);
  </script>


<script>
  // ====== Config ======
  const contractAddress = "0xb5022A7D7F5c2a7862b0C63FFfe01b2Ed6EAEfdf";

  // ABI mínima com submitVote e getters usados
  const contractABI = [
    {"inputs":[],"stateMutability":"nonpayable","type":"constructor"},
    {"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"voter","type":"address"},{"indexed":false,"internalType":"string","name":"projectName","type":"string"},{"indexed":false,"internalType":"string","name":"voteFor","type":"string"}],"name":"VoteSubmitted","type":"event"},
    {"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"admin","type":"address"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"Withdraw","type":"event"},
    {"inputs":[],"name":"VOTE_COST","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},
    {"inputs":[],"name":"getTotalVotes","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},
    {"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},
    {"inputs":[{"internalType":"string","name":"_projectName","type":"string"},{"internalType":"string","name":"_voteFor","type":"string"}],"name":"submitVote","outputs":[],"stateMutability":"payable","type":"function"},
    {"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"votes","outputs":[{"internalType":"string","name":"projectName","type":"string"},{"internalType":"string","name":"voteFor","type":"string"},{"internalType":"address","name":"voter","type":"address"}],"stateMutability":"view","type":"function"},
    {"inputs":[],"name":"withdraw","outputs":[],"stateMutability":"nonpayable","type":"function"}
  ];

  // ====== Helpers (ethers v6) ======
  async function getProvider() {
    if (!window.ethereum) throw new Error("MetaMask não detectado.");
    const provider = new ethers.BrowserProvider(window.ethereum);
    // Solicita contas
    await provider.send("eth_requestAccounts", []);
    return provider;
  }

  async function getContractWithSigner() {
    const provider = await getProvider();
    // Opcional: verificação de rede e bytecode (ajuda a diagnosticar rede errada)
    const net = await provider.getNetwork();
    console.log("chainId:", Number(net.chainId));

    const code = await provider.getCode(contractAddress);
    if (!code || code === "0x") {
      throw new Error("Endereço não é contrato nesta rede atual. Verifique a rede no MetaMask.");
    }

    const signer = await provider.getSigner();
    return new ethers.Contract(contractAddress, contractABI, signer);
  }

  function normalizeRpcError(err) {
    // Extrai mensagens úteis (inclui casos MetaMask: -32603 / -32000 / missing trie node)
    const parts = [
      err?.info?.error?.message,
      err?.error?.message,
      err?.data?.message,
      err?.message
    ].filter(Boolean);
    return parts[0] || "Falha ao processar a operação.";
  }

  // ====== UI: mostrar custo e enviar voto ======
  // Mostra o VOTE_COST como texto em <p id="voteCost">
  window.showVoteCost = async function showVoteCost() {
    try {
      const contract = await getContractWithSigner();
      // Força leitura no estado mais recente (evita alguns RPCs problemáticos)
      const cost = await contract.VOTE_COST({ blockTag: "latest" });
      const costEth = ethers.formatEther(cost);
      console.log("VOTE_COST (wei):", cost.toString());
      const el = document.getElementById("voteCost");
      if (el) el.textContent = `Custo do voto: ${costEth} ETH`;
      else alert(`Custo do voto: ${costEth} ETH`);
    } catch (err) {
      console.error("Erro ao buscar VOTE_COST:", err);
      alert("Erro ao buscar VOTE_COST: " + normalizeRpcError(err));
    }
  };

  // Envia o voto chamando submitVote(projectName, candidate) com o value correto
  window.sendVote = async function sendVote(projectName, candidate) {
    try {
      if (!projectName || !candidate) {
        alert("Preencha projectName e candidate.");
        return;
      }

      const contract = await getContractWithSigner();

      // Lê o custo diretamente do contrato
      const cost = await contract.VOTE_COST({ blockTag: "latest" });
      console.log("Vote cost (wei):", cost.toString());

      // Opcional: você pode definir gasLimit manualmente se o RPC não estimar bem:
      // const tx = await contract.submitVote(projectName, candidate, { value: cost, gasLimit: 500000 });
      const tx = await contract.submitVote(projectName, candidate, { value: cost });

      console.log("Transaction sent:", tx.hash);
      const receipt = await tx.wait(); // aguarda ser minerada
      console.log("Vote confirmed:", receipt);
      alert("Seu voto foi confirmado! Tx: " + (tx.hash || receipt.hash));

    } catch (err) {
      console.error("Voting failed:", err);
      alert("Voting failed: " + normalizeRpcError(err));
    }
  };
</script>
  
    <script>
    const CONTRACT = "0xb5022A7D7F5c2a7862b0C63FFfe01b2Ed6EAEfdf";
    const ABI = [{"inputs":[],"name":"VOTE_COST","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"}];
    // Coloque aqui um endpoint que você confia (da MESMA rede do contrato)
    const READONLY_RPC = "https://rpc.testnet.soniclabs.com";

    async function showVoteCostRobusto() {
      const out = document.getElementById('out');
      out.textContent = '...';

      try {
        // Detecta v5 ou v6
        const isV5 = !!(window.ethers?.providers?.Web3Provider);
        const isV6 = !!window.ethers?.BrowserProvider;

        if (!window.ethereum) throw new Error('MetaMask não detectado');

        const provider = isV5
          ? new ethers.providers.Web3Provider(window.ethereum)
          : new ethers.BrowserProvider(window.ethereum);

        await provider.send("eth_requestAccounts", []);

        const net = await provider.getNetwork();
        const chainId = Number(net.chainId);
        const code = await provider.getCode(CONTRACT);

        out.textContent = `chainId: ${chainId}\nhas bytecode?: ${code && code !== '0x'}\n`;

        const contract = new ethers.Contract(CONTRACT, ABI, provider);

        // Tenta leitura normal
        try {
          const cost = await contract.VOTE_COST({ blockTag: "latest" });
          const fmt = isV5 ? ethers.utils.formatEther(cost) : ethers.formatEther(cost);
          out.textContent += `VOTE_COST (MetaMask RPC): ${fmt}\n`;
          return;
        } catch (e1) {
          out.textContent += `Falha no MetaMask RPC: ${e1.message}\nTentando RPC readonly...\n`;
        }

        // Fallback: RPC readonly estável
        const ro = isV5
          ? new ethers.providers.JsonRpcProvider(READONLY_RPC)
          : new ethers.JsonRpcProvider(READONLY_RPC);

        const roContract = new ethers.Contract(CONTRACT, ABI, ro);
        const cost2 = await roContract.VOTE_COST({ blockTag: "latest" });
        const fmt2 = isV5 ? ethers.utils.formatEther(cost2) : ethers.formatEther(cost2);
        out.textContent += `VOTE_COST (RPC readonly): ${fmt2}\n`;

      } catch (e) {
        out.textContent = 'Erro: ' + (e && e.message ? e.message : e);
      }
    }
    
 
    
  </script>


</body>

</html>