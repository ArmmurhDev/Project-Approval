<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Admin Dashboard (Demo)</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'dashboard'; include '../include/admin_sidebar.php'; ?>
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