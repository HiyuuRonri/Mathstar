# Mathstar Project Setup Guide (Windows)

Welcome to the Mathstar Project! This guide will help you set up and run the Mathstar Project on your Windows machine.

---

## Requirements
Before you begin, ensure the following are installed on your machine:

1. **PHP** (minimum version 8.0 or as required by the project)
2. **Composer** (latest version)
3. **Laravel** (CLI tool, optional but recommended)
4. **Git**
5. **XAMPP**(MySQL it must support PHP version 8.2)
6. **Node.js and npm** (for frontend dependencies)

---

## Steps to Import the Laravel Project

### 1. Clone the Repository

Open your terminal or command prompt and run the following command to clone the repository:

```bash
git clone <https://github.com/HiyuuRonri/Mathstar>
```


### 2. Navigate to the Project Directory

Move into the cloned repository's directory:

```bash
cd Mathstar
```


### 3. Install PHP Dependencies

Run the following command to install the required PHP dependencies using Composer:

```bash
composer install
```

### 4. Set Up the Environment File

1. Duplicate the `.env.example` file and rename it to `.env`:
   
   ```bash
   cp .env.example .env
   ```

2. Open the `.env` file and update the database credentials and other configuration settings as required.

### 5. Generate the Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

### 6. Run Migrations 

Start apache and MySql in XAMPP and run the following commands to create the database structure:

```bash
php artisan migrate
```

### 7. Install Frontend Dependencies (if applicable)

The project uses frontend dependencies ( Vue.js), install them using npm:

```bash
npm install
```

Then compile the frontend assets:

```bash
npm run dev
```

For production, use:

```bash
npm run build
```

### 8. Serve the Application

Run the Laravel development server:

```bash
php artisan serve 
```
or 
```bash
npm run dev
```

Access the application in your browser at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Additional Notes

1. **File Permissions**: Ensure the `storage` and `bootstrap/cache` directories are writable:

   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

2. **Scheduler and Queues**: If the project uses cron jobs or queues, set them up as per the project documentation.

3. **Environment Variables**: Verify that all necessary environment variables are properly configured in the `.env` file.

4. **Production Setup**: For production environments, configure a web server like Apache or Nginx, and ensure proper security measures are in place.

5. **Laravel Version**: Confirm the Laravel version by running:

   ```bash
   php artisan --version
   ```

   Make sure your PHP version is compatible with the Laravel version used.

---

You have now successfully imported and set up the Laravel project. For further assistance, refer to the project's documentation or reach out to the repository maintainers.




--