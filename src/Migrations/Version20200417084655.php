<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200417084655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD users_id INT NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BFDD316867B3B43D ON articles (users_id)');
        $this->addSql('ALTER TABLE proprietaires CHANGE numero numero VARCHAR(255) DEFAULT NULL, CHANGE voie voie VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE tel_perso tel_perso VARCHAR(255) DEFAULT NULL, CHANGE tel_pro tel_pro VARCHAR(255) DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL, CHANGE bic bic VARCHAR(255) DEFAULT NULL, CHANGE iban iban VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316867B3B43D');
        $this->addSql('DROP INDEX IDX_BFDD316867B3B43D ON articles');
        $this->addSql('ALTER TABLE articles DROP users_id, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE proprietaires CHANGE numero numero VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE voie voie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel_perso tel_perso VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel_pro tel_pro VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE bic bic VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE iban iban VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
