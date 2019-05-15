<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513195119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE film (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_session (film_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_30FACEF7567F5183 (film_id), INDEX IDX_30FACEF7613FECDF (session_id), PRIMARY KEY(film_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant_session (participant_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_4A491ADC9D1C3019 (participant_id), INDEX IDX_4A491ADC613FECDF (session_id), PRIMARY KEY(participant_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regle (id INT AUTO_INCREMENT NOT NULL, film_id INT DEFAULT NULL, texte VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F0C02F5A567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_session ADD CONSTRAINT FK_30FACEF7567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_session ADD CONSTRAINT FK_30FACEF7613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant_session ADD CONSTRAINT FK_4A491ADC9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant_session ADD CONSTRAINT FK_4A491ADC613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE regle ADD CONSTRAINT FK_F0C02F5A567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE film_session DROP FOREIGN KEY FK_30FACEF7567F5183');
        $this->addSql('ALTER TABLE regle DROP FOREIGN KEY FK_F0C02F5A567F5183');
        $this->addSql('ALTER TABLE participant_session DROP FOREIGN KEY FK_4A491ADC9D1C3019');
        $this->addSql('ALTER TABLE film_session DROP FOREIGN KEY FK_30FACEF7613FECDF');
        $this->addSql('ALTER TABLE participant_session DROP FOREIGN KEY FK_4A491ADC613FECDF');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE film_session');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE participant_session');
        $this->addSql('DROP TABLE regle');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
    }
}
