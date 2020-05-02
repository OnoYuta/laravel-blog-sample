<p><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# laravel-blog-sample

Sample blog project featuring many basic and general topics of Laravel 6.x.

## Topics

This project is featuring many basic and general topics like below:

* Continuous integration(CircleCI/PHPUnit/Dusk/ChromeDriver)
* Infrastructure as code(Docker/DockerHub/DockerCompose)

## Environments

This project uses the following technologies and versions:

- PHP 7.4
- Laravel 6.x
- MySQL 8.0
- nginx 1.17
- Docker 19.03.5
- docker-compose 1.25.4
- Circle CI 2.1

## Directory structure

This project has the following directory structure:

```bash
.
├── app # Laravel controller, model, routing, etc.
│   ├── Console # Laravel CLI files
│   ├── Events
│   │   └── Frontend
│   │       └── Auth
│   ├── Exceptions
│   │   └── Backend
│   │       └── Access
│   ├── Http # Controller, middleware, request and other core parts of the application
│   │   ├── Breadcrumbs
│   │   ├── Controllers
│   │   │   ├── Backend # Admin controller
│   │   │   ├── Frontend # Front controller
│   │   │   └── Language
│   │   ├── Middleware # Laravel middleware (authentication, etc.)
│   │   └── Requests
│   │       ├── Backend # Admin Request processing
│   │       └── Frontend # Front Request processing
│   ├── Jobs # Queue processing
│   ├── Listeners
│   │   └── Frontend
│   ├── Models
│   ├── Policies
│   ├── Providers
│   ├── Repositories
│   │   ├── Backend　# Admin repository
│   │   └── Frontend # Front Repository
│   └── Services
├── bootstrap
│   └── cache
├── config
├── database
│   ├── config
│   ├── factories # Factory for database
│   ├── migrations # migration file
│   └── seeds # DB initialization file
├── public
│   ├── build
│   │   ├── css
│   │   ├── fonts
│   │   └── js
│   ├── css
│   └── js
├── resources
│   ├── assets
│   │   ├── css
│   │   │   ├── backend
│   │   │   └── frontend
│   │   ├── js
│   │   │   ├── backend
│   │   │   └── frontend
│   │   ├── less
│   │   │   ├── backend
│   │   │   └── frontend
│   │   └── sass
│   │       ├── backend
│   │       └── frontend
│   ├── lang
│   │   ├── en
│   │   ├── es
│   │   ├── fr-FR
│   │   ├── it
│   │   ├── pl
│   │   ├── pt-BR
│   │   ├── ru
│   │   └── sv
│   └── views
│       ├── backend
│       │   ├── access
│       │   ├── includes
│       │   ├── lang
│       │   └── layouts
│       ├── emails
│       ├── errors
│       ├── frontend
│       │   ├── auth
│       │   ├── event
│       │   ├── includes
│       │   ├── layouts
│       │   └── user
│       └── includes
│           └── partials
├── routes # routing
│   ├── Frontend # Front routing
│   └── Backend # Admin routing
└── tests
    └── Browsers # E2E test
```

## License

Sample blog project is released under the [MIT license](https://opensource.org/licenses/MIT).
