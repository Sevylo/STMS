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

### Screenshots
**Login Page**
<img width="1920" height="899" alt="image" src="https://github.com/user-attachments/assets/a557ba3f-2220-4e32-b187-38231d80fbc3" />
**Register Page**
<img width="1920" height="898" alt="image" src="https://github.com/user-attachments/assets/e64ac9b0-8899-4994-bd89-f2aedd167859" />
**Reset Password Page**
<img width="1920" height="891" alt="image" src="https://github.com/user-attachments/assets/5ec4b6f3-8b50-4d9e-bd6e-69bffda57705" />
**Dashboard Page**
<img width="1920" height="898" alt="image" src="https://github.com/user-attachments/assets/16fa72a3-ca92-43f8-a1c2-b5f56fcbb8cd" />
**My Tasks Page**
<img width="1920" height="897" alt="image" src="https://github.com/user-attachments/assets/dfae35c5-8498-43e5-b568-5f6c44e6e045" />
**Add Task Form**
<img width="1920" height="892" alt="image" src="https://github.com/user-attachments/assets/d82ec2d0-2195-46e6-aa9e-69c8d239dcea" />
**Profile**
<img width="1895" height="672" alt="image" src="https://github.com/user-attachments/assets/1d78e375-a614-4775-9910-0f701292792e" />
<img width="1891" height="573" alt="image" src="https://github.com/user-attachments/assets/276d117c-71b4-48f5-95da-81aee7d10a19" />
<img width="1898" height="306" alt="image" src="https://github.com/user-attachments/assets/4d249615-8629-425a-8516-1785b7a9dd05" />

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
