<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513074818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activites (id INT AUTO_INCREMENT NOT NULL, typeactivites_id INT DEFAULT NULL, associations_id INT DEFAULT NULL, administrateurs_id INT DEFAULT NULL, nom_activite VARCHAR(50) NOT NULL, INDEX IDX_766B5EB54E2854D8 (typeactivites_id), INDEX IDX_766B5EB54122538A (associations_id), INDEX IDX_766B5EB5C86024E2 (administrateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfants (id INT AUTO_INCREMENT NOT NULL, nom_enfant VARCHAR(50) NOT NULL, prenom_enfant VARCHAR(50) NOT NULL, date_de_naissance_enfant DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfants_parents (enfants_id INT NOT NULL, parents_id INT NOT NULL, INDEX IDX_24D94370A586286C (enfants_id), INDEX IDX_24D94370B706B6D3 (parents_id), PRIMARY KEY(enfants_id, parents_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenementiels (id INT AUTO_INCREMENT NOT NULL, activites_id INT DEFAULT NULL, date_evenementiel DATETIME NOT NULL, INDEX IDX_8B3C8AEB5B8C31B7 (activites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journaliers (id INT AUTO_INCREMENT NOT NULL, activites_id INT DEFAULT NULL, date_de_debut_journalier DATETIME NOT NULL, date_fin_journalier DATETIME NOT NULL, option_journalier VARCHAR(255) NOT NULL, INDEX IDX_3585CB615B8C31B7 (activites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, proprietaire_message_id INT DEFAULT NULL, objet_message VARCHAR(255) NOT NULL, contenu_message LONGTEXT NOT NULL, INDEX IDX_DB021E96267A6434 (proprietaire_message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages_user (messages_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5F7E9CF4A5905F5A (messages_id), INDEX IDX_5F7E9CF4A76ED395 (user_id), PRIMARY KEY(messages_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_activites (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB54E2854D8 FOREIGN KEY (typeactivites_id) REFERENCES type_activites (id)');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB54122538A FOREIGN KEY (associations_id) REFERENCES associations (id)');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB5C86024E2 FOREIGN KEY (administrateurs_id) REFERENCES administrateur (id)');
        $this->addSql('ALTER TABLE enfants_parents ADD CONSTRAINT FK_24D94370A586286C FOREIGN KEY (enfants_id) REFERENCES enfants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfants_parents ADD CONSTRAINT FK_24D94370B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenementiels ADD CONSTRAINT FK_8B3C8AEB5B8C31B7 FOREIGN KEY (activites_id) REFERENCES activites (id)');
        $this->addSql('ALTER TABLE journaliers ADD CONSTRAINT FK_3585CB615B8C31B7 FOREIGN KEY (activites_id) REFERENCES activites (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96267A6434 FOREIGN KEY (proprietaire_message_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages_user ADD CONSTRAINT FK_5F7E9CF4A5905F5A FOREIGN KEY (messages_id) REFERENCES messages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages_user ADD CONSTRAINT FK_5F7E9CF4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evenementiels DROP FOREIGN KEY FK_8B3C8AEB5B8C31B7');
        $this->addSql('ALTER TABLE journaliers DROP FOREIGN KEY FK_3585CB615B8C31B7');
        $this->addSql('ALTER TABLE enfants_parents DROP FOREIGN KEY FK_24D94370A586286C');
        $this->addSql('ALTER TABLE messages_user DROP FOREIGN KEY FK_5F7E9CF4A5905F5A');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB54E2854D8');
        $this->addSql('DROP TABLE activites');
        $this->addSql('DROP TABLE enfants');
        $this->addSql('DROP TABLE enfants_parents');
        $this->addSql('DROP TABLE evenementiels');
        $this->addSql('DROP TABLE journaliers');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE messages_user');
        $this->addSql('DROP TABLE type_activites');
    }
}
