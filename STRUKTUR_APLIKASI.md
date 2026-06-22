# 📋 Dokumentasi Struktur Aplikasi Todo List

## ✅ Status Perbaikan
**Tanggal**: 22 Juni 2026
**Status**: Semua komponen sudah terhubung dengan benar

---

## 🗂️ Struktur Routing (routes/web.php)

### 1. **Routes Umum**
- `GET /` → Redirect ke `/task-kategori`
- `GET /dashboard` → Redirect ke `/task-kategori` (named: `dashboard`)

### 2. **Task Kategori Routes**
- `GET /task-kategori` → `TaskKategoriController@index` (named: `task_kategori.index`)
- `POST /task-kategori/status` → `TaskKategoriController@storeStatus` (named: `task_kategori.storeStatus`)
- `POST /task-kategori/priority` → `TaskKategoriController@storePriority` (named: `task_kategori.storePriority`)
- `PUT /task-kategori/status/{id}` → `TaskKategoriController@updateStatus` (named: `task_kategori.updateStatus`)
- `PUT /task-kategori/priority/{id}` → `TaskKategoriController@updatePriority` (named: `task_kategori.updatePriority`)
- `DELETE /task-kategori/status/{id}` → `TaskKategoriController@destroyStatus` (named: `task_kategori.destroyStatus`)
- `DELETE /task-kategori/priority/{id}` → `TaskKategoriController@destroyPriority` (named: `task_kategori.destroyPriority`)

### 3. **Task Views Routes**
- `GET /my-task` → view('mytask') (named: `my_task`)
- `GET /vital-task` → view('vitaltask') (named: `vital_task`)

### 4. **Auth Routes**
- `GET /login` → view('login') (named: `login`)
- `GET /register` → view('register') (named: `register`)
- `POST /logout` → Logout & Redirect to login (named: `logout`)

### 5. **Profile Routes** (Protected by auth middleware)
- `GET /profile` → `ProfileController@showProfile` (named: `profile`)
- `GET /account-info` → `ProfileController@showAccountInfo` (named: `account.info`)
- `POST /account-info` → `ProfileController@updateAccountInfo` (named: `account.info.update`)
- `GET /change-password` → `ProfileController@showChangePassword` (named: `change.password`)
- `POST /change-password` → `ProfileController@changePassword` (named: `change.password.post`)

---

## 📊 Struktur Database

### Table: `users`
| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | NO | Primary Key |
| name | varchar(255) | NO | Full name |
| first_name | varchar(255) | YES | First name |
| last_name | varchar(255) | YES | Last name |
| email | varchar(255) | NO | Email (unique) |
| email_verified_at | timestamp | YES | Email verification |
| password | varchar(255) | NO | Hashed password |
| age | integer | YES | User age |
| school | varchar(255) | YES | School/University |
| social_media | varchar(255) | YES | Social media link |
| profile_pic | varchar(255) | YES | Profile picture path |
| remember_token | varchar(100) | YES | Remember token |
| created_at | timestamp | YES | Created timestamp |
| updated_at | timestamp | YES | Updated timestamp |

### Table: `task_status`
| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | NO | Primary Key |
| status_name | varchar(255) | NO | Status name |
| created_at | timestamp | YES | Created timestamp |
| updated_at | timestamp | YES | Updated timestamp |

### Table: `task_priority`
| Column | Type | Nullable | Description |
|--------|------|----------|-------------|
| id | bigint | NO | Primary Key |
| priority_name | varchar(255) | NO | Priority name |
| created_at | timestamp | YES | Created timestamp |
| updated_at | timestamp | YES | Updated timestamp |

---

## 🎯 Model Eloquent

### User Model (`app/Models/User.php`)
```php
protected $fillable = [
    'name', 'first_name', 'last_name', 'email', 'password',
    'age', 'school', 'social_media', 'profile_pic'
];

protected $hidden = ['password', 'remember_token'];
```

### TaskStatus Model (`app/Models/TaskStatus.php`)
```php
protected $table = 'task_status';
protected $fillable = ['status_name'];
public $timestamps = true;
```

### TaskPriority Model (`app/Models/TaskPriority.php`)
```php
protected $table = 'task_priority';
protected $fillable = ['priority_name'];
public $timestamps = true;
```

---

## 🎨 Views dan Navigation

### Navigation Links (Sidebar)
Semua view menggunakan navigation yang konsisten:

1. **Dashboard** → `route('dashboard')`
2. **Vital Task** → `route('vital_task')`
3. **My Task** → `route('my_task')`
4. **Task Categories** → `route('task_kategori.index')`
5. **Settings** → `route('account.info')` atau `route('profile')`
6. **Logout** → Modal logout dengan POST ke `route('logout')`

