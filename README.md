# Laravel-Vue SPA 

<a href="https://travis-ci.org/cretueusebiu/laravel-vue-spa"><img src="https://travis-ci.org/cretueusebiu/laravel-vue-spa.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/cretueusebiu/laravel-vue-spa"><img src="https://poser.pugx.org/cretueusebiu/laravel-vue-spa/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/cretueusebiu/laravel-vue-spa"><img src="https://poser.pugx.org/cretueusebiu/laravel-vue-spa/v/stable.svg" alt="Latest Stable Version"></a>

Fork differences can be found at the bottom of the document
> A Laravel-Vue SPA starter project template.

<p align="center">
<img src="https://i.imgur.com/NHFTsGt.png">
</p>

## Features

- Laravel 6.0
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Login, register, email verification and password reset
- Authentication with JWT
- Socialite integration
- Bootstrap 4 + Font Awesome 5

## Installation

- `composer create-project --prefer-dist cretueusebiu/laravel-vue-spa`
- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate`
- `npm install`

## Usage

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```

## Socialite

This project comes with GitHub as an example for [Laravel Socialite](https://laravel.com/docs/5.8/socialite).

To enable the provider create a new GitHub application and use `https://example.com/api/oauth/github/callback` as the Authorization callback URL.

Edit `.env` and set `GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET` with the keys form your GitHub application.

For other providers you may need to set the appropriate keys in `config/services.php` and redirect url in `OAuthController.php`.

## Email Verification

To enable email verification make sure that your `App\Models\User` model implements the `Illuminate\Contracts\Auth\MustVerifyEmail` contract.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Fork differences

This is not an exhaustive list of changes
Only the major notable changes.

**FRONTEND**
 - Removed bootstrap
 - Removed popper.js
 - Removed jQuery
 - Removed fontawesome
 - Removed SweetAlert2
 - Added layout helpers
 - Added base styles
 - Updated error component
 - Added tailwindcss
 - Added material design icons
 - Added vue toastify
 - Updated styling throughout
 - Implemented frontend roles/permissions

***

**BACKEND**
- Added LaravelEnum package and 2 general enum list
- Added testing utilities
- Added transform keys middleware and its tests
- Added collection macros
- Added helpful traits
- Added install script
- Updated User model to include first and last name
- Moved models into Models/ directory
- Added StrongPassword rule
- Added base model
- Added spatie permissions

