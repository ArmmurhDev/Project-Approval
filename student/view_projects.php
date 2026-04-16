<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | View Projects</title>
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
            min-width: 240px;
        }
        .search-box button {
            background: var(--kaduna-gold);
            border: none;
            padding: 0 18px;
            border-radius: 50px;
            cursor: pointer;
        }

        /* Projects Table / Card Grid */
        .projects-container {
            background: white;
            border-radius: var(--radius);
            overflow-x: auto;
            box-shadow: var(--shadow-sm);
        }
        .projects-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        .projects-table th {
            background: var(--kaduna-cream);
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid var(--kaduna-gold);
        }
        .projects-table td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid #e2e8e0;
            vertical-align: middle;
        }
        .projects-table tr:hover {
            background: #fafaf5;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-pending { background: #fef3c7; color: #b45309; }
        .status-approved { background: #dcfce7; color: #166534; }
        .status-rejected { background: #fee2e2; color: #b91c1c; }

        .btn-view {
            background: #eef2ee;
            border: none;
            padding: 6px 14px;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        /* Mobile cards */
        .project-cards {
            display: none;
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 0.5rem;
        }
        .project-card {
            background: white;
            border-radius: var(--radius-sm);
            padding: 1rem;
            border: 1px solid #e2e8e0;
        }
        .project-card h4 {
            color: var(--kaduna-green);
            margin-bottom: 0.5rem;
        }
        .project-card p {
            font-size: 0.8rem;
            margin: 6px 0;
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

        /* Modal for details */
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
            max-height: 85vh;
            overflow-y: auto;
        }
        .modal-content h3 {
            margin-bottom: 1rem;
        }
        .detail-row {
            margin: 12px 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
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
        @media (max-width: 768px) {
            .projects-table {
                display: none;
            }
            .project-cards {
                display: grid;
            }
            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }
            .search-box {
                width: 100%;
            }
            .main-content {
                padding: 1rem;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
        @media (min-width: 769px) {
            .project-cards {
                display: none;
            }
            .projects-table {
                display: table;
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
            <div class="logo-icon"><i class="fas fa-eye"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="admin_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-project-diagram"></i> View Projects</a></li>
            <li class="nav-item"><a href="project_reviews.html" class="nav-link"><i class="fas fa-comment-dots"></i> Reviews</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-project-diagram"></i> All Projects</h1>
                <p>Browse and manage student project submissions</p>
            </div>
            <div class="user-profile">
                <span class="user-name"><i class="fas fa-user-shield"></i> Admin</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="stats-grid" id="statsContainer"></div>

        <div class="action-bar">
            <div class="filter-group" id="filterGroup">
                <button data-filter="all" class="filter-btn active">All</button>
                <button data-filter="pending" class="filter-btn">Pending</button>
                <button data-filter="approved" class="filter-btn">Approved</button>
                <button data-filter="rejected" class="filter-btn">Rejected</button>
            </div>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by title, student, or dept...">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <!-- Desktop Table -->
        <div class="projects-container">
            <table class="projects-table" id="projectsTable">
                <thead>
                    <tr><th>Project Title</th><th>Student</th><th>Department</th><th>Submission Date</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div id="cardsContainer" class="project-cards"></div>
        <div id="emptyMessage" style="text-align:center; padding:2rem; display:none;">📭 No projects found.</div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Complete Project Repository
        </div>
    </main>
</div>

<!-- Project Details Modal -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <h3><i class="fas fa-info-circle"></i> Project Details</h3>
        <div id="modalDetails"></div>
        <div style="text-align:right; margin-top:1rem;">
            <button class="btn-view" onclick="closeDetailModal()">Close</button>
        </div>
    </div>
</div>

<script>
    // Mock project data
    let projects = [
        { id: "P001", title: "AI-Powered Crop Disease Detection", student: "Amina Bello", regNo: "KP/CS/2022/001", dept: "Computer Science", subDate: "2025-03-10", status: "approved", topics: "Machine Learning, CNN", description: "Deep learning for cassava disease detection.", methodology: "CNN with TensorFlow", supervisor: "Dr. Fatima Bello" },
        { id: "P002", title: "Blockchain for Student Records", student: "Ibrahim Musa", regNo: "KP/CS/2022/045", dept: "Computer Science", subDate: "2025-03-12", status: "pending", topics: "Blockchain, Smart Contracts", description: "Decentralized academic records.", methodology: "Ethereum, IPFS", supervisor: "Prof. Adekunle" },
        { id: "P003", title: "IoT Water Quality Monitor", student: "Fatima Sani", regNo: "KP/CE/2023/012", dept: "Computer Eng.", subDate: "2025-03-05", status: "approved", topics: "IoT, Sensors", description: "Real-time water monitoring.", methodology: "Arduino, Cloud", supervisor: "Dr. Samuel Okonkwo" },
        { id: "P004", title: "E-Learning Platform", student: "Samuel John", regNo: "KP/CS/2023/088", dept: "CS", subDate: "2025-03-01", status: "rejected", topics: "E-learning, NLP", description: "Adaptive learning platform.", methodology: "React, Node.js", supervisor: "Dr. Fatima Bello" },
        { id: "P005", title: "Cybersecurity Threat Intel", student: "Zainab Idris", regNo: "KP/CY/2022/033", dept: "Cyber Security", subDate: "2025-03-14", status: "pending", topics: "Threat Hunting", description: "Automated threat feed analysis.", methodology: "Python, ML", supervisor: "Prof. Adekunle" }
    ];

    let currentFilter = "all";
    let searchQuery = "";

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

    function renderProjects() {
        let filtered = projects.filter(p => {
            if (currentFilter !== "all" && p.status !== currentFilter) return false;
            if (searchQuery.trim()) {
                const q = searchQuery.toLowerCase();
                return p.title.toLowerCase().includes(q) || p.student.toLowerCase().includes(q) || p.dept.toLowerCase().includes(q);
            }
            return true;
        });
        const tbody = document.getElementById("tableBody");
        const cardsDiv = document.getElementById("cardsContainer");
        const emptyMsg = document.getElementById("emptyMessage");
        if (filtered.length === 0) {
            tbody.innerHTML = "";
            cardsDiv.innerHTML = "";
            emptyMsg.style.display = "block";
            return;
        }
        emptyMsg.style.display = "none";

        // Table rows
        tbody.innerHTML = filtered.map(p => `
            <tr>
                <td>${escapeHtml(p.title)}</td>
                <td>${escapeHtml(p.student)}</td>
                <td>${escapeHtml(p.dept)}</td>
                <td>${p.subDate}</td>
                <td><span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span></td>
                <td><button class="btn-view" onclick="showDetails('${p.id}')"><i class="fas fa-eye"></i> View</button></td>
            </tr>
        `).join("");

        // Mobile cards
        cardsDiv.innerHTML = filtered.map(p => `
            <div class="project-card">
                <h4>${escapeHtml(p.title)}</h4>
                <p><i class="fas fa-user"></i> ${escapeHtml(p.student)}</p>
                <p><i class="fas fa-building"></i> ${escapeHtml(p.dept)} • ${p.subDate}</p>
                <p><span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span></p>
                <button class="btn-view" onclick="showDetails('${p.id}')" style="margin-top:8px;">View Details</button>
            </div>
        `).join("");
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

    // Modal details
    const modal = document.getElementById("detailModal");
    function showDetails(id) {
        const project = projects.find(p => p.id === id);
        if (project) {
            const detailsHtml = `
                <div class="detail-row"><strong>Title:</strong> ${escapeHtml(project.title)}</div>
                <div class="detail-row"><strong>Student:</strong> ${escapeHtml(project.student)} (${project.regNo})</div>
                <div class="detail-row"><strong>Department:</strong> ${escapeHtml(project.dept)}</div>
                <div class="detail-row"><strong>Submission Date:</strong> ${project.subDate}</div>
                <div class="detail-row"><strong>Status:</strong> <span class="status-badge status-${project.status}">${project.status.toUpperCase()}</span></div>
                <div class="detail-row"><strong>Topics:</strong> ${escapeHtml(project.topics)}</div>
                <div class="detail-row"><strong>Description:</strong> ${escapeHtml(project.description)}</div>
                <div class="detail-row"><strong>Methodology:</strong> ${escapeHtml(project.methodology)}</div>
                <div class="detail-row"><strong>Supervisor:</strong> ${escapeHtml(project.supervisor)}</div>
            `;
            document.getElementById("modalDetails").innerHTML = detailsHtml;
            modal.style.display = "flex";
        }
    }
    window.showDetails = showDetails;
    function closeDetailModal() { modal.style.display = "none"; }
    window.closeDetailModal = closeDetailModal;
    window.onclick = function(e) { if (e.target === modal) closeDetailModal(); };

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
    document.getElementById("searchInput").addEventListener("keyup", (e) => {
        if (e.key === "Enter") { searchQuery = e.target.value; renderProjects(); }
    });

    // Logout demo
    function logoutDemo() { alert("Logged out – redirect to login."); }
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