function addExpense() {
    const category = document.getElementById('category').value;
    const items = document.getElementById('items').value;
    const cost = document.getElementById('cost').value;
    const remaining = document.getElementById('remaining').value;

    if (!category || !items || !cost || !remaining) {
      alert("Please fill in all fields.");
      return;
    }

    const table = document.getElementById('expense-table');
    const row = table.insertRow();
    row.innerHTML = `
      <td>${category}</td>
      <td>${items}</td>
      <td>₦${cost}</td>
      <td>₦${remaining}</td>
    `;

    // Clear form fields
    document.getElementById('category').value = '';
    document.getElementById('items').value = '';
    document.getElementById('cost').value = '';
    document.getElementById('remaining').value = '';
  }

  function downloadPDF() {
    const element = document.getElementById('pdf-content');
    html2pdf().from(element).save("Expense_Tracker.pdf");
  }
  