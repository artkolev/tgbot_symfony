<?php

namespace App\Command;

use App\Entity\Chat;
use App\Repository\ChatRepository;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:today_count_messages',
    description: 'Stats messages by user fron chat',
)]
class TodayCountMessagesCommand extends Command
{
    public function __construct(
        private readonly MessageRepository $messageRepository,
        private readonly ChatRepository $chatRepository,
        private readonly UserRepository $userRepository
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('chatName', InputArgument::REQUIRED, 'Имя чата');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $chatName = $input->getArgument('chatName');

        if (!$chatName) {
            $io->error('Требуется корректное имя чата');
        }

        /** @var Chat $chat */
        $chat = $this->chatRepository->findOneBy(['title' => $chatName]);
        if (!$chat) {
            $io->error('Чат с указаным именем не найден');
        }

        $popularUsersByChat = $this->messageRepository->getPopularUsersByChat($chat);

        $io->success(sprintf('Самые популянтые пользователи чата %s', $chat->getTitle()));
        foreach ($popularUsersByChat as $popularUser) {
            $user = $this->userRepository->findOneBy([sprintf('id = %s', $popularUser['user_id'])]);
            $io->info(sprintf('Пользователь: %s, сообщений %d', $user->getUsername(), $popularUser['count']));
        }

        $io->success('Статистика выгружена');

        return Command::SUCCESS;
    }
}
