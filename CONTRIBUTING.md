# Contributing Guidelines

We welcome and appreciate contributions to our project! To ensure a smooth collaboration, please adhere to the following guidelines when submitting pull requests.

## Contribution Process

1. **Fork the Repository:** Start by forking the project repository to your own GitHub account.
2. **Create a New Branch:** Create a new branch in your forked repository for your changes.
3. **Code and Test:** Implement your changes, ensuring they are thoroughly tested.
4. **Commit and Push:** Make meaningful commits and push your branch to your forked repository.
5. **Open a Pull Request:** Submit a pull request to the main repository, clearly detailing your changes. Be sure to use the provided [pull request template](.github/PULL_REQUEST_TEMPLATE.md).

## Contribution Guidelines

- **Coding Style:** Ensure your code adheres to the project’s coding standards by running `composer lint`.
- **Commit History:** Submit a clean and coherent commit history. Each commit should represent a meaningful change.
- **Rebasing:** You may need to [rebase](https://git-scm.com/book/en/v2/Git-Branching-Rebasing) your branch to resolve any merge conflicts before submitting your pull request.
- **Versioning:** We follow [Semantic Versioning (SemVer)](http://semver.org/). Please ensure that your changes comply with these principles.

## Setup Instructions

To get started with development, clone your forked repository and install the necessary dependencies:

```bash
composer install
```

## Refactoring

To refactor your code:

```bash
composer refactor
```

## Linting

To lint your code and ensure it meets our coding standards:

```bash
composer lint
```

## Testing

Please make sure to run the full suite of tests before submitting your pull request:

- **Run All Tests:**

  ```bash
  composer test
  ```

- **Check Code Quality:**

  ```bash
  composer test:refactor
  ```

- **Check Types:**

  ```bash
  composer test:types
  ```

- **Unit Tests:**

  ```bash
  composer test:unit
  ```
