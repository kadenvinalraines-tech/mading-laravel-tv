# Context7 Technical Blueprint
- Framework: Laravel 11.x (PHP 8.2+)
- Front-End: Native Blade + Tailwind CSS CDN (zero npm build requirement for kiosk reliability)
- Database: MySQL InnoDB utf8mb4 with UUID string primary keys
- Security: Role-based middleware, CSRF protection, password hashing (bcrypt)
