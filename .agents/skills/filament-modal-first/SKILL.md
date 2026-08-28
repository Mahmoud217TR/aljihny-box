---
name: filament-modal-first
description: "Use for Filament resources, tables, actions, create/edit/view flows, CRUD interfaces, and admin-panel UX in this project. Prefer Filament 5 modal actions and simple modal resources over dedicated pages whenever the workflow is focused and self-contained."
---

# Filament Modal-First UI

Keep users in context. A modal is the default for focused Filament CRUD and actions; a dedicated page requires a concrete usability reason.

## Default Approach

- Use a simple resource for straightforward CRUD so create, view, edit, and delete stay on one manage page.
- Generate new simple resources with `vendor/bin/sail artisan make:filament-resource Model --simple --no-interaction` after checking the command's current options.
- Use built-in `CreateAction`, `ViewAction`, `EditAction`, and `DeleteAction` from `Filament\Actions` before writing custom equivalents.
- Put focused custom workflows in `Action::make()` with `->schema()` and `->action()` so the form opens in a modal.
- Keep Filament classes thin. Delegate writes, complex reads, and integrations according to the `team-development-standards` skill.

## Modal Design

- Give every modal a clear localized heading, concise supporting text only when needed, and an action label that states the outcome.
- Keep forms short and single-purpose. Group related fields and hide uncommon options until relevant.
- Use the narrowest comfortable modal width. Use a slide-over or sticky modal header/footer for moderately tall focused content, but do not cram a complex workflow into an oversized modal.
- For read-only view actions, remove the submit action and provide a localized close action.
- Require confirmation for destructive, irreversible, expensive, or externally visible actions.
- Show a localized success or failure notification and leave the table or record state visibly current after completion.
- Preserve authorization, validation, transactions, and error handling exactly as a page-based flow would.

## When A Page Is Justified

Use a dedicated page only when one or more of these materially improves the task:

- A long, multi-section, or multi-step workflow needs stable navigation and progress.
- Relation managers, dense comparison, or substantial surrounding record context must remain visible.
- Rich editing, large file management, drafts, autosave, or recovery from interruption is central to the task.
- The route must be bookmarkable, shareable, or directly addressable for an operational reason.
- A modal or slide-over would be difficult to use on mobile or with assistive technology.

Do not choose a page merely because generated Filament resource defaults include one. Mention the concrete reason in the implementation summary when choosing a page over a modal.

## Localization And Simplicity

- Apply `arabic-first-localization`: Arabic is default and first, all Filament labels and messages are localized, and RTL is verified.
- Apply `simple-ui-design`: one clear primary action, minimal chrome, no decorative clutter, and responsive behavior.
- Use correct Filament 5 namespaces: actions from `Filament\Actions`, form fields from `Filament\Forms\Components`, schema layout from `Filament\Schemas\Components`, and table columns from `Filament\Tables\Columns`.

## Testing

- Write PHPUnit Livewire tests for authorization, opening and submitting the action, valid persistence, validation failures, notifications, and destructive confirmations where applicable.
- Authenticate before testing panel functionality.
- Assert observable behavior and database state rather than Filament implementation details.
- Run the narrowest affected test through Sail and format changed PHP with Pint.

## Completion Checklist

- A focused workflow uses a modal or simple resource.
- Any dedicated page has a concrete usability justification.
- Copy is localized with Arabic first and RTL verified.
- Authorization, validation, persistence, notification, and failure paths are tested.
