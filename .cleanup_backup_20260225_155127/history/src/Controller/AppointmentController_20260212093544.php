<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Notification;
use App\Repository\AppointmentRepository;
use App\Repository\DoctorRepository;
use App\Repository\DailyTrackingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ParapharmacieType;
use App\Form\AppointmentFormType;
use App\Entity\Parapharmacie;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/appointment')]
class AppointmentController extends AbstractController
{
    #[Route('/', name: 'appointment_index')]
    public function index(AppointmentRepository $appointmentRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $appointments = [];

        if ($this->isGranted('ROLE_ADMIN')) {
            $appointments = $appointmentRepository->findAll();
        } elseif ($this->isGranted('ROLE_DOCTOR')) {
            $appointments = $appointmentRepository->findByDoctor($user->getUserIdentifier());
        } elseif ($this->isGranted('ROLE_USER')) {
            $appointments = $appointmentRepository->findByPatient($user->getUserIdentifier());
        }

        return $this->render('appointment/index.html.twig', [
            'appointments' => $appointments,
        ]);
    }

    #[Route('/new', name: 'appointment_new')]
    public function new(Request $request, DoctorRepository $doctorRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if ($this->isGranted('ROLE_DOCTOR') || $this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Only patients can book appointments.');
            return $this->redirectToRoute('appointment_index');
        }

        $appointment = new Appointment();
        $appointment->setPatientEmail($this->getUser()->getUserIdentifier());
        $appointment->setPatientName($this->getUser() instanceof User ? $this->getUser()->getFullName() : 'Patient');
        $appointment->setStatus('pending');

        $form = $this->createForm(AppointmentFormType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$appointment->getAppointmentDate()) {
                $this->addFlash('error', 'Appointment date is required and must be in the future.');
                return $this->render('appointment/new.html.twig', [
                    'form' => $form->createView(),
                    'doctors' => $doctorRepository->findAll(),
                ]);
            }

            if ($appointment->getDoctorEmail()) {
                $doctor = $doctorRepository->findOneBy(['email' => $appointment->getDoctorEmail()]);
                if ($doctor) {
                    $appointment->setDoctorName($doctor->getFullName());
                }
            }

            $entityManager->persist($appointment);

            $allUsers = $userRepository->findAll();
            foreach ($allUsers as $user) {
                if (in_array('ROLE_ADMIN', $user->getRoles())) {
                    $notification = new Notification