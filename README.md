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

---

# Task 22 – Service Categories, Images & Details

## Task Overview

Task 22 extends the dynamic Services plugin developed in Task 21 by adding Service Categories, image attachments, category-based filtering, and individual Service Details pages.

The existing `Training.Services` plugin was extended rather than creating a separate plugin. This keeps the Services functionality organized in one reusable October CMS plugin.

## Service Category Model

A new `Category` model was added to organize Services into categories.

The Category entity contains the following fields:

- `id`
- `name`
- `slug`
- `is_active`
- `display_order`
- `created_at`
- `updated_at`

Categories are stored in:

```text
training_services_categories
```

The October CMS backend allows administrators to:

- View Categories.
- Create a Category.
- Edit a Category.
- Delete a Category.
- Set a Category as active or inactive.
- Configure its display order.

The Category model also includes validation. The category name and slug are required, and the slug must be unique.

Duplicate category slugs are rejected with validation feedback in the October CMS backend.

## Service-to-Category Relationship

Each Service can belong to a Category.

The existing Services table was extended with:

```text
category_id
```

The Service model uses an October CMS `belongsTo` relationship to connect a Service to its Category.

Conceptually, the relationship is:

```text
Category
   |
   | has many
   ↓
Services

Service
   |
   | belongs to
   ↓
Category
```

This relationship allows the backend Service form to provide a Category selector and allows the public components to access Category information directly from each Service.

The relationship is also used when retrieving public Services so that Services belonging to inactive Categories are not displayed.

## Service Image Attachment

Task 22 adds image support to Services using the October CMS file attachment system.

The Service model uses an `attachOne` relationship for its image.

This allows each Service to have one uploaded image that can be managed directly from the October CMS backend.

Administrators can:

- Upload a Service image.
- Replace an existing image.
- Remove an image.
- Save the attachment as part of the Service record.

The frontend retrieves the attached image through the Service model relationship rather than storing a hardcoded image path in the page markup.

Service images are displayed inside controlled responsive containers so uploaded images remain consistent in size without being distorted.

## Backend Management Changes

The existing Services backend management interface was extended for Task 22.

The main backend navigation now provides access to:

```text
Services
Categories
```

The Service Create/Edit form includes:

- Title
- Short Description
- Detailed Description
- Category
- Service Image
- Active status
- Display Order

The Services backend list includes useful information such as:

- Title
- Category
- Status
- Display Order
- Updated At

The Categories backend section provides its own list and Create/Edit forms for managing category records.

These features use October CMS backend controllers, models, forms, lists, relationships, and file attachments rather than a separate administration interface.

## Category Filtering

The reusable `ServicesList` component was extended to support Category filtering.

Only active Categories are displayed as public filter options.

The Services section provides filters such as:

```text
All Services
Web Development
Mobile Development
Design
```

Selecting a Category filters the Services using the Category slug.

For example:

```text
?category=mobile-development
```

The component then retrieves Services belonging to the selected active Category.

Only Services that are active and belong to an active Category are displayed publicly.

If no Services are available for the selected Category, the page displays a clear empty-state message rather than an empty or broken section.

## Service Details Component

A reusable CMS component named:

```text
ServiceDetails
```

was added to the plugin.

The component retrieves a single Service using the dynamic Service ID from the page URL.

The component loads the Service together with its related Category and attached image.

Only active Services belonging to active Categories can be displayed through the public Service Details page.

If the requested Service does not exist, is inactive, or belongs to an inactive Category, the page displays a clear:

```text
Service Not Found
```

state instead of exposing unpublished content.

## Service Details Page and URL

A new CMS page was created for individual Service details.

The dynamic URL pattern is:

```text
/services/:id
```

For example:

```text
/services/3
```

Each Service card on the public Services section contains a `View Details` link that routes the visitor to the corresponding Service Details page.

The details page displays:

- Service image
- Category
- Service title
- Short description
- Detailed description
- Back to Services navigation

The page uses the existing shared theme layout and responsive styling.

## Database Updates

Task 22 introduces database changes through the October CMS migration/update mechanism.

The updates include:

- Creating the Categories table.
- Adding `category_id` to the existing Services table.
- Registering the new plugin update versions.

After pulling or cloning the updated project, the database changes can be applied using:

```bash
php artisan october:migrate
```

No manual database table creation is required.

## October CMS Relationships and File Attachments

October CMS model relationships are used to connect Services and Categories.

A Service uses a `belongsTo` relationship to access its Category. This allows the application to retrieve related Category information through the Service model and makes it possible to provide a relation field in the backend Service form.

The relationship is also used by the public Services component to filter Services by Category and prevent Services from inactive Categories from appearing publicly.

October CMS file attachments are used to manage Service images.

The Service model uses an `attachOne` relationship, allowing one image to be associated with each Service. October CMS manages the uploaded file and its relationship to the model, while the frontend accesses the image through the Service model.

This keeps database relationships, file management, backend administration, and frontend rendering integrated through October CMS conventions.

## Public Services Flow

The updated public content flow is:

```text
October CMS Backend
        ↓
Categories + Services + Images
        ↓
October CMS Models
        ↓
Model Relationships
        ↓
ServicesList / ServiceDetails Components
        ↓
Reusable Component Markup
        ↓
Public Website
```

Changes made to Categories, Services, statuses, relationships, images, or Service content in the October CMS backend are reflected dynamically on the public website.

## Task 22 Setup

After cloning the repository, install the required project dependencies:

```bash
composer install
```

Configure the local environment and database connection.

Do not commit real database credentials or other sensitive environment values.

Apply the October CMS database and plugin updates:

```bash
php artisan october:migrate
```

Start the local development server:

```bash
php artisan serve
```

The public website can then be opened using the local development URL.

The October CMS backend is available at:

```text
/admin
```

A local administrator account must be configured separately. Administrator usernames and passwords are not stored in the README.

## Task 22 Verification

Task 22 was verified by:

1. Creating multiple Categories through the October CMS backend.
2. Assigning Services to different Categories.
3. Uploading images to Services.
4. Confirming the Service backend list displays Category information.
5. Confirming Service Create/Edit forms allow Category selection and image management.
6. Confirming only active Categories appear as public filter options.
7. Filtering the public Services section by Category.
8. Confirming active Services display their Category and image publicly.
9. Opening individual Services through the dynamic `/services/:id` details page.
10. Confirming inactive Services cannot be accessed publicly.
11. Confirming missing Service IDs display a clear `Service Not Found` state.
12. Confirming duplicate Category slugs are rejected by backend validation.
13. Confirming the Services and Service Details sections remain responsive across different screen sizes.
