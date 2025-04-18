<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Budget Your Way</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

 <!-- Navigation Bar -->
 <nav>
        <ul>
            
            <li><a href="moneytimeline.php">MoneyTimeline</a></li>
            <li><a href="opportunities.php">Opportunities</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="planner.php">Planner</a></li>
            <li><a href="tracker.php">Tracker</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </nav>

  <div class="container1">
    <h1>Budget Your Way</h1>
    <button class="main-btn">Set how much you wish to spend/save</button>

    <section class="planner">
      <h2>BUDGET PLANNER</h2>
      <table class="input-table">
        <tr>
          <th>TITLE</th>
          <th>DESCRIPTION</th>
          <th>DESIRED EXPENSE</th>
          <th>DESIRED SAVINGS</th>
          <th><button id="addBtn">➕ ADD</button></th>
        </tr>
        <tr>
          <td><input id="title" type="text"></td>
          <td><input id="description" type="text"></td>
          <td><input id="expense" type="number"></td>
          <td><input id="savings" type="number"></td>
          <td></td>
        </tr>
      </table>
    </section>

    <section class="planned">
      <h2>BUDGET PLANNED</h2>
      <table class="budget-table" id="budgetTable">
        <tr>
          <th>TITLE</th>
          <th>DESCRIPTION</th>
          <th>DESIRED EXPENSE</th>
          <th>DESIRED SAVINGS</th>
          <th>EDIT</th>
          <th>DELETE</th>
        </tr>
      </table>
    </section>
  </div>

  <script src="script.js"></script>
</body>
</html>
