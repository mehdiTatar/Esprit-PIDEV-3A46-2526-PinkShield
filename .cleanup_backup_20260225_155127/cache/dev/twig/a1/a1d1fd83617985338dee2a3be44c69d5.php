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

/* appointment/index.html.twig */
class __TwigTemplate_379b53d179f2d1edc46d1653212ccfa3 extends Template
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
            'body' => [$this, 'block_body'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointment/index.html.twig"));

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

        yield "My Appointments";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container-fluid mt-5\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1>My Appointments</h1>
        ";
        // line 9
        if ((($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER") &&  !$this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR")) &&  !$this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
            // line 10
            yield "            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_new");
            yield "\" class=\"btn btn-primary\">
                <i class=\"fas fa-calendar-plus\"></i> Book Appointment
            </a>
        ";
        }
        // line 14
        yield "    </div>

    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "flashes", ["success"], "method", false, false, false, 16));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 17
            yield "        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 22, $this->source); })()), "flashes", ["error"], "method", false, false, false, 22));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 23
            yield "        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            ";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        yield "
    <!-- Calendar Section -->
    <div class=\"row mb-5\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-primary text-white\">
                    <h5 class=\"mb-0\"><i class=\"fas fa-calendar\"></i> Appointment Calendar</h5>
                </div>
                <div class=\"card-body\">
                    <div id=\"calendar-holder\"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- AI Suggestions Section -->
    <div class=\"row mb-5\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm\" style=\"background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;\">
                <div class=\"card-header\" style=\"background: rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.2);\">
                    <h5 class=\"mb-0\" style=\"color: white;\">
                        <i class=\"fas fa-robot\"></i> 🤖 AI Pharmacist Suggestions
                    </h5>
                </div>
                <div class=\"card-body\">
                    ";
        // line 53
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["aiSuggestions"]) || array_key_exists("aiSuggestions", $context) ? $context["aiSuggestions"] : (function () { throw new RuntimeError('Variable "aiSuggestions" does not exist.', 53, $this->source); })())) > 0)) {
            // line 54
            yield "                        <p class=\"mb-3\" style=\"color: rgba(255,255,255,0.9);\">
                            Based on consultation notes, here are AI-suggested parapharmacy products for your appointments:
                        </p>
                        <div class=\"row\">
                            ";
            // line 58
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["appointments"]) || array_key_exists("appointments", $context) ? $context["appointments"] : (function () { throw new RuntimeError('Variable "appointments" does not exist.', 58, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["appointment"]) {
                // line 59
                yield "                                ";
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["aiSuggestions"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 59), [], "array", true, true, false, 59)) {
                    // line 60
                    yield "                                <div class=\"col-md-6 col-lg-4 mb-3\">
                                    <div class=\"card\" style=\"background: rgba(255,255,255,0.95); border: none;\">
                                        <div class=\"card-body\">
                                            <h6 class=\"card-title text-dark\">
                                                <i class=\"fas fa-user-md\"></i> ";
                    // line 64
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "doctorName", [], "any", false, false, false, 64), "html", null, true);
                    yield "
                                            </h6>
                                            <p class=\"card-text text-muted small mb-2\">
                                                ";
                    // line 67
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "appointmentDate", [], "any", false, false, false, 67), "M d, Y H:i"), "html", null, true);
                    yield "
                                            </p>
                                            <div class=\"mb-2\">
                                                ";
                    // line 70
                    $context["suggestions"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["aiSuggestions"]) || array_key_exists("aiSuggestions", $context) ? $context["aiSuggestions"] : (function () { throw new RuntimeError('Variable "aiSuggestions" does not exist.', 70, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 70), [], "array", false, false, false, 70), ",");
                    // line 71
                    yield "                                                ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable((isset($context["suggestions"]) || array_key_exists("suggestions", $context) ? $context["suggestions"] : (function () { throw new RuntimeError('Variable "suggestions" does not exist.', 71, $this->source); })()));
                    foreach ($context['_seq'] as $context["_key"] => $context["suggestion"]) {
                        // line 72
                        yield "                                                    <span class=\"badge bg-primary me-1 mb-1\">
                                                        <i class=\"fas fa-prescription-bottle-alt\"></i> ";
                        // line 73
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim($context["suggestion"]), "html", null, true);
                        yield "
                                                    </span>
                                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['suggestion'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 76
                    yield "                                            </div>
                                            <a href=\"";
                    // line 77
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 77)]), "html", null, true);
                    yield "\" class=\"btn btn-sm btn-outline-primary\">
                                                <i class=\"fas fa-arrow-right\"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                ";
                }
                // line 84
                yield "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['appointment'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            yield "                        </div>
                    ";
        } else {
            // line 87
            yield "                        <p style=\"color: rgba(255,255,255,0.9); margin: 0;\">
                            <i class=\"fas fa-info-circle\"></i> No AI suggestions yet. Create appointments with consultation notes to get AI-powered parapharmacy recommendations!
                        </p>
                    ";
        }
        // line 91
        yield "                </div>
            </div>
        </div>
    </div>

    <!-- Appointments List Section -->
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-secondary text-white\">
                    <h5 class=\"mb-0\"><i class=\"fas fa-list\"></i> Appointments List</h5>
                </div>
                <div class=\"card-body\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    ";
        // line 109
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
            // line 110
            yield "                                        <th>Patient</th>
                                    ";
        }
        // line 112
        yield "                                    ";
        if (( !$this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
            // line 113
            yield "                                        <th>Doctor</th>
                                    ";
        }
        // line 115
        yield "                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ";
        // line 121
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["appointments"]) || array_key_exists("appointments", $context) ? $context["appointments"] : (function () { throw new RuntimeError('Variable "appointments" does not exist.', 121, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["appointment"]) {
            // line 122
            yield "                                    <tr>
                                        <td>";
            // line 123
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "appointmentDate", [], "any", false, false, false, 123), "M d, Y H:i"), "html", null, true);
            yield "</td>
                                        ";
            // line 124
            if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
                // line 125
                yield "                                            <td>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "patientName", [], "any", false, false, false, 125), "html", null, true);
                yield "</td>
                                        ";
            }
            // line 127
            yield "                                        ";
            if (( !$this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
                // line 128
                yield "                                            <td>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "doctorName", [], "any", false, false, false, 128), "html", null, true);
                yield "</td>
                                        ";
            }
            // line 130
            yield "                                        <td>
                                            <span class=\"badge ";
            // line 131
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "status", [], "any", false, false, false, 131) == "confirmed")) {
                yield "bg-success";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "status", [], "any", false, false, false, 131) == "pending")) {
                yield "bg-warning";
            } else {
                yield "bg-danger";
            }
            yield "\">
                                                ";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "status", [], "any", false, false, false, 132)), "html", null, true);
            yield "
                                            </span>
                                        </td>
                                        <td>";
            // line 135
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "notes", [], "any", true, true, false, 135)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "notes", [], "any", false, false, false, 135), "-")) : ("-")), "html", null, true);
            yield "</td>
                                        <td>
                                            <a href=\"";
            // line 137
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 137)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-info\" title=\"View Details\">
                                                <i class=\"fas fa-eye\"></i> View
                                            </a>
                                            ";
            // line 140
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "status", [], "any", false, false, false, 140) == "pending")) {
                // line 141
                yield "                                                ";
                if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
                    // line 142
                    yield "                                                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_confirm", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 142)]), "html", null, true);
                    yield "\" class=\"btn btn-sm btn-success\">Confirm</a>
                                                ";
                }
                // line 144
                yield "                                                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_cancel", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 144)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure you want to cancel?')\">Cancel</a>
                                            ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 145
