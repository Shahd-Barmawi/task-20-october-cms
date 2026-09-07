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

---

# Task 23 – Permissions, Contact Settings & AJAX Contact Management

## Task Overview

Task 23 extends the existing `Training.Services` plugin by adding backend permissions, configurable contact information, a database-backed Contact Message entity, an AJAX-powered public Contact form, backend message management, validation, user feedback, and basic anti-spam protection.

The existing `Training.Services` plugin and `training-theme` were extended rather than creating a separate plugin or frontend application. This keeps the functionality integrated with October CMS models, components, settings, permissions, backend controllers, AJAX handling, and the existing public theme.

## Backend Permissions

Task 23 introduces separate backend permissions for the main management areas of the plugin:

- `training.services.manage_services` – allows access to Service management.
- `training.services.manage_categories` – allows access to Category management.
- `training.services.manage_contact_messages` – allows access to Contact Message management.

These permissions are registered in the `Training.Services` plugin and are used by both the backend navigation and the corresponding backend controllers.

Backend users only see management sections for which they have the required permission. Direct access to restricted management sections is also protected by controller permission requirements.

This allows different backend users or roles to receive only the administrative access they require.

## Contact Settings

A configurable Contact Settings section was added to the October CMS backend.

It allows administrators to manage public contact information without modifying the theme source code.

The configurable Contact Settings include:

- Contact email
- Phone number
- Address
- Help text

These values are managed through the October CMS backend settings area and are displayed dynamically on the public Contact page.

When an administrator changes and saves a Contact Setting, the updated information is reflected on the public website without requiring a source-code change.

## Contact Message Model

A database-backed `ContactMessage` model was added to store messages submitted through the public Contact form.

Contact Messages are stored in:

```text
training_services_contact_messages
```

Each Contact Message contains:

- `id`
- `name`
- `email`
- `subject`
- `message`
- `status`
- `created_at`
- `updated_at`

The message status supports:

```text
new
read
```

New public submissions are stored with the `new` status.

## Contact Message Validation

The `ContactMessage` model contains validation rules for the stored data.

The validation requirements include:

- Name is required.
- Email is required and must contain a valid email address.
- Subject is required.
- Message is required.
- Status is required and must be either `new` or `read`.
- Maximum-length rules are applied where appropriate.

Validation is also performed server-side by the Contact form AJAX handler before a Contact Message is saved.

This prevents invalid requests from being stored even if browser-side validation is bypassed.

## Public Contact Form

The existing `/contact` page was extended with a responsive Contact Us form.

The form contains the following fields:

- Name
- Email
- Subject
- Message

The Contact page also displays the contact information configured through the October CMS backend settings.

The form uses the existing `training-theme` design and remains usable on desktop and mobile-sized viewports.

A separate Vue application is not required for the Contact form.

## October CMS AJAX Handling

The public Contact form uses the October CMS AJAX framework instead of relying on a traditional full-page form submission.

The reusable CMS component:

```text
ContactForm
```

provides the server-side handler:

```text
onSubmit
```

The Contact submission flow is:

```text
Public Contact Form
        ↓
October CMS AJAX Request
        ↓
ContactForm::onSubmit
        ↓
Server-Side Validation
        ↓
ContactMessage Model
        ↓
Database
```

A valid Contact Message is saved to the database through the AJAX handler.

Invalid submissions return validation feedback and are not saved.

This keeps the form integrated with October CMS while providing a smoother user experience without requiring a separate JavaScript application.

## Validation and User Feedback

The Contact form provides clear validation and feedback for submitted data.

The implementation includes:

- Required-field validation.
- Valid email format validation.
- Server-side validation.
- Clearly associated field validation messages.
- Prevention of invalid database records.
- Success feedback after a valid submission.
- Prevention of duplicate submission while an AJAX request is being processed where practical.
- Preservation of useful entered values when validation fails.

After a successful submission, the visitor receives the following confirmation:

```text
Thank you! Your message has been sent successfully.
```

Invalid requests are not stored in the database.

## Backend Contact Message Management

Contact Messages can be managed through the October CMS backend.

The plugin backend navigation provides access to:

```text
Services
├── Services
├── Categories
└── Contact Messages
```

Administrators with the required Contact Messages permission can:

- View the Contact Messages list.
- Search Contact Messages.
- Open an individual message.
- View the sender name.
- View the sender email.
- View the subject.
- View the full message.
- View the submission date.
- View the current status.
- Change the status between `New` and `Read`.
- Delete messages when appropriate.

The Contact Messages list is organized with useful columns such as sender information, subject, status, and submission date.

The newest submissions are displayed first to make incoming Contact Messages easier to manage.

## Backend Navigation

The plugin backend navigation is organized into three management sections:

1. Services
2. Categories
3. Contact Messages

Clear labels and icons are used for each section.

The side-menu order is configured as:

```text
Services          → 100
Categories        → 200
Contact Messages  → 300
```

This keeps the backend navigation organized and predictable.

Navigation visibility is also permission-aware.

For example, a backend user with only the Category management permission can see the Categories section but cannot see the Services or Contact Messages management sections.

Users without the required permission are also prevented from directly accessing restricted backend management pages.

## Basic Anti-Spam Protection

A honeypot field was added to the public Contact form as a basic anti-spam measure suitable for the training project.

The honeypot field is hidden from normal visitors and is not intended to be completed by a human user.

