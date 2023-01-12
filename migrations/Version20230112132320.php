<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112132320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE halls (id INT AUTO_INCREMENT NOT NULL, name_hall VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, id_recommendation_id INT DEFAULT NULL, title_movie VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, producer VARCHAR(255) DEFAULT NULL, actors LONGTEXT DEFAULT NULL, time_movie VARCHAR(255) NOT NULL, year_movie VARCHAR(255) NOT NULL, image_movie VARCHAR(255) DEFAULT NULL, video_movie VARCHAR(255) DEFAULT NULL, description_movie VARCHAR(255) DEFAULT NULL, INDEX IDX_C61EED30A545015 (id_category_id), INDEX IDX_C61EED302044FC1C (id_recommendation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title_new VARCHAR(255) NOT NULL, image_new VARCHAR(255) DEFAULT NULL, video_new VARCHAR(255) DEFAULT NULL, description_new LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommendations (id INT AUTO_INCREMENT NOT NULL, forbidden_age VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions (id INT AUTO_INCREMENT NOT NULL, id_hall_id INT NOT NULL, id_movie_id INT NOT NULL, month_movie VARCHAR(255) DEFAULT NULL, hour_movie VARCHAR(255) DEFAULT NULL, day_movie VARCHAR(255) DEFAULT NULL, INDEX IDX_9A609D138C3266A6 (id_hall_id), INDEX IDX_9A609D13DF485A69 (id_movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED30A545015 FOREIGN KEY (id_category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED302044FC1C FOREIGN KEY (id_recommendation_id) REFERENCES recommendations (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D138C3266A6 FOREIGN KEY (id_hall_id) REFERENCES halls (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D13DF485A69 FOREIGN KEY (id_movie_id) REFERENCES movies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED30A545015');
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED302044FC1C');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D138C3266A6');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D13DF485A69');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE halls');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE recommendations');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
