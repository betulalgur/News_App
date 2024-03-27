# Simple News Notification System

The News App is a simple web application that allows you to view news articles and perform CRUD operations. This application is developed using Laravel for the backend and Next.js for the frontend.

## Technologies Used

- **Backend:** Laravel
- **Frontend:** Next.js
- **Database:** MySQL
- **Real-time Data Communication:** Pusher
- **Email Notifications:** Mailtrap

## Setup

Follow these steps to run the project on your local machine.

### Backend

1. Clone or download the project.
2. Navigate to the `newsapp-backend` folder.
3. Run `composer install` to install dependencies.
4. Copy `.env.example` to `.env` and configure the necessary settings (database connection, mail configuration, Pusher API keys, etc.).
5. Create your database and specify its name in the `.env` file.
6. Generate an application key with `php artisan key:generate`.
7. Create the database schema with `php artisan migrate`.
8. Populate the database with sample news data using `php artisan db:seed`.
9. Start the Laravel server with `php artisan serve`.

### Frontend

1. Navigate to the `newsapp` folder.
2. Run `npm install` to install dependencies.
3. Start the Next.js server with `npm run dev`.
4. Open `http://localhost:3000` in your browser to start using the application.

### Real-time Features Setup
This project uses Laravel WebSockets to handle real-time data communication. To enable real-time features in your local development environment:

1.  After starting the Laravel server, open a new terminal tab or window.
2.  Navigate to your project's newsapp-backend directory.
3.  Run php artisan websockets:serve to start the WebSocket server.
4.  Keep this terminal window running to maintain the WebSocket connection.
  
### Scheduled Tasks Setup

This project utilizes Laravel's task scheduling to send daily summaries and perform other time-based operations. To enable this feature:

1. Ensure you have added a cron entry on your server. Open your terminal and run `crontab -e`.
2. Add the following line, replacing `/path/to/your/project` with the actual path to your Laravel project:
   
   '* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1'

3. This cron job checks and runs scheduled tasks every minute, according to the schedule defined in your Laravel application.

## Features

- Listing of news articles and viewing their details
- Adding new news articles, updating existing ones, and deleting them
- Real-time addition of news articles to the list
- Sending email notifications when a new news article is added
  
## Notes

- Upon the first launch, sample news data added by `php artisan db:seed` will be displayed.
- You can use Postman or a similar API testing tool for CRUD operations.
- Mailtrap is used for testing email notifications. It should be replaced with a real mail service for production.
- Scheduled tasks (like sending a daily news summary) require setting up a cron job. See the "Scheduled Tasks Setup" section for instructions.
