<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Sign Up</title>
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

        .signup-container {
            max-width: 520px;
            width: 100%;
            background: var(--kaduna-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Header with Logo */
        .signup-header {
            background: linear-gradient(145deg, var(--kaduna-green) 0%, #064d2a 100%);
            padding: 1.8rem 1.5rem;
            text-align: center;
            color: white;
        }

        .logo-icon {
            background: var(--kaduna-gold);
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.8rem;
            font-size: 2rem;
            color: var(--kaduna-green);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .signup-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .signup-header p {
            font-size: 0.8rem;
            opacity: 0.85;
            margin-top: 0.25rem;
        }

        /* Form Body */
        .signup-body {
            padding: 2rem 1.8rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: var(--kaduna-charcoal);
            font-size: 0.85rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa89a;
            font-size: 0.9rem;
        }

        .input-wrapper input, 
        .input-wrapper select {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1.5px solid #e2e8e0;
            border-radius: 60px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: var(--kaduna-white);
            appearance: none;
        }

        .input-wrapper select {
            padding: 12px 12px 12px 40px;
            cursor: pointer;
        }

        .input-wrapper input:focus, 
        .input-wrapper select:focus {
            outline: none;
            border-color: var(--kaduna-gold);
            box-shadow: 0 0 0 3px rgba(230,160,23,0.15);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9aa89a;
        }

        /* Password strength */
        .password-strength {
            margin-top: 6px;
            font-size: 0.7rem;
        }
        .strength-bar {
            height: 4px;
            background: #e2e8e0;
            border-radius: 4px;
            margin-top: 6px;
            width: 100%;
            transition: 0.2s;
        }
        .strength-bar-fill {
            height: 100%;
            border-radius: 4px;
            width: 0%;
            transition: 0.2s;
        }

        /* Button */
        .signup-btn {
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

        .signup-btn:hover {
            background: #064d2a;
            transform: scale(0.98);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
        }
        .login-link a {
            color: var(--kaduna-gold-dark);
            text-decoration: none;
            font-weight: 600;
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
        @media (max-width: 520px) {
            body {
                padding: 1rem;
            }
            .signup-body {
                padding: 1.5rem;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
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
<div class="signup-container">
    <div class="signup-header">
        <div class="logo-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <h1>Create Account</h1>
        <p>Join Topic Verifier — Kaduna Polytechnic</p>
    </div>

    <div class="signup-body">
        <form id="signupForm">
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="fullName" placeholder="e.g., Amina Bello" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label>Registration No. *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-id-card"></i>
                        <input type="text" id="regNo" placeholder="e.g., KP/CS/2022/001">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Email Address *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" placeholder="student@kadpoly.edu.ng">
                    </div>
                </div>
                <div class="form-group">
                    <label>Phone (Optional)</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" placeholder="0803 123 4567">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Department *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-building"></i>
                        <select id="department">
                            <option value="">Select Department</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Cyber Security">Cyber Security</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Level *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-graduation-cap"></i>
                        <select id="level">
                            <option value="">Select Level</option>
                            <option>ND1</option><option>ND2</option><option>HND1</option><option>HND2</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Password *</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" placeholder="Create a strong password">
                    <i class="fas fa-eye-slash toggle-password" data-target="password"></i>
                </div>
                <div class="password-strength">
                    <div class="strength-bar"><div class="strength-bar-fill" id="strengthFill"></div></div>
                    <span id="strengthText" style="font-size:0.7rem;">Password strength</span>
                </div>
            </div>

            <div class="form-group">
                <label>Confirm Password *</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="confirmPassword" placeholder="Confirm your password">
                    <i class="fas fa-eye-slash toggle-password" data-target="confirmPassword"></i>
                </div>
            </div>

            <button type="submit" class="signup-btn"><i class="fas fa-user-check"></i> Register Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.html">Sign in here</a>
        </div>
    </div>
    <div class="footer-note">
        <i class="fas fa-shield-alt"></i> Your data is secure with us
    </div>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Password strength checker
    const passwordInput = document.getElementById('password');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');

    function checkStrength(pw) {
        let strength = 0;
        if (pw.length >= 6) strength++;
        if (pw.length >= 10) strength++;
        if (/[A-Z]/.test(pw)) strength++;
        if (/[0-9]/.test(pw)) strength++;
        if (/[^A-Za-z0-9]/.test(pw)) strength++;
        return Math.min(strength, 4);
    }

    passwordInput.addEventListener('input', function() {
        const val = this.value;
        const strengthLevel = checkStrength(val);
        const percent = (strengthLevel / 4) * 100;
        strengthFill.style.width = percent + '%';
        if (strengthLevel === 0) {
            strengthFill.style.background = '#e2e8e0';
            strengthText.innerText = 'Very weak';
        } else if (strengthLevel === 1) {
            strengthFill.style.background = '#e6a017';
            strengthText.innerText = 'Weak';
        } else if (strengthLevel === 2) {
            strengthFill.style.background = '#e6a017';
            strengthText.innerText = 'Fair';
        } else if (strengthLevel === 3) {
            strengthFill.style.background = '#2a7a4a';
            strengthText.innerText = 'Good';
        } else {
            strengthFill.style.background = '#0a5c36';
            strengthText.innerText = 'Strong';
        }
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
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

    document.getElementById('signupForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const fullName = document.getElementById('fullName').value.trim();
        const regNo = document.getElementById('regNo').value.trim();
        const email = document.getElementById('email').value.trim();
        const department = document.getElementById('department').value;
        const level = document.getElementById('level').value;
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirmPassword').value;

        if (!fullName || !regNo || !email || !department || !level) {
            showToast('Please fill all required fields.', 'error');
            return;
        }
        if (password !== confirm) {
            showToast('Passwords do not match.', 'error');
            return;
        }
        if (password.length < 6) {
            showToast('Password must be at least 6 characters.', 'error');
            return;
        }
        // Simple email validation
        if (!email.includes('@') || !email.includes('.')) {
            showToast('Enter a valid email address.', 'error');
            return;
        }
        // Simulate registration success
        showToast('Account created successfully! Redirecting to login...', 'success');
        // In real implementation, send data to server
        setTimeout(() => {
            window.location.href = 'login.html';
        }, 1500);
    });
</script>
</body>
</html>