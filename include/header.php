<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
  <div class="logo"></div>
  <div class="menu-toggle">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav>
    <ul>
       <!-- Navigation Bar -->
   
        
            <li><a href="moneytimeline.php">MoneyTimeline</a></li>
            <li><a href="opportunities.php">Opportunities</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="planner.php">Planner</a></li>
            <li><a href="tracker.php">Tracker</a></li>
            <li><a href="profile.php">Profile</a></li>
     
    </ul>
   
  </nav>
  <div class="overlay"></div>
</header>
<script >

document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.menu-toggle');
  const navbar = document.querySelector('.navbar');
  const overlay = document.querySelector('.overlay');
  
  menuToggle.addEventListener('click', function() {
    // Toggle active class on navbar and overlay
    navbar.classList.toggle('active');
    overlay.classList.toggle('active');
    
    // Animate hamburger to X
    if (navbar.classList.contains('active')) {
      menuToggle.querySelector('span:nth-child(1)').style.transform = 'rotate(45deg) translate(5px, 5px)';
      menuToggle.querySelector('span:nth-child(2)').style.opacity = '0';
      menuToggle.querySelector('span:nth-child(3)').style.transform = 'rotate(-45deg) translate(7px, -6px)';
    } else {
      menuToggle.querySelector('span:nth-child(1)').style.transform = 'rotate(0) translate(0)';
      menuToggle.querySelector('span:nth-child(2)').style.opacity = '1';
      menuToggle.querySelector('span:nth-child(3)').style.transform = 'rotate(0) translate(0)';
    }
  });
  
  overlay.addEventListener('click', function() {
    // Close menu when clicking overlay
    navbar.classList.remove('active');
    overlay.classList.remove('active');
    
    // Reset hamburger animation
    menuToggle.querySelector('span:nth-child(1)').style.transform = 'rotate(0) translate(0)';
    menuToggle.querySelector('span:nth-child(2)').style.opacity = '1';
    menuToggle.querySelector('span:nth-child(3)').style.transform = 'rotate(0) translate(0)';
  });
});
</script>
</body>
</html>