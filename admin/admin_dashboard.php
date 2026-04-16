<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Admin Dashboard (Demo)</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap" rel="stylesheet">
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
        }
        :root {
            --kaduna-green: #0a5c36;
            --kaduna-green-light: #2a7a4a;
            --kaduna-gold: #e6a017;
            --kaduna-gold-dark: #c47d0c;
            --kaduna-red: #c0392b;
            --kaduna-cream: #fef9e6;
            --kaduna-charcoal: #2c3e2c;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --radius: 20px;
            --radius-sm: 14px;
        }
        .app-container {
            display: flex;
            min-height: 100vh;
        }
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
        .logo-text h2 { font-size: 1.3rem; font-weight: 700; }
        .logo-text p { font-size: 0.7rem; opacity: 0.8; }
        .nav-menu { list-style: none; margin-top: 2rem; }
        .nav-item { margin-bottom: 0.75rem; }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            border-radius: 50px;
            color: rgba(255,255,240,0.85);
            text-decoration: none;
            transition: 0.2s;
            font-weight: 500;
        }
        .nav-link.active, .nav-link:hover {
            background: rgba(230,160,23,0.2);
            color: var(--kaduna-gold);
        }
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 1.8rem 2rem;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 1rem 2rem;
            border-radius: 60px;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .page-title h1 { font-size: 1.6rem; font-weight: 700; color: var(--kaduna-charcoal); }
        .admin-profile { display: flex; align-items: center; gap: 15px; }
        .admin-name { background: #eef2ee; padding: 6px 16px; border-radius: 40px; font-weight: 600; }
        .logout-btn { background: rgba(192,57,43,0.1); color: var(--kaduna-red); padding: 8px 18px; border-radius: 40px; text-decoration: none; font-weight: 500; }
        .logout-btn:hover { background: var(--kaduna-red); color: white; }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.4rem;
            border-radius: var(--radius-sm);
            border-left: 6px solid var(--kaduna-gold);
        }
        .stat-title { font-size: 0.85rem; text-transform: uppercase; color: #5f6c5f; }
        .stat-number { font-size: 2.5rem; font-weight: 800; color: var(--kaduna-green); margin: 8px 0; }
        .filters-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 1rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 60px;
            margin-bottom: 2rem;
        }
        .status-filters { display: flex; gap: 8px; flex-wrap: wrap; }
        .filter-btn {
            padding: 8px 20px;
            border-radius: 40px;
            background: #f0f2f0;
            text-decoration: none;
            font-weight: 500;
            color: #2c442c;
            cursor: pointer;
        }
        .filter-btn.active, .filter-btn:hover { background: var(--kaduna-green); color: white; }
        .search-box { display: flex; gap: 8px; }
        .search-box input { padding: 10px 18px; border-radius: 50px; border: 1px solid #ddd; min-width: 240px; }
        .search-box button { background: var(--kaduna-gold); border: none; padding: 0 20px; border-radius: 50px; cursor: pointer; }
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
            transition: 0.25s;
            border: 1px solid #e2e8e0;
        }
        .project-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-md); }
        .card-header {
            background: var(--kaduna-cream);
            padding: 1rem 1.4rem;
            border-bottom: 2px solid var(--kaduna-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .project-title { font-weight: 700; font-size: 1.1rem; }
        .status-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-pending { background: #fef3c7; color: #b45309; }
        .status-approved { background: #dcfce7; color: #166534; }
        .status-rejected { background: #fee2e2; color: #b91c1c; }
        .card-body { padding: 1.2rem 1.4rem; }
        .student-info { display: flex; gap: 12px; margin-bottom: 12px; font-size: 0.85rem; color: #4a5b4a; }
        .topic-area { background: #f8faf6; padding: 10px; border-radius: 16px; margin: 12px 0; font-size: 0.85rem; font-family: monospace; }
        .duplicate-warning { background: #fff0db; border-left: 4px solid var(--kaduna-gold); padding: 8px 12px; font-size: 0.75rem; margin: 12px 0; border-radius: 12px; }
        .card-actions { display: flex; gap: 12px; margin-top: 16px; flex-wrap: wrap; }
        .btn {
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 0.8rem;
        }
        .btn-view { background: #eef2ee; color: #2d3e2d; }
        .btn-approve { background: var(--kaduna-green); color: white; }
        .btn-reject { background: #e9e6e0; color: #a13e2f; border: 1px solid #e2c6c0; }
        .modal {
            display: none;
            position: fixed;
            top:0;left:0;
            width:100%;height:100%;
            background: rgba(0,0,0,0.6);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            max-width: 500px;
            width: 90%;
            border-radius: 28px;
            padding: 1.8rem;
        }
        .modal textarea { width: 100%; border-radius: 20px; border: 1px solid #ccc; padding: 12px; margin: 15px 0; }
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
            .sidebar { transform: translateX(-100%); position: fixed; }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-menu-toggle { display: inline-block; }
        }
        @media (max-width: 640px) {
            .main-content { padding: 1rem; }
            .top-bar, .filters-bar { flex-direction: column; align-items: stretch; border-radius: 24px; }
            .search-box { width: 100%; }
            .search-box input { flex: 1; }
            .projects-grid { grid-template-columns: 1fr; }
        }
        .footer-note { text-align: center; margin-top: 2rem; padding: 1rem; color: #6f7e6f; }
    </style>
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-icon"><i class="fas fa-check-double"></i></div>
            <div class="logo-text"><h2>Topic Verifier</h2><p>Kaduna Polytechnic</p></div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-project-diagram"></i> Projects</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chalkboard-teacher"></i> Supervisors</a></li>
            <li class="nav-item"><a href="#" class="nav-link" id="demoLogout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>
    <main class="main-content">
        <div class="top-bar">
            <div class="page-title"><h1><i class="fas fa-clipboard-list"></i> Project Approvals</h1><p>Review, verify & manage student project topics</p></div>
            <div class="admin-profile"><span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span><a href="#" id="logoutBtnDemo" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a></div>
        </div>
        <div class="stats-grid" id="statsContainer"></div>
        <div class="filters-bar">
            <div class="status-filters" id="filterButtons">
                <button data-filter="all" class="filter-btn active">All</button>
                <button data-filter="pending" class="filter-btn">Pending</button>
                <button data-filter="approved" class="filter-btn">Approved</button>
                <button data-filter="rejected" class="filter-btn">Rejected</button>
            </div>
            <div class="search-box"><input type="text" id="searchInput" placeholder="Search by title or student..."><button id="searchBtn"><i class="fas fa-search"></i></button></div>
        </div>
        <div class="projects-grid" id="projectsGrid"></div>
        <div class="footer-note"><i class="fas fa-shield-alt"></i> Topic Verifier — Automated Project Approval System | Demo Mode</div>
    </main>
</div>
<div id="actionModal" class="modal"><div class="modal-content"><h3 id="modalTitle">Confirm Action</h3><textarea id="commentText" rows="3" placeholder="Add comments (optional)..."></textarea><div style="display:flex; gap:12px; justify-content:flex-end;"><button class="btn btn-view" id="cancelModal">Cancel</button><button class="btn btn-approve" id="confirmActionBtn">Confirm</button></div></div></div>
<script>
    // Mock data
    let projects = [
        { project_id: 1, title: "AI-Powered Crop Disease Detection", student_name: "Amina Bello", department: "Computer Science", email: "amina@kadpoly.edu", topics: "Machine Learning, Agriculture, CNN", submission_date: "2025-03-10", approval_status: "pending", description: "Using deep learning to identify cassava diseases." },
        { project_id: 2, title: "Blockchain for Student Records", student_name: "Ibrahim Musa", department: "Computer Science", email: "ibrahim@kadpoly.edu", topics: "Blockchain, Smart Contracts", submission_date: "2025-03-12", approval_status: "pending", description: "Decentralized record keeping." },
        { project_id: 3, title: "IoT Water Quality Monitor", student_name: "Fatima Sani", department: "Computer Eng.", email: "fatima@kadpoly.edu", topics: "IoT, Sensors, Real-time", submission_date: "2025-03-05", approval_status: "approved", description: "Monitoring river pollution." },
        { project_id: 4, title: "E-Learning Platform with AI Tutor", student_name: "Samuel John", department: "CS", email: "samuel@kadpoly.edu", topics: "E-learning, NLP", submission_date: "2025-03-01", approval_status: "rejected", description: "Duplicate of existing project." },
        { project_id: 5, title: "Cybersecurity Threat Intelligence", student_name: "Zainab Idris", department: "Cyber Sec", email: "zainab@kadpoly.edu", topics: "Threat Hunting, ML", submission_date: "2025-03-14", approval_status: "pending", description: "Automated threat feed analysis." }
    ];
    let currentFilter = "all";
    let searchQuery = "";
    let currentProjectId = null;
    let currentAction = null;

    function updateStats() {
        const total = projects.length;
        const pending = projects.filter(p => p.approval_status === "pending").length;
        const approved = projects.filter(p => p.approval_status === "approved").length;
        const rejected = projects.filter(p => p.approval_status === "rejected").length;
        document.getElementById("statsContainer").innerHTML = `
            <div class="stat-card"><div class="stat-title">Total Proposals</div><div class="stat-number">${total}</div></div>
            <div class="stat-card"><div class="stat-title">Pending</div><div class="stat-number" style="color:#e6a017;">${pending}</div></div>
            <div class="stat-card"><div class="stat-title">Approved</div><div class="stat-number" style="color:#0a5c36;">${approved}</div></div>
            <div class="stat-card"><div class="stat-title">Rejected</div><div class="stat-number" style="color:#c0392b;">${rejected}</div></div>
        `;
    }

    function renderProjects() {
        let filtered = projects.filter(p => {
            if (currentFilter !== "all" && p.approval_status !== currentFilter) return false;
            if (searchQuery.trim() !== "") {
                const q = searchQuery.toLowerCase();
                return p.title.toLowerCase().includes(q) || p.student_name.toLowerCase().includes(q);
            }
            return true;
        });
        const container = document.getElementById("projectsGrid");
        if (filtered.length === 0) {
            container.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:3rem;">📭 No projects found.</div>`;
            return;
        }
        container.innerHTML = filtered.map(proj => {
            let dupWarning = "";
            // check duplicate among approved topics (mock)
            const approvedTopics = projects.filter(p => p.approval_status === "approved" && p.project_id !== proj.project_id).map(p => p.topics.toLowerCase());
            const hasDuplicate = approvedTopics.some(t => t.includes(proj.topics.toLowerCase().split(",")[0].trim()));
            if (hasDuplicate && proj.approval_status === "pending") dupWarning = `<div class="duplicate-warning"><i class="fas fa-exclamation-triangle"></i> ⚠️ Similar approved topic exists!</div>`;
            return `
                <div class="project-card" data-id="${proj.project_id}">
                    <div class="card-header"><span class="project-title">${escapeHtml(proj.title.substring(0,55))}</span><span class="status-badge status-${proj.approval_status}">${proj.approval_status}</span></div>
                    <div class="card-body">
                        <div class="student-info"><i class="fas fa-user-graduate"></i> <strong>${escapeHtml(proj.student_name)}</strong> (${escapeHtml(proj.department)})</div>
                        <div class="student-info"><i class="fas fa-envelope"></i> ${escapeHtml(proj.email)}</div>
                        <div class="topic-area"><i class="fas fa-tag"></i> Topics: ${escapeHtml(proj.topics)}</div>
                        ${dupWarning}
                        <div><small><i class="far fa-calendar-alt"></i> Submitted: ${proj.submission_date}</small></div>
                        <div class="card-actions">
                            <button class="btn btn-view" onclick="viewDetails(${proj.project_id})"><i class="fas fa-eye"></i> Details</button>
                            ${proj.approval_status === "pending" ? `<button class="btn btn-approve" onclick="openModal(${proj.project_id}, 'approve')"><i class="fas fa-check-circle"></i> Approve</button>
                            <button class="btn btn-reject" onclick="openModal(${proj.project_id}, 'reject')"><i class="fas fa-times-circle"></i> Reject</button>` : ""}
                        </div>
                    </div>
                </div>
            `;
        }).join("");
    }

    function escapeHtml(str) { return str.replace(/[&<>]/g, function(m){if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m;}); }

    function openModal(pid, action) {
        currentProjectId = pid;
        currentAction = action;
        document.getElementById("modalTitle").innerHTML = action === 'approve' ? '✅ Approve Project' : '❌ Reject Project';
        document.getElementById("actionModal").style.display = 'flex';
    }
    function closeModal() { document.getElementById("actionModal").style.display = 'none'; document.getElementById("commentText").value = ''; }
    window.openModal = openModal;
    window.viewDetails = function(pid) { alert(`[Demo] Full details for project ID ${pid}.\nIn production, this would show abstract, methodology, etc.`); };

    document.getElementById("confirmActionBtn").onclick = function() {
        if (currentProjectId && currentAction) {
            const newStatus = currentAction === 'approve' ? 'approved' : 'rejected';
            const projIndex = projects.findIndex(p => p.project_id === currentProjectId);
            if (projIndex !== -1) {
                projects[projIndex].approval_status = newStatus;
                updateStats();
                renderProjects();
                alert(`Project ${currentAction}d successfully!`);
            }
            closeModal();
        }
    };
    document.getElementById("cancelModal").onclick = closeModal;
    window.onclick = function(e) { if(e.target === document.getElementById("actionModal")) closeModal(); };

    // Filter & Search
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
    document.getElementById("searchInput").addEventListener("keypress", (e) => { if(e.key === "Enter") { searchQuery = e.target.value; renderProjects(); } });
    document.getElementById("logoutBtnDemo").addEventListener("click", (e) => { e.preventDefault(); alert("Demo logout – would redirect to login."); });
    document.getElementById("demoLogout").addEventListener("click", (e) => { e.preventDefault(); alert("Demo logout."); });
    // Mobile toggle
    const toggle = document.getElementById("mobileToggle");
    const sidebar = document.getElementById("sidebar");
    toggle.addEventListener("click", () => sidebar.classList.toggle("open"));
    document.addEventListener("click", function(e) { if(!sidebar.contains(e.target) && !toggle.contains(e.target) && sidebar.classList.contains("open")) sidebar.classList.remove("open"); });

    updateStats();
    renderProjects();
</script>
</body>
</html>