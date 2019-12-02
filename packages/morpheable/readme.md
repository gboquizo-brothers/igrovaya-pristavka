Morpheable attributes inheritance for Laravel 
====

Establish all attributes in children through morpheable inheritance.

# Installation

```bash
composer require gboquizo/morpheable
```

If autodiscover doesn't work, add to your `config/app.php` providers array this line:

```php
Boquizo\Inheritance\MorpheableServiceProvider::class
```

By default the package has active the inheritance. But if you want discover all options in this package.

```bash
php artisan vendor:publish --provider="Boquizo\Inheritance\MorpheableServiceProvider"
```

## TODO
