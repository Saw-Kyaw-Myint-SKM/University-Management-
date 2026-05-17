# University Management System

A web-based University Management System built with **Laravel 9**, **TailwindCSS**, and **Alpine.js**. It supports role-based access for Admins, Teachers, and Students, covering core university operations including student and teacher management, course administration, enrollments, examinations, attendance, and notifications.

---

## Tech Stack

| Layer      | Technology                        |
|------------|-----------------------------------|
| Backend    | Laravel 9, PHP 8.0+               |
| Frontend   | Blade Templates, TailwindCSS (CDN), Alpine.js (CDN) |
| Auth       | Laravel Breeze                    |
| Database   | MySQL (production) / SQLite (dev) |
| API Auth   | Laravel Sanctum                   |

---

## Requirements

Before you begin, make sure you have the following installed:

- **PHP** >= 8.0.2 with extensions: `pdo`, `pdo_mysql` (or `pdo_sqlite`), `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`
- **Composer** >= 2.x
- **MySQL** >= 5.7 or **SQLite** (for local dev)
- **Node.js** >= 16.x and **npm** (optional — only needed if you want to compile assets locally)

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/university-management.git
cd university-management
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Copy the environment file

```bash
cp .env.example .env
```

### 4. Generate the application key

```bash
php artisan key:generate
```

---

## Database Setup

### Option A — MySQL (recommended for production)

Edit your `.env` file and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=university_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database in MySQL first:

```sql
CREATE DATABASE university_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Option B — SQLite (quick local dev)

```env
DB_CONNECTION=sqlite
```

Then create the SQLite file:

```bash
touch database/database.sqlite
```

---

## Run Migrations & Seed

Run all migrations and seed the database with demo data:

```bash
php artisan migrate:fresh --seed
```

This will create all tables and populate them with:

| Table            | Records         |
|------------------|-----------------|
| Roles            | 3               |
| Users            | ~53             |
| Faculties        | 5               |
| Departments      | 8               |
| Courses          | 17              |
| Teachers         | 15              |
| Students         | 25              |
| Admissions       | 10              |
| Enrollments      | ~100            |
| Exams            | ~30             |
| Exam Questions   | ~150            |
| Exam Results     | ~100+           |
| Attendance       | ~1,000+         |
| Notifications    | ~150+           |

---

## Default Login Accounts

After seeding, you can log in with these accounts:

| Role    | Email                       | Password      |
|---------|-----------------------------|---------------|
| Admin   | admin@university.edu        | password123   |
| Teacher | teacher@university.edu      | password123   |
| Student | student@university.edu      | password123   |

> **Note:** All seeded users (not just the defaults above) also use `password123`.

---

## Start the Development Server

```bash
php artisan serve
```

Then open your browser at: [http://localhost:8000](http://localhost:8000)

---

## Project Structure

```
university-management/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Resource controllers (Student, Teacher, Course, ...)
│   │   └── Middleware/         # RoleMiddleware for RBAC
│   ├── Models/                 # Eloquent models (15 models)
│   └── Providers/
├── database/
│   ├── factories/              # Model factories for all 15 models
│   ├── migrations/             # 14 migration files
│   └── seeders/                # 14 seeders (ordered by dependency)
├── resources/
│   └── views/
│       ├── layouts/            # app.blade.php (sidebar + nav)
│       ├── students/           # index, create, edit, show
│       ├── teachers/           # index, create, edit, show
│       └── courses/            # index, create, edit, show
├── routes/
│   └── web.php                 # All 96 web routes
└── .env.example
```

---

## Roles & Permissions

Access is controlled by the `RoleMiddleware`. Routes are grouped by role:

| Role    | Access                                                                 |
|---------|------------------------------------------------------------------------|
| Admin   | Full access — faculties, departments, courses, teachers, students, admissions, enrollments, exams, results, attendance |
| Teacher | My courses, my students, exams, results, attendance                    |
| Student | My courses, exams, results, attendance, notifications                  |
| All     | Notifications (read/delete own), profile                               |

---

## Available Routes (summary)

| Resource      | Route prefix      | Middleware         |
|---------------|-------------------|--------------------|
| Dashboard     | `/dashboard`      | auth, verified     |
| Profile       | `/profile`        | auth               |
| Faculties     | `/faculties`      | auth, role:admin   |
| Departments   | `/departments`    | auth, role:admin   |
| Courses       | `/courses`        | auth, role:admin   |
| Teachers      | `/teachers`       | auth, role:admin   |
| Students      | `/students`       | auth, role:admin   |
| Admissions    | `/admissions`     | auth, role:admin   |
| Enrollments   | `/enrollments`    | auth, role:admin   |
| Exams         | `/exams`          | auth, role:admin   |
| Results       | `/results`        | auth, role:admin   |
| Attendance    | `/attendance`     | auth, role:admin   |
| Notifications | `/notifications`  | auth               |

Run `php artisan route:list` to see all 96 routes.

---

## Useful Artisan Commands

```bash
# Re-run all migrations and seeders from scratch
php artisan migrate:fresh --seed

# Run only seeders (without dropping tables)
php artisan db:seed

# Run a specific seeder
php artisan db:seed --class=StudentSeeder

# Clear all caches
php artisan optimize:clear

# List all routes
php artisan route:list

# Open interactive shell
php artisan tinker
```

---

## Environment Variables Reference

Key variables in `.env`:

```env
APP_NAME=UniversityManagement
APP_ENV=local                   # local | production
APP_DEBUG=true                  # Set to false in production
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=university_management
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp                # Configure for email verification
MAIL_HOST=mailhog
MAIL_PORT=1025
```

---

## Troubleshooting

**`php artisan` commands fail with class not found**
```bash
composer dump-autoload
```

**Blank page or 500 error**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

**Permission denied on storage or bootstrap/cache**
```bash
chmod -R 775 storage bootstrap/cache
```
*(Linux/macOS only)*

**Email verification not working**
Set up a real mail driver in `.env` (e.g. Mailtrap, Mailgun) or disable email verification by removing `MustVerifyEmail` from `app/Models/User.php`.

---

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
