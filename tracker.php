<?php



session_start();

require 'database.php';

$pdo = new PDO('mysql:host=localhost;dbname=financetracker', 'root', '');

if (!$userId) {
    header('Location: login.php');
    exit();
}
$userId = $_SESSION['user_id'] ?? null;

function getUserIncome($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT monthly_income FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

function getTotalSpent($userId, $month = null) {
    global $pdo;
    $sql = "SELECT SUM(cost) FROM expenses WHERE user_id = ?"; // Changed id to user_id
    $params = [$userId];
    
    if ($month) {
        $sql .= " AND DATE_FORMAT(date, '%Y-%m') = ?";
        $params[] = $month;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn() ?: 0;
}

function getExpenses($userId, $month = null) {
    global $pdo;
    $sql = "SELECT * FROM expenses WHERE user_id = ?"; // Changed id to user_id
    $params = [$userId];
    
    if ($month) {
        $sql .= " AND DATE_FORMAT(date, '%Y-%m') = ?";
        $params[] = $month;
    }
    
    $sql .= " ORDER BY date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpendingByCategory($userId, $month = null) {
    global $pdo;
    $sql = "SELECT category, SUM(cost) as total FROM expenses WHERE user_id = ?"; // Changed id to user_id
    $params = [$userId];
    
    if ($month) {
        $sql .= " AND DATE_FORMAT(date, '%Y-%m') = ?";
        $params[] = $month;
    }
    
    $sql .= " GROUP BY category";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get user ID from session - make sure this matches your login system



$currentMonth = date('Y-m');
$monthlyIncome = getUserIncome($userId);
$totalSpent = getTotalSpent($userId, $currentMonth);
$remainingBalance = $monthlyIncome - $totalSpent;
$expenses = getExpenses($userId, $currentMonth);
$spendingByCategory = getSpendingByCategory($userId, $currentMonth);

// Prepare data for chart
$chartLabels = [];
$chartData = [];
$chartColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];

foreach ($spendingByCategory as $category) {
    $chartLabels[] = $category['category'];
    $chartData[] = $category['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<div class="expense-tracker">
    <div class="header">
        <h2>Expense Tracker</h2>
        
        <div class="financial-summary">
            <div class="summary-item">
                <form action="update_income.php" method="post" class="income-form">
                    <label>Monthly Income</label>
                    <div class="input-group">
                        <span>$</span>
                        <input type="number" name="income" value="<?php echo $monthlyIncome; ?>" step="0.01" min="0">
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>
            <div class="summary-item">
                <label>Total Spent</label>
                <span>$<?php echo number_format($totalSpent, 2); ?></span>
            </div>
            <div class="summary-item">
                <label>Remaining Balance</label>
                <span>$<?php echo number_format($remainingBalance, 2); ?></span>
            </div>
        </div>
    </div>

    <div class="add-expense-form">
        <h3>Add New Expense</h3>
        <form action="add_expense.php" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" required>
                        <option value="Food">Food</option>
                        <option value="Transport">Transport</option>
                        <option value="Utilities">Utilities</option>
                        <option value="Education">Education</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input type="text" name="item_name" id="item_name" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="quantity">Number of Items</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
                </div>
                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="number" name="cost" id="cost" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="note">Note</label>
                <input type="text" name="note" id="note">
            </div>

            <button type="submit">Add Expense</button>
        </form>
    </div>

    <div class="spending-analysis">
        <h3>Spending Analysis</h3>
        <div class="chart-container">
            <canvas id="spendingChart"></canvas>
        </div>
    </div>

    <div class="expense-history">
        <h3>Expense History</h3>
        <?php if (empty($expenses)): ?>
            <p>No expenses recorded yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($expenses as $expense): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($expense['category']); ?></td>
                            <td><?php echo htmlspecialchars($expense['item_name']); ?></td>
                            <td><?php echo $expense['quantity']; ?></td>
                            <td>$<?php echo number_format($expense['cost'], 2); ?></td>
                            <td><?php echo htmlspecialchars($expense['note']); ?></td>
                            <td><?php echo date('M j, Y', strtotime($expense['date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
    const ctx = document.getElementById('spendingChart').getContext('2d');
    const spendingChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($chartData); ?>,
                backgroundColor: <?php echo json_encode(array_slice($chartColors, 0, count($chartLabels))); ?>,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php require_once 'includes/footer.php'; ?> 
</body>
</html>