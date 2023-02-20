
# ShortUrl documentation

## Structure

All versions are in the `Version\[version number]` namespace, within the `version` directory

A new version should be created on any breaking change to the api

New versions should extend the previous versions using inheritance to expand  or modify behaviour

## Source code

### Auth

- `AuthToken` interface
  - `ParenthesisAuthToken` implementation
    - checks a parenthesis token is valid

### Http

#### Controllers

- `Api\ApiController`
  - serves as base for all api controllers
- `Api\ShortUrlController`
  - controller for `/api/[version number]/short-urls` endpoint

#### Middleware

- `AuthenticateToken`
  - checks bearer token in current request is valid
- `JsonHeaderMiddleware`
  - force laravel to issue json response

#### Requests

- `ShortenUrlRequest`
  - validates the request for `ShortUrlController@shortenUrl`

### Repositories

- `ShortUrlRepository` interface
    - `TinyUrlRepository` implementation

### Traits

- `AnswersJsonRequests`
  - common method shared to issue a json response
    - used by
      - `App\Http\Controllers\Api\ApiController`
      - `App\Http\Middleware\AuthenticateToken`

## Testing

Run the following command to execute tests and see code coverage

```php artisan test --coverage```

### Feature tests

- `AuthTest`
  - Tests authentication of the app
- `ShortUrlTest`
  - Tests `/api/[version number]/short-urls` endpoint

### Unit tests

- `Auth\Token`
  - Tests of `Auth\Token` implementations
- `Repositories\ShortUrl`
    - Tests of `Repositories\ShortUrl` implementations

### Postman

[Download resources/postman/ShortUrl.postman_collection.json](resources/postman/ShortUrl.postman_collection.json)

## Deployment

Deploy entire project to a server
