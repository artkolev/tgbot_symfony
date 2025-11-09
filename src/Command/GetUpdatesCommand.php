<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:get-updates',
    description: 'Add a short description for your command',
)]
class GetUpdatesCommand extends Command
{
    public function __construct(
        private readonly KernelInterface $kernel,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Получение данных из Telegram...');

        $bot_api_key  = $_ENV['BOT_API_KEY'];
        $bot_username = $_ENV['BOT_USERNAME'];

        try {
            $telegram = new Telegram($bot_api_key, $bot_username);
            if ($_ENV['ADMIN_USER']) {
                $telegram->enableAdmin((int) $_ENV['ADMIN_USER']);
            }
            $telegram->enableLimiter();
            $telegram->setDownloadPath($this->kernel->getProjectDir() . '/public/download');
            $telegram->setUploadPath($this->kernel->getProjectDir() . '/public/upload');
            $telegram->addCommandsPath($this->kernel->getProjectDir() . 'src/Service/BotCommands');
            /** @noinspection PhpParamsInspection */
            $telegram->enableExternalMySql($this->entityManager->getConnection()->getNativeConnection());
            $result = $telegram->handleGetUpdates();
            if (!$result->isOk()) {
                $io->error($result->getDescription());
                return Command::FAILURE;
            }
        } catch (TelegramException $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        $io->success('Получение успешно');
        return Command::SUCCESS;
    }
}
