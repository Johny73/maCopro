<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200417084942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaires ADD articles_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C41EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C41EBAF6CC ON commentaires (articles_id)');
        $this->addSql('ALTER TABLE proprietaires CHANGE numero numero VARCHAR(255) DEFAULT NULL, CHANGE voie voie VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE tel_perso tel_perso VARCHAR(255) DEFAULT NULL, CHANGE tel_pro tel_pro VARCHAR(255) DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL, CHANGE bic bic VARCHAR(255) DEFAULT NULL, CHANGE iban iban VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C41EBAF6CC');
        $this->addSql('DROP INDEX IDX_D9BEC0C41EBAF6CC ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP articles_id');
        $this->addSql('ALTER TABLE proprietaires CHANGE numero numero VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE voie voie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel_perso tel_perso VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel_pro tel_pro VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bic bic VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE iban iban VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
