<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Manage Students</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'students'; include '../include/admin_sidebar.php'; ?>

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