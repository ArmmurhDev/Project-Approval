<aside class="sidebar" id="sidebar">
    <div class="logo-area">
        <div class="logo-icon"><i class="fas fa-user-graduate"></i></div>
        <div class="logo-text">
            <h2>Topic Verifier</h2>
            <p>Kaduna Polytechnic</p>
        </div>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="student_dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="view_projects.php" class="nav-link <?php echo ($currentPage == 'my_projects') ? 'active' : ''; ?>">
                <i class="fas fa-project-diagram"></i> My Projects
            </a>
        </li>
        <li class="nav-item">
            <a href="project_status.php" class="nav-link <?php echo ($currentPage == 'feedback') ? 'active' : ''; ?>">
                <i class="fas fa-comment-dots"></i> Feedback
            </a>
        </li>
        <li class="nav-item">
            <a href="messages.php" class="nav-link <?php echo ($currentPage == 'messages') ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i> Messages
            </a>
        </li>
        <li class="nav-item">
            <a href="#" id="logoutLink" class="nav-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</aside>
