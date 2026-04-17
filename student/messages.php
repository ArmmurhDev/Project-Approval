<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Topic Verifier | Messages</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
</head>
<body>
<div class="app-container">
    <button class="mobile-menu-toggle" id="mobileToggle"><i class="fas fa-bars"></i> Menu</button>
    <?php $currentPage = 'messages'; include '../include/student_sidebar.php'; ?>

    <main class="main-content">
        <div class="top-bar">
            <div class="page-title">
                <h1><i class="fas fa-envelope"></i> Messages</h1>
                <p>Communicate with supervisors and coordinators</p>
            </div>
            <div class="student-profile">
                <span class="student-name"><i class="fas fa-user"></i> Amina Bello</span>
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
            <button class="btn-cancel" id="closeModalBtn">Cancel</button>
            <button class="btn-submit" id="sendNewMsgBtn">Send Message</button>
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