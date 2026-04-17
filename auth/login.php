<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Student Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4f0 0%, #e2e8e0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* Kaduna Polytechnic Colour Scheme */
        :root {
            --kaduna-green: #0a5c36;
            --kaduna-green-light: #2a7a4a;
            --kaduna-gold: #e6a017;
            --kaduna-gold-dark: #c47d0c;
            --kaduna-red: #c0392b;
            --kaduna-cream: #fef9e6;
            --kaduna-charcoal: #2c3e2c;
            --kaduna-white: #ffffff;
            --kaduna-gray: #e8ece8;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.05);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.12);
            --shadow-lg: 0 16px 32px rgba(0,0,0,0.1);
            --radius: 28px;
            --radius-sm: 16px;
        }

        .login-container {
            max-width: 440px;
            width: 100%;
            background: var(--kaduna-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Header with Logo */
        .login-header {
            background: linear-gradient(145deg, var(--kaduna-green) 0%, #064d2a 100%);
            padding: 2rem 1.5rem;
            text-align: center;
            color: white;
        }

        .logo-icon {
            background: var(--kaduna-gold);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2.2rem;
            color: var(--kaduna-green);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .login-header p {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-top: 0.25rem;
        }

        /* Form Body */
        .login-body {
            padding: 2rem 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--kaduna-charcoal);
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa89a;
            font-size: 1rem;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 1.5px solid #e2e8e0;
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: var(--kaduna-white);
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--kaduna-gold);
            box-shadow: 0 0 0 3px rgba(230,160,23,0.15);
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9aa89a;
        }

        /* Button */
        .login-btn {
            width: 100%;
            background: var(--kaduna-green);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 0.5rem;
        }

        .login-btn:hover {
            background: #064d2a;
            transform: scale(0.98);
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.2rem;
            font-size: 0.85rem;
        }
        .links a {
            color: var(--kaduna-gold-dark);
            text-decoration: none;
            font-weight: 500;
        }
        .links a:hover {
            text-decoration: underline;
        }

        /* Demo Info */
        .demo-info {
            background: #fef9e6;
            border-radius: var(--radius-sm);
            padding: 0.8rem;
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.7rem;
            border-left: 4px solid var(--kaduna-gold);
            color: #7a6a3a;
        }
        .demo-info i {
            margin-right: 6px;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--kaduna-charcoal);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            display: none;
            align-items: center;
            gap: 8px;
            z-index: 1000;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        .toast.error { background: var(--kaduna-red); }
        .toast.success { background: var(--kaduna-green); }

        /* Responsive */
        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }
            .login-body {
                padding: 1.5rem;
            }
            .links {
                flex-direction: column;
                gap: 0.8rem;
                text-align: center;
            }
            .toast {
                white-space: normal;
                text-align: center;
                max-width: 90%;
            }
        }
        .footer-note {
            text-align: center;
            padding: 1rem;
            font-size: 0.7rem;
            color: #8a9a8a;
            border-top: 1px solid #eef2ee;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <div class="logo-icon">
            <i class="fas fa-check-double"></i>
        </div>
        <h1>Topic Verifier</h1>
        <p>Automated Project Approval System</p>
        <p style="font-size: 0.7rem; margin-top: 6px;">Kaduna Polytechnic</p>
    </div>

    <div class="login-body">
        <form id="loginForm">
            <div class="form-group">
                <label>Email or Registration Number</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="text" id="username" placeholder="student@kadpoly.edu.ng or KP/CS/2022/001" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" placeholder="Enter your password">
                    <i class="fas fa-eye-slash toggle-password" id="togglePassword"></i>
                </div>
            </div>

            <button type="submit" class="login-btn"><i class="fas fa-arrow-right-to-bracket"></i> Sign In</button>
        </form>

        <div class="links">
            <a href="sign_up.html"><i class="fas fa-user-plus"></i> Create Account</a>
            <a href="reset_password.html"><i class="fas fa-key"></i> Forgot Password?</a>
        </div>

        <div class="demo-info">
            <i class="fas fa-info-circle"></i> Demo: any email/reg number + any password → Student Dashboard
        </div>
    </div>
    <div class="footer-note">
        <i class="fas fa-shield-alt"></i> Secure portal for project submission & review
    </div>
</div>

<div id="toast" class="toast"><i class="fas fa-exclamation-triangle"></i> <span id="toastMsg"></span></div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    function showToast(message, type = 'error') {
        const toast = document.getElementById('toast');
        const msgSpan = document.getElementById('toastMsg');
        msgSpan.innerText = message;
        toast.className = `toast ${type}`;
        toast.style.display = 'flex';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!username || !password) {
            showToast('Please enter both username/reg number and password', 'error');
            return;
        }

        // Simulate login - redirect to student dashboard (no role selection)
        showToast('Login successful! Redirecting to dashboard...', 'success');
        setTimeout(() => {
            window.location.href = 'student_dashboard.html';
        }, 1000);
    });
</script>
</body>
</html>