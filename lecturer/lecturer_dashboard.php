<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Lecturer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/lecturer.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'dashboard'; include '../include/lecturer_sidebar.php'; ?>
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