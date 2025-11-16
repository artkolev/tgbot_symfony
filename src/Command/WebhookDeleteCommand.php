<?php

namespace App\Command;

use App\Service\TelegramService;
use Doctrine\ORM\EntityManagerInterface;
use Longman\TelegramBot\Exception\TelegramException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:webhook-delete',
    description: 'Delete webhook telegram',
)]
class WebhookDeleteCommand extends Command
{
    public function __construct(
        private readonly KernelInterface $kernel,
        private readonly EntityManagerInterface $entityManager,
        private readonly LoggerInterface $logger
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Удаление вебхука в Telegram...');

        try {
            $telegram = (new TelegramService($this->kernel, $this->entityManager, $this->logger))
                ->createTelegramService();
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
