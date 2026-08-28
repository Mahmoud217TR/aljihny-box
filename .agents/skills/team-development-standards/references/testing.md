# Testing

Adapt the source standard's architecture-driven testing strategy to this project's required PHPUnit 12 class syntax.

## Test Placement

| Subject | Test type | Location |
| --- | --- | --- |
| HTTP endpoint, Controller, FormRequest, JsonResource | Feature | `tests/Feature/{Domain}/` |
| Livewire or Filament behavior | Feature/component | `tests/Feature/{Domain}/` |
| Action | Unit with application container and database | `tests/Unit/Actions/{Domain}/` |
| Query | Unit with real PostgreSQL | `tests/Unit/Queries/{Domain}/` |
| Service | Unit | `tests/Unit/Services/` |
| Listener | Unit `handle()` plus feature dispatch assertion | `tests/Unit/Listeners/` and relevant Feature test |
| Job | Unit `handle()` plus feature dispatch assertion | `tests/Unit/Jobs/` and relevant Feature test |
| State transition | Unit | `tests/Unit/States/{Model}/` |

Use PHPUnit classes extending `Tests\TestCase`. Use `RefreshDatabase` for database-backed tests. Keep one scenario per test method and use descriptive `test_*` method names.

## Required Coverage

- Every behavior change gets a programmatic test.
- Every bug fix gets a regression test reproducing the failure.
- Critical paths require happy-path and failure coverage: authentication, authorization, payments, money, order placement, and access to another user's data.
- Endpoint tests cover the applicable happy path, validation failure, unauthenticated response, forbidden response, database state, response shape, and dispatched side effects.
- Action tests cover the result, persisted state, domain failures, events/jobs, and transaction rollback when relevant.
- Query tests cover filters, combinations, empty results, boundaries, and tenant/user scoping.

## Test Doubles

- Use `Http::fake()` for code using Laravel's HTTP client.
- Use Laravel fakes for Events, Queues, Bus, Mail, Notifications, and Storage.
- For vendor SDKs, define an application interface and bind a hand-written `Fake*` implementation from `tests/Fakes/`.
- Avoid subclass mocks of final classes and avoid asserting that an internal method was called.
- Assert observable output: HTTP response, returned value, database state, emitted event, queued job, sent notification, or thrown domain exception.

## Data Setup

- Every model created in tests has a factory.
- Prefer realistic factory defaults and named factory states over long hand-built arrays.
- Use `UploadedFile::fake()` and `Storage::fake()` for uploads.
- Freeze time per test when behavior depends on the clock, and restore it after the test.
- Tests must be deterministic and independent. Never use `sleep()` or rely on test order.

## Do Not Test

- Plain Data DTO construction.
- Laravel or Eloquent framework behavior.
- Private methods or implementation details.
- Trivial getters, setters, casts, or accessors without project logic.
- Domain exception classes in isolation; assert them where the behavior throws them.

## Commands

Create tests with:

```bash
vendor/bin/sail artisan make:test --phpunit {Name} --no-interaction
vendor/bin/sail artisan make:test --phpunit --unit {Name} --no-interaction
```

Run the narrowest affected test first:

```bash
vendor/bin/sail artisan test --compact tests/Feature/Domain/BehaviorTest.php
vendor/bin/sail artisan test --compact --filter=test_specific_behavior
```

Do not convert this project to Pest. Ask before running the full suite after focused tests pass.
