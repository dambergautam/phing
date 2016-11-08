<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161108013342 extends AbstractMigration
{
  /**
   * @param Schema $schema
   */
  public function up(Schema $schema)
  {
    $this->addSql('ALTER TABLE addresses add column economy varchar(255) null');
      //$table = $schema->createTable('my_addresses');
      //$table->addColumn('username', 'string');
      //$table->addColumn('password', 'string');
  }

  /**
   * @param Schema $schema
   */
  public function down(Schema $schema)
  {
      // this down() migration is auto-generated, please modify it to your needs
      //$schema->dropTable('my_addresses');
      $this->addSql('alter table address drop column economy');
  }

  // happens after up method is processed
  public function postUp(Schema $schema)
  {
    //$this->connection->executeQuery("INSERT INTO addresses (id, street) VALUES(1,'51 First avenue')");
    //$this->connection->executeQuery('INSERT into addresses (id, street) values(1, "Unit 6, 50 Wilkie St. Yeerongiplly")');
  }

  // happens after down method is processed
  public function postDown(Schema $schema)
  {
       // this would not work as the table is already gone at this point
      //$this->connection->delete('addresses', array());
  }
}
