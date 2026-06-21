<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerjain! - Account Information</title>
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
            <h3>{{ $first_name }} {{ $last_name }}</h3>
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
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
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

        <div class="content account-content">
            <div class="page-header">
                <div>
                    <h2>Account Information</h2>
                </div>
            </div>

            @if (!empty($errors))
                <div style="color:#B91C1C; margin-bottom:16px; font-size:14px;">
                    {!! implode('<br>', $errors) !!}
                </div>
            @endif
            @if ($success)
                <div style="color:#10B981; margin-bottom:16px; font-size:14px;">
                    {{ $success }}
                </div>
            @endif

            <div class="account-card">
                <div class="account-user">
                    <div class="profile-avatar-wrapper">
                        <img id="profileAvatar" src="{{ asset($profile_pic) }}" alt="profile" class="account-avatar">
                    </div>
                    <div class="profile-avatar-actions">
                        <button type="button" class="profile-edit-button" onclick="togglePhotoModal()">
                            <i class="fas fa-pen"></i> Edit
                        </button>
                    </div>
                    <div class="account-user-text">
                        <h3>{{ $first_name }} {{ $last_name }}</h3>
                        <p>{{ $email }}</p>
                    </div>
                </div>

                <form id="photoForm" class="account-form" method="post" action="{{ route('account.info.post') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="profile_pic_input" type="file" name="profile_pic" accept="image/*" style="display:none;">
                    <input id="remove_photo" type="hidden" name="remove_photo" value="no">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input id="first-name" type="text" name="first_name" value="{{ $first_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" type="text" name="last_name" value="{{ $last_name }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="email">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ $email }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input id="age" type="number" name="age" min="0" value="{{ $age }}">
                        </div>
                        <div class="form-group">
                            <label for="school">School/University</label>
                            <input id="school" type="text" name="school" value="{{ $school }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="social_media">Social Media Link</label>
                            <input id="social_media" type="url" name="social_media" value="{{ $social_media }}" placeholder="https://...">
                        </div>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn-primary">Save Changes</button>
                        <a href="{{ route('profile') }}" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<div id="photoModal" class="photo-modal">
    <div class="photo-modal-backdrop" onclick="closePhotoModal()"></div>
    <div class="photo-modal-content">
        <div class="photo-modal-header">
            <h3>Change Profile Photo</h3>
            <button type="button" class="modal-close-btn" onclick="closePhotoModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="photo-modal-options">
            <button type="button" class="photo-modal-option camera-option" onclick="openUpload('camera')">
                <div class="photo-option-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <div class="photo-option-info">
                    <p class="photo-option-title">Take Photo</p>
                </div>
            </button>
            <button type="button" class="photo-modal-option library-option" onclick="openUpload('library')">
                <div class="photo-option-icon">
                    <i class="fas fa-images"></i>
                </div>
                <div class="photo-option-info">
                    <p class="photo-option-title">Choose from Library</p>
                </div>
            </button>
            <button type="button" class="photo-modal-option delete-option" onclick="removePhoto()">
                <div class="photo-option-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <div class="photo-option-info">
                    <p class="photo-option-title">Delete Photo</p>
                </div>
            </button>
        </div>
    </div>
</div>

<div id="removePhotoModal" class="modal">
    <div class="modal-overlay" onclick="hideRemovePhotoModal()"></div>
    <div class="modal-content">
        <h1>Are You Sure?</h1>
        <p>You will delete your profile photo and it will be replaced with the default photo.</p>
        <div class="modal-buttons">
            <button type="button" onclick="confirmRemovePhoto()" class="btn-yes">Yes</button>
            <button type="button" onclick="hideRemovePhotoModal()" class="btn-no">No</button>
        </div>
    </div>
</div>

<script>
    const photoModal = document.getElementById('photoModal');
    const fileInput = document.getElementById('profile_pic_input');
    const removePhotoInput = document.getElementById('remove_photo');
    const photoForm = document.getElementById('photoForm');

    function togglePhotoModal() {
        photoModal.classList.toggle('open');
    }

    function closePhotoModal() {
        photoModal.classList.remove('open');
    }

    function openUpload(mode) {
        if (mode === 'camera') {
            fileInput.setAttribute('capture', 'environment');
        } else {
            fileInput.removeAttribute('capture');
        }
        removePhotoInput.value = 'no';
        fileInput.click();
        closePhotoModal();
    }

    function removePhoto() {
        showRemovePhotoModal();
    }

    function showRemovePhotoModal() {
        const modal = document.getElementById('removePhotoModal');
        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('show'), 10);
    }

    function hideRemovePhotoModal() {
        const modal = document.getElementById('removePhotoModal');
        modal.classList.remove('show');
        setTimeout(() => modal.style.display = 'none', 300);
    }

    function confirmRemovePhoto() {
        removePhotoInput.value = 'yes';
        photoForm.submit();
    }

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            removePhotoInput.value = 'no';
            photoForm.submit();
        }
    });

    document.addEventListener('click', function (event) {
        if (photoModal && !photoModal.contains(event.target) && !event.target.closest('.profile-edit-button')) {
            closePhotoModal();
        }
    });
</script>
</body>
</html>
