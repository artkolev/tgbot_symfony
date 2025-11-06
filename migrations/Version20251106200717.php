<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251106200717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add security_user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
CREATE TABLE IF NOT EXISTS `security_user` (
  `id` bigint,
  `email` CHAR(255) NOT NULL,
  `roles` JSON NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `security_user`');
    }
}
