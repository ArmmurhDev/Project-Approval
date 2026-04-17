<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | My Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/lecturer.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'my_students'; include '../include/lecturer_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-user-graduate"></i> My Students</h1>
                <p>Manage and track the progress of students assigned to you</p>
            </div>
            <div class="lecturer-profile">
                <span class="lecturer-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="stats-grid" id="statsContainer"></div>

        <div class="action-bar">
            <div class="filter-group" id="filterGroup">
                <button data-filter="all" class="filter-btn active">All Students</button>
                <button data-filter="approved" class="filter-btn">Approved Topics</button>
                <button data-filter="pending" class="filter-btn">Pending Review</button>
                <button data-filter="revised" class="filter-btn">Needs Revision</button>
            </div>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by name, reg no, or email...">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <!-- Desktop View -->
        <div class="projects-container">
            <table class="projects-table" id="studentsTable">
                <thead>
                    <tr>
                        <th>Student Details</th>
                        <th>Department & Level</th>
                        <th>Current Topic Status</th>
                        <th>Project Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

        <!-- Mobile View -->
        <div id="cardsContainer" class="project-cards"></div>
        <div id="emptyMessage" style="text-align:center; padding:3rem; display:none;">📭 No students found matching your criteria.</div>

        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Supervisor Portal | Kaduna Polytechnic
        </div>
    </main>
</div>

