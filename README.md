# Omnia Library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omnia-digital/library.svg?style=flat-square)](https://packagist.org/packages/omnia-digital/library)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/omnia-digital/library/run-tests?label=tests)](https://github.com/omnia-digital/library/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/omnia-digital/library/Check%20&%20fix%20styling?label=code%20style)](https://github.com/omnia-digital/library/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/omnia-digital/library.svg?style=flat-square)](https://packagist.org/packages/omnia-digital/library)

Offer a bunch of components for modern web.

## Installation

You can install the package via composer:

```bash
composer require omnia-digital/library
```

Publish the package scripts:

```bash
php artisan vendor:publish --tag="library-assets"
```

Include the assets

```html
<html>
<head>
    ...
    @libraryStyles
</head>
<body>
    ...
    @libraryScripts
</body>
</html>
```

Config Tailwind CSS for all components in `tailwind.config.js`:

```js
module.exports = {
    content: [
        ...
        './vendor/omnia-digital/library/resources/views/**/*.blade.php',
    ]
};
```

## Optional Steps

## Config File + Component Views

You can publish the config file with:

```bash
php artisan vendor:publish --tag="library-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="library-views"
```

## Alpine.js Plugins

This package uses **focus** and **collapse** plugins for improving UI/UX. Consider adding it in your `resources/js/app.js`:

```js
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

Alpine.plugin(focus)
Alpine.plugin(collapse)

window.Alpine = Alpine;

Alpine.start();
```

## Usage

...

## Media Manager

To use the Media Manager component, you need to install this package first: https://github.com/omnia-digital/media-manager

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Omnia](https://github.com/omnia-digital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
