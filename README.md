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

**__constructor()**

Creates a new instance of the `Request` class.

Arguments:

* `$caddyHost` - _string_: The address where the [Caddy config endpoint](https://github.com/caddyserver/caddy/wiki/v2:-Documentation#admin) is listening.

**addHost()**

Sends a request to Caddy to add the given host.

Arguments:

* `$host` - _string_: The host to add.

Returns:

* `Response` - The response from Caddy wrapped in a `Response` instance.

**http()**

Adds the http path, "/apps/http", to the request URI.

No arguments.

Returns:

* `Request` - The request instance (allows chaining).

**server()**

Adds the server path, "/servers/{server}", to the request URI.

Arguments:

* `$server` - _string_: The name of the server to target.

Returns:

* `Request` - The request instance (allows chaining).

**route()**

Adds the route path, "/routes/{routeIndex}", to the request URI.

Arguments:

* `$routeIndex` - _int_: The route to target.

Returns:

* `Request` - The request instance (allows chaining).

**match()**

Adds the match path, "/match/{matchIndex}", to the request URI.

Arguments:

* `$matchIndex` - _int_: The match to target.

Returns:

* `Request` - The request instance (allows chaining).

**sendRequest()**

Sends the built request to the Caddy server.

Arguments:

* `$method` - _string_: The method for the request.
* `$body` - _array|nuullable_: The request body to send to Caddy.

Returns:

* `Response` - A new instance of a `Response` instance.

### Response

**__constructor()**

Creates a new instance of the `Response` class.

Arguments:

* `$response` - _ResponseInterface_: Instance of a `ResponseInterface` (created by Guzzle).

**getBody()**

Returns the response body as a string.

No arguments.

**isSuccessful()**

Returns a boolean indicating if the request was successful. Status codes of 200 or 201 are considered successful, everything else is not.

No arguments.