<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211016204054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ALTER date_created SET DEFAULT now()');
        $this->addSql('ALTER TABLE order_item ALTER date_created SET DEFAULT now()');
        $this->addSql('ALTER TABLE product ALTER date_created SET DEFAULT now()');
        $this->addSql('ALTER TABLE reservation ALTER date_created SET DEFAULT now()');
        $this->addSql('ALTER TABLE stock ALTER date_created SET DEFAULT now()');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reservation ALTER date_created SET NOT NULL');
        $this->addSql('ALTER TABLE product ALTER date_created SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER date_created SET NOT NULL');
        $this->addSql('ALTER TABLE order_item ALTER date_created SET NOT NULL');
        $this->addSql('ALTER TABLE stock ALTER date_created SET NOT NULL');
    }
}
