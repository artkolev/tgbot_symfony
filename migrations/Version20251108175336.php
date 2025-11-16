<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251108175336 extends AbstractMigration
{
    const TABLENAME = 'reset_password_request';

    public function getDescription(): string
    {
        return 'Add reset password table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
CREATE TABLE IF NOT EXISTS `' . self::TABLENAME . '` (
  `id` bigint UNSIGNED AUTO_INCREMENT,
  `user_id` bigint NULL DEFAULT NULL COMMENT \'Unique user identifier\',
  `selector` VARCHAR(20) NOT NULL,
  `hashed_token` VARCHAR(100) NOT NULL,
  `requested_at` DATETIME NOT NULL,
  `expires_at` DATETIME NOT NULL,

  PRIMARY KEY (`id`),

  FOREIGN KEY (`user_id`) REFERENCES `security_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `' . self::TABLENAME . '`');
    }
}
