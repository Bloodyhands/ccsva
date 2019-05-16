<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516175052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, images_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, age INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_7D3656A4D44F05E5 (images_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calling (id INT AUTO_INCREMENT NOT NULL, competition VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE division (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, score VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, age INT NOT NULL, email VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff_team (staff_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_26D6D090D4D57CD (staff_id), INDEX IDX_26D6D090296CD8AE (team_id), PRIMARY KEY(staff_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff_calling (staff_id INT NOT NULL, calling_id INT NOT NULL, INDEX IDX_FAB0D2C5D4D57CD (staff_id), INDEX IDX_FAB0D2C56F1895A1 (calling_id), PRIMARY KEY(staff_id, calling_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, divisions_id INT DEFAULT NULL, images_id INT DEFAULT NULL, category VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C4E0A61F73540333 (divisions_id), INDEX IDX_C4E0A61FD44F05E5 (images_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_match (team_id INT NOT NULL, match_id INT NOT NULL, INDEX IDX_BD5D8C45296CD8AE (team_id), INDEX IDX_BD5D8C452ABEACD6 (match_id), PRIMARY KEY(team_id, match_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_calling (team_id INT NOT NULL, calling_id INT NOT NULL, INDEX IDX_597FB444296CD8AE (team_id), INDEX IDX_597FB4446F1895A1 (calling_id), PRIMARY KEY(team_id, calling_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4D44F05E5 FOREIGN KEY (images_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE staff_team ADD CONSTRAINT FK_26D6D090D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_team ADD CONSTRAINT FK_26D6D090296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_calling ADD CONSTRAINT FK_FAB0D2C5D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_calling ADD CONSTRAINT FK_FAB0D2C56F1895A1 FOREIGN KEY (calling_id) REFERENCES calling (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F73540333 FOREIGN KEY (divisions_id) REFERENCES division (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FD44F05E5 FOREIGN KEY (images_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C45296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_match ADD CONSTRAINT FK_BD5D8C452ABEACD6 FOREIGN KEY (match_id) REFERENCES `match` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_calling ADD CONSTRAINT FK_597FB444296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_calling ADD CONSTRAINT FK_597FB4446F1895A1 FOREIGN KEY (calling_id) REFERENCES calling (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE staff_calling DROP FOREIGN KEY FK_FAB0D2C56F1895A1');
        $this->addSql('ALTER TABLE team_calling DROP FOREIGN KEY FK_597FB4446F1895A1');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F73540333');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4D44F05E5');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FD44F05E5');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C452ABEACD6');
        $this->addSql('ALTER TABLE staff_team DROP FOREIGN KEY FK_26D6D090D4D57CD');
        $this->addSql('ALTER TABLE staff_calling DROP FOREIGN KEY FK_FAB0D2C5D4D57CD');
        $this->addSql('ALTER TABLE staff_team DROP FOREIGN KEY FK_26D6D090296CD8AE');
        $this->addSql('ALTER TABLE team_match DROP FOREIGN KEY FK_BD5D8C45296CD8AE');
        $this->addSql('ALTER TABLE team_calling DROP FOREIGN KEY FK_597FB444296CD8AE');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE calling');
        $this->addSql('DROP TABLE division');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE staff_team');
        $this->addSql('DROP TABLE staff_calling');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_match');
        $this->addSql('DROP TABLE team_calling');
        $this->addSql('DROP TABLE user');
    }
}
