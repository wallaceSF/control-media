<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803130415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Gerando Migration para a criação dos status da media';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO media_status (id, description) VALUES (1, 'Disponivel');");
        $this->addSql("INSERT INTO media_status (id, description) VALUES (2, 'Emprestado');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
