document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        const video = entry.target;
        if(entry.isIntersecting) {
          video.play().catch(error => {
            // Handle autoplay restrictions
            console.log('Video autoplay blocked:', error);
          });
        } else {
          video.pause();
        }
      });
    }, {
      threshold: 0.7 // Play when 70% of video is visible
    });
  
    document.querySelectorAll('.auto-play-video').forEach(video => {
      observer.observe(video);
    });
  });








  // Helper to shuffle questions
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
  }
  
  
  
  
     document.addEventListener('DOMContentLoaded', function () {})
    const quizData = [
        {
          question: "1. What is the main purpose of budgeting?",
          options: [
            "A) To manage income and expenses",
            "B) To track TV shows",
            "C) To collect stamps",
            "D) To shop online"
          ],
          answer: "A"
        },
        {
          question: "2. Which system came before the invention of money?",
          options: [
            "A) Banking system",
            "B) Barter system",
            "C) Credit system",
            "D) Cryptocurrency"
          ],
          answer: "B"
        },
        {
          question: "3. What is a major benefit of saving money?",
          options: [
            "A) Decrease in purchasing power",
            "B) Financial security",
            "C) Encourages debt",
            "D) Reduces assets"
          ],
          answer: "B"
        },
        {
          question: "4. What is Bitcoin?",
          options: [
            "A) Physical coin",
            "B) Government-issued currency",
            "C) Digital cryptocurrency",
            "D) Credit card type"
          ],
          answer: "C"
        },
        {
          question: "5. What is a common freelancing platform?",
          options: [
            "A) Netflix",
            "B) Fiverr",
            "C) Spotify",
            "D) Walmart"
          ],
          answer: "B"
        },
        {
          question: "6. What did early humans use for trade?",
          options: [
            "A) ATM cards",
            "B) Credit scores",
            "C) Goods and services",
            "D) Gold bars only"
          ],
          answer: "C"
        },
        {
          question: "7. What backs fiat money today?",
          options: [
            "A) Gold",
            "B) Silver",
            "C) Government trust",
            "D) Diamonds"
          ],
          answer: "C"
        },
        {
          question: "8. What is an example of e-commerce?",
          options: [
            "A) Shopping at a mall",
            "B) Selling products on Shopify",
            "C) Trading livestock",
            "D) Collecting taxes"
          ],
          answer: "B"
        },
        {
          question: "9. Which of these is a digital wallet?",
          options: [
            "A) Binance",
            "B) Wallet made of leather",
            "C) Filing cabinet",
            "D) Checkbook"
          ],
          answer: "A"
        },
        {
          question: "10. What is diversification in investing?",
          options: [
            "A) Investing in one stock",
            "B) Spreading investments across multiple assets",
            "C) Spending all income",
            "D) Selling everything at once"
          ],
          answer: "B"
        },
        {
          question: "11. What is KDP used for?",
          options: [
            "A) Online teaching",
            "B) Publishing books on Amazon",
            "C) Cryptocurrency mining",
            "D) Freelance web design"
          ],
          answer: "B"
        },
        {
          question: "12. What is blockchain?",
          options: [
            "A) A supermarket chain",
            "B) Technology for secure transactions",
            "C) Social media platform",
            "D) A payment gateway"
          ],
          answer: "B"
        },
        {
          question: "13. What is a key feature of a smart contract?",
          options: [
            "A) Manual approval required",
            "B) Automatically executes transactions",
            "C) Issued by banks",
            "D) Written on paper"
          ],
          answer: "B"
        },
        {
          question: "14. Which one is a cryptocurrency?",
          options: [
            "A) Ethereum",
            "B) Dollar",
            "C) Euro",
            "D) Yen"
          ],
          answer: "A"
        },
        {
          question: "15. Which item was once used as commodity money?",
          options: [
            "A) Cowry shells",
            "B) Mobile apps",
            "C) Debit cards",
            "D) Smart TVs"
          ],
          answer: "A"
        },
        {
          question: "16. What does e-commerce stand for?",
          options: [
            "A) Entertainment commerce",
            "B) Electronic commerce",
            "C) Easy commerce",
            "D) Exclusive commerce"
          ],
          answer: "B"
        },
        {
          question: "17. Who invented Bitcoin?",
          options: [
            "A) Mark Zuckerberg",
            "B) Elon Musk",
            "C) Satoshi Nakamoto",
            "D) Warren Buffet"
          ],
          answer: "C"
        },
        {
          question: "18. What is the first step in setting financial goals?",
          options: [
            "A) Spending randomly",
            "B) Identifying your priorities",
            "C) Ignoring expenses",
            "D) Canceling subscriptions"
          ],
          answer: "B"
        },
        {
          question: "19. What is inflation?",
          options: [
            "A) Increase in currency’s value",
            "B) Increase in general prices",
            "C) Reduction in money supply",
            "D) Selling assets quickly"
          ],
          answer: "B"
        },
        {
          question: "20. What platform is best for video content creators?",
          options: [
            "A) Upwork",
            "B) YouTube",
            "C) KDP",
            "D) Fiverr"
          ],
          answer: "B"
        },
        {
          question: "21. What is passive income?",
          options: [
            "A) Earnings from ongoing work",
            "B) Income without active involvement",
            "C) Emergency funds",
            "D) Loan repayments"
          ],
          answer: "B"
        },
        {
          question: "22. What is a key risk in crypto trading?",
          options: [
            "A) Stable prices",
            "B) High volatility",
            "C) Government insurance",
            "D) Fixed returns"
          ],
          answer: "B"
        },
        {
          question: "23. What does a freelancer sell?",
          options: [
            "A) Shares",
            "B) Services or skills",
            "C) Livestock",
            "D) Hardware"
          ],
          answer: "B"
        },
        {
          question: "24. What is the gold standard?",
          options: [
            "A) Money backed by silver",
            "B) Currency backed by gold",
            "C) Digital money",
            "D) Credit rating system"
          ],
          answer: "B"
        },
        {
          question: "25. What is an example of content creation?",
          options: [
            "A) Building houses",
            "B) Uploading videos on TikTok",
            "C) Opening a bank account",
            "D) Growing a garden"
          ],
          answer: "B"
        },
        {
          question: "26. What is financial literacy?",
          options: [
            "A) Knowing how to manage money wisely",
            "B) Reading books fast",
            "C) Tracking movies online",
            "D) Writing essays about banking"
          ],
          answer: "A"
        },
        {
          question: "27. Which is NOT a freelancing platform?",
          options: [
            "A) Freelancer.com",
            "B) Fiverr",
            "C) Shopify",
            "D) Upwork"
          ],
          answer: "C"
        },
        {
          question: "28. What does an online marketplace do?",
          options: [
            "A) Shares photos",
            "B) Sells goods/services online",
            "C) Provides loans only",
            "D) Conducts surveys"
          ],
          answer: "B"
        },
        {
          question: "29. What is budgeting?",
          options: [
            "A) A shopping spree",
            "B) Planning your income and expenses",
            "C) Buying stocks",
            "D) Donating all earnings"
          ],
          answer: "B"
        },
        {
          question: "30. Which is an example of Web3 innovation?",
          options: [
            "A) NFT marketplace",
            "B) Email service",
            "C) Telephone banking",
            "D) ATM withdrawals"
          ],
          answer: "A"
        },
        {
          question: "31. What is a key benefit of creating a minimum viable product (MVP) in business?",
          options: [
            "A) Launching with no customer feedback",
            "B) Minimizing initial costs and testing market demand",
            "C) Maximizing inventory before sales",
            "D) Avoiding customer interaction"
          ],
          answer: "B"
        },
        {
          question: "32. What does ROI stand for in business terms?",
          options: [
            "A) Rate of Inflation",
            "B) Return on Investment",
            "C) Return of Invoices",
            "D) Reduction of Income"
          ],
          answer: "B"
        },
        {
          question: "33. Which of the following best describes liquidity in a business context?",
          options: [
            "A) The business’s profitability",
            "B) The ease of converting assets into cash",
            "C) The number of shareholders",
            "D) The amount of borrowed capital"
          ],
          answer: "B"
        },
        {
          question: "34. What is considered a liability on a balance sheet?",
          options: [
            "A) Company’s owned equipment",
            "B) Outstanding loans and debts",
            "C) Retained earnings",
            "D) Employee salaries"
          ],
          answer: "B"
        },
        {
          question: "35. What is the purpose of a SWOT analysis?",
          options: [
            "A) Measuring daily sales",
            "B) Identifying strengths, weaknesses, opportunities, and threats",
            "C) Forecasting the next 5 years of revenue",
            "D) Setting marketing budgets"
          ],
          answer: "B"
        },
        {
          question: "36. What is equity crowdfunding?",
          options: [
            "A) A loan from a bank",
            "B) Raising capital from multiple investors online in exchange for ownership",
            "C) Investing in government bonds",
            "D) Applying for business grants"
          ],
          answer: "B"
        },
        {
          question: "37. In supply chain management, what does “just-in-time” (JIT) refer to?",
          options: [
            "A) Delivering products one year late",
            "B) Receiving goods only as they are needed",
            "C) Stockpiling goods in advance",
            "D) Selling goods before production starts"
          ],
          answer: "B"
        },
        {
          question: "38. What is the breakeven point for a business?",
          options: [
            "A) When total revenue equals total costs",
            "B) When all debts are paid",
            "C) When the business makes its first sale",
            "D) When there is no cash left"
          ],
          answer: "A"
        },
        {
          question: "39. What is venture capital?",
          options: [
            "A) Government-provided startup funds",
            "B) Funds from individual friends and family",
            "C) Investment from professional firms into high-growth startups",
            "D) Income from selling equity to customers"
          ],
          answer: "C"
        },
        {
          question: "40. What is a key characteristic of a limited liability company (LLC)?",
          options: [
            "A) Owners are personally responsible for all business debts",
            "B) Owners have limited liability and personal assets are protected",
            "C) The company does not pay taxes",
            "D) It can only be operated by one individual"
          ],
          answer: "B"
        }
      ];
      document.addEventListener('DOMContentLoaded', function () {
        const quizForm = document.getElementById('quizForm');
        const submitBtn = document.getElementById('submitBtn');
        const reattemptBtn = document.getElementById('reattemptBtn');
        const scoreDisplay = document.createElement('div');
        scoreDisplay.style.textAlign = 'center';
        scoreDisplay.style.fontWeight = 'bold';
        scoreDisplay.style.marginTop = '20px';
        quizForm.after(scoreDisplay);
      
        let originalQuizData = [...quizData]; // Use your 40-question array
        let shuffledQuiz = [];
      
        function loadQuiz() {
          quizForm.innerHTML = '';
          scoreDisplay.textContent = '';
          shuffledQuiz = shuffleArray([...originalQuizData]);
      
          shuffledQuiz.forEach((q, index) => {
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('question');
            questionDiv.innerHTML = `
              <p>${index + 1}. ${q.question.slice(q.question.indexOf(' ') + 1)}</p>
              <div class="options">
                ${q.options.map(opt => `
                  <label>
                    <input type="radio" name="q${index}" value="${opt.charAt(0)}">
                    ${opt}
                  </label>`).join('')}
              </div>
              <div class="feedback" id="feedback${index}"></div>
            `;
            quizForm.appendChild(questionDiv);
          });
        }
      
        function getAnswers() {
          return shuffledQuiz.map((_, i) => {
            const selected = document.querySelector(`input[name="q${i}"]:checked`);
            return selected ? selected.value : null;
          });
        }
      
        function showResults(answers) {
          let score = 0;
          answers.forEach((ans, i) => {
            const allOptions = document.querySelectorAll(`input[name="q${i}"]`);
            allOptions.forEach(opt => {
              if (opt.value === shuffledQuiz[i].answer) {
                opt.parentElement.classList.add('correct');
              } else if (opt.checked && opt.value !== shuffledQuiz[i].answer) {
                opt.parentElement.classList.add('incorrect');
              }
              opt.disabled = true;
            });
      
            if (ans === shuffledQuiz[i].answer) {
              score++;
            }
          });
      
          const percent = ((score / shuffledQuiz.length) * 100).toFixed(2);
          scoreDisplay.textContent = `You scored ${percent}% (${score} out of ${shuffledQuiz.length} correct)`;
        }
      
        submitBtn.addEventListener('click', () => {
          const answers = getAnswers();
          if (answers.includes(null)) {
            alert("Please answer all questions.");
            return;
          }
          showResults(answers);
          submitBtn.style.display = "none";
          reattemptBtn.style.display = "inline-block";
        });
      
        reattemptBtn.addEventListener('click', () => {
          loadQuiz();
          submitBtn.style.display = "inline-block";
          reattemptBtn.style.display = "none";
        });
      
        loadQuiz();
      });




      const addBtn = document.getElementById('addBtn');
