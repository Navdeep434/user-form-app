# Laravel AJAX CRUD with CSV Export

This is a Laravel project that provides a **CRUD (Create, Read, Update, Delete) system** with **AJAX-based dynamic updates** and **CSV export functionality**.

## Features
- **Form submission**
- **Table updates**
- **Profile image upload**
- **Phone number validation**
- **CSV Export** (Export single or all records)
- **Bootstrap UI** for styling

## Prerequisites
Make sure you have the following installed:
- PHP (>= 8.0)
- Composer
- MySQL (or any database supported by Laravel)
- Node.js & NPM (for frontend assets, if needed)
- Laravel 11 (recommended)

## Installation

### 1. Clone the repository
```sh
git clone https://github.com/Navdeep434/user-form-app.git
cd YOUR_REPO
```

### 2. Install dependencies
```sh
composer install
```

### 3. Set up environment variables
```sh
cp .env.example .env
```
Modify the `.env` file and update the database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user_form_app
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Generate application key
```sh
php artisan key:generate
```

### 5. Run database migrations & seed data (if needed)
```sh
php artisan migrate --seed
```

### 6. Serve the application
```sh
php artisan serve
```
Your application will now be available at:
```
http://127.0.0.1:8000
```

## Usage
### Adding a User
1. Fill out the **User Form**.
2. Click **Save** to store the record.
3. Click **Save & Export Current** to save and download the record as CSV.
4. Click **Export All** to download all stored records.

### Deleting a User
- Click the **Delete** button next to a record in the table.

## API Routes
| Method | URL | Description |
|--------|-----|-------------|
| `POST` | `/store` | Save a new user |
| `GET` | `/export/{id}` | Export a single user as CSV |
| `GET` | `/export-all` | Export all users as CSV |
| `POST` | `/delete/{id}` | Delete a user |

## Additional Commands
### Running Tests
```sh
php artisan test
```

### Clearing Cache
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```


## Contributing
Feel free to fork this repository and submit pull requests!
