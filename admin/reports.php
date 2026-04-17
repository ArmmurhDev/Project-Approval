<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Reports & Analytics</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'reports'; include '../include/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-chart-line"></i> Reports & Analytics</h1>
                <p>Project statistics, trends, and data insights</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid" id="statsCards"></div>

        <!-- Charts -->
        <div class="charts-row">
            <div class="chart-card"><h3><i class="fas fa-chart-bar"></i> Project Status Distribution</h3><canvas id="statusChart"></canvas></div>
            <div class="chart-card"><h3><i class="fas fa-chart-line"></i> Monthly Submissions</h3><canvas id="monthlyChart"></canvas></div>
        </div>

        <!-- Export and Data Table -->
        <div class="export-bar">
            <button class="export-btn" id="exportCsvBtn"><i class="fas fa-file-csv"></i> Export CSV</button>
            <button class="export-btn" id="exportPrintBtn"><i class="fas fa-print"></i> Print Report</button>
        </div>
        <div class="reports-table-container">
            <table class="data-table" id="reportsTable">
                <thead>
                    <tr><th>Project Title</th><th>Student</th><th>Department</th><th>Submission Date</th><th>Status</th><th>Approval Date</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Comprehensive Project Reports
        </div>
    </main>
</div>

<script>
    // ---------- Mock Data ----------
    const projectsData = [
        { title: "AI-Powered Crop Disease Detection", student: "Amina Bello", dept: "Computer Science", subDate: "2025-03-10", status: "approved", approvalDate: "2025-03-15" },
        { title: "Blockchain for Student Records", student: "Ibrahim Musa", dept: "Computer Science", subDate: "2025-03-12", status: "rejected", approvalDate: "2025-03-18" },
        { title: "IoT Water Quality Monitor", student: "Fatima Sani", dept: "Computer Eng.", subDate: "2025-03-05", status: "approved", approvalDate: "2025-03-10" },
        { title: "E-Learning Platform with AI Tutor", student: "Samuel John", dept: "CS", subDate: "2025-03-01", status: "rejected", approvalDate: "2025-03-07" },
        { title: "Cybersecurity Threat Intelligence", student: "Zainab Idris", dept: "Cyber Sec", subDate: "2025-03-14", status: "pending", approvalDate: "—" },
        { title: "Smart Attendance System", student: "Oluwaseun Adeyemi", dept: "Computer Eng.", subDate: "2025-02-20", status: "approved", approvalDate: "2025-02-25" },
        { title: "Mobile Health Records", student: "Grace Emmanuel", dept: "Information Tech", subDate: "2025-02-15", status: "approved", approvalDate: "2025-02-22" },
        { title: "E-Voting Platform", student: "Musa Abdullahi", dept: "Cyber Security", subDate: "2025-01-28", status: "rejected", approvalDate: "2025-02-02" }
    ];

    // Compute stats
    const total = projectsData.length;
    const approved = projectsData.filter(p => p.status === "approved").length;
    const rejected = projectsData.filter(p => p.status === "rejected").length;
    const pending = projectsData.filter(p => p.status === "pending").length;

    document.getElementById("statsCards").innerHTML = `
        <div class="stat-card"><div class="stat-number">${total}</div><div class="stat-title">Total Projects</div></div>
        <div class="stat-card"><div class="stat-number" style="color:#0a5c36;">${approved}</div><div class="stat-title">Approved</div></div>
        <div class="stat-card"><div class="stat-number" style="color:#c0392b;">${rejected}</div><div class="stat-title">Rejected</div></div>
        <div class="stat-card"><div class="stat-number" style="color:#e6a017;">${pending}</div><div class="stat-title">Pending</div></div>
    `;

    // Populate table
    const tbody = document.getElementById("tableBody");
    function renderTable() {
        tbody.innerHTML = projectsData.map(p => `
            <tr>
                <td>${escapeHtml(p.title)}</td>
                <td>${escapeHtml(p.student)}</td>
                <td>${escapeHtml(p.dept)}</td>
                <td>${p.subDate}</td>
                <td><span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span></td>
                <td>${p.approvalDate}</td>
            </tr>
        `).join("");
    }

    function escapeHtml(str) { 
        if(!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if(m === '&') return '&amp;';
            if(m === '<') return '&lt;';
            if(m === '>') return '&gt;';
            return m;
        });
    }

    // Monthly submissions for chart (Jan-Mar)
    const monthNames = ["Jan", "Feb", "Mar"];
    const monthlyCounts = [1, 2, 5]; // Jan:1, Feb:2, Mar:5 based on data

    // Status Chart (Pie/Doughnut)
    const ctx1 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Rejected', 'Pending'],
            datasets: [{
                data: [approved, rejected, pending],
                backgroundColor: ['#0a5c36', '#c0392b', '#e6a017'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Monthly Bar Chart
    const ctx2 = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: monthNames,
            datasets: [{
                label: 'Projects Submitted',
                data: monthlyCounts,
                backgroundColor: '#2a7a4a',
                borderRadius: 8
            }]
        },
        options: { responsive: true, maintainAspectRatio: true, scales: { y: { beginAtZero: true, grid: { color: '#e0e6e0' } } } }
    });

    // Export CSV
    document.getElementById("exportCsvBtn").addEventListener("click", () => {
        let csvRows = [["Project Title", "Student", "Department", "Submission Date", "Status", "Approval Date"]];
        projectsData.forEach(p => {
            csvRows.push([p.title, p.student, p.dept, p.subDate, p.status, p.approvalDate]);
        });
        const csvContent = csvRows.map(row => row.map(cell => `"${cell}"`).join(",")).join("\n");
        const blob = new Blob([csvContent], { type: "text/csv" });
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "project_reports.csv";
        a.click();
        URL.revokeObjectURL(url);
    });

    // Print
    document.getElementById("exportPrintBtn").addEventListener("click", () => {
        const printWindow = window.open('', '_blank');
        const tableHtml = document.querySelector(".reports-table-container").cloneNode(true);
        const statsHtml = document.querySelector(".stats-grid").cloneNode(true);
        printWindow.document.write(`
            <html><head><title>Project Reports</title><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"><style>
                body { font-family: Inter, sans-serif; padding: 20px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                th { background: #f0f0f0; }
                .stats-grid { display: flex; gap: 20px; margin-bottom: 20px; }
                .stat-card { border-left: 4px solid #e6a017; padding: 10px; background: #fafafa; }
            </style></head>
            <body><h2>Topic Verifier - Project Reports</h2>${statsHtml.outerHTML}${tableHtml.outerHTML}</body></html>
        `);
        printWindow.document.close();
        printWindow.print();
    });

    // Logout demo
    function logoutDemo() { alert("Demo logout – redirect to login page."); }
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

    renderTable();
</script>

</body>
</html>