$context["appointment"], "status", [], "any", false, false, false, 145) == "confirmed")) {
                // line 146
                yield "                                                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_cancel", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 146)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure you want to cancel?')\">Cancel</a>
                                            ";
            }
            // line 148
            yield "                                        </td>
                                    </tr>
                                ";
            $context['_iterated'] = true;
        }
        // line 150
        if (!$context['_iterated']) {
            // line 151
            yield "                                    <tr>
                                        <td colspan=\"6\" class=\"text-center py-4\">No appointments found.</td>
                                    </tr>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['appointment'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 155
        yield "                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar v6 CSS & JS (via CDN) -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

<script>
function initializeCalendar() {
    var calendarEl = document.getElementById('calendar-holder');
    
    if (!calendarEl) {
        console.error('Calendar element not found');
        return;
    }
    
    // Check if FullCalendar is available
    if (typeof FullCalendar === 'undefined') {
        console.error('FullCalendar library not loaded');
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger';
        alertDiv.innerHTML = '<strong>Error:</strong> Calendar library failed to load. Please refresh the page.';
        calendarEl.parentElement.insertBefore(alertDiv, calendarEl);
        return;
    }
    
    // Fetch events from the API
    fetch('";
        // line 188
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("fc_load_events");
        yield "')
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Server error: ' + response.status);
            }
            return response.json();
        })
        .then(function(events) {
            console.log('Loaded ' + events.length + ' appointments');
            
            // Initialize calendar with events
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                height: '400px',
                contentHeight: '350px',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: events,
                eventClick: function(info) {
                    var event = info.event;
                    var props = event.extendedProps;
                    var message = 'Appointment: ' + event.title + '\\n\\n' +
                                 'Patient: ' + (props.patientName || 'N/A') + '\\n' +
                                 'Doctor: ' + (props.doctorName || 'N/A') + '\\n' +
                                 'Status: ' + (props.status || '').toUpperCase() + '\\n' +
                                 'Time: ' + (event.start ? event.start.toLocaleString() : 'N/A');
                    if (props.notes) {
                        message += '\\n\\nNotes: ' + props.notes;
                    }
                    alert(message);
                }
            });
            
            calendar.render();
            
            // Show message if no appointments
            if (events.length === 0) {
                var alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-info mt-3';
                alertDiv.innerHTML = '<i class=\"fas fa-info-circle\"></i> No appointments scheduled for the current period.';
                calendarEl.parentElement.appendChild(alertDiv);
            } else {
                var infoDiv = document.createElement('div');
                infoDiv.className = 'alert alert-success mt-3';
                infoDiv.innerHTML = '<i class=\"fas fa-check-circle\"></i> Showing ' + events.length + ' appointment(s).';
                calendarEl.parentElement.appendChild(infoDiv);
            }
        })
        .catch(function(error) {
            console.error('Error loading appointments:', error);
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.innerHTML = '<strong><i class=\"fas fa-exclamation-circle\"></i> Failed to load calendar.</strong><br>Error: ' + error.message + '<br><small>Check the browser console for more details.</small>';
            calendarEl.parentElement.insertBefore(alertDiv, calendarEl);
        });
}

