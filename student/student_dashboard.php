<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'dashboard'; include '../include/student_sidebar.php'; ?>
    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
                <p>Track your project proposals and feedback</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello (KP/CS/2022/001)</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="stats-grid" id="statsContainer"></div>

        <div class="action-bar">
            <button class="btn-primary" id="newProjectBtn"><i class="fas fa-plus-circle"></i> Submit New Project</button>
        </div>

        <div class="projects-grid" id="projectsGrid"></div>
        <div id="emptyMessage" style="text-align:center; padding:2rem; display:none;">📭 You haven't submitted any projects yet. Click "Submit New Project" to begin.</div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Student Project Portal
        </div>
    </main>
</div>

<!-- Submit/Edit Project Modal -->
<div id="projectModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Submit New Project</h3>
        <input type="hidden" id="editProjectId">
        <label>Project Title *</label>
        <input type="text" id="projectTitle" placeholder="e.g., AI-Powered Crop Disease Detection">
        <label>Topic Keywords *</label>
        <input type="text" id="projectTopics" placeholder="e.g., Machine Learning, CNN, Agriculture">
        <label>Abstract / Description *</label>
        <textarea id="projectDesc" rows="3" placeholder="Brief description of your project..."></textarea>
        <label>Methodology *</label>
        <textarea id="projectMethod" rows="2" placeholder="Research methods, tools, technologies..."></textarea>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-save" id="saveProjectBtn">Submit Project</button>
        </div>
    </div>
</div>

<script>
    // Mock data for student projects (initially 2 projects)
    let projects = [
        { id: "P001", title: "AI-Powered Crop Disease Detection", topics: "Machine Learning, CNN, Agriculture", description: "Deep learning model to detect cassava diseases from leaf images.", methodology: "Data collection from farms, CNN training with TensorFlow, mobile app integration.", status: "approved", feedback: "Excellent topic. Approved for implementation.", submissionDate: "2025-03-10", approvalDate: "2025-03-15" },
        { id: "P002", title: "Blockchain for Student Records", topics: "Blockchain, Smart Contracts", description: "Decentralized record keeping for academic credentials.", methodology: "Ethereum smart contracts, IPFS storage, web3.js.", status: "pending", feedback: "", submissionDate: "2025-03-12", approvalDate: "" }
    ];
    let nextId = 3;

    function updateStats() {
        const total = projects.length;
        const pending = projects.filter(p => p.status === "pending").length;
        const approved = projects.filter(p => p.status === "approved").length;
        const rejected = projects.filter(p => p.status === "rejected").length;
        document.getElementById("statsContainer").innerHTML = `
            <div class="stat-card"><div class="stat-number">${total}</div><div class="stat-title">Total Projects</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#e6a017;">${pending}</div><div class="stat-title">Pending Review</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#0a5c36;">${approved}</div><div class="stat-title">Approved</div></div>
            <div class="stat-card"><div class="stat-number" style="color:#c0392b;">${rejected}</div><div class="stat-title">Rejected</div></div>
        `;
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
        container.innerHTML = projects.map(p => `
            <div class="project-card">
                <div class="card-header">
                    <span class="project-title">${escapeHtml(p.title)}</span>
                    <span class="status-badge status-${p.status}">${p.status.toUpperCase()}</span>
                </div>
                <div class="card-body">
                    <div class="info-row"><i class="fas fa-tags"></i> Topics: ${escapeHtml(p.topics)}</div>
                    <div class="info-row"><i class="fas fa-calendar-alt"></i> Submitted: ${p.submissionDate}</div>
                    ${p.approvalDate ? `<div class="info-row"><i class="fas fa-check-circle"></i> Decision Date: ${p.approvalDate}</div>` : ''}
                    ${p.feedback ? `<div class="feedback-area"><i class="fas fa-comment-dots"></i> <strong>Feedback:</strong> ${escapeHtml(p.feedback)}</div>` : ''}
                    <div style="margin-top: 12px; display: flex; gap: 8px;">
                        ${p.status === 'pending' ? `<button class="btn-edit" onclick="openEditModal('${p.id}')"><i class="fas fa-edit"></i> Edit</button>` : ''}
                        <button class="btn-view" onclick="viewDetails('${p.id}')"><i class="fas fa-eye"></i> Details</button>
                    </div>
                </div>
            </div>
        `).join("");
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

    // Modal logic for new/edit project
    const modal = document.getElementById("projectModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; resetForm(); }
    function resetForm() {
        document.getElementById("editProjectId").value = "";
        document.getElementById("projectTitle").value = "";
        document.getElementById("projectTopics").value = "";
        document.getElementById("projectDesc").value = "";
        document.getElementById("projectMethod").value = "";
        document.getElementById("modalTitle").innerText = "Submit New Project";
    }

    function openEditModal(id) {
        const project = projects.find(p => p.id === id);
        if (project) {
            document.getElementById("editProjectId").value = project.id;
            document.getElementById("projectTitle").value = project.title;
            document.getElementById("projectTopics").value = project.topics;
            document.getElementById("projectDesc").value = project.description;
            document.getElementById("projectMethod").value = project.methodology;
            document.getElementById("modalTitle").innerText = "Edit Project";
            openModal();
        }
    }

    function saveProject() {
        const id = document.getElementById("editProjectId").value;
        const title = document.getElementById("projectTitle").value.trim();
        const topics = document.getElementById("projectTopics").value.trim();
        const description = document.getElementById("projectDesc").value.trim();
        const methodology = document.getElementById("projectMethod").value.trim();
        if (!title || !topics || !description || !methodology) {
            alert("Please fill all required fields.");
            return;
        }
        const today = new Date().toISOString().slice(0,10);
        if (id) { // edit existing pending project
            const index = projects.findIndex(p => p.id === id);
            if (index !== -1 && projects[index].status === "pending") {
                projects[index] = { ...projects[index], title, topics, description, methodology, submissionDate: today };
                alert("Project updated successfully!");
            } else {
                alert("Cannot edit: Project already reviewed or not found.");
            }
        } else { // new project
            const newId = "P00" + nextId++;
            projects.push({
                id: newId, title, topics, description, methodology,
                status: "pending", feedback: "", submissionDate: today, approvalDate: ""
            });
            alert("New project submitted successfully!");
        }
        updateStats();
        renderProjects();
        closeModal();
    }

    window.openEditModal = openEditModal;
    window.viewDetails = function(id) {
        const p = projects.find(p => p.id === id);
        if (p) {
            alert(`Project: ${p.title}\nTopics: ${p.topics}\nStatus: ${p.status.toUpperCase()}\nDescription: ${p.description}\nMethodology: ${p.methodology}\nFeedback: ${p.feedback || "No feedback yet"}`);
        }
    };

    document.getElementById("newProjectBtn").addEventListener("click", () => { resetForm(); openModal(); });
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("saveProjectBtn").addEventListener("click", saveProject);
    window.onclick = function(e) { if (e.target === modal) closeModal(); };

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