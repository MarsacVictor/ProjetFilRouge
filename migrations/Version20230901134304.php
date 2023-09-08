<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901134304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acheteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE realisation ADD acheteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realisation ADD CONSTRAINT FK_EAA5610E96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES acheteur (id)');
        $this->addSql('CREATE INDEX IDX_EAA5610E96A7BB5F ON realisation (acheteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE realisation DROP FOREIGN KEY FK_EAA5610E96A7BB5F');
        $this->addSql('DROP TABLE acheteur');
        $this->addSql('DROP INDEX IDX_EAA5610E96A7BB5F ON realisation');
        $this->addSql('ALTER TABLE realisation DROP acheteur_id');
    }
}
