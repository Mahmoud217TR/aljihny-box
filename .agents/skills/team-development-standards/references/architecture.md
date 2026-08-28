# Architecture

## Layering

Use this dependency flow:

```text
Controller / Livewire / Filament / Job / Command
                  |
          Actions (writes)   Queries (reads)
                  \           /
                    Services
                       |
             Models / HTTP / Filesystem
```

- Actions represent synchronous write use cases and expose one public `handle()` method.
- Queries represent read-only operations with meaningful complexity: three or more filters, joins, aggregates, or reuse.
- Services wrap cohesive external APIs, libraries, or internal capabilities. They do not decide business policy.
- Simple reads can remain in the entry point when they do not hide business rules or meaningful query construction.
- Eloquent is the data access layer. Do not add repositories around it.

## Naming And Placement

| Type | Location | Required suffix |
| --- | --- | --- |
| Action | `app/Actions/` | `Action` |
| Query | `app/Queries/` | `Query` |
| Service | `app/Services/` | `Service` |
| DTO | `app/Data/` | `Data` |
| Event | `app/Events/` | `Event` |
| Listener | `app/Listeners/` | `Listener` |
| Job | `app/Jobs/` | `Job` |
| FormRequest | `app/Http/Requests/` | `Request` |
| JsonResource | `app/Http/Resources/` | `Resource` |
| Controller | `app/Http/Controllers/` | `Controller` |
| Domain exception | `app/Exceptions/` | `Exception` |

Models, Concerns, states, and transitions do not take architectural suffixes. Framework contract implementations may retain required package names, such as Fortify's `CreateNewUser`.

Keep each architectural folder flat until adding an eighth file, then move all files of that type into PascalCase domain folders atomically. Never mix flat and nested files for one type. `app/Listeners/` always remains flat. Do not perform this promotion as incidental scope; request approval for the structural refactor.

## HTTP And UI Boundaries

For conventional write endpoints, use:

```text
FormRequest -> Data::from(validated input) -> Action::handle() -> Resource
```

- FormRequests own authorization, validation, messages, and input normalization.
- Data classes extend Spatie Data, are `final`, contain public readonly promoted properties, and have no validation attributes or business methods.
- JsonResources own API output formatting and never query the database.
- Controllers only adapt request input to the use case and adapt its result to a response.

Livewire and Filament do not execute through FormRequests. Use their native validation and authorization APIs at the component/page/action boundary, then construct a Data object and invoke an Action. Keep persistence and business rules out of component methods, Filament callbacks, schemas, and table actions.

## Dependency Rules

Allowed dependencies:

- Entry points may use Requests, Data, Actions, Queries, and Resources.
- Actions may use Models, Queries, Services, Events, and other Actions sparingly.
- Queries may use Models and, rarely, read-only Services.
- Listeners may use Services and Jobs.
- Services may use Models, HTTP clients, libraries, and filesystems.

Forbidden dependencies:

- Queries calling Actions or causing writes and side effects.
- Services calling Actions or Queries.
- Models containing business decisions or external side effects.
- Resources querying the database or calling Actions.
- Controllers, Livewire components, or Filament classes implementing business rules.
- `app()` or `resolve()` inside method bodies where constructor or method injection is available.

Use constructor injection for long-lived class dependencies and framework-supported method injection at entry points and job `handle()` methods. Use interfaces and fakes when a final Service needs substitution.

## Writes, Events, And Queues

- Actions are synchronous and never implement `ShouldQueue`.
- Wrap two or more related database writes in `DB::transaction()`.
- Dispatch events only after the transaction commits.
- If the response needs the work's result, perform it synchronously in the Action.
- If the response does not need the result, use an Event with one queued Listener per reaction.
- Dispatch Jobs directly for delayed, scheduled, chained, batched, bulk, or independently retryable work.
- Jobs and queued Listeners configure retries, backoff, timeout, and queue deliberately.
- Do not catch exceptions in Job or Listener `handle()` methods; use queue retries and `failed()`.

## Models And States

- Models define table configuration, explicit `$fillable`, casts, relationships, accessors, scopes, traits, and lifecycle plumbing.
- Never use `$guarded = []`.
- Keep model hooks to invariants and plumbing such as UUIDs, slugs, audit fields, and local cleanup.
- Put cross-cutting model hooks in `app/Concerns/` traits using `boot{TraitName}()`.
- Do not add Observer classes; use model hooks or Concerns.
- Use Spatie model states for three or more states or non-trivial transition rules.
- Co-locate states under `app/Models/{Model}/States/` and non-trivial transitions under `Transitions/`.
- A transition performs the atomic state change; its Action orchestrates the use case and dispatches events.

## Exceptions

- Throw domain exceptions at the source of a business-rule violation.
- Services catch specific vendor exceptions only to translate them into domain exceptions.
- Actions catch only for an explicit business fallback.
- Controllers, Queries, Jobs, and Listeners let exceptions propagate.
- Never catch `Throwable` or `Exception` broadly in business code.
- Centralize HTTP rendering and reporting in Laravel's exception configuration.

## Forbidden Patterns

- Inline controller validation for a conventional write endpoint.
- Validation attributes or business methods on Data classes.
- Query construction or persistence in a Resource.
- Business logic in controllers, Livewire components, Filament callbacks, models, or hooks.
- Action implementing `ShouldQueue`.
- Event dispatch from inside a transaction.
- One Listener performing unrelated reactions.
- Missing architectural suffix without a framework-contract reason.
- Non-final concrete class without a framework or inheritance requirement.
