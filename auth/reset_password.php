<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Reset Password</title>
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

        .reset-container {
            max-width: 460px;
            width: 100%;
            background: var(--kaduna-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Header with Logo */
        .reset-header {
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
            font-size: 2rem;
            color: var(--kaduna-green);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .reset-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .reset-header p {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-top: 0.25rem;
        }

        /* Form Body */
        .reset-body {
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

        /* Button */
        .reset-btn {
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

        .reset-btn:hover {
            background: #064d2a;
            transform: scale(0.98);
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .back-link a {
            color: var(--kaduna-gold-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-link a:hover {
            text-decoration: underline;
        }

        /* Info Box */
        .info-box {
            background: #fef9e6;
            border-radius: var(--radius-sm);
            padding: 1rem;
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.75rem;
            border-left: 4px solid var(--kaduna-gold);
            color: #7a6a3a;
        }
        .info-box i {
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
            .reset-body {
                padding: 1.5rem;
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
<div class="reset-container">
    <div class="reset-header">
        <div class="logo-icon">
            <i class="fas fa-key"></i>
        </div>
        <h1>Reset Password</h1>
        <p>We'll send you a link to reset your password</p>
    </div>

    <div class="reset-body">
        <form id="resetForm">
            <div class="form-group">
                <label>Email Address or Registration Number</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="text" id="userIdentity" placeholder="e.g., student@kadpoly.edu.ng or KP/CS/2022/001" autocomplete="off">
                </div>
            </div>

            <button type="submit" class="reset-btn"><i class="fas fa-paper-plane"></i> Send Reset Link</button>
        </form>

        <div class="back-link">
            <a href="login.html"><i class="fas fa-arrow-left"></i> Back to Login</a>
        </div>

        <div class="info-box">
            <i class="fas fa-info-circle"></i> Enter your registered email or registration number. 
            A password reset link will be sent to your email address.
        </div>
    </div>
    <div class="footer-note">
        <i class="fas fa-shield-alt"></i> Topic Verifier — Secure Password Recovery
    </div>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    function showToast(message, type = 'error') {
        const toast = document.getElementById('toast');
        const msgSpan = document.getElementById('toastMsg');
        msgSpan.innerText = message;
        toast.className = `toast ${type}`;
        toast.style.display = 'flex';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 4000);
    }

    document.getElementById('resetForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const identity = document.getElementById('userIdentity').value.trim();
        
        if (!identity) {
            showToast('Please enter your email or registration number.', 'error');
            return;
        }
        
        // Simulate sending reset link
        showToast(`Reset link sent to your email (demo). Check your inbox.`, 'success');
        
        // In a real implementation, you would send an AJAX request to the server
        // to verify the identity and send an email with a reset token.
        
        // Optionally clear form after success
        document.getElementById('userIdentity').value = '';
    });
</script>
</body>
</html>