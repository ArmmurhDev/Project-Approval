<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Submit Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'submit_project'; include '../include/student_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-upload"></i> Submit Project Proposal</h1>
                <p>Fill in the details below to submit your project for approval</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello (KP/CS/2022/001)</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="form-card">
            <div class="card-header">
                <h2><i class="fas fa-file-alt"></i> Project Submission Form</h2>
            </div>
            <div class="card-body">
                <form id="projectForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" id="fullName" value="Amina Bello" readonly>
                        </div>
                        <div class="form-group">
                            <label>Registration Number <span class="required">*</span></label>
                            <input type="text" id="regNo" value="KP/CS/2022/001" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Department <span class="required">*</span></label>
                            <select id="department">
                                <option value="Computer Science">Computer Science</option>
                                <option value="Computer Engineering">Computer Engineering</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Cyber Security">Cyber Security</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level <span class="required">*</span></label>
                            <select id="level">
                                <option>ND1</option><option>ND2</option><option>HND1</option><option selected>HND2</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Project Title <span class="required">*</span></label>
                        <input type="text" id="projectTitle" placeholder="e.g., AI-Powered Crop Disease Detection for Nigerian Farmers" required>
                    </div>

                    <div class="form-group">
                        <label>Topic Keywords <span class="required">*</span></label>
                        <input type="text" id="topics" placeholder="e.g., Machine Learning, Computer Vision, Agriculture" required>
                        <small>Separate keywords with commas</small>
                    </div>

                    <div class="form-group">
                        <label>Abstract / Description <span class="required">*</span></label>
                        <textarea id="description" rows="4" placeholder="Provide a clear description of your project, its objectives, and expected outcomes..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Methodology <span class="required">*</span></label>
                        <textarea id="methodology" rows="3" placeholder="Describe the research methods, tools, technologies, and approach you will use..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Proposed Supervisor (Optional)</label>
                        <input type="text" id="supervisor" placeholder="e.g., Dr. Fatima Bello">
                    </div>

                    <div class="modal-buttons">
                        <button type="button" class="btn-submit" id="submitBtn"><i class="fas fa-paper-plane"></i> Submit Proposal</button>
                        <button type="reset" class="btn-reset" id="resetBtn"><i class="fas fa-undo-alt"></i> Clear Form</button>
                        <a href="student_dashboard.php" class="btn-reset"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Submit your project for review and approval
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
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

    function validateForm() {
        const title = document.getElementById("projectTitle").value.trim();
        const topics = document.getElementById("topics").value.trim();
        const description = document.getElementById("description").value.trim();
        const methodology = document.getElementById("methodology").value.trim();
        
        if (!title) {
            alert("Please enter a project title.");
            return false;
        }
        if (!topics) {
            alert("Please enter topic keywords.");
            return false;
        }
        if (!description) {
            alert("Please provide a project description.");
            return false;
        }
        if (!methodology) {
            alert("Please describe your methodology.");
            return false;
        }
        return true;
    }

    function submitProject() {
        if (!validateForm()) return;
        
        const formData = {
            fullName: document.getElementById("fullName").value,
            regNo: document.getElementById("regNo").value,
            department: document.getElementById("department").value,
            level: document.getElementById("level").value,
            title: document.getElementById("projectTitle").value.trim(),
            topics: document.getElementById("topics").value.trim(),
            description: document.getElementById("description").value.trim(),
            methodology: document.getElementById("methodology").value.trim(),
            supervisor: document.getElementById("supervisor").value.trim(),
            submissionDate: new Date().toISOString().slice(0,10)
        };
        
        console.log("Submitting project:", formData);
        
        // Simulate API call
        showToast(`Project "${formData.title}" submitted successfully! Awaiting review.`, "success");
        
        // Optionally reset form after successful submission
        // document.getElementById("projectForm").reset();
        
        // In a real implementation, you would send data to server via fetch/AJAX
        // and redirect to dashboard after success
        setTimeout(() => {
            // window.location.href = "student_dashboard.html";
        }, 2000);
    }

    document.getElementById("submitBtn").addEventListener("click", submitProject);
    document.getElementById("resetBtn").addEventListener("click", () => {
        document.getElementById("projectForm").reset();
        // Reset readonly fields to default values
        document.getElementById("fullName").value = "Amina Bello";
        document.getElementById("regNo").value = "KP/CS/2022/001";
        document.getElementById("department").value = "Computer Science";
        document.getElementById("level").value = "HND2";
    });

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
</script>
</body>
</html>