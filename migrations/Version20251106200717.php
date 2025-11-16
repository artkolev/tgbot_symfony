<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20251106200717 extends AbstractMigration
{

    const TABLENAME = 'security_user';
    public function getDescription(): string
    {
        return 'Add security_user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
CREATE TABLE IF NOT EXISTS `' . self::TABLENAME . '` (
  `id` bigint,
  `email` CHAR(255) NOT NULL,
  `roles` JSON NOT NULL,
  `password` VARCHAR(255) NOT NULL,

   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci
        ');
        $this->addSql('
INSERT INTO `' . self::TABLENAME . '`
    (`id`, `email`, `roles`, `password`)
VALUES
(1, \'admin@example.com\', \'["ROLE_USER","ROLE_ADMIN"]\', \'$2y$13$ObokljlBT7Jfc4hJtvKtJOqimtC3beCKwNpdiW/nt3PJVVZImAXe2\')
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `' . self::TABLENAME . '`');
    }
}
