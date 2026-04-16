<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Lecturer Dashboard</title>
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

        .lecturer-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .lecturer-name {
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.2rem;
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
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #6f7e6f;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 60px;
        }

        .filter-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .filter-btn {
            padding: 8px 20px;
            border-radius: 40px;
            background: #f0f2f0;
            border: none;
            font-weight: 500;
            cursor: pointer;
        }
        .filter-btn.active {
            background: var(--kaduna-green);
            color: white;
        }

        .search-box {
            display: flex;
            gap: 8px;
        }
        .search-box input {
            padding: 8px 16px;
            border-radius: 50px;
            border: 1px solid #ddd;
            min-width: 220px;
        }
        .search-box button {
            background: var(--kaduna-gold);
            border: none;
            padding: 0 18px;
            border-radius: 50px;
            cursor: pointer;
        }

        /* Projects Grid */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
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
        .status-reviewed { background: #dcfce7; color: #166534; }
        .card-body {
            padding: 1rem 1.2rem;
        }
        .student-info {
            display: flex;
            gap: 8px;
            font-size: 0.85rem;
            margin-bottom: 8px;
            color: #4a5b4a;
        }
        .topic-area {
            background: #f8faf6;
            padding: 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin: 10px 0;
        }
        .card-actions {
            display: flex;
            gap: 12px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 6px 14px;
            border-radius: 40px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 0.8rem;
        }
        .btn-review { background: var(--kaduna-gold); color: #2c2c1c; }
        .btn-approve { background: var(--kaduna-green); color: white; }
        .btn-reject { background: #e9e6e0; color: var(--kaduna-red); }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            max-width: 550px;
            width: 90%;
            border-radius: 28px;
            padding: 1.8rem;
        }
        .modal-content textarea, .modal-content select {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 1rem;
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

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
            }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-menu-toggle { display: inline-block; }
        }
        @media (max-width: 640px) {
            .main-content { padding: 1rem; }
            .top-bar { flex-direction: column; align-items: flex-start; gap: 12px; }
            .action-bar { flex-direction: column; align-items: stretch; }
            .search-box { width: 100%; }
            .projects-grid { grid-template-columns: 1fr; }
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
            <div class="logo-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="logo-text"><h2>Topic Verifier</h2><p>Kaduna Polytechnic</p></div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-tasks"></i> My Reviews</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user-graduate"></i> Assigned Students</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>
    <main class="main-content">
        <div class="top-bar">
            <div class="page-title"><h1><i class="fas fa-chalkboard-teacher"></i> Lecturer Dashboard</h1><p>Review assigned project topics & provide feedback</p></div>
            <div class="lecturer-profile"><span class="lecturer-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span><a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a></div>
        </div>
        <div class="stats-grid" id="statsContainer"></div>
        <div class="action-bar">
            <div class="filter-group" id="filterGroup">
                <button data-filter="all" class="filter-btn active">All Projects</button>
                <button data-filter="pending" class="filter-btn">Pending Review</button>
                <button data-filter="reviewed" class="filter-btn">Reviewed</button>
            </div>
            <div class="search-box"><input type="text" id="searchInput" placeholder="Search by title or student..."><button id="searchBtn"><i class="fas fa-search"></i></button></div>
        </div>
        <div class="projects-grid" id="projectsGrid"></div>
        <div class="footer-note"><i class="fas fa-shield-alt"></i> Topic Verifier — Lecturer Review Portal</div>
    </main>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Submit Review</h3>
        <input type="hidden" id="currentProjectId">
        <label>Recommendation</label>
        <select id="recommendation">
            <option value="approve">Approve</option>
            <option value="reject">Reject</option>
            <option value="revise">Request Revision</option>
        </select>
        <label>Feedback Comments</label>
        <textarea id="reviewComments" rows="3" placeholder="Provide detailed feedback for the student..."></textarea>
        <div class="modal-buttons">
            <button class="btn" id="closeModalBtn" style="background:#eef2ee;">Cancel</button>
            <button class="btn" id="submitReviewBtn" style="background:#0a5c36; color:white;">Submit Review</button>
        </div>
    </div>
</div>

<script>
    // Mock data: projects assigned to this lecturer
    let projects = [
        { id: "P001", title: "AI-Powered Crop Disease Detection", student: "Amina Bello", regNo: "KP/CS/2022/001", dept: "Computer Science", submissionDate: "2025-03-10", status: "pending", topics: "Machine Learning, CNN, Agriculture", description: "Deep learning model for cassava disease detection." },
        { id: "P002", title: "Blockchain for Student Records", student: "Ibrahim Musa", regNo: "KP/CS/2022/045", dept: "Computer Science", submissionDate: "2025-03-12", status: "pending", topics: "Blockchain, Smart Contracts", description: "Decentralized record keeping." },
        { id: "P003", title: "IoT Water Quality Monitor", student: "Fatima Sani", regNo: "KP/CE/2023/012", dept: "Computer Eng.", submissionDate: "2025-03-05", status: "reviewed", topics: "IoT, Sensors", description: "Real-time water pollution monitoring." }
    ];

    let currentFilter = "all";
    let searchQuery = "";

    function updateStats() {
        const total = projects.length;
        const pending = projects.filter(p => p.status === "pending").length;
        const reviewed = projects.filter(p => p.status === "reviewed").length;
        document.getElementById("statsContainer").innerHTML = `
            <div class="stat-card"><div class="stat-number">${total}</div><div class="stat-title">Assigned Projects</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#e6a017;">${pending}</div><div class="stat-title">Pending Review</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#0a5c36;">${reviewed}</div><div class="stat-title">Reviewed</div></div>
        `;
    }

    function renderProjects() {
        let filtered = projects.filter(p => {
            if (currentFilter !== "all" && p.status !== currentFilter) return false;
            if (searchQuery.trim()) {
                const q = searchQuery.toLowerCase();
                return p.title.toLowerCase().includes(q) || p.student.toLowerCase().includes(q);
            }
            return true;
        });
        const container = document.getElementById("projectsGrid");
        if (filtered.length === 0) {
            container.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:3rem;">📭 No projects assigned.</div>`;
            return;
        }
        container.innerHTML = filtered.map(p => `
            <div class="project-card" data-id="${p.id}">
                <div class="card-header">
                    <span class="project-title">${escapeHtml(p.title.substring(0,50))}</span>
                    <span class="status-badge status-${p.status}">${p.status === 'pending' ? 'Pending' : 'Reviewed'}</span>
                </div>
                <div class="card-body">
                    <div class="student-info"><i class="fas fa-user-graduate"></i> ${escapeHtml(p.student)} (${escapeHtml(p.regNo)})</div>
                    <div class="student-info"><i class="fas fa-building"></i> ${escapeHtml(p.dept)} • Submitted: ${p.submissionDate}</div>
                    <div class="topic-area"><i class="fas fa-tag"></i> Topics: ${escapeHtml(p.topics)}</div>
                    <div class="card-actions">
                        <button class="btn btn-review" onclick="openReviewModal('${p.id}')"><i class="fas fa-edit"></i> Review</button>
                        ${p.status === 'reviewed' ? '<button class="btn btn-approve" disabled style="opacity:0.5;">Reviewed</button>' : ''}
                    </div>
                </div>
            </div>
        `).join("");
    }

    function escapeHtml(str) { return str.replace(/[&<>]/g, function(m){ return m==='&'?'&amp;':m==='<'?'&lt;':'&gt;';}); }

    // Modal handling
    let currentProjectId = null;
    const modal = document.getElementById("reviewModal");
    function openReviewModal(projectId) {
        currentProjectId = projectId;
        document.getElementById("currentProjectId").value = projectId;
        document.getElementById("reviewComments").value = "";
        document.getElementById("recommendation").value = "approve";
        document.getElementById("modalTitle").innerText = "Review Project";
        modal.style.display = "flex";
    }
    function closeModal() { modal.style.display = "none"; }
    window.openReviewModal = openReviewModal;

    document.getElementById("submitReviewBtn").addEventListener("click", () => {
        const projectId = document.getElementById("currentProjectId").value;
        const recommendation = document.getElementById("recommendation").value;
        const comments = document.getElementById("reviewComments").value.trim();
        if (!comments) {
            alert("Please provide feedback comments.");
            return;
        }
        const project = projects.find(p => p.id === projectId);
        if (project) {
            project.status = "reviewed";
            alert(`Review submitted for "${project.title}". Recommendation: ${recommendation.toUpperCase()}\nComments: ${comments}`);
            updateStats();
            renderProjects();
        }
        closeModal();
    });
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    window.onclick = function(e) { if (e.target === modal) closeModal(); };

    // Filters & Search
    document.querySelectorAll(".filter-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            currentFilter = btn.getAttribute("data-filter");
            renderProjects();
        });
    });
    document.getElementById("searchBtn").addEventListener("click", () => {
        searchQuery = document.getElementById("searchInput").value;
        renderProjects();
    });
    document.getElementById("searchInput").addEventListener("keyup", (e) => { if(e.key === "Enter") { searchQuery = e.target.value; renderProjects(); } });

    // Logout
    function logoutDemo() { alert("Logged out – redirect to login."); }
    document.getElementById("logoutLink")?.addEventListener("click", (e) => { e.preventDefault(); logoutDemo(); });
    document.getElementById("logoutTop")?.addEventListener("click", (e) => { e.preventDefault(); logoutDemo(); });

    // Mobile sidebar toggle
    const toggleBtn = document.getElementById("mobileToggle");
    const sidebar = document.getElementById("sidebar");
    toggleBtn.addEventListener("click", () => sidebar.classList.toggle("open"));
    document.addEventListener("click", function(e) {
        if(!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
        }
    });

    updateStats();
    renderProjects();
</script>
</body>
</html>