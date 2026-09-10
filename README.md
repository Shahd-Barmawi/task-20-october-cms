# October CMS Training Project

Final October CMS project developed as part of the **Blue Information Technology University Field Training Program – Full-Stack Development Track**.

This repository contains the completed CMS implementation developed throughout the October CMS phase of the training. The project combines a custom public theme, reusable CMS components, structured backend content management, role-based permissions, audit logging, administrative reporting, file management, QA improvements, and production-readiness review.

---

## Project Overview

The project started with a custom October CMS theme and was progressively extended into a complete content-management application.

The final system allows backend users to manage services, categories, contact messages, dynamic pages, blog content, documents, and administrative reporting. Public users can browse published content through a responsive website while draft, inactive, restricted, and unavailable content remains protected.

The main custom plugin is:

```text
Training.Services
```

The main custom theme is:

```text
training-theme
```

Repository:

```text
https://github.com/Shahd-Barmawi/task-20-october-cms.git
```

---

## Main Technologies

The project uses:

- October CMS
- PHP
- Laravel / October CMS framework conventions
- Twig
- YAML backend configuration
- MySQL / MariaDB
- HTML5
- CSS3
- October CMS AJAX Framework
- October CMS file attachments
- Git and GitHub
- Composer

A local environment such as XAMPP can be used for PHP and MySQL/MariaDB development.

---

## Main Features and Modules

### Theme and Public Website

A custom October CMS theme named `training-theme` provides the public website.

The theme includes:

- Shared layout structure
- Reusable header and footer partials
- Responsive navigation
- Responsive public sections
- Reusable CMS components
- Dynamic public content
- Safe not-found behavior
- Mobile and tablet responsive styling

The final navigation provides access to:

- Home
- About
- Training
- Career
- Blog & News
- Documents
- Contact

### Services Management

The Services module allows authorized backend users to:

- Create Services
- Edit Services
- Delete Services
- Enable or disable Services
- Configure display order
- Assign Services to Categories
- Upload and replace Service images

Only active Services that satisfy the public visibility rules are displayed publicly.

The reusable `ServicesList` component renders Services on the public website.

Individual Service details are available through:

```text
/services/:id
```

Unavailable or inactive Services are not exposed as normal public content.

### Service Categories

Service Categories organize Services and support:

- Create, update, and delete operations
- Unique slugs
- Active/inactive state
- Display ordering
- Service-to-Category relationships
- Public Service filtering

Services assigned to inactive Categories are excluded from public Service listings.

### Contact Management

The Contact module includes:

- Backend-managed Contact Settings
- Public Contact page
- AJAX Contact form
- Server-side validation
- Email format validation
- Honeypot anti-spam protection
- Backend Contact Message management
- New/Read message status
- Search functionality

The Contact form is available at:

```text
/contact
```

The form validates submitted input on the server before creating a Contact Message.

### Dynamic Page Builder

The Dynamic Page Builder allows backend administrators to create public pages without hardcoding a separate theme page for every content page.

Supported section types include:

- Hero / Banner
- Text Content
- Image + Text
- Call to Action

Dynamic pages support:

- Unique slugs
- Draft/Published status
- SEO title
- SEO description
- Ordered reusable sections
- Active/inactive sections
- Structured content
- Controlled button URLs

Published Dynamic Pages use:

```text
/pages/:slug
```

Examples:

```text
/pages/about-training
/pages/career-development
```

Draft or unavailable Dynamic Pages return a not-found state instead of exposing unpublished content.

### Blog & News

The Blog module provides:

- Blog Category management
- Blog Post management
- Featured images
- Draft and Published states
- Scheduled/future publication
- Unique slugs
- Public Blog listing
- Search
- Category filtering
- Combined search and filtering
- Database-backed pagination
- Blog Details pages
- Related Posts
- Dynamic SEO metadata

Public Blog listing:

```text
/blog
```

Blog Details:

