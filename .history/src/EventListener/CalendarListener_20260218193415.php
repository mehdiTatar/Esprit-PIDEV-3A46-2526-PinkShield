<?php

namespace App\EventListener;

use App\Repository\AppointmentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarListener implements EventSubscriberInterface
{
    public function __construct(
        private AppointmentRepository $appointmentRepository
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [];
    }

    /**
     * Get appointments between two dates
     * Used by controllers/templates for calendar display
     */
    public function getAppointments(\DateTimeInterface $start, \DateTimeInterface $end): array
    {
        return $this->appointmentRepository->findAppointmentsBetween($start, $end);
    }

    /**
     * Format appointment as calendar event
     */
    public function formatEvent($appointment): array
    {
        $endDate = (clone $appointment->getAppointmentDate())->modify('+30 minutes');
        
        return [
            'id' => $appointment->getId(),
            'title' => $appointment->getPatientName() . ' (Dr. ' . $appointment->getDoctorName() . ')',
            'start' => $appointment->getAppointmentDate()->format('Y-m-d\TH:i:s'),
            'end' => $endDate->format('Y-m-d\TH:i:s'),
            'backgroundColor' => $this->getColorByStatus($appointment->getStatus()),
            'borderColor' => $this->getBorderColorByStatus($appointment->getStatus()),
            'textColor' => '#ffffff',
            'extendedProps' => [
                'patientEmail' => $appointment->getPatientEmail(),
                'patientName' => $appointment->getPatientName(),
                'doctorName' => $appointment->getDoctorName(),
                'doctorEmail' => $appointment->getDoctorEmail(),
                'status' => $appointment->getStatus(),
                'notes' => $appointment->getNotes(),
                'appointmentId' => $appointment->getId(),
            ],
        ];
    }

    private function getColorByStatus(string $status): string
    {
        return match($status) {
            'confirmed' => '#28a745',
            'pending' => '#ffc107',
            'cancelled' => '#dc3545',
            default => '#007bff',
        };
    }

    private function getBorderColorByStatus(string $status): string
    {
        return match($status) {
            'confirmed' => '#1e7e34',
            'pending' => '#d39e00',
            'cancelled' => '#bd2130',
            default => '#0056b3',
        };
    }
}