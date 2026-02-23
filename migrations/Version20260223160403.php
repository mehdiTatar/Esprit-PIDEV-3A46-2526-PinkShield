<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260223160403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor ADD full_name VARCHAR(255) NOT NULL, DROP first_name, DROP last_name');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY `FK_BF5476CA642B8210`');
        $this->addSql('DROP INDEX IDX_BF5476CA642B8210 ON notification');
        $this->addSql('ALTER TABLE notification DROP admin_id');
        $this->addSql('ALTER TABLE rating CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user DROP reset_token, DROP reset_token_expires_at, DROP face_id, DROP face_image_path');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor ADD first_name VARCHAR(100) NOT NULL, ADD last_name VARCHAR(100) NOT NULL, DROP full_name');
        $this->addSql('ALTER TABLE notification ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT `FK_BF5476CA642B8210` FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_BF5476CA642B8210 ON notification (admin_id)');
        $this->addSql('ALTER TABLE rating CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(100) DEFAULT NULL, ADD reset_token_expires_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD face_id VARCHAR(255) DEFAULT NULL, ADD face_image_path VARCHAR(255) DEFAULT NULL');
    }
}
