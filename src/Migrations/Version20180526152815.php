<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180526152815 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Authors (id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Posts (id VARCHAR(36) NOT NULL, author_id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX author_index (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Posts ADD CONSTRAINT FK_499C95FEF675F31B FOREIGN KEY (author_id) REFERENCES Authors (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Posts DROP FOREIGN KEY FK_499C95FEF675F31B');
        $this->addSql('DROP TABLE Authors');
        $this->addSql('DROP TABLE Posts');
    }
}
