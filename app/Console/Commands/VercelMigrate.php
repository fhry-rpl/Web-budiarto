<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class VercelMigrate extends Command
{
    protected $signature = 'vercel:migrate {--seed : Run seeders after migration}';

    protected $description = 'Run migrations and seeders for Vercel deployment';

    public function handle(): int
    {
        $rawUrl = env('DB_URL');
        if ($rawUrl && str_contains($rawUrl, '.c-')) {
            $poolerUrl = str_replace('.c-', '-pooler.c-', $rawUrl);
            putenv("DB_URL={$poolerUrl}");
            $_SERVER['DB_URL'] = $poolerUrl;
            config(['database.connections.pgsql.url' => $poolerUrl]);
            DB::purge('pgsql');
            DB::reconnect('pgsql');
            $this->info('Using connection pooler URL');
        }

        $this->info('Running migrations...');
        $exitCode = Artisan::call('migrate', ['--force' => true]);
        $this->info(Artisan::output());

        if ($exitCode !== 0) {
            $this->error('Migration failed');

            return Command::FAILURE;
        }

        if ($this->option('seed') || env('VERCEL_MIGRATE_SEED', false)) {
            $this->info('Running seeders...');
            $exitCode = Artisan::call('db:seed', ['--force' => true]);
            $this->info(Artisan::output());
        }

        $this->info('Migration completed successfully');

        return Command::SUCCESS;
    }
}
