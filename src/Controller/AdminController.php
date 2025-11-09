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
    public function chats(Request $request, ChatRepository $chatRepository): Response
    {
        $chats = $chatRepository->findAll();
        return $this->render('admin/chats.html.twig', ['chats' => $chats]);
    }

    #[Route('/users/edit/{id}', name: '_chat_edit', methods: ['GET'])]
    public function admin_chat_edit(Request $request, ChatRepository $chatRepository): Response
    {
        $chat = $chatRepository->find($request->attributes->get('id'));
        return $this->render('admin/user_edit.html.twig', ['chat' => $chat]);
    }

    #[Route('/users/delete/{id}', name: '_chat_delete', methods: ['GET'])]
    public function admin_chat_delete(Request $request, ChatRepository $chatRepository): Response
    {
        $chat = $chatRepository->find($request->attributes->get('id'));
        return $this->render('admin/user_delete.html.twig', ['chat' => $chat]);
    }

    #[Route('/users', name: '_users', methods: ['GET'])]
    public function users(Request $request, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/users.html.twig', ['users' => $users,]);
    }

    #[Route('/users/edit/{id}', name: '_user_edit', methods: ['GET'])]
    public function admin_user_edit(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($request->attributes->get('id'));
        return $this->render('admin/user_edit.html.twig', ['user' => $user]);
    }

    #[Route('/users/delete/{id}', name: '_user_delete', methods: ['GET'])]
    public function admin_user_delete(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($request->attributes->get('id'));
        return $this->render('admin/user_delete.html.twig', ['user' => $user]);
    }

    #[Route('/commands', name: '_commands', methods: ['GET'])]
    public function commands(Request $request, CommandChatRepository $commandChatRepository): Response
    {
        $commands = $commandChatRepository->findAll();
        return $this->render('admin/commands.html.twig', ['commands' => $commands]);
    }

    #[Route('/commands/edit/{id}', name: '_command_edit', methods: ['GET'])]
    public function admin_command_edit(Request $request, CommandChatRepository $commandChatRepository): Response
    {
        $command = $commandChatRepository->find($request->attributes->get('id'));
        return $this->render('admin/command_edit.html.twig', ['command' => $command]);
    }

    #[Route('/commands/delete/{id}', name: '_command_delete', methods: ['GET'])]
    public function admin_command_delete(Request $request, CommandChatRepository $commandChatRepository): Response
    {
        $command = $commandChatRepository->find($request->attributes->get('id'));
        return $this->render('admin/command_delete.html.twig', ['command' => $command]);
    }

    #[Route('/messages', name: '_messages', methods: ['GET'])]
    public function messages(Request $request, MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findAllByPaginator($request->get('page', 1), 10);
        return $this->render('admin/messages.html.twig', ['messages' => $messages]);
    }

    #[Route('/security', name: '_security', methods: ['GET'])]
    public function admin_security(Request $request, SecurityUserRepository $securityUserRepository): Response
    {
        $admins = $securityUserRepository->findAll();
        return $this->render('admin/security.html.twig', ['admins' => $admins,]);
    }

    #[Route('/security/edit/{id}', name: '_security_edit', methods: ['GET'])]
    public function admin_security_edit(Request $request, SecurityUserRepository $securityUserRepository): Response
    {
        $user = $securityUserRepository->find($request->attributes->get('id'));
        return $this->render('admin/security_edit.html.twig', ['user' => $user]);
    }

    #[Route('/security/delete/{id}', name: '_security_delete', methods: ['GET'])]
    public function admin_security_delete(Request $request, SecurityUserRepository $securityUserRepository): Response
    {
        $user = $securityUserRepository->find($request->attributes->get('id'));
        return $this->render('admin/security_delete.html.twig', ['user' => $user]);
    }
}
