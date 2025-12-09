# Plateforme Doctorale

A comprehensive web-based management system for PhD students (doctorants) built with Laravel 9 and Livewire.

## Overview

**Plateforme Doctorale** enables PhD students to:
- Manage their academic profile with bilingual support (French/Arabic)
- Track thesis information with supervisor and laboratory details
- Publish and manage research articles and conference communications
- Submit annual re-inscriptions with automated PDF receipt generation
- Switch between French and English interface languages

## Technology Stack

- **Framework**: Laravel 9.52.21
- **PHP**: 8.0.30
- **Database**: MySQL
- **Frontend**: Livewire 2.x for reactive components
- **PDF Generation**: DomPDF (barryvdh/laravel-dompdf)
- **Authentication**: Laravel Sanctum + Google OAuth (Laravel Socialite)
- **UI Components**: PowerGrid for data tables

## Features

### 🔐 Authentication
- Google OAuth integration (single sign-on)
- Traditional email/password authentication
- Secure session management

### 👤 User Profile Management
- Personal information (CIN, CNE, birth date, gender)
- Bilingual name support (French and Arabic)
- ORCID integration for researchers
- Contact information

### 🎓 Thesis Management
- Complete academic structure (CED, PED, institutions, laboratories)
- Supervisor and co-supervisor tracking
- Research topic management
- Defense timeline tracking

### 📄 Publications
- **Articles**: Research papers, conference proceedings, book chapters
- **Communications**: Conference presentations and talks
- CRUD operations with validation
- DOI and URL linking
- Export to PDF

### 📋 Re-inscription System
- Annual re-enrollment workflow
- Activity report upload (PDF)
- Thesis progress description
- Automatic PDF receipt generation
- Smart caching for fast downloads

### 🌍 Bilingual Support
- French and English interface
- Easy language switching
- All key features translated

## Installation

### Prerequisites

- PHP 8.0 or higher
- Composer 2.x
- MySQL 5.7 or higher
- Node.js and NPM

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Plateforme-Doctorale
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=plateforme_doctorale
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

7. **Compile assets**
   ```bash
   npm run dev
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   
   Open your browser and navigate to: `http://localhost:8000`

## Google OAuth Setup

To enable Google login:

1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Create a new project (or select existing)
3. Enable Google+ API
4. Create OAuth 2.0 credentials
5. Add authorized redirect URI: `http://localhost:8000/auth/google/callback`
6. Copy Client ID and Client Secret

Update `.env`:
```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

## Database Schema

The application uses 12 main tables:

### Core Tables
- `users` - User authentication and basic information
- `doctorant_profiles` - Extended PhD student profiles
- `theses` - Thesis information with academic relationships
- `articles` - Published research articles
- `communications` - Conference presentations
- `reinscriptions` - Annual re-enrollment records

### Reference Tables
- `peds` - Doctoral Study Programs
- `ceds` - Doctoral Study Centers
- `etablissements` - Academic Institutions
- `laboratoires` - Research Laboratories
- `profs` - Professors/Supervisors
- `sujets` - Research Topics

For detailed schema documentation, see the Database Schema section in the full documentation.

## Key Components

### Models
All models use Eloquent ORM with proper relationships:
- `User` - Has many articles, communications, one thesis, one profile
- `These` - Belongs to user, CED, PED, professor, laboratory, etc.
- `Article` & `Communication` - Belong to user
- `Reinscription` - Belongs to user with PDF receipt

### Controllers
- `ReinscriptionController` - Complete re-inscription workflow
- `ArticleController` - Article CRUD operations
- `CommunicationController` - Communication management
- `Auth\GoogleController` - Google OAuth authentication
- `DashboardController` - Main dashboard display
- `LanguageController` - Language switching

### Livewire Components
- `TheseForm` - Interactive thesis information form with auto-complete
- `UserProfile` - Real-time profile editor with validation
- `ArticleTable` - PowerGrid data table for articles
- `CommunicationTable` - PowerGrid data table for communications

## Security Features

- CSRF protection on all forms
- XSS prevention with Blade auto-escaping
- SQL injection prevention with Eloquent ORM
- Password hashing with bcrypt
- Authorization checks on all CRUD operations
- Session regeneration on authentication

## File Storage

Files are stored in `storage/app/public/`:
- Re-inscription reports: `reinscriptions/`
- PDF receipts: `reinscriptions/receipts/`

Access via: `http://localhost:8000/storage/path/to/file`

## Testing

Run the test suite:
```bash
php artisan test
```

## Project Structure

```
Plateforme Doctorale/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # HTTP Controllers
│   │   └── Livewire/         # Livewire Components
│   ├── Models/               # Eloquent Models
│   └── Providers/
├── database/
│   ├── migrations/           # Database Migrations
│   └── seeders/
├── resources/
│   ├── views/                # Blade Templates
│   └── lang/                 # Translations (fr, en)
├── routes/
│   └── web.php              # Web Routes
└── storage/
    └── app/public/          # File Storage
```

## Contributing

This project follows Laravel best practices:
- PSR-12 coding standards
- Proper MVC separation
- Eloquent relationships
- Request validation
- Resource controllers

## License

[Your License Here]

## Support

For issues, questions, or contributions, please contact [Your Contact Info]

## Changelog

### Version 2.0 (Current)
- Added re-inscription module with PDF receipt generation
- Implemented communications management
- Enhanced bilingual support
- Added Google OAuth authentication
- Improved UI with responsive design
- Database schema optimization

### Version 1.0
- Initial release
- Basic user management
- Thesis tracking
- Article management
