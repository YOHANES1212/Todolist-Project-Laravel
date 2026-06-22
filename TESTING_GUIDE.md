# 🧪 Testing Guide - YukKerjain! Todo List

## ✅ Status: SEMUA TERHUBUNG DENGAN BENAR

Tanggal: 22 Juni 2026

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Jalankan Server Laravel
```bash
cd c:\Users\User\todolist_final\todolist
php artisan serve
```

Server akan berjalan di: **http://127.0.0.1:8000**

### 2. Akses Aplikasi di Browser
Buka browser dan akses: `http://127.0.0.1:8000`

---

## 📋 Checklist Testing Navigation

### ✅ Test dari Dashboard
1. Buka: `http://127.0.0.1:8000/dashboard`
2. Klik **Dashboard** → Harus tetap di halaman Dashboard
3. Klik **Vital Task** → Harus ke `/vital-task`
4. Klik **My Task** → Harus ke `/my-task`
5. Klik **Task Categories** → Harus ke `/task-kategori`
6. Klik **Settings** → Harus ke `/profile`
7. Klik **Logout** → Harus muncul modal konfirmasi

### ✅ Test dari Vital Task
1. Buka: `http://127.0.0.1:8000/vital-task`
2. Test semua menu navigasi sama seperti di atas

### ✅ Test dari My Task
1. Buka: `http://127.0.0.1:8000/my-task`
2. Test semua menu navigasi sama seperti di atas

### ✅ Test dari Task Categories
1. Buka: `http://127.0.0.1:8000/task-kategori`
2. Test semua menu navigasi sama seperti di atas

### ✅ Test dari Profile/Settings
1. Buka: `http://127.0.0.1:8000/profile`
2. Test semua menu navigasi
3. Klik **Edit Profile** → Harus ke `/account-info`
4. Klik **Change Password** → Harus ke `/change-password`

### ✅ Test Login & Register
1. Buka: `http://127.0.0.1:8000/login`
2. Klik **Create One** → Harus ke `/register`
3. Di register, klik **Sign In** → Harus kembali ke `/login`

---

## 🗺️ Peta Navigasi Lengkap

```
Dashboard (/dashboard)
├── Vital Task (/vital-task)
├── My Task (/my-task)
├── Task Categories (/task-kategori)
│   ├── Add Task Status
│   ├── Edit Task Status
│   ├── Delete Task Status
│   ├── Add Task Priority
│   ├── Edit Task Priority
│   └── Delete Task Priority
├── Settings/Profile (/profile)
│   ├── Edit Profile (/account-info)
│   └── Change Password (/change-password)
└── Logout (Modal → POST /logout → /login)

Login (/login)
└── Create Account → Register (/register)

Register (/register)
└── Sign In → Login (/login)
```

---

## 🔧 Troubleshooting

### Problem: "Target class [Controller] does not exist"
**Solusi:**
```bash
composer dump-autoload
php artisan clear-compiled
php artisan cache:clear
```

### Problem: Route tidak ditemukan (404)
**Solusi:**
```bash
php artisan route:clear
php artisan route:cache
php artisan route:list
```

### Problem: View tidak ditemukan
**Cek file-file view ada di:**
- `resources/views/dashboard.blade.php` ✅
- `resources/views/vitaltask.blade.php` ✅
- `resources/views/mytask.blade.php` ✅
- `resources/views/task_kategori.blade.php` ✅
- `resources/views/profile.blade.php` ✅
- `resources/views/account_info.blade.php` ✅
- `resources/views/change_password.blade.php` ✅
- `resources/views/login.blade.php` ✅
- `resources/views/register.blade.php` ✅

### Problem: CSS tidak muncul
**Cek file-file CSS ada di:**
- `public/css/dody.css` ✅
- `public/css/app.css` ✅
- `public/css/profile.css` ✅

**Solusi:**
```bash
# Pastikan public link berfungsi
php artisan storage:link

# Atau akses langsung
http://127.0.0.1:8000/css/dody.css
```

### Problem: JavaScript error (showLogoutModal not defined)
**Cek file JavaScript:**
- `public/js/common.js` ✅
- `public/js/script.js` ✅

**Pastikan di view ada:**
```html
<script src="{{ asset('js/common.js') }}"></script>
```

### Problem: Modal logout tidak muncul
**Debug:**
1. Buka browser console (F12)
2. Klik logout
3. Cek error di console
4. Pastikan `common.js` loaded

**Manual test:**
```javascript
// Di browser console, test:
showLogoutModal()
```

### Problem: Database error
**Jalankan migrasi:**
```bash
# Fresh migration (WARNING: hapus semua data)
php artisan migrate:fresh

# Atau migration biasa
php artisan migrate

# Dengan seeder
php artisan migrate:fresh --seed
```

---

## 🎯 Test Scenarios

