<?php

namespace App\Controller;

use App\EventListener\CalendarListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'app_calendar')]
    public function index(CalendarListener $calendarListener): Response
    {
        // Get current month's appointments
        $start = new \DateTime('first day of this month');
        $start->setTime(0, 0, 0);
        
        $end = new \DateTime('last day of this month');
        $end->setTime(23, 59, 59);

        $appointments = $calendarListener->getAppointments($start, $end);
        $events = array_map([$calendarListener, 'formatEvent'], $appointments);

        return $this->render('calendar/index.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/api/events', name: 'api_calendar_events', methods: ['GET'])]
    public function getEvents(Request $request, CalendarListener $calendarListener): JsonResponse
    {
        $start = new \DateTime($request->query->get('start', 'first day of this month'));
        $end = new \DateTime($request->query->get('end', 'last day of this month'));

        $appointments = $calendarListener->getAppointments($start, $end);
        $events = array_map([$calendarListener, 'formatEvent'], $appointments);

        return $this->json($events);
    }
}
