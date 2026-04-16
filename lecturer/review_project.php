<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Review Project</title>
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

        /* Project Details Card */
        .project-card {
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

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            background: #fafaf5;
            padding: 1rem;
            border-radius: var(--radius-sm);
        }

        .info-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #7a8a7a;
            letter-spacing: 1px;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--kaduna-charcoal);
            margin-top: 6px;
            word-break: break-word;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        /* Review Form */
        .review-section {
            background: var(--kaduna-cream);
            padding: 1.5rem;
            border-radius: var(--radius);
            margin-top: 1rem;
        }

        .review-section h3 {
            margin-bottom: 1rem;
            color: var(--kaduna-charcoal);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        select, textarea {
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            border: 1px solid #ccc;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .btn-submit {
            background: var(--kaduna-green);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 700;
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
            padding: 12px 28px;
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
            .info-grid {
                grid-template-columns: 1fr;
            }
            .review-section {
                padding: 1rem;
            }
            .btn-submit, .btn-back {
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
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
            <div class="logo-icon"><i class="fas fa-star-of-life"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="lecturer_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="assigned_projects.html" class="nav-link"><i class="fas fa-clipboard-list"></i> Assigned Projects</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-edit"></i> Review Project</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-edit"></i> Review Project</h1>
                <p>Evaluate project proposal and submit recommendation</p>
            </div>
            <div class="user-profile">
                <span class="user-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <!-- Project Details Card (dynamic) -->
        <div class="project-card" id="projectCard">
            <div class="card-header">
                <h2 id="projectTitle">Loading...</h2>
            </div>
            <div class="card-body">
                <div class="info-grid" id="infoGrid"></div>

                <!-- Review Form -->
                <div class="review-section">
                    <h3><i class="fas fa-comment-dots"></i> Submit Your Review</h3>
                    <div class="form-group">
                        <label>Recommendation *</label>
                        <select id="recommendation">
                            <option value="approve">✅ Approve – Topic is novel and feasible</option>
                            <option value="reject">❌ Reject – Topic unsuitable or duplicated</option>
                            <option value="revise">🔄 Request Revision – Needs modifications</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Feedback / Comments *</label>
                        <textarea id="comments" rows="4" placeholder="Provide detailed feedback for the student..."></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button class="btn-submit" id="submitReviewBtn"><i class="fas fa-paper-plane"></i> Submit Review</button>
                        <a href="assigned_projects.html" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Assigned Projects</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Project Review Portal
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Mock project data (simulating passed ID, e.g., from URL param)
    const project = {
        id: "P001",
        title: "AI-Powered Crop Disease Detection for Nigerian Farmers",
        student: "Amina Bello",
        regNo: "KP/CS/2022/001",
        email: "amina.bello@kadpoly.edu.ng",
        department: "Computer Science",
        level: "HND2",
        supervisor: "Dr. Fatima Bello",
        topics: "Machine Learning, Convolutional Neural Networks, Agriculture",
        description: "This project aims to develop a deep learning model to detect cassava diseases from leaf images, providing real-time diagnosis for farmers.",
        methodology: "Data collection from local farms, image preprocessing, CNN model training using TensorFlow, and mobile app integration.",
        submissionDate: "2025-03-10",
        currentStatus: "pending"
    };

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

    function renderProjectDetails() {
        document.getElementById("projectTitle").innerText = project.title;
        const infoGrid = document.getElementById("infoGrid");
        infoGrid.innerHTML = `
            <div class="info-item"><div class="info-label">Student Name</div><div class="info-value">${escapeHtml(project.student)}</div></div>
            <div class="info-item"><div class="info-label">Registration No.</div><div class="info-value">${escapeHtml(project.regNo)}</div></div>
            <div class="info-item"><div class="info-label">Email</div><div class="info-value">${escapeHtml(project.email)}</div></div>
            <div class="info-item"><div class="info-label">Department / Level</div><div class="info-value">${escapeHtml(project.department)} • ${escapeHtml(project.level)}</div></div>
            <div class="info-item"><div class="info-label">Supervisor</div><div class="info-value">${escapeHtml(project.supervisor)}</div></div>
            <div class="info-item"><div class="info-label">Submission Date</div><div class="info-value">${project.submissionDate}</div></div>
            <div class="info-item full-width"><div class="info-label">Project Topics</div><div class="info-value">${escapeHtml(project.topics)}</div></div>
            <div class="info-item full-width"><div class="info-label">Abstract / Description</div><div class="info-value">${escapeHtml(project.description)}</div></div>
            <div class="info-item full-width"><div class="info-label">Methodology</div><div class="info-value">${escapeHtml(project.methodology)}</div></div>
            <div class="info-item"><div class="info-label">Current Status</div><div class="info-value"><span class="status-badge" style="background:#fef3c7;color:#b45309;padding:4px 12px;border-radius:50px;">${project.currentStatus.toUpperCase()}</span></div></div>
        `;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function submitReview() {
        const recommendation = document.getElementById("recommendation").value;
        const comments = document.getElementById("comments").value.trim();
        if (!comments) {
            alert("Please provide feedback comments.");
            return;
        }
        // Simulate API call
        showToast(`Review submitted! Recommendation: ${recommendation.toUpperCase()}. Feedback recorded.`, "success");
        // In real scenario, redirect or update UI
        setTimeout(() => {
            // Disable submit button to prevent double submission
            const btn = document.getElementById("submitReviewBtn");
            btn.disabled = true;
            btn.style.opacity = "0.6";
            btn.innerText = "Submitted";
        }, 500);
    }

    document.getElementById("submitReviewBtn").addEventListener("click", submitReview);

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

    // Initial render
    renderProjectDetails();
</script>
</body>
</html>