# SEA Catering

SEA Catering is a Laravel-based web application for healthy meal plan subscriptions, featuring an admin dashboard, user authentication, testimonials, and a modern frontend built with Tailwind CSS.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [Database Migration](#database-migration)
- [API Endpoints](#api-endpoints)
- [Frontend Pages](#frontend-pages)
- [Admin Dashboard](#admin-dashboard)
- [Testimonials](#testimonials)
- [Meal Plans](#meal-plans)
- [File Structure](#file-structure)
- [License](#license)

---

## Features

- User authentication (login/register)
- Meal plan CRUD (admin)
- Meal plan listing and detail modal (user)
- Admin dashboard with analytics and user management
- Testimonial submission and display (with rating)
- Responsive UI with Tailwind CSS
- RESTful API for all resources
- Subscription management (pause/cancel/subscribe)
- Contact Us page with manager details
- User dashboard for managing subscriptions

---

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL/MariaDB or compatible DB
- Laravel 10+

---

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/sea-catering.git
   cd sea-catering
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JS dependencies:**
   ```bash
   npm install
   ```

4. **Build frontend assets:**
   ```bash
   npm run build
   ```

---

## Environment Setup

1. Copy `.env.example` to `.env` and configure your database and mail settings.
2. Generate application key:
   ```bash
   php artisan key:generate
   ```

---

## Database Migration

Run the following to create all tables:
```bash
php artisan migrate
php artisan db:seed
php artisan db:seed --class=MealPlanSeeder
```

---
## Demo Account for admin
- Email: admin@seacatering.com
- Password : Adminsea@123

## Features
### Admin Dashboard

- Filter subscriptions by date range.
- View new subscriptions, revenue, reactivations, and active subscriptions.
- Manage user roles (USER/ADMIN).

---

### Testimonials

- Users can submit testimonials with a star rating and review.
- Testimonials are displayed in a Swiper carousel.

---

### Meal Plans

- Meal plans are displayed with image, name, description, price, and features.
- Clicking "Lihat Detail" opens a modal with more information.

---

### Subscription

- Users can subscribe to meal plans by selecting plan, meal types, delivery days, and allergies.
- Price calculation is shown dynamically based on user selection.
- After subscribing, users can manage (pause/cancel) their subscriptions from the dashboard.

---

### User Dashboard

- Users can view all their active subscriptions.
- Pause a subscription for a selected date range.
- Cancel a subscription.

---

### Contact Us

- Dedicated Contact Us page with manager name and phone number.

---
