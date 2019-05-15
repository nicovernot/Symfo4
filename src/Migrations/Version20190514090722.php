<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514090722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505567F5183');
        $this->addSql('DROP INDEX IDX_7A5BC505567F5183 ON `match`');
        $this->addSql('ALTER TABLE `match` CHANGE film_id regle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC5058E12947B FOREIGN KEY (regle_id) REFERENCES regle (id)');
        $this->addSql('CREATE INDEX IDX_7A5BC5058E12947B ON `match` (regle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC5058E12947B');
        $this->addSql('DROP INDEX IDX_7A5BC5058E12947B ON `match`');
        $this->addSql('ALTER TABLE `match` CHANGE regle_id film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_7A5BC505567F5183 ON `match` (film_id)');
    }
}
