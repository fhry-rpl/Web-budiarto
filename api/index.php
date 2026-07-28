<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;

require __DIR__.'/../vendor/autoload.php';

// Load .env.vercel as fallback if .env doesn't exist (e.g. on Vercel serverless)
// Vercel Dashboard env vars take precedence (safeLoad won't overwrite existing vars)
if (! file_exists(__DIR__.'/../.env')) {
    $vercelEnv = __DIR__.'/../.env.vercel';
    if (file_exists($vercelEnv)) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..', '.env.vercel');
        $dotenv->safeLoad();
    }
}

$uri = $_SERVER['REQUEST_URI'] ?? '/';

if (str_starts_with($uri, '/__ping')) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'ok', 'timestamp' => time()]);
    exit;
}

if (str_starts_with($uri, '/__migrate/')) {
    header('Content-Type: text/plain');
    $token = substr($uri, strlen('/__migrate/'));
    $token = strtok($token, '?');
    $token = trim($token, '/ ');                     // hapus trailing slash & spasi
    $secret = trim(getenv('MIGRATE_SECRET') ?: '');  // trim env var juga

    if (! $secret) {
        echo "ERROR: MIGRATE_SECRET not configured\n";
        echo "HINT: Set MIGRATE_SECRET di Vercel Dashboard -> Settings -> Environment Variables\n";
        exit;
    }

    if ($token !== $secret) {
        http_response_code(403);
        echo "ERROR: Invalid token\n";
        echo "Token received: [{$token}]\n";
        echo 'Token length: '.strlen($token)."\n";
        echo 'Secret length: '.strlen($secret)."\n";
        exit;
    }

    try {
        $app = require __DIR__.'/../bootstrap/app.php';
        $kernel = $app->make(Kernel::class);
        $kernel->bootstrap();

        $dbUrl = getenv('DB_URL') ?: 'NOT SET';
        $dbConfig = config('database.connections.pgsql');
        echo "DB_HOST: " . ($dbConfig['host'] ?? 'N/A') . "\n";
        echo "DB_USER: " . ($dbConfig['username'] ?? 'N/A') . "\n";
        echo "DB_PASS: " . (isset($dbConfig['password']) ? 'SET(len='.strlen($dbConfig['password']).')' : 'N/A') . "\n";
        echo "DB_DB: " . ($dbConfig['database'] ?? 'N/A') . "\n";
        echo "DB_PORT: " . ($dbConfig['port'] ?? 'N/A') . "\n";
        echo "DB_SSLMODE: " . ($dbConfig['sslmode'] ?? 'N/A') . "\n";

        $exitCode = Artisan::call('migrate', ['--force' => true]);
        echo "migrate exit code: {$exitCode}\n";
        echo Artisan::output();

        $exitCode = Artisan::call('db:seed', ['--force' => true]);
        echo "db:seed exit code: {$exitCode}\n";
        echo Artisan::output();

        echo "\nMigration completed successfully.\n";
    } catch (Throwable $e) {
        echo 'Error: '.$e->getMessage()."\n";
        echo 'File: '.$e->getFile().':'.$e->getLine()."\n";
    }
    exit;
}

require __DIR__.'/../public/index.php';
