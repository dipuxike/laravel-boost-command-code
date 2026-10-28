# Laravel Boost — Command Code Agent

A [Laravel Boost](https://github.com/laravel/boost) agent that connects Boost to [Command Code](https://commandcode.ai).

It registers the `command_code` agent with Boost so Boost can:

- detect Command Code on the system and in a project,
- sync AI guidelines into the files Command Code reads,
- write the Boost MCP server configuration, and
- sync Boost skills for Command Code.

## Requirements

- PHP 8.2 or newer
- [`laravel/boost`](https://github.com/laravel/boost) `^2.2`

> Boost is a development tool, so install this package as a dev dependency.

## Installation

```bash
composer require dipuxike/laravel-boost-command-code --dev
```

The package is auto-discovered by Laravel. That is all that is required — there is no need to register the service provider or the agent manually.

## Usage

Run Boost's installer and select **Command Code** when it asks which agents to configure:

```bash
php artisan boost:install
```

From then on, `php artisan boost:install` and `php artisan boost:update` keep the following project files in sync for Command Code:

| Feature    | Default path        |
| ---------- | ------------------- |
| Guidelines | `AGENTS.md`         |
| MCP config | `.mcp.json`         |
| Skills     | `.commandcode/skills` |

## Configuration

The agent reads its paths from Boost's config under the `boost.agents.command_code` key, falling back to the defaults shown above. To override them, add the key to your application's `config/boost.php`:

```php
// config/boost.php
return [
    'agents' => [
        'command_code' => [
            'guidelines_path' => 'AGENTS.md',
            'mcp_config_path' => '.mcp.json',
            'skills_path' => '.commandcode/skills',
        ],
    ],
];
```

## Uninstall

```bash
composer remove dipuxike/laravel-boost-command-code
```

Then remove the `"command_code"` entry from the `agents` array in your project's `boost.json` and re-run:

```bash
php artisan boost:update
```

## License

The Laravel Boost Command Code agent is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
