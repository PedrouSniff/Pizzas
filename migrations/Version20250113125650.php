<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113125650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pizza_classique_ing (pizza_id INT NOT NULL, classique_ing_id INT NOT NULL, INDEX IDX_E2340738D41D1D42 (pizza_id), INDEX IDX_E23407384D790010 (classique_ing_id), PRIMARY KEY(pizza_id, classique_ing_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizza_classique_ing ADD CONSTRAINT FK_E2340738D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_classique_ing ADD CONSTRAINT FK_E23407384D790010 FOREIGN KEY (classique_ing_id) REFERENCES classique_ing (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_classique_ing DROP FOREIGN KEY FK_E2340738D41D1D42');
        $this->addSql('ALTER TABLE pizza_classique_ing DROP FOREIGN KEY FK_E23407384D790010');
        $this->addSql('DROP TABLE pizza_classique_ing');
    }
}
