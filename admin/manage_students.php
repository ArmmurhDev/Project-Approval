<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Manage Students</title>
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

        .add-student-btn {
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

        .add-student-btn:hover {
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

        /* Students Table / Card Grid */
        .students-container {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .students-table {
            width: 100%;
            border-collapse: collapse;
        }

        .students-table th {
            text-align: left;
            padding: 1rem 1.2rem;
            background: var(--kaduna-cream);
            color: var(--kaduna-charcoal);
            font-weight: 600;
            border-bottom: 2px solid var(--kaduna-gold);
        }

        .students-table td {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid #e2e8e0;
            vertical-align: middle;
        }

        .students-table tr:hover {
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
        .students-cards {
            display: none;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .student-card {
            background: white;
            border-radius: var(--radius-sm);
            padding: 1rem;
            border: 1px solid #e2e8e0;
            box-shadow: var(--shadow-sm);
        }

        .student-card h4 {
            color: var(--kaduna-green);
            margin-bottom: 0.5rem;
        }

        .student-card p {
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
            max-width: 500px;
            width: 90%;
            border-radius: 28px;
            padding: 1.8rem;
            position: relative;
        }

        .modal-content h3 {
            margin-bottom: 1rem;
            color: var(--kaduna-charcoal);
        }

        .modal-content input, .modal-content select {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-family: 'Inter', sans-serif;
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
            .students-table {
                display: none;
            }
            .students-cards {
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
        }

        @media (min-width: 769px) {
            .students-cards {
                display: none;
            }
            .students-table {
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
            <div class="logo-icon"><i class="fas fa-user-graduate"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="admin_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-users"></i> Manage Students</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chalkboard-teacher"></i> Supervisors</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-users"></i> Student Management</h1>
                <p>Add, edit, or remove student accounts</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="action-bar">
            <button class="add-student-btn" id="addStudentBtn"><i class="fas fa-plus-circle"></i> Register New Student</button>
            <div class="search-box">
                <input type="text" id="searchStudentInput" placeholder="Search by name, reg no, or email...">
                <button id="searchStudentBtn"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>

        <!-- Table view for desktop -->
        <div class="students-container">
            <table class="students-table" id="studentsTable">
                <thead>
                    <tr><th>Reg. No.</th><th>Full Name</th><th>Email</th><th>Department</th><th>Level</th><th style="width:100px">Actions</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
            <!-- Card view for mobile -->
            <div id="cardsContainer" class="students-cards"></div>
            <div id="emptyMessage" class="empty-state" style="display: none;">📌 No students found. Click "Register New Student" to add.</div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Student Records | Kaduna Polytechnic
        </div>
    </main>
</div>

<!-- Add/Edit Modal -->
<div id="studentModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Add New Student</h3>
        <input type="hidden" id="studentId">
        <label>Registration Number *</label>
        <input type="text" id="regNo" placeholder="e.g., KP/CS/2022/001">
        <label>Full Name *</label>
        <input type="text" id="fullName" placeholder="Full name">
        <label>Email Address *</label>
        <input type="email" id="email" placeholder="student@kadpoly.edu.ng">
        <label>Department *</label>
        <select id="department">
            <option value="Computer Science">Computer Science</option>
            <option value="Computer Engineering">Computer Engineering</option>
            <option value="Cyber Security">Cyber Security</option>
            <option value="Information Technology">Information Technology</option>
        </select>
        <label>Level</label>
        <select id="level">
            <option>ND1</option><option>ND2</option><option>HND1</option><option>HND2</option>
        </select>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-save" id="saveStudentBtn">Save Student</button>
        </div>
    </div>
</div>

<script>
    // ---------- Mock Data ----------
    let students = [
        { id: "1", regNo: "KP/CS/2022/001", fullName: "Amina Bello", email: "amina.bello@kadpoly.edu.ng", department: "Computer Science", level: "HND2" },
        { id: "2", regNo: "KP/CS/2022/045", fullName: "Ibrahim Musa", email: "ibrahim.musa@kadpoly.edu.ng", department: "Computer Science", level: "HND1" },
        { id: "3", regNo: "KP/CE/2023/012", fullName: "Fatima Sani", email: "fatima.sani@kadpoly.edu.ng", department: "Computer Engineering", level: "ND2" },
        { id: "4", regNo: "KP/CS/2023/088", fullName: "Samuel John", email: "samuel.john@kadpoly.edu.ng", department: "Cyber Security", level: "ND1" },
        { id: "5", regNo: "KP/IT/2022/033", fullName: "Zainab Idris", email: "zainab.idris@kadpoly.edu.ng", department: "Information Technology", level: "HND2" }
    ];
    let nextId = 6;

    // Helper: render both table and cards
    function renderStudents() {
        const searchTerm = document.getElementById("searchStudentInput").value.toLowerCase();
        let filtered = students.filter(s => 
            s.fullName.toLowerCase().includes(searchTerm) || 
            s.regNo.toLowerCase().includes(searchTerm) || 
            s.email.toLowerCase().includes(searchTerm)
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
        tbody.innerHTML = filtered.map(s => `
            <tr>
                <td>${escapeHtml(s.regNo)}</td>
                <td>${escapeHtml(s.fullName)}</td>
                <td>${escapeHtml(s.email)}</td>
                <td>${escapeHtml(s.department)}</td>
                <td>${escapeHtml(s.level)}</td>
                <td class="action-icons">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${s.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteStudent('${s.id}')"></i>
                </td>
            </tr>
        `).join("");
        
        // Mobile cards
        cardsDiv.innerHTML = filtered.map(s => `
            <div class="student-card">
                <h4>${escapeHtml(s.fullName)}</h4>
                <p><i class="fas fa-id-card"></i> ${escapeHtml(s.regNo)}</p>
                <p><i class="fas fa-envelope"></i> ${escapeHtml(s.email)}</p>
                <p><i class="fas fa-laptop-code"></i> ${escapeHtml(s.department)} • ${escapeHtml(s.level)}</p>
                <div class="card-actions">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${s.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteStudent('${s.id}')"></i>
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
    const modal = document.getElementById("studentModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; resetForm(); }
    
    function resetForm() {
        document.getElementById("studentId").value = "";
        document.getElementById("regNo").value = "";
        document.getElementById("fullName").value = "";
        document.getElementById("email").value = "";
        document.getElementById("department").value = "Computer Science";
        document.getElementById("level").value = "ND1";
        document.getElementById("modalTitle").innerText = "Add New Student";
    }
    
    function openEditModal(id) {
        const student = students.find(s => s.id === id);
        if(student) {
            document.getElementById("studentId").value = student.id;
            document.getElementById("regNo").value = student.regNo;
            document.getElementById("fullName").value = student.fullName;
            document.getElementById("email").value = student.email;
            document.getElementById("department").value = student.department;
            document.getElementById("level").value = student.level;
            document.getElementById("modalTitle").innerText = "Edit Student";
            openModal();
        }
    }
    
    function saveStudent() {
        const id = document.getElementById("studentId").value;
        const regNo = document.getElementById("regNo").value.trim();
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const department = document.getElementById("department").value;
        const level = document.getElementById("level").value;
        
        if(!regNo || !fullName || !email) {
            alert("Please fill all required fields (Reg No, Name, Email)");
            return;
        }
        if(id) { // edit
            const index = students.findIndex(s => s.id === id);
            if(index !== -1) {
                students[index] = { ...students[index], regNo, fullName, email, department, level };
            }
        } else { // add
            const newId = String(nextId++);
            students.push({ id: newId, regNo, fullName, email, department, level });
        }
        renderStudents();
        closeModal();
    }
    
    window.deleteStudent = function(id) {
        if(confirm("Are you sure you want to delete this student? This will also remove all project records associated.")) {
            students = students.filter(s => s.id !== id);
            renderStudents();
        }
    };
    
    window.openEditModal = openEditModal;
    
    // Event listeners
    document.getElementById("addStudentBtn").addEventListener("click", () => { resetForm(); openModal(); });
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("saveStudentBtn").addEventListener("click", saveStudent);
    document.getElementById("searchStudentBtn").addEventListener("click", renderStudents);
    document.getElementById("searchStudentInput").addEventListener("keyup", (e) => { if(e.key === "Enter") renderStudents(); });
    
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
    renderStudents();
</script>
</body>
</html>