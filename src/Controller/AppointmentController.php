<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\User;
use App\Entity\Doctor;
use App\Repository\AppointmentRepository;
use App\Repository\DoctorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function new(Request $request, DoctorRepository $doctorRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // Only patients can book appointments
        if ($this->isGranted('ROLE_DOCTOR') || $this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('error', 'Only patients can book appointments.');
            return $this->redirectToRoute('appointment_index');
        }

        $doctors = $doctorRepository->findAll();

        if ($request->isMethod('POST')) {
            $doctorId = $request->request->get('doctor_id');
            $dateStr = $request->request->get('date');
            $notes = $request->request->get('notes');

            $doctor = $doctorRepository->find($doctorId);
            if ($doctor && $dateStr) {
                $appointment = new Appointment();
                $appointment->setPatientEmail($this->getUser()->getUserIdentifier());
                $appointment->setPatientName($this->getUser() instanceof User ? $this->getUser()->getFullName() : 'Patient');
                $appointment->setDoctorEmail($doctor->getEmail());
                $appointment->setDoctorName($doctor->getFullName());
                $appointment->setAppointmentDate(new \DateTime($dateStr));
                $appointment->setNotes($notes);
                $appointment->setStatus('pending');

                $entityManager->persist($appointment);
                $entityManager->flush();

                $this->addFlash('success', 'Appointment booked successfully! Waiting for doctor confirmation.');
                return $this->redirectToRoute('appointment_index');
            }
        }

        return $this->render('appointment/new.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    #[Route('/{id}/confirm', name: 'appointment_confirm')]
    #[IsGranted('ROLE_DOCTOR')]
    public function confirm(Appointment $appointment, EntityManagerInterface $entityManager): Response
    {
        if ($appointment->getDoctorEmail() !== $this->getUser()->getUserIdentifier() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $appointment->setStatus('confirmed');
        $entityManager->flush();

        $this->addFlash('success', 'Appointment confirmed.');
        return $this->redirectToRoute('appointment_index');
    }

    #[Route('/{id}/cancel', name: 'appointment_cancel')]
    public function cancel(Appointment $appointment, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userEmail = $this->getUser()->getUserIdentifier();
        
        if ($appointment->getPatientEmail() !== $userEmail && 
            $appointment->getDoctorEmail() !== $userEmail && 
            !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $appointment->setStatus('cancelled');
        $entityManager->flush();

        $this->addFlash('success', 'Appointment cancelled.');
        return $this->redirectToRoute('appointment_index');
    }
}
