<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\SecurityUserRoleEnum;
use App\Repository\ChatRepository;
use App\Repository\CommandChatRepository;
use App\Repository\MessageRepository;
use App\Repository\SecurityUserRepository;
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
    public function adminChats(Request $request, ChatRepository $chatRepository): Response
    {
        $chats = $chatRepository->findAll();
        return $this->render('admin/chats.html.twig', ['chats' => $chats]);
    }

    #[Route('/chats/edit/{id}', name: '_chat_edit', methods: ['GET'])]
    public function adminChatEdit($id, Request $request, ChatRepository $chatRepository): Response
    {
        $chat = $chatRepository->find($id);
        return $this->render('admin/chat_edit.html.twig', ['chat' => $chat]);
    }

    #[Route('/chats/delete/{id}', name: '_chat_delete', methods: ['GET'])]
    public function adminChatDelete($id, Request $request, ChatRepository $chatRepository): Response
    {
        $chat = $chatRepository->find($id);
        return $this->render('admin/chat_delete.html.twig', ['chat' => $chat]);
    }

    #[Route('/users', name: '_users', methods: ['GET'])]
    public function adminUsers(Request $request, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/users.html.twig', ['users' => $users,]);
    }

    #[Route('/users/edit/{id}', name: '_user_edit', methods: ['GET'])]
    public function adminUserEdit($id, Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->render('admin/user_edit.html.twig', ['user' => $user]);
    }

    #[Route('/users/delete/{id}', name: '_user_delete', methods: ['GET'])]
    public function adminUserDelete($id, Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->render('admin/user_delete.html.twig', ['user' => $user]);
    }

    #[Route('/commands', name: '_commands', methods: ['GET'])]
    public function adminCommands(Request $request, CommandChatRepository $commandChatRepository): Response
    {
        $commands = $commandChatRepository->findAll();
        return $this->render('admin/commands.html.twig', ['commands' => $commands]);
    }

    #[Route('/commands/edit/{id}', name: '_command_edit', methods: ['GET'])]
    public function adminCommandEdit($id, Request $request, CommandChatRepository $commandChatRepository): Response
    {
        $command = $commandChatRepository->find($id);
        return $this->render('admin/command_edit.html.twig', ['command' => $command]);
    }

    #[Route('/commands/delete/{id}', name: '_command_delete', methods: ['GET'])]
    public function adminCommandDelete($id, Request $request, CommandChatRepository $commandChatRepository): Response
    {
        $command = $commandChatRepository->find($id);
        return $this->render('admin/command_delete.html.twig', ['command' => $command]);
    }

    #[Route('/messages', name: '_messages', methods: ['GET'])]
    public function adminMessages(
        Request $request,
        MessageRepository $messageRepository,
        ChatRepository $chatRepository
    ): Response {
        $currentChat = null;
        $chatId = $request->get('chatId');
        if ($chatId) {
            $currentChat = $chatRepository->find($request->get('chatId'));
        }
        $messages = $messageRepository->findAllByPaginator(
            $request->get('page', 1),
            50,
            $currentChat
        );
        $chats = $chatRepository->findAll();
        return $this->render('admin/messages.html.twig', [
            'messages' => $messages,
            'chats' => $chats,
            'currentChat' => $currentChat
        ]);
    }

    #[Route('/messages/delete/{id}', name: '_messages_delete', methods: ['GET'])]
    public function adminMessagesDelete(
        $command,
        $chat_id,
        Request $request,
        MessageRepository $messageRepository
    ): Response {
        $user = $messageRepository->findBy(['command' => $command, 'chat' => $chat_id]);
        return $this->render('admin/security_delete.html.twig', ['user' => $user]);
    }

    #[Route('/security', name: '_security', methods: ['GET'])]
    public function adminSecurity(Request $request, SecurityUserRepository $securityUserRepository): Response
    {
        $admins = $securityUserRepository->findAll();
        return $this->render('admin/security.html.twig', ['admins' => $admins,]);
    }

    #[Route('/security/edit/{id}', name: '_security_edit', methods: ['GET'])]
    public function adminSecurityEdit($id, Request $request, SecurityUserRepository $securityUserRepository): Response
    {
        $user = $securityUserRepository->find($id);
        return $this->render('admin/security_edit.html.twig', ['user' => $user]);
    }

    #[Route('/security/delete/{id}', name: '_security_delete', methods: ['GET'])]
    public function adminSecurityDelete(
        $id,
        Request $request,
        SecurityUserRepository $securityUserRepository
    ): Response {
        $user = $securityUserRepository->find($id);
        return $this->render('admin/security_delete.html.twig', ['user' => $user]);
    }
}
