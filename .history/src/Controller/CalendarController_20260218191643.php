<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Tattali\CalendarBundle\Event\CalendarEvent;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'app_calendar')]
    public function index(EventDispatcherInterface $dispatcher): Response
    {
        $calendar = new CalendarEvent();

        // Dispatch the event to populate the calendar with appointments
        $dispatcher->dispatch($calendar, CalendarEvent::SET_DATA);

        return $this->render('calendar/index.html.twig', [
            'calendar' => $calendar,
        ]);
    }
}
