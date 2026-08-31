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

---

# Task 21 – Dynamic Services Plugin

## Services Plugin

Task 21 extends the October CMS project from Task 20 by introducing database-backed dynamic content through a custom plugin.

The custom plugin is named:

```text
Training.Services
```

Its purpose is to allow administrators to manage Services through the October CMS backend and display the managed Services dynamically on the public website through a reusable CMS component.

## Plugin Structure

The main files and folders used in the plugin are:

```text
plugins/training/services/
├── components/
│   ├── serviceslist/
│   │   └── default.htm
│   └── ServicesList.php
├── controllers/
│   ├── services/
│   │   ├── config_form.yaml
│   │   ├── config_list.yaml
│   │   └── ...
│   └── Services.php
├── models/
│   ├── service/
│   │   ├── columns.yaml
│   │   └── fields.yaml
│   └── Service.php
├── updates/
│   ├── create_services_table.php
│   └── version.yaml
└── Plugin.php
```

`Plugin.php` registers the plugin, backend navigation, and reusable CMS component.

The `models` directory contains the Service model and its backend field/list configuration.

The `updates` directory contains the database migration and plugin version information.

The `controllers` directory contains the October CMS backend controller used to manage Services.

The `components` directory contains the reusable CMS component responsible for retrieving and displaying Services on the public website.

## Database Migration

The Services table is created using the October CMS/Laravel migration mechanism.

The migration creates the following table:

```text
training_services_services
```

The Service entity contains:

- `id`
- `title`
- `short_description`
- `content`
- `is_active`
- `display_order`
- `created_at`
- `updated_at`

The migration can be applied using:

```bash
php artisan october:migrate
```

## Service Model and Validation

The `Service` model represents the Services stored in the database.

Validation rules are used to ensure that required and structured values are provided. The title is required, the display order must be a non-negative integer, and the active status is handled as a boolean value.

Validation feedback is displayed through the October CMS backend form when invalid data is submitted.

## Backend Service Management

Services are managed using the October CMS backend rather than a separate custom Vue administration interface.

The Services section allows an administrator to:

- View the Services list.
- Create a Service.
- Edit an existing Service.
- Delete a Service.
- Set a Service as active or inactive.
- Configure its display order.

The backend list displays useful information including:

- Title
- Status
- Display order
- Updated date

The Create/Edit form contains clearly labeled fields for the Service content, status, and display order.

## ServicesList CMS Component

The plugin provides a reusable CMS component named:

```text
ServicesList
```

The component retrieves Service records from the database and makes them available to the theme for rendering.

Only active Services are retrieved, and they are ordered using the `display_order` field.

The database/query logic is kept inside the component class, while the presentation markup is stored separately in:

```text
components/serviceslist/default.htm
```

This keeps the data logic separate from the presentation layer.

## Component Property

The `ServicesList` component provides a configurable property:

```text
limit
```

The property controls the maximum number of Services displayed on the public page.

For example:

```ini
[servicesList]
limit = 6
```

Changing the property to:

```ini
[servicesList]
limit = 1
```

limits the public Services section to one Service.

This behavior was verified during Task 21.

## Dynamic Public Services

The component is attached to the Home page using:

```twig
{% component 'servicesList' %}
```

Service records are not hardcoded into the page markup.

Instead, the flow is:

```text
October CMS Backend
        ↓
Database
        ↓
Service Model
        ↓
ServicesList Component
        ↓
Reusable Component Markup
        ↓
Public Website
```

When an administrator creates or edits an active Service in the backend, the updated database content is reflected on the public website.

## Status and Display Ordering

Only Services where `is_active` is enabled are displayed publicly.

Inactive Services remain available for management in the October CMS backend but are excluded from the public Services section.

Active Services are displayed in ascending order according to their `display_order` value.

For example, a Service with display order `1` appears before a Service with display order `2`.

## Empty State

If there are no active Services available, the component displays a clear empty-state message:

```text
No services are currently available.
```

This prevents the Services section from appearing broken or confusing when no active records exist.

## Responsive Services Section

The Services section uses the existing custom theme from Task 20 and adds responsive Service cards without redesigning the entire website.

The layout adapts across:

- Desktop
- Tablet
- Mobile

The Service cards use a responsive grid that changes from multiple columns on larger screens to a single-column layout on smaller mobile screens.

## Setup for Another Developer

After cloning the repository and completing the base October CMS setup described earlier in this README, install the project dependencies:

```bash
composer install
```

Configure the local environment and database connection without committing sensitive credentials.

Run the October CMS migrations:

```bash
php artisan october:migrate
```

Start the local development server:

```bash
php artisan serve
```

The public website can then be accessed using the local development URL, and the October CMS backend can be accessed through:

```text
/admin
```

A local administrator account must be created or configured separately. Real administrator credentials are not included in the repository.

## Task 21 Verification

The complete dynamic CMS flow was verified by:

1. Creating at least three Services through the October CMS backend.
2. Assigning different display orders.
3. Keeping one Service inactive during testing.
4. Confirming that only active Services appeared publicly.
5. Confirming that active Services appeared in the configured display order.
6. Editing a Service in the backend and verifying that the change appeared on the public website.
7. Changing the component `limit` property and verifying that the number of displayed Services changed accordingly.
8. Verifying backend validation for required Service fields.
