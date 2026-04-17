<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Project Reviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'reviews'; include '../include/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-comment-dots"></i> Project Reviews</h1>
                <p>Manage faculty feedback and approval recommendations</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="action-bar">
            <div class="filter-group" id="filterGroup">
                <button data-filter="all" class="filter-btn active">All Reviews</button>
                <button data-filter="approve" class="filter-btn">Approved</button>
                <button data-filter="reject" class="filter-btn">Rejected</button>
                <button data-filter="revise" class="filter-btn">Revise</button>
            </div>
            <div class="search-box">
                <input type="text" id="searchReviewInput" placeholder="Search by project, student, or reviewer...">
                <button id="searchReviewBtn"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>

        <!-- Table view for desktop -->
        <div class="reviews-container">
            <table class="review-table" id="reviewTable">
                <thead>
                    <tr><th>Project Title</th><th>Student</th><th>Reviewer</th><th>Recommendation</th><th>Review Date</th><th>Comments</th><th style="width:80px">Actions</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
            <!-- Card view for mobile -->
            <div id="cardsContainer" class="review-cards"></div>
            <div id="emptyMessage" class="empty-state" style="display: none;">📋 No reviews found. Add feedback to student projects.</div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Project Feedback & Approval Tracking
        </div>
    </main>
</div>

<!-- Add/Edit Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Add / Edit Review</h3>
        <input type="hidden" id="reviewId">
        <label>Project *</label>
        <select id="projectSelect"></select>
        <label>Reviewer (Lecturer) *</label>
        <select id="reviewerSelect"></select>
        <label>Recommendation *</label>
        <select id="recommendation">
            <option value="approve">Approve</option>
            <option value="reject">Reject</option>
            <option value="revise">Request Revision</option>
        </select>
        <label>Review Comments</label>
        <textarea id="reviewComments" rows="3" placeholder="Detailed feedback for the student..."></textarea>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-save" id="saveReviewBtn">Save Review</button>
        </div>
    </div>
</div>