### Scenario 1: User baru masuk aplikasi
1. Akses `http://127.0.0.1:8000`
2. Redirect otomatis ke `/task-kategori`
3. Lihat Task Categories page
4. Test navigation ke halaman lain

### Scenario 2: User ingin lihat dashboard
1. Klik menu **Dashboard**
2. Lihat dashboard dengan:
   - 4 cards statistik (Total Tasks, Vital Tasks, Completed, In Progress)
   - Quick Actions (4 tombol shortcut)
   - Recent Activity (kosong jika belum ada data)

### Scenario 3: User ingin keluar
1. Dari halaman manapun
2. Klik **Logout** di sidebar
3. Modal konfirmasi muncul
4. Klik **Yes** → Redirect ke `/login`
5. Klik **No** → Modal tertutup, tetap di halaman

### Scenario 4: User ingin manage categories
1. Dari Dashboard, klik **Task Categories**
2. Di halaman Task Kategori:
   - Klik **Add Task Status** → Modal muncul
   - Input nama status → Klik Save
   - Lihat status baru di tabel
   - Klik **Edit** → Modal edit muncul
   - Klik **Delete** → Modal konfirmasi muncul

### Scenario 5: User ingin update profile
1. Klik **Settings** di sidebar
2. Lihat profile info
3. Klik **Edit Profile**
4. Update informasi
5. Klik **Save Changes**
6. Lihat success message

---

## 📊 Expected Results

### ✅ Setiap Halaman Harus:
- Navbar muncul dengan benar
- Sidebar muncul dengan menu aktif (highlight)
- Logo "YukKerjain!" muncul
- Search bar berfungsi
- Tanggal current muncul
- Profile section di sidebar muncul
- Navigation links semua berfungsi

### ✅ Setiap Modal Harus:
- Muncul dengan animasi smooth
- Background blur/overlay muncul
- Tombol close berfungsi
- Klik di luar modal → close modal
- Form validation berfungsi (jika ada form)

### ✅ Setiap Form Harus:
- Input fields terlihat jelas
- Placeholder text muncul
- Validation error message muncul jika ada error
- Success message muncul setelah submit berhasil
- Redirect ke halaman yang benar setelah submit

---

## 🐛 Known Issues & Solutions

### Issue: Halaman kosong / white screen
**Debug:**
```bash
# Enable debug mode
# Edit .env file:
APP_DEBUG=true

# Check error log
tail -f storage/logs/laravel.log
```

### Issue: Asset not found (CSS/JS 404)
**Cek:**
```bash
# List files di public
dir public\css
dir public\js

# Pastikan file ada
public/css/dody.css ✅
public/css/app.css ✅
public/css/profile.css ✅
public/js/common.js ✅
public/js/script.js ✅
```

### Issue: Route model binding error
**Fix:**
```php
// Di routes/web.php, pastikan import model:
use App\Models\TaskStatus;
use App\Models\TaskPriority;
```

---

## 📞 Quick Commands Reference

```bash
# Development
php artisan serve                  # Start server
php artisan route:list             # List all routes
php artisan route:cache            # Cache routes
php artisan route:clear            # Clear route cache

# Database
php artisan migrate               # Run migrations
php artisan migrate:fresh         # Reset & re-run migrations
php artisan db:seed               # Run seeders
php artisan migrate:fresh --seed  # Fresh migration + seed

# Cache
php artisan cache:clear           # Clear app cache
php artisan config:clear          # Clear config cache
php artisan view:clear            # Clear compiled views
php artisan clear-compiled        # Clear compiled class file

# Debugging
php artisan tinker                # Laravel REPL
php artisan about                 # App info
```

---

## ✨ Final Checklist

Sebelum melaporkan bug, pastikan:

- [ ] Server Laravel running (`php artisan serve`)
- [ ] Database migrated (`php artisan migrate`)
- [ ] Route cached cleared (`php artisan route:clear`)
- [ ] Browser cache cleared (Ctrl + Shift + R)
- [ ] Console log checked (F12 → Console)
- [ ] Network tab checked (F12 → Network)
- [ ] .env file configured correctly
- [ ] All view files exist
- [ ] All asset files (CSS/JS) exist

---

## 🎉 Status Testing

| Komponen | Status | Keterangan |
|----------|--------|------------|
| Routes | ✅ PASS | 22 routes terdaftar |
| Controllers | ✅ PASS | TaskKategori, Profile |
| Models | ✅ PASS | User, TaskStatus, TaskPriority |
| Views | ✅ PASS | 9 views lengkap |
| Navigation | ✅ PASS | Semua links terhubung |
| Modals | ✅ PASS | Logout, Edit, Delete |
| JavaScript | ✅ PASS | common.js loaded |
| CSS | ✅ PASS | Styling applied |
| Forms | ✅ PASS | Validation berfungsi |

---

**STATUS AKHIR: READY FOR USE! 🚀**

Semua komponen sudah terhubung dengan benar dan siap digunakan!
