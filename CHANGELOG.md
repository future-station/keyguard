# Changelog

All notable changes made to this project will be documented in this file. The format follows the guidelines provided by [Keep a Changelog](http://keepachangelog.com/), and this project adheres to the principles of [Semantic Versioning](http://semver.org/).

## v0.1.1 (2024-08-26)
### Added
- **`KeyGuard` Facade**:
  - Introduced the `KeyGuard` facade to simplify the validation of API keys across different services like OpenAI, GitHub, and Shopify.
  - **Use Cases:**
    - **Validate an OpenAI API key**:

      ```php
      use FutureStation\KeyGuard\Facades\KeyGuard;

      $response = KeyGuard::validateOpenAI('your-openai-api-key');
      echo $response->getStatus(); // Outputs: 'valid' if the key is valid
      ```

    - **Validate a GitHub API key**:

      ```php
      use FutureStation\KeyGuard\Facades\KeyGuard;

      $response = KeyGuard::validateGitHub('your-github-api-key');
      echo $response->getStatus(); // Outputs: 'valid' if the key is valid
      ```

    - **Validate a Shopify API key with HMAC**:

      ```php
      use FutureStation\KeyGuard\Facades\KeyGuard;

      $response = KeyGuard::validateShopify('your-shopify-api-key', 'your-secret', 'your-hmac-hash', 'data');
      echo $response->getStatus(); // Outputs: 'valid' if the key and HMAC are valid
      ```

- **`BaseValidator` Class**:
  - Implemented the `BaseValidator` class to centralize and manage common dependencies such as the HTTP client and request factory, improving maintainability and reducing redundancy.

- **`ValidatorFactory`**:
  - Updated the `ValidatorFactory` to dynamically create validators based on the `ServiceType` enum, streamlining the process of validator instantiation.

- **PHPDoc Comments**:
  - Added comprehensive PHPDoc comments for all classes and methods to improve code documentation, making the codebase more understandable and easier to maintain.

## v0.1.0 (2024-08-25)
### Added
- First version
