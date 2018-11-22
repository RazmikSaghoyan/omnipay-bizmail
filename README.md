# Omnipay: Bussines mail.ru Getway

**Bussines mail.ru gateway for Omnipay payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements Bizmail support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:


```json
{
    "require": {
        "razmiksaghoyan/omnipay-bizmail": "dev-master"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require razmiksaghoyan/omnipay-bizmail

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize Bizmail gateway and make a purchase:

```php

    $gateway = Omnipay::create('Bizmail');
    $gateway->setType(env('type'));
    $gateway->setKind(env('kind'));
    $gateway->setAmount(10); // Amount to charge
    $gateway->setCurrency('RUB'); // Currency
    $gateway->setBizProjectId('Your biz Project Id'));
    $purchase = $gateway->purchase()->send();
    
    if ($purchase->isSuccessful()) {
        // Do your logic
    } else {
        throw new Exception($purchase->getMessage());
    }
    
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/RazmikSaghoyan/omnipay-bizmail/issues),
or better yet, fork the library and submit a pull request.
