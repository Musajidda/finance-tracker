function startJourney() {
  alert("🚀 Welcome to the Intelligent Finance Management System! Let's start your journey!");
}

function signUpUser() {
  let newEmail = prompt("Enter your new email:");
  if (!newEmail) {
    alert("❌ Email is required!");
    return;
  }

  let newPassword = prompt("Create a new password:");
  if (!newPassword) {
    alert("❌ Password is required!");
    return;
  }

  localStorage.setItem("email", newEmail);
  localStorage.setItem("password", newPassword);

  alert("✅ Sign-up successful! You can now log in.");
}

function loginUser() {
  let email = prompt("Enter your email:");
  let password = prompt("Enter your password:");

  let storedEmail = localStorage.getItem("email");
  let storedPassword = localStorage.getItem("password");

  if (!storedEmail || !storedPassword) {
    alert("⚠️ No account found. Please sign up first.");
    return;
  }

  if (email === storedEmail && password === storedPassword) {
    alert("✅ Login successful! Welcome back, " + email);
  } else {
    alert("❌ Incorrect email or password. Try again.");
  }
}

function startQuiz() {
  alert("Quiz feature coming soon! 🚀");
}

window.addEventListener('scroll', () => {
  document.querySelectorAll('.fade-in, .testimonial').forEach(section => {
    if (section.getBoundingClientRect().top < window.innerHeight - 100) {
      section.classList.add('show');
    }
  });
});
