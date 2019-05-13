<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190512121049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom_parent VARCHAR(50) NOT NULL, prenom_parent VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_FD501D6AFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents_parents (parents_source INT NOT NULL, parents_target INT NOT NULL, INDEX IDX_721021717A289BAF (parents_source), INDEX IDX_7210217163CDCB20 (parents_target), PRIMARY KEY(parents_source, parents_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE parents_parents ADD CONSTRAINT FK_721021717A289BAF FOREIGN KEY (parents_source) REFERENCES parents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parents_parents ADD CONSTRAINT FK_7210217163CDCB20 FOREIGN KEY (parents_target) REFERENCES parents (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parents_parents DROP FOREIGN KEY FK_721021717A289BAF');
        $this->addSql('ALTER TABLE parents_parents DROP FOREIGN KEY FK_7210217163CDCB20');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE parents_parents');
    }
}
