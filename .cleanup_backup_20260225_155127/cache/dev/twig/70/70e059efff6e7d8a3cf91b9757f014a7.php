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

/* doctor/show.html.twig */
class __TwigTemplate_36b973a6d1f1b6ffa41d39c1ff4baa6a extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "doctor/show.html.twig"));

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

        yield "Doctor Details - PinkShield";
        
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
        yield "<div class=\"row\">
    <div class=\"col-md-8\">
        <div class=\"card shadow-lg\">
            <div class=\"card-body\">
                <h2 class=\"mb-4\">Doctor Details</h2>
                
                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>ID:</strong></label>
                    <p>";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 14, $this->source); })()), "id", [], "any", false, false, false, 14), "html", null, true);
        yield "</p>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>Email:</strong></label>
                    <p>";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 19, $this->source); })()), "email", [], "any", false, false, false, 19), "html", null, true);
        yield "</p>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>Full Name:</strong></label>
                    <p>";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 24, $this->source); })()), "fullName", [], "any", false, false, false, 24), "html", null, true);
        yield "</p>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>Speciality:</strong></label>
                    <p>";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 29, $this->source); })()), "speciality", [], "any", false, false, false, 29), "html", null, true);
        yield "</p>
                </div>

                <div class=\"d-flex gap-2\">
                    <a href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 33, $this->source); })()), "id", [], "any", false, false, false, 33)]), "html", null, true);
        yield "\" class=\"btn btn-warning\">Edit</a>
                    <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_index");
        yield "\" class=\"btn btn-secondary\">Back</a>
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
        return "doctor/show.html.twig";
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
        return array (  130 => 34,  126 => 33,  119 => 29,  111 => 24,  103 => 19,  95 => 14,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Doctor Details - PinkShield{% endblock %}

{% block body %}
<div class=\"row\">
    <div class=\"col-md-8\">
        <div class=\"card shadow-lg\">
            <div class=\"card-body\">
                <h2 class=\"mb-4\">Doctor Details</h2>
                
                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>ID:</strong></label>
                    <p>{{ doctor.id }}</p>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>Email:</strong></label>
                    <p>{{ doctor.email }}</p>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>Full Name:</strong></label>
                    <p>{{ doctor.fullName }}</p>
                </div>

                <div class=\"mb-3\">
                    <label class=\"form-label\"><strong>Speciality:</strong></label>
                    <p>{{ doctor.speciality }}</p>
                </div>

                <div class=\"d-flex gap-2\">
                    <a href=\"{{ path('doctor_edit', {id: doctor.id}) }}\" class=\"btn btn-warning\">Edit</a>
                    <a href=\"{{ path('doctor_index') }}\" class=\"btn btn-secondary\">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "doctor/show.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\doctor\\show.html.twig");
    }
}
