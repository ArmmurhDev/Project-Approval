<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Manage Lecturers</title>
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

        .add-lecturer-btn {
            background: var(--kaduna-green);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .add-lecturer-btn:hover {
            background: #064d2a;
            transform: scale(0.97);
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

        /* Lecturers Table / Card Grid */
        .lecturers-container {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .lecturer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .lecturer-table th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: var(--kaduna-cream);
            color: var(--kaduna-charcoal);
            font-weight: 600;
            border-bottom: 2px solid var(--kaduna-gold);
        }

        .lecturer-table td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #e2e8e0;
            vertical-align: middle;
        }

        .lecturer-table tr:hover {
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

        /* Mobile card view */
        .lecturer-cards {
            display: none;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .lecturer-card {
            background: white;
            border-radius: var(--radius-sm);
            padding: 1rem;
            border: 1px solid #e2e8e0;
            box-shadow: var(--shadow-sm);
        }

        .lecturer-card h4 {
            color: var(--kaduna-green);
            margin-bottom: 0.5rem;
        }

        .lecturer-card p {
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
            .lecturer-table {
                display: none;
            }
            .lecturer-cards {
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
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (min-width: 769px) {
            .lecturer-cards {
                display: none;
            }
            .lecturer-table {
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
            <div class="logo-icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="admin_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="manage_students.html" class="nav-link"><i class="fas fa-users"></i> Students</a></li>
            <li class="nav-item"><a href="manage_departments.html" class="nav-link"><i class="fas fa-building"></i> Departments</a></li>
            <li class="nav-item"><a href="manage_courses.html" class="nav-link"><i class="fas fa-book"></i> Courses</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-chalkboard-teacher"></i> Lecturers</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-chalkboard-teacher"></i> Lecturer Management</h1>
                <p>Add, edit, or remove lecturer/faculty accounts</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="action-bar">
            <button class="add-lecturer-btn" id="addLecturerBtn"><i class="fas fa-plus-circle"></i> Add New Lecturer</button>
            <div class="search-box">
                <input type="text" id="searchLecturerInput" placeholder="Search by name, staff ID, or department...">
                <button id="searchLecturerBtn"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>

        <!-- Table view for desktop -->
        <div class="lecturers-container">
            <table class="lecturer-table" id="lecturerTable">
                <thead>
                    <tr><th>Staff ID</th><th>Full Name</th><th>Email</th><th>Department</th><th>Title</th><th style="width:100px">Actions</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
            <!-- Card view for mobile -->
            <div id="cardsContainer" class="lecturer-cards"></div>
            <div id="emptyMessage" class="empty-state" style="display: none;">👩‍🏫 No lecturers found. Click "Add New Lecturer" to create one.</div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Faculty Records | Kaduna Polytechnic
        </div>
    </main>
</div>

<!-- Add/Edit Modal -->
<div id="lecturerModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Add New Lecturer</h3>
        <input type="hidden" id="lecturerId">
        <div class="form-row">
            <div class="field-group">
                <label>Staff ID *</label>
                <input type="text" id="staffId" placeholder="e.g., KP/CS/001">
            </div>
            <div class="field-group">
                <label>Title</label>
                <select id="title">
                    <option>Dr.</option><option>Prof.</option><option>Mr.</option><option>Mrs.</option><option>Ms.</option>
                </select>
            </div>
        </div>
        <label>Full Name *</label>
        <input type="text" id="fullName" placeholder="e.g., Adekunle Oluwole">
        <label>Email Address *</label>
        <input type="email" id="email" placeholder="lecturer@kadpoly.edu.ng">
        <label>Department *</label>
        <select id="deptSelect">
            <option value="Computer Science">Computer Science</option>
            <option value="Computer Engineering">Computer Engineering</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Cyber Security">Cyber Security</option>
        </select>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-save" id="saveLecturerBtn">Save Lecturer</button>
        </div>
    </div>
</div>

<script>
    // ---------- Mock Data ----------
    let lecturers = [
        { id: "1", staffId: "KP/CS/001", title: "Prof.", fullName: "Adekunle Oluwole", email: "adekunle.oluwole@kadpoly.edu.ng", department: "Computer Science" },
        { id: "2", staffId: "KP/CS/002", title: "Dr.", fullName: "Fatima Bello", email: "fatima.bello@kadpoly.edu.ng", department: "Computer Science" },
        { id: "3", staffId: "KP/CE/005", title: "Dr.", fullName: "Samuel Okonkwo", email: "samuel.okonkwo@kadpoly.edu.ng", department: "Computer Engineering" },
        { id: "4", staffId: "KP/IT/003", title: "Mr.", fullName: "John Okafor", email: "john.okafor@kadpoly.edu.ng", department: "Information Technology" },
        { id: "5", staffId: "KP/CY/007", title: "Dr.", fullName: "Amina Yusuf", email: "amina.yusuf@kadpoly.edu.ng", department: "Cyber Security" }
    ];
    let nextId = 6;

    // Helper: render both table and cards
    function renderLecturers() {
        const searchTerm = document.getElementById("searchLecturerInput").value.toLowerCase();
        let filtered = lecturers.filter(l => 
            l.fullName.toLowerCase().includes(searchTerm) || 
            l.staffId.toLowerCase().includes(searchTerm) ||
            l.email.toLowerCase().includes(searchTerm) ||
            l.department.toLowerCase().includes(searchTerm)
        );
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
        tbody.innerHTML = filtered.map(l => `
            <tr>
                <td>${escapeHtml(l.staffId)}</td>
                <td>${escapeHtml(l.title)} ${escapeHtml(l.fullName)}</td>
                <td>${escapeHtml(l.email)}</td>
                <td>${escapeHtml(l.department)}</td>
                <td>${escapeHtml(l.title)}</td>
                <td class="action-icons">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${l.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteLecturer('${l.id}')"></i>
                 </td>
            </tr>
        `).join("");
        
        // Mobile cards
        cardsDiv.innerHTML = filtered.map(l => `
            <div class="lecturer-card">
                <h4>${escapeHtml(l.title)} ${escapeHtml(l.fullName)}</h4>
                <p><i class="fas fa-id-badge"></i> ${escapeHtml(l.staffId)}</p>
                <p><i class="fas fa-envelope"></i> ${escapeHtml(l.email)}</p>
                <p><i class="fas fa-building"></i> ${escapeHtml(l.department)}</p>
                <div class="card-actions">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${l.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteLecturer('${l.id}')"></i>
                </div>
            </div>
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
    
    // Modal handling
    const modal = document.getElementById("lecturerModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; resetForm(); }
    
    function resetForm() {
        document.getElementById("lecturerId").value = "";
        document.getElementById("staffId").value = "";
        document.getElementById("fullName").value = "";
        document.getElementById("email").value = "";
        document.getElementById("deptSelect").value = "Computer Science";
        document.getElementById("title").value = "Dr.";
        document.getElementById("modalTitle").innerText = "Add New Lecturer";
    }
    
    function openEditModal(id) {
        const lecturer = lecturers.find(l => l.id === id);
        if(lecturer) {
            document.getElementById("lecturerId").value = lecturer.id;
            document.getElementById("staffId").value = lecturer.staffId;
            document.getElementById("fullName").value = lecturer.fullName;
            document.getElementById("email").value = lecturer.email;
            document.getElementById("deptSelect").value = lecturer.department;
            document.getElementById("title").value = lecturer.title;
            document.getElementById("modalTitle").innerText = "Edit Lecturer";
            openModal();
        }
    }
    
    function saveLecturer() {
        const id = document.getElementById("lecturerId").value;
        const staffId = document.getElementById("staffId").value.trim().toUpperCase();
        const title = document.getElementById("title").value;
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const department = document.getElementById("deptSelect").value;
        
        if(!staffId || !fullName || !email) {
            alert("Staff ID, Full Name, and Email are required.");
            return;
        }
        // Check duplicate staff ID (excluding current)
        const exists = lecturers.some(l => l.staffId === staffId && l.id !== id);
        if(exists) {
            alert("A lecturer with this Staff ID already exists.");
            return;
        }
        
        if(id) { // edit
            const index = lecturers.findIndex(l => l.id === id);
            if(index !== -1) {
                lecturers[index] = { ...lecturers[index], staffId, title, fullName, email, department };
            }
        } else { // add
            const newId = String(nextId++);
            lecturers.push({ id: newId, staffId, title, fullName, email, department });
        }
        renderLecturers();
        closeModal();
    }
    
    window.deleteLecturer = function(id) {
        if(confirm("Are you sure you want to delete this lecturer? All associated supervision and approvals may be affected.")) {
            lecturers = lecturers.filter(l => l.id !== id);
            renderLecturers();
        }
    };
    
    window.openEditModal = openEditModal;
    
    // Event listeners
    document.getElementById("addLecturerBtn").addEventListener("click", () => { resetForm(); openModal(); });
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("saveLecturerBtn").addEventListener("click", saveLecturer);
    document.getElementById("searchLecturerBtn").addEventListener("click", renderLecturers);
    document.getElementById("searchLecturerInput").addEventListener("keyup", (e) => { if(e.key === "Enter") renderLecturers(); });
    
    // Close modal if click outside
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
    renderLecturers();
</script>
</body>
</html>