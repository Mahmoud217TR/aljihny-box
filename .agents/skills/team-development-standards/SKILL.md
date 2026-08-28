---
name: team-development-standards
description: "Use when creating, modifying, reviewing, or organizing Laravel PHP code, tests, code-quality configuration, branches, commits, or pull requests in this project. Enforces Mahmoud's Development Standards for Actions, Queries, Services, DTOs, events, listeners, jobs, controllers, FormRequests, Resources, models, PHPUnit tests, Pint, Larastan, and Git workflow while honoring this project's Laravel 13, Livewire, Filament, Sail, and PHPUnit constraints."
metadata:
  source: https://github.com/Mahmoud217TR/Development-Standards
  reviewed_commit: e5bed38346e70af57b704aa28e13df06ed3e0433
---

# Team Development Standards

Apply the locked sections of Mahmoud's Development Standards to this project. Do not infer requirements from source sections marked pending.

## Precedence

Resolve conflicts in this order:

1. The user's current request.
2. Project instructions in `AGENTS.md` and applicable `.ai/rules/` files.
3. Installed package versions and framework contracts.
4. This skill's adaptation of the team standards.
5. Nearby code conventions.

The standards define the target shape for new and deliberately refactored code. Do not expand a focused change into an unrelated migration of legacy code. Flag material drift instead.

## Project Adaptations

- Runtime: PHP 8.5, Laravel 13, PostgreSQL.
- UI: Livewire 4, Flux 2, and Filament 5. Treat their components, pages, resources, and actions as entry points that must remain thin.
- Tests: use PHPUnit 12 classes, never Pest. This project rule overrides the source standard's Pest syntax.
- Commands: run PHP, Artisan, Composer, and Node through `vendor/bin/sail`.
- DTOs and states: use the installed `spatie/laravel-data` and `spatie/laravel-model-states` packages where the architecture calls for them.
- Quality: Pint uses the Laravel preset; Larastan is already level 7, so never lower it to the source baseline of level 5.
- Dependencies: Rector and IDE Helper are source-standard tools but are not installed here. Do not add them without approval; report the gap when relevant.
- Framework seams: preserve names and signatures required by Fortify, Filament, Livewire, or another installed package. Do not force a suffix or FormRequest where a framework contract makes that shape inapplicable.

## Workflow

1. Inspect sibling files, relevant tests, package versions, and project rules before changing code.
2. Read every reference below that applies to the task.
3. Use Laravel Boost `search-docs` for version-sensitive Laravel ecosystem behavior.
4. Make the smallest coherent change that moves touched code toward the standards without broad incidental refactors.
5. Add or update PHPUnit coverage for every behavior change and bug fix.
6. Run the narrowest relevant test, then required formatting and analysis checks.
7. Re-read the diff for architecture boundaries, explicit types, accidental scope growth, and forbidden patterns.

## Reference Index

| Concern | Read |
| --- | --- |
| Class placement, suffixes, dependency direction, endpoint flow, async work, exceptions | [`references/architecture.md`](references/architecture.md) |
| PHPUnit placement, factories, fakes, behavior assertions, required cases | [`references/testing.md`](references/testing.md) |
| Strict types, `final`, Pint, Larastan, Rector and verification commands | [`references/code-quality.md`](references/code-quality.md) |
| Branches, commits, pull requests, reviews, merge and hotfix flow | [`references/git-workflow.md`](references/git-workflow.md) |

## Non-Negotiable Defaults

- Put writes in Actions, complex reads in Queries, and external capabilities in Services.
- Keep controllers, Livewire components, and Filament classes as thin adapters and orchestrators.
- Use explicit parameter and return types, `declare(strict_types=1);`, constructor injection, and `final` concrete classes unless a framework contract requires otherwise.
- Keep validation and authorization at the entry boundary; pass typed data into business operations.
- Test observable behavior, not implementation details.
- Do not introduce dependencies, base directories, or repository-wide restructuring without approval.
