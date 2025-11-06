<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\SecurityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class DefaultController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(?SecurityUser $user): Response
    {
        if (!$user) {
            return $this->redirectToRoute('security_login');
        }

        return $this->redirectToRoute('admin_index');
    }
}