Simple automated bots may detect and populate hidden form fields. The server-side AJAX handler therefore checks the honeypot value before storing a Contact Message.

The anti-spam flow is:

```text
Contact Form Submission
        ↓
Check Honeypot Field
        ↓
Is Honeypot Empty?
      /       \
    Yes        No
     ↓          ↓
Validate     Treat as Spam
     ↓          ↓
Save       Do Not Save
Message       Message
```

If the honeypot field contains a value, the submission is treated as spam and no Contact Message is stored.

The honeypot behavior was verified using a simulated bot submission. The number of Contact Message records remained unchanged after the spam submission, confirming that the message was not stored.

## Security Review

The Task 23 implementation was reviewed against the basic security requirements of the Contact management flow.

### Server-Side Validation

Contact form input is validated on the server before database storage.

This is important because browser-side validation alone cannot be trusted. Browser validation can be bypassed by manually creating or modifying a request.

Server-side validation ensures that the application itself determines whether submitted data is valid before saving it.

### Safe Output Rendering

Dynamic values displayed through Twig use normal escaped output.

Untrusted submitted values are not intentionally rendered as raw HTML on the public website.

This reduces the risk of submitted content being interpreted as executable markup when displayed through normal Twig output.

### Secrets and Credentials

Real database credentials, administrator passwords, API keys, and other sensitive environment information are not stored in the public source code or README.

Environment-specific credentials remain in the local environment configuration and are not intended to be committed to the repository.

### Public and Backend Access Separation

Submitting the public Contact form only creates a Contact Message record after the request passes the required checks.

A public Contact submission does not:

- Create a backend administrator.
- Authenticate the visitor into the backend.
- Create a backend session.
- Assign a backend role.
- Grant backend permissions.

Public Contact functionality and backend administration therefore remain separate.

### Restricted Backend Access

Backend management sections use registered October CMS permissions.

Users without the required permission cannot access the corresponding restricted management section.

Permission checks are applied both to navigation visibility and backend controller access.

This means hiding a menu item is not the only protection. Unauthorized users are also prevented from directly accessing restricted management URLs.

## Database Updates

Task 23 introduces a database migration for Contact Messages.

The Contact Messages table is created through the October CMS plugin update mechanism.

The Task 23 plugin update includes:

```text
v1.0.5
Create contact messages table
```

After pulling or cloning the updated project, the database and plugin updates can be applied using:

```bash
php artisan october:migrate
```

No manual creation of the Contact Messages table is required.

The same migration command can be used by another developer after configuring the local environment and database connection.

## Contact Management Flow

The complete Contact management flow is:

```text
October CMS Backend
        ↓
Contact Settings
        ↓
Public Contact Page
        ↓
Contact Form
        ↓
October CMS AJAX Handler
        ↓
Honeypot Anti-Spam Check
        ↓
Server-Side Validation
        ↓
ContactMessage Model
        ↓
Database
        ↓
Backend Contact Messages
        ↓
New / Read Management
```

This flow keeps configuration, public submission, validation, storage, and administrative management integrated through October CMS.

## Task 23 End-to-End Verification

Task 23 was verified through the complete Contact management flow:

1. Contact information was configured through the October CMS backend Contact Settings.

2. The configured Contact information was confirmed on the public `/contact` page.

3. The Contact form was submitted with invalid and missing data, and validation feedback was verified.

4. Invalid requests were confirmed not to create Contact Message records.

5. A valid Contact Message was submitted using the October CMS AJAX framework.

6. Success feedback was displayed after the valid submission.

7. The valid Contact Message was confirmed in the database.

8. The submitted Contact Message appeared in the October CMS backend Contact Messages list.

9. The message was opened and its details were verified.

10. The message status was changed from `New` to `Read` and the updated status was confirmed.

11. Backend navigation was verified to provide organized access to Services, Categories, and Contact Messages.

12. Backend navigation visibility was tested with different permissions.

13. A backend user without the Contact Messages permission was confirmed not to have access to the restricted Contact Messages management section.

14. The public Contact page was tested on a mobile-sized viewport and remained usable and responsive.

15. The honeypot anti-spam mechanism was tested using a simulated bot submission.

16. The Contact Message database record count remained unchanged after the simulated spam submission, confirming that the spam message was not stored.

17. Contact Settings were changed through the backend and the updated values were confirmed dynamically on the public Contact page.

## Why Permissions Matter in a CMS

Permissions are important in a CMS because different backend users can have different responsibilities.

For example, a user responsible for managing Categories does not necessarily need access to Contact Messages or Service management.

Using separate permissions follows the principle of giving users only the access required for their responsibilities.

It also protects administrative functionality from users who should not be able to view or modify particular types of data.

For this project, permissions control both the visibility of backend navigation items and access to the corresponding backend management sections.

## Why Server-Side Validation Matters

Server-side validation is essential because client-side validation cannot be treated as a security boundary.

A visitor can bypass browser validation, modify a request, or submit data without using the normal website form.

For this reason, the Contact form validates submitted data on the server before creating a `ContactMessage` record.

Only data that passes the required validation rules is stored in the database.

Combining server-side validation with backend permissions and basic anti-spam protection provides a safer and more reliable Contact management flow for the CMS.

---

# Task 24 – October CMS Dynamic Page Builder & Reusable Content Sections

## Dynamic Page Builder

The project includes a dynamic Page Builder that allows backend administrators to create and manage public website pages without hardcoding each page directly into the theme.

