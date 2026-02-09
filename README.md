# Desk Support – Helpdesk Ticketing System

A simple Helpdesk / Support Ticket system built with Laravel and Tailwind CSS.  
This project allows users to create support tickets and admins to manage, reply, and update ticket status and priority.

## 🚀 Features

- User authentication (Register & Login)
- Create support tickets
- Admin dashboard:
  - View and manage tickets
  - Reply to users
  - Update ticket status (Open / Closed)
  - Set ticket priority (Low / Medium / High)
- Conversation-style ticket replies
- Flash toast notifications
- Role-based access (Admin & User)

## 🛠 Tech Stack

- Laravel (PHP)
- Blade Templates
- Tailwind CSS
- Alpine.js
- MySQL

## ⚙️ Setup

```bash
git clone https://github.com/EmilliaSholaja/desk-support.git
cd desk-support
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