```text
/blog/:slug
```

Draft, future-scheduled, and unavailable Blog Posts are not publicly accessible.

### Document Library

The Document Library provides:

- Document Category management
- Document management
- File attachment handling
- PDF upload
- File type validation
- Draft and Published states
- Optional publication dates
- Public Document Library
- Search
- Category filtering
- Pagination
- Controlled download handling
- Download tracking
- File replacement
- Missing-file handling

Public Document Library:

```text
/documents
```

Missing files are handled with a safe `File unavailable` state.

### Roles and Permissions

Backend access is controlled with October CMS authentication, roles, and permissions.

The project uses practical backend roles such as:

- Content Editor
- Content Manager
- Administrator Supervisor

The configured permissions include:

```text
training.services.manage_services
training.services.manage_categories
training.services.manage_contact_messages
training.services.manage_pages
training.services.manage_blog_categories
training.services.manage_blog_posts
training.services.manage_document_categories
training.services.manage_documents
training.services.review_audit_logs
training.services.view_dashboard
training.services.view_reports
```

Permissions are applied to both:

- Backend navigation visibility
- Direct backend controller access

Restricted users cannot bypass permissions by manually entering protected backend URLs.

### Audit Logging

The Audit Log provides administrative activity tracking for selected content modules.

Tracked activity includes:

- Create
- Update
- Status Change
- Delete

The current audit implementation tracks meaningful administrative changes for:

- Services
- Documents

Audit entries include:

- Backend user
- Action
- Module
- Record ID
- Human-readable description
- Safe metadata
- Timestamp

Audit Logs are read-only through the normal backend interface.

Sensitive metadata keys such as passwords, tokens, API keys, secrets, cookies, authorization data, and private environment values are sanitized before storage.

Audit access requires:

```text
training.services.review_audit_logs
```

### Administrative Dashboard

The backend Dashboard provides a high-level operational overview using real project data.

The Dashboard includes eight KPI cards:

1. Published Blog Posts
2. Draft Blog Posts
3. Total Documents
4. Published Documents
5. New Contact Messages
6. Published Dynamic Pages
7. Total Services
8. Active Services

It also includes recent administrative activity and recent Contact Messages.

Dashboard KPI values use database-level aggregate queries, while recent lists are intentionally limited to avoid loading unnecessary records.

### Reports and CSV Export

The Reports module provides administrative reporting based on Audit Log data.

Features include:

- Date From filter
- Date To filter
- Module filter
- Action filter
- Combined filtering
- Dynamic summary values
- Detailed results
- Pagination
- Empty-result state
- Invalid date-range handling
- Filter-aware CSV export

CSV export uses streaming/cursor-based processing so the complete filtered dataset does not need to be loaded into memory at once.

Protected backend routes include:

```text
/admin/training/services/dashboard
/admin/training/services/reports
/admin/training/services/auditlogs
```

---

## Project Structure

Important project areas include:

```text
plugins/training/services/
├── classes/
├── components/
├── controllers/
├── models/
├── updates/
└── Plugin.php

themes/training-theme/
├── assets/
│   └── css/
├── content/
├── layouts/
├── pages/
└── partials/
```

The plugin contains the project business logic, backend controllers, models, permissions, CMS components, and database migrations.

The theme contains the public presentation layer, page templates, reusable partials, and responsive styling.

---

## Local Installation and Setup

### Requirements

Install or provide:

- PHP
- Composer
- MySQL or MariaDB
- Git
- Required PHP extensions for the installed October CMS version
- A local PHP/MySQL environment such as XAMPP, or another compatible setup

### 1. Clone the Repository

```bash
git clone https://github.com/Shahd-Barmawi/task-20-october-cms.git
```

### 2. Enter the Project Directory

```bash
cd task-20-october-cms
```

### 3. Install PHP Dependencies

```bash
composer install
```

### 4. Create the Environment File

Create a local `.env` file based on `.env.example`.