// Wait for DOM to be ready and FullCalendar to be loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if FullCalendar is already loaded
    if (typeof FullCalendar !== 'undefined') {
        initializeCalendar();
    } else {
        // Wait a bit for scripts to load
        var checkInterval = setInterval(function() {
            if (typeof FullCalendar !== 'undefined') {
                clearInterval(checkInterval);
                initializeCalendar();
            }
        }, 100);
        
        // Timeout after 5 seconds
        setTimeout(function() {
            clearInterval(checkInterval);
            if (typeof FullCalendar === 'undefined') {
                var calendarEl = document.getElementById('calendar-holder');
                if (calendarEl) {
                    var alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.innerHTML = '<strong>Error:</strong> Calendar library failed to load. Please check your internet connection and refresh the page.';
                    calendarEl.parentElement.insertBefore(alertDiv, calendarEl);
                }
            }
        }, 5000);
    }
});
</script>

<style>
    #calendar-holder {
        position: relative;
    }

    /* FullCalendar styling */
    .fc {
        font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
        font-size: 0.85rem;
    }

    /* Allow event titles to wrap to multiple lines */
    .fc-event-title {
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        line-height: 1.2 !important;
        padding: 1px 2px !important;
        font-size: 0.75rem;
    }

    /* Increase event height to accommodate wrapped text */
    .fc-daygrid-event {
        height: auto !important;
        min-height: auto !important;
        padding: 1px !important;
    }

    .fc-col-event-container {
        min-height: auto !important;
    }

    /* Reduce cell height */
    .fc-daygrid-day {
        height: 60px !important;
    }

    /* Reduce header size */
    .fc-toolbar {
        padding: 8px 0 !important;
    }

    .fc-toolbar-title {
        font-size: 1.1rem !important;
    }

    .fc-button {
        padding: 0.4rem 0.6rem !important;
        font-size: 0.8rem !important;
    }

    /* Calendar button styling */
    .fc-button-primary {
        background-color: #007bff !important;
        border-color: #0056b3 !important;
    }

    .fc-button-primary:hover {
        background-color: #0056b3 !important;
    }

    .fc-button-primary.fc-button-active {
        background-color: #0056b3 !important;
    }

    .card {
        border-radius: 0.375rem;
    }

    .table-responsive {
        border-radius: 0.375rem;
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
        return "appointment/index.html.twig";
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
        return array (  423 => 188,  388 => 155,  379 => 151,  377 => 150,  371 => 148,  365 => 146,  363 => 145,  358 => 144,  352 => 142,  349 => 141,  347 => 140,  341 => 137,  336 => 135,  330 => 132,  320 => 131,  317 => 130,  311 => 128,  308 => 127,  302 => 125,  300 => 124,  296 => 123,  293 => 122,  288 => 121,  280 => 115,  276 => 113,  273 => 112,  269 => 110,  267 => 109,  247 => 91,  241 => 87,  237 => 85,  231 => 84,  221 => 77,  218 => 76,  209 => 73,  206 => 72,  201 => 71,  199 => 70,  193 => 67,  187 => 64,  181 => 60,  178 => 59,  174 => 58,  168 => 54,  166 => 53,  139 => 28,  129 => 24,  126 => 23,  121 => 22,  111 => 18,  108 => 17,  104 => 16,  100 => 14,  92 => 10,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}My Appointments{% endblock %}

{% block body %}
<div class=\"container-fluid mt-5\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1>My Appointments</h1>
        {% if is_granted('ROLE_USER') and not is_granted('ROLE_DOCTOR') and not is_granted('ROLE_ADMIN') %}
            <a href=\"{{ path('appointment_new') }}\" class=\"btn btn-primary\">
                <i class=\"fas fa-calendar-plus\"></i> Book Appointment
            </a>
        {% endif %}
    </div>

    {% for message in app.flashes('success') %}
        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            {{ message }}
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    {% endfor %}
    {% for message in app.flashes('error') %}
        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            {{ message }}
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    {% endfor %}

    <!-- Calendar Section -->
    <div class=\"row mb-5\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-primary text-white\">
                    <h5 class=\"mb-0\"><i class=\"fas fa-calendar\"></i> Appointment Calendar</h5>
                </div>
                <div class=\"card-body\">
                    <div id=\"calendar-holder\"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- AI Suggestions Section -->
    <div class=\"row mb-5\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm\" style=\"background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;\">
                <div class=\"card-header\" style=\"background: rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.2);\">
                    <h5 class=\"mb-0\" style=\"color: white;\">
                        <i class=\"fas fa-robot\"></i> 🤖 AI Pharmacist Suggestions
                    </h5>
                </div>
                <div class=\"card-body\">
                    {% if aiSuggestions|length > 0 %}
                        <p class=\"mb-3\" style=\"color: rgba(255,255,255,0.9);\">
                            Based on consultation notes, here are AI-suggested parapharmacy products for your appointments:
                        </p>
                        <div class=\"row\">
                            {% for appointment in appointments %}
                                {% if aiSuggestions[appointment.id] is defined %}
                                <div class=\"col-md-6 col-lg-4 mb-3\">
                                    <div class=\"card\" style=\"background: rgba(255,255,255,0.95); border: none;\">
                                        <div class=\"card-body\">
                                            <h6 class=\"card-title text-dark\">
                                                <i class=\"fas fa-user-md\"></i> {{ appointment.doctorName }}
                                            </h6>
                                            <p class=\"card-text text-muted small mb-2\">
                                                {{ appointment.appointmentDate|date('M d, Y H:i') }}
                                            </p>
                                            <div class=\"mb-2\">
                                                {% set suggestions = aiSuggestions[appointment.id]|split(',') %}
                                                {% for suggestion in suggestions %}
                                                    <span class=\"badge bg-primary me-1 mb-1\">
                                                        <i class=\"fas fa-prescription-bottle-alt\"></i> {{ suggestion|trim }}
                                                    </span>
                                                {% endfor %}
                                            </div>
                                            <a href=\"{{ path('appointment_show', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-outline-primary\">
                                                <i class=\"fas fa-arrow-right\"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {% endif %}
                            {% endfor %}
                        </div>
                    {% else %}
                        <p style=\"color: rgba(255,255,255,0.9); margin: 0;\">
                            <i class=\"fas fa-info-circle\"></i> No AI suggestions yet. Create appointments with consultation notes to get AI-powered parapharmacy recommendations!
                        </p>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>

    <!-- Appointments List Section -->
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-secondary text-white\">
                    <h5 class=\"mb-0\"><i class=\"fas fa-list\"></i> Appointments List</h5>
                </div>
                <div class=\"card-body\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    {% if is_granted('ROLE_DOCTOR') or is_granted('ROLE_ADMIN') %}
                                        <th>Patient</th>
                                    {% endif %}
                                    {% if not is_granted('ROLE_DOCTOR') or is_granted('ROLE_ADMIN') %}
                                        <th>Doctor</th>
                                    {% endif %}
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for appointment in appointments %}
                                    <tr>
                                        <td>{{ appointment.appointmentDate|date('M d, Y H:i') }}</td>
                                        {% if is_granted('ROLE_DOCTOR') or is_granted('ROLE_ADMIN') %}
                                            <td>{{ appointment.patientName }}</td>
                                        {% endif %}
                                        {% if not is_granted('ROLE_DOCTOR') or is_granted('ROLE_ADMIN') %}
                                            <td>{{ appointment.doctorName }}</td>
                                        {% endif %}
                                        <td>
                                            <span class=\"badge {% if appointment.status == 'confirmed' %}bg-success{% elseif appointment.status == 'pending' %}bg-warning{% else %}bg-danger{% endif %}\">
                                                {{ appointment.status|capitalize }}
                                            </span>
                                        </td>
                                        <td>{{ appointment.notes|default('-') }}</td>
                                        <td>
                                            <a href=\"{{ path('appointment_show', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-info\" title=\"View Details\">
                                                <i class=\"fas fa-eye\"></i> View
                                            </a>
                                            {% if appointment.status == 'pending' %}
                                                {% if is_granted('ROLE_DOCTOR') or is_granted('ROLE_ADMIN') %}
                                                    <a href=\"{{ path('appointment_confirm', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-success\">Confirm</a>
                                                {% endif %}
                                                <a href=\"{{ path('appointment_cancel', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure you want to cancel?')\">Cancel</a>
                                            {% elseif appointment.status == 'confirmed' %}
                                                <a href=\"{{ path('appointment_cancel', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure you want to cancel?')\">Cancel</a>
                                            {% endif %}
                                        </td>
                                    </tr>
                                {% else %}
                                    <tr>
                                        <td colspan=\"6\" class=\"text-center py-4\">No appointments found.</td>
                                    </tr>
                                {% endfor %}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar v6 CSS & JS (via CDN) -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

