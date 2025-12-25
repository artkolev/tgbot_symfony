<?php

declare(strict_types=1);

namespace App\Service\BotCommands\UserCommands;

use App\Entity\CommandSlapPhases;
use App\Repository\CommandSlapPhasesRepository;
use App\Service\UserBaseCommandService;
use Longman\TelegramBot\Entities\ServerResponse;

class SlapCommand extends UserBaseCommandService
{
    /**
     * @var string
     */
    protected $name = 'slap';

    /**
     * @var string
     */
    protected $description = 'Пинок кому-то по имени пользователя';

    /**
     * @var string
     */
    protected $usage = '/slap <@user>';

    /**
     * @var bool
     */
    protected $enabled = true;

    protected bool $publicOnly = true;

    protected bool $replyToSender = true;

    public function execute(): ServerResponse
    {
        $this->logger->info('Новый запрос пощечины');

        $message = $this->getMessage();

        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'parse_mode' => 'Markdown',
        ];

        $targetLnk = null;
        if (!($senderLnk = $this->getSenderLink()) || !($targetLnk = $this->getTargetLink())) {
            $this->logger->error('Не получены адресаты запроса', [$senderLnk, $targetLnk, $message->toJson()]);
            $data['text'] = 'Жаль, но некому дать пощечину.. Смотри `/help slap`.';
            return $this->sendAnswerRequest($data);
        }

        $this->replyToSender = false;
        $data['disable_web_page_preview'] = true;

        /** @var CommandSlapPhasesRepository $commandSlapPhasesRepository */
        $commandSlapPhasesRepository = $this->em->getRepository(CommandSlapPhases::class);

        /** @var CommandSlapPhases[] $phases */
        $phases = $commandSlapPhasesRepository->findBy(['active' => 1]);
        $phraseKey = array_rand($phases);
        $this->logger->info('Выбрана фраза №' . $phraseKey);
        $data['text'] = sprintf($phases[$phraseKey]->getPhase(), $senderLnk, $targetLnk);

        return $this->sendAnswerRequest($data);
    }
}
