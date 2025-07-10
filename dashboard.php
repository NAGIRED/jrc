<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet"
  />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    <style>
        
* {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      display: flex;
      background: #f4f6f9;
      min-height: 100vh;
      color: #444;
      transition: margin-left 0.3s ease;
    }

    /* SIDEBAR */
    .sidebar {
      width: 240px;
      background-color: #1e1e2f;
      height: 100vh;
      color: #fff;
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.25);
      display: flex;
      flex-direction: column;
      z-index: 100;
      transition: transform 0.3s ease;
    }

    .sidebar h2 {
      margin-bottom: 40px;
      font-size: 26px;
      letter-spacing: 1px;
      font-weight: 700;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      margin: 16px 0;
      color: #bbb;
      text-decoration: none;
      font-size: 16px;
      padding: 10px 12px;
      border-radius: 8px;
      transition: background 0.2s ease, color 0.2s ease;
    }

    .sidebar a i {
      margin-right: 12px;
      font-size: 18px;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #4e73df;
      color: #fff;
      box-shadow: 0 4px 10px rgba(78, 115, 223, 0.4);
    }
     /* User Profile Popup Styles */
    .user-profile-popup {
      position: absolute;
      top: 60px;
      right: 30px;
      width: 280px;
      background: #fff;
      color: #333;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      padding: 20px;
      z-index: 1050;
      display: none;
      animation: fadeInPopup 0.3s ease forwards;
    }

    @keyframes fadeInPopup {
      from { opacity: 0; transform: translateY(-10px);}
      to { opacity: 1; transform: translateY(0);}
    }

    .user-profile-popup h5 {
      margin-bottom: 15px;
      color: #6f42c1;
      font-weight: 700;
    }

    .user-profile-popup li {
      list-style: none;
      margin-bottom: 10px;
      font-size: 1rem;
    }

    .user-profile-popup li i {
      color: #6f42c1;
      margin-right: 10px;
      font-size: 1.1rem;
      vertical-align: middle;
    }

    /* Navbar styles */
    .navbar {
      background-color: #fff;
      padding: 15px 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      border-radius: 10px;
    }

    .user-icon {
      cursor: pointer;
      color: #6f42c1;
      font-size: 2rem;
      transition: color 0.3s ease;
    }

    .user-icon:hover {
      color: #5932a1;
    }

    @media (max-width: 768px) {
      .contact-section {
        padding: 25px;
      }
  
      .contact-section h2 {
        font-size: 2rem;
      }
  
      .contact-section button {
        width: 100%;
        font-size: 1.1rem;
      }
    }

    /* MAIN CONTENT */
    .main-content {
      margin-left: 240px;
      padding: 30px 40px;
      width: 100%;
      min-height: 100vh;
      background: #f4f6f9;
      transition: margin-left 0.3s ease;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
    }

    .card {
      background-color: #fff;
      padding: 24px 28px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: box-shadow 0.3s ease;
    }

    .card:hover {
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .card .icon {
      font-size: 38px;
      color: #4e73df;
      min-width: 52px;
      text-align: center;
    }

    .card .info {
      text-align: right;
    }

    .card .info p.value {
      font-size: 24px;
      font-weight: 700;
      color: #222;
      margin-bottom: 6px;
      letter-spacing: 0.02em;
    }

    .card .info span {
      color: #666;
      font-size: 15px;
      letter-spacing: 0.02em;
    }

    </style>
</head>
<body>
     
       <!-- <a href="index.php">Product</a> -->
<nav class="sidebar">
  <h2>My Dashboard</h2>
  <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
  <a href="./contact.html"><i class="fas fa-user"></i> Profile</a>
  <a href="index.php"><i class="fas fa-box"></i> Product view</a>
  <a href="./enter.html"><i class="fas fa-file-invoice"></i> View Bills</a>
  <a href="./grap.html"><i class="fas fa-chart-bar"></i> Reports</a>
  
   
  <a href="logout.php" title="Logout">
    <i class="fas fa-sign-out-alt" ></i>Logout
  </a>


</nav>


  <main class="main-content">
    <header class="navbar">
    <h1>Welcome Back!</h1>
    <div>
      <i class="bi bi-person-circle user-icon" id="userIcon" title="User Profile"></i>
    </div>

    <div class="user-profile-popup" id="userProfilePopup" aria-hidden="true">
      <h5>User Profile</h5>
      <ul>
        <li><i class="bi bi-telephone-fill"></i> +91 93479 89882</li>
        <li><i class="bi bi-envelope-fill"></i> nagir1090@gmail.com</li>
        <li><i class="bi bi-geo-alt-fill"></i> Kanakadri Palli (V), Kolimigundal (M), Kurnool (Dist) - 518123</li>
      </ul>
    </div>
  </header>

    <section class="cards" aria-label="Dashboard statistics">
      <article class="card" aria-live="polite" aria-atomic="true">
        <div class="icon"><i class="fas fa-shopping-bag"></i></div>
        <div class="info">
          <p class="value" id="totalPurchaseQty">0</p>
          <span>Total Purchase Quantity</span>
        </div>
      </article>

      <article class="card" aria-live="polite" aria-atomic="true">
        <div class="icon"><i class="fas fa-rupee-sign"></i></div>
        <div class="info">
          <p class="value" id="totalPurchasePrice">₹0.00</p>
          <span>Purchase Price</span>
        </div>
      </article>

      <article class="card" aria-live="polite" aria-atomic="true">
        <div class="icon"><i class="fas fa-chart-line"></i></div>
        <div class="info">
          <p class="value" id="totalSaleQty">0</p>
          <span>Total Sale Quantity</span>
        </div>
      </article>

      <article class="card" aria-live="polite" aria-atomic="true">
        <div class="icon"><i class="fas fa-rupee-sign"></i></div>
        <div class="info">
          <p class="value" id="totalSalesPrice">₹0.00</p>
          <span>Sales Price</span>
        </div>
      </article>

      <article class="card" aria-live="polite" aria-atomic="true">
        <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
        <div class="info">
          <p class="value" id="netProfit">₹0.00</p>
          <span>Net Profit</span>
        </div>
      </article>
    </section>

</main>

    <script>
        const userIcon = document.getElementById('userIcon');
    const userProfilePopup = document.getElementById('userProfilePopup');

    userIcon.addEventListener('click', () => {
      const isVisible = userProfilePopup.style.display === 'block';
      userProfilePopup.style.display = isVisible ? 'none' : 'block';
      userProfilePopup.setAttribute('aria-hidden', isVisible);
    });

    // Close popup if clicking outside
    document.addEventListener('click', (event) => {
      if (!userIcon.contains(event.target) && !userProfilePopup.contains(event.target)) {
        userProfilePopup.style.display = 'none';
        userProfilePopup.setAttribute('aria-hidden', 'true');
      }
    });
    </script>
</body>
</html>
