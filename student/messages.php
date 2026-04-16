<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Messages</title>
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
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

        /* Messages Container */
        .messages-container {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            display: flex;
            flex-direction: row;
            min-height: 550px;
        }

        /* Conversations Sidebar */
        .conversations-sidebar {
            width: 320px;
            background: var(--kaduna-white);
            border-right: 1px solid #e2e8e0;
            display: flex;
            flex-direction: column;
        }

        .convo-header {
            padding: 1rem;
            border-bottom: 1px solid #e2e8e0;
            background: var(--kaduna-cream);
        }
        .new-msg-btn {
            background: var(--kaduna-gold);
            border: none;
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .convo-list {
            flex: 1;
            overflow-y: auto;
        }
        .convo-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: 0.2s;
            border-bottom: 1px solid #eef2ee;
        }
        .convo-item:hover {
            background: #fafaf5;
        }
        .convo-item.active {
            background: #fef9e6;
            border-left: 4px solid var(--kaduna-gold);
        }
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--kaduna-green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .convo-info {
            flex: 1;
        }
        .convo-name {
            font-weight: 700;
        }
        .convo-preview {
            font-size: 0.75rem;
            color: #6f7e6f;
        }
        .convo-time {
            font-size: 0.7rem;
            color: #8a9a8a;
        }
        .unread-badge {
            background: var(--kaduna-gold);
            color: #2c2c1c;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }

        /* Chat Area */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fafaf5;
        }
        .chat-header {
            padding: 1rem;
            border-bottom: 1px solid #e2e8e0;
            background: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .message {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .message.sent {
            background: var(--kaduna-green);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }
        .message.received {
            background: white;
            border: 1px solid #ddd;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }
        .message-time {
            font-size: 0.65rem;
            margin-top: 4px;
            opacity: 0.7;
        }
        .chat-input-area {
            padding: 1rem;
            background: white;
            border-top: 1px solid #e2e8e0;
            display: flex;
            gap: 12px;
        }
        .chat-input-area input {
            flex: 1;
            padding: 12px 16px;
            border-radius: 40px;
            border: 1px solid #ddd;
            font-family: 'Inter', sans-serif;
        }
        .chat-input-area button {
            background: var(--kaduna-gold);
            border: none;
            padding: 0 20px;
            border-radius: 40px;
            cursor: pointer;
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
            max-width: 450px;
            width: 90%;
            border-radius: 28px;
            padding: 1.5rem;
        }
        .modal-content select, .modal-content textarea {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 1rem;
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
            .messages-container {
                flex-direction: column;
            }
            .conversations-sidebar {
                width: 100%;
                max-height: 300px;
            }
            .main-content {
                padding: 1rem;
            }
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .message {
                max-width: 90%;
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
            <div class="logo-icon"><i class="fas fa-envelope"></i></div>
            <div class="logo-text">
                <h2>Topic Verifier</h2>
                <p>Kaduna Polytechnic</p>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="student_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-comment-dots"></i> Messages</a></li>
            <li class="nav-item"><a href="project_status.html" class="nav-link"><i class="fas fa-chart-simple"></i> Status</a></li>
            <li class="nav-item"><a href="#" id="logoutLink" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-envelope"></i> Messages</h1>
                <p>Communicate with supervisors and coordinators</p>
            </div>
            <div class="user-profile">
                <span class="user-name"><i class="fas fa-user"></i> Amina Bello</span>
                <a href="#" id="logoutTop" class="logout-btn"><i class="fas fa-power-off"></i> Exit</a>
            </div>
        </div>

        <div class="messages-container">
            <!-- Conversations List -->
            <div class="conversations-sidebar">
                <div class="convo-header">
                    <button class="new-msg-btn" id="newMessageBtn"><i class="fas fa-plus-circle"></i> New Message</button>
                </div>
                <div class="convo-list" id="convoList"></div>
            </div>

            <!-- Chat Area -->
            <div class="chat-area" id="chatArea">
                <div class="chat-header" id="chatHeader">
                    <div class="avatar" id="chatAvatar">AB</div>
                    <div><strong id="chatName">Select a conversation</strong></div>
                </div>
                <div class="chat-messages" id="chatMessages"></div>
                <div class="chat-input-area" id="chatInputArea" style="display: none;">
                    <input type="text" id="messageInput" placeholder="Type your message...">
                    <button id="sendMsgBtn"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> Topic Verifier — Secure Messaging
        </div>
    </main>
</div>

<!-- New Message Modal -->
<div id="newMsgModal" class="modal">
    <div class="modal-content">
        <h3><i class="fas fa-paper-plane"></i> New Message</h3>
        <label>Recipient</label>
        <select id="recipientSelect">
            <option value="">-- Select --</option>
            <option value="Dr. Fatima Bello">Dr. Fatima Bello (Supervisor)</option>
            <option value="Prof. Adekunle Oluwole">Prof. Adekunle Oluwole (HOD)</option>
            <option value="Admin Support">Admin Support</option>
        </select>
        <label>Subject / Project</label>
        <input type="text" id="msgSubject" placeholder="e.g., Question about my project">
        <label>Message</label>
        <textarea id="msgBody" rows="3" placeholder="Type your message..."></textarea>
        <div class="modal-buttons">
            <button class="btn-cancel" id="closeModalBtn" style="background:#eef2ee; padding:8px 20px; border-radius:40px;">Cancel</button>
            <button class="btn-send" id="sendNewMsgBtn" style="background:#0a5c36; color:white; padding:8px 20px; border-radius:40px;">Send</button>
        </div>
    </div>
</div>

<script>
    // Mock conversations and messages
    let conversations = [
        {
            id: "c1",
            withUser: "Dr. Fatima Bello",
            role: "Supervisor",
            avatar: "FB",
            lastMessage: "Your project topic looks promising. Please submit methodology.",
            lastTime: "2025-03-14 10:30",
            unread: 1,
            messages: [
                { from: "Dr. Fatima Bello", text: "Hello Amina, I've reviewed your proposal.", time: "2025-03-14 09:00", isMine: false },
                { from: "Amina Bello", text: "Thank you Dr. I will update the methodology section.", time: "2025-03-14 09:45", isMine: true },
                { from: "Dr. Fatima Bello", text: "Your project topic looks promising. Please submit methodology.", time: "2025-03-14 10:30", isMine: false }
            ]
        },
        {
            id: "c2",
            withUser: "Prof. Adekunle Oluwole",
            role: "HOD",
            avatar: "AO",
            lastMessage: "Approval pending after review.",
            lastTime: "2025-03-12 14:15",
            unread: 0,
            messages: [
                { from: "Prof. Adekunle Oluwole", text: "Your project has been forwarded for committee review.", time: "2025-03-12 14:15", isMine: false }
            ]
        }
    ];

    let currentConvoId = null;

    function formatTime(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function renderConversations() {
        const container = document.getElementById("convoList");
        container.innerHTML = conversations.map(conv => `
            <div class="convo-item ${currentConvoId === conv.id ? 'active' : ''}" data-id="${conv.id}">
                <div class="avatar" style="background:${conv.avatar === 'FB' ? '#2a7a4a' : '#c47d0c'}">${conv.avatar}</div>
                <div class="convo-info">
                    <div class="convo-name">${escapeHtml(conv.withUser)} <span style="font-size:0.7rem;">(${conv.role})</span></div>
                    <div class="convo-preview">${escapeHtml(conv.lastMessage.substring(0, 40))}</div>
                </div>
                <div style="text-align:right;">
                    <div class="convo-time">${formatTime(conv.lastTime)}</div>
                    ${conv.unread > 0 ? `<div class="unread-badge">${conv.unread}</div>` : ''}
                </div>
            </div>
        `).join("");
        // Add click listeners
        document.querySelectorAll('.convo-item').forEach(el => {
            el.addEventListener('click', () => {
                const id = el.getAttribute('data-id');
                selectConversation(id);
            });
        });
    }

    function selectConversation(convoId) {
        currentConvoId = convoId;
        const conv = conversations.find(c => c.id === convoId);
        if (conv) {
            // Mark as read
            conv.unread = 0;
            renderConversations();
            // Update chat header
            document.getElementById("chatAvatar").innerText = conv.avatar;
            document.getElementById("chatName").innerHTML = `${conv.withUser} <span style="font-size:0.8rem; font-weight:normal;">(${conv.role})</span>`;
            // Render messages
            const messagesContainer = document.getElementById("chatMessages");
            messagesContainer.innerHTML = conv.messages.map(msg => `
                <div class="message ${msg.isMine ? 'sent' : 'received'}">
                    <div>${escapeHtml(msg.text)}</div>
                    <div class="message-time">${formatTime(msg.time)}</div>
                </div>
            `).join("");
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            // Show input area
            document.getElementById("chatInputArea").style.display = "flex";
        }
    }

    function sendMessage() {
        if (!currentConvoId) return;
        const input = document.getElementById("messageInput");
        const text = input.value.trim();
        if (!text) return;
        const conv = conversations.find(c => c.id === currentConvoId);
        if (conv) {
            const newMsg = {
                from: "Amina Bello",
                text: text,
                time: new Date().toISOString().slice(0, 16).replace('T', ' '),
                isMine: true
            };
            conv.messages.push(newMsg);
            conv.lastMessage = text;
            conv.lastTime = newMsg.time;
            // Simulate auto-reply (optional)
            renderConversations();
            // Re-render chat messages
            const messagesContainer = document.getElementById("chatMessages");
            messagesContainer.innerHTML = conv.messages.map(msg => `
                <div class="message ${msg.isMine ? 'sent' : 'received'}">
                    <div>${escapeHtml(msg.text)}</div>
                    <div class="message-time">${formatTime(msg.time)}</div>
                </div>
            `).join("");
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            input.value = "";
        }
    }

    // New Message Modal
    const modal = document.getElementById("newMsgModal");
    function openModal() { modal.style.display = "flex"; }
    function closeModal() { modal.style.display = "none"; }
    document.getElementById("newMessageBtn").addEventListener("click", openModal);
    document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    document.getElementById("sendNewMsgBtn").addEventListener("click", () => {
        const recipient = document.getElementById("recipientSelect").value;
        const subject = document.getElementById("msgSubject").value.trim();
        const body = document.getElementById("msgBody").value.trim();
        if (!recipient || !subject || !body) {
            alert("Please fill all fields.");
            return;
        }
        // Create new conversation or add to existing?
        let existing = conversations.find(c => c.withUser === recipient);
        if (existing) {
            existing.messages.push({
                from: "Amina Bello",
                text: `[${subject}] ${body}`,
                time: new Date().toISOString().slice(0,16).replace('T',' '),
                isMine: true
            });
            existing.lastMessage = body.substring(0,40);
            existing.lastTime = new Date().toISOString().slice(0,16).replace('T',' ');
            existing.unread = 0;
        } else {
            const newId = "c" + (conversations.length+1);
            const avatar = recipient === "Dr. Fatima Bello" ? "FB" : (recipient === "Prof. Adekunle Oluwole" ? "AO" : "AD");
            conversations.push({
                id: newId,
                withUser: recipient,
                role: recipient.includes("Dr.") ? "Supervisor" : (recipient.includes("Prof.") ? "HOD" : "Admin"),
                avatar: avatar,
                lastMessage: body.substring(0,40),
                lastTime: new Date().toISOString().slice(0,16).replace('T',' '),
                unread: 0,
                messages: [{ from: "Amina Bello", text: `[${subject}] ${body}`, time: new Date().toISOString().slice(0,16).replace('T',' '), isMine: true }]
            });
        }
        renderConversations();
        closeModal();
        document.getElementById("recipientSelect").value = "";
        document.getElementById("msgSubject").value = "";
        document.getElementById("msgBody").value = "";
        alert("Message sent!");
    });

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, m => m === '&' ? '&amp;' : (m === '<' ? '&lt;' : '&gt;'));
    }

    document.getElementById("sendMsgBtn").addEventListener("click", sendMessage);
    document.getElementById("messageInput").addEventListener("keypress", (e) => {
        if (e.key === "Enter") sendMessage();
    });

    // Logout demo
    function logoutDemo() { alert("Logged out – redirect to login."); }
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

    // Initial load: select first conversation
    if (conversations.length > 0) {
        selectConversation(conversations[0].id);
    }
    renderConversations();
</script>
</body>
</html>