# Laravel 5 Notifications

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

This package provides a simple but powerful way to incoporate flash notifications into your Laravel application.

This package includes both the server-side code for creating flash messages, and client-side code to interact with and dynamically create notifications.

## Requirements

The JavaScript requires jQuery 2.x or later.

By default, this packages uses Bootstrap and Font Awesome, although alternative providers can be configured.

## Installation

To install, either run

``` bash
$ composer require bnjns/laravel-notifications
```

or add the following to the `require` section of your `composer.json` file:

```
"bnjns/laravel-notifications": "dev-master"
```

## Setup
 
1. Add the following to the `providers` entry in `config/app.php`:
    ``` php
    bnjns\LaravelNotifications\NotificationServiceProvider::class,
    ```
2. Add the following to the `aliases` entry to use the Facade:
    ``` php
    'Notify' => bnjns\LaravelNotifications\Facades\Notify::class,
    ```
3. Run the following to publish the package's views:
	``` bash
	$ php artisan vendor:publish --provider="bnjns\LaravelNotifications\NotificationServiceProvider"
	```
	
**Note:** Steps 1 and 2 are not required for Laravel 5.5+.

## Configuration

Most aspects of the package can be customised with the including `config/notifications.php` file.

* `timeout` sets how long automatic notifications should be visible for before fading out
* `classes.provider` sets the "provider" for the styling of the notification - this is used to set the correct class prefix for each notification level
* `classes.levels` sets which class to use for each notification level
* `icons.provider` sets the "provider" for the styling of the icons - this is used to set the correct icon class prefix for each notification level
* `icons.levels` sets which icon class to use for each notification level
* `icons.close` sets the icon class for the close button

### Blade template

To customise the Blade template simply modify `vendor/laravel-notifications/notification.blade.php`.

You can customise this as much as you want. The notification will be passed to the view as an associative array, with the following elements available:

* `level`
* `title`
* `message`
* `class` with the provider prefix
* `icon` with the provider prefix
* `attributes` as a string

## Usage

### Including the assets

The assets are no longer publishable. If you wish to use the styling or script that's included with the package, please include them in your `webpack.mix.js` file.

### Including the configuration

If you wish to be able to dynamically create notifications, please ensure you include the configuration so that the plugin can correctly format the notifications.

To include the config, simply call `{!! Notify::config() !!}` at the end of your `<body>`. This creates a `NotificationConfig` object in `<script>` tags.

### Creating notifications

You can create notifications of the following types:

* info
* success
* warning
* error

To create a notification, simply call the relevant method:

``` php
Notify::info('Your info message');
Notify::success('Your success message');
Notify::warning('Your warning message');
Notify::error('Your error message');
```

If you wish to include a title, pass that as the second parameter:

``` php
Notify::info('Your info message', 'Info title');
Notify::success('Your success message', 'Success title');
Notify::warning('Your warning message', 'Warning title');
Notify::error('Your error message', 'Error title');
```

### Modifying notifications

When you create a notification, the notification object is returned so that you can modify it later.

``` php
$notification = Notify::info('An example info message');
$notification->success() // Changes to a success notification
```

Methods you can call on a notification:

* `$notification->info()` to change to an information notification
* `$notification->success()` to change to a success notification
* `$notification->warning()` to change to a warning notification
* `$notification->error()` to change to an error notification
* `$notification->title('Notification title')` to change the notification title
* `$notification->message('Notification message')` to change the notification message

### Setting attributes

If you want to set a specific HTML attribute of the notification element (such as the ID), simply call the `attribute()` method:

``` php
$notification->attribute('name', 'value');
```

### Notification bags

This package allows you to split your notifications into different lists, or "bags". This means you can output different notifications in different parts of your webpage. 

To specify a bag, simply call the `bag()` method:

``` php
$notification->bag('bagName');
```

If you don't explicitly state a bag, notifications are placed in the `default` bag.

### Making notifications permanent

By default, all notifications are set to be automatically removed after 3 seconds. This can be changed with the `data-close` attribute:

* `data-close="auto"` notifications are automatically removed after 3 seconds
* `data-close="manual"` notifications are given a close button, which allows them to be manually removed, but they don't automatically hide
* `data-close="none"` notifications can't be removed by the user

This can be set either by manually setting the attribute, or by calling `$notification->close('closeType')`;

It is quite common to separate 'permanent' notifications (i.e. those that can only be closed manually) from the rest of the notifications. To do this, you can call `$notification->permanent()`; this sets the `close` attribute to `manual` and moves the notification to the `permanent` bag.

### Displaying the notifications

This package provides a handy method to correctly output all notifications for a bag:

``` php
{!! Notify::renderBag('bagName') !!}
```

It is recommended that you use this method, as it ensure that the notifications are correctly contained such that the jQuery plugin can dynamically add notifications to the bag.

However, if you wish, you can manually output the notifications.

### Manually outputting the notifications

This package includes several methods to help with ouputting notifications:

* `Notify::has()` checks whether there are any notifications
* `Notify::has('bag')` checks whether there are any notifications in given bag
* `Notify::get('bag')` get an array of all the notifications in the given bag
* `Notify::all()` get an array of all of the notifications, irrespective of their bag
* `Notify::bags()` get an array of all the bags with notifications

To output a notification, simple call

``` php
@include('laravel-notifications::notification')
```

Do make sure that the notification to be outputted is in a variable `$notification`. If not, you can use the following instead:

``` php
@include('laravel-notifications::notification', ['notification' => $notification_variable])
```

It is recommended that notifications are contained within a `<div>` that specifies the bag, so that the jQuery plugin can add any dynamic notifications. To create this `<div>`, call `Notify::open('bag')` before outputting the bag's notifications, and `Notify::close()` afterwards.

> The method `Notify::renderBag('bag')` is in fact a shortcut for:
``` php
{!! Notify::open('bag') !!}

@foreach(Notify::get('bag') as $notification)  
  @include('laravel-notifications::notification')  
@endforeach

{!! Notify::close() !!}
```

### Dynamically creating notifications

If you want to dynamically create a notification (after the page has been loaded) simple use the jQuery plugin:

``` javascript
$.notify({
  level: 'info',
  message: 'This is a dynamic info notification',
  title: 'Created dynamically',
  bag: 'bag'
});
```

The `title` and `bag` attributes are optional.

You can also pass an object of attributes to set:

``` javascript
$.notify({
  level: 'info',
  message: 'This is a dynamic info notification',
  attributes: {
    id: 'amazing-notification'
  },
});
```

To modify the type of notification, pass:
* `permanent: true` to make it require the user to manually remove
* `close: false` to make it so it cannot be removed by the user

## License

This package is covered by the GNU General Public License v3. See the [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/bnjns/laravel-notifications.svg?style=flat
[ico-license]: https://img.shields.io/packagist/l/bnjns/laravel-notifications.svg?style=flat


[link-packagist]: https://packagist.org/packages/bnjns/laravel-notifications
[link-author]: https://github.com/bnjns