<script>
    // Mock Assigned Students Data
    let assignedStudents = [
        { 
            id: "S001", 
            regNo: "KP/CS/2022/001", 
            name: "Amina Bello", 
            email: "amina.bello@kadpoly.edu.ng", 
            dept: "Computer Science", 
            level: "HND2",
            topic: "AI-Powered Crop Disease Detection",
            status: "approved"
        },
        { 
            id: "S002", 
            regNo: "KP/CS/2022/045", 
            name: "Ibrahim Musa", 
            email: "ibrahim.musa@kadpoly.edu.ng", 
            dept: "Computer Science", 
            level: "HND1",
            topic: "Blockchain for Student Records",
            status: "pending"
        },
        { 
            id: "S003", 
            regNo: "KP/CE/2023/012", 
            name: "Fatima Sani", 
            email: "fatima.sani@kadpoly.edu.ng", 
            dept: "Computer Engineering", 
            level: "ND2",
            topic: "IoT Water Quality Monitor",
            status: "approved"
        },
        { 
            id: "S004", 
            regNo: "KP/CS/2023/088", 
            name: "Samuel John", 
            email: "samuel.john@kadpoly.edu.ng", 
            dept: "CS", 
            level: "ND1",
            topic: "E-Learning Platform",
            status: "revised"
        },
        { 
            id: "S005", 
            regNo: "KP/IT/2022/033", 
            name: "Zainab Idris", 
            email: "zainab.idris@kadpoly.edu.ng", 
            dept: "Info Tech", 
            level: "HND2",
            topic: "Cybersecurity Threat Intel",
            status: "pending"
        }
    ];

    let currentFilter = "all";
    let searchQuery = "";

    function updateStats() {
        const total = assignedStudents.length;
        const approved = assignedStudents.filter(s => s.status === "approved").length;
        const pending = assignedStudents.filter(s => s.status === "pending").length;
        const revised = assignedStudents.filter(s => s.status === "revised").length;

        document.getElementById("statsContainer").innerHTML = `
            <div class="stat-card" style="border-left-color: var(--kaduna-green);">
                <div class="stat-number">${total}</div>
                <div class="stat-title">Total Students</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--kaduna-green-light);">
                <div class="stat-number">${approved}</div>
                <div class="stat-title">Approved Topics</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--kaduna-gold);">
                <div class="stat-number">${pending}</div>
                <div class="stat-title">Pending Review</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--kaduna-red);">
                <div class="stat-number">${revised}</div>
                <div class="stat-title">Needs Revision</div>
            </div>
        `;
    }

    function renderStudents() {
        let filtered = assignedStudents.filter(s => {
            if (currentFilter !== "all" && s.status !== currentFilter) return false;
            if (searchQuery.trim()) {
                const q = searchQuery.toLowerCase();
                return s.name.toLowerCase().includes(q) || s.regNo.toLowerCase().includes(q) || s.email.toLowerCase().includes(q);
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

        // Table Rows
        tbody.innerHTML = filtered.map(s => `
            <tr>
                <td>
                    <div style="font-weight:700; color:var(--kaduna-charcoal);">${escapeHtml(s.name)}</div>
                    <div style="font-size:0.8rem; color:#6f7e6f;">${escapeHtml(s.regNo)}</div>
                </td>
                <td>
                    <div style="font-size:0.9rem;">${escapeHtml(s.dept)}</div>
                    <div style="font-size:0.75rem; color:#6f7e6f; font-weight:600;">LEVEL: ${s.level}</div>
                </td>
                <td style="max-width:250px;">
                    <div style="font-size:0.85rem; font-style:italic;">"${escapeHtml(s.topic)}"</div>
                </td>
                <td>
                    <span class="status-badge status-${s.status}">${s.status.toUpperCase()}</span>
                </td>
                <td>
                    <div style="display:flex; gap:8px;">
                        <a href="review_project.php?id=${s.id}" class="btn btn-view" title="View Details"><i class="fas fa-eye"></i></a>
                        <a href="messages.php?to=${s.id}" class="btn btn-review" title="Message Student" style="background:var(--kaduna-green-light); color:white;"><i class="fas fa-envelope"></i></a>
                    </div>
                </td>
            </tr>
        `).join("");

        // Mobile Cards
        cardsDiv.innerHTML = filtered.map(s => `
            <div class="project-card">
                <div class="card-header">
                    <span class="project-title">${escapeHtml(s.name)}</span>
                    <span class="status-badge status-${s.status}">${s.status.toUpperCase()}</span>
                </div>
                <div class="card-body">
                    <div class="student-info"><i class="fas fa-id-card"></i> ${escapeHtml(s.regNo)}</div>
                    <div class="student-info"><i class="fas fa-building"></i> ${escapeHtml(s.dept)} • ${s.level}</div>
                    <div class="topic-area"><strong>Topic:</strong> ${escapeHtml(s.topic)}</div>
                    <div class="card-actions">
                        <a href="review_project.php?id=${s.id}" class="btn btn-view"><i class="fas fa-eye"></i> View Project</a>
                        <a href="messages.php?to=${s.id}" class="btn btn-review" style="background:var(--kaduna-green-light); color:white;"><i class="fas fa-envelope"></i> Message</a>
                    </div>
                </div>
            </div>
        `).join("");
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

    // Event Listeners
    document.querySelectorAll(".filter-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            currentFilter = btn.getAttribute("data-filter");
            renderStudents();
        });
    });

    document.getElementById("searchBtn").addEventListener("click", () => {
        searchQuery = document.getElementById("searchInput").value;
        renderStudents();
    });

    document.getElementById("searchInput").addEventListener("keyup", (e) => {
        if (e.key === "Enter") { searchQuery = e.target.value; renderStudents(); }
    });

    // Logout
    function logoutDemo() { alert("Demo logout - redirect to login page."); }
    document.getElementById("logoutLink")?.addEventListener("click", (e) => { e.preventDefault(); logoutDemo(); });
    document.getElementById("logoutTop")?.addEventListener("click", (e) => { e.preventDefault(); logoutDemo(); });

    // Mobile Sidebar Toggle
    const toggleBtn = document.getElementById("mobileToggle");
    const sidebar = document.getElementById("sidebar");
    toggleBtn.addEventListener("click", () => sidebar.classList.toggle("open"));
    document.addEventListener("click", function(e) {
        if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
        }
    });

    // Initial Load
    updateStats();
    renderStudents();
</script>
</body>
</html>
