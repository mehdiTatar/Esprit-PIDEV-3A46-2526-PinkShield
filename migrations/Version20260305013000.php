<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add performance indexes to Appointment, BlogPost, Comment, and DailyTracking tables.
 * Created manually because doctrine:migrations:diff fails on MariaDB 10.11
 * due to DBAL FULL_COLLATION_NAME incompatibility.
 */
final class Version20260305013000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add performance indexes to frequently queried columns';
    }

    public function up(Schema $schema): void
    {
        // Appointment indexes
        $this->addSql('CREATE INDEX idx_appointment_patient_email ON appointment (patient_email)');
        $this->addSql('CREATE INDEX idx_appointment_doctor_email ON appointment (doctor_email)');
        $this->addSql('CREATE INDEX idx_appointment_status ON appointment (status)');
        $this->addSql('CREATE INDEX idx_appointment_date ON appointment (appointment_date)');

        // BlogPost indexes
        $this->addSql('CREATE INDEX idx_blogpost_author_email ON blog_post (author_email)');
        $this->addSql('CREATE INDEX idx_blogpost_created_at ON blog_post (created_at)');

        // Comment indexes
        $this->addSql('CREATE INDEX idx_comment_author_email ON comment (author_email)');
        $this->addSql('CREATE INDEX idx_comment_created_at ON comment (created_at)');

        // DailyTracking indexes
        $this->addSql('CREATE INDEX idx_dailytracking_date ON daily_tracking (date)');
        $this->addSql('CREATE INDEX idx_dailytracking_created_at ON daily_tracking (created_at)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX idx_appointment_patient_email ON appointment');
        $this->addSql('DROP INDEX idx_appointment_doctor_email ON appointment');
        $this->addSql('DROP INDEX idx_appointment_status ON appointment');
        $this->addSql('DROP INDEX idx_appointment_date ON appointment');

        $this->addSql('DROP INDEX idx_blogpost_author_email ON blog_post');
        $this->addSql('DROP INDEX idx_blogpost_created_at ON blog_post');

        $this->addSql('DROP INDEX idx_comment_author_email ON comment');
        $this->addSql('DROP INDEX idx_comment_created_at ON comment');

        $this->addSql('DROP INDEX idx_dailytracking_date ON daily_tracking');
        $this->addSql('DROP INDEX idx_dailytracking_created_at ON daily_tracking');
    }
}
