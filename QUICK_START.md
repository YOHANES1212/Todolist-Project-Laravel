# 🚀 Quick Start Guide - Dashboard Setup

## Langkah-Langkah Setup (5 Menit)

### 1️⃣ Jalankan Migration Database

Buka terminal dan jalankan:

```bash
php artisan migrate
```

Ini akan membuat table `tasks` dan relationships yang diperlukan.

---

### 2️⃣ (OPTIONAL) Jalankan Seeder untuk Sample Data

```bash
php artisan db:seed
```

Atau jalankan seeder specific:

```bash
php artisan db:seed --class=TaskSeeder
```

**Ini akan membuat:**
- Test User: **Bogin** (test@example.com / password: password)
- 10 Sample Tasks dengan berbagai status dan priority

---

### 3️⃣ Akses Dashboard

Buka browser dan navigasi ke:

```
http://localhost:8000/
```

atau

```
http://localhost:8000/dashboard
```

---

## ✨ Fitur Dashboard yang Sudah Siap

✅ Welcome Card dengan nama user yang login  
✅ Statistik Task dalam Progress Circles:
   - Total Tasks
   - Completed (hijau)
   - In Progress (biru)
   - Not Started (merah)

✅ Latest Tasks List dengan:
   - Task title & description
   - Status badge
   - Priority badge
   - Relative date
   - Checkbox untuk mark complete

✅ Sidebar dengan:
   - User profile
   - Navigation menu
   - Links ke pages lain

✅ Search Functionality - Real-time search tasks

✅ Modern Design - Sesuai dengan referensi gambar

---

## 📁 File yang Dibuat

### Controllers
- `app/Http/Controllers/DashboardController.php` - Logic untuk dashboard
- `app/Http/Controllers/TaskController.php` - CRUD operations untuk tasks

### Models
- `app/Models/Task.php` - Model untuk tasks table

### Views
- `resources/views/dashboard.blade.php` - Dashboard view dengan styling

### Database
- `database/migrations/2026_06_21_000000_create_tasks_table.php` - Migration
- `database/seeders/TaskSeeder.php` - Sample data

### Routes (Updated)
- `routes/web.php` - Menambahkan dashboard & task routes

---

## 🔄 Routes yang Tersedia

```
GET  /                 → Dashboard
GET  /dashboard        → Dashboard
POST /tasks            → Create task
PUT  /tasks/{id}       → Update task
DELETE /tasks/{id}     → Delete task
PATCH /tasks/{id}/status    → Update task status
PATCH /tasks/{id}/priority  → Update task priority
GET  /task-kategori         → Task Categories (existing)
```

---

## 📊 Database Schema

**Tasks Table:**
```
id (bigint, PK)
user_id (bigint, FK to users)
title (string)
description (text, nullable)
task_status_id (bigint, FK to task_status, nullable)
task_priority_id (bigint, FK to task_priority, nullable)
created_at (timestamp)
updated_at (timestamp)
```

---

## ❗ Jika Ada Error

### Error: "No query results found"
→ Jalankan migration: `php artisan migrate`

### Error: "1054 Unknown column 'user_id'"
→ Database belum ter-migrate, jalankan: `php artisan migrate:refresh`

### No tasks showing
→ Jalankan seeder: `php artisan db:seed --class=TaskSeeder`

### Authentication error
→ Setup login/authentication di project (currently dashboard expects authenticated user)

---

## 💡 Tips

1. **Generate Test Data** - Gunakan seeder untuk membuat sample tasks: `php artisan db:seed`

2. **Check Database** - Gunakan database client untuk verify tables:
   - `users` - User data
   - `tasks` - Task data (BARU)
   - `task_status` - Status references
   - `task_priority` - Priority references

3. **Search Feature** - Search berfungsi real-time tanpa refresh

4. **Add More Tasks** - Buat via TaskController::store atau langsung di database

5. **Customize Colors** - Edit CSS di `dashboard.blade.php` dalam `<style>` tag

---

## 📝 Default Test User (dari Seeder)

- **Name**: Bogin
- **Email**: test@example.com
- **Password**: password

---

## 🎨 Design Reference

Dashboard mengikuti design reference yang Anda berikan dengan:
- Sidebar dengan user profile
- Modern card-based layout
- Progress circles untuk statistics
- Color-coded status badges
- Responsive design
- Font Awesome icons
- Poppins font

---

## ❓ Pertanyaan Umum

**Q: Bagaimana cara menambah task baru?**
A: Klik tombol "+ Add Task" di dashboard (akan di-implement di phase berikutnya)

**Q: Apakah task saya private?**
A: Ya! Setiap user hanya bisa lihat/edit task mereka sendiri (user_id checking)

**Q: Bagaimana cara edit task status?**
A: Klik pada status badge untuk mengubah (akan di-implement di phase berikutnya)

**Q: Berapa banyak tasks yang ditampilkan?**
A: Dashboard menampilkan 5 task terbaru. Edit di DashboardController jika ingin mengubah.

---

## 🔧 Customization

Edit file ini untuk customize:

- **Welcome message** → `resources/views/dashboard.blade.php` (baris ~300)
- **Colors & styling** → `resources/views/dashboard.blade.php` (dalam tag `<style>`)
- **Task limit** → `app/Http/Controllers/DashboardController.php` (ubah `.limit(5)`)
- **Sample data** → `database/seeders/TaskSeeder.php`

---

## ✅ Checklist

- [ ] Jalankan: `php artisan migrate`
- [ ] Jalankan: `php artisan db:seed` (optional)
- [ ] Akses: `http://localhost:8000/`
- [ ] Verifikasi dashboard muncul
- [ ] Check statistik tasks
- [ ] Coba search functionality
- [ ] Check sidebar navigation

---

## 📚 Dokumentasi Lengkap

Untuk dokumentasi lengkap, lihat file: `DASHBOARD_IMPLEMENTATION.md`

Dalamnya ada:
- File structure lengkap
- Controllers detail
- Models relationships
- Customization options
- Next steps untuk fitur tambahan

---

Selamat! Dashboard Anda sudah siap! 🎉
