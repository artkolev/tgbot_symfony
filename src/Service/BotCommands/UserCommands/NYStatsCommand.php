<?php

declare(strict_types=1);

namespace App\Service\BotCommands\UserCommands;

use App\Entity\Chat;
use App\Entity\Message;
use App\Repository\ChatRepository;
use App\Repository\MessageRepository;
use App\Service\UserBaseCommandService;
use Longman\TelegramBot\Entities\ServerResponse;

class NYStatsCommand extends UserBaseCommandService
{
    /**
     * @var string
     */
    protected $name = 'NY_stats';

    /**
     * @var string
     */
    protected $description = 'Статистика сообщений за год';

    /**
     * @var string
     */
    protected $usage = '/NY_stats';

    protected bool $publicOnly = true;
    public function execute(): ServerResponse
    {
        $this->logger->info('Новый запрос новогодней статистики');

        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'parse_mode' => 'HTML',
        ];

        /** @var ChatRepository $chatRepository */
        $chatRepository = $this->em->getRepository(Chat::class);
        /** @var Chat $chat */
        $chat = $chatRepository->find($this->getMessage()->getChat()->getId());

        /** @var MessageRepository $messageRepository */
        $messageRepository = $this->em->getRepository(Message::class);

        $data['text'] = "Пять самых популярных чатландев: \n\n";

        $stats = $messageRepository->getPopularUsersByYear($chat);
        $this->logger->debug('стата: ' . json_encode($stats));

        $data['text'] .= $this->getTextByStats($stats);

        $data['text'] .= "\n\nПять самых тихих чатландев (более 5 мсг): \n\n";
        $stats = $messageRepository->getQuietUsersByYear($chat);

        $data['text'] .= "\n Приятного общения!";

        return $this->sendAnswerRequest($data);
    }

    private function getTextByStats(array $stats): string
    {
        $text = "Имя - количество сообщений \n";

        foreach ($stats as $stat) {
            if (trim($stat['first_name']) !== '' || trim($stat['last_name']) !== '') {
                $text .= $stat['first_name'] . ' ' . $stat['last_name'];
            } else {
                $text .= $stat['username'];
            }
            $text .= '  -  ' . $stat['count'] . "\n";
        }

        return $text;
    }
}
