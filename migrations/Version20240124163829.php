<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124163829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery_info (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, delivery_name VARCHAR(255) NOT NULL, delivery_method VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD delivery_info_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939857957E26 FOREIGN KEY (delivery_info_id) REFERENCES delivery_info (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F529939857957E26 ON `order` (delivery_info_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939857957E26');
        $this->addSql('DROP TABLE delivery_info');
        $this->addSql('DROP INDEX UNIQ_F529939857957E26 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP delivery_info_id');
    }
}
