<!DOCTYPE html>
<html lang="en">
<head>1
  <meta charset="UTF-8">
  <title>Financial Quiz</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
 <!-- Navigation Bar -->
 <nav>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="moneytimeline.php">MoneyTimeline</a></li>
            <li><a href="opportunities.php">Opportunities</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="planner.php">Planner</a></li>
            <li><a href="tracker.php">Tracker</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </nav>


  <header class="banner">
    <h1>Test Your Knowledge</h1>
    <p>Discover how far you’ve acknowledged</p>
  </header>

  <section class="answer-all-btn">
    <button id="answerAllBtn" disabled>Answer all Questions</button>
  </section>

  <form id="quizForm" class="quiz-form"></form>

  <div class="quiz-buttons">
    <button id="submitBtn">Submit</button>
    <button id="reattemptBtn" style="display:none;">Re-attempt</button>
  </div>

  <script src="script.js"></script>
  <?php include 'include/footer.php'; ?>
</body>
</html>


