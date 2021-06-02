<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602123107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit ADD postal_code VARCHAR(255) DEFAULT NULL, DROP postalcode, CHANGE identifier identifier VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE postal_code postal_code VARCHAR(255) NOT NULL, CHANGE billing_postal billing_postal VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit ADD postalcode INT DEFAULT NULL, DROP postal_code, CHANGE identifier identifier VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE postal_code postal_code INT NOT NULL, CHANGE billing_postal billing_postal INT DEFAULT NULL');
    }
}
