<aside class="sidebar" id="sidebar">
    <div class="logo-area">
        <div class="logo-icon"><i class="fas fa-check-double"></i></div>
        <div class="logo-text">
            <h2>Topic Verifier</h2>
            <p>Kaduna Polytechnic</p>
        </div>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="admin_dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_students.php" class="nav-link <?php echo ($currentPage == 'students') ? 'active' : ''; ?>">
                <i class="fas fa-users"></i> Students
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_departments.php" class="nav-link <?php echo ($currentPage == 'departments') ? 'active' : ''; ?>">
                <i class="fas fa-building"></i> Departments
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_courses.php" class="nav-link <?php echo ($currentPage == 'courses') ? 'active' : ''; ?>">
                <i class="fas fa-book"></i> Courses
            </a>
        </li>
        <li class="nav-item">
            <a href="manage_lecturers.php" class="nav-link <?php echo ($currentPage == 'lecturers') ? 'active' : ''; ?>">
                <i class="fas fa-chalkboard-teacher"></i> Lecturers
            </a>
        </li>
        <li class="nav-item">
            <a href="project_reviews.php" class="nav-link <?php echo ($currentPage == 'reviews') ? 'active' : ''; ?>">
                <i class="fas fa-comment-dots"></i> Reviews
            </a>
        </li>
        <li class="nav-item">
            <a href="reports.php" class="nav-link <?php echo ($currentPage == 'reports') ? 'active' : ''; ?>">
                <i class="fas fa-chart-bar"></i> Reports
            </a>
        </li>
        <li class="nav-item">
            <a href="#" id="logoutLink" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</aside>
