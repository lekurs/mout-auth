# Laravel-Auth

Laravel-auth provide ready-to-use authentication and allow you to easily customize the code published in your controllers

## Installation

Laravel-auth is installed via the package manager composer

``composer require mout/auth``

you must then publish all the files via the command ``php artisan mout-auth:install``

Then you have to install the packages necessary for the proper functioning of the frontend

Via npm :

``npm i tailwindcss @tailwindcss/aspect-ratio @tailwindcss/forms @tailwindcss/jit @tailwindcss/typography alpinejs``

Via Yarn :

``yarn add tailwindcss @tailwindcss/aspect-ratio @tailwindcss/forms @tailwindcss/jit @tailwindcss/typography alpinejs``

It is also necessary to modify the configuration file of Tailwindcss

Note: you don't have to use Tailwindcss. You will have to modify the views in the folder ``resources/views/vendor/laravel-auth``.

```javascript
//tailwind.config.js
const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')
module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './packages/**/*.blade.php',
        './packages/**/*.js',
        './packages/**/*.vue',
    ],
    darkMode: 'media',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                teal: colors.teal,
                cyan: colors.cyan,
                'light-blue': colors.lightBlue,
                'blue-gray': colors.blueGray,
                'cool-gray': colors.coolGray,
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
}

```

You can also modify the ``webpack.mix.js`` file to include Tailwind

```javascript
mix.js('resources/js/app.js', 'public/js')
mix.postCss('resources/css/app.css', 'public/css').options({
    postCss: [
        require('@tailwindcss/jit'),
        require('autoprefixer')
    ],
});
mix.sourceMaps()
mix.disableNotifications()
```

You can then start the build of your application with the command ``npm run watch``

```php
Route::group(['middleware' => 'web'], function () {
    Route::view('privacy', 'pages.statics.privacy')->name('privacy');
    Route::view('terms', 'pages.statics.terms')->name('terms');

    Route::group(['middleware' => 'guest', 'prefix' => ''], function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    Route::group(['middleware' => 'auth', 'prefix' => ''], function () {
        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('verify-email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
```
