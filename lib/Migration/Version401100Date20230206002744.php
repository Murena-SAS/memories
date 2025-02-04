<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2023 Varun Patil <radialapps@gmail.com>
 * @author Varun Patil <radialapps@gmail.com>
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace OCA\Memories\Migration;

use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version401100Date20230206002744 extends SimpleMigrationStep
{
    /**
     * @param \Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
     */
    public function preSchemaChange(IOutput $output, \Closure $schemaClosure, array $options): void {}

    /**
     * @param \Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
     */
    public function changeSchema(IOutput $output, \Closure $schemaClosure, array $options): ?ISchemaWrapper
    {
        /** @var ISchemaWrapper $schema */
        $schema = $schemaClosure();

        if (!$schema->hasTable('memories_places')) {
            $table = $schema->createTable('memories_places');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('fileid', Types::BIGINT, [
                'notnull' => true,
                'length' => 20,
            ]);
            $table->addColumn('osm_id', Types::INTEGER, [
                'notnull' => true,
            ]);

            $table->setPrimaryKey(['id']);
            $table->addIndex(['fileid'], 'memories_places_fileid_index');
            $table->addIndex(['osm_id'], 'memories_places_osm_id_index');
        }

        if (!$schema->hasTable('memories_planet')) {
            $table = $schema->createTable('memories_planet');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('osm_id', Types::INTEGER, [
                'notnull' => true,
            ]);
            $table->addColumn('name', Types::TEXT, [
                'notnull' => true,
            ]);
            $table->addColumn('admin_level', Types::INTEGER, [
                'notnull' => true,
            ]);

            $table->setPrimaryKey(['id']);
            $table->addIndex(['osm_id'], 'memories_planet_osm_id_index');
        }

        return $schema;
    }

    /**
     * @param \Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
     */
    public function postSchemaChange(IOutput $output, \Closure $schemaClosure, array $options): void {}
}
