# October CMS Training Project

## Project Overview

This project was created as part of the Blue Information Technology University Field Training Program.

The purpose of the project is to practice the fundamentals of October CMS, including project setup, backend administration, custom themes, reusable layouts and partials, website pages, navigation, CMS-managed content, and responsive styling.

## Requirements

To run the project locally, the following are required:

- PHP
- Composer
- MySQL / MariaDB
- October CMS
- A local development environment such as XAMPP
- Git

## Installation and Local Setup

1. Clone the repository:

```bash
git clone https://github.com/Shahd-Barmawi/task-20-october-cms.git
```

2. Enter the project directory:

```bash
cd task-20-october-cms
```

3. Install the project dependencies:

```bash
composer install
```

4. Configure the local environment and database connection.

5. Run the October CMS migrations:

```bash
php artisan october:migrate
```

6. Start the local development server:

```bash
php artisan serve
```

7. Open the public website in the browser using the local URL provided by the development server.

## Database Setup

The project uses MySQL / MariaDB as its database.

A local database must be created before running the project. Database connection settings should be configured in the local environment file.

Real database passwords, credentials, license keys, and other environment secrets must not be committed to the repository.

## Backend Administration

The October CMS backend administration area can be accessed locally through:

```text
/admin
```

For example, when using the Laravel development server:

```text
http://127.0.0.1:8000/admin
```

A local administrator account is required to access the backend. Real usernames and passwords are not included in this repository.

## Custom Theme

The custom theme created for this project is:

```text
training-theme
```

The main theme structure includes:

```text
themes/training-theme/
├── assets/
│   └── css/
│       └── style.css
├── content/
│   ├── home-intro.htm
│   └── about-intro.htm
├── layouts/
│   └── default.htm
├── pages/
│   ├── home.htm
│   ├── about.htm
│   └── contact.htm
└── partials/
    ├── header.htm
    ├── footer.htm
    └── hero.htm
```

## Website Pages

The website contains three main pages:

- Home (`/`)
- About (`/about`)
- Contact (`/contact`)

All pages use the shared main layout.

## Reusable Layout and Partials

The `default.htm` layout provides the shared HTML structure for the website and contains the main page content area.

Reusable partials are used to avoid duplicating common sections:

- `header.htm` contains the website header and navigation.
- `footer.htm` contains the shared footer.
- `hero.htm` contains the reusable hero section.

## CMS-Managed Content

The project separates editable content from the page templates using October CMS content files.

Two pieces of managed content are currently used:

- `home-intro.htm`
- `about-intro.htm`

These content files are rendered inside the Home and About pages instead of hardcoding all page text directly into the page templates.

## Navigation

The shared header provides navigation between the Home, About, and Contact pages.

October CMS page URLs are used for navigation, and the current page receives an active navigation state. Internal page URLs also continue to work correctly after a browser refresh.

## Responsive Styling

Basic responsive styling is included in the custom theme.

The layout adapts to desktop, tablet, and mobile screen sizes. The navigation, hero section, page content, and footer are adjusted on smaller screens to prevent major overflow or broken sections.

## CMS Concept Comparison

In Tasks 18 and 19, dynamic pages were built using Laravel and Vue. The frontend used reusable Vue components to render different content blocks, while the backend was responsible for storing and providing the page and block data through APIs.

October CMS provides similar concepts but organizes them directly around CMS features. Pages define the individual routes and content of the website, while Layouts provide a shared structure that can be reused across multiple pages. This is similar to using a common application layout in the previous Vue implementation.

Partials are reusable sections such as the header, footer, and hero section. They are similar to reusable Vue components because they prevent repeated markup and allow the same section to be included in multiple places.

Editable content in October CMS separates managed content from the page structure. Instead of hardcoding all text inside a page template, content can be managed separately and rendered by the page. This is similar to the dynamic content blocks used in Tasks 18 and 19, where the page structure remained reusable while the actual content came from managed data.

Overall, both approaches separate presentation from content and encourage reusable website structures. The main difference is that October CMS provides these concepts as part of the CMS itself, while the previous Laravel and Vue implementation required us to build more of the content-management and dynamic-rendering logic ourselves.

## Challenges and Notes

During the initial setup, the local database configuration required checking the MariaDB port used by XAMPP and creating the October CMS database before completing the installation.

The project was then configured with a separate custom theme instead of performing the implementation inside the default demonstration theme.

The project also provided practical experience with the relationship between October CMS pages, layouts, partials, content files, and the backend administration area.
