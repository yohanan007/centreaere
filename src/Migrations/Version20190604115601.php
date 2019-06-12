<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190604115601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activites_enfants_jour_activite (activites_enfants_id INT NOT NULL, jour_activite_id INT NOT NULL, INDEX IDX_BCA0F8D8FBC53B40 (activites_enfants_id), INDEX IDX_BCA0F8D83DFC1247 (jour_activite_id), PRIMARY KEY(activites_enfants_id, jour_activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activites_enfants_jour_activite ADD CONSTRAINT FK_BCA0F8D8FBC53B40 FOREIGN KEY (activites_enfants_id) REFERENCES activites_enfants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activites_enfants_jour_activite ADD CONSTRAINT FK_BCA0F8D83DFC1247 FOREIGN KEY (jour_activite_id) REFERENCES jour_activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jour_activite DROP FOREIGN KEY FK_6C6BA64CFBC53B40');
        $this->addSql('DROP INDEX IDX_6C6BA64CFBC53B40 ON jour_activite');
        $this->addSql('ALTER TABLE jour_activite DROP activites_enfants_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE activites_enfants_jour_activite');
        $this->addSql('ALTER TABLE jour_activite ADD activites_enfants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jour_activite ADD CONSTRAINT FK_6C6BA64CFBC53B40 FOREIGN KEY (activites_enfants_id) REFERENCES activites_enfants (id)');
        $this->addSql('CREATE INDEX IDX_6C6BA64CFBC53B40 ON jour_activite (activites_enfants_id)');
    }
}
