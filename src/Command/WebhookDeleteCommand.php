<?php

namespace App\Command;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsCommand(
    name: 'app:webhook-delete',
    description: 'Set webhook telegram',
)]
class WebhookDeleteCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Удаление вебхука в Telegram...');

        $bot_api_key  = $_ENV['BOT_API_KEY'];
        $bot_username = $_ENV['BOT_USERNAME'];

        try {
            $telegram = new Telegram($bot_api_key, $bot_username);
            $result = $telegram->deleteWebhook();
            if ($result->isOk()) {
                $io->note($result->getDescription());
            } else {
                $io->error($result->getDescription());
                return Command::FAILURE;
            }
        } catch (TelegramException $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        $io->success('Удаление успешно');
        return Command::SUCCESS;
    }
}
