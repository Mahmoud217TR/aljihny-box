---
name: arabic-first-localization
description: "Use for every user-facing feature, string, form, notification, email, Filament resource, Livewire component, or Blade view in this project. Enforces complete localization with Arabic (ar) as the default and first language, English (en) as the secondary fallback, and correct RTL/LTR behavior."
---

# Arabic-First Localization

Treat localization as part of the feature, not follow-up work.

## Language Policy

- Arabic (`ar`) is the default locale and appears first in every locale selector, translated field group, fixture, and example.
- English (`en`) is the secondary locale and fallback unless the user specifies another supported locale.
- When locale defaults are in scope, use `APP_LOCALE=ar` and `APP_FALLBACK_LOCALE=en` in committed defaults such as `.env.example`.
- Preserve a signed-in user's locale preference when the application supports preferences. Otherwise use a deliberate session, cookie, or route strategy rather than browser-only state.

## User-Facing Copy

- Localize every visible string: headings, navigation, labels, placeholders, help text, buttons, validation errors, table columns, filters, empty states, notifications, confirmation dialogs, emails, and accessibility labels.
- Use Laravel's `__()` for strings and `trans_choice()` for count-sensitive text. Never concatenate translated fragments into a sentence.
- The current Blade UI uses English source strings as translation keys. Add their Arabic values to `lang/ar.json` unless the surrounding feature already uses named translation files; do not mix conventions within one feature.
- Do not translate internal identifiers, route names, database column names, log messages, or API keys.

## Translatable Content

- Use `spatie/laravel-translatable` only for model content that editors manage in multiple languages, not for static interface copy.
- Prefer `#[Translatable('name', 'description')]` with `HasTranslations`, JSON database columns, and no competing `array` or `json` casts on those attributes.
- Present Arabic inputs before English inputs and require Arabic when the domain requires a primary-language value.

## RTL And Formatting

- Set the document `lang` and `dir` from the active locale. Arabic renders with `lang="ar"` and `dir="rtl"`; English renders with `lang="en"` and `dir="ltr"`.
- Prefer direction-aware Tailwind utilities such as `text-start`, `text-end`, `ms-*`, `me-*`, `ps-*`, `pe-*`, `rounded-s-*`, `rounded-e-*`, `inset-s-*`, and `inset-e-*` over physical left/right utilities.
- Use `rtl:` or `ltr:` variants only when logical utilities cannot express the difference.
- Keep email addresses, phone numbers, codes, and other intrinsically LTR values readable inside Arabic layouts with an explicit local direction where needed.
- Format dates, times, numbers, money, and pluralized counts with locale-aware APIs. Do not translate by string replacement.

## Scope And Verification

- When changing a feature, finish localization for that feature's complete user journey. Do not expand a focused task into an unrelated whole-application translation unless requested.
- Test Arabic as the default, Arabic copy rendering, RTL direction, English switching or fallback, and locale persistence when applicable.
- For translated model attributes, test Arabic and English storage, retrieval, validation, and fallback behavior.
- Inspect both desktop and mobile layouts in Arabic because longer text and RTL ordering expose different failures than English.

## Completion Checklist

- Arabic is the default and first language.
- No new user-facing string bypasses Laravel localization.
- The feature works in both RTL and LTR.
- Arabic and English behavior has programmatic coverage.
