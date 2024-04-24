### Job Listings Application

### Architecture

Model-View-Controller

### Language

PHP 8.3.6

### Framework

Laravel 11.4.0

### Database

Production: MySQL 8.0.36

Develop: SQLite 3.37.2

### Developer Setup & Configuration

#### Clone the repository
`git clone git@github.com:svnblame/lara11app.git`

#### Install dependencies
`composer install`

#### Spin up local development environment as a background process
`vendor/bin/sail up -d`

#### Run data migrations for local development
`sail artisan migrate`

To seed with test data run `sail artisan migrate --seed`

### Last Updated
Author: Gene Kelley
Date: Wed, Apr 24, 2024
