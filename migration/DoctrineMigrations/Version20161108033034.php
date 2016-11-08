<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161108033034 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    // happens after up method is processed
    public function postUp(Schema $schema)
    {
      //$this->connection->executeQuery("INSERT INTO addresses (id, street) VALUES(1,'51 First avenue')");
      $this->connection->executeQuery('UPDATE addresses set economy = "Australia" where id = 1 limit 1');
    }

    // happens after down method is processed
    public function postDown(Schema $schema)
    {
        // this would not work as the table is already gone at this point
        $this->connection->executeQuery('UPDATE addresses set economy = NULL where id = 1 limit 1');
    }
}
