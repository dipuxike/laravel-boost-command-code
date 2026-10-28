<?php

namespace Dipuxike\LaravelBoostCommandCode;

use Dipuxike\LaravelBoostCommandCode\Agents\CommandCode;
use Illuminate\Support\ServiceProvider;
use Laravel\Boost\Boost;

class CommandCodeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $config = $this->app['config'];

        $config->set('boost.agents.command_code', array_merge([
            'guidelines_path' => 'AGENTS.md',
            'mcp_config_path' => '.mcp.json',
            'skills_path' => '.commandcode/skills',
        ], $config->get('boost.agents.command_code', [])));
    }

    public function boot(): void
    {
        if (array_key_exists('command_code', Boost::getAgents())) {
            return;
        }

        Boost::registerAgent('command_code', CommandCode::class);
    }
}