### Dynamic Page Model

Dynamic pages are represented by the `Page` model:

```text
Training\Services\Models\Page
```

The model uses the following database table:

```text
training_services_pages
```

Each page contains the following main fields:

- `title` — Required page title.
- `slug` — Required unique slug used to generate the public URL.
- `status` — Controls whether the page is `draft` or `published`.
- `seo_title` — Optional SEO-specific page title.
- `seo_description` — Optional SEO meta description.
- `created_at` and `updated_at` — Standard timestamps.

A Page can contain multiple Page Sections through the relationship between the `Page` and `PageSection` models.

---

### Page Builder and Content Block Approach

Instead of allowing administrators to enter unrestricted HTML for an entire page, the Page Builder uses reusable structured content blocks called Page Sections.

Each Page Section belongs to a Page and contains:

- `page_id` — The parent dynamic page.
- `section_type` — Determines which reusable section layout is used.
- `content` — Structured JSON content for the section.
- `display_order` — Determines the order of sections on the public page.
- `is_active` — Controls whether the section is rendered publicly.

The Page Section model uses the following database table:

```text
training_services_page_sections
```

Administrators can create multiple sections for a page, edit their content, control their display order, enable or disable individual sections, and delete sections from the backend.

---

### Supported Section Types

The Page Builder currently supports four approved section types:

#### Hero / Banner

Used for the main introductory area of a page.

Supported content includes:

- Title / heading.
- Subtitle.
- Optional image.
- Optional button label.
- Optional button URL.

#### Text Content

Used for standard text-based content.

Supported content includes:

- Title / heading.
- Body content.

#### Image + Text

Used for content that combines text with an optional image.

Supported content includes:

- Title / heading.
- Body content.
- Optional image.
- Image position (`left` or `right`).

#### Call to Action

Used to encourage the visitor to perform an action.

Supported content includes:

- Title / heading.
- CTA text.
- Optional button label.
- Optional button URL.

The backend form dynamically displays the appropriate fields according to the selected section type.

---

### Section Data and Theme Partials

Each supported section type is rendered through a reusable theme partial.

The current mapping is:

| Section Type | Theme Partial                  |
| ------------ | ------------------------------ |
| `hero`       | `page-sections/hero.htm`       |
| `text`       | `page-sections/text.htm`       |
| `image_text` | `page-sections/image-text.htm` |
| `cta`        | `page-sections/cta.htm`        |

The partials are located under:

```text
themes/training-theme/partials/page-sections/
```

The public dynamic page loads the Page Sections from the database, orders them using `display_order`, and selects the appropriate partial according to the value of `section_type`.

This keeps presentation logic inside the theme while the content remains managed through the backend and database.

---

### Public Dynamic Route

Published dynamic pages are available through the following public route:

```text
/pages/:slug
```

For example:

```text
/pages/about-training
/pages/career-development
```

The dynamic CMS page is located at:

```text
themes/training-theme/pages/dynamic-page.htm
```

The requested slug is used to retrieve the corresponding Page from the database.

Only active sections are loaded, and they are rendered in ascending `display_order`.

---

### Publishing Behavior

Dynamic pages support the following statuses:

```text
draft
published
```

Only pages with the `published` status are publicly accessible.

A draft page does not render as a normal public page. If a visitor requests a draft page or provides an unknown slug, the dynamic route returns a clear Page Not Found state with an HTTP 404 status.

Individual Page Sections can also be enabled or disabled using the `is_active` field.

Only active sections are rendered on the public page.

---

### SEO Metadata

Each dynamic Page supports:

- `seo_title`
- `seo_description`

When a published dynamic page is rendered, the SEO title is used as the HTML page title.

If `seo_title` is empty, the normal Page `title` is used as a fallback.

The SEO description is used to populate the public page meta description when provided.

Example:

```html
<title>About Our Training Program</title>

<meta
    name="description"
    content="Learn more about our professional training program and services."
/>
```

This allows SEO information to be managed directly from the backend without hardcoding metadata into individual theme pages.

---

### Page Management Permission

Dynamic Page management uses the following backend permission:

```text
training.services.manage_pages
```

The permission is registered by the Services plugin and is used by the Pages backend controller.

This allows Page management access to be assigned through October CMS backend roles and permissions instead of automatically allowing every backend user to manage dynamic pages.

---

### Validation and Data Integrity

Validation is applied to both Pages and Page Sections to prevent invalid records from being saved where practical.

Page validation includes:

- Required page title.
- Required slug.
- Unique slug.
- Valid `draft` or `published` status.
- Maximum lengths for SEO fields.

Page Section validation includes:

- Required valid section type.
- Valid integer display order.
- Display order cannot be negative.
- Required important content according to section type.
- Valid image position for Image + Text sections.
- Safe optional image handling.
- Optional buttons require consistent button label and URL values.
- Button URLs accept valid internal site paths or HTTP/HTTPS URLs.

For example, unsafe URL values such as JavaScript URLs are rejected by validation.

---

### Database Migrations and Plugin Updates

The dynamic Page Builder database structure is managed through October CMS plugin migrations.

The Page migration creates:

```text
training_services_pages
```

The Page Section migration creates:

```text
training_services_page_sections
```

After adding or modifying plugin migrations, the database can be updated using:

```bash
php artisan october:migrate
```

The Services plugin version history should include the migrations for the dynamic Page and Page Section entities so October CMS can apply the required database changes.

