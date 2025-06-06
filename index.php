<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Intelligent Finance Management System</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <div class="logo"> <!-- Insert Logo Image Here --> </div>
        <nav class="navbar">
            <ul>
                <li><a href="#">Financial Education</a></li>
                <li><a href="#">Money Management</a></li>
                <li><a href="#">Budgeting</a></li>
            </ul>
        </nav>
        <div class="auth-links">
            <a href="login.php" class="login">Log in</a>
            <a href="signup.php" class="signup">Sign Up</a>
        </div>
    </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>Welcome to Intelligent Finance Management System</h1>
      <p>Financial literacy is the foundation of smart money management. Understanding how money works—its history, earning potential, and management strategies.</p>
      <button class="cta-button" onclick="window.location.href='login.php'">Start Learning Today</button>
      <div class="testimonial">
        <img src="assets/images/emily.png" alt="Emily Johnson">
        <div class="testimonial-text">
          <p>“The Intelligent Finance Management System has transformed my understanding of money management. The insights are invaluable!”</p>
          <strong>Emily Johnson - Financial Enthusiast</strong>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section class="how-it-works" style="text-align: center; font-size: large;">
    <h1 style="font-size: larger;">How Intelligent Finance Management System Works</h1>
    <p class="subtitle"><p>Transform your financial journey with ease using Intelligent Finance Management System</p>
    </section>
    <section class="features">
    <div class="features">
      <div class="feature"><div class="circle">1</div><h3>Enhance Your Financial Literacy</h3><p>Access curated educational resources that empower you with knowledge about money management and investment opportunities.</p></div>
      <div class="feature"><div class="circle">2</div><h3>Customize Your Financial Goals</h3><p>Define your financial aspirations and set personalized budget plans that align with your unique lifestyle and priorities.</p></div>
      <div class="feature"><div class="circle">3</div><h3>Monitor Your Spending Patterns</h3><p>Utilize our intuitive tracking tools to analyze your expenditures, helping you make informed financial decisions.</p></div>
      <div class="feature"><div class="circle">4</div><h3>Weekly Report</h3><p>Get automatically generated reports with spending insights and trends.</p></div>
    </div>
  </section>

  <!-- Knowledge Section -->
  <section class="financial-knowledge ">
    <div class="image-container"><img src="assets/images/man.png" alt="Finance Management"></div>
    <div class="content">
      <h2>Elevate Your Financial Knowledge to the Highest Level</h2>
      <p>Transform your financial journey with our cutting-edge platform designed to enhance your understanding of money and budgeting.</p>
      <ul>
        <li>✅ Tailor your financial goals with personalized budgeting tools to fit your lifestyle.</li>
        <li>✅ Monitor your spending habits with intuitive tracking features to make better decisions.</li>
        <li>✅ Access a wealth of educational resources to boost your financial literacy and investment skills.</li>
      </ul>
      <button class="cta-button" onclick="window.location.href='login.php'">Start Your Journey Today</button>
      <div class="testimonial">
        <img src="assets/images/daniel.png" alt="Daniel K.">
        <div>
          <p>“As a small business owner, my personal and business finances often felt tangled. Using this platform, I've been able to separate my personal goals from business objectives effectively.”</p>
          <strong>By Daniel K., <span class="highlight">Small Business Owner</span></strong>
        </div>
      </div>
    </div>
  </section>

  <!-- Quiz Section -->
  <section class="quiz-section">
    <div class="quiz-text">
      <h3>Finance <br><strong>Knowledge Quiz</strong></h3>
      <p>Test your financial literacy <br>
      and sharpen your <br>understanding of money<br> management with our <br>interactive Multiple-Choice<br> Questions (MCQs) section.</p>
      <button class="cta-button" onclick="window.location.href='quiz.php'">Try it.</button>
    </div>
    <div class="quiz-image">
      <img src="assets/images/qa.png" alt="Questions and Answers">
    </div>
  </section>

   <!-- Services Section -->
   <section class="services-section">
    <div class="service image">
        <!-- INSERT service image -->
        <img src="assets/images/services.png" alt="service">
    </div>
    <div class="services-cards">
        <div class="service-card">
            <!-- INSERT your icon/image here -->
            <img src="assets/images/income.png" alt="Earn and Learn">
            <p>Earn and Learn</p>
        </div>
        <div class="service-card">
            <img src="assets/images/budget.png" alt="Budget as You Earn">
            <p>Budget as You Earn</p>
        </div>
        <div class="service-card">
            <img src="assets/images/goals.png" alt="Track Your Spending">
            <p>Track Your Spending</p>
        </div>
    </div>
    <div class="services-text">
        <h2>Discover Latest Finance Trends</h2>
        <p>Stay informed with cutting-edge insights on modern financial strategies, emerging technologies like digital currencies, and practical tips to help you navigate the evolving world of personal and business finance confidently.</p>
      </div>
    </section>
</section>

<div class="services-container">
    <div class="service-card">
        <img src="assets/images/decentralized.png" alt="Decentralized Currency">
        <h3>Decentralized Currency</h3>
        <p>Explore the revolutionary world of cryptocurrency and how digital assets are shaping the future of finance.</p>
    </div>
    <div class="service-card">
        <img src="assets/images/digital.png" alt="Digital Marketing">
        <h3>Digital Marketing</h3>
        <p>Unlock the power of digital marketing to grow your online brand and reach audiences effectively.</p>
    </div>
    <div class="service-card">
        <img src="assets/images/freelance.png" alt="Freelancing">
        <h3>Freelancing</h3>
        <p>Discover how freelancing empowers you to work independently and build multiple income streams.</p>
    </div>
</div>

<!-- Banner Section (Full Image) -->
<div class="banner-section">
    <img src="assets/images/companion.png" alt="Your Trusted Financial Companion">
</div>



<?php include 'include/footer.php'; ?>

  <script src="main.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const navbar = document.querySelector('.navbar');
  const overlay = document.querySelector('.overlay');
  
  menuToggle.addEventListener('click', function() {
    this.classList.toggle('active');
    navbar.classList.toggle('active');
    overlay.classList.toggle('active');
  });
  
  overlay.addEventListener('click', function() {
    this.classList.remove('active');
    menuToggle.classList.remove('active');
    navbar.classList.remove('active');
  });
});
  </script>
</body>
</html>
