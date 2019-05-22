<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190522193802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE team_calling');
        $this->addSql('ALTER TABLE calling ADD teams_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE calling ADD CONSTRAINT FK_A606C573D6365F12 FOREIGN KEY (teams_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_A606C573D6365F12 ON calling (teams_id)');
        $this->addSql('ALTER TABLE `match` DROP competition');
        $this->addSql('ALTER TABLE team DROP opponent');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team_calling (team_id INT NOT NULL, calling_id INT NOT NULL, INDEX IDX_597FB444296CD8AE (team_id), INDEX IDX_597FB4446F1895A1 (calling_id), PRIMARY KEY(team_id, calling_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE team_calling ADD CONSTRAINT FK_597FB444296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_calling ADD CONSTRAINT FK_597FB4446F1895A1 FOREIGN KEY (calling_id) REFERENCES calling (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calling DROP FOREIGN KEY FK_A606C573D6365F12');
        $this->addSql('DROP INDEX IDX_A606C573D6365F12 ON calling');
        $this->addSql('ALTER TABLE calling DROP teams_id');
        $this->addSql('ALTER TABLE `match` ADD competition VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE team ADD opponent VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
