<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminFormType;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/manage-admins', name: 'admin_index')]
    public function index(AdminRepository $adminRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $admins = $adminRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'admins' => $admins,
        ]);
    }

    #[Route('/new', name: 'admin_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $admin = new Admin();
        $form = $this->createForm(AdminFormType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($passwordHasher->hashPassword($admin, $admin->getPassword()));

            $entityManager->persist($admin);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/form.html.twig', [
            'form' => $form,
            'title' => 'Create Admin',
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_edit', requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id, AdminRepository $adminRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $admin = $adminRepository->find($id);
        if (!$admin) {
            throw $this->createNotFoundException('Admin not found');
        }

        $form = $this->createForm(AdminFormType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('password')->getData()) {
                $admin->setPassword($passwordHasher->hashPassword($admin, $form->get('password')->getData()));
            }

            $entityManager->flush();
            $this->addFlash('success', 'Admin profile updated successfully!');

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/form.html.twig', [
            'form' => $form,
            'title' => 'Edit Admin',
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_delete', requirements: ['id' => '\d+'])]
    public function delete(Request $request, int $id, AdminRepository $adminRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $admin = $adminRepository->find($id);
        if (!$admin) {
            throw $this->createNotFoundException('Admin not found');
        }

        $entityManager->remove($admin);
        $entityManager->flush();

        $this->addFlash('success', 'Admin deleted successfully!');
        return $this->redirectToRoute('admin_index');
    }

    #[Route('/{id}', name: 'admin_show', requirements: ['id' => '\d+'])]
    public function show(int $id, AdminRepository $adminRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $admin = $adminRepository->find($id);
        if (!$admin) {
            throw $this->createNotFoundException('Admin not found');
        }

        return $this->render('admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }
}
