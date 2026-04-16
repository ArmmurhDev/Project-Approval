<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Edit Project</title>
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

        .student-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .student-name {
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

        /* Warning Banner */
        .warning-banner {
            background: #fef3c7;
            border-left: 6px solid var(--kaduna-gold);
            padding: 1rem 1.5rem;
            border-radius: var(--radius-sm);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .card-header {
            background: var(--kaduna-cream);
            padding: 1.2rem 2rem;
            border-bottom: 3px solid var(--kaduna-gold);
        }

        .card-header h2 {
            color: var(--kaduna-charcoal);
            font-size: 1.4rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--kaduna-charcoal);
        }

        .form-group label .required {
            color: var(--kaduna-red);
        }

        .form-group input, 
        .form-group textarea, 
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 30px;
            border: 1px solid #ddd;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .form-group input:focus, 
        .form-group textarea:focus, 
        .form-group select:focus {
            outline: none;
            border-color: var(--kaduna-gold);
            box-shadow: 0 0 0 3px rgba(230,160,23,0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-update {
            background: var(--kaduna-green);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
        }

        .btn-update:hover {
            background: #064d2a;
            transform: scale(0.98);
        }

        .btn-cancel {
            background: #eef2ee;
            color: var(--kaduna-charcoal);
            border: none;
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--kaduna-charcoal);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            display: none;
            align-items: center;
            gap: 10px;
            z-index: 1000;
        }
        .toast.success { background: var(--kaduna-green); }
        .toast.error { background: var(--kaduna-red); }

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

        @media (max-width: 640px) {
            .main-content {
                padding: 1rem;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .card-body {
                padding: 1.2rem;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .btn-update, .btn-cancel {
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }
        }

        .footer-note {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
            color: #6f7e6f;
        }
    </style>
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo-icon"><i class="fas fa-edit"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="student_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="submit_project.html" class="nav-link"><i class="fas fa-upload"></i> Submit</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-edit"></i> Edit Project</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-edit"></i> Edit Project Proposal</h1>
                <p>Modify your project details before final submission</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello (KP/CS/2022/001)</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="warning-banner">
            <i class="fas fa-info-circle" style="font-size: 1.2rem; color: #b45309;"></i>
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
                            <input type="text" id="fullName" value="Amina Bello" readonly style="background:#f5f5f5;">
                        </div>
                        <div class="form-group">
                            <label>Registration Number <span class="required">*</span></label>
                            <input type="text" id="regNo" value="KP/CS/2022/001" readonly style="background:#f5f5f5;">
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
                        <small style="color:#6f7e6f;">Separate keywords with commas</small>
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

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem;">
                        <button type="button" class="btn-update" id="updateBtn"><i class="fas fa-save"></i> Update Project</button>
                        <a href="student_dashboard.html" class="btn-cancel"><i class="fas fa-arrow-left"></i> Cancel & Go Back</a>
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