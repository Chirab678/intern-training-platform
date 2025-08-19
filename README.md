
# StageForce Platform

A modern Laravel + Vite + TailwindCSS web platform for intern training and education.

## 🚀 Quick Start (for GitHub Users)

### 1. Clone the repository
```
git clone https://github.com/Chirab678/intern-training-platform.git
cd intern-training-platform
```

### 2. Install dependencies
```
composer install
npm install
```

### 3. Configure environment
- Copy `.env.example` to `.env`:
   ```
   cp .env.example .env
   ```
- Edit `.env` and set your database and mail credentials.

### 4. Generate application key
```
php artisan key:generate
```

### 5. Run migrations (and optionally seed demo data)
```
php artisan migrate
php artisan db:seed # optional
```

### 6. Start the servers
- In one terminal:
   ```
   php artisan serve
   ```
- In another terminal:
   ```
   npm run dev
   ```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## 📝 Project Features
- Modern Laravel 12 backend
- Vite + TailwindCSS for fast, beautiful UI
- Role-based access (admin, manager, intern, entrepreneur)
- Module, quiz, and assignment management
- User authentication and profile management

## ⚠️ Notes
- **Never commit your real `.env` file.** Only share `.env.example`.
- The `vendor/` and `node_modules/` folders are not included in the repo. Run `composer install` and `npm install` after cloning.

## 🛠 Troubleshooting
- If you see errors about missing dependencies (e.g. `autoprefixer`, `@tailwindcss/forms`), install them with npm as shown above.
- If `php artisan serve` fails, try: `php -S 127.0.0.1:8888 -t public` and visit [http://localhost:8888](http://localhost:8888).
- If migrations fail, check for duplicate migration files or existing tables in your database.