<?php

namespace App\EventListener;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Tattali\CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarListener implements EventSubscriberInterface
{
    public function __construct(
        private AppointmentRepository $appointmentRepository
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            CalendarEvent::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar): void
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();

        // Fetch all appointments between the start and end dates
        $appointments = $this->appointmentRepository->findAppointmentsBetween($start, $end);

        // Convert appointments to calendar events
        foreach ($appointments as $appointment) {
            $calendar->addEvent(
                new \Tattali\CalendarBundle\Entity\Event(
                    title: $appointment->getPatientName(),
                    start: $appointment->getAppointmentDate(),
                    end: $appointment->getAppointmentDate(),
                    backgroundColor: $this->getColorByStatus($appointment->getStatus()),
                    borderColor: $this->getBorderColorByStatus($appointment->getStatus()),
                    textColor: '#ffffff',
                    allDay: false,
                    resourceId: $appointment->getId(),
                    resourceClassName: 'appointment',
                    extendedProps: [
                        'patientEmail' => $appointment->getPatientEmail(),
                        'doctorName' => $appointment->getDoctorName(),
                        'doctorEmail' => $appointment->getDoctorEmail(),
                        'status' => $appointment->getStatus(),
                        'notes' => $appointment->getNotes(),
                        'appointmentId' => $appointment->getId(),
                    ],
                )
            );
        }
    }

    /**
     * Get background color based on appointment status
     */
    private function getColorByStatus(string $status): string
    {
        return match($status) {
            'confirmed' => '#28a745',  // Green
            'pending' => '#ffc107',    // Yellow/Amber
            'cancelled' => '#dc3545',  // Red
            default => '#007bff',      // Blue
        };
    }

    /**
     * Get border color based on appointment status
     */
    private function getBorderColorByStatus(string $status): string
    {
        return match($status) {
            'confirmed' => '#1e7e34',  // Darker Green
            'pending' => '#e0a800',    // Darker Yellow
            'cancelled' => '#bd2130',  // Darker Red
            default => '#0056b3',      // Darker Blue
        };
    }
}