<script>
function initializeCalendar() {
    var calendarEl = document.getElementById('calendar-holder');
    
    if (!calendarEl) {
        console.error('Calendar element not found');
        return;
    }
    
    // Check if FullCalendar is available
    if (typeof FullCalendar === 'undefined') {
        console.error('FullCalendar library not loaded');
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger';
        alertDiv.innerHTML = '<strong>Error:</strong> Calendar library failed to load. Please refresh the page.';
        calendarEl.parentElement.insertBefore(alertDiv, calendarEl);
        return;
    }
    
    // Fetch events from the API
    fetch('{{ path(\"fc_load_events\") }}')
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Server error: ' + response.status);
            }
            return response.json();
        })
        .then(function(events) {
            console.log('Loaded ' + events.length + ' appointments');
            
            // Initialize calendar with events
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                height: '400px',
                contentHeight: '350px',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: events,
                eventClick: function(info) {
                    var event = info.event;
                    var props = event.extendedProps;
                    var message = 'Appointment: ' + event.title + '\\n\\n' +
                                 'Patient: ' + (props.patientName || 'N/A') + '\\n' +
                                 'Doctor: ' + (props.doctorName || 'N/A') + '\\n' +
                                 'Status: ' + (props.status || '').toUpperCase() + '\\n' +
                                 'Time: ' + (event.start ? event.start.toLocaleString() : 'N/A');
                    if (props.notes) {
                        message += '\\n\\nNotes: ' + props.notes;
                    }
                    alert(message);
                }
            });
            
            calendar.render();
            
            // Show message if no appointments
            if (events.length === 0) {
                var alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-info mt-3';
                alertDiv.innerHTML = '<i class=\"fas fa-info-circle\"></i> No appointments scheduled for the current period.';
                calendarEl.parentElement.appendChild(alertDiv);
            } else {
                var infoDiv = document.createElement('div');
                infoDiv.className = 'alert alert-success mt-3';
                infoDiv.innerHTML = '<i class=\"fas fa-check-circle\"></i> Showing ' + events.length + ' appointment(s).';
                calendarEl.parentElement.appendChild(infoDiv);
            }
        })
        .catch(function(error) {
            console.error('Error loading appointments:', error);
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.innerHTML = '<strong><i class=\"fas fa-exclamation-circle\"></i> Failed to load calendar.</strong><br>Error: ' + error.message + '<br><small>Check the browser console for more details.</small>';
            calendarEl.parentElement.insertBefore(alertDiv, calendarEl);
        });
}

