<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'home')]
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): RedirectResponse
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('login');
        }
        
        // Redirect based on role
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_dashboard');
        } elseif ($this->isGranted('ROLE_DOCTOR')) {
            return $this->redirectToRoute('doctor_dashboard');
        } elseif ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('user_dashboard');
        }

        return $this->redirectToRoute('login');
    }

    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function adminDashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        return $this->render('dashboard/admin.html.twig', [
            'title' => 'Admin Dashboard',
        ]);
    }

    #[Route('/doctor/dashboard', name: 'doctor_dashboard')]
    public function doctorDashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DOCTOR');
        
        return $this->render('dashboard/doctor.html.twig', [
            'title' => 'Doctor Dashboard',
        ]);
    }

    #[Route('/user/dashboard', name: 'user_dashboard')]
    public function userDashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        return $this->render('dashboard/user.html.twig', [
            'title' => 'Patient Dashboard',
        ]);
    }
}
