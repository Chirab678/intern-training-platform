# StageForce Platform

A modern Laravel + Vite + TailwindCSS web platform for intern training and education.

## Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### Installation
1. **Unzip the project folder** to your desired location.
2. **Open a terminal in the project directory.**
3. **Install PHP dependencies:**
   ```
   composer install
   ```
4. **Install Node.js dependencies:**
   ```
   npm install
   ```
   > **Note:** If you see errors about missing PostCSS/Tailwind plugins, install them:
   > ```
   > npm install tailwindcss @tailwindcss/forms autoprefixer postcss --save-dev
   > ```
5. **Copy and configure your environment file:**
   - If `.env` does not exist, copy `.env.example` to `.env`:
     ```
     cp .env.example .env
     ```
   - Edit `.env` with your database credentials and other settings.
6. **Generate application key:**
   ```
   php artisan key:generate
   ```
7. **Run database migrations:**
   ```
   php artisan migrate
   ```
8. **(Optional) Seed the database:**
   ```
   php artisan db:seed
   ```

## Running the Project

Open two terminal windows/tabs:

1. **Start the Laravel backend server:**
   ```
   php artisan serve
   ```
   Or, if port 8000 is busy:
   ```
   php artisan serve --port=8080
   ```
2. **Start the Vite frontend dev server:**
   ```
   npm run dev
   ```

Visit `http://localhost:8000` (or your chosen port) in your browser.

## Troubleshooting
- If you see errors about missing dependencies (e.g. `autoprefixer`, `@tailwindcss/forms`), install them with npm as shown above.
- If `php artisan serve` keeps failing, try this command :                     `php -S 127.0.0.1:8888 -t public`, then visit : `http://localhost:8888`.
- If migrations fail, check for duplicate migration files or existing tables in your database.

## License
MIT
