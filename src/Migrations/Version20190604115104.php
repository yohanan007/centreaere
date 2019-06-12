<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190604115104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jour_activite ADD activites_enfants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jour_activite ADD CONSTRAINT FK_6C6BA64CFBC53B40 FOREIGN KEY (activites_enfants_id) REFERENCES activites_enfants (id)');
        $this->addSql('CREATE INDEX IDX_6C6BA64CFBC53B40 ON jour_activite (activites_enfants_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jour_activite DROP FOREIGN KEY FK_6C6BA64CFBC53B40');
        $this->addSql('DROP INDEX IDX_6C6BA64CFBC53B40 ON jour_activite');
        $this->addSql('ALTER TABLE jour_activite DROP activites_enfants_id');
    }
}
