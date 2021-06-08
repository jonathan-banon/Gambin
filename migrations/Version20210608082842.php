<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608082842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, pack_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_64C19C11919B217 (pack_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_product (category_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_149244D312469DE2 (category_id), INDEX IDX_149244D34584665A (product_id), PRIMARY KEY(category_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_product (user_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_8B471AA7A76ED395 (user_id), INDEX IDX_8B471AA74584665A (product_id), PRIMARY KEY(user_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE category_product ADD CONSTRAINT FK_149244D312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_product ADD CONSTRAINT FK_149244D34584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_product ADD CONSTRAINT FK_8B471AA74584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('ALTER TABLE accessory ADD characteristic LONGTEXT DEFAULT NULL, ADD argument_one VARCHAR(255) DEFAULT NULL, ADD argument_two VARCHAR(255) DEFAULT NULL, ADD argument_three VARCHAR(255) DEFAULT NULL, ADD price_per_day DOUBLE PRECISION NOT NULL, ADD price_service DOUBLE PRECISION NOT NULL, DROP price');
        $this->addSql('ALTER TABLE pack ADD price_per_day DOUBLE PRECISION NOT NULL, ADD price_service DOUBLE PRECISION NOT NULL, ADD description LONGTEXT NOT NULL, DROP price');
        $this->addSql('ALTER TABLE product ADD characteristic LONGTEXT DEFAULT NULL, ADD argument_one VARCHAR(255) DEFAULT NULL, ADD argument_two VARCHAR(255) DEFAULT NULL, ADD argument_three VARCHAR(255) DEFAULT NULL, ADD price_per_day DOUBLE PRECISION NOT NULL, ADD price_service DOUBLE PRECISION NOT NULL, DROP price');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_product DROP FOREIGN KEY FK_149244D312469DE2');
        $this->addSql('CREATE TABLE favorite (product_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_68C58ED94584665A (product_id), INDEX IDX_68C58ED9A76ED395 (user_id), PRIMARY KEY(product_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED94584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_product');
        $this->addSql('DROP TABLE user_product');
        $this->addSql('ALTER TABLE accessory ADD price DOUBLE PRECISION DEFAULT NULL, DROP characteristic, DROP argument_one, DROP argument_two, DROP argument_three, DROP price_per_day, DROP price_service');
        $this->addSql('ALTER TABLE pack ADD price DOUBLE PRECISION DEFAULT NULL, DROP price_per_day, DROP price_service, DROP description');
        $this->addSql('ALTER TABLE product ADD price DOUBLE PRECISION DEFAULT NULL, DROP characteristic, DROP argument_one, DROP argument_two, DROP argument_three, DROP price_per_day, DROP price_service');
    }
}
