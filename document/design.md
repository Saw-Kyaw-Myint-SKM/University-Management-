# University Management System Design Document

## System Architecture

The system follows MVC architecture.

Flow:

Controller
↓
Service Layer
↓
Model
↓
Database

---

# Frontend Design

## Technologies

- TailwindCSS
- Alpine.js
- Blade Templates

## Layout Structure

- Sidebar Navigation
- Top Navbar
- Dashboard Cards
- Responsive Tables
- Modal Forms

---

# Backend Design

## Framework

- Laravel 9

## Backend Structure

app/
├── Http/
├── Models/
├── Services/
├── Policies/
├── Providers/
├── Notifications/
└── Helpers/

---

# Database Design

## Core Tables

- users
- roles
- faculties
- departments
- courses
- students
- teachers
- admissions
- enrollments
- exams
- exam_questions
- exam_results
- attendance
- notifications
- settings