const budgetTable = document.getElementById('budgetTable');

addBtn.addEventListener('click', () => {
  const title = document.getElementById('title').value;
  const desc = document.getElementById('description').value;
  const expense = document.getElementById('expense').value;
  const savings = document.getElementById('savings').value;

  if (!title || !desc || !expense || !savings) {
    alert("Please fill in all fields!");
    return;
  }

  const row = budgetTable.insertRow();
  row.innerHTML = `
    <td>${title}</td>
    <td>${desc}</td>
    <td>₦${parseInt(expense).toLocaleString()}</td>
    <td>₦${parseInt(savings).toLocaleString()}</td>
    <td><button class="edit" onclick="editRow(this)">✏️ Edit</button></td>
    <td><button class="delete" onclick="deleteRow(this)">🗑️ Delete</button></td>
  `;

  // Clear input fields
  document.getElementById('title').value = '';
  document.getElementById('description').value = '';
  document.getElementById('expense').value = '';
  document.getElementById('savings').value = '';
});

function deleteRow(btn) {
  const row = btn.parentElement.parentElement;
  row.remove();
}

function editRow(btn) {
  const row = btn.parentElement.parentElement;
  const cells = row.querySelectorAll('td');

  document.getElementById('title').value = cells[0].innerText;
  document.getElementById('description').value = cells[1].innerText;
  document.getElementById('expense').value = cells[2].innerText.replace(/[₦,]/g, '');
  document.getElementById('savings').value = cells[3].innerText.replace(/[₦,]/g, '');

  row.remove(); // Remove old row to be re-added as new
}

  
  