---

### Dynamic Navigation Integration

The existing website navigation includes a link to a dynamic page.

For example, the `Training` navigation item links to:

```text
/pages/about-training
```

The navigation contains only the link to the dynamic page. The complete page content is not hardcoded into the navigation.

The actual page content continues to come from the Page and Page Section records managed through the backend.

---

### Sample Dynamic Pages

The Page Builder was tested by creating multiple pages with different section compositions.

#### About Our Training

Section composition:

```text
Hero
Text
Call to Action
```

Public route:

```text
/pages/about-training
```

#### Career Development

Section composition:

```text
Hero
Image + Text
Text
Call to Action
```

Public route:

```text
/pages/career-development
```

These pages demonstrate that the same reusable section library can generate different page structures and content compositions without creating a separate hardcoded theme page for each layout.

---

### Why Reusable Section Types Are Used

Reusable section types provide a safer and more maintainable approach than allowing unrestricted HTML editing inside a managed CMS.

With unrestricted HTML, backend users could accidentally introduce broken markup, inconsistent layouts, unsafe links, or styling that does not follow the website design system.

The reusable section approach separates content from presentation. Administrators manage structured content through clearly defined backend fields, while the theme controls the final HTML and styling through approved partials.

This approach provides several benefits:

- Consistent design across dynamic pages.
- Reusable layouts and components.
- Easier validation of content.
- Safer handling of URLs and optional media.
- Less risk of broken HTML.
- Easier responsive design maintenance.
- Clear separation between content management and presentation.
- New page layouts can be created by combining existing section types instead of duplicating page templates.

The result is a controlled Page Builder that gives backend administrators flexibility while preserving the structure, security, and visual consistency of the website.

---

# Task 25 – October CMS Blog Module, Search, Filtering & Pagination

## Overview

Task 25 extends the existing October CMS training project from Tasks 20–24 by adding a complete Blog/News content module.

The Blog module provides structured content management through the October CMS backend and a public Blog interface that supports publication controls, scheduled publishing, featured images, search, category filtering, database-backed pagination, Blog Details pages, Related Posts, SEO metadata, backend permissions, and responsive design.

All functionality from the previous tasks remains available and continues to work alongside the new Blog module.

---

## Features Implemented

The following functionality was implemented as part of Task 25:

- Blog Category management
- Blog Post management
- Unique category and post slugs
- Draft and Published post statuses
- Scheduled publication using publication date and time
- Featured image support
- Backend Blog permissions
- Backend Blog navigation
- Public Blog listing
- Search functionality
- Category filtering
- Combined search and category filtering
- Database-backed pagination
- Blog Details pages using slugs
- Related Posts
- Dynamic SEO metadata
- Responsive desktop and mobile design
- Public protection for Draft, future-scheduled, and unavailable posts

---

## Blog Categories

A Blog Category entity was added to organize Blog Posts.

Each Blog Category contains:

- Name
- Slug
- Status
- Display order
- Created timestamp
- Updated timestamp

Category slugs are unique.

Categories can be managed from the October CMS backend through the Blog Categories section.

Backend users with the required permission can:

- View Blog Categories
- Create Blog Categories
- Edit Blog Categories
- Delete Blog Categories

Only active categories are used for public Blog content.

Three Blog Categories were created for testing:

- Web Development
- Frontend Development
- Career Development

---

## Blog Posts

A Blog Post entity was added for managing Blog/News content.

Each Blog Post contains:

- Title
- Slug
- Excerpt / summary
- Main body content
- Blog Category relationship
- Featured image
- Publication status
- Published date and time
- Created timestamp
- Updated timestamp

Each Blog Post belongs to a Blog Category.

Blog Post slugs are unique and are used to generate the public Blog Details URLs.

The October CMS backend provides interfaces for:

- Listing Blog Posts
- Creating Blog Posts
- Editing Blog Posts
- Publishing Blog Posts
- Keeping posts as Draft
- Deleting Blog Posts
- Searching Blog Posts
- Filtering Blog Posts by publication status
- Filtering Blog Posts by category

---

## Publication Rules

Blog Posts support the following publication statuses:

- Draft
- Published

A Blog Post is publicly available only when:

1. Its status is `published`.
2. Its `published_at` value is not in the future.
3. It belongs to an active Blog Category.

Draft posts are never displayed publicly.

A post marked as Published but having a future publication date is treated as a scheduled post and remains hidden until its publication time is reached.

The publication rules are applied consistently to:

- Blog listing
- Search results
- Category filtering
- Blog Details pages
- Related Posts

This prevents visitors from accessing Draft or future-scheduled content directly through its slug.

---

## Backend Blog Management

The October CMS backend contains a dedicated Blog navigation section.

The Blog section provides access to:

- Blog Posts
- Blog Categories

The Blog Posts backend list includes practical information such as:

- Title
- Slug
- Category
- Status
- Published At
- Updated At

Backend filters were also implemented for:

- Publication Status
- Category

This allows Blog content to be managed efficiently from the October CMS administration area.

---

## Backend Permissions

Dedicated permissions were added for Blog management.

The permissions are:

```text
training.services.manage_blog_categories
training.services.manage_blog_posts
```

The first permission controls access to Blog Category management.

The second permission controls access to Blog Post management.

The permissions are applied to the relevant backend controllers and navigation items.

A restricted backend administrator without Blog permissions was tested.

