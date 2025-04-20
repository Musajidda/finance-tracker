<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Financial Quiz</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <br>
<?php include 'include/header.php'; ?>

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


