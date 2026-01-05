<?php

declare(strict_types=1);

namespace App\Service\BotCommands\UserCommands;

use App\Service\UserBaseCommandService;
use Doctrine\ORM\EntityManager;
use Exception;
use GuzzleHttp\Client;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PadonakCommand extends UserBaseCommandService
{
    /**
     * @var string
     */
    protected $name = 'padonak';

    /**
     * @var string
     */
    protected $description = 'Перевод на йАзЫг пАдОнКаФф';

    /**
     * @var string
     */
    protected $usage = '/padonak <текст>';

    protected $show_in_help = true;

    protected $version = '1.0.0';

    protected $enabled = true;

    /**
     * Ответить отправителю команды
     *
     * @var bool
     */
    protected bool $replyToSender = true;
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $chatId = $message->getChat()->getId();
        $text = mb_strtolower(trim($message->getText(true)));

        $data = [
            'chat_id' => $chatId,
            'parse_mode' => 'markdown',
        ];

        if (empty($text) && empty($message->getReplyToMessage())) {
            $data['text'] = 'Отсутствует текст запроса';
            return $this->sendAnswerRequest($data);
        }

        if (empty($text)) {
            $text = mb_strtolower(trim($message->getReplyToMessage()->getText(true)));
        }

        $cacheKey = sha1(self::class . $text);

        TelegramLog::debug('Проверка наличия в кеше по ключу ' . $cacheKey);
        $padonakText = $this->cache->get($cacheKey, callback: function ($text, ItemInterface $item): string {
            $item->expiresAfter(3600);

            TelegramLog::debug('Кеш отсуствует, получаем с сервиса и сохраняем');
            try {
                $client = new Client([
                    'base_uri' => 'https://javer.kiev.ua/',
                    'connect_timeout' => 10,
                    'timeout' => 60
                ]);
                $serviceText = str_replace('_', ' ', $text);
                $response = $client->get(
                    sprintf('alban.php?input=%s', urlencode(mb_convert_encoding($serviceText, 'cp-1251', 'utf-8')))
                );

                if ($responseText = $response->getBody()) {
                    $responseText = mb_convert_encoding($responseText, 'utf-8', 'cp-1251');
                    preg_match('~<h2>.+</h2>\s*<textarea.*>(.*?)</textarea~ism', $responseText, $matches);
                    $text = urldecode(trim($matches[1]));
                }
            } catch (Exception $e) {
                TelegramLog::error($e->getMessage());
            }

            $padonakText = '';
            $key = 0;
            $strLen = mb_strlen($text);

            while ($strLen && $key < 1000) {
                $newChar = mb_substr($text, 0, 1);
                if (preg_match('~[a-zа-я]+~i', $newChar)) {
                    if ($key++ % 2 === 0) {
                        $newChar = mb_strtoupper($newChar);
                    }
                }
                $padonakText .= $newChar;
                $text = mb_substr($text, 1, $strLen);
                $strLen = mb_strlen($text);
            }

            return $padonakText;
        });

        $data['text'] = $padonakText;

        return $this->sendAnswerRequest($data);
    }
}
