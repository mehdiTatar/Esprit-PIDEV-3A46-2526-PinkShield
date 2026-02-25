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

/* appointment/suggestion.html.twig */
class __TwigTemplate_3b2ff098dde9641e702e41f98956e091 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointment/suggestion.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        yield "    <h1>Appointment Suggestion</h1>

    ";
        // line 6
        if ((($tmp = (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 6, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 7
            yield "        <p>Based on your recent statistics, we suggest booking an appointment with a ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 7, $this->source); })()), "html", null, true);
            yield ".</p>
    ";
        } else {
            // line 9
            yield "        <p>No appointments are suggested at the moment. Keep up the good work!</p>
    ";
        }
        // line 11
        yield "
    <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\">Back to Appointments</a>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "appointment/suggestion.html.twig";
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
        return array (  86 => 12,  83 => 11,  79 => 9,  73 => 7,  71 => 6,  67 => 4,  57 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <h1>Appointment Suggestion</h1>

    {% if doctor %}
        <p>Based on your recent statistics, we suggest booking an appointment with a {{ doctor }}.</p>
    {% else %}
        <p>No appointments are suggested at the moment. Keep up the good work!</p>
    {% endif %}

    <a href=\"{{ path('appointment_index') }}\">Back to Appointments</a>
{% endblock %}", "appointment/suggestion.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\appointment\\suggestion.html.twig");
    }
}
