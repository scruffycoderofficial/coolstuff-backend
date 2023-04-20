<?php

declare(strict_types=1);

namespace Racoon\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420123505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates a table to persist Shopping List items.';
    }

    public function up(Schema $schema): void
    {
        $myTable = $schema->createTable('shopping_items');

        $myTable->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement'=>true]);
        $myTable->addColumn('name', 'string', ['length' => 60]);
        $myTable->addColumn('is_checked', 'boolean');

        $myTable->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('shopping_items');
    }
}
