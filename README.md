# CREATE PROJECT LARAVEL
## Installing laravel using composer
command for create laravel project
```sh
composer create-project laravel/laravel [NAME_OF_PROJECT]
# example:
# composer create-project laravel/laravel laravel-clinicmobile-backend
```

## Create DB
and then create db. you can create on tableplus. example fic21-clinic-db

## Configure File .env
edit file .env in root directory
```conf
# ------- BEFORE -------
APP_TIMEZONE=UTC
APP_URL=http://localhost

....

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

# ------- AFTER -------
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://127.0.0.1:8000   

....

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fic21-clinic-db
DB_USERNAME=root
DB_PASSWORD=[....password....]
```

## Configure APP_KEY
in this [link](https://laravel.com/docs/11.x/encryption#configuration)

```txt
Before using Laravel's encrypter, you must set the key configuration option in your config/app.php configuration file. This configuration value is driven by the APP_KEY environment variable. You should use the php artisan key:generate command to generate this variable's value since the key:generate command will use PHP's secure random bytes generator to build a cryptographically secure key for your application. Typically, the value of the APP_KEY environment variable will be generated for you during Laravel's installation.
```

run this command: 
```sh
php artisan key:generate
```

## Configure Public Disk
in laravel, we have to set-up [public-disk](https://laravel.com/docs/11.x/filesystem#the-public-disk). this directory can access by user. run this command:
```sh 
php artisan storage:link
```

## Check Project can connect to DB
this command will trigger file migration and modify your table/data in database. run this command:
```sh
php artisan migrate
```

## Run Local Server
to run project laravel in local, use this command:
```sh
php artisan serve
```

# FILAMENT PHP
[Filament](filamentphp.com) is a framework to accelerated laravel development because this is a collection of beautiful full-stack components. The perfect starting
point for your next app.

[docs](https://filamentphp.com/docs)

## Install filament in project
You can install filament with this command:
```sh 
composer require filament/filament:"^3.2" -W
```

### Panel Builder
You can install filament-panel with this command:
```sh
php artisan filament:install --panels
# and then fill ID. example `admin`
```

<img src="images/01-install-filament-panel.png"/>

This command will create panel provider, and modify file providers.php

<img src="images/02-result-install-filament-panel.png" height="60px"/>

and then you have to create filament user to login, with this command:
```sh
php artisan make:filament-user
```

<img src="images/02.panel-user.png" height="170px"/>

and then access in the browser. [url]/admin (in this case http://127.0.0.1:8000/admin/login)
<img src="images/02.panel-login.png"/>

after login, will direct to dashboard/panel
<img src="images/02.panel-after-login.png"/>

### Resources
**Resources** are static classes that are used to build CRUD interfaces for your Eloquent models. They describe how administrators should be able to interact with data from your app - using tables and forms.

#### Create Migration File
We have to create file migration (example: create table clinics) with command pallete `Artisan: make migration`

<img src="images/03.artisan-make-migration-1.png" height="60px"/>

and then fill migration name. example: `create clinics table`

<img src="images/03.artisan-make-migration-2.png" height="60px"/>

choose `Yes` because we will create a table
<img src="images/03.artisan-make-migration-3.png" height="60px"/>

fill the name of table. example: `clinics`
<img src="images/03.artisan-make-migration-4.png" height="60px"/>

#### Create Model File
We have to create file model. run this command:
```sh
php artisan make:model [NAME_OF_MODEL] -m

# example: Clinic
php artisan make:model Clinic -m
```

And we have to add variable fillable in the model Clinic.

<img src="images/04.model-clinic.png" width="200" height="200"/>

#### Run Filament Resources
And then we create resources with command:
```sh 
php artisan make:filament-resource [NAME_OF_MODEL] --generate

# example: Clinic
php artisan make:filament-resource Clinic --generate
```

<img src="images/05.resource-clinic.png" height="60px"/>

will generate files:

<img src="images/05.resource-clinic-result.png" width="200" height="200"/>

ui will show like:

<img src="images/05.resource-clinic-web.png"/>


# CREATE API
## Create API controller
If you want to create api. you have to create controller based on features

example `UserController` to handle about user / authentication

```sh
php artisan make:controller [NAME_OF_CONTROLLER]
# example:
php artisan make:controller Api/UserController
```


## Add api authentication using sanctum
Sanctum will handle about api authentication. [sanctum](https://laravel.com/docs/11.x/sanctum#main-content)

run this command
```sh
php artisan install:api
```

add `HasApiTokens` in model user 
```php
// before
use HasFactory, Notifiable;

// after
use HasFactory, Notifiable, HasApiTokens;
```

###  add access filament user in website

modify in model user
```php
// before
class User extends Authenticatable

// after
class User extends Authenticatable implements FilamentUser
```

and add this method
```php
# change yourdomain.com with your domain. example @fic21.com
public function canAccessPanel(Panel $panel): bool
{
    if ($panel->getId() === 'admin') {
        return str_ends_with($this->email, '@fic21.com');
    }
}
```

### Add route api
```php
//login
Route::post('/login', [UserController::class, 'login']);

//user/check

Route::post('/user/check', [UserController::class, 'checkUser'])->middleware('auth:sanctum');
//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
//store
Route::post('/user', [UserController::class, 'store']);
//get user
Route::get('/user/{email}', [UserController::class, 'index']);
//update google id
Route::put('/user/googleid/{id}', [UserController::class, 'updateGoogleId']);
//update user
Route::put('/user/{id}', [UserController::class, 'update']);
```
-------------------------------------------
# MEET 3 (19 Des 2024) - FIC21 
Zoom 3: Laravel API Doctors & Orders and Integration with Xendit Payment Gateway








-------------------------------------------
# MEET 4 (20 Des 2024)
-------------------------------------------
- Create new project flutter
- Delete folder windows, macos, linux
- copy assets and file in folder lib from template
- adjust nama package di `import` file" tersebut

## Login with google
to login with google
https://firebase.google.com/docs/flutter/setup

1. install [firebase CLI](https://firebase.google.com/docs/cli#setup_update_cli)
   - install nodejs [link](https://nodejs.org/en)
   - run `npm install -g firebase-tools`
2. run `firebase login`
3. run `dart pub global activate flutterfire_cli`
4. create project on [firebase console](https://console.firebase.google.com/) 

<img src="images/06.create-project-firebase.png" width="200px"/>
   
5. add firebase core, run command `flutter pub add firebase_core`
6. add firebase auth, run command `flutter pub add firebase_auth`
7. enable authentication in firebase console
    - choose menu authentication

<img src="images/07.choose-menu-authentication-1.png" width="200px"/>

    - click get started

<img src="images/07.choose-menu-authentication-2.png" width="200px"/>

    - click get icon google

<img src="images/07.choose-menu-authentication-3.png" width="200px"/>

    - enable features and choose support email

<img src="images/07.choose-menu-authentication-4.png" width="200px"/>

8. add google_sign_in flow [link](https://firebase.google.com/docs/auth/flutter/federated-auth). add google sign in package, run command `flutter pub add google_sign_in`
9. connect the apps to the project firebase, run `flutterfire configure`
    - choose project firebase
10.  add firebase plugin on project apps in `main.dart`

<img src="images/08.add-firebase-core.png"/>

11.  add method `signInWithGoogle` in login / onboarding screen

<img src="images/09.method-login-google.png"/>

12.  adjust build.gradle and settings.gradle

adjust compileSdk, ndkVersion, minSdk, targetSdk

<img src="images/10.adjust-build-gradle.png"/>

adjust kotlin version

<img src="images/10.adjust-settings-gradle.png"/>

13. run project apps

<img src="images/11.result-sign-in-google.png" width="200px"/>
