<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- User Profile Section -->
            <div class="user-profile">
                <img src="{{ asset($profile_pic) }}" alt="profile" class="profile-pic">
                <h3>{{ $name }}</h3>
                <p>{{ $email }}</p>
            </div>

            <!-- Navigation Menu -->
            <nav class="sidebar-menu">
                <ul>
                    <li><a href="#"><i class="fas fa-th-large"></i> Dashboard</a></li>
                    <li><a href="#"><i class="fas fa-exclamation-circle"></i> Vital Task</a></li>
                    <li><a href="#"><i class="fas fa-tasks"></i> My Task</a></li>
                    <li><a href="#"><i class="fas fa-list"></i> Task Categories</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="#"><i class="fas fa-question-circle"></i> Help</a></li>
                </ul>
            </nav>

            <!-- Logout -->
            <div class="logout">
                @if ($logged_in)
                    <button onclick="showLogoutModal()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                @endif
            </div>
            <style>
                .logout {
                    display: flex;
                    justify-content: center;
                }

                .logout-btn {
                    background-color: #f8d7da;
                    /* Merah sangat muda */
                    color: #dc3545;
                    /* Warna teks merah tegas */
                    border: 1px solid #f5c6cb;
                    padding: 8px 16px;
                    font-size: 14px;
                    font-weight: 600;
                    border-radius: 6px;
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    /* Jarak antara ikon dan tulisan "Logout" */
                    transition: all 0.3s ease;
                }

                /* Efek ketika kursor di atas tombol */
                .logout-btn:hover {
                    background-color: #dc3545;
                    color: #ffffff;
                    border-color: #dc3545;
                    box-shadow: 0 4px 6px rgba(220, 53, 69, 0.2);
                }

                /* Efek ketika tombol diklik */
                .logout-btn:active {
                    transform: scale(0.98);
                }
            </style>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="topbar">
                <div class="logo">
                    <span class="logo-primary">Yuk</span><span class="logo-secondary">Kerjain!</span>
                </div>

                <div class="search-box">
                    <input type="text" placeholder="Search your task here...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="topbar-actions">
                    <button class="icon-btn"><i class="fas fa-bell"></i></button>
                    <button class="icon-btn"><i class="fas fa-envelope"></i></button>
                    <div class="topbar-date">Tuesday 20/06/2026</div>
                </div>
            </div>

            <!-- Content -->
            <div class="content profile-content">
                <div class="page-header">
                    <div>
                        <h2>Account Information</h2>
                    </div>
                </div>
                <!-- User Info Card -->
                <div class="profile-card">
                    <img src="{{ asset($profile_pic) }}" alt="profile" class="profile-large-pic">
                    <div class="profile-info">
                        <h3>{{ $name }}</h3>
                        <div class="profile-details">
                            <p><strong>Email:</strong> {{ $email ?: 'Not set' }}</p>
                            <p><strong>Age:</strong> {{ $age ?: 'Not set' }}</p>
                            <p><strong>School/University:</strong> {{ $school ?: 'Not set' }}</p>
                            <p><strong>Social Media:</strong>
                                @if ($social_media)
                                    <a href="{{ $social_media }}" target="_blank">{{ $social_media }}</a>
                                @else
                                    Not set
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="profile-actions">
                    @if ($logged_in)
                        <a href="{{ route('account.info') }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                        <a href="{{ route('change.password') }}" class="btn-action btn-password">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                        <button onclick="showLogoutModal()" class="btn-action btn-logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn-action btn-edit">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-action btn-password">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-overlay" onclick="hideLogoutModal()"></div>
        <div class="modal-content">
            <h1>Are You Sure?</h1>
            <p>You will be logged out of the current account and returned to the Guest profile view.</p>
            <form method="POST" action="{{ route('logout') }}" class="logout-buttons">
                @csrf
                <button type="submit" class="btn-yes">Yes</button>
                <button type="button" onclick="hideLogoutModal()" class="btn-no">No</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/common.js') }}"></script>
</body>

</html>
