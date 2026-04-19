<?php

namespace App\Database;

use Illuminate\Database\Connectors\PostgresConnector;

/**
 * Custom connector untuk Neon PostgreSQL.
 *
 * Neon membutuhkan endpoint ID dikirim via parameter `options` di DSN
 * agar SNI routing bekerja pada libpq versi lama (XAMPP, shared hosting).
 *
 * Referensi: https://neon.tech/docs/connect/connection-errors#the-endpoint-id-is-not-specified
 */
class NeonPostgresConnector extends PostgresConnector
{
    /**
     * Create a DSN string from a configuration.
     * Inject Neon endpoint ID ke DSN options jika tersedia.
     */
    protected function getDsn(array $config): string
    {
        $dsn = parent::getDsn($config);

        // Inject endpoint ID jika ada (untuk Neon SNI fix pada libpq lama)
        if (!empty($config['neon_endpoint'])) {
            $dsn .= ';options=endpoint=' . $config['neon_endpoint'];
        }

        return $dsn;
    }
}
