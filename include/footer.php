<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-main">
            <div class="footer-brand">
                <h3 class="footer-heading">Intelligence Finance Management System</h3>
                <p class="footer-tagline">Empowering Financial Decisions Through AI-Driven Insights</p>
            </div>
            
            <div class="footer-sections">
                <div class="footer-column">
                    <h4 class="footer-title">Solutions</h4>
                    <ul class="footer-links">
                        <li><a href="#">Personal Finance</a></li>
                        <li><a href="#">Business Analytics</a></li>
                        <li><a href="#">Investment Strategies</a></li>
                        <li><a href="#">Risk Management</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4 class="footer-title">Company</h4>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Partners</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4 class="footer-title">Contact</h4>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Financial Street, Katsina 10001</li>
                        <li><i class="fas fa-phone"></i> +234 8062365769</li>
                        <li><i class="fas fa-envelope"></i> support@intelfinance.com</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                &copy; 2024 Intelligence Finance Management System. All rights reserved.
            </div>
            <div class="legal-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Settings</a>
            </div>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background: #1a1e26;
    color: #ffffff;
    padding: 4rem 0 0;
    margin-top: 5rem;
    border-top: 3px solid #27ae60;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.footer-main {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 3rem;
    padding-bottom: 3rem;
}

.footer-brand {
    padding-right: 2rem;
}

.footer-heading {
    font-size: 1.8rem;
    color: #27ae60;
    margin-bottom: 1rem;
    font-weight: 600;
}

.footer-tagline {
    color: #a0aec0;
    line-height: 1.6;
    font-size: 0.95rem;
}

.footer-sections {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.footer-title {
    font-size: 1.1rem;
    color: #27ae60;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: #cbd5e0;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #27ae60;
}

.footer-contact li {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    color: #cbd5e0;
}

.footer-contact .fas {
    color: #27ae60;
    width: 20px;
}

.footer-bottom {
    border-top: 1px solid #2d3748;
    padding: 2rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.copyright {
    color: #718096;
    font-size: 0.9rem;
}

.legal-links a {
    color: #cbd5e0;
    text-decoration: none;
    margin-left: 2rem;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.legal-links a:hover {
    color: #27ae60;
}

@media (max-width: 768px) {
    .footer-main {
        grid-template-columns: 1fr;
    }
    
    .footer-sections {
        grid-template-columns: 1fr;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .legal-links a {
        margin: 0 1rem;
    }
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>