On systems that support the command:

```bash
cp .env.example .env
```

On Windows, `.env.example` can also be copied manually and renamed to `.env`.

### 5. Configure the Environment

Configure the local application URL and database connection in `.env`.

Do not commit the real `.env` file.

### 6. Generate an Application Key if Required

```bash
php artisan key:generate
```

### 7. Create the Local Database

Create an empty MySQL/MariaDB database and configure its connection through the local environment file.

### 8. Apply October CMS Migrations

```bash
php artisan october:migrate
```

This applies the core/project database updates and the migrations registered by the custom plugin.

### 9. Start the Development Server

```bash
php artisan serve
```

The default development URL is typically:

```text
http://127.0.0.1:8000
```

Backend administration is available at:

```text
http://127.0.0.1:8000/admin
```

A local backend administrator account must be created or configured separately. No real administrator credentials are included in this repository.

---

## Database Setup and Updates

Database structures are managed through October CMS/plugin migrations.

Custom plugin migrations are located under:

```text
plugins/training/services/updates/
```

After cloning the project or pulling changes that include migrations, run:

```bash
php artisan october:migrate
```

No manual creation of the custom plugin tables should be required when the registered migrations are applied correctly.

Before running schema updates in a production environment, create an appropriate database backup.

### Sample Data

The project was tested using sample Services, Categories, Dynamic Pages, Blog Posts, Documents, Contact Messages, and Audit Log records.

Sample/demo data used for testing must not contain real confidential or production information.

A developer can create representative test records through the October CMS backend after migrations are applied.

---

## Required Environment Variables

Environment-specific configuration belongs in `.env`.

The main variable names used or expected by the project environment include:

```text
APP_NAME
APP_ENV
APP_KEY
APP_DEBUG
APP_URL

DB_CONNECTION
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD

CACHE_STORE
SESSION_DRIVER
QUEUE_CONNECTION

MAIL_MAILER
MAIL_HOST
MAIL_PORT
MAIL_USERNAME
MAIL_PASSWORD
MAIL_ENCRYPTION
MAIL_FROM_ADDRESS
MAIL_FROM_NAME

FILESYSTEM_DISK

AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
AWS_DEFAULT_REGION
AWS_BUCKET
AWS_USE_PATH_STYLE_ENDPOINT
```

Only variable names are documented here.

Real passwords, credentials, API keys, access tokens, private keys, and other secrets must remain outside version control.

The repository includes `.env.example` as a safe configuration reference. The local `.env` file is ignored by Git.

---

## Main Public Routes

| Route                       | Purpose                                   |
| --------------------------- | ----------------------------------------- |
| `/`                         | Home page and public Services             |
| `/about`                    | About page                                |
| `/services/:id`             | Service Details                           |
| `/pages/:slug`              | Published Dynamic Pages                   |
| `/pages/about-training`     | Training Dynamic Page                     |
| `/pages/career-development` | Career Development Dynamic Page           |
| `/blog`                     | Blog & News listing                       |
| `/blog/:slug`               | Blog Details                              |
| `/documents`                | Public Document Library                   |
| `/contact`                  | Contact information and AJAX Contact form |

Draft, inactive, future-scheduled, restricted, or unavailable content is not intended to be exposed publicly.

---

## File and Storage Considerations

The project uses October CMS file attachments for uploaded content such as:

- Service images
- Blog featured images
- Document files

For production handover:

- Ensure the configured storage location is writable by the application.
- Configure production filesystem/storage settings through the environment.
- Do not commit private uploaded files that are not intended for public use.
- Keep cloud-storage credentials outside source control.
- Preserve the configured upload validation.
- Validate file types before accepting uploaded documents.
- Review storage limits and maximum upload-size settings for the deployment environment.
- Ensure any server-level PHP upload limits are compatible with the application requirements.

Valid PDF uploads, invalid file-type rejection, file replacement, public download behavior, draft/publication restrictions, and missing-file behavior were tested during QA.