### View Files
| File | Route | Purpose |
|------|-------|---------|
| welcome.blade.php | / | Landing page |
| login.blade.php | /login | Login form |
| register.blade.php | /register | Registration form |
| profile.blade.php | /profile | View profile |
| account_info.blade.php | /account-info | Edit account |
| change_password.blade.php | /change-password | Change password |
| task_kategori.blade.php | /task-kategori | Task categories management |
| mytask.blade.php | /my-task | User tasks |
| vitaltask.blade.php | /vital-task | Vital tasks |

---

## 📦 Controllers

### TaskKategoriController
**Methods:**
- `index()` - Tampilkan semua status & priority
- `storeStatus(Request)` - Simpan status baru
- `storePriority(Request)` - Simpan priority baru
- `updateStatus(Request, $id)` - Update status
- `updatePriority(Request, $id)` - Update priority
- `destroyStatus($id)` - Hapus status
- `destroyPriority($id)` - Hapus priority

### ProfileController
**Methods:**
- `showProfile()` - Tampilkan profile user/guest
- `showAccountInfo()` - Tampilkan form edit account
- `updateAccountInfo(Request)` - Update account info & profile pic
- `showChangePassword()` - Tampilkan form ganti password
- `changePassword(Request)` - Proses ganti password

**Helper Methods:**
- `accountInfoPayload($user)` - Payload untuk account info view
- `changePasswordPayload($user)` - Payload untuk change password view
- `storeProfilePhoto($photo, $user)` - Upload profile photo
- `removeProfilePhoto($user)` - Hapus profile photo

---

## 🔧 JavaScript Common Functions (`public/js/common.js`)

### Functions:
1. **togglePassword(inputId)** - Toggle visibility password field
2. **showLogoutModal()** - Tampilkan modal logout
3. **hideLogoutModal()** - Sembunyikan modal logout
4. **updateDate()** - Update tanggal di topbar
5. **Window click handler** - Close modal saat klik di luar

### Usage di View:
```html
<script src="{{ asset('js/common.js') }}"></script>
```

---

## 🚀 Cara Menjalankan Migrasi

### 1. Fresh Migration (Reset database)
```bash
php artisan migrate:fresh
```

### 2. Run Migration (Update saja)
```bash
php artisan migrate
```

### 3. Dengan Seeder
```bash
php artisan migrate:fresh --seed
```

---

## 📝 Migrations yang Perlu Dijalankan

1. `0001_01_01_000000_create_users_table.php` - Tabel users dengan field lengkap
2. `0001_01_01_000001_create_cache_table.php` - Tabel cache
3. `0001_01_01_000002_create_jobs_table.php` - Tabel jobs
4. `2026_06_10_093406_create_task_status_table.php` - Tabel task status
5. `2026_06_10_093459_create_task_priority_table.php` - Tabel task priority
6. `2026_06_22_093922_add_profile_fields_to_users_table.php` - Update tabel users (jika sudah ada)

---

## ✨ Fitur yang Sudah Terhubung

### ✅ Authentication
- Login/Logout dengan session
- Middleware `auth` untuk protect routes
- Guest mode untuk user yang belum login

### ✅ Profile Management
- View profile
- Edit account info (first name, last name, email, age, school, social media)
- Upload/Remove profile picture
- Change password dengan validasi

### ✅ Task Management
- CRUD Task Status
- CRUD Task Priority
- View My Tasks
- View Vital Tasks

### ✅ UI/UX
- Sidebar navigation konsisten
- Topbar dengan search & date
- Logout modal dengan konfirmasi
- Password toggle visibility
- Profile photo upload modal
- Success/Error messages

---

## 🔐 Security Features

1. **CSRF Protection** - Semua form menggunakan `@csrf`
2. **Password Hashing** - Menggunakan `Hash::make()`
3. **Middleware Auth** - Protected routes dengan `auth` middleware
4. **Validation** - Request validation di semua form
5. **File Upload Security** - Validasi image upload dengan max 2MB

---

## 🎯 Next Steps (Opsional)

### Yang bisa ditambahkan:
1. ✅ Sistem Task dengan CRUD lengkap
2. ✅ Assign priority & status ke task
3. ✅ Filter & search tasks
4. ✅ Task categories (sudah ada basic)
5. ✅ Notifications system
6. ✅ Email verification
7. ✅ Forgot password feature
8. ✅ Task sharing antar user
9. ✅ Dashboard analytics
10. ✅ Export tasks (PDF/Excel)

---

## 📞 Troubleshooting

### Error: Route not found
```bash
php artisan route:clear
php artisan route:cache
```

### Error: Class not found
```bash
composer dump-autoload
```

### Error: Session driver
Check `.env` file:
```
SESSION_DRIVER=file
```

### Error: Database connection
Check `.env` file:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

---

## 🎉 Kesimpulan

Semua komponen aplikasi sudah **TERHUBUNG DENGAN BENAR**:

✅ Routes → Controllers → Models → Database
✅ Views → Routes (named routes)
✅ Navigation → Routes
✅ Forms → Controller Actions
✅ JavaScript → HTML Elements
✅ Middleware → Protected Routes
✅ Assets → Public folder

**Status: READY TO USE! 🚀**
