<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529122122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE parent_association (id INT AUTO_INCREMENT NOT NULL, parents_id INT DEFAULT NULL, associations_id INT NOT NULL, valid TINYINT(1) DEFAULT NULL, INDEX IDX_96A933BCB706B6D3 (parents_id), INDEX IDX_96A933BC4122538A (associations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parent_association ADD CONSTRAINT FK_96A933BCB706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE parent_association ADD CONSTRAINT FK_96A933BC4122538A FOREIGN KEY (associations_id) REFERENCES associations (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE parent_association');
    }
}