---

## Testing and QA

The project was tested throughout implementation and received a dedicated final QA review.

Testing covered:

- Backend CRUD operations
- Services and Service Categories
- Contact Settings and Contact Messages
- AJAX Contact submission
- Required-field validation
- Server-side email validation
- Anti-spam behavior
- Dynamic Pages
- Draft/Published behavior
- Page Builder sections
- Blog Categories and Blog Posts
- Scheduled Blog publication
- Search
- Category and status filters
- Pagination
- Blog Details and Related Posts
- Document Categories and Documents
- File upload and download
- Missing-file behavior
- Roles and permissions
- Direct backend URL restrictions
- Audit Log creation and filters
- Audit integrity
- Dashboard KPI accuracy
- Reports and combined filtering
- CSV export
- Invalid report date ranges
- Empty result states
- Data integrity
- Public navigation
- Responsive behavior
- 404/not-found behavior
- Repository security
- Performance review
- Production configuration review

### Task 29 QA Findings

Task 29 recorded:

```text
12 total findings
12 fixed and re-tested
0 unresolved High severity findings
0 unresolved Medium severity findings
```

The fixes included:

- Service Category post-delete navigation
- Stronger server-side Contact email validation
- Backend search-field layout improvements
- Dynamic Page discoverability
- Blog & News public navigation
- Document Library public navigation
- About page route correction
- Training page View Services link correction

The detailed QA findings are maintained in:

```text
QA_FINDINGS.md
```

### Task 30 Final Regression

A final regression pass was performed on the most important public and backend flows.

The final verification covered:

- Public navigation
- Published/Draft Dynamic Pages
- Contact submission and backend message visibility
- Blog listing and Blog Details
- Search and filters
- Document Library and downloads
- Backend CRUD
- Restricted backend access
- Audit Log
- Dashboard
- Reports
- CSV export
- Responsive behavior
- 404/error handling

During Task 30, a responsive header issue was identified at a tablet/mobile-sized viewport. The public navigation was updated so the header and links wrap correctly at smaller widths, and the fix was re-tested successfully.

---

## Security Review

The final security review included:

- Confirmation that `.env` is not tracked by Git
- Confirmation that `.env` is ignored by `.gitignore`
- Review of `.env.example` for real credentials
- Repository search for obvious passwords, tokens, API keys, and secrets
- Server-side validation for public forms
- Direct backend permission enforcement
- Draft/inactive public-content protection
- Upload validation
- Audit metadata sanitization
- Public error-state review
- Safe missing-file handling

Tested public error states did not expose raw stack traces, SQL details, filesystem paths, or credentials.

The Audit Log sanitization removes known sensitive metadata fields before storage.

Production credentials must always be supplied through environment-specific configuration rather than committed source files.

---

## Performance Notes

The final review focused on avoiding unnecessary data loading in the main administrative reporting features.

Implemented considerations include:

- Database-level aggregate queries for Dashboard KPIs
- Recent Dashboard lists limited to five records
- Database-level report filtering
- Paginated report results
- Cursor/stream-based CSV export
- Review of Dashboard and Reports for obvious N+1 query patterns

No obvious critical performance issue was identified during the reviewed workflows.

Production performance should still be monitored using real deployment traffic and production-scale data.

---

## Production Readiness

Before deploying to production:

1. Set the correct production application environment.
2. Disable public debug output.
3. Configure the production `APP_URL`.
4. Configure production database credentials through environment variables.
5. Configure production mail settings if mail delivery is required.
6. Configure the intended filesystem/storage driver.
7. Verify filesystem permissions.
8. Configure the required cache and session drivers.
9. Configure queue processing if the deployment requires it.
10. Apply all required database migrations.
11. Back up the database before production schema updates.
12. Prepare production assets and caches as required by the deployment environment.
13. Verify upload-size restrictions at both application and server levels.
14. Review exported administrative data before using it with real sensitive production information.
15. Perform a final smoke test after deployment.
16. Never commit production secrets or credentials.

