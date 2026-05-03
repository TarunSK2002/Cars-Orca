# MilesWeb Deployment Notes

This app is failing on production because Laravel is trying to connect to MySQL at `127.0.0.1:3306` with local development credentials. On MilesWeb/cPanel hosting, use the database name, database user, and password created in cPanel.

## 1. Create the database in cPanel

1. Open cPanel > MySQL Databases.
2. Create a database, for example `carsorca`.
3. Create a database user, for example `carsorcauser`, with a strong password.
4. Add the user to the database with `ALL PRIVILEGES`.
5. Note the real names shown by cPanel. They usually include your cPanel prefix, like:
   - `cpaneluser_carsorca`
   - `cpaneluser_carsorcauser`

## 2. Import the database

Use cPanel > phpMyAdmin and import:

```text
carsorca.sql
```

The SQL file already contains the required app tables, including `cars`, `sessions`, `cache`, and `jobs`.

## 3. Set the server `.env`

On the server, create or edit the Laravel `.env` file using `.env.milesweb.example` as the template.

Important values:

```env
APP_NAME="Cars Orca"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://carsorca.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpaneluser_carsorca
DB_USERNAME=cpaneluser_carsorcauser
DB_PASSWORD="your_database_user_password"

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Do not use the local development values `DB_USERNAME=root`, `DB_PASSWORD=12345678`, or `DB_HOST=127.0.0.1` on MilesWeb unless MilesWeb specifically gives you those values.

## 4. Generate the Laravel app key

If `APP_KEY` is empty on the server, run:

```bash
php artisan key:generate --force
```

## 5. Clear Laravel cached config

After every `.env` change, run:

```bash
php artisan optimize:clear
php artisan config:clear
```

If MilesWeb does not allow SSH, use cPanel Terminal if available. Otherwise, remove cached files from `bootstrap/cache/` except `.gitignore`.

## 6. Point the domain to `public`

The web document root must be Laravel's `public` directory.

Preferred:

```text
carsorca.com -> /path/to/cars-orca/public
```

If cPanel only points the domain to `public_html`, place Laravel outside `public_html` and copy only the contents of Laravel's `public` folder into `public_html`, then adjust `public_html/index.php` to point to the real `vendor/autoload.php` and `bootstrap/app.php`.

## 7. Storage permissions

Make sure these folders are writable by PHP:

```text
storage
bootstrap/cache
```

For uploaded car images, also run if SSH is available:

```bash
php artisan storage:link
```

If symlinks are blocked on shared hosting, copy uploaded public files from `storage/app/public` into `public/storage`.
