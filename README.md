# Fly Buddy

**Fly Buddy** is a Laravel-based travel listing and admin app for managing destinations and travel packages.

**Project Overview**
- **Purpose:** Manage and browse travel destinations and travel packages with admin CRUD and public listing/search endpoints.
- **Stack:** Laravel (PHP), MySQL / MariaDB, Vite, Blade templates and common CSS utilities (Bootstrap/Tailwind present in project files).

**Setup Instructions**
- **Prerequisites:** PHP 8.1+, Composer, Node.js (16+), npm, MySQL (or XAMPP on Windows), Git.

- **Clone repository:**
```bash
git clone <repo-url> flybuddy
cd flybuddy
```

- **Copy environment file and set secrets:**
```powershell
copy .env.example .env
# then open .env and set DB_*, APP_URL, etc.
```

- **Install dependencies:**
```bash
composer install
npm install
```

- **Generate application key:**
```bash
php artisan key:generate
```

- **Database setup:**
1. Create a database (e.g., `flybuddy`).
2. Update `.env` with database credentials.

- **Run migrations & seeders:**
```bash
php artisan migrate --seed
```

- **Link storage for public uploads:**
```bash
php artisan storage:link
```

- **Build assets / run dev server:**
```bash
npm run dev
php artisan serve
# or configure XAMPP/Apache to serve the `public` folder
```

**Usage Guide**
- **Public pages:**
	- Home: `/`
	- Destinations list: `/destinations`
	- Packages list: `/packages`
	- Details: `/destinations/{id}`, `/packages/{id}`

- **Authentication / Admin:**
	- Register at `/register` or login at `/login` to access admin features.
	- The admin dashboard is at `/dashboard` (note: in development some admin routes are temporarily public; add auth middleware before production).
	- Authenticated users will see "Add", "Edit", and "Delete" controls on listing pages.

- **API endpoints:**
	- `/api/featured-destinations`
	- `/api/featured-packages`
	- `/api/packages/search?query=...`

- **Helpful commands:**
```bash
php artisan route:list
php artisan view:clear
php artisan cache:clear
php artisan migrate --seed
php artisan test
```

**Troubleshooting**
- If `/destinations/create` or `/packages/create` returns 404, check that dynamic `{id}` routes are constrained (the project uses `->whereNumber('id')`), and run `php artisan route:list` to confirm route ordering.
- If uploaded images don't appear, ensure `php artisan storage:link` has been run and that `public/storage` is accessible to the webserver.
- On Windows/XAMPP, ensure `storage` and `bootstrap/cache` are writable by PHP/Apache.

**Testing**
- Run tests:
```bash
php artisan test
```

**Contributing**
- Fork, create a feature branch, add tests, and open a pull request. Keep commits focused and descriptive.

**Notes & Next Steps**
- Blade views are in `resources/views`, controllers in `app/Http/Controllers`, and migrations/seeders in `database/`.
- Before production: protect admin routes with middleware, secure `.env` values, and review file permissions.


