<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Review Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/lecturer.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'review_project'; include '../include/lecturer_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-edit"></i> Review Project</h1>
                <p>Evaluate project proposal and submit recommendation</p>
            </div>
            <div class="user-profile">
                <span class="user-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span>
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

                <!-- Review Form -->
                <div class="review-section">
                    <h3><i class="fas fa-comment-dots"></i> Submit Your Review</h3>
                    <div class="form-group">
                        <label>Recommendation *</label>
                        <select id="recommendation">
                            <option value="approve">✅ Approve – Topic is novel and feasible</option>
                            <option value="reject">❌ Reject – Topic unsuitable or duplicated</option>
                            <option value="revise">🔄 Request Revision – Needs modifications</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Feedback / Comments *</label>
                        <textarea id="comments" rows="4" placeholder="Provide detailed feedback for the student..."></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button class="btn-submit" id="submitReviewBtn"><i class="fas fa-paper-plane"></i> Submit Review</button>
                        <a href="assigned_projects.html" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Assigned Projects</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Project Review Portal
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Mock project data (simulating passed ID, e.g., from URL param)
    const project = {
        id: "P001",
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
            <div class="info-item"><div class="info-label">Current Status</div><div class="info-value"><span class="status-badge" style="background:#fef3c7;color:#b45309;padding:4px 12px;border-radius:50px;">${project.currentStatus.toUpperCase()}</span></div></div>
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

    function submitReview() {
        const recommendation = document.getElementById("recommendation").value;
        const comments = document.getElementById("comments").value.trim();
        if (!comments) {
            alert("Please provide feedback comments.");
            return;
        }
        // Simulate API call
        showToast(`Review submitted! Recommendation: ${recommendation.toUpperCase()}. Feedback recorded.`, "success");
        // In real scenario, redirect or update UI
        setTimeout(() => {
            // Disable submit button to prevent double submission
            const btn = document.getElementById("submitReviewBtn");
            btn.disabled = true;
            btn.style.opacity = "0.6";
            btn.innerText = "Submitted";
        }, 500);
    }

    document.getElementById("submitReviewBtn").addEventListener("click", submitReview);

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

    // Initial render
    renderProjectDetails();
</script>
</body>
</html>