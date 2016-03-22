Behat-Magento2RestapiConnectorExtension
=========================

Behat-Magento2RestapiConnectorExtension provide access to magento 2 rest api.

Installation
------------

Install by adding to your `composer.json`:

```bash
composer require --dev bex/behat-magento2-restapi-connector
```

Configuration
-------------

Enable the extension in `behat.yml` like this:

```yml
default:
  extensions:
    Bex\Behat\Magento2RestapiConnectorExtension:
      api_url: yourbaseurl # e.g. mysite.com/rest
      api_user: apiuser
      api_password: apipass
```
