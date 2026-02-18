<?php

namespace App\EventListener;

use App\Repository\AppointmentRepository;
use Tattali\CalendarBundle\Entity\Event;
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

        // Fetch non-cancelled appointments between the dates
        $appointments = $this->appointmentRepository->findAppointmentsBetween($start, $end);

        foreach ($appointments as $appointment) {
            $title = $appointment->getPatientName() . ' (Dr. ' . $appointment->getDoctorName() . ')';
            $endDate = (clone $appointment->getAppointmentDate())->modify('+30 minutes');

            $event = new Event(
                $title,
                $appointment->getAppointmentDate(),
                $endDate
            );

            $event->setOptions([
                'backgroundColor' => $this->getColorByStatus($appointment->getStatus()),
                'borderColor' => $this->getBorderColorByStatus($appointment->getStatus()),
                'textColor' => '#ffffff',
            ]);

            $calendar->addEvent($event);
        }
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