# Simple Task Management System (STMS)

A robust and simple task management system built with Laravel 11. This application allows users to simpler manage their day-to-day tasks with features like priority tracking, deadline reminders, and task organization.

## Features

- **User Authentication**: Secure Login and Registration system.
- **Task Management**:
    - Create, Read, Update, and Delete (CRUD) tasks.
    - Set task priorities (High, Medium, Low) with color-coded badges.
    - Set deadlines and optional custom reminders.
    - Toggle task status (Pending/Completed).
- **Organization & Sorting**:
    - **Separate "My Tasks" Page**: Dedicated space for task management.
    - **Sorting**: Sort tasks by **Priority** (High to Low) or **Deadline** (Earliest to Latest).
    - **Dashboard Stats**: Quick overview of Total, Pending, and Completed tasks.
- **Modern UI/UX**:
    - Clean, sticky navigation bar.
    - Responsive card layout for tasks.
    - Visual cues for task status and priority.

## Tech Stack

- **Framework**: [Laravel 11](https://laravel.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Database**: MySQL (compatible with MariaDB, SQLite, PostgreSQL)
- **Frontend**: Blade Templating Engine with Alpine.js

## Installation & Setup

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/Sevylo/STMS.git
   cd STMS
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   Copy the example environment file and configure your database settings:
   ```bash
   cp .env.example .env
   ```
   Update `.env` with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Start the Development Server**
   ```bash
   # Run the Laravel server
   php artisan serve

   # Run the Vite development server (in a separate terminal)
   npm run dev
   ```

Access the application at `http://localhost:8000`.

## Usage Guide

### Creating a Task
1. Navigate to **My Tasks**.
2. Click the **+ Create Task** button.
3. Fill in the Title, Description, Deadline, Priority, and optional Reminder.
4. Click **Save Task**.

### Sorting Tasks
Use the **Sort By** dropdown on the "My Tasks" page to organize your view:
- **Priority**: Sorts tasks from High -> Medium -> Low priority.
- **Deadline**: Sorts tasks from the earliest deadline to the latest.

### Notifications
- **Deadline Reminders**: Automated reminders sent 7 days, 3 days, and 1 day before the deadline.
- **Custom Reminders**: Custom alerts sent at your specified date and time.
- **Testing Reminders**: Run `php artisan reminders:send` to manually trigger reminder checks.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
