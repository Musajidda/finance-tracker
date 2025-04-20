<?php



session_start();

require 'database.php';


$currentMonth = date('Y-m');
$currentMonth = $_GET['month'] ?? date('Y-m');


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
    *, *::before, *::after {
    box-sizing: inherit;
}


body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6f8;
    color: #333;
    box-sizing: border-box;
}
.expense-tracker {
    width: 100%;
    padding: 20px;
    background: #fff;
    box-shadow: none;
    border-radius: 0;
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
    /* Keep the summary-item box clean */
.summary-item {
    flex: 1 1 200px;
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background-color: #f9fafc;
    color: #333;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

/* Icon container */
.summary-icon {
    font-size: 20px;
    padding: 14px;
    border-radius: 50%;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Specific colors */
.icon-blue {
    background-color: #3498db;
}

.icon-orange {
    background-color: #e67e22;
}

.icon-green {
    background-color: #2ecc71;
}

.summary-content {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.summary-content label {
    font-weight: bold;
    font-size: 14px;
    color: #444;
}

.summary-content span,
.input-group {
    font-size: 18px;
}
.progress-bar-container {
    margin-top: 10px;
    width: 100%;
    background-color: #e0e0e0;
    height: 8px;
    border-radius: 20px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
   
    width: 0%;
    transition: width 0.5s ease-in-out;
}

.progress-bar.income {
    background-color: #3498db;
}

.progress-bar.spent {
    background-color: #e67e22;
}

.progress-bar.remaining {
    background-color: #2ecc71;
}
.expense-analysis-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

/* Shared card styles */
.card {
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    flex: 1;
    min-width: 200px;
}

/* Make sure the canvas inside chart doesn't overflow */
.spending-analysis .chart-container {
    max-width: 85%;
    height: 85%;
}


</style>


</head>
<body>
    <br>
<?php include 'include/header.php'; ?>

<div class="expense-tracker">
    <div class="header">
        <h2>Expense Tracker</h2>
        
        <div class="financial-summary">

<!-- Monthly Income Card -->
<div class="summary-item">
    <i class="fas fa-wallet summary-icon icon-blue"></i>
    <div class="summary-content">
        <label>Monthly Income</label>
        <form action="update_income.php" method="post" class="income-form">
            <div class="input-group">
                <span>₦</span>
                <input type="number" name="income" value="<?php echo $monthlyIncome; ?>" step="0.01" min="0">
                <button type="submit">Update</button>
            </div>
        </form>
        <div class="progress-bar-container">
            <div class="progress-bar income" style="width:100%;"></div>
        </div>
    </div>
</div>

<!-- Total Spent Card -->
<div class="summary-item">
    <i class="fas fa-money-bill-wave summary-icon icon-orange"></i>
    <div class="summary-content">
        <label>Total Spent</label>
        <span>₦<?php echo number_format($totalSpent, 2); ?></span>
        <div class="progress-bar-container">
            <div class="progress-bar spent" id="spentProgressBar"></div>
        </div>
    </div>
</div>

<!-- Remaining Balance Card -->
<div class="summary-item">
    <i class="fas fa-piggy-bank summary-icon icon-green"></i>
    <div class="summary-content">
        <label>Remaining Balance</label>
        <span>₦<?php echo number_format($remainingBalance, 2); ?></span>
        <div class="progress-bar-container">
            <div class="progress-bar remaining" id="remainingProgressBar"></div>
        </div>
    </div>
</div>

</div>

<div class="expense-analysis-row">

    <!-- Add Expense Form -->
    <div class="add-expense-form card">
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

    <!-- Spending Chart -->
    <div class="spending-analysis card">
        <h3>Spending Analysis</h3>
        <div class="chart-container">
            <canvas id="spendingChart"></canvas>
        </div>
    </div>

</div>


    <div class="month-filter">
    <form method="GET" action="tracker.php">
        <label for="month">Select Month:</label>
        <input type="month" id="month" name="month" value="<?php echo htmlspecialchars($_GET['month'] ?? date('Y-m')); ?>">
        <button type="submit">Filter</button>
    </form>
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

    <div style="margin-top: 40px;">
    
    <button type="submit" onclick="exportToPDF()">Download Expenses as PDF</button>
</div>



</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

<!-- jsPDF and autoTable plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script src="script.js"></script>
<script>
    const centerTextPlugin = {
        id: 'centerText',
        afterDraw(chart) {
            const { width, height, ctx } = chart;
            const income = <?php echo $monthlyIncome ?: 1; ?>;
            const spent = <?php echo $totalSpent ?: 0; ?>;
            const percentSpent = Math.round((spent / income) * 100);
            const text = percentSpent + "%";

            // Reset transform & styling
            ctx.save();
            ctx.font = "bold 24px Inter, sans-serif";
            ctx.fillStyle = "#333";
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";

            // Fix for high-DPI screens (Chart.js scales canvas internally)
            const { top, bottom, left, right } = chart.chartArea;
            const centerX = (left + right) / 2;
            const centerY = (top + bottom) / 2;

            ctx.fillText(text, centerX, centerY);
            ctx.restore();
        }
    };
</script>


<script>
    const ctx = document.getElementById('spendingChart').getContext('2d');
    const spendingChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($chartData); ?>,
                backgroundColor: <?php echo json_encode(array_slice($chartColors, 0, count($chartLabels))); ?>,
                borderWidth: 1
            }]
        },
        options: {
            cutout: '50%', // donut hole size
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#444',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${context.label}: ₦${value} (${percentage}%)`;
                        }
                    }
                }
            }
        },
        plugins: [centerTextPlugin]
    });
</script>




<script>
    document.addEventListener("DOMContentLoaded", () => {
        const income = <?php echo $monthlyIncome ?: 0; ?>;
        const spent = <?php echo $totalSpent ?: 0; ?>;
        const remaining = income - spent;

        const spentPercent = income > 0 ? (spent / income) * 100 : 0;
        const remainingPercent = income > 0 ? (remaining / income) * 100 : 0;

        document.getElementById("spentProgressBar").style.width = Math.min(spentPercent, 100) + "%";
        document.getElementById("remainingProgressBar").style.width = Math.min(remainingPercent, 100) + "%";
    });
</script>
<?php include 'include/footer.php'; ?>
</body>
</html>