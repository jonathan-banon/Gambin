<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603080002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessory (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, stock_id INT DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, identifier VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A1B1251C4584665A (product_id), INDEX IDX_A1B1251CDCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deposit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, identifier VARCHAR(100) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(100) DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack_product (pack_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_E80394D01919B217 (pack_id), INDEX IDX_E80394D04584665A (product_id), PRIMARY KEY(pack_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, stock_id INT DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, identifier VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, storage LONGTEXT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, target INT DEFAULT NULL, INDEX IDX_D34A04AD4827B9B2 (marque_id), INDEX IDX_D34A04ADDCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_user (product_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7BF4E84584665A (product_id), INDEX IDX_7BF4E8A76ED395 (user_id), PRIMARY KEY(product_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_D8892622A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating_product (rating_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_3006FDD5A32EFC6 (rating_id), INDEX IDX_3006FDD54584665A (product_id), PRIMARY KEY(rating_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, stock_id INT NOT NULL, deposit_id INT NOT NULL, user_id INT NOT NULL, date_in DATETIME NOT NULL, date_out DATETIME NOT NULL, date_return DATETIME NOT NULL, status INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2784DCCDCD6110 (stock_id), UNIQUE INDEX UNIQ_2784DCC9815E4B1 (deposit_id), INDEX IDX_2784DCCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4B3656608BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(100) DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, address VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, billing_address VARCHAR(255) DEFAULT NULL, billing_postal VARCHAR(255) DEFAULT NULL, billing_city VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accessory ADD CONSTRAINT FK_A1B1251C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE accessory ADD CONSTRAINT FK_A1B1251CDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE pack_product ADD CONSTRAINT FK_E80394D01919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_product ADD CONSTRAINT FK_E80394D04584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE product_user ADD CONSTRAINT FK_7BF4E84584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_user ADD CONSTRAINT FK_7BF4E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rating_product ADD CONSTRAINT FK_3006FDD5A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating_product ADD CONSTRAINT FK_3006FDD54584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC9815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656608BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656608BAC62AF');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC9815E4B1');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4827B9B2');
        $this->addSql('ALTER TABLE pack_product DROP FOREIGN KEY FK_E80394D01919B217');
        $this->addSql('ALTER TABLE accessory DROP FOREIGN KEY FK_A1B1251C4584665A');
        $this->addSql('ALTER TABLE pack_product DROP FOREIGN KEY FK_E80394D04584665A');
        $this->addSql('ALTER TABLE product_user DROP FOREIGN KEY FK_7BF4E84584665A');
        $this->addSql('ALTER TABLE rating_product DROP FOREIGN KEY FK_3006FDD54584665A');
        $this->addSql('ALTER TABLE rating_product DROP FOREIGN KEY FK_3006FDD5A32EFC6');
        $this->addSql('ALTER TABLE accessory DROP FOREIGN KEY FK_A1B1251CDCD6110');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADDCD6110');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCDCD6110');
        $this->addSql('ALTER TABLE product_user DROP FOREIGN KEY FK_7BF4E8A76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCA76ED395');
        $this->addSql('DROP TABLE accessory');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE deposit');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE pack_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_user');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE rating_product');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE user');
    }
}
