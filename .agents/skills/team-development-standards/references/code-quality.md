# Code Quality

## PHP Shape

- Start new PHP files with `declare(strict_types=1);` after `<?php`.
- Use explicit parameter and return types.
- Use constructor property promotion and readonly properties where appropriate.
- Mark concrete application classes `final` by default. Keep abstract bases `abstract`.
- If a package requires inheritance or proxying, preserve compatibility and document the reason when it is not obvious.
- Use mandatory architectural suffixes from the architecture reference.
- Prefer complete, explicit, type-safe code over dynamic resolution and hidden behavior.
- Use PHPDoc for array shapes, generics, and information PHP cannot express; do not duplicate native types.
- A static-analysis suppression requires a nearby explanation and the narrowest possible scope.

## Installed Enforcement

Pint uses the Laravel preset from `pint.json`. Larastan runs at level 7 from `phpstan.neon`; this exceeds the source baseline and must never be lowered.

After modifying PHP:

```bash
vendor/bin/sail bin pint --dirty --format agent
```

Run focused tests, then static analysis when the changed PHP is in its configured paths:

```bash
vendor/bin/sail artisan test --compact path/to/Test.php
vendor/bin/sail composer types:check
```

The project-wide check is:

```bash
vendor/bin/sail composer ci:check
```

Run the broad check only when requested or when the scope justifies it; prefer narrow feedback first.

## Source-Standard Gaps

The upstream standard also mandates Rector and Laravel IDE Helper, but neither is installed in this project. Do not alter dependencies or invent commands. If work explicitly concerns quality tooling or CI, report these gaps and ask before adding packages or configuration.

Treat quality levels as a ratchet:

- Never lower Larastan's level or exclude new paths to hide failures.
- Never weaken Pint or tests to make a change pass.
- Do not disable analysis inline without a specific technical justification.
- Keep tooling-only baseline changes separate from feature behavior when possible.
