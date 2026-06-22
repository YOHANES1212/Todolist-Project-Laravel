<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - YukKerjain!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-layout">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="profile-section">
                <div class="profile-pic">
                    <img src="https://ui-avatars.com/api/?name=Sundar+Gurung&background=4a5568&color=fff&size=100" alt="Profile">
                </div>
                <h3 class="profile-name">Michael Tjandra</h3>
                <p class="profile-email">Michael@gmail.com</p>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('vital_task') }}" class="nav-link">
                    <i class="fas fa-bolt"></i>
                    <span>Vital Task</span>
                </a>
                <a href="{{ route('my_task') }}" class="nav-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>My Task</span>
                </a>
                <a href="{{ route('task_kategori.index') }}" class="nav-link">
                    <i class="fas fa-list"></i>
                    <span>Task Categories</span>
                </a>
                <a href="{{ route('profile') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-question-circle"></i>
                    <span>Help</span>
                </a>
            </nav>

            <button class="logout-button" onclick="showLogoutModal()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- TOP HEADER -->
            <header class="top-header">
                <h1 class="page-title"><span class="title-red">Dash</span><span class="title-black">board</span></h1>
                
                <div class="search-container">
                    <input type="text" placeholder="Search your task here..." class="search-input">
                </div>

                <div class="header-actions">
                    <button class="action-btn"><i class="fas fa-search"></i></button>
                    <button class="action-btn"><i class="fas fa-bell"></i></button>
                    <button class="action-btn"><i class="fas fa-envelope"></i></button>
                    <div class="date-display">
                        <span class="day-name">{{ now()->translatedFormat('l') }}</span>
                        <span class="date-value">{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </header>

            <!-- CONTENT AREA -->
            <div class="content-wrapper">
                <!-- WELCOME SECTION -->
                <div class="welcome-bar">
                    <h2 class="welcome-text">Welcome back, Sundar <span class="wave">👋</span></h2>
                    <div class="team-section">
                        <div class="avatars">
                            <div class="avatar" style="background: #667eea;">JD</div>
                            <div class="avatar" style="background: #f093fb;">JS</div>
                            <div class="avatar" style="background: #4facfe;">BW</div>
                            <div class="avatar" style="background: #43e97b;">AB</div>
                            <div class="avatar" style="background: #fa709a;">MD</div>
                        </div>
                        <button class="invite-btn" onclick="showInviteModal()"><i class="fas fa-user-plus"></i> Invite</button>
                    </div>
                </div>

                <!-- MAIN GRID -->
                <div class="main-grid">
                    <!-- LEFT: TO-DO SECTION -->
                    <div class="todo-container">
                        <div class="section-header">
                            <div class="section-title">
                                <i class="far fa-circle"></i>
                                <span>To-Do</span>
                            </div>
                            <button class="add-btn" onclick="showAddTaskModal()">+ Add task</button>
                        </div>

                        <p class="date-label">20 June <span class="today">- Today</span></p>

                        <!-- TASK CARD 1 -->
                        <div class="task-card">
                            <div class="task-icon red">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div class="task-body">
                                <h4 class="task-title">Attend Nischal's Birthday Party</h4>
                                <p class="task-desc">Buy gifts on the way and pick up cake from the bakery. (6 PM | Fresh Elements)</p>
                                <div class="task-meta">
                                    <span class="priority moderate">Priority: Moderate</span>
                                    <span class="status not-started">Status: Not Started</span>
                                    <span class="created">Created on 20/06/2023</span>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=100&h=100&fit=crop" alt="Task" class="task-img">
                            <button class="task-menu"><i class="fas fa-ellipsis-v"></i></button>
                        </div>

                        <!-- TASK CARD 2 -->
                        <div class="task-card">
                            <div class="task-icon blue">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="task-body">
                                <h4 class="task-title">Landing Page Design for TravelDays</h4>
                                <p class="task-desc">Get the work done by EOD and discuss with client before leaving. (4 PM | Meeting Room)</p>
                                <div class="task-meta">
                                    <span class="priority moderate">Priority: Moderate</span>
                                    <span class="status in-progress">Status: In Progress</span>
                                    <span class="created">Created on 20/06/2023</span>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=100&h=100&fit=crop" alt="Task" class="task-img">
                            <button class="task-menu"><i class="fas fa-ellipsis-v"></i></button>
                        </div>

                        <!-- TASK CARD 3 -->
                        <div class="task-card">
                            <div class="task-icon blue">
                                <i class="fas fa-presentation"></i>
                            </div>
                            <div class="task-body">
                                <h4 class="task-title">Presentation on Final Product</h4>
                                <p class="task-desc">Make sure everything is functioning flawlessly, rehearse the presentation and dummy test it on Friday.</p>
                                <div class="task-meta">
                                    <span class="priority moderate">Priority: Moderate</span>
                                    <span class="status in-progress">Status: In Progress</span>
                                    <span class="created">Created on 18/06/2023</span>
                                </div>
                            </div>
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=100&h=100&fit=crop" alt="Task" class="task-img">
                            <button class="task-menu"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <!-- RIGHT: STATUS & COMPLETED -->
                    <div class="right-sidebar">
                        <!-- TASK STATUS -->
                        <div class="status-box">
                            <div class="box-header">
                                <i class="fas fa-chart-pie"></i>
                                <span>Task Status</span>
                            </div>
                            <div class="progress-row">
                                <div class="progress-item">
                                    <svg class="progress-ring" width="100" height="100">
                                        <circle class="progress-bg" cx="50" cy="50" r="40"></circle>
                                        <circle class="progress-bar green" cx="50" cy="50" r="40" 
                                            stroke-dasharray="251.2" stroke-dashoffset="40"></circle>
                                        <text x="50" y="55" class="progress-text">84%</text>
                                    </svg>
                                    <p class="progress-label green">● Completed</p>
                                </div>
                                <div class="progress-item">
                                    <svg class="progress-ring" width="100" height="100">
                                        <circle class="progress-bg" cx="50" cy="50" r="40"></circle>
                                        <circle class="progress-bar blue" cx="50" cy="50" r="40" 
                                            stroke-dasharray="251.2" stroke-dashoffset="135"></circle>
                                        <text x="50" y="55" class="progress-text">46%</text>
                                    </svg>
                                    <p class="progress-label blue">● In Progress</p>
                                </div>
                                <div class="progress-item">
                                    <svg class="progress-ring" width="100" height="100">
                                        <circle class="progress-bg" cx="50" cy="50" r="40"></circle>
                                        <circle class="progress-bar red" cx="50" cy="50" r="40" 
                                            stroke-dasharray="251.2" stroke-dashoffset="218"></circle>
                                        <text x="50" y="55" class="progress-text">13%</text>
                                    </svg>
                                    <p class="progress-label red">● Not Started</p>
                                </div>
                            </div>
                        </div>

                        <!-- COMPLETED TASK -->
                        <div class="completed-box">
                            <div class="box-header">
                                <i class="fas fa-check-circle"></i>
                                <span>Completed Task</span>
                            </div>

                            <div class="completed-card">
                                <i class="fas fa-check-circle check-icon"></i>
                                <div class="completed-info">
                                    <h5 class="completed-title">Walk the dog</h5>
                                    <p class="completed-desc">Take the dog to the park and bring treats as well.</p>
                                    <p class="completed-status">Status: <span class="green">Completed</span></p>
                                    <p class="completed-time">Completed 2 days ago</p>
                                </div>
                                <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=80&h=80&fit=crop" alt="Task" class="completed-img">
                                <button class="completed-menu"><i class="fas fa-ellipsis-v"></i></button>
                            </div>

                            <div class="completed-card">
                                <i class="fas fa-check-circle check-icon"></i>
                                <div class="completed-info">
                                    <h5 class="completed-title">Conduct meeting</h5>
                                    <p class="completed-desc">Meet with the client and finalize requirements.</p>
                                    <p class="completed-status">Status: <span class="green">Completed</span></p>
                                    <p class="completed-time">Completed 2 days ago</p>
                                </div>
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=80&h=80&fit=crop" alt="Task" class="completed-img">
                                <button class="completed-menu"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="modal">
        <div class="modal-overlay" onclick="hideLogoutModal()"></div>
        <div class="modal-box">
            <h3>Are You Sure?</h3>
            <p>You will be logged out of the current account.</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="modal-actions">
                    <button type="submit" class="btn-yes">Yes, Logout</button>
                    <button type="button" class="btn-no" onclick="hideLogoutModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ADD TASK MODAL -->
    <div id="addTaskModal" class="modal">
        <div class="modal-overlay" onclick="hideAddTaskModal()"></div>
        <div class="add-task-modal-box">
            <div class="modal-header">
                <h3>Add New Task</h3>
                <button class="modal-close-btn" onclick="hideAddTaskModal()">×</button>
            </div>
            
            <form class="add-task-form">
                <div class="form-group">
                    <label>Task Title <span class="required">*</span></label>
                    <input type="text" placeholder="Enter task title" class="form-input" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea placeholder="Enter task description" class="form-textarea" rows="3"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Priority <span class="required">*</span></label>
                        <select class="form-select" required>
                            <option value="">Select Priority</option>
                            <option value="low">Low</option>
                            <option value="moderate">Moderate</option>
                            <option value="high">High</option>
                            <option value="extreme">Extreme</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status <span class="required">*</span></label>
                        <select class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="not-started" selected>Not Started</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" class="form-input">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-select">
                            <option value="">Select Category</option>
                            <option value="personal">Personal</option>
                            <option value="work">Work</option>
                            <option value="meeting">Meeting</option>
                            <option value="event">Event</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Attach Image (Optional)</label>
                    <input type="file" accept="image/*" class="form-file">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Create Task</button>
                    <button type="button" class="btn-cancel" onclick="hideAddTaskModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- INVITE MEMBER MODAL -->
    <div id="inviteModal" class="modal">
        <div class="modal-overlay" onclick="hideInviteModal()"></div>
        <div class="invite-modal-box">
            <div class="invite-modal-header">
                <h3>Send an invite to a new member</h3>
                <button class="go-back-btn" onclick="hideInviteModal()">Go Back</button>
            </div>

            <div class="invite-modal-content">
                <!-- EMAIL INPUT -->
                <div class="invite-email-section">
                    <label class="invite-label">Email</label>
                    <div class="invite-email-input-group">
                        <input type="email" placeholder="newrajgurung99@gmail.com" class="invite-email-input">
                        <button class="send-invite-btn">Send Invite</button>
                    </div>
                </div>

                <!-- MEMBERS LIST -->
                <div class="members-section">
                    <h4 class="members-title">Members</h4>
                    
                    <div class="member-item">
                        <img src="https://ui-avatars.com/api/?name=Upashna+Gurung&background=667eea&color=fff" alt="Member" class="member-avatar">
                        <div class="member-info">
                            <div class="member-name">Upashna Gurung</div>
                            <div class="member-email">upashnag931@gmail.com</div>
                        </div>
                        <select class="member-role-select">
                            <option value="edit" selected>Can edit</option>
                            <option value="view">Can view</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>

                    <div class="member-item">
                        <img src="https://ui-avatars.com/api/?name=Jeremy+Lee&background=f093fb&color=fff" alt="Member" class="member-avatar">
                        <div class="member-info">
                            <div class="member-name">Jeremy Lee</div>
                            <div class="member-email">jeremylee199@gmail.com</div>
                        </div>
                        <select class="member-role-select">
                            <option value="edit" selected>Can edit</option>
                            <option value="view">Can view</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>

                    <div class="member-item">
                        <img src="https://ui-avatars.com/api/?name=Thomas+Park&background=4facfe&color=fff" alt="Member" class="member-avatar">
                        <div class="member-info">
                            <div class="member-name">Thomas Park</div>
                            <div class="member-email">parkho234@gmail.com</div>
                        </div>
                        <select class="member-role-select">
                            <option value="owner" selected>Owner</option>
                            <option value="edit">Can edit</option>
                            <option value="view">Can view</option>
                        </select>
                    </div>

                    <div class="member-item">
                        <img src="https://ui-avatars.com/api/?name=Rachel+Takahasi&background=43e97b&color=fff" alt="Member" class="member-avatar">
                        <div class="member-info">
                            <div class="member-name">Rachel Takahasi</div>
                            <div class="member-email">takahasiraa23@gmail.com</div>
                        </div>
                        <select class="member-role-select">
                            <option value="edit" selected>Can edit</option>
                            <option value="view">Can view</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                </div>

                <!-- PROJECT LINK -->
                <div class="project-link-section">
                    <label class="invite-label">Project Link</label>
                    <div class="project-link-input-group">
                        <input type="text" value="https://chandnimarestaurant/home.com/4s4060y29" class="project-link-input" readonly>
                        <button class="copy-link-btn">Copy Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
        }
        function hideLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
        function showAddTaskModal() {
            document.getElementById('addTaskModal').style.display = 'flex';
        }
        function hideAddTaskModal() {
            document.getElementById('addTaskModal').style.display = 'none';
        }
        function showInviteModal() {
            document.getElementById('inviteModal').style.display = 'flex';
        }
        function hideInviteModal() {
            document.getElementById('inviteModal').style.display = 'none';
        }
        
        // Copy link functionality
        document.addEventListener('DOMContentLoaded', function() {
            const copyBtn = document.querySelector('.copy-link-btn');
            if (copyBtn) {
                copyBtn.addEventListener('click', function() {
                    const input = document.querySelector('.project-link-input');
                    input.select();
                    document.execCommand('copy');
                    this.textContent = 'Copied!';
                    setTimeout(() => {
                        this.textContent = 'Copy Link';
                    }, 2000);
                });
            }
        });
    </script>
</body>
</html>
