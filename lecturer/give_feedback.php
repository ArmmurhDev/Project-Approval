<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Give Feedback</title>
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
            background: #f0f4f0;
            color: #1e2a1e;
            line-height: 1.5;
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
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
            --radius: 20px;
            --radius-sm: 14px;
        }

        /* Layout */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(145deg, var(--kaduna-green) 0%, #064d2a 100%);
            color: white;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 100;
            box-shadow: 2px 0 20px rgba(0,0,0,0.08);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(255,215,120,0.3);
        }

        .logo-icon {
            background: var(--kaduna-gold);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--kaduna-green);
        }

        .logo-text h2 {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .logo-text p {
            font-size: 0.7rem;
            opacity: 0.8;
        }

        .nav-menu {
            list-style: none;
            margin-top: 2rem;
        }

        .nav-item {
            margin-bottom: 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            border-radius: 50px;
            color: rgba(255,255,240,0.85);
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 500;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.2rem;
        }

        .nav-link.active, .nav-link:hover {
            background: rgba(230,160,23,0.2);
            color: var(--kaduna-gold);
            backdrop-filter: blur(4px);
        }

        /* Main content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 1.8rem 2rem;
            transition: margin 0.3s;
        }

        /* Top bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--kaduna-white);
            padding: 1rem 2rem;
            border-radius: 60px;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
            flex-wrap: wrap;
        }

        .page-title h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--kaduna-charcoal);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-weight: 600;
            background: var(--kaduna-gray);
            padding: 6px 16px;
            border-radius: 40px;
        }

        .logout-btn {
            background: rgba(192,57,43,0.1);
            color: var(--kaduna-red);
            padding: 8px 18px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: var(--kaduna-red);
            color: white;
        }

        /* Feedback Form Card */
        .feedback-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .card-header {
            background: var(--kaduna-cream);
            padding: 1.2rem 2rem;
            border-bottom: 3px solid var(--kaduna-gold);
        }

        .card-header h2 {
            color: var(--kaduna-charcoal);
            font-size: 1.4rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.8rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--kaduna-charcoal);
        }

        .form-group label .required {
            color: var(--kaduna-red);
        }

        select, textarea, input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 30px;
            border: 1px solid #ddd;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        select:focus, textarea:focus, input:focus {
            outline: none;
            border-color: var(--kaduna-gold);
            box-shadow: 0 0 0 3px rgba(230,160,23,0.1);
        }

        /* Rating Stars */
        .rating-container {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .stars {
            display: flex;
            gap: 8px;
            direction: rtl;
        }
        .stars input {
            display: none;
        }
        .stars label {
            font-size: 1.8rem;
            color: #ccc;
            cursor: pointer;
            transition: 0.1s;
        }
        .stars input:checked ~ label,
        .stars label:hover,
        .stars label:hover ~ label {
            color: var(--kaduna-gold);
        }
        .rating-value {
            margin-left: 10px;
            font-weight: 600;
            color: var(--kaduna-green);
        }

        /* Project Selector */
        .project-selector {
            background: #fafaf5;
            padding: 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
        }

        .btn-submit {
            background: var(--kaduna-green);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #064d2a;
            transform: scale(0.98);
        }

        .btn-back {
            background: #eef2ee;
            color: var(--kaduna-charcoal);
            border: none;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--kaduna-charcoal);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            display: none;
            align-items: center;
            gap: 10px;
            z-index: 1000;
        }
        .toast.success { background: var(--kaduna-green); }
        .toast.error { background: var(--kaduna-red); }

        .mobile-menu-toggle {
            display: none;
            background: var(--kaduna-green);
            color: white;
            border: none;
            font-size: 1.5rem;
            padding: 8px 16px;
            border-radius: 30px;
            margin-bottom: 1rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .mobile-menu-toggle {
                display: inline-block;
            }
        }

        @media (max-width: 640px) {
            .main-content {
                padding: 1rem;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .card-body {
                padding: 1.2rem;
            }
            .btn-submit, .btn-back {
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }
            .rating-container {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .footer-note {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            color: #6f7e6f;
        }
    </style>
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-icon"><i class="fas fa-comment-dots"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="lecturer_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="assigned_projects.html" class="nav-link"><i class="fas fa-clipboard-list"></i> Assigned Projects</a></li>
            <li class="nav-item"><a href="review_project.html" class="nav-link"><i class="fas fa-edit"></i> Review</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-comment"></i> Give Feedback</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-comment-dots"></i> Give Feedback</h1>
                <p>Provide constructive feedback on student projects</p>
            </div>
            <div class="user-profile">
                <span class="user-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="feedback-card">
            <div class="card-header">
                <h2><i class="fas fa-pen-fancy"></i> Student Project Feedback</h2>
            </div>
            <div class="card-body">
                <!-- Project Selection -->
                <div class="project-selector">
                    <div class="form-group" style="margin-bottom:0;">
                        <label>Select Project <span class="required">*</span></label>
                        <select id="projectSelect">
                            <option value="">-- Choose a project --</option>
                            <option value="P001">AI-Powered Crop Disease Detection - Amina Bello (KP/CS/2022/001)</option>
                            <option value="P002">Blockchain for Student Records - Ibrahim Musa (KP/CS/2022/045)</option>
                            <option value="P003">IoT Water Quality Monitor - Fatima Sani (KP/CE/2023/012)</option>
                        </select>
                    </div>
                </div>

                <form id="feedbackForm">
                    <div class="form-group">
                        <label>Feedback Title <span class="required">*</span></label>
                        <input type="text" id="feedbackTitle" placeholder="e.g., Methodology Review, Literature Feedback, etc.">
                    </div>

                    <div class="form-group">
                        <label>Rating (Overall Quality) <span class="required">*</span></label>
                        <div class="rating-container">
                            <div class="stars">
                                <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="fas fa-star"></label>
                            </div>
                            <span class="rating-value" id="ratingValue">Not rated</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Detailed Feedback <span class="required">*</span></label>
                        <textarea id="feedbackText" rows="5" placeholder="Provide specific, actionable feedback for the student..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Suggestions for Improvement</label>
                        <textarea id="suggestions" rows="3" placeholder="Optional: Suggest resources, references, or next steps..."></textarea>
                    </div>

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button type="button" class="btn-submit" id="submitFeedbackBtn"><i class="fas fa-paper-plane"></i> Submit Feedback</button>
                        <button type="reset" class="btn-back" id="resetBtn"><i class="fas fa-undo-alt"></i> Clear Form</button>
                        <a href="assigned_projects.html" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Constructive Feedback Portal
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Star rating display
    const stars = document.querySelectorAll('.stars input');
    const ratingSpan = document.getElementById('ratingValue');
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const val = this.value;
            ratingSpan.innerText = val + ' / 5';
        });
    });

    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");
        const msgSpan = document.getElementById("toastMsg");
        msgSpan.innerText = message;
        toast.className = `toast ${type}`;
        toast.style.display = "flex";
        setTimeout(() => {
            toast.style.display = "none";
        }, 3000);
    }

    function validateForm() {
        const project = document.getElementById("projectSelect").value;
        const title = document.getElementById("feedbackTitle").value.trim();
        const rating = document.querySelector('input[name="rating"]:checked');
        const feedback = document.getElementById("feedbackText").value.trim();
        if (!project) {
            alert("Please select a project.");
            return false;
        }
        if (!title) {
            alert("Please enter a feedback title.");
            return false;
        }
        if (!rating) {
            alert("Please provide a rating.");
            return false;
        }
        if (!feedback) {
            alert("Please enter detailed feedback.");
            return false;
        }
        return true;
    }

    function submitFeedback() {
        if (!validateForm()) return;
        
        const projectSelect = document.getElementById("projectSelect");
        const projectText = projectSelect.options[projectSelect.selectedIndex]?.text || "";
        const title = document.getElementById("feedbackTitle").value;
        const rating = document.querySelector('input[name="rating"]:checked').value;
        const feedback = document.getElementById("feedbackText").value;
        const suggestions = document.getElementById("suggestions").value;
        
        // Simulate API call
        console.log({ project: projectText, title, rating, feedback, suggestions });
        showToast(`Feedback submitted for "${projectText.substring(0, 40)}..."`, "success");
        
        // Optionally reset form after submission
        document.getElementById("feedbackForm").reset();
        ratingSpan.innerText = "Not rated";
        // Clear rating stars visually
        document.querySelectorAll('.stars input').forEach(inp => inp.checked = false);
    }

    document.getElementById("submitFeedbackBtn").addEventListener("click", submitFeedback);
    document.getElementById("resetBtn").addEventListener("click", () => {
        document.getElementById("feedbackForm").reset();
        ratingSpan.innerText = "Not rated";
        document.querySelectorAll('.stars input').forEach(inp => inp.checked = false);
    });

    // Logout demo
    function logoutDemo() { alert("Logged out – redirect to login page."); }
    document.getElementById("logoutLink")?.addEventListener("click", (e) => { e.preventDefault(); logoutDemo(); });
    document.getElementById("logoutTop")?.addEventListener("click", (e) => { e.preventDefault(); logoutDemo(); });

    // Mobile sidebar toggle
    const toggleBtn = document.getElementById("mobileToggle");
    const sidebar = document.getElementById("sidebar");
    toggleBtn.addEventListener("click", () => sidebar.classList.toggle("open"));
    document.addEventListener("click", function(e) {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
        }
    });
</script>
</body>
</html>