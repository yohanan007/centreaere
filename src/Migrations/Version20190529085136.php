<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529085136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associations_parents (associations_id INT NOT NULL, parents_id INT NOT NULL, INDEX IDX_DB1095C64122538A (associations_id), INDEX IDX_DB1095C6B706B6D3 (parents_id), PRIMARY KEY(associations_id, parents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents_associations (parents_id INT NOT NULL, associations_id INT NOT NULL, INDEX IDX_E86D2C7FB706B6D3 (parents_id), INDEX IDX_E86D2C7F4122538A (associations_id), PRIMARY KEY(parents_id, associations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associations_parents ADD CONSTRAINT FK_DB1095C64122538A FOREIGN KEY (associations_id) REFERENCES associations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE associations_parents ADD CONSTRAINT FK_DB1095C6B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parents_associations ADD CONSTRAINT FK_E86D2C7FB706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parents_associations ADD CONSTRAINT FK_E86D2C7F4122538A FOREIGN KEY (associations_id) REFERENCES associations (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE parents_parents');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE parents_parents (parents_source INT NOT NULL, parents_target INT NOT NULL, INDEX IDX_721021717A289BAF (parents_source), INDEX IDX_7210217163CDCB20 (parents_target), PRIMARY KEY(parents_source, parents_target)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE parents_parents ADD CONSTRAINT FK_7210217163CDCB20 FOREIGN KEY (parents_target) REFERENCES parents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parents_parents ADD CONSTRAINT FK_721021717A289BAF FOREIGN KEY (parents_source) REFERENCES parents (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE associations_parents');
        $this->addSql('DROP TABLE parents_associations');
    }
}
