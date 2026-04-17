<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Manage Departments</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'departments'; include '../include/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-building"></i> Department Management</h1>
                <p>Manage academic departments and their details</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="action-bar">
            <button class="add-dept-btn" id="addDeptBtn"><i class="fas fa-plus-circle"></i> Add New Department</button>
            <div class="search-box">
                <input type="text" id="searchDeptInput" placeholder="Search by name or code...">
                <button id="searchDeptBtn"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>

        <!-- Table view for desktop -->
        <div class="departments-container">
            <table class="dept-table" id="deptTable">
                <thead>
                    <tr><th>Department Code</th><th>Department Name</th><th>Head of Department</th><th>Description</th><th style="width:100px">Actions</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
             </table>
            <!-- Card view for mobile -->
            <div id="cardsContainer" class="dept-cards"></div>
            <div id="emptyMessage" class="empty-state" style="display: none;">📂 No departments found. Click "Add New Department" to create one.</div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Department Records | Kaduna Polytechnic
        </div>
    </main>
</div>

<!-- Add/Edit Modal -->
<div id="deptModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Add New Department</h3>
        <input type="hidden" id="deptId">
        <label>Department Code *</label>
        <input type="text" id="deptCode" placeholder="e.g., CS, CE, IT">
        <label>Department Name *</label>
        <input type="text" id="deptName" placeholder="e.g., Computer Science">
        <label>Head of Department</label>
        <input type="text" id="hodName" placeholder="Prof./Dr. Name">
        <label>Description</label>
        <textarea id="deptDesc" rows="2" placeholder="Brief description of the department"></textarea>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-save" id="saveDeptBtn">Save Department</button>
        </div>
    </div>
</div>

<script>
    // ---------- Mock Data ----------
    let departments = [
        { id: "1", code: "CS", name: "Computer Science", hod: "Prof. Adeyemi Ogunleye", description: "Focus on software development, AI, and data science." },
        { id: "2", code: "CE", name: "Computer Engineering", hod: "Dr. Fatima Bello", description: "Hardware, embedded systems, and robotics." },
        { id: "3", code: "IT", name: "Information Technology", hod: "Mr. Samuel Okonkwo", description: "Network administration, database management, and IT support." },
        { id: "4", code: "CY", name: "Cyber Security", hod: "Dr. Amina Yusuf", description: "Digital forensics, ethical hacking, and security policies." }
    ];
    let nextId = 5;

    // Helper: render both table and cards
    function renderDepartments() {
        const searchTerm = document.getElementById("searchDeptInput").value.toLowerCase();
        let filtered = departments.filter(d => 
            d.name.toLowerCase().includes(searchTerm) || 
            d.code.toLowerCase().includes(searchTerm)
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
        tbody.innerHTML = filtered.map(d => `
            <tr>
                <td>${escapeHtml(d.code)}</td>
                <td>${escapeHtml(d.name)}</td>
                <td>${escapeHtml(d.hod || '—')}</td>
                <td>${escapeHtml(d.description.substring(0, 60))}${d.description.length > 60 ? '…' : ''}</td>
                <td class="action-icons">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${d.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteDepartment('${d.id}')"></i>
                </td>
            </tr>
        `).join("");
        
        // Mobile cards
        cardsDiv.innerHTML = filtered.map(d => `
            <div class="dept-card">
                <h4>${escapeHtml(d.name)} (${escapeHtml(d.code)})</h4>
                <p><i class="fas fa-user-tie"></i> HOD: ${escapeHtml(d.hod || 'Not assigned')}</p>
                <p><i class="fas fa-align-left"></i> ${escapeHtml(d.description.substring(0, 80))}${d.description.length > 80 ? '…' : ''}</p>
                <div class="card-actions">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${d.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteDepartment('${d.id}')"></i>
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
    const modal = document.getElementById("deptModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; resetForm(); }
    
    function resetForm() {
        document.getElementById("deptId").value = "";
        document.getElementById("deptCode").value = "";
        document.getElementById("deptName").value = "";
        document.getElementById("hodName").value = "";
        document.getElementById("deptDesc").value = "";
        document.getElementById("modalTitle").innerText = "Add New Department";
    }
    
    function openEditModal(id) {
        const dept = departments.find(d => d.id === id);
        if(dept) {
            document.getElementById("deptId").value = dept.id;
            document.getElementById("deptCode").value = dept.code;
            document.getElementById("deptName").value = dept.name;
            document.getElementById("hodName").value = dept.hod || "";
            document.getElementById("deptDesc").value = dept.description;
            document.getElementById("modalTitle").innerText = "Edit Department";
            openModal();
        }
    }
    
    function saveDepartment() {
        const id = document.getElementById("deptId").value;
        const code = document.getElementById("deptCode").value.trim().toUpperCase();
        const name = document.getElementById("deptName").value.trim();
        const hod = document.getElementById("hodName").value.trim();
        const description = document.getElementById("deptDesc").value.trim();
        
        if(!code || !name) {
            alert("Department Code and Name are required.");
            return;
        }
        // Check duplicate code (excluding current if editing)
        const exists = departments.some(d => d.code === code && d.id !== id);
        if(exists) {
            alert("A department with this code already exists.");
            return;
        }
        
        if(id) { // edit
            const index = departments.findIndex(d => d.id === id);
            if(index !== -1) {
                departments[index] = { ...departments[index], code, name, hod, description };
            }
        } else { // add
            const newId = String(nextId++);
            departments.push({ id: newId, code, name, hod, description });
        }
        renderDepartments();
        closeModal();
    }
    
    window.deleteDepartment = function(id) {
        if(confirm("Are you sure you want to delete this department? All associated students and projects may be affected.")) {
            departments = departments.filter(d => d.id !== id);
            renderDepartments();
        }
    };
    
    window.openEditModal = openEditModal;
    
    // Event listeners
    document.getElementById("addDeptBtn").addEventListener("click", () => { resetForm(); openModal(); });
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("saveDeptBtn").addEventListener("click", saveDepartment);
    document.getElementById("searchDeptBtn").addEventListener("click", renderDepartments);
    document.getElementById("searchDeptInput").addEventListener("keyup", (e) => { if(e.key === "Enter") renderDepartments(); });
    
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
    renderDepartments();
</script>
</body>
</html>