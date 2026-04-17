<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Approve / Reject Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'approve_reject'; include '../include/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-gavel"></i> Project Approval</h1>
                <p>Review project details and make final decision</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <!-- Project Details Card (dynamic) -->
        <div class="project-card" id="projectCard">
            <div class="card-header">
                <h2 id="projectTitle">Loading...</h2>
            </div>
            <div class="card-body">
                <div class="info-grid" id="infoGrid"></div>
                <div class="comment-section">
                    <label><i class="fas fa-comment-dots"></i> Decision Comments (optional)</label>
                    <textarea id="decisionComments" rows="3" placeholder="Provide reason for approval or rejection..."></textarea>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-approve" id="approveBtn"><i class="fas fa-check-circle"></i> Approve Project</button>
                    <button class="btn btn-reject" id="rejectBtn"><i class="fas fa-times-circle"></i> Reject Project</button>
                </div>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Final Approval Workflow | Kaduna Polytechnic
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Mock data for a specific project (normally passed via URL param, e.g., ?id=1)
    // Simulating a pending project
    const project = {
        id: "101",
        title: "AI-Powered Crop Disease Detection for Nigerian Farmers",
        student: "Amina Bello",
        regNo: "KP/CS/2022/001",
        email: "amina.bello@kadpoly.edu.ng",
        department: "Computer Science",
        level: "HND2",
        supervisor: "Dr. Fatima Bello",
        topics: "Machine Learning, Convolutional Neural Networks, Agriculture",
        description: "This project aims to develop a deep learning model to detect cassava diseases from leaf images, providing real-time diagnosis for farmers.",
        methodology: "Data collection from local farms, image preprocessing, CNN model training using TensorFlow, and mobile app integration.",
        submissionDate: "2025-03-10",
        currentStatus: "pending"
    };

    function showToast(message, type = "success") {
        const toast = document.getElementById("toast");
        const msgSpan = document.getElementById("toastMsg");
        msgSpan.innerText = message;
        toast.className = `toast ${type}`;
        toast.style.display = "flex";
        setTimeout(() => {
            toast.style.display = "none";
        }, 3000);
    }

    function renderProjectDetails() {
        document.getElementById("projectTitle").innerText = project.title;
        const infoGrid = document.getElementById("infoGrid");
        infoGrid.innerHTML = `
            <div class="info-item"><div class="info-label">Student Name</div><div class="info-value">${escapeHtml(project.student)}</div></div>
            <div class="info-item"><div class="info-label">Registration No.</div><div class="info-value">${escapeHtml(project.regNo)}</div></div>
            <div class="info-item"><div class="info-label">Email</div><div class="info-value">${escapeHtml(project.email)}</div></div>
            <div class="info-item"><div class="info-label">Department / Level</div><div class="info-value">${escapeHtml(project.department)} • ${escapeHtml(project.level)}</div></div>
            <div class="info-item"><div class="info-label">Supervisor</div><div class="info-value">${escapeHtml(project.supervisor)}</div></div>
            <div class="info-item"><div class="info-label">Submission Date</div><div class="info-value">${project.submissionDate}</div></div>
            <div class="info-item full-width"><div class="info-label">Project Topics</div><div class="info-value">${escapeHtml(project.topics)}</div></div>
            <div class="info-item full-width"><div class="info-label">Abstract / Description</div><div class="info-value">${escapeHtml(project.description)}</div></div>
            <div class="info-item full-width"><div class="info-label">Methodology</div><div class="info-value">${escapeHtml(project.methodology)}</div></div>
            <div class="info-item"><div class="info-label">Current Status</div><div class="info-value"><span class="status-badge status-${project.currentStatus}">${project.currentStatus.toUpperCase()}</span></div></div>
        `;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function approveProject() {
        const comments = document.getElementById("decisionComments").value.trim();
        if (confirm(`Are you sure you want to APPROVE this project?\n${comments ? 'Comments: ' + comments : 'No comments provided'}`)) {
            // Simulate API call
            showToast(`Project "${project.title}" has been APPROVED successfully.`, "success");
            // In real scenario, redirect or update UI
            setTimeout(() => {
                // Optionally disable buttons
                document.getElementById("approveBtn").disabled = true;
                document.getElementById("rejectBtn").disabled = true;
                document.getElementById("approveBtn").style.opacity = "0.5";
                document.getElementById("rejectBtn").style.opacity = "0.5";
                // Update status display
                project.currentStatus = "approved";
                renderProjectDetails();
            }, 500);
        }
    }

    function rejectProject() {
        const comments = document.getElementById("decisionComments").value.trim();
        if (!comments) {
            alert("Please provide a reason for rejection before proceeding.");
            return;
        }
        if (confirm(`Are you sure you want to REJECT this project?\nReason: ${comments}`)) {
            showToast(`Project "${project.title}" has been REJECTED.`, "error");
            setTimeout(() => {
                document.getElementById("approveBtn").disabled = true;
                document.getElementById("rejectBtn").disabled = true;
                document.getElementById("approveBtn").style.opacity = "0.5";
                document.getElementById("rejectBtn").style.opacity = "0.5";
                project.currentStatus = "rejected";
                renderProjectDetails();
            }, 500);
        }
    }

    // Event listeners
    document.getElementById("approveBtn").addEventListener("click", approveProject);
    document.getElementById("rejectBtn").addEventListener("click", rejectProject);

    // Logout demo
    function logoutDemo() { alert("Demo logout – redirect to login page."); }
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

    // Initial render
    renderProjectDetails();
</script>
</body>
</html>