<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Edit Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'edit_project'; include '../include/student_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-edit"></i> Edit Project Proposal</h1>
                <p>Modify your project details before final submission</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="warning-banner">
            <i class="fas fa-info-circle"></i>
            <span><strong>Note:</strong> You can only edit projects that are still <strong>pending review</strong>. Once approved or rejected, editing is disabled.</span>
        </div>

        <div class="form-card">
            <div class="card-header">
                <h2><i class="fas fa-file-alt"></i> Project Information</h2>
            </div>
            <div class="card-body">
                <form id="editProjectForm">
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
                                <option value="Computer Science" selected>Computer Science</option>
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
                        <input type="text" id="projectTitle" placeholder="e.g., AI-Powered Crop Disease Detection" required>
                    </div>

                    <div class="form-group">
                        <label>Topic Keywords <span class="required">*</span></label>
                        <input type="text" id="topics" placeholder="e.g., Machine Learning, CNN, Agriculture" required>
                        <small>Separate keywords with commas</small>
                    </div>

                    <div class="form-group">
                        <label>Abstract / Description <span class="required">*</span></label>
                        <textarea id="description" rows="4" placeholder="Provide a clear description of your project..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Methodology <span class="required">*</span></label>
                        <textarea id="methodology" rows="3" placeholder="Describe your research methods and approach..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Proposed Supervisor (Optional)</label>
                        <input type="text" id="supervisor" placeholder="e.g., Dr. Fatima Bello">
                    </div>

                    <div class="modal-buttons">
                        <button type="button" class="btn-update" id="updateBtn"><i class="fas fa-save"></i> Update Project</button>
                        <a href="student_dashboard.php" class="btn-cancel"><i class="fas fa-arrow-left"></i> Cancel & Go Back</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Edit your pending project proposal
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Mock existing project data (simulating a pending project)
    const mockProject = {
        id: "P002",
        title: "Blockchain for Student Records",
        topics: "Blockchain, Smart Contracts, Ethereum",
        description: "A decentralized system for storing and verifying student academic records using blockchain technology to prevent fraud and ensure data integrity.",
        methodology: "Develop smart contracts on Ethereum, build a web interface with Web3.js, and deploy IPFS for document storage.",
        supervisor: "Dr. Fatima Bello",
        status: "pending"
    };

    // Populate form with existing data
    document.getElementById("projectTitle").value = mockProject.title;
    document.getElementById("topics").value = mockProject.topics;
    document.getElementById("description").value = mockProject.description;
    document.getElementById("methodology").value = mockProject.methodology;
    document.getElementById("supervisor").value = mockProject.supervisor;

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

    function updateProject() {
        if (!validateForm()) return;
        
        const updatedData = {
            id: mockProject.id,
            title: document.getElementById("projectTitle").value.trim(),
            topics: document.getElementById("topics").value.trim(),
            description: document.getElementById("description").value.trim(),
            methodology: document.getElementById("methodology").value.trim(),
            supervisor: document.getElementById("supervisor").value.trim(),
            department: document.getElementById("department").value,
            level: document.getElementById("level").value,
            status: "pending"
        };
        
        console.log("Updating project:", updatedData);
        
        // Simulate API call
        showToast(`Project "${updatedData.title}" updated successfully!`, "success");
        
        // In a real implementation, you would send data to server via fetch/AJAX
        // and redirect to dashboard after success
        setTimeout(() => {
            // window.location.href = "student_dashboard.html";
        }, 1500);
    }

    document.getElementById("updateBtn").addEventListener("click", updateProject);

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