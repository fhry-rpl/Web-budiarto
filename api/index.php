<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;

require __DIR__.'/../vendor/autoload.php';

register_shutdown_function(function () {
    $err = error_get_last();
    if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        error_log('SHUTDOWN: '.$err['message'].' in '.$err['file'].':'.$err['line']);
        if (! headers_sent()) {
            header('Content-Type: text/plain');
        }
        echo 'SHUTDOWN: '.$err['message']."\n";
        echo $err['file'].':'.$err['line']."\n";
    }
});

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

        $db = $app->make('db');
        $db->connection('pgsql')->getPdo();
        echo "DB connection OK\n";

        $exitCode = Artisan::call('migrate', ['--force' => true]);
        echo "migrate exit code: {$exitCode}\n";
        echo Artisan::output();

        try {
            $exitCode = Artisan::call('db:seed', ['--force' => true]);
            echo "db:seed exit code: {$exitCode}\n";
            echo Artisan::output();
        } catch (Throwable $e) {
            echo 'db:seed error (non-fatal): '.$e->getMessage()."\n";
        }

        echo "\nMigration completed successfully.\n";
    } catch (Throwable $e) {
        echo 'Error: '.$e->getMessage()."\n";
        echo 'File: '.$e->getFile().':'.$e->getLine()."\n";
    }
    exit;
}

try {
    require __DIR__.'/../public/index.php';
} catch (Throwable $e) {
    if (! headers_sent()) {
        header('Content-Type: text/plain');
        http_response_code(500);
    }
    echo 'Fatal: '.get_class($e).': '.$e->getMessage()."\n";
    echo $e->getFile().':'.$e->getLine()."\n";
}
