<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901140017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acheteur ADD realisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE acheteur ADD CONSTRAINT FK_304AFF9DB685E551 FOREIGN KEY (realisation_id) REFERENCES realisation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_304AFF9DB685E551 ON acheteur (realisation_id)');
        $this->addSql('ALTER TABLE realisation DROP FOREIGN KEY FK_EAA5610E96A7BB5F');
        $this->addSql('DROP INDEX IDX_EAA5610E96A7BB5F ON realisation');
        $this->addSql('ALTER TABLE realisation DROP acheteur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acheteur DROP FOREIGN KEY FK_304AFF9DB685E551');
        $this->addSql('DROP INDEX UNIQ_304AFF9DB685E551 ON acheteur');
        $this->addSql('ALTER TABLE acheteur DROP realisation_id');
        $this->addSql('ALTER TABLE realisation ADD acheteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realisation ADD CONSTRAINT FK_EAA5610E96A7BB5F FOREIGN KEY (acheteur_id) REFERENCES acheteur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EAA5610E96A7BB5F ON realisation (acheteur_id)');
    }
}
