<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\Support\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20230420123505.
 *
 * @package CoolStuff\Support\Database\Migrations
 */
final class Version20230420123505 extends AbstractMigration
{
    /**
     * Description of this migration.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'Creates a table to persist Shopping List items.';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('tbl_list_items');

        $table->addColumn('id', 'integer', ['unsigned' => true, 'autoincrement'=>true]);
        $table->addColumn('name', 'string', ['length' => 60]);
        $table->addColumn('is_marked', 'boolean');

        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $schema->dropTable('tbl_list_items');
    }
}
