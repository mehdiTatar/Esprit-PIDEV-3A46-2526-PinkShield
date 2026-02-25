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

/* appointment/edit.html.twig */
class __TwigTemplate_ee65689c4884b971df54f74c3161530f extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointment/edit.html.twig"));

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

        yield "Edit Appointment";
        
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
    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-primary text-white\">
                    <h4 class=\"mb-0\">Edit Appointment</h4>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\">
                        <div class=\"mb-3\">
                            <label for=\"date\" class=\"form-label\">Date & Time</label>
                            <input type=\"datetime-local\" name=\"date\" id=\"date\" class=\"form-control\" value=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 17, $this->source); })()), "appointmentDate", [], "any", false, false, false, 17), "Y-m-d\\TH:i"), "html", null, true);
        yield "\">
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"notes\" class=\"form-label\">Notes</label>
                            <textarea name=\"notes\" id=\"notes\" class=\"form-control\" rows=\"4\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 21, $this->source); })()), "notes", [], "any", false, false, false, 21), "html", null, true);
        yield "</textarea>
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"status\" class=\"form-label\">Status</label>
                            <select name=\"status\" id=\"status\" class=\"form-select\">
                                <option value=\"pending\" ";
        // line 26
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 26, $this->source); })()), "status", [], "any", false, false, false, 26) == "pending")) {
            yield "selected";
        }
        yield ">Pending</option>
                                <option value=\"confirmed\" ";
        // line 27
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 27, $this->source); })()), "status", [], "any", false, false, false, 27) == "confirmed")) {
            yield "selected";
        }
        yield ">Confirmed</option>
                                <option value=\"cancelled\" ";
        // line 28
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 28, $this->source); })()), "status", [], "any", false, false, false, 28) == "cancelled")) {
            yield "selected";
        }
        yield ">Cancelled</option>
                            </select>
                        </div>
                        <div class=\"d-grid gap-2\">
                            <button class=\"btn btn-primary\">Save Changes</button>
                            <a href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 33, $this->source); })()), "id", [], "any", false, false, false, 33)]), "html", null, true);
        yield "\" class=\"btn btn-secondary\">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        return "appointment/edit.html.twig";
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
        return array (  135 => 33,  125 => 28,  119 => 27,  113 => 26,  105 => 21,  98 => 17,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Appointment{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-primary text-white\">
                    <h4 class=\"mb-0\">Edit Appointment</h4>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\">
                        <div class=\"mb-3\">
                            <label for=\"date\" class=\"form-label\">Date & Time</label>
                            <input type=\"datetime-local\" name=\"date\" id=\"date\" class=\"form-control\" value=\"{{ appointment.appointmentDate|date('Y-m-d\\\\TH:i') }}\">
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"notes\" class=\"form-label\">Notes</label>
                            <textarea name=\"notes\" id=\"notes\" class=\"form-control\" rows=\"4\">{{ appointment.notes }}</textarea>
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"status\" class=\"form-label\">Status</label>
                            <select name=\"status\" id=\"status\" class=\"form-select\">
                                <option value=\"pending\" {% if appointment.status == 'pending' %}selected{% endif %}>Pending</option>
                                <option value=\"confirmed\" {% if appointment.status == 'confirmed' %}selected{% endif %}>Confirmed</option>
                                <option value=\"cancelled\" {% if appointment.status == 'cancelled' %}selected{% endif %}>Cancelled</option>
                            </select>
                        </div>
                        <div class=\"d-grid gap-2\">
                            <button class=\"btn btn-primary\">Save Changes</button>
                            <a href=\"{{ path('appointment_show', {'id': appointment.id}) }}\" class=\"btn btn-secondary\">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "appointment/edit.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\appointment\\edit.html.twig");
    }
}
