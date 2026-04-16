<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Reports & Analytics</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-name {
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
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--kaduna-green);
        }
        .stat-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #6f7e6f;
        }

        /* Charts Row */
        .charts-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .chart-card {
            background: white;
            border-radius: var(--radius);
            padding: 1rem;
            box-shadow: var(--shadow-sm);
        }
        .chart-card h3 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            color: var(--kaduna-charcoal);
        }
        canvas {
            max-height: 250px;
            width: 100%;
        }

        /* Export Bar */
        .export-bar {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .export-btn {
            background: var(--kaduna-gold);
            border: none;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Data Table */
        .reports-table-container {
            background: white;
            border-radius: var(--radius);
            overflow-x: auto;
            box-shadow: var(--shadow-sm);
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }
        .data-table th {
            background: var(--kaduna-cream);
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid var(--kaduna-gold);
        }
        .data-table td {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #e2e8e0;
        }
        .data-table tr:hover {
            background: #fafaf5;
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
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        .footer-note {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            color: #6f7e6f;
            font-size: 0.8rem;
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
            <li class="nav-item"><a href="admin_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="manage_students.html" class="nav-link"><i class="fas fa-users"></i> Students</a></li>
            <li class="nav-item"><a href="project_reviews.html" class="nav-link"><i class="fas fa-comment-dots"></i> Reviews</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-chart-pie"></i> Reports</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

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
<style>
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    .status-approved { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-pending { background: #fef3c7; color: #b45309; }
</style>
</body>
</html>