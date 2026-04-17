<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | View Projects</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'my_projects'; include '../include/student_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-project-diagram"></i> All Projects</h1>
                <p>Browse and manage student project submissions</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello (KP/CS/2022/001)</span>
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
        <div class="modal-buttons">
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
                <div class="card-actions">
                    <button class="btn-view" onclick="showDetails('${p.id}')">View Details</button>
                </div>
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