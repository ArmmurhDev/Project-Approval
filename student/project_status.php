<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Project Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'status'; include '../include/student_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-chart-simple"></i> Project Status</h1>
                <p>Track the progress of your project submissions</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello (KP/CS/2022/001)</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="stats-grid" id="statsContainer"></div>

        <div class="projects-grid" id="projectsGrid"></div>
        <div id="emptyMessage" style="text-align:center; padding:2rem; display:none;">📭 You haven't submitted any projects yet.</div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Real-time project approval tracking
        </div>
    </main>
</div>

<script>
    // Mock project data for a student
    let projects = [
        { 
            id: "P001", 
            title: "AI-Powered Crop Disease Detection", 
            topics: "Machine Learning, CNN, Agriculture",
            submissionDate: "2025-03-10",
            status: "approved",
            feedback: "Excellent topic with clear methodology. Approved for implementation. Supervisor assigned: Dr. Fatima Bello",
            reviewDate: "2025-03-15",
            reviewer: "Dr. Fatima Bello"
        },
        { 
            id: "P002", 
            title: "Blockchain for Student Records", 
            topics: "Blockchain, Smart Contracts",
            submissionDate: "2025-03-12",
            status: "pending",
            feedback: "",
            reviewDate: null,
            reviewer: null
        },
        { 
            id: "P003", 
            title: "Mobile Health Records System", 
            topics: "Mobile Dev, Healthcare, Firebase",
            submissionDate: "2025-02-20",
            status: "rejected",
            feedback: "Topic already covered by previous project (2024). Please choose a more novel area with clear differentiation.",
            reviewDate: "2025-02-28",
            reviewer: "Prof. Adekunle Oluwole"
        }
    ];

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

    function getProgressSteps(status) {
        const steps = [
            { name: "Proposal Submitted", key: "submitted" },
            { name: "Under Review", key: "review" },
            { name: "Final Decision", key: "decision" }
        ];
        if (status === "pending") {
            return steps.map(step => ({
                ...step,
                completed: step.key === "submitted",
                current: step.key === "review"
            }));
        } else if (status === "approved" || status === "rejected") {
            return steps.map(step => ({
                ...step,
                completed: true,
                current: false
            }));
        }
        return steps;
    }

    function renderProjects() {
        const container = document.getElementById("projectsGrid");
        const emptyMsg = document.getElementById("emptyMessage");
        if (projects.length === 0) {
            container.innerHTML = "";
            emptyMsg.style.display = "block";
            return;
        }
        emptyMsg.style.display = "none";
        container.innerHTML = projects.map(p => {
            const steps = getProgressSteps(p.status);
            return `
                <div class="project-card">
                    <div class="card-header">
                        <span class="project-title">${escapeHtml(p.title)}</span>
                        <span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span>
                    </div>
                    <div class="card-body">
                        <div class="info-row"><i class="fas fa-tags"></i> Topics: ${escapeHtml(p.topics)}</div>
                        <div class="info-row"><i class="fas fa-calendar-alt"></i> Submitted: ${p.submissionDate}</div>
                        ${p.reviewDate ? `<div class="info-row"><i class="fas fa-clock"></i> Reviewed: ${p.reviewDate}</div>` : ''}
                        
                        <div class="progress-track">
                            ${steps.map(step => `
                                <div class="progress-step">
                                    <div class="step-icon ${step.completed ? 'completed' : (step.current ? 'current' : '')}">
                                        ${step.completed ? '<i class="fas fa-check"></i>' : (step.current ? '<i class="fas fa-spinner fa-pulse"></i>' : '<i class="fas fa-circle-notch"></i>')}
                                    </div>
                                    <div class="step-text">${step.name}</div>
                                </div>
                            `).join('')}
                        </div>
                        
                        ${p.feedback ? `
                            <div class="feedback-area">
                                <i class="fas fa-comment-dots"></i> <strong>Feedback from ${escapeHtml(p.reviewer || 'Reviewer')}:</strong><br>
                                ${escapeHtml(p.feedback)}
                            </div>
                        ` : `
                            <div class="feedback-area">
                                <i class="fas fa-hourglass-half"></i> <strong>Awaiting Review</strong><br>
                                Your project is in queue. You will be notified once reviewed.
                            </div>
                        `}
                    </div>
                </div>
            `;
        }).join("");
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

    // Logout demo
    function logoutDemo() { alert("Logged out – redirect to login page."); }
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