The restricted administrator could access the permitted Services functionality but received an `Access Denied` response when attempting to access Blog management.

This confirms that Blog backend functionality is protected by the configured permissions.

---

## Blog List Component

A reusable October CMS component named `BlogList` was implemented.

The component is responsible for retrieving Blog Posts for the public Blog page.

It loads eligible Published posts together with their:

- Blog Category
- Featured image
- Title
- Excerpt
- Published date

The component applies the publication rules before returning posts.

Posts are ordered by publication date with the newest eligible posts displayed first.

The component also handles:

- Search
- Category filtering
- Combined search and filtering
- Pagination
- Active category loading

---

## Public Blog Page

The public Blog page is available at:

```text
/blog
```

When running the project locally, it can be accessed at:

```text
http://127.0.0.1:8000/blog
```

The page displays eligible Blog Posts using responsive Blog cards.

Each card includes:

- Featured image
- Category
- Published date
- Title
- Excerpt
- Read More button

The Read More button opens the corresponding Blog Details page.

---

## Blog Search

The Blog page includes database-backed search functionality.

Visitors can search Blog content using the search field.

Search checks the following Blog Post fields:

- Title
- Excerpt
- Main body content

For example, searching for:

```text
Laravel
```

returns matching eligible Blog Posts.

Search results continue to respect the publication rules, so Draft and future-scheduled posts are not exposed through search.

---

## Empty Search and No Results

An empty search displays the normal eligible Blog listing.

If a visitor searches for a value that does not match any available Blog Post, the page displays a clear no-results state.

The no-results interface informs the visitor that no Blog Posts matched the search and provides an option to clear the search.

---

## Category Filtering

The Blog page provides category filtering using Blog Categories stored in the database.

Only active categories are available in the public category filter.

Visitors can select a category and display only Blog Posts belonging to that category.

For example:

```text
Frontend Development
```

displays eligible posts belonging to the Frontend Development category.

Category filtering also respects all publication rules.

---

## Combined Search and Category Filtering

Search and category filtering can be used together.

For example, a visitor can search for:

```text
Building
```

while selecting:

```text
Frontend Development
```

The result contains only eligible posts that satisfy both conditions.

Search and category parameters are preserved correctly while filtering the Blog listing.

---

## Pagination

The Blog listing uses database-backed pagination.

The current Blog List component displays:

```text
3 posts per page
```

Pagination controls allow visitors to navigate between result pages.

The interface provides controls such as:

- Previous
- Page numbers
- Next

Pagination continues to work while respecting the current Blog query, publication rules, search, and category filtering.

---

## Blog Details Component

A reusable `BlogDetails` component was implemented for individual Blog Posts.

The component loads a Blog Post using its unique slug.

The Blog Details route follows this structure:

```text
/blog/:slug
```

Example:

```text
/blog/getting-started-web-development
```

The Blog Details page displays:

- Blog Category
- Published date
- Blog Post title
- Excerpt
- Featured image
- Main body content

The page uses the existing Training CMS theme and responsive layout.

---

## Invalid and Unavailable Blog Posts

The Blog Details component checks the publication rules before displaying a Blog Post.

The following types of URLs are not publicly accessible:

- Unknown Blog Post slugs
- Draft Blog Posts
- Future-scheduled Blog Posts
- Posts that do not satisfy the public publication rules

These requests return a Page Not Found response instead of exposing unavailable Blog content.

For example:

```text
/blog/draft-blog-post
```

and:

```text
/blog/future-blog-post
```

are not publicly accessible while those posts remain unavailable.

An unknown slug such as:

```text
/blog/this-post-does-not-exist
```

also returns Page Not Found.

---

## Related Posts

The Blog Details page includes a Related Posts section.

Related Posts are selected using the category of the currently displayed Blog Post.

A related post must:

- Belong to the same Blog Category
- Be publicly eligible
- Not be the current Blog Post

Related Posts are ordered by publication date.

A maximum of three Related Posts is retrieved.

Each Related Post can display:

- Featured image
- Category
- Published date
- Title
- Excerpt
- Link to the article

---

## SEO Metadata

Dynamic SEO metadata was implemented for Blog Details pages.

The Blog Post title is used as the HTML page title.

The Blog Post excerpt is used as the meta description.

If the excerpt is unavailable, the Blog Post title is used as a fallback.

The main theme layout outputs the dynamic metadata using:

```html
<title>{{ this.page.title }}</title>
```

and:

```html
{% if this.page.meta_description %}
<meta name="description" content="{{ this.page.meta_description }}" />
{% endif %}
```

This allows individual Blog Posts to provide meaningful page metadata.

---

## Featured Images

Blog Posts support featured images through the October CMS file attachment system.

Featured images are displayed on:

- Public Blog cards
- Blog Details pages
- Related Posts

The Blog interface also provides a fallback presentation when a Blog Post does not contain a featured image.

---

## Responsive Design

The Blog module was integrated into the existing custom Training CMS theme.

Responsive styling was implemented for both desktop and mobile devices.

The responsive implementation includes:

- Blog page headings
- Search controls
- Category selector
- Apply and Clear buttons
- Blog card grid
- Blog card images
- Blog titles
- Blog excerpts
- Pagination
- Blog Details header
- Featured images
- Blog body content
- Related Posts
- Navigation
- Content spacing

On smaller screens, Blog content automatically adjusts to the available screen width and Blog cards are displayed in a mobile-friendly layout.

---

## Test Data

