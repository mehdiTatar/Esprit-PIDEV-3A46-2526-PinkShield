<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorFormType;
use App\Repository\DoctorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route('/doctor')]
class DoctorController extends AbstractController
{
    #[Route('/', name: 'doctor_index')]
    public function index(DoctorRepository $doctorRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $doctors = $doctorRepository->findAll();

        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    #[Route('/new', name: 'doctor_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $doctor = new Doctor();
        $form = $this->createForm(DoctorFormType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctor->setRoles(['ROLE_DOCTOR']);
            $doctor->setPassword($passwordHasher->hashPassword($doctor, $doctor->getPassword()));

            $entityManager->persist($doctor);
            $entityManager->flush();

            return $this->redirectToRoute('doctor_index');
        }

        return $this->render('doctor/form.html.twig', [
            'form' => $form,
            'title' => 'Create Doctor',
        ]);
    }

    #[Route('/{id}/edit', name: 'doctor_edit')]
    public function edit(Request $request, Doctor $doctor, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, TokenStorageInterface $tokenStorage): Response
    {
        // Doctor can only edit their own profile, Admin can edit any doctor
        $currentUser = $tokenStorage->getToken()->getUser();
        if ($currentUser !== $doctor && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(DoctorFormType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('password')->getData()) {
                $doctor->setPassword($passwordHasher->hashPassword($doctor, $form->get('password')->getData()));
            }

            $entityManager->flush();
            $this->addFlash('success', 'Profile updated successfully!');

            return $this->redirectToRoute('doctor_dashboard');
        }

        return $this->render('doctor/form.html.twig', [
            'form' => $form,
            'title' => 'Edit Profile',
        ]);
    }

    #[Route('/{id}/delete', name: 'doctor_delete')]
    public function delete(Request $request, Doctor $doctor, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $entityManager->remove($doctor);
        $entityManager->flush();

        $this->addFlash('success', 'Doctor deleted successfully!');
        return $this->redirectToRoute('doctor_index');
    }

    #[Route('/{id}', name: 'doctor_show')]
    public function show(Doctor $doctor): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }
}
