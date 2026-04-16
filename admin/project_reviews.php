<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Project Reviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Action Bar */
        .action-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 60px;
        }

        .filter-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 20px;
            border-radius: 40px;
            background: #f0f2f0;
            border: none;
            font-weight: 500;
            color: #2c442c;
            cursor: pointer;
            transition: 0.2s;
        }

        .filter-btn.active, .filter-btn:hover {
            background: var(--kaduna-green);
            color: white;
        }

        .search-box {
            display: flex;
            gap: 8px;
        }

        .search-box input {
            padding: 10px 18px;
            border-radius: 50px;
            border: 1px solid #ddd;
            min-width: 260px;
            font-family: 'Inter', sans-serif;
        }

        .search-box button {
            background: var(--kaduna-gold);
            border: none;
            padding: 0 20px;
            border-radius: 50px;
            color: #2c2c1c;
            cursor: pointer;
            font-weight: 600;
        }

        /* Reviews Table / Card Grid */
        .reviews-container {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .review-table {
            width: 100%;
            border-collapse: collapse;
        }

        .review-table th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: var(--kaduna-cream);
            color: var(--kaduna-charcoal);
            font-weight: 600;
            border-bottom: 2px solid var(--kaduna-gold);
        }

        .review-table td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #e2e8e0;
            vertical-align: middle;
        }

        .review-table tr:hover {
            background: #fafaf5;
        }

        .action-icons {
            display: flex;
            gap: 12px;
        }

        .edit-icon, .delete-icon {
            cursor: pointer;
            font-size: 1.2rem;
            transition: 0.2s;
        }

        .edit-icon { color: var(--kaduna-gold-dark); }
        .delete-icon { color: var(--kaduna-red); }
        .edit-icon:hover { color: var(--kaduna-gold); transform: scale(1.1); }
        .delete-icon:hover { color: #a82315; transform: scale(1.1); }

        .recommendation-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .rec-approve { background: #dcfce7; color: #166534; }
        .rec-reject { background: #fee2e2; color: #b91c1c; }
        .rec-revise { background: #fef3c7; color: #b45309; }

        /* Mobile card view */
        .review-cards {
            display: none;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .review-card {
            background: white;
            border-radius: var(--radius-sm);
            padding: 1rem;
            border: 1px solid #e2e8e0;
            box-shadow: var(--shadow-sm);
        }

        .review-card h4 {
            color: var(--kaduna-green);
            margin-bottom: 0.5rem;
        }

        .review-card p {
            font-size: 0.85rem;
            margin: 6px 0;
            color: #4a5b4a;
        }

        .card-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 12px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            max-width: 550px;
            width: 90%;
            border-radius: 28px;
            padding: 1.8rem;
            position: relative;
        }

        .modal-content h3 {
            margin-bottom: 1rem;
            color: var(--kaduna-charcoal);
        }

        .modal-content input, .modal-content select, .modal-content textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-family: 'Inter', sans-serif;
        }

        .form-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .form-row .field-group {
            flex: 1;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 1rem;
        }

        .btn-cancel {
            background: #eef2ee;
            border: none;
            padding: 8px 20px;
            border-radius: 40px;
            cursor: pointer;
        }

        .btn-save {
            background: var(--kaduna-green);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 40px;
            cursor: pointer;
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

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #7a8a7a;
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

        @media (max-width: 768px) {
            .review-table {
                display: none;
            }
            .review-cards {
                display: grid;
            }
            .action-bar {
                flex-direction: column;
                align-items: stretch;
                border-radius: 24px;
            }
            .search-box {
                width: 100%;
            }
            .search-box input {
                flex: 1;
            }
            .main-content {
                padding: 1rem;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .filter-group {
                justify-content: center;
            }
        }

        @media (min-width: 769px) {
            .review-cards {
                display: none;
            }
            .review-table {
                display: table;
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
            <div class="logo-icon"><i class="fas fa-star-of-life"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="admin_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="manage_students.html" class="nav-link"><i class="fas fa-users"></i> Students</a></li>
            <li class="nav-item"><a href="manage_lecturers.html" class="nav-link"><i class="fas fa-chalkboard-teacher"></i> Lecturers</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-comment-dots"></i> Project Reviews</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

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