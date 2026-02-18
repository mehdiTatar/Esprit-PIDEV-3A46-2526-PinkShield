<?php

namespace App\EventListener;

use App\Repository\AppointmentRepository;
use CalendarBundle\CalendarEvents;  // <--- REGARDE ICI : PAS DE TATTALI
use CalendarBundle\Entity\Event;    // <--- PAS DE TATTALI
use CalendarBundle\Event\CalendarEvent; // <--- PAS DE TATTALI
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarListener implements EventSubscriberInterface
{
    private $appointmentRepository;
    private $router;

    public function __construct(
        AppointmentRepository $appointmentRepository,
        UrlGeneratorInterface $router
    ) {
        $this->appointmentRepository = $appointmentRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar): void
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();

        // On utilise QueryBuilder car findAppointmentsBetween n'existe pas par défaut
        $appointments = $this->appointmentRepository
            ->createQueryBuilder('a')
            ->where('a.appointmentDate BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        foreach ($appointments as $appointment) {
            
            $title = $appointment->getPatientName() . ' (Dr. ' . $appointment->getDoctorName() . ')';
            
            // On invente une fin (+30min) car tu n'as pas de date de fin
            $endDate = (clone $appointment->getAppointmentDate())->modify('+30 minutes');

            $eventEntity = new Event(
                $title,
                $appointment->getAppointmentDate(),
                $endDate
            );

            // Couleurs selon le statut
            $eventEntity->setOptions([
                'backgroundColor' => $this->getColorByStatus($appointment->getStatus()),
                'borderColor' => $this->getBorderColorByStatus($appointment->getStatus()),
                'textColor' => '#ffffff',
            ]);

            $calendar->addEvent($eventEntity);
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