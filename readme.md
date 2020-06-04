# laravel-blog-sample

Sample blog project featuring many basic and general topics of Laravel 6.x.

## Topics

This project is featuring many basic and general topics like below:

* Continuous integration(CircleCI/PHPUnit/Dusk/ChromeDriver)
* Infrastructure as code(Docker/DockerHub/DockerCompose)
* Static code analyse(PHPStan/CircleCI)
* Coding rules check and fix automatically(PSR12/PHP_CodeSniffer)
* Email sending test(MailHog/CircleCI)
* Subdomain routing(RouteGroup)
* Multiple authentication(Guard/Middleware/Hash)
* PasswordReset(PasswordBroker)

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

## Demo

![1aebd339f99e8e053dd782ce45e75d1c](https://user-images.githubusercontent.com/49770211/83761955-f353d080-a6b1-11ea-9aa5-8838e26f15e3.gif)

![768761f34bb19eac6cd8dc340c5ba05b](https://user-images.githubusercontent.com/49770211/83762766-d966bd80-a6b2-11ea-8e72-7eaca96b52e9.gif)

## License

Sample blog project is released under the [MIT license](https://opensource.org/licenses/MIT).
