<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. It simplifies common tasks such as routing, authentication, sessions, caching, and database operations.

---

#  Mini Ticketing System (API-based)

##  Project Overview

This project is a **Mini Ticketing System API** built using **Laravel** and **Laravel Sanctum** as part of a technical task submission.

The system allows users to raise support tickets and communicate through replies, while admins manage all tickets and control their workflow using status updates.

The application follows **RESTful API principles** with secure authentication, role-based authorization, proper validation, and consistent JSON responses.

---

##  Tech Stack

- **Backend Framework:** Laravel
- **Authentication:** Laravel Sanctum (Token-based)
- **Database:** MySQL
- **API Testing:** Postman
- **Architecture:** REST API (Backend only)

---

##  User Roles

###  User
- Register & Login
- Create support tickets
- View own tickets
- Update or close tickets
- Add replies to tickets

###  Admin
- Login using the same authentication system
- View all users’ tickets
- Change ticket status (`open`, `in_progress`, `closed`)
- Add replies to tickets

Admin access is managed using an `is_admin` boolean field in the users table.

---

##  Database Structure

### Users Table
- `id`
- `name`
- `email`
- `password`
- `is_admin`

### Tickets Table
- `id`
- `user_id`
- `title`
- `description`
- `status`
- `created_at`
- `updated_at`

### Replies Table
- `id`
- `ticket_id`
- `user_id`
- `message`
- `created_at`
- `updated_at`

---

##  Authentication

- Token-based authentication using **Laravel Sanctum**
- All protected APIs require the following header:


---

##  API Endpoints

###  Authentication
- `POST /api/register` – Register user
- `POST /api/login` – Login user / admin

---

###  User Ticket APIs
- `POST /api/tickets` – Create ticket
- `GET /api/tickets` – List logged-in user tickets
- `PUT /api/tickets/{id}` – Update ticket
- `PUT /api/tickets/{id}/close` – Close ticket

---

###  Reply APIs
- `POST /api/tickets/{id}/replies` – Add reply
- `GET /api/tickets/{id}/replies` – List replies

---

###  Admin APIs
- `GET /api/admin/tickets` – List all tickets
- `PUT /api/admin/tickets/{id}/status` – Update ticket status

Allowed status values:
- `open`
- `in_progress`
- `closed`

---

##  Sample Admin Status Update

**PUT**
