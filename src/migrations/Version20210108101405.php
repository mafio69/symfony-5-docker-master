<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108101405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id INT UNSIGNED AUTO_INCREMENT NOT NULL, login VARCHAR(10) NOT NULL, l_name VARCHAR(100) NOT NULL COMMENT \'last name\', f_name VARCHAR(100) NOT NULL COMMENT \'first name\', state SMALLINT UNSIGNED NOT NULL COMMENT \'1 - active, 2- banned, 3 - deleted\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_like_product (person_id INT UNSIGNED NOT NULL, product_id INT UNSIGNED NOT NULL, INDEX IDX_63C9AEC3217BBB47 (person_id), INDEX IDX_63C9AEC34584665A (product_id), PRIMARY KEY(person_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, info TEXT NOT NULL COMMENT \'opis html\', public_date DATE NOT NULL COMMENT \'w sprzedazy od\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_like_product ADD CONSTRAINT FK_63C9AEC3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE person_like_product ADD CONSTRAINT FK_63C9AEC34584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person_like_product DROP FOREIGN KEY FK_63C9AEC3217BBB47');
        $this->addSql('ALTER TABLE person_like_product DROP FOREIGN KEY FK_63C9AEC34584665A');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_like_product');
        $this->addSql('DROP TABLE product');
    }
}
