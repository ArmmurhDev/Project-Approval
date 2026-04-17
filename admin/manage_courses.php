<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Manage Courses</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'courses'; include '../include/admin_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-book"></i> Course Management</h1>
                <p>Add, edit, or remove academic courses</p>
            </div>
            <div class="admin-profile">
                <span class="admin-name"><i class="fas fa-user-shield"></i> Dr. A. Hassan</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="action-bar">
            <button class="add-course-btn" id="addCourseBtn"><i class="fas fa-plus-circle"></i> Add New Course</button>
            <div class="search-box">
                <input type="text" id="searchCourseInput" placeholder="Search by code, title, or department...">
                <button id="searchCourseBtn"><i class="fas fa-search"></i> Search</button>
            </div>
        </div>

        <!-- Table view for desktop -->
        <div class="courses-container">
            <table class="course-table" id="courseTable">
                <thead>
                    <tr><th>Course Code</th><th>Course Title</th><th>Department</th><th>Level</th><th>Credits</th><th style="width:100px">Actions</th></tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
            <!-- Card view for mobile -->
            <div id="cardsContainer" class="course-cards"></div>
            <div id="emptyMessage" class="empty-state" style="display: none;">📚 No courses found. Click "Add New Course" to create one.</div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Course Catalogue | Kaduna Polytechnic
        </div>
    </main>
</div>

<!-- Add/Edit Modal -->
<div id="courseModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Add New Course</h3>
        <input type="hidden" id="courseId">
        <div class="form-row">
            <div class="field-group">
                <label>Course Code *</label>
                <input type="text" id="courseCode" placeholder="e.g., CSC 401">
            </div>
            <div class="field-group">
                <label>Credits *</label>
                <input type="number" id="credits" placeholder="e.g., 3" min="1" max="6">
            </div>
        </div>
        <label>Course Title *</label>
        <input type="text" id="courseTitle" placeholder="e.g., Advanced Database Systems">
        <label>Department *</label>
        <select id="deptSelect">
            <option value="Computer Science">Computer Science</option>
            <option value="Computer Engineering">Computer Engineering</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Cyber Security">Cyber Security</option>
        </select>
        <label>Level</label>
        <select id="levelSelect">
            <option>ND1</option><option>ND2</option><option>HND1</option><option>HND2</option>
        </select>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-save" id="saveCourseBtn">Save Course</button>
        </div>
    </div>
</div>

<script>
    // ---------- Mock Data ----------
    let courses = [
        { id: "1", code: "CSC 401", title: "Advanced Database Systems", department: "Computer Science", level: "HND2", credits: 3 },
        { id: "2", code: "CSC 302", title: "Object Oriented Programming", department: "Computer Science", level: "HND1", credits: 3 },
        { id: "3", code: "CE 411", title: "Embedded Systems", department: "Computer Engineering", level: "HND2", credits: 4 },
        { id: "4", code: "IT 202", title: "Network Administration", department: "Information Technology", level: "ND2", credits: 3 },
        { id: "5", code: "CY 305", title: "Ethical Hacking", department: "Cyber Security", level: "HND1", credits: 3 }
    ];
    let nextId = 6;

    // Helper: render both table and cards
    function renderCourses() {
        const searchTerm = document.getElementById("searchCourseInput").value.toLowerCase();
        let filtered = courses.filter(c => 
            c.code.toLowerCase().includes(searchTerm) || 
            c.title.toLowerCase().includes(searchTerm) ||
            c.department.toLowerCase().includes(searchTerm)
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
        tbody.innerHTML = filtered.map(c => `
            <tr>
                <td>${escapeHtml(c.code)}</td>
                <td>${escapeHtml(c.title)}</td>
                <td>${escapeHtml(c.department)}</td>
                <td>${escapeHtml(c.level)}</td>
                <td>${c.credits}</td>
                <td class="action-icons">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${c.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteCourse('${c.id}')"></i>
                </td>
            </tr>
        `).join("");
        
        // Mobile cards
        cardsDiv.innerHTML = filtered.map(c => `
            <div class="course-card">
                <h4>${escapeHtml(c.code)} - ${escapeHtml(c.title)}</h4>
                <p><i class="fas fa-building"></i> ${escapeHtml(c.department)}</p>
                <p><i class="fas fa-level-up-alt"></i> ${escapeHtml(c.level)} • <i class="fas fa-star"></i> ${c.credits} Credits</p>
                <div class="card-actions">
                    <i class="fas fa-edit edit-icon" onclick="openEditModal('${c.id}')"></i>
                    <i class="fas fa-trash-alt delete-icon" onclick="deleteCourse('${c.id}')"></i>
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
    const modal = document.getElementById("courseModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; resetForm(); }
    
    function resetForm() {
        document.getElementById("courseId").value = "";
        document.getElementById("courseCode").value = "";
        document.getElementById("courseTitle").value = "";
        document.getElementById("credits").value = "3";
        document.getElementById("deptSelect").value = "Computer Science";
        document.getElementById("levelSelect").value = "ND1";
        document.getElementById("modalTitle").innerText = "Add New Course";
    }
    
    function openEditModal(id) {
        const course = courses.find(c => c.id === id);
        if(course) {
            document.getElementById("courseId").value = course.id;
            document.getElementById("courseCode").value = course.code;
            document.getElementById("courseTitle").value = course.title;
            document.getElementById("credits").value = course.credits;
            document.getElementById("deptSelect").value = course.department;
            document.getElementById("levelSelect").value = course.level;
            document.getElementById("modalTitle").innerText = "Edit Course";
            openModal();
        }
    }
    
    function saveCourse() {
        const id = document.getElementById("courseId").value;
        const code = document.getElementById("courseCode").value.trim().toUpperCase();
        const title = document.getElementById("courseTitle").value.trim();
        const credits = parseInt(document.getElementById("credits").value);
        const department = document.getElementById("deptSelect").value;
        const level = document.getElementById("levelSelect").value;
        
        if(!code || !title || isNaN(credits)) {
            alert("Course Code, Title, and Credits are required.");
            return;
        }
        // Check duplicate code (excluding current)
        const exists = courses.some(c => c.code === code && c.id !== id);
        if(exists) {
            alert("A course with this code already exists.");
            return;
        }
        
        if(id) { // edit
            const index = courses.findIndex(c => c.id === id);
            if(index !== -1) {
                courses[index] = { ...courses[index], code, title, credits, department, level };
            }
        } else { // add
            const newId = String(nextId++);
            courses.push({ id: newId, code, title, department, level, credits });
        }
        renderCourses();
        closeModal();
    }
    
    window.deleteCourse = function(id) {
        if(confirm("Are you sure you want to delete this course? It may affect project associations.")) {
            courses = courses.filter(c => c.id !== id);
            renderCourses();
        }
    };
    
    window.openEditModal = openEditModal;
    
    // Event listeners
    document.getElementById("addCourseBtn").addEventListener("click", () => { resetForm(); openModal(); });
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("saveCourseBtn").addEventListener("click", saveCourse);
    document.getElementById("searchCourseBtn").addEventListener("click", renderCourses);
    document.getElementById("searchCourseInput").addEventListener("keyup", (e) => { if(e.key === "Enter") renderCourses(); });
    
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
    renderCourses();
</script>
</body>
</html>