The Blog module was tested with the required content.

The test data includes:

- 3 Blog Categories
- 8 Blog Posts
- Multiple Published posts
- At least 1 Draft post
- At least 1 future-scheduled post
- Multiple Blog Categories
- Featured images

Example test posts include:

- Getting Started with Web Development
- Laravel Backend Development
- Building Responsive Websites
- Modern CSS Techniques
- Starting Your Tech Career
- Preparing for Developer Interviews
- Draft Blog Post
- Future Blog Post

---

## Testing and Verification

The Blog module was tested to verify the required functionality.

The following behavior was confirmed:

- Blog Categories can be managed from the backend.
- Blog Posts can be managed from the backend.
- Backend Blog filters work correctly.
- Published and eligible Blog Posts appear publicly.
- Draft Blog Posts remain hidden.
- Future-scheduled Blog Posts remain hidden.
- Search works correctly.
- Search checks Blog content stored in the database.
- Empty search works correctly.
- No-results search state works correctly.
- Category filtering works correctly.
- Search and category filtering work together.
- Pagination works correctly.
- Blog Details pages load using Blog Post slugs.
- Featured images display correctly.
- Related Posts are displayed.
- Related Posts exclude the current Blog Post.
- Unknown Blog Post slugs return Page Not Found.
- Draft Blog Post URLs return Page Not Found.
- Future-scheduled Blog Post URLs return Page Not Found.
- Backend Blog permissions restrict unauthorized users.
- Blog pages work on desktop screen sizes.
- Blog pages adapt correctly to mobile screen sizes.
- SEO title and meta description are generated dynamically.

---

## Main Files

The main files used for the Task 25 Blog implementation include:

```text
plugins/training/services/models/BlogCategory.php
plugins/training/services/models/BlogPost.php
plugins/training/services/components/BlogList.php
plugins/training/services/components/BlogDetails.php
plugins/training/services/Plugin.php
themes/training-theme/pages/blog.htm
themes/training-theme/pages/blog-details.htm
themes/training-theme/layouts/default.htm
themes/training-theme/assets/css/style.css
```

Backend configuration files for Blog Categories and Blog Posts are also located inside the Training Services plugin.

Database migration files are located under:

```text
plugins/training/services/updates/
```

---

## Database Migration

After cloning or pulling the project, install the required project dependencies and configure the environment as needed.

Apply the October CMS database migrations using:

```bash
php artisan october:migrate
```

This creates or updates the database structures required by the Training Services plugin, including the Blog functionality.

---

## Running the Project

Start the local October CMS development server using:

```bash
php artisan serve
```

The project can then be accessed at:

```text
http://127.0.0.1:8000
```

The Blog page is available at:

```text
http://127.0.0.1:8000/blog
```

---

## Task 25 Screenshots

Task 25 testing evidence includes screenshots for:

- Blog Posts backend management
- Blog Categories backend management
- Public Blog listing
- Search functionality
- Category filtering
- Pagination
- Blog Details page
- Related Posts
- Draft / future content protection
- Responsive mobile Blog interface
- Backend permission restriction

The screenshots demonstrate both backend content management and public Blog functionality.

---

## Challenges and Solutions

### Publication Visibility

The public Blog queries needed to distinguish between Published content that is currently available and Published content scheduled for the future.

This was handled by applying publication rules to the Blog queries so that only posts whose publication date has been reached are publicly available.

### Search and Category Filtering

Search and category filtering needed to work independently and together.

The Blog List component builds the database query dynamically based on the provided search term and selected category while continuing to apply the publication restrictions.

### Backend Permissions

Blog management needed to be unavailable to unauthorized backend administrators.

Dedicated Blog permissions were added and applied to the backend controllers and navigation.

Testing with a restricted administrator confirmed that unauthorized Blog access is denied.

### Blog Details Protection

Direct URLs could potentially be used to request Draft, future, or nonexistent Blog Posts.

The Blog Details component validates the post against the public publication rules before rendering it. Invalid or unavailable posts return a Page Not Found response.

### Responsive Interface

The Blog listing and Blog Details interfaces needed to remain usable across desktop and mobile screen sizes.

Responsive CSS was added to adjust the Blog grid, images, typography, filters, buttons, details content, and Related Posts according to the available screen width.

---

## Remaining Work

No required Task 25 functionality is currently known to be incomplete.

The implemented Blog module satisfies the required Blog management, publication control, public listing, search, filtering, pagination, Blog Details, Related Posts, SEO, permissions, testing, and responsive interface requirements.

---

## Task 25 Result

Task 25 successfully extends the existing October CMS project with a complete Blog/News module while preserving the functionality implemented in Tasks 20–24.

The completed module provides:

- Structured Blog content management
- Blog Categories
- Blog Posts
- Featured images
- Publication controls
- Scheduled publishing
- Backend permissions
- Public Blog listing
- Search
- Category filtering
- Combined filtering
- Database pagination
- Blog Details pages
- Related Posts
- Dynamic SEO metadata
- Protected unavailable content
- Responsive desktop and mobile interfaces

The result is a reusable and maintainable Blog/News system integrated into the existing Training CMS project.

---

# Task 26 - October CMS Document Library, File Management & Downloads

## Overview

Task 26 extends the existing October CMS project with a complete Document Library module.

The module provides backend management for document categories and documents, controlled file uploads, public document discovery, search and category filtering, pagination, publication rules, secure download handling, and download tracking.

