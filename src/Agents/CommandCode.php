<?php

namespace Dipuxike\LaravelBoostCommandCode\Agents;

use Laravel\Boost\Contracts\SupportsGuidelines;
use Laravel\Boost\Contracts\SupportsMcp;
use Laravel\Boost\Contracts\SupportsSkills;
use Laravel\Boost\Install\Agents\Agent;
use Laravel\Boost\Install\Enums\Platform;

class CommandCode extends Agent implements SupportsGuidelines, SupportsMcp, SupportsSkills
{
    public function name(): string
    {
        return 'command_code';
    }

    public function displayName(): string
    {
        return 'Command Code';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin, Platform::Linux => [
                'command' => 'command -v cmd',
            ],
            Platform::Windows => [
                'command' => 'cmd /c where command-code 2>nul',
            ],
        };
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.commandcode'],
        ];
    }

    public function mcpConfigPath(): string
    {
        return config('boost.agents.command_code.mcp_config_path', '.mcp.json');
    }

    public function guidelinesPath(): string
    {
        return config('boost.agents.command_code.guidelines_path', 'AGENTS.md');
    }

    public function skillsPath(): string
    {
        return config('boost.agents.command_code.skills_path', '.commandcode/skills');
    }
}
