<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803132406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Gerando migration para a criação dos tipos de media';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO media_type (id, description) VALUES (1, 'CD');");
        $this->addSql("INSERT INTO media_type (id, description) VALUES (2, 'DVD');");
        $this->addSql("INSERT INTO media_type (id, description) VALUES (3, 'Livro');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