The implementation continues using the existing custom October CMS plugin and theme from the previous tasks without creating a new project.

---

## Features Implemented

The Document Library includes:

- Document Category management.
- Document management.
- File attachments using October CMS file attachment capabilities.
- Published and Draft document statuses.
- Optional publication dates.
- File type validation.
- Maximum upload size validation.
- Backend permissions.
- Public Document Library page.
- Search by document title and description.
- Category filtering.
- Combined search and category filtering.
- Database-level pagination.
- Download handling through the application.
- Download counter tracking.
- File replacement support.
- Handling of missing and unavailable files.
- Handling of invalid or unavailable document downloads.
- Empty and no-result states.
- Responsive public Document Library interface.

---

## Document Categories

A `DocumentCategory` model was created to organize documents into categories.

Each category contains:

- Name
- Slug
- Status
- Display order
- Created timestamp
- Updated timestamp

Category slugs are validated and must be unique.

Only active categories are available through the public Document Library.

### Sample Categories

The following sample categories were created:

- Technical Guides
- Training Resources
- Company Documents

---

## Document Entity

A database-backed `Document` model was created for managing uploaded documents.

Each Document contains:

- Title
- Unique slug
- Short description
- Document Category relationship
- Attached file
- Status
- Optional publication date
- Download counter
- Created timestamp
- Updated timestamp

The supported document statuses are:

- Published
- Draft

Documents are related to Document Categories through a category relationship.

---

## Document Relationships

Each Document belongs to one Document Category.

The relationship is implemented using the `document_category_id` foreign key.

Conceptually:

```text
DocumentCategory
      |
      | has many
      |
   Documents

Document
      |
      | belongs to
      |
DocumentCategory
```

The Document model also uses an October CMS file attachment relationship for its uploaded file.

---

## File Attachment Approach

Uploaded files are handled using the native October CMS file attachment system.

The Document model defines a file attachment relationship using the October CMS `System\Models\File` model.

Files are therefore not stored as binary data directly inside the normal Document database table.

This keeps document metadata separate from the physical uploaded file and allows October CMS to manage file storage and attachment relationships.

---

## Allowed File Types

The Document Library accepts the following document formats:

- PDF
- DOC
- DOCX
- XLS
- XLSX
- PPT
- PPTX

Unsupported file types are rejected during upload.

For example, a `.txt` file was tested and correctly rejected by the upload validation.

---

## Maximum File Size

The maximum allowed uploaded document size is:

```text
10 MB
```

Files exceeding the configured maximum size are rejected.

The upload restrictions are applied to prevent unsupported or excessively large files from being accepted by the Document Library.

---

## Backend Document Management

Backend management sections were created for:

- Documents
- Document Categories

Authorized backend users can manage Document Library content through the October CMS administration area.

Document management supports:

- Listing documents
- Creating documents
- Editing documents
- Publishing documents
- Keeping documents as Draft
- Replacing attached files
- Deleting documents

The backend Documents list includes useful information such as:

- Title
- Category
- Status
- File name
- File type
- Download count
- Updated date

Backend filtering is also available for useful document attributes such as status and category.

---

## File Replacement

An attached file can be replaced while keeping the existing Document record and its metadata.

Replacing a file does not require creating a new Document record.

The existing:

- Title
- Slug
- Description
- Category
- Publication information
- Document record

can remain unchanged while the attached file is replaced.

The public Document Library then reflects the latest attached file.

File replacement was tested successfully during Task 26.

---

## Backend Permissions

Separate backend permissions were added for Document Library management.

The permissions include:

```text
training.services.manage_documents
training.services.manage_document_categories
```

These permissions are applied to the relevant backend navigation and controllers.

A restricted backend user without the required permission was tested and was denied access to Document management.

This prevents unauthorized backend users from managing Documents or Document Categories.

---

## Public Document Library

A public Document Library page was added to the existing theme.

Public URL:

```text
/documents
```

The page displays eligible published documents using the existing project design.

Each document card can display:

- Title
- Category
- Short description
- File type
- Publication or upload date
- Download count
- Download action

Only documents that satisfy the public publication rules are included.

---

## Publication and Access Rules

The public Document Library does not display every database record automatically.

A document is eligible for public display when:

- Its status is `published`.
- Its category is active.
- Its publication date is not in the future when a publication date is provided.

Draft documents are excluded from the public library.

Documents belonging to inactive categories are also excluded.

The same eligibility rules are checked when processing a public download request.

This prevents an unavailable or unpublished Document from becoming downloadable simply by changing the Document ID in the URL.

---

## Search

The public Document Library supports search using the Document:

- Title
- Description

Search is performed through the server/database query rather than by loading all documents and hiding unmatched records in the browser.

Example:

```text
/documents?q=Frontend
```

Only matching eligible documents are returned.

---

## Category Filtering

Users can filter public documents by Document Category.

The filter uses the category slug.

Example:

```text
/documents?category=training-resources
```

Only eligible documents belonging to the selected category are returned.

---

## Combined Search and Category Filtering

Search and category filtering can be used together.

Example:

```text
/documents?q=Frontend&category=training-resources
```

Both conditions are applied to the database query.

This allows users to search within a specific Document Category.

---

## Pagination

Public Document results are paginated at the database level.

The current page size is:

```text
6 documents per page
```

Enough sample Documents were created to demonstrate multiple result pages.

Pagination continues to work while search or category filters are active.

