# 🎫 SupportDesk – Laravel Ticketing System

SupportDesk is a simple support ticket management system built with Laravel.  
It allows users to create tickets, upload attachments, and communicate with admins in a chat-like interface.  
Admins can manage tickets, update status & priority, and respond to users.

---

## 🚀 Features

### 👤 User
- Register & Login
- Create support tickets
- Upload attachments
- View ticket status
- Chat with admins (Read more / Read less UI)

### 🛠 Admin
- View all tickets
- Reply to tickets
- Change ticket status (Open / Closed)
- Change priority (Low / Medium / High)
- Admin-only dashboard & routes (protected by middleware)

---

## 🧰 Tech Stack

- **Backend:** Laravel 12
- **Frontend:** Blade + Tailwind CSS
- **Interactivity:** Alpine.js
- **Database:** MySQL
- **Auth:** Laravel Auth
- **Storage:** Local file storage (attachments)

---

## ⚙️ Installation (Local Setup)

```bash
git clone https://github.com/yourusername/support-desk.git
cd support-desk

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
