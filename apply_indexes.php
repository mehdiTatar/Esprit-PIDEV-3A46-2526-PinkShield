<?php
/**
 * Standalone script to apply performance indexes directly via PDO.
 * Bypasses Doctrine migrations (which crash on MariaDB 10.11 due to FULL_COLLATION_NAME bug).
 *
 * Usage: php apply_indexes.php
 */

$dsn  = 'mysql:host=127.0.0.1;port=3306;dbname=pinkshield_db;charset=utf8mb4';
$user = 'root';
$pass = '';

$indexes = [
    // Appointment
    ['appointment',     'idx_appointment_patient_email', 'patient_email'],
    ['appointment',     'idx_appointment_doctor_email',  'doctor_email'],
    ['appointment',     'idx_appointment_status',        'status'],
    ['appointment',     'idx_appointment_date',          'appointment_date'],
    // BlogPost
    ['blog_post',       'idx_blogpost_author_email',     'author_email'],
    ['blog_post',       'idx_blogpost_created_at',       'created_at'],
    // Comment
    ['comment',         'idx_comment_author_email',      'author_email'],
    ['comment',         'idx_comment_created_at',        'created_at'],
    // DailyTracking
    ['daily_tracking',  'idx_dailytracking_date',        'date'],
    ['daily_tracking',  'idx_dailytracking_created_at',  'created_at'],
];

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "Connected to pinkshield_db\n\n";

    $created  = 0;
    $skipped  = 0;
    $failed   = 0;

    foreach ($indexes as [$table, $indexName, $column]) {
        // Check if index already exists
        $stmt = $pdo->prepare(
            "SELECT COUNT(*) FROM information_schema.STATISTICS
             WHERE TABLE_SCHEMA = DATABASE()
               AND TABLE_NAME   = :table
               AND INDEX_NAME   = :idx"
        );
        $stmt->execute(['table' => $table, 'idx' => $indexName]);

        if ((int) $stmt->fetchColumn() > 0) {
            echo "  SKIP  $indexName  (already exists on `$table`)\n";
            $skipped++;
            continue;
        }

        // Check if the table exists
        $tblCheck = $pdo->prepare(
            "SELECT COUNT(*) FROM information_schema.TABLES
             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table"
        );
        $tblCheck->execute(['table' => $table]);
        if ((int) $tblCheck->fetchColumn() === 0) {
            echo "  SKIP  $indexName  (table `$table` does not exist)\n";
            $skipped++;
            continue;
        }

        try {
            $pdo->exec("CREATE INDEX `$indexName` ON `$table` (`$column`)");
            echo "  OK    $indexName  ON `$table` (`$column`)\n";
            $created++;
        } catch (PDOException $e) {
            echo "  FAIL  $indexName  — " . $e->getMessage() . "\n";
            $failed++;
        }
    }

    echo "\nDone: $created created, $skipped skipped, $failed failed.\n";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
