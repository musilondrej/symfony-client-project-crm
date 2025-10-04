# Symfony Client Project CRM

**Symfony Client Project CRM** is a clean and modern web application built with **Symfony** and **Doctrine ORM**.  
It provides client, project, and task management features with integrated **time tracking** and **report exports**.  

Designed for small teams, agencies, and IT companies who need a structured yet simple way to manage clients, projects, and time tracking — without the overhead of enterprise systems.

---

## Features

- Client and project management  
- Task tracking with priorities and deadlines  
- Time tracking with per-project summaries  
- Export of time reports (CSV / PDF)  
- Role-based authentication (session-based login)  
- Input validation and structured error handling  
- Clean architecture with service and repository layers  
- Dockerized development setup  

---

## Tech Stack

| Component | Description |
|------------|-------------|
| **Framework** | Symfony 7 |
| **Database** | PostgreSQL / MySQL (Doctrine ORM) |
| **Frontend** | Twig templates (optional Vue integration planned) |
| **Background jobs** | Symfony Messenger |
| **Validation** | Symfony Validator component |
| **Authentication** | Symfony Security (session-based) |
| **Environment** | Docker Compose (PHP-FPM, Nginx, DB, Mailhog) |
| **Testing** | PHPUnit / Pest |
| **Static analysis** | PHPStan (level 8) |
| **Coding standard** | PSR-12 + PHP-CS-Fixer |

---

## Project Goals

This project demonstrates a **realistic Symfony architecture** that balances simplicity, maintainability, and scalability.

- Domain-driven structure (Domain / Application / Infrastructure)  
- Repository and service layers  
- Dependency injection and clean configuration  
- Validation and serialization  
- Event-driven features (e.g., report exported event)  
- Modular, testable codebase with clear separation of concerns  

---

## Installation

### Requirements

- PHP 8.2+  
- Composer  
- Symfony CLI (optional)  
- Docker and Docker Compose  

### Steps

```bash
git clone https://github.com/musilondrej/symfony-client-project-crm.git
cd symfony-client-project-crm

# Install dependencies
composer install

# Copy environment variables
cp .env.example .env

# Start Docker containers
docker-compose up -d

# Run migrations
php bin/console doctrine:migrations:migrate

# Start development server
symfony serve -d
```

The application should now be accessible at `http://localhost:8000`.
