<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251108191049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add command_chat table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
CREATE TABLE IF NOT EXISTS `command_chat` (
  `command` VARCHAR(255),
  `chat_id` bigint COMMENT \'Unique user or chat identifier\',

  PRIMARY KEY (`command`, `chat_id`),

  FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `command_chat`');
    }
}
