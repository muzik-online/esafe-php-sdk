# Contributing to ESafe-PHP-SDK

First off, thanks for taking the time to contribute!

## Coding Style

- [PSR 12](https://www.php-fig.org/psr/psr-12/)
- And some custom rules: 
    - Use `php-cs-fixer fix` at project root.

## VCS

### Branch

We use [Git Flow](https://jeffkreeftmeijer.com/git-flow/).

### Commit

We use [Semantic Commit Message](https://www.conventionalcommits.org/), there are some scopes we used:

- **feat**: It is a new feature, it should commit with a test case, but it is not mandatory.
- **test**: It is a new test case for feature which is exists or new feature.
- **style**: Commit with fix coding style.
- **pack**: Update for package, such as `composer update` or add/remove some packages.
- **ci**: Update for ci.
- **docs**: Write some documentations or license.
- **hotfix**: Quick fix an exists feature, test case, package, ci...

