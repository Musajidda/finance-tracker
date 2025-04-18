<?php



session_start();

require 'database.php';




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
    <!-- Inside <head> -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f6f8;
        color: #333;
    }

    .expense-tracker {
        max-width: 1100px;
        margin: 40px auto;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .header h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .financial-summary {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .summary-item {
        flex: 1 1 200px;
        padding: 20px;
        background-color: #f9fafc;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    }

    .summary-item label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
        color: #444;
    }

    .summary-item span,
    .input-group {
        font-size: 18px;
    }

    .income-form .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .income-form input {
        width: 100px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .income-form button {
        padding: 5px 10px;
        background-color: #1abc9c;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    .income-form button:hover {
        background-color: #16a085;
    }

    h3 {
        margin-top: 40px;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .add-expense-form,
    .spending-analysis,
    .expense-history {
        margin-bottom: 30px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    button[type="submit"]:hover {
        background-color: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    table th, table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f5f5f5;
    }

    .chart-container {
        max-width: 600px;
        margin: 0 auto;
    }

    @media screen and (max-width: 768px) {
        .financial-summary {
            flex-direction: column;
        }

        .form-row {
            flex-direction: column;
        }

        .chart-container {
            width: 100%;
        }
    }
</style>

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
                        <span>₦</span>
                        <input type="number" name="income" value="<?php echo $monthlyIncome; ?>" step="0.01" min="0">
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>
            <div class="summary-item">
                <label>Total Spent</label>
                <span>₦<?php echo number_format($totalSpent, 2); ?></span>
            </div>
            <div class="summary-item">
                <label>Remaining Balance</label>
                <span>₦<?php echo number_format($remainingBalance, 2); ?></span>
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
                            <td>₦<?php echo number_format($expense['cost'], 2); ?></td>
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
<?php include 'include/footer.php'; ?>
</body>
</html>