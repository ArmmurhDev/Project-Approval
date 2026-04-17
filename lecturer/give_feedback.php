<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Give Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/lecturer.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'give_feedback'; include '../include/lecturer_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-comment-dots"></i> Give Feedback</h1>
                <p>Provide constructive feedback on student projects</p>
            </div>
            <div class="user-profile">
                <span class="user-name"><i class="fas fa-user"></i> Dr. Fatima Bello</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="feedback-card">
            <div class="card-header">
                <h2><i class="fas fa-pen-fancy"></i> Student Project Feedback</h2>
            </div>
            <div class="card-body">
                <!-- Project Selection -->
                <div class="project-selector">
                    <div class="form-group" style="margin-bottom:0;">
                        <label>Select Project <span class="required">*</span></label>
                        <select id="projectSelect">
                            <option value="">-- Choose a project --</option>
                            <option value="P001">AI-Powered Crop Disease Detection - Amina Bello (KP/CS/2022/001)</option>
                            <option value="P002">Blockchain for Student Records - Ibrahim Musa (KP/CS/2022/045)</option>
                            <option value="P003">IoT Water Quality Monitor - Fatima Sani (KP/CE/2023/012)</option>
                        </select>
                    </div>
                </div>

                <form id="feedbackForm">
                    <div class="form-group">
                        <label>Feedback Title <span class="required">*</span></label>
                        <input type="text" id="feedbackTitle" placeholder="e.g., Methodology Review, Literature Feedback, etc.">
                    </div>

                    <div class="form-group">
                        <label>Rating (Overall Quality) <span class="required">*</span></label>
                        <div class="rating-container">
                            <div class="stars">
                                <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="fas fa-star"></label>
                                <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="fas fa-star"></label>
                            </div>
                            <span class="rating-value" id="ratingValue">Not rated</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Detailed Feedback <span class="required">*</span></label>
                        <textarea id="feedbackText" rows="5" placeholder="Provide specific, actionable feedback for the student..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Suggestions for Improvement</label>
                        <textarea id="suggestions" rows="3" placeholder="Optional: Suggest resources, references, or next steps..."></textarea>
                    </div>

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button type="button" class="btn-submit" id="submitFeedbackBtn"><i class="fas fa-paper-plane"></i> Submit Feedback</button>
                        <button type="reset" class="btn-back" id="resetBtn"><i class="fas fa-undo-alt"></i> Clear Form</button>
                        <a href="assigned_projects.html" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Constructive Feedback Portal
        </div>
    </main>
</div>

<div id="toast" class="toast"><i class="fas fa-info-circle"></i> <span id="toastMsg"></span></div>

<script>
    // Star rating display
    const stars = document.querySelectorAll('.stars input');
    const ratingSpan = document.getElementById('ratingValue');
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const val = this.value;
            ratingSpan.innerText = val + ' / 5';
        });
    });

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
        const project = document.getElementById("projectSelect").value;
        const title = document.getElementById("feedbackTitle").value.trim();
        const rating = document.querySelector('input[name="rating"]:checked');
        const feedback = document.getElementById("feedbackText").value.trim();
        if (!project) {
            alert("Please select a project.");
            return false;
        }
        if (!title) {
            alert("Please enter a feedback title.");
            return false;
        }
        if (!rating) {
            alert("Please provide a rating.");
            return false;
        }
        if (!feedback) {
            alert("Please enter detailed feedback.");
            return false;
        }
        return true;
    }

    function submitFeedback() {
        if (!validateForm()) return;
        
        const projectSelect = document.getElementById("projectSelect");
        const projectText = projectSelect.options[projectSelect.selectedIndex]?.text || "";
        const title = document.getElementById("feedbackTitle").value;
        const rating = document.querySelector('input[name="rating"]:checked').value;
        const feedback = document.getElementById("feedbackText").value;
        const suggestions = document.getElementById("suggestions").value;
        
        // Simulate API call
        console.log({ project: projectText, title, rating, feedback, suggestions });
        showToast(`Feedback submitted for "${projectText.substring(0, 40)}..."`, "success");
        
        // Optionally reset form after submission
        document.getElementById("feedbackForm").reset();
        ratingSpan.innerText = "Not rated";
        // Clear rating stars visually
        document.querySelectorAll('.stars input').forEach(inp => inp.checked = false);
    }

    document.getElementById("submitFeedbackBtn").addEventListener("click", submitFeedback);
    document.getElementById("resetBtn").addEventListener("click", () => {
        document.getElementById("feedbackForm").reset();
        ratingSpan.innerText = "Not rated";
        document.querySelectorAll('.stars input').forEach(inp => inp.checked = false);
    });

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