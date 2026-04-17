<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Manage Lecturers</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'lecturers'; include '../include/admin_sidebar.php'; ?>

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