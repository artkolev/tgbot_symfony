<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\SecurityUserRoleEnum;
use App\Repository\ChatRepository;
use App\Repository\CommandChatRepository;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin', name: 'admin')]
#[IsGranted(SecurityUserRoleEnum::ROLE_ADMIN->value)]
final class AdminController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(
        Request $request,
        UserRepository $userRepository,
        ChatRepository $chatRepository,
        MessageRepository $messageRepository,
        CommandChatRepository $commandChatRepository
    ): Response {
        $users_count = $userRepository->getCount();
        $chats_count = $chatRepository->getCount();
        $messages_count = $messageRepository->getCount();
        $command_chats_count = $commandChatRepository->getCount();
        return $this->render(
            'admin/index.html.twig',
            [
                'users_count' => $users_count,
                'chats_count' => $chats_count,
                'messages_count' => $messages_count,
                'command_chats_count' => $command_chats_count,
            ]
        );
    }

    #[Route('/chats', name: '_chats', methods: ['GET'])]
    public function chats(Request $request): Response
    {
        return $this->render('admin/chats.html.twig');
    }

    #[Route('/users', name: '_users', methods: ['GET'])]
    public function users(Request $request): Response
    {
        return $this->render('admin/users.html.twig');
    }

    #[Route('/commands', name: '_commands', methods: ['GET'])]
    public function commands(Request $request): Response
    {
        return $this->render('admin/commands.html.twig');
    }

    #[Route('/online', name: '_online', methods: ['GET'])]
    public function online(Request $request): Response
    {
        return $this->render('admin/online.html.twig');
    }
}
