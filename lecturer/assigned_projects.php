<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Assigned Projects</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/lecturer.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'assigned_projects'; include '../include/lecturer_sidebar.php'; ?>
    <main class="main-content">
        <div class="top-bar">
            <div class="page-title"><h1><i class="fas fa-clipboard-list"></i> Assigned Projects</h1><p>Projects under your supervision</p></div>
            <div class="lecturer-profile"><span class="lecturer-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span><a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a></div>
        </div>
        <div class="stats-grid" id="statsContainer"></div>
        <div class="action-bar">
            <div class="filter-group" id="filterGroup">
                <button data-filter="all" class="filter-btn active">All</button>
                <button data-filter="pending" class="filter-btn">Pending Review</button>
                <button data-filter="reviewed" class="filter-btn">Reviewed</button>
                <button data-filter="approved" class="filter-btn">Approved</button>
                <button data-filter="rejected" class="filter-btn">Rejected</button>
            </div>
            <div class="search-box"><input type="text" id="searchInput" placeholder="Search by title or student..."><button id="searchBtn"><i class="fas fa-search"></i></button></div>
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
        <div class="footer-note"><i class="fas fa-shield-alt"></i> Topic Verifier — Supervisor Portal</div>
    </main>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Submit Review / Recommendation</h3>
        <input type="hidden" id="currentProjectId">
        <label>Recommendation</label>
        <select id="recommendation">
            <option value="approve">Approve</option>
            <option value="reject">Reject</option>
            <option value="revise">Request Revision</option>
        </select>
        <label>Comments / Feedback</label>
        <textarea id="reviewComments" rows="3" placeholder="Provide detailed feedback..."></textarea>
        <div class="modal-buttons">
            <button class="btn" id="closeModalBtn" style="background:#eef2ee;">Cancel</button>
            <button class="btn" id="submitReviewBtn" style="background:#0a5c36; color:white;">Submit</button>
        </div>
    </div>
</div>

<script>
    // Mock data: projects assigned to this lecturer
    let projects = [
        { id: "P001", title: "AI-Powered Crop Disease Detection", student: "Amina Bello", regNo: "KP/CS/2022/001", dept: "Computer Science", subDate: "2025-03-10", status: "pending", topics: "Machine Learning, CNN", description: "Deep learning for cassava disease" },
        { id: "P002", title: "Blockchain for Student Records", student: "Ibrahim Musa", regNo: "KP/CS/2022/045", dept: "Computer Science", subDate: "2025-03-12", status: "pending", topics: "Blockchain, Smart Contracts", description: "Decentralized records" },
        { id: "P003", title: "IoT Water Quality Monitor", student: "Fatima Sani", regNo: "KP/CE/2023/012", dept: "Computer Eng.", subDate: "2025-03-05", status: "reviewed", topics: "IoT, Sensors", description: "Real-time monitoring" },
        { id: "P004", title: "E-Learning Platform with AI Tutor", student: "Samuel John", regNo: "KP/CS/2023/088", dept: "CS", subDate: "2025-02-28", status: "approved", topics: "E-learning, NLP", description: "Adaptive learning" },
        { id: "P005", title: "Cybersecurity Threat Intelligence", student: "Zainab Idris", regNo: "KP/CY/2022/033", dept: "Cyber Security", subDate: "2025-03-01", status: "rejected", topics: "Threat Hunting", description: "Automated threat feed" }
    ];

    let currentFilter = "all";
    let searchQuery = "";

    function updateStats() {
        const total = projects.length;
        const pending = projects.filter(p => p.status === "pending").length;
        const reviewed = projects.filter(p => p.status === "reviewed").length;
        const approved = projects.filter(p => p.status === "approved").length;
        const rejected = projects.filter(p => p.status === "rejected").length;
        document.getElementById("statsContainer").innerHTML = `
            <div class="stat-card"><div class="stat-number">${total}</div><div class="stat-title">Total Assigned</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#e6a017;">${pending}</div><div class="stat-title">Pending Review</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#2a7a4a;">${reviewed}</div><div class="stat-title">Reviewed</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#0a5c36;">${approved}</div><div class="stat-title">Approved</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#c0392b;">${rejected}</div><div class="stat-title">Rejected</div></div>
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
                <td>${escapeHtml(p.student)} (${p.regNo})</td>
                <td>${escapeHtml(p.dept)}</td>
                <td>${p.subDate}</td>
                <td><span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span></td>
                <td>
                    ${p.status === 'pending' ? `<button class="btn btn-review" onclick="openReviewModal('${p.id}')"><i class="fas fa-edit"></i> Review</button>` : `<button class="btn btn-view" disabled style="opacity:0.6;">${p.status === 'reviewed' ? 'Reviewed' : p.status}</button>`}
                </td>
            </tr>
        `).join("");

        // Mobile cards
        cardsDiv.innerHTML = filtered.map(p => `
            <div class="project-card">
                <h4>${escapeHtml(p.title)}</h4>
                <p><i class="fas fa-user"></i> ${escapeHtml(p.student)} (${p.regNo})</p>
                <p><i class="fas fa-building"></i> ${escapeHtml(p.dept)} • ${p.subDate}</p>
                <p><span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span></p>
                <div class="mobile-actions">
                    ${p.status === 'pending' ? `<button class="btn btn-review" onclick="openReviewModal('${p.id}')">Review</button>` : `<button class="btn btn-view" disabled>${p.status === 'reviewed' ? 'Reviewed' : p.status}</button>`}
                </div>
            </div>
        `).join("");
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

    // Modal logic
    let currentProjectId = null;
    const modal = document.getElementById("reviewModal");
    window.openReviewModal = function(projectId) {
        currentProjectId = projectId;
        document.getElementById("currentProjectId").value = projectId;
        document.getElementById("reviewComments").value = "";
        document.getElementById("recommendation").value = "approve";
        modal.style.display = "flex";
    };
    function closeModal() { modal.style.display = "none"; }
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("submitReviewBtn").addEventListener("click", () => {
        const pid = document.getElementById("currentProjectId").value;
        const rec = document.getElementById("recommendation").value;
        const comments = document.getElementById("reviewComments").value.trim();
        if (!comments) {
            alert("Please provide feedback comments.");
            return;
        }
        const project = projects.find(p => p.id === pid);
        if (project) {
            project.status = "reviewed";
            alert(`Review submitted for "${project.title}".\nRecommendation: ${rec.toUpperCase()}\nComments: ${comments}`);
            updateStats();
            renderProjects();
        }
        closeModal();
    });
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