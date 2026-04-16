<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Project Status</title>
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

        .student-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .student-name {
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

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-sm);
            border-left: 6px solid var(--kaduna-gold);
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--kaduna-green);
        }
        .stat-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #6f7e6f;
        }

        /* Projects Grid */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 1.8rem;
        }

        .project-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: 0.2s;
        }
        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }
        .card-header {
            background: var(--kaduna-cream);
            padding: 1rem 1.2rem;
            border-bottom: 2px solid var(--kaduna-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .project-title {
            font-weight: 700;
            font-size: 1rem;
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-pending { background: #fef3c7; color: #b45309; }
        .status-approved { background: #dcfce7; color: #166534; }
        .status-rejected { background: #fee2e2; color: #b91c1c; }

        .card-body {
            padding: 1rem 1.2rem;
        }
        .info-row {
            font-size: 0.85rem;
            margin: 8px 0;
            color: #4a5b4a;
        }
        .progress-track {
            margin: 12px 0;
        }
        .progress-step {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0;
            font-size: 0.8rem;
        }
        .step-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e2e8e0;
            color: #6f7e6f;
        }
        .step-icon.completed {
            background: var(--kaduna-green);
            color: white;
        }
        .step-icon.current {
            background: var(--kaduna-gold);
            color: #2c2c1c;
        }
        .step-text {
            flex: 1;
        }
        .feedback-area {
            background: #f8faf6;
            padding: 10px;
            border-radius: 12px;
            margin-top: 12px;
            font-size: 0.8rem;
            border-left: 3px solid var(--kaduna-gold);
        }

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
            .projects-grid {
                grid-template-columns: 1fr;
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
            <div class="logo-icon"><i class="fas fa-chart-line"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="student_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="submit_project.html" class="nav-link"><i class="fas fa-upload"></i> Submit</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-chart-simple"></i> Project Status</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-chart-simple"></i> Project Status</h1>
                <p>Track the progress of your project submissions</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello (KP/CS/2022/001)</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="stats-grid" id="statsContainer"></div>

        <div class="projects-grid" id="projectsGrid"></div>
        <div id="emptyMessage" style="text-align:center; padding:2rem; display:none;">📭 You haven't submitted any projects yet.</div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Real-time project approval tracking
        </div>
    </main>
</div>

<script>
    // Mock project data for a student
    let projects = [
        { 
            id: "P001", 
            title: "AI-Powered Crop Disease Detection", 
            topics: "Machine Learning, CNN, Agriculture",
            submissionDate: "2025-03-10",
            status: "approved",
            feedback: "Excellent topic with clear methodology. Approved for implementation. Supervisor assigned: Dr. Fatima Bello",
            reviewDate: "2025-03-15",
            reviewer: "Dr. Fatima Bello"
        },
        { 
            id: "P002", 
            title: "Blockchain for Student Records", 
            topics: "Blockchain, Smart Contracts",
            submissionDate: "2025-03-12",
            status: "pending",
            feedback: "",
            reviewDate: null,
            reviewer: null
        },
        { 
            id: "P003", 
            title: "Mobile Health Records System", 
            topics: "Mobile Dev, Healthcare, Firebase",
            submissionDate: "2025-02-20",
            status: "rejected",
            feedback: "Topic already covered by previous project (2024). Please choose a more novel area with clear differentiation.",
            reviewDate: "2025-02-28",
            reviewer: "Prof. Adekunle Oluwole"
        }
    ];

    function updateStats() {
        const total = projects.length;
        const pending = projects.filter(p => p.status === "pending").length;
        const approved = projects.filter(p => p.status === "approved").length;
        const rejected = projects.filter(p => p.status === "rejected").length;
        document.getElementById("statsContainer").innerHTML = `
            <div class="stat-card"><div class="stat-number">${total}</div><div class="stat-title">Total Projects</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#e6a017;">${pending}</div><div class="stat-title">Pending</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#0a5c36;">${approved}</div><div class="stat-title">Approved</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#c0392b;">${rejected}</div><div class="stat-title">Rejected</div></div>
        `;
    }

    function getProgressSteps(status) {
        const steps = [
            { name: "Proposal Submitted", key: "submitted" },
            { name: "Under Review", key: "review" },
            { name: "Final Decision", key: "decision" }
        ];
        if (status === "pending") {
            return steps.map(step => ({
                ...step,
                completed: step.key === "submitted",
                current: step.key === "review"
            }));
        } else if (status === "approved" || status === "rejected") {
            return steps.map(step => ({
                ...step,
                completed: true,
                current: false
            }));
        }
        return steps;
    }

    function renderProjects() {
        const container = document.getElementById("projectsGrid");
        const emptyMsg = document.getElementById("emptyMessage");
        if (projects.length === 0) {
            container.innerHTML = "";
            emptyMsg.style.display = "block";
            return;
        }
        emptyMsg.style.display = "none";
        container.innerHTML = projects.map(p => {
            const steps = getProgressSteps(p.status);
            return `
                <div class="project-card">
                    <div class="card-header">
                        <span class="project-title">${escapeHtml(p.title)}</span>
                        <span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span>
                    </div>
                    <div class="card-body">
                        <div class="info-row"><i class="fas fa-tags"></i> Topics: ${escapeHtml(p.topics)}</div>
                        <div class="info-row"><i class="fas fa-calendar-alt"></i> Submitted: ${p.submissionDate}</div>
                        ${p.reviewDate ? `<div class="info-row"><i class="fas fa-clock"></i> Reviewed: ${p.reviewDate}</div>` : ''}
                        
                        <div class="progress-track">
                            ${steps.map(step => `
                                <div class="progress-step">
                                    <div class="step-icon ${step.completed ? 'completed' : (step.current ? 'current' : '')}">
                                        ${step.completed ? '<i class="fas fa-check"></i>' : (step.current ? '<i class="fas fa-spinner fa-pulse"></i>' : '<i class="fas fa-circle-notch"></i>')}
                                    </div>
                                    <div class="step-text">${step.name}</div>
                                </div>
                            `).join('')}
                        </div>
                        
                        ${p.feedback ? `
                            <div class="feedback-area">
                                <i class="fas fa-comment-dots"></i> <strong>Feedback from ${escapeHtml(p.reviewer || 'Reviewer')}:</strong><br>
                                ${escapeHtml(p.feedback)}
                            </div>
                        ` : `
                            <div class="feedback-area" style="background:#fef9e6;">
                                <i class="fas fa-hourglass-half"></i> <strong>Awaiting Review</strong><br>
                                Your project is in queue. You will be notified once reviewed.
                            </div>
                        `}
                    </div>
                </div>
            `;
        }).join("");
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

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

    updateStats();
    renderProjects();
</script>
</body>
</html>