// Wait for DOM to be ready and FullCalendar to be loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if FullCalendar is already loaded
    if (typeof FullCalendar !== 'undefined') {
        initializeCalendar();
    } else {
        // Wait a bit for scripts to load
        var checkInterval = setInterval(function() {
            if (typeof FullCalendar !== 'undefined') {
                clearInterval(checkInterval);
                initializeCalendar();
            }
        }, 100);
        
        // Timeout after 5 seconds
        setTimeout(function() {
            clearInterval(checkInterval);
            if (typeof FullCalendar === 'undefined') {
                var calendarEl = document.getElementById('calendar-holder');
                if (calendarEl) {
                    var alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.innerHTML = '<strong>Error:</strong> Calendar library failed to load. Please check your internet connection and refresh the page.';
                    calendarEl.parentElement.insertBefore(alertDiv, calendarEl);
                }
            }
        }, 5000);
    }
});
</script>

<style>
    #calendar-holder {
        position: relative;
    }

    /* FullCalendar styling */
    .fc {
        font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif;
        font-size: 0.85rem;
    }

    /* Allow event titles to wrap to multiple lines */
    .fc-event-title {
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        line-height: 1.2 !important;
        padding: 1px 2px !important;
        font-size: 0.75rem;
    }

    /* Increase event height to accommodate wrapped text */
    .fc-daygrid-event {
        height: auto !important;
        min-height: auto !important;
        padding: 1px !important;
    }

    .fc-col-event-container {
        min-height: auto !important;
    }

    /* Reduce cell height */
    .fc-daygrid-day {
        height: 60px !important;
    }

    /* Reduce header size */
    .fc-toolbar {
        padding: 8px 0 !important;
    }

    .fc-toolbar-title {
        font-size: 1.1rem !important;
    }

    .fc-button {
        padding: 0.4rem 0.6rem !important;
        font-size: 0.8rem !important;
    }

    /* Calendar button styling */
    .fc-button-primary {
        background-color: #007bff !important;
        border-color: #0056b3 !important;
    }

    .fc-button-primary:hover {
        background-color: #0056b3 !important;
    }

    .fc-button-primary.fc-button-active {
        background-color: #0056b3 !important;
    }

    .card {
        border-radius: 0.375rem;
    }

    .table-responsive {
        border-radius: 0.375rem;
    }
</style>
{% endblock %}
", "appointment/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\appointment\\index.html.twig");
    }
}
