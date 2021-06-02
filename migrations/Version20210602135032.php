<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602135032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8892622A76ED395 ON rating (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A32EFC6');
        $this->addSql('DROP INDEX UNIQ_8D93D649A32EFC6 ON user');
        $this->addSql('ALTER TABLE user DROP rating_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('DROP INDEX UNIQ_D8892622A76ED395 ON rating');
        $this->addSql('ALTER TABLE rating DROP user_id');
        $this->addSql('ALTER TABLE user ADD rating_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A32EFC6 ON user (rating_id)');
    }
}
