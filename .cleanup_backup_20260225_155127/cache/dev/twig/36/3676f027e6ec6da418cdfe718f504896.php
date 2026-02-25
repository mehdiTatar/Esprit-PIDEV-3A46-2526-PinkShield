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

/* appointment/show.html.twig */
class __TwigTemplate_ee48308bd6a7eeb5be87606743071a2f extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointment/show.html.twig"));

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

        yield "Appointment Details";
        
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
        yield "<div class=\"container mt-5\">
    <div class=\"card shadow-sm\">
        <div class=\"card-header d-flex justify-content-between align-items-center\">
            <h3>Appointment Details</h3>
            <div>
                <a href=\"";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_invoice", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 11, $this->source); })()), "id", [], "any", false, false, false, 11)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-outline-success\" title=\"Download Invoice as PDF\">
                    <i class=\"fas fa-file-pdf\"></i> Download Invoice
                </a>

                ";
        // line 16
        yield "                ";
        if (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 16, $this->source); })()), "status", [], "any", false, false, false, 16) == "completed") && $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_FULLY"))) {
            // line 17
            yield "                    <form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_email_doctor", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 17, $this->source); })()), "id", [], "any", false, false, false, 17)]), "html", null, true);
            yield "\" style=\"display:inline-block;\">
                        <input type=\"hidden\" name=\"_csrf_token\" value=\"";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("email_doctor" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 18, $this->source); })()), "id", [], "any", false, false, false, 18))), "html", null, true);
            yield "\">
                        <button type=\"submit\" class=\"btn btn-sm btn-outline-info\" title=\"Email Invoice to Doctor\">
                            <i class=\"fas fa-paper-plane\"></i> Email Doctor
                        </button>
                    </form>
                ";
        }
        // line 24
        yield "
                <a href=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 25, $this->source); })()), "id", [], "any", false, false, false, 25)]), "html", null, true);
        yield "\" class=\"btn btn-sm btn-outline-primary\">Edit</a>
                <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"btn btn-sm btn-secondary\">Back</a>
            </div>
        </div>
        <div class=\"card-body\">
            <p><strong>Date:</strong> ";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 30, $this->source); })()), "appointmentDate", [], "any", false, false, false, 30), "M d, Y H:i"), "html", null, true);
        yield "</p>
            <p><strong>Patient:</strong> ";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 31, $this->source); })()), "patientName", [], "any", false, false, false, 31), "html", null, true);
        yield " (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 31, $this->source); })()), "patientEmail", [], "any", false, false, false, 31), "html", null, true);
        yield ")</p>
            <p><strong>Doctor:</strong> ";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 32, $this->source); })()), "doctorName", [], "any", false, false, false, 32), "html", null, true);
        yield " (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 32, $this->source); })()), "doctorEmail", [], "any", false, false, false, 32), "html", null, true);
        yield ")</p>
            <p><strong>Status:</strong> ";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 33, $this->source); })()), "status", [], "any", false, false, false, 33)), "html", null, true);
        yield "</p>
            <p><strong>Notes:</strong> ";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["appointment"] ?? null), "notes", [], "any", true, true, false, 34)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 34, $this->source); })()), "notes", [], "any", false, false, false, 34), "-")) : ("-")), "html", null, true);
        yield "</p>

            ";
        // line 37
        yield "            ";
        if ((($tmp = (isset($context["aiSuggestions"]) || array_key_exists("aiSuggestions", $context) ? $context["aiSuggestions"] : (function () { throw new RuntimeError('Variable "aiSuggestions" does not exist.', 37, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 38
            yield "                <div class=\"card mt-4\" style=\"background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">
                            <i class=\"fas fa-robot\"></i> AI Pharmacist Suggestions
                        </h5>
                        <p class=\"card-text mb-0\">
                            Based on the consultation notes, the AI suggests considering:
                        </p>
                        <div class=\"mt-3\">
                            ";
            // line 47
            $context["suggestions"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), (isset($context["aiSuggestions"]) || array_key_exists("aiSuggestions", $context) ? $context["aiSuggestions"] : (function () { throw new RuntimeError('Variable "aiSuggestions" does not exist.', 47, $this->source); })()), ",");
            // line 48
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["suggestions"]) || array_key_exists("suggestions", $context) ? $context["suggestions"] : (function () { throw new RuntimeError('Variable "suggestions" does not exist.', 48, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["suggestion"]) {
                // line 49
                yield "                                <span class=\"badge bg-light text-dark me-2 mb-2\" style=\"padding: 0.5rem 0.75rem; font-size: 0.95rem;\">
                                    <i class=\"fas fa-prescription-bottle-alt\"></i> ";
                // line 50
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::trim($context["suggestion"]), "html", null, true);
                yield "
                                </span>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['suggestion'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            yield "                        </div>
                        <small class=\"mt-3 d-block\" style=\"opacity: 0.9;\">💡 Discuss with the doctor before adding items to the parapharmacy list.</small>
                    </div>
                </div>
            ";
        } elseif ((($tmp =         // line 57
(isset($context["aiError"]) || array_key_exists("aiError", $context) ? $context["aiError"] : (function () { throw new RuntimeError('Variable "aiError" does not exist.', 57, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 58
            yield "                <div class=\"alert alert-warning mt-4\" role=\"alert\">
                    <i class=\"fas fa-exclamation-triangle\"></i> <strong>AI Analysis:</strong> ";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["aiError"]) || array_key_exists("aiError", $context) ? $context["aiError"] : (function () { throw new RuntimeError('Variable "aiError" does not exist.', 59, $this->source); })()), "html", null, true);
            yield "
                </div>
            ";
        }
        // line 62
        yield "
            <hr>
            <h5>Parapharmacie Items</h5>
            <div class=\"mb-3\">
                ";
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(((CoreExtension::getAttribute($this->env, $this->source, ($context["appointment"] ?? null), "parapharmacies", [], "any", true, true, false, 66)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 66, $this->source); })()), "parapharmacies", [], "any", false, false, false, 66)) : ([])));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 67
            yield "                    <div class=\"d-flex justify-content-between align-items-center border p-2 mb-2\">
                        <div>
                            <strong>";
            // line 69
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 69), "html", null, true);
            yield "</strong>
                            <div class=\"text-muted\">";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, false, 70), "html", null, true);
            yield "</div>
                        </div>
                        <div class=\"text-end\">
                            <div>";
            // line 73
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 73), "html", null, true);
            yield " USD</div>
                        </div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        // line 76
        if (!$context['_iterated']) {
            // line 77
            yield "                    <div class=\"text-muted\">No parapharmacie items.</div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        yield "            </div>

            ";
        // line 81
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN"))) {
            // line 82
            yield "                <hr>
                <h5>Add Parapharmacie Item</h5>
                ";
            // line 84
            yield             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["paraphForm"]) || array_key_exists("paraphForm", $context) ? $context["paraphForm"] : (function () { throw new RuntimeError('Variable "paraphForm" does not exist.', 84, $this->source); })()), 'form_start');
            yield "
                    ";
            // line 85
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paraphForm"]) || array_key_exists("paraphForm", $context) ? $context["paraphForm"] : (function () { throw new RuntimeError('Variable "paraphForm" does not exist.', 85, $this->source); })()), "name", [], "any", false, false, false, 85), 'row');
            yield "
                    ";
            // line 86
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paraphForm"]) || array_key_exists("paraphForm", $context) ? $context["paraphForm"] : (function () { throw new RuntimeError('Variable "paraphForm" does not exist.', 86, $this->source); })()), "description", [], "any", false, false, false, 86), 'row');
            yield "
                    ";
            // line 87
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["paraphForm"]) || array_key_exists("paraphForm", $context) ? $context["paraphForm"] : (function () { throw new RuntimeError('Variable "paraphForm" does not exist.', 87, $this->source); })()), "price", [], "any", false, false, false, 87), 'row');
            yield "
                    <div class=\"d-grid mt-2\">
                        <button class=\"btn btn-primary\">Add Item</button>
                    </div>
                ";
            // line 91
            yield             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["paraphForm"]) || array_key_exists("paraphForm", $context) ? $context["paraphForm"] : (function () { throw new RuntimeError('Variable "paraphForm" does not exist.', 91, $this->source); })()), 'form_end');
            yield "
            ";
        }
        // line 93
        yield "        </div>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "appointment/show.html.twig";
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
        return array (  281 => 93,  276 => 91,  269 => 87,  265 => 86,  261 => 85,  257 => 84,  253 => 82,  251 => 81,  247 => 79,  240 => 77,  238 => 76,  230 => 73,  224 => 70,  220 => 69,  216 => 67,  211 => 66,  205 => 62,  199 => 59,  196 => 58,  194 => 57,  188 => 53,  179 => 50,  176 => 49,  171 => 48,  169 => 47,  158 => 38,  155 => 37,  150 => 34,  146 => 33,  140 => 32,  134 => 31,  130 => 30,  123 => 26,  119 => 25,  116 => 24,  107 => 18,  102 => 17,  99 => 16,  92 => 11,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Appointment Details{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"card shadow-sm\">
        <div class=\"card-header d-flex justify-content-between align-items-center\">
            <h3>Appointment Details</h3>
            <div>
                <a href=\"{{ path('appointment_invoice', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-outline-success\" title=\"Download Invoice as PDF\">
                    <i class=\"fas fa-file-pdf\"></i> Download Invoice
                </a>

                {# Send Email button (only for completed appointments) #}
                {% if appointment.status == 'completed' and is_granted('IS_AUTHENTICATED_FULLY') %}
                    <form method=\"post\" action=\"{{ path('appointment_email_doctor', {'id': appointment.id}) }}\" style=\"display:inline-block;\">
                        <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('email_doctor' ~ appointment.id) }}\">
                        <button type=\"submit\" class=\"btn btn-sm btn-outline-info\" title=\"Email Invoice to Doctor\">
                            <i class=\"fas fa-paper-plane\"></i> Email Doctor
                        </button>
                    </form>
                {% endif %}

                <a href=\"{{ path('appointment_edit', {'id': appointment.id}) }}\" class=\"btn btn-sm btn-outline-primary\">Edit</a>
                <a href=\"{{ path('appointment_index') }}\" class=\"btn btn-sm btn-secondary\">Back</a>
            </div>
        </div>
        <div class=\"card-body\">
            <p><strong>Date:</strong> {{ appointment.appointmentDate|date('M d, Y H:i') }}</p>
            <p><strong>Patient:</strong> {{ appointment.patientName }} ({{ appointment.patientEmail }})</p>
            <p><strong>Doctor:</strong> {{ appointment.doctorName }} ({{ appointment.doctorEmail }})</p>
            <p><strong>Status:</strong> {{ appointment.status|capitalize }}</p>
            <p><strong>Notes:</strong> {{ appointment.notes|default('-') }}</p>

            {# AI Suggestions Card #}
            {% if aiSuggestions %}
                <div class=\"card mt-4\" style=\"background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">
                            <i class=\"fas fa-robot\"></i> AI Pharmacist Suggestions
                        </h5>
                        <p class=\"card-text mb-0\">
                            Based on the consultation notes, the AI suggests considering:
                        </p>
                        <div class=\"mt-3\">
                            {% set suggestions = aiSuggestions|split(',') %}
                            {% for suggestion in suggestions %}
                                <span class=\"badge bg-light text-dark me-2 mb-2\" style=\"padding: 0.5rem 0.75rem; font-size: 0.95rem;\">
                                    <i class=\"fas fa-prescription-bottle-alt\"></i> {{ suggestion|trim }}
                                </span>
                            {% endfor %}
                        </div>
                        <small class=\"mt-3 d-block\" style=\"opacity: 0.9;\">💡 Discuss with the doctor before adding items to the parapharmacy list.</small>
                    </div>
                </div>
            {% elseif aiError %}
                <div class=\"alert alert-warning mt-4\" role=\"alert\">
                    <i class=\"fas fa-exclamation-triangle\"></i> <strong>AI Analysis:</strong> {{ aiError }}
                </div>
            {% endif %}

            <hr>
            <h5>Parapharmacie Items</h5>
            <div class=\"mb-3\">
                {% for item in appointment.parapharmacies is defined ? appointment.parapharmacies : [] %}
                    <div class=\"d-flex justify-content-between align-items-center border p-2 mb-2\">
                        <div>
                            <strong>{{ item.name }}</strong>
                            <div class=\"text-muted\">{{ item.description }}</div>
                        </div>
                        <div class=\"text-end\">
                            <div>{{ item.price }} USD</div>
                        </div>
                    </div>
                {% else %}
                    <div class=\"text-muted\">No parapharmacie items.</div>
                {% endfor %}
            </div>

            {% if is_granted('ROLE_DOCTOR') or is_granted('ROLE_ADMIN') %}
                <hr>
                <h5>Add Parapharmacie Item</h5>
                {{ form_start(paraphForm) }}
                    {{ form_row(paraphForm.name) }}
                    {{ form_row(paraphForm.description) }}
                    {{ form_row(paraphForm.price) }}
                    <div class=\"d-grid mt-2\">
                        <button class=\"btn btn-primary\">Add Item</button>
                    </div>
                {{ form_end(paraphForm) }}
            {% endif %}
        </div>
    </div>
</div>
{% endblock %}
", "appointment/show.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\appointment\\show.html.twig");
    }
}