The active search and category values are preserved when navigating between result pages.

---

## Download Flow

Public downloads are processed through the Document Library application flow.

Instead of using the file URL directly as the Download button target, the public page sends a request containing the Document ID.

Example:

```text
/documents?download=8
```

The Document List component processes the request before allowing the file to be opened.

The download process performs the following checks:

1. Find the requested Document.
2. Verify that the Document is published.
3. Verify that the Document belongs to an active category.
4. Verify publication eligibility.
5. Verify that an attached file exists.
6. Increment the download counter.
7. Redirect the valid request to the attached file.

If the Document is unavailable, unpublished, inactive, or invalid, the download is not processed.

---

## Download Counter

Each Document contains a `download_count` value.

The counter is incremented only when a valid download request is processed.

For example:

```text
Downloads: 0
```

becomes:

```text
Downloads: 1
```

after a valid download request.

Invalid or unavailable Document requests do not increment the counter.

The download counter behavior was tested successfully.

---

## Missing and Invalid Download Handling

The application handles invalid download requests without exposing an application error.

For an unknown, inactive, or unavailable Document, the user is redirected back to the Document Library with clear feedback:

```text
This document is unavailable or is not published.
```

For a Document whose attached file is missing, the application provides appropriate unavailable-file feedback.

This prevents invalid requests from breaking the public interface.

---

## Missing File Handling

The public Document Library checks whether a Document has an attached file.

If the file attachment is unavailable, the Document card remains usable and displays:

```text
File unavailable
```

instead of displaying a broken Download link.

This allows the page to continue rendering normally even when an attachment has been removed or is missing.

---

## Empty and No-Result States

The public Document Library provides user-friendly feedback for empty states.

If search or filtering returns no matching Documents, the page displays:

```text
No results found
```

with a message explaining that no documents matched the current search or category filter.

If no published Documents are available, the page displays:

```text
No documents available
```

The interface therefore avoids blank pages or application errors when no results are available.

---

## Responsive Design

The public Document Library was designed to remain practical on mobile-sized screens.

Responsive behavior was applied to:

- Document Library header
- Search field
- Category filter
- Filter actions
- Document cards
- Document metadata
- Download actions
- Pagination

On smaller screens, the layout adjusts to a single-column structure and form controls adapt to the available screen width.

The responsive layout was tested using a `390 × 844` mobile-sized viewport.

---

## Sample Data and Testing

Three Document Categories were created:

```text
Technical Guides
Training Resources
Company Documents
```

At least eight Document records were created so that pagination could be demonstrated.

The test data includes:

- Published Documents
- At least one Draft Document
- Multiple Document Categories
- PDF files
- DOCX files

Using PDF and DOCX files verifies support for more than one allowed document type.

---

## End-to-End Testing

The following scenarios were tested successfully:

- Three Document Categories were created.
- At least eight Document records were created.
- More than one allowed file type was used.
- At least one Document was kept as Draft.
- Public search was verified.
- Category filtering was verified.
- Combined search and category filtering were verified.
- Pagination was verified.
- A published Document was downloaded and its counter increased.
- An existing attached file was replaced and the latest file was reflected.
- An unsupported `.txt` upload was rejected.
- Backend permission restrictions were verified.
- Draft content was hidden from the public library.
- Unknown Document downloads were handled without an application error.
- Missing file attachments were handled without breaking the public interface.
- No-result search behavior was verified.
- The public Document Library was tested on a mobile-sized screen.

---

## Database and Migration Updates

Task 26 adds database structures for Document Categories and Documents.

After pulling the project or receiving new plugin migrations, run:

```bash
php artisan october:up
```

This applies outstanding October CMS and plugin migrations.

If required during development, the application cache can also be cleared using:

```bash
php artisan cache:clear
```

---

## Security Considerations

The Document Library includes security controls for uploaded files, backend management, and public downloads.

### Upload Security

Uploaded files are restricted to the approved document formats:

```text
PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX
```

The maximum file size is:

```text
10 MB
```

Unsupported files are rejected instead of being accepted as arbitrary uploads.

Upload validation is performed by the application/backend configuration and should not rely only on the filename or extension supplied by the browser.

### Backend Access Control

Document management is protected using October CMS backend permissions.

Users without the required Document Library permissions cannot manage Documents or Document Categories.

### Public Download Access

Only eligible published Documents belonging to active categories are available through the public Document Library.

Download requests are checked against the publication and category rules before the counter is incremented and the file is opened.

Invalid, unavailable, or unpublished Document requests are rejected without exposing an application error.

### Sensitive Information

Sensitive project information must not be committed to the public repository.

This includes:

- `.env`
- Database credentials
- Administrator passwords
- Mail credentials
- API keys
- Tokens
- Private uploaded documents
- Other confidential information

Test files used for the Document Library should not contain private or sensitive information.

---

## Task 26 Result

Task 26 adds a complete Document Library workflow to the existing October CMS project.

The final implementation provides:

- Document Category management
- Document management
- Controlled file uploads
- File attachments
- Backend permissions
- Publication rules
- Public Document Library
- Search
- Category filtering
- Combined search and filtering
- Pagination
- Download processing
- Download counter tracking
- File replacement
- Missing-file handling
- Invalid-state feedback
- Responsive mobile support

The public Document Library is available at:

```text
/documents
```

The implementation continues to use the same custom October CMS plugin and theme developed throughout the previous training tasks.
