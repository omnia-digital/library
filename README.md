# Omnia Library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omnia-digital/library.svg?style=flat-square)](https://packagist.org/packages/omnia-digital/library)
[![Total Downloads](https://img.shields.io/packagist/dt/omnia-digital/library.svg?style=flat-square)](https://packagist.org/packages/omnia-digital/library)

A comprehensive Laravel Livewire component library with UI components, traits, and third-party integrations.

## Requirements

- PHP 8.2+
- Laravel 10.x or 11.x
- Livewire 2.10+ or 3.x

## Features

### Livewire Traits

Reusable traits to add common functionality to your Livewire components:

- **WithModal** - Modal dialog management
- **WithNotification** - Toast and notification handling
- **WithSorting** - Data sorting functionality
- **WithCachedRows** - Row caching for improved performance
- **WithStepWizard** - Multi-step wizard navigation
- **WithStripe** - Stripe payment integration
- **WithPlace** - Google Places & Mapbox location picker
- **WithMap** - Interactive map functionality
- **WithLayoutSwitcher** - Grid/list layout toggling
- **WithInlineInput** - Inline editing support
- **WithValidationFails** - Enhanced validation error handling

### Blade Components

Ready-to-use UI components:

- **Layout** - Dropdown, Card, Tag, Notification, Confirm dialog
- **Forms** - Text input, Date picker, Select, Radio group, Email, Range slider
- **Integrations** - Place picker, Stripe payment fields, Media manager

### Rich Text Editor

TipTap-powered rich text editor with:

- Extensive toolbar configuration
- Bubble and floating menus
- Tables, code blocks, and formatting options

### Third-Party Integrations

- Google Places API
- Mapbox API
- Stripe Payments
- Canva Button API

## Installation

Install the package via composer:

```bash
composer require omnia-digital/library
```

Publish the package assets:

```bash
php artisan vendor:publish --tag="library-assets"
```

Include the assets in your layout:

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

Configure Tailwind CSS in `tailwind.config.js`:

```js
module.exports = {
    content: [
        ...
        './vendor/omnia-digital/library/resources/views/**/*.blade.php',
    ]
};
```

## Optional Configuration

### Config File & Views

Publish the config file:

```bash
php artisan vendor:publish --tag="library-config"
```

Publish the views for customization:

```bash
php artisan vendor:publish --tag="library-views"
```

### Alpine.js Plugins

This package uses **focus** and **collapse** plugins. Add them to your `resources/js/app.js`:

```js
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

Alpine.plugin(focus)
Alpine.plugin(collapse)

window.Alpine = Alpine;

Alpine.start();
```

## Media Manager

To use the Media Manager component, install the companion package: [omnia-digital/media-manager](https://github.com/omnia-digital/media-manager)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Omnia Church Apps](https://omnia.church)
- [All Contributors](../../contributors)

## Support

For questions and support, visit [omnia.church](https://omnia.church) or email [info@omnia.church](mailto:info@omnia.church).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
