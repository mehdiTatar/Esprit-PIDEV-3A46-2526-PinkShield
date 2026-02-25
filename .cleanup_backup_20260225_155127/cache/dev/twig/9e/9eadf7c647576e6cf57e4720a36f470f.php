<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* calendar/index.html.twig */
class __TwigTemplate_cebad62fe3f12e7ca0ef03dfc6601241 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "calendar/index.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Appointment Calendar";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 6
        yield "<div class=\"container-fluid mt-4\">
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white\">
                    <h2 class=\"mb-0\">Appointments Calendar</h2>
                </div>
                <div class=\"card-body\">
                    <div id=\"calendar\"></div>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 21
        yield "    <div class=\"row mt-4\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header\">
                    <h5 class=\"mb-0\">Status Legend</h5>
                </div>
                <div class=\"card-body\">
                    <div class=\"row\">
                        <div class=\"col-md-3\">
                            <span class=\"badge\" style=\"background-color: #28a745;\">Confirmed</span>
                        </div>
                        <div class=\"col-md-3\">
                            <span class=\"badge\" style=\"background-color: #ffc107; color: #000;\">Pending</span>
                        </div>
                        <div class=\"col-md-3\">
                            <span class=\"badge\" style=\"background-color: #dc3545;\">Cancelled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

";
        // line 46
        yield "<link href=\"https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css\" rel=\"stylesheet\" />

";
        // line 49
        yield "<script src=\"https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js\"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: ";
        // line 61
        yield json_encode((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 61, $this->source); })()));
        yield ",
        eventClick: function(info) {
            let event = info.event;
            let props = event.extendedProps;
            alert(
                'Appointment: ' + event.title + '\\n' +
                'Patient: ' + props.patientName + ' (' + props.patientEmail + ')\\n' +
                'Doctor: ' + props.doctorName + ' (' + props.doctorEmail + ')\\n' +
                'Status: ' + props.status + '\\n' +
                'Time: ' + event.start.toLocaleString() + '\\n' +
                (props.notes ? 'Notes: ' + props.notes : '')
            );
        },
        height: 'auto'
    });
    calendar.render();
});
</script>

<style>
    #calendar {
        background: #fff;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 20px;
    }

    .fc {
        font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
    }

    .fc .fc-button-primary {
        background-color: #007bff;
        border-color: #0056b3;
    }

    .fc .fc-button-primary:hover {
        background-color: #0056b3;
    }

    .fc .fc-button-primary.fc-button-active {
        background-color: #0056b3;
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "calendar/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  145 => 61,  131 => 49,  127 => 46,  101 => 21,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Appointment Calendar{% endblock %}

{% block content %}
<div class=\"container-fluid mt-4\">
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white\">
                    <h2 class=\"mb-0\">Appointments Calendar</h2>
                </div>
                <div class=\"card-body\">
                    <div id=\"calendar\"></div>
                </div>
            </div>
        </div>
    </div>

    {# Legend #}
    <div class=\"row mt-4\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header\">
                    <h5 class=\"mb-0\">Status Legend</h5>
                </div>
                <div class=\"card-body\">
                    <div class=\"row\">
                        <div class=\"col-md-3\">
                            <span class=\"badge\" style=\"background-color: #28a745;\">Confirmed</span>
                        </div>
                        <div class=\"col-md-3\">
                            <span class=\"badge\" style=\"background-color: #ffc107; color: #000;\">Pending</span>
                        </div>
                        <div class=\"col-md-3\">
                            <span class=\"badge\" style=\"background-color: #dc3545;\">Cancelled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{# FullCalendar CSS #}
<link href=\"https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css\" rel=\"stylesheet\" />

{# FullCalendar JS #}
<script src=\"https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js\"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {{ events|json_encode|raw }},
        eventClick: function(info) {
            let event = info.event;
            let props = event.extendedProps;
            alert(
                'Appointment: ' + event.title + '\\n' +
                'Patient: ' + props.patientName + ' (' + props.patientEmail + ')\\n' +
                'Doctor: ' + props.doctorName + ' (' + props.doctorEmail + ')\\n' +
                'Status: ' + props.status + '\\n' +
                'Time: ' + event.start.toLocaleString() + '\\n' +
                (props.notes ? 'Notes: ' + props.notes : '')
            );
        },
        height: 'auto'
    });
    calendar.render();
});
</script>

<style>
    #calendar {
        background: #fff;
        border-radius: 0.375rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 20px;
    }

    .fc {
        font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
    }

    .fc .fc-button-primary {
        background-color: #007bff;
        border-color: #0056b3;
    }

    .fc .fc-button-primary:hover {
        background-color: #0056b3;
    }

    .fc .fc-button-primary.fc-button-active {
        background-color: #0056b3;
    }
</style>
{% endblock %}
", "calendar/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\calendar\\index.html.twig");
    }
}