---

## Setup Dependencies and Assumptions

Another developer taking over the project should know that:

- PHP, Composer, and MySQL/MariaDB must be available.
- The local database must be configured before running migrations.
- Environment-specific settings belong in `.env`.
- A backend administrator account must be configured separately.
- The October CMS backend prefix used during development and testing is `/admin`.
- Uploaded files depend on correctly configured writable storage.
- Sample content may need to be created through the backend when starting from a clean database.
- The project was primarily verified in a local development environment using the repository configuration documented above.

---

## Final Project Status

### Completed Functionality

The project currently includes:

- Custom responsive October CMS theme
- Public navigation and reusable layouts/partials
- Dynamic Services
- Service Categories
- Service images and detail pages
- Contact Settings
- AJAX Contact form
- Contact Message management
- Server-side validation and honeypot protection
- Dynamic Page Builder
- Reusable Page Builder sections
- Blog & News
- Blog search, filtering, pagination, details, Related Posts, and SEO
- Document Library
- Document search, filtering, downloads, and download tracking
- Backend roles and permissions
- Read-only Audit Log
- Sensitive audit metadata sanitization
- Administrative Dashboard
- Administrative Reports
- CSV export
- Responsive public/backend improvements
- Final QA, security, performance, and production-readiness review

### Known Remaining Limitations

No unresolved High or Medium severity issue remains in the recorded Task 29 QA findings.

The following handover limitations remain documented:

- The configured maximum document file-size restriction was not manually stress-tested during the final QA cycle.
- Exported report data should receive a final sensitivity/privacy review before being used with real production data.
- Missing-image/file states were reviewed in important flows but not exhaustively tested on every possible public page.
- Empty/no-results states were tested in key modules but not exhaustively across every possible content configuration.
- Responsive behavior was tested on representative desktop/mobile/tablet-sized views, but not on every possible device and browser combination.

These are documented verification limitations and are not known unresolved High or Medium severity bugs.

### Optional Future Improvements

Possible future enhancements include:

- Broader automated test coverage
- More granular audit coverage for additional content modules
- Advanced report/export options
- Configurable audit-retention policies
- More comprehensive file-size and storage-quota controls
- Additional accessibility testing
- Broader cross-browser/device testing
- Production monitoring and performance instrumentation

These items are optional enhancements and are separate from known bugs or required completed functionality.

---

## Training Reflection

During this training, I gained practical experience in full-stack development and learned how the different parts of a real web application work together. Working with October CMS helped me improve my understanding of PHP, backend development, databases, frontend development, and content management systems.

Throughout the project, I worked on several features, including services, contact messages, dynamic pages, blog and news content, a document library, user roles and permissions, audit logs, an administrative dashboard, reports, and CSV export. I also gained more experience with validation, file handling, responsive design, Git, GitHub, and testing.

One of the biggest challenges was continuing to add new features to the same project while making sure that the previous functionality still worked correctly. This taught me the importance of regression testing, debugging, security checks, and organizing code in a maintainable way.

The training also helped me understand the connection between the frontend, backend, database, permissions, and security instead of looking at each part separately.

After completing this training, I would like to continue improving my backend and full-stack development skills, especially in API development, application architecture, automated testing, security, and deployment.

---

## Final Handover Notes

The project has completed the implementation, QA, security review, regression testing, documentation, and production-readiness review required for the training handover.

Before final deployment, the receiving developer should:

- Review environment-specific production configuration
- Apply the documented migrations
- Configure the intended storage environment
- Verify deployment-specific upload limits
- Review real exported data for privacy requirements
- Perform a production smoke test

The repository should remain free of real credentials, private keys, tokens, passwords, and other sensitive environment information.

This README is intended to provide the final technical handover reference for the October CMS training project.
