<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190509191135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, film_id INT NOT NULL, participant_id INT NOT NULL, regle_id INT NOT NULL, INDEX IDX_7A5BC505613FECDF (session_id), INDEX IDX_7A5BC505567F5183 (film_id), INDEX IDX_7A5BC5059D1C3019 (participant_id), INDEX IDX_7A5BC5058E12947B (regle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regle (id INT AUTO_INCREMENT NOT NULL, film_id INT NOT NULL, texte VARCHAR(255) NOT NULL, INDEX IDX_F0C02F5A567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, INDEX IDX_D79F6B11613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_8244BE22613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC5059D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC5058E12947B FOREIGN KEY (regle_id) REFERENCES regle (id)');
        $this->addSql('ALTER TABLE regle ADD CONSTRAINT FK_F0C02F5A567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC5058E12947B');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505613FECDF');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11613FECDF');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22613FECDF');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC5059D1C3019');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505567F5183');
        $this->addSql('ALTER TABLE regle DROP FOREIGN KEY FK_F0C02F5A567F5183');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE regle');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE film');
    }
}
