<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181220153644 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C89D86650F');
        $this->addSql('DROP INDEX UNIQ_BDAFD8C89D86650F ON author');
        $this->addSql('ALTER TABLE author CHANGE user_id user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C88D93D649 FOREIGN KEY (user) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C88D93D649 ON author (user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C88D93D649');
        $this->addSql('DROP INDEX UNIQ_BDAFD8C88D93D649 ON author');
        $this->addSql('ALTER TABLE author CHANGE user user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C89D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C89D86650F ON author (user_id)');
    }
}