<script>
    // ---------- Mock Data ----------
    let projects = [
        { id: "1", title: "AI-Powered Crop Disease Detection", student: "Amina Bello" },
        { id: "2", title: "Blockchain for Student Records", student: "Ibrahim Musa" },
        { id: "3", title: "IoT Water Quality Monitor", student: "Fatima Sani" },
        { id: "4", title: "E-Learning Platform with AI Tutor", student: "Samuel John" },
        { id: "5", title: "Cybersecurity Threat Intelligence", student: "Zainab Idris" }
    ];

    let lecturers = [
        { id: "1", name: "Prof. Adekunle Oluwole" },
        { id: "2", name: "Dr. Fatima Bello" },
        { id: "3", name: "Dr. Samuel Okonkwo" }
    ];

    let reviews = [
        { id: "1", projectId: "1", reviewerId: "1", recommendation: "approve", comments: "Excellent topic with clear methodology. Approved.", date: "2025-03-10" },
        { id: "2", projectId: "2", reviewerId: "2", recommendation: "revise", comments: "Please narrow down scope and add more references.", date: "2025-03-12" },
        { id: "3", projectId: "4", reviewerId: "3", recommendation: "reject", comments: "Topic already covered by previous project. Choose a novel area.", date: "2025-03-05" }
    ];
    let nextId = 4;

    let currentFilter = "all";
    let searchQuery = "";

    function getProjectTitle(pid) {
        let p = projects.find(p => p.id === pid);
        return p ? p.title : "Unknown";
    }
    function getStudentName(pid) {
        let p = projects.find(p => p.id === pid);
        return p ? p.student : "Unknown";
    }
    function getReviewerName(rid) {
        let r = lecturers.find(l => l.id === rid);
        return r ? r.name : "Unknown";
    }

    function renderReviews() {
        let filtered = reviews.filter(r => {
            if (currentFilter !== "all" && r.recommendation !== currentFilter) return false;
            if (searchQuery.trim() !== "") {
                const q = searchQuery.toLowerCase();
                const projectTitle = getProjectTitle(r.projectId).toLowerCase();
                const studentName = getStudentName(r.projectId).toLowerCase();
                const reviewer = getReviewerName(r.reviewerId).toLowerCase();
                return projectTitle.includes(q) || studentName.includes(q) || reviewer.includes(q);
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
        tbody.innerHTML = filtered.map(r => {
            let recClass = r.recommendation === 'approve' ? 'rec-approve' : (r.recommendation === 'reject' ? 'rec-reject' : 'rec-revise');
            let recText = r.recommendation.charAt(0).toUpperCase() + r.recommendation.slice(1);
            return `
                <tr>
                    <td>${escapeHtml(getProjectTitle(r.projectId))}</td>
                    <td>${escapeHtml(getStudentName(r.projectId))}</td>
                    <td>${escapeHtml(getReviewerName(r.reviewerId))}</td>
                    <td><span class="recommendation-badge ${recClass}">${recText}</span></td>
                    <td>${r.date}</td>
                    <td>${escapeHtml(r.comments.substring(0, 60))}${r.comments.length > 60 ? '…' : ''}</td>
                    <td class="action-icons">
                        <i class="fas fa-edit edit-icon" onclick="openEditModal('${r.id}')"></i>
                        <i class="fas fa-trash-alt delete-icon" onclick="deleteReview('${r.id}')"></i>
                    </td>
                </tr>
            `;
        }).join("");
        
        // Mobile cards
        cardsDiv.innerHTML = filtered.map(r => {
            let recClass = r.recommendation === 'approve' ? 'rec-approve' : (r.recommendation === 'reject' ? 'rec-reject' : 'rec-revise');
            let recText = r.recommendation.charAt(0).toUpperCase() + r.recommendation.slice(1);
            return `
                <div class="review-card">
                    <h4>${escapeHtml(getProjectTitle(r.projectId))}</h4>
                    <p><i class="fas fa-user"></i> Student: ${escapeHtml(getStudentName(r.projectId))}</p>
                    <p><i class="fas fa-chalkboard-teacher"></i> Reviewer: ${escapeHtml(getReviewerName(r.reviewerId))}</p>
                    <p><span class="recommendation-badge ${recClass}">${recText}</span> • ${r.date}</p>
                    <p><i class="fas fa-comment"></i> ${escapeHtml(r.comments.substring(0, 80))}${r.comments.length > 80 ? '…' : ''}</p>
                    <div class="card-actions">
                        <i class="fas fa-edit edit-icon" onclick="openEditModal('${r.id}')"></i>
                        <i class="fas fa-trash-alt delete-icon" onclick="deleteReview('${r.id}')"></i>
                    </div>
                </div>
            `;
        }).join("");
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
    
    // Populate project and lecturer dropdowns in modal
    function populateSelectors() {
        const projectSelect = document.getElementById("projectSelect");
        projectSelect.innerHTML = '<option value="">-- Select Project --</option>' + projects.map(p => `<option value="${p.id}">${escapeHtml(p.title)} (${escapeHtml(p.student)})</option>`).join("");
        const reviewerSelect = document.getElementById("reviewerSelect");
        reviewerSelect.innerHTML = '<option value="">-- Select Reviewer --</option>' + lecturers.map(l => `<option value="${l.id}">${escapeHtml(l.name)}</option>`).join("");
    }
    
    // Modal handling
    const modal = document.getElementById("reviewModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; resetForm(); }
    
    function resetForm() {
        document.getElementById("reviewId").value = "";
        document.getElementById("projectSelect").value = "";
        document.getElementById("reviewerSelect").value = "";
        document.getElementById("recommendation").value = "approve";
        document.getElementById("reviewComments").value = "";
        document.getElementById("modalTitle").innerText = "Add New Review";
    }
    
    function openEditModal(id) {
        const review = reviews.find(r => r.id === id);
        if(review) {
            document.getElementById("reviewId").value = review.id;
            document.getElementById("projectSelect").value = review.projectId;
            document.getElementById("reviewerSelect").value = review.reviewerId;
            document.getElementById("recommendation").value = review.recommendation;
            document.getElementById("reviewComments").value = review.comments;
            document.getElementById("modalTitle").innerText = "Edit Review";
            openModal();
        }
    }
    
    function saveReview() {
        const id = document.getElementById("reviewId").value;
        const projectId = document.getElementById("projectSelect").value;
        const reviewerId = document.getElementById("reviewerSelect").value;
        const recommendation = document.getElementById("recommendation").value;
        const comments = document.getElementById("reviewComments").value.trim();
        
        if(!projectId || !reviewerId) {
            alert("Please select a project and a reviewer.");
            return;
        }
        const today = new Date().toISOString().slice(0,10);
        
        if(id) { // edit
            const index = reviews.findIndex(r => r.id === id);
            if(index !== -1) {
                reviews[index] = { ...reviews[index], projectId, reviewerId, recommendation, comments, date: today };
            }
        } else { // add
            const newId = String(nextId++);
            reviews.push({ id: newId, projectId, reviewerId, recommendation, comments, date: today });
        }
        renderReviews();
        closeModal();
    }
    
    window.deleteReview = function(id) {
        if(confirm("Delete this review? This action cannot be undone.")) {
            reviews = reviews.filter(r => r.id !== id);
            renderReviews();
        }
    };
    
    window.openEditModal = openEditModal;
    
    // Filter and search
    document.querySelectorAll(".filter-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            currentFilter = btn.getAttribute("data-filter");
            renderReviews();
        });
    });
    document.getElementById("searchReviewBtn").addEventListener("click", () => {
        searchQuery = document.getElementById("searchReviewInput").value;
        renderReviews();
    });
    document.getElementById("searchReviewInput").addEventListener("keyup", (e) => { if(e.key === "Enter") { searchQuery = e.target.value; renderReviews(); } });
    
    // Modal event listeners
    document.getElementById("addReviewBtn")?.removeEventListener; // not needed, we'll add button in action bar? Actually we need an "Add Review" button
    // Add a button to action bar for new review
    const actionBar = document.querySelector(".action-bar");
    const addBtn = document.createElement("button");
    addBtn.className = "add-lecturer-btn"; // reuse style
    addBtn.innerHTML = '<i class="fas fa-plus-circle"></i> Add Review';
    addBtn.style.background = "var(--kaduna-gold)";
    addBtn.style.color = "#2c2c1c";
    addBtn.onclick = () => { resetForm(); populateSelectors(); openModal(); };
    actionBar.insertBefore(addBtn, actionBar.firstChild);
    
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("saveReviewBtn").addEventListener("click", saveReview);
    
    // Close modal on outside click
    window.onclick = function(e) { if(e.target === modal) closeModal(); };
    
    // Logout demos
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
    
    // Initial render
    populateSelectors();
    renderReviews();
</script>
</body>
</html>