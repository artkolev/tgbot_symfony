<?php
declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Longman\TelegramBot\Commands\AdminCommand;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class TelegramService extends Telegram
{
    public function __construct(
        private readonly KernelInterface $kernel,
        private readonly EntityManagerInterface $entityManager,
        private readonly LoggerInterface $logger
    ) {
        $bot_api_key  = $_ENV['BOT_API_KEY'];
        $bot_username = $_ENV['BOT_USERNAME'];

        parent::__construct($bot_api_key, $bot_username);
    }

    public function createTelegramService(): static
    {
        TelegramLog::initialize($this->logger);
        if ($_ENV['ADMIN_USER']) {
            $this->enableAdmin((int) $_ENV['ADMIN_USER']);
        }
        $this->enableLimiter();
        $this->setDownloadPath($this->kernel->getProjectDir() . '/public/download');
        $this->setUploadPath($this->kernel->getProjectDir() . '/public/upload');
        $this->addCommandsPath($this->kernel->getProjectDir() . '/src/Service/BotCommands');
        $this->logger->info('CommandsPath:' . json_encode($this->getCommandsPaths()));
        $this->logger->info('CommandsList:' . json_encode($this->getCommandsList()));
        /** @noinspection PhpParamsInspection */
        $this->enableExternalMySql($this->entityManager->getConnection()->getNativeConnection());

        return $this;
    }

    public function getCommandObject(string $command, string $filepath = ''): ?Command
    {
        if (isset($this->commands_objects[$command])) {
            return $this->commands_objects[$command];
        }

        $which = [Command::AUTH_SYSTEM];
        $this->isAdmin() && $which[] = Command::AUTH_ADMIN;
        $which[] = Command::AUTH_USER;

        foreach ($which as $auth) {
            $command_class = $this->getCommandClassName($auth, $command, $filepath);

            if ($command_class) {
                $command_obj = new $command_class($this, $this->update, $this->logger, $this->entityManager);

                if ($auth === Command::AUTH_SYSTEM && $command_obj instanceof SystemCommand) {
                    return $command_obj;
                }
                if ($auth === Command::AUTH_ADMIN && $command_obj instanceof AdminCommand) {
                    return $command_obj;
                }
                if ($auth === Command::AUTH_USER && $command_obj instanceof UserCommand) {
                    return $command_obj;
                }
            }
        }

        return null;
    }
}
