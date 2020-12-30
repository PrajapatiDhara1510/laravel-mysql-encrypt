# Laravel MySql AES Encrypt/Decrypt

[![Latest Stable Version](https://poser.pugx.org/chr15k/laravel-mysql-encrypt/v)](//packagist.org/packages/chr15k/laravel-mysql-encrypt) [![Latest Unstable Version](https://poser.pugx.org/chr15k/laravel-mysql-encrypt/v/unstable)](//packagist.org/packages/chr15k/laravel-mysql-encrypt) [![Total Downloads](https://poser.pugx.org/chr15k/laravel-mysql-encrypt/downloads)](//packagist.org/packages/chr15k/laravel-mysql-encrypt) [![License](https://poser.pugx.org/chr15k/laravel-mysql-encrypt/license)](//packagist.org/packages/chr15k/laravel-mysql-encrypt)

Laravel database encryption at database side using native AES_DECRYPT and AES_ENCRYPT functions.
Automatically encrypt and decrypt fields in your Models.

## Install
### 1. Composer
```bash
composer require chr15k/laravel-mysql-encrypt
```

### 2. Publish config (optional)
```bash
php artisan vendor:publish --provider="Chr15k\MysqlEncrypt\MysqlEncryptServiceProvider"
```

### 3. Configure Provider (Laravel 5.4 or earlier)
For Laravel 5.4 or earlier, you'll need to add the following to config/app.php:

```php
'providers' => array(
    Chr15k\\MysqlEncrypt\\MysqlEncryptServiceProvider::class
)
```

### 4. Set encryption key in `.env` file
```
APP_AESENCRYPT_KEY=yourencryptionkey
```

## Update Models
```php
<?php

namespace App;

use Chr15k\MysqlEncrypt\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Encryptable; // <-- 1. Include trait

    protected $encryptable = [ // <-- 2. Include columns to be encrypted
        'email',
        'first_name',
        'last_name',
        'telephone',
    ];
}
```

## Schema columns to support encrypted data
```php
Schema::create('users', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});

// Once the table has been created, use ALTER TABLE to create VARBINARY
// or BLOB types to store encrypted data.
DB::statement('ALTER TABLE `users` ADD `first_name` VARBINARY(300)');
DB::statement('ALTER TABLE `users` ADD `last_name` VARBINARY(300)');
DB::statement('ALTER TABLE `users` ADD `email` VARBINARY(300)');
DB::statement('ALTER TABLE `users` ADD `telephone` VARBINARY(50)');
```

## Lumen support
Add the following to `bootstrap/app.php`:
```php
$app->register(Chr15k\MysqlEncrypt\Providers\LumenServiceProvider::class);
```

## License
The MIT License (MIT). Please see [License File](https://github.com/chr15k/laravel-mysql-encrypt/blob/master/LICENSE) for more information.
