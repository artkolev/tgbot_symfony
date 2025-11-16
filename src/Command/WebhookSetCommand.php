<?php

namespace App\Command;

use App\Service\TelegramService;
use Doctrine\ORM\EntityManagerInterface;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsCommand(
    name: 'app:webhook-set',
    description: 'Set webhook telegram',
)]
class WebhookSetCommand extends Command
{
    public function __construct(
        private readonly KernelInterface $kernel,
        private readonly EntityManagerInterface $entityManager,
        private readonly LoggerInterface $logger,
        private readonly UrlGeneratorInterface $urlGenerator
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Установка вебхука в Telegram...');

        try {
            $telegram = (new TelegramService($this->kernel, $this->entityManager, $this->logger))
                ->createTelegramService();

            $result = $telegram->setWebhook($this->urlGenerator->generate(
                'app_webhook',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ));

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
