# Caddy Config PHP
Caddy v2 API helper for PHP.

![Build Status Badge](https://github.com/ohseesoftware/caddy-config-php/workflows/Build/badge.svg)

---

Caddy v2 allows you to update your Caddy configuration via a JSON API. This package is a simple helper library to update parts of your configuration.

Functionality for updating all aspects of the configuration will be added over time.

## Usage

To get started, create an instance of `OhSeeSoftware\CaddyConfig\Client`, ensuring to pass your Caddy network address as the first argument:

```php
$client = new OhSeeSoftware\CaddyConfig\Client('localhost:2019');
```

From there, you can use the `$client` instance to make API requests to your Caddy instance.

The idea behind the wrapper is that you can have a `Client` singleton class, and then use the `$client->request()` method to create new `Request` instances. You should create a new `Request` instance per HTTP request you send to your Caddy server.

## API Methods

### Client

**__constructor()**

Creates a new instance of the `Client` class.

Arguments:

* `$caddyHost` - _string_: The address where the [Caddy config endpoint](https://github.com/caddyserver/caddy/wiki/v2:-Documentation#admin) is listening.

**setCaddyHost()**

Allows you to change the Caddy host after creating the Client instance.

Arguments:

* `$caddyHost` - _string_: The address where the [Caddy config endpoint](https://github.com/caddyserver/caddy/wiki/v2:-Documentation#admin) is listening.

**request()**

Returns a new `Request` instance which you use to make configuration requests.

No arguments.

### Request


