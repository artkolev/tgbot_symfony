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
    name: 'app:webhook-set',
    description: 'Set webhook telegram',
)]
class WebhookSetCommand extends Command
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator,)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Установка вебхука в Telegram...');

        $bot_api_key  = $_ENV['BOT_API_KEY'];
        $bot_username = $_ENV['BOT_USERNAME'];
        $hook_url = $this->urlGenerator->generate('app_webhook', [], UrlGeneratorInterface::ABSOLUTE_URL);

        try {
            $telegram = new Telegram($bot_api_key, $bot_username);
            $result = $telegram->setWebhook($hook_url);
            if ($result->isOk()) {
                $io->note($result->getDescription());
            }
        } catch (TelegramException $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        $io->success('Установка успешна');
        return Command::SUCCESS;
    }
}
