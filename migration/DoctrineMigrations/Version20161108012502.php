<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161108012502 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
      $table = $schema->createTable('addresses');
      $table->addColumn('id', 'integer', array(
          'autoincrement' => true,
      ));
      $table->addColumn('street', 'string', array('length' => 255));
      $table->setPrimaryKey(array('id'));
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE addresses');
    }

    // happens after up method is processed
    public function postUp(Schema $schema)
    {
        $this->connection->insert("addresses", array('street' =>'51 First avenue'));
    }

    // happens after down method is processed
    public function postDown(Schema $schema) 
    {
         // this would not work as the table is already gone at this point
        //$this->connection->delete('addresses', array());
    }
}
