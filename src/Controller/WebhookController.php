<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;

final class WebhookController extends AbstractController
{

    #[Route('/webhook', name: 'app_webhook')]
    public function index(): Response
    {
        return new Response('Ok', Response::HTTP_OK);
    }
    #[Route('/webhook/{token}', name: 'app_webhook_handle')]
    public function handleWebhook(
        $token,
        KernelInterface $kernel,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager
    ): Response {
        if ($token !==$_ENV['BOT_API_KEY']) {
            return new Response('Invalid token', Response::HTTP_FORBIDDEN);
        }

        $bot_api_key  = $_ENV['BOT_API_KEY'];
        $bot_username = $_ENV['BOT_USERNAME'];

        try {
            $telegram = new Telegram($bot_api_key, $bot_username);
            if ($_ENV['ADMIN_USER']) {
                $telegram->enableAdmin((int) $_ENV['ADMIN_USER']);
            }
            $telegram->enableLimiter();
            $telegram->setDownloadPath($kernel->getProjectDir() . '/public/download');
            $telegram->setUploadPath($kernel->getProjectDir() . '/public/upload');
            $telegram->addCommandsPath($kernel->getProjectDir() . 'src/Service/BotCommands');
            /** @noinspection PhpParamsInspection */
            $telegram->enableExternalMySql($entityManager->getConnection()->getNativeConnection());
            $telegram->handle();
        } catch (TelegramException $e) {
            $logger->error($e->getMessage());
            return new Response('Error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new Response('Ok', Response::HTTP_OK);
    }
}
