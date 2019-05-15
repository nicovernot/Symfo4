<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514083252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_participant (match_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_E5061A392ABEACD6 (match_id), INDEX IDX_E5061A399D1C3019 (participant_id), PRIMARY KEY(match_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_film (match_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_E32B0F502ABEACD6 (match_id), INDEX IDX_E32B0F50567F5183 (film_id), PRIMARY KEY(match_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_participant ADD CONSTRAINT FK_E5061A392ABEACD6 FOREIGN KEY (match_id) REFERENCES `match` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_participant ADD CONSTRAINT FK_E5061A399D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_film ADD CONSTRAINT FK_E32B0F502ABEACD6 FOREIGN KEY (match_id) REFERENCES `match` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_film ADD CONSTRAINT FK_E32B0F50567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE match_participant DROP FOREIGN KEY FK_E5061A392ABEACD6');
        $this->addSql('ALTER TABLE match_film DROP FOREIGN KEY FK_E32B0F502ABEACD6');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE match_participant');
        $this->addSql('DROP TABLE match_film');
    }
}
