# Parel Kirby — Portfolio (Laravel)

A personal portfolio for Parel Kirby, built with Laravel 12 and Blade. The site
uses a lightweight galaxy theme, a circular hero portrait, glass-style cards,
in-page project/resume/certificate viewers, and a contact form that stores
messages and forwards them to an external mail service.

A pure static copy of the same design lives in `../Parel-Portfolio-static`.

## Stack

- Laravel 12 / PHP 8.2+
- SQLite database
- Blade templates
- Prebuilt Tailwind CSS (`public/css/style.css`) — no Node build step required
- Vanilla JavaScript (`public/js/app.js`, `resume-viewer.js`, `certificate-viewer.js`)

## Features

- Responsive galaxy-themed layout with light and dark modes
- Circular hero portrait with carousel support
- Skills, experience, education, and project sections
- Project cards that open an in-page details modal
- Certificate thumbnails with a fixed 4:3 frame; full view opens in a modal on
  the same tab and closes with the ✕ button, footer button, backdrop, or Escape
- Resume **View** modal and **Download** button in the Contact section
- Contact form with validation, database storage, and mail-service forwarding
- JSON endpoint at `/api/portfolio` for the embedded portfolio data

## Requirements

- PHP 8.2 or newer with the usual Laravel extensions
- Composer
- SQLite support in PHP
- Optional: XAMPP/Apache if you prefer serving through `htdocs`

## Setup

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
```

Create the SQLite database file if it does not exist, then migrate and seed:

```powershell
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate:fresh --seed
```

Start the development server:

```powershell
php artisan serve
```

Open `http://127.0.0.1:8000`.

With XAMPP, place the project under `htdocs` and point a virtual host (or use
`php artisan serve`) at the `public` directory. Do not expose the project root.

## Routes

| Method | URI              | Purpose                                  |
| ------ | ---------------- | ---------------------------------------- |
| GET    | `/`              | Portfolio home page                      |
| POST   | `/contact`       | Validate, store, and forward a message   |
| GET    | `/api/portfolio` | Portfolio data as JSON                   |

## Content

Portfolio content comes from the SQLite database. Seed data lives in:

- `database/seeders/PortfolioSeeder.php` — profile, skills, projects, experience,
  education, social links
- `database/seeders/CertificateSeeder.php` — certificates and certificate images

To change the seeded content, edit those files and reseed:

```powershell
php artisan migrate:fresh --seed
```

`migrate:fresh` drops all tables, including stored contact messages. To update a
single record without resetting the database, edit it through `php artisan
tinker` or a short Eloquent script.

Project images live in `public/images/screenshots/`. The current project is the
**Students Document Request System for DCCP-Bangued**, using
`public/images/screenshots/DCCP.png`.

## Contact form

`ContactController` validates the form, saves the message in the `messages`
table, then forwards it to the mail service configured in `.env`:

```env
MAIL_SERVICE_URL=https://mail-service-nine.vercel.app
CONTACT_EMAIL=parelkirby@gmail.com
```

If forwarding fails, the message is still stored and the visitor sees a notice.
No SMTP credentials are required for the default setup.

## Resume and certificates

- Resume PDF: `public/resume/ParelKirbs_Resume.pdf`
- Resume path: `config/portfolio.php` → `meta.pdf`
- Certificate images: `public/images/certificates/`
- Certificate entries: `database/seeders/CertificateSeeder.php`

## Project structure

```
app/Http/Controllers/        Page, API, and contact controllers
app/Models/                  Eloquent models
app/Services/PortfolioData.php  Builds the portfolio payload
config/portfolio.php         Resume path, contact/API URLs, tag colors, icons
database/migrations/         Schema
database/seeders/            Portfolio and certificate seed data
public/css/                  Compiled Tailwind styles and markdown styles
public/js/                   Site behavior and modal viewers
public/images/               Profile, project screenshots, certificates
public/resume/               Resume PDF
resources/views/             Blade layouts, sections, and modals
routes/web.php               Web routes
```

## Static copy

`../Parel-Portfolio-static` is a pure HTML/CSS/JS export of this project. It has
no Laravel, PHP, Composer, database, or Node dependency. When the design or
content changes here, rebuild the static page as well so both versions match.

## Notes

- CSS is prebuilt and committed; `npm` is not needed to run the site.
- The certificate and resume viewers are small vanilla-JS files with no
  external modal library.
- The galaxy background is CSS-only and adds no canvas, particle scripts, or
  extra image requests.

## Prompt History

### Certificate viewer

> fix it dont open another tab is just view it and it can close it and the ratio should be fix

> dont open another tab when i full view the certificate it stays at the same tab. theres a x button to exit the full view.

### Project replacement

> Replace the previous project with "STUDENTS DOCUMENT REQUEST SYSTEM FOR DCCP-BANGUED" and its description, using the screenshot at "Parel-Portfolio-main\public\images\screenshots\DCCP.png", and apply it to both the static and Laravel versions.
