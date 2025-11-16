<?php
declare(strict_types=1);

namespace App\Service\BotCommands\UserCommands;

use App\Entity\Chat;
use App\Entity\Message;
use App\Repository\ChatRepository;
use App\Repository\MessageRepository;
use App\Service\UserBaseCommandService;
use Longman\TelegramBot\Entities\ServerResponse;

class TodayStatsCommand extends UserBaseCommandService
{
    /**
     * @var string
     */
    protected $name = 'today_stats';

    /**
     * @var string
     */
    protected $description = 'Статистика сообщений за день';

    /**
     * @var string
     */
    protected $usage = '/today_stats';

    /**
     * Только публичная команда
     *
     * @var bool
     */
    protected $publicOnly = true;
    public function execute(): ServerResponse
    {
        $this->logger->info('Новый запрос дневной статистики');

        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'parse_mode' => 'Markdown',
        ];

        /** @var ChatRepository $chatRepository */
        $chatRepository = $this->em->getRepository(Chat::class);
        /** @var Chat $chat */
        $chat = $chatRepository->find($this->getMessage()->getChat()->getId());

        /** @var MessageRepository $messageRepository */
        $messageRepository = $this->em->getRepository(Message::class);
        $stats = $messageRepository->getPopularUsersByChat($chat);

        $data['text'] = 'Пять самых популярных чатландев за сегодняшний день: \n';
        $this->logger->debug('стата: ' . json_encode($stats));
        return $this->sendAnswerRequest($data);
    }
}
