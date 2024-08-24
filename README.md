<p align="center">
    <img src="https://raw.githubusercontent.com/future-station/keyguard/main/art/example.png" width="600" alt="KeyGuard">
    <p align="center">
        <a href="https://github.com/future-station/keyguard/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/future-station/keyguard/tests.yml?branch=main&label=tests&style=round-square"></a>
        <a href="https://packagist.org/packages/future-station/keyguard"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/future-station/keyguard"></a>
        <a href="https://packagist.org/packages/future-station/keyguard"><img alt="Latest Version" src="https://img.shields.io/packagist/v/future-station/keyguard"></a>
        <a href="https://packagist.org/packages/future-station/keyguard"><img alt="License" src="https://img.shields.io/github/license/future-station/keyguard"></a>
    </p>
</p>

------
**KeyGuard** is a powerful PHP package designed to validate API keys, secrets, access tokens, and HMACs for popular services like OpenAI, GitHub, Shopify, and more. This tool is essential for developers and businesses that depend on secure and accurate validation of their API credentials.

### Contributors

This package is made possible thanks to the contributions of these developers:

- **[AkrAm](https://github.com/akr4m)**
- **[Shuvro Roy](https://github.com/shuvroroy)**

If you or your organization benefits from using KeyGuard, please consider supporting the developers who have invested their time and expertise into creating and maintaining this invaluable tool.

## Get Started

> **Prerequisite:** PHP 8.1 or higher is required. [Download PHP](https://php.net/releases/)

### Installation

To begin using KeyGuard, install the package via Composer:

```bash
composer require future-station/keyguard
```

If your project does not already include a PSR-18 HTTP client, ensure the `php-http/discovery` plugin is enabled, or manually install a compatible client such as Guzzle:

```bash
composer require guzzlehttp/guzzle
```

### Usage Example

Below is a basic example demonstrating how to validate a GitHub API key using KeyGuard:

```php
$yourApiKey = 'YOUR_API_KEY';
$keyguard = new KeyGuard();

$result = $keyguard
            ->validate(ServiceType::GITHUB, $yourApiKey);

echo $result->value; // Output: valid
```

### License

KeyGuard is open-source software licensed under the [BSD 3-Clause License](https://opensource.org/licenses/BSD-3-Clause).
