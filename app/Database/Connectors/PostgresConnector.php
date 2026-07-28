<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector as BasePostgresConnector;

class PostgresConnector extends BasePostgresConnector
{
    protected function addSslOptions($dsn, array $config)
    {
        $dsn = parent::addSslOptions($dsn, $config);

        if (isset($config['host']) && preg_match('/^ep-([^.]+)/', $config['host'], $m)) {
            $dsn .= ";options='endpoint={$m[1]}'";
        }

        return $dsn;
    }
}
