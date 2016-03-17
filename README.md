# WP Page Templates: View

> Provides functinos for registering a page template in a plugin.


## Getting Started

The easiest way to install this package is by using composer from your terminal:

```bash
composer require moxie-leean/wp-page-templates --save
```

Or by adding the following lines on your `composer.json` file

```json
"require": {
  "moxie-leean/wp-page-templates": "dev-master"
}
```

This will download the files from the [packagist site](https://packagist.org/packages/moxie-leean/wp-page-templates) 
and set you up with the latest version located on master branch of the repository. 

After that you can include the `autoload.php` file in order to
be able to autoload the class during the object creation.

```php
include '/vendor/autoload.php';
```

## Usage

Has just 1 function.

### Register

Registers a new template. Takes the slug and name as arguments. Eg:

```php
\Leean\PageTemplates::register('training', 'Training');
```
