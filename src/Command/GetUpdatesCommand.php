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
    name: 'app:get-updates',
    description: 'Get updates from telegram',
)]
class GetUpdatesCommand extends Command
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

        $io->note('Получение данных из Telegram...');

        try {
            $telegram = (new TelegramService($this->kernel, $this->entityManager, $this->logger))
                ->createTelegramService();

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
