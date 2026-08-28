---
name: simple-ui-design
description: "Use when creating or changing any user-facing layout, Blade view, Livewire UI, Flux component composition, dashboard, form, table, or navigation in this project. Enforces a simple, focused, responsive, accessible interface without decorative clutter."
---

# Simple UI Design

Make the interface obvious before making it expressive. Preserve established Flux, Filament, Livewire, and Tailwind patterns instead of introducing a parallel design system.

## Composition

- Give each screen one clear purpose and one visually primary action.
- Use the smallest useful hierarchy: a concise heading, optional supporting text, the task content, and relevant actions.
- Prefer existing components and familiar interaction patterns over custom controls.
- Keep related fields and actions together. Reveal advanced or uncommon options progressively instead of showing everything at once.
- Use whitespace, typography, and alignment for hierarchy before adding containers, borders, colors, or shadows.

## Restraint

- Avoid ornamental gradients, glass effects, excessive shadows, nested cards, oversized hero text, decorative charts, unnecessary animations, and icon-only controls without labels or tooltips.
- Do not turn every section into a card or every metric into a dashboard tile.
- Do not duplicate the page title in multiple components or repeat explanatory copy users can infer from labels.
- Use a restrained color palette. Reserve strong color for the primary action, status, warning, or destructive intent.
- Keep motion brief and functional, and respect reduced-motion preferences.

## Usability

- Design mobile-first, then improve composition at wider breakpoints. Never require horizontal scrolling for normal forms or core actions.
- Keep forms single-column by default. Use multiple columns only for short, strongly related fields when the layout remains clear in Arabic and on mobile.
- Use visible labels, helpful validation near the affected field, keyboard focus states, sufficient contrast, and comfortably sized targets.
- Include intentional loading, empty, error, disabled, and success states where the interaction can reach them.
- Confirm destructive operations and make destructive styling unambiguous.
- Keep the main action visible at the point where the user finishes the task.

## Project Requirements

- Arabic is the first and default language. Apply the `arabic-first-localization` skill to all visible copy and use direction-aware layout utilities.
- Match existing dark-mode behavior whenever the surrounding interface supports it.
- Use Flux components in Livewire interfaces and Filament components in the admin panel before building custom equivalents.
- For focused Filament create, view, edit, and confirmation flows, apply the `filament-modal-first` skill.

## Verification

- Test behavior programmatically and run the narrowest relevant test suite.
- Check the changed interface at mobile and desktop widths, in Arabic RTL and English LTR.
- Verify keyboard navigation, focus visibility, validation, loading, empty, error, and destructive states relevant to the change.
