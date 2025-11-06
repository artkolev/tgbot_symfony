<?php

declare(strict_types=1);

namespace App\Controller;

use App\Enum\SecurityUserRoleEnum;
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
    public function index(Request $request): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
