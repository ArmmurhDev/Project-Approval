<aside class="sidebar" id="sidebar">
    <div class="logo-area">
        <div class="logo-icon"><i class="fas fa-chalkboard-teacher"></i></div>
        <div class="logo-text">
            <h2>Topic Verifier</h2>
            <p>Kaduna Polytechnic</p>
        </div>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="lecturer_dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="assigned_projects.php" class="nav-link <?php echo ($currentPage == 'assigned_projects') ? 'active' : ''; ?>">
                <i class="fas fa-tasks"></i> Assigned Projects
            </a>
        </li>
        <li class="nav-item">
            <a href="assigned_students.php" class="nav-link <?php echo ($currentPage == 'my_students') ? 'active' : ''; ?>">
                <i class="fas fa-user-graduate"></i> My Students
            </a>
        </li>
        <li class="nav-item">
            <a href="#" id="logoutLink" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</aside>
