# Git Workflow

Apply these rules only when the user requests branch, commit, pull request, review, or release work. Never create commits, push, or open pull requests without an explicit request.

## Branches

- Long-lived branches are `dev`, `staging`, and `main`.
- Branch features, non-urgent fixes, chores, and refactors from `dev`.
- Branch urgent production hotfixes from `main`.
- Use `feature/`, `fix/`, `hotfix/`, or `chore/` followed by a lowercase hyphenated description.
- Do not include ticket IDs in branch names.
- Never push directly to `dev`, `staging`, or `main`.
- Never rewrite long-lived branch history.

Normal flow is feature branch to `dev`, then `dev` to `staging`, then `staging` to `main` through pull requests.

After a hotfix reaches `main`, back-merge `main` to `staging`, then `staging` to `dev` within 24 hours.

## Commits

Use Conventional Commits:

```text
<type>(<optional-scope>): <imperative description>
```

Allowed types are `feat`, `fix`, `chore`, `refactor`, `test`, `docs`, `perf`, `ci`, `build`, and `style`.

- Keep the type lowercase.
- Use imperative present tense.
- Keep the subject below 72 characters with no trailing period.
- Use an optional body to explain why, wrapped at 72 characters.
- Keep each commit coherent and free of unrelated changes.

Before committing, inspect status, diff, and recent log. Stage only intended files and never bypass hooks.

## Pull Requests

- One pull request has one purpose.
- Target `dev` for normal work and `main` for hotfixes.
- Keep changes reviewable; consider splitting diffs above roughly 500 lines.
- Require one approving review, green CI, and resolved conversations before merging.
- Use merge commits, not squash or rebase merges.
- Delete the feature branch after merge.

Every non-hotfix pull request description includes:

```markdown
## Description
What does this PR do, and why is it needed?

## What's new
- Meaningful changes only

## Notes
- Review focus, trade-offs, migration steps, or operational concerns
```

A hotfix may use a shorter description but must state what broke and what fixed it.
