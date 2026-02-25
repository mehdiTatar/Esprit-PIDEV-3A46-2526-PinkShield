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

/* appointment/new.html.twig */
class __TwigTemplate_f4d3ae0812f0b93b2cfaba2bc0a53b07 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointment/new.html.twig"));

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

        yield "Book an Appointment";
        
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
                    <h2 class=\"mb-0\">Book an Appointment</h2>
                </div>
                <div class=\"card-body\">
                    ";
        // line 14
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 14, $this->source); })()), "vars", [], "any", false, false, false, 14), "errors", [], "any", false, false, false, 14)) > 0)) {
            // line 15
            yield "                        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                            <strong><i class=\"fas fa-exclamation-circle me-2\"></i> Please fix the following errors:</strong>
                            <ul class=\"mb-0 mt-2\">
                                ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 18, $this->source); })()), "vars", [], "any", false, false, false, 18), "errors", [], "any", false, false, false, 18));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 19
                yield "                                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 19), "html", null, true);
                yield "</li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            yield "                            </ul>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                        </div>
                    ";
        }
        // line 25
        yield "
                    ";
        // line 26
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        yield "
                        ";
        // line 27
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "_token", [], "any", false, false, false, 27), 'widget');
        yield "
                        <div class=\"mb-3\">
                            ";
        // line 29
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 29, $this->source); })()), "doctorEmail", [], "any", false, false, false, 29), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 30
        $context["doctorClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), "doctorEmail", [], "any", false, false, false, 30), "vars", [], "any", false, false, false, 30), "errors", [], "any", false, false, false, 30)) > 0)) ? ("form-select is-invalid") : ("form-select"));
        // line 31
        yield "                            <select name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "doctorEmail", [], "any", false, false, false, 31), "vars", [], "any", false, false, false, 31), "full_name", [], "any", false, false, false, 31), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "doctorEmail", [], "any", false, false, false, 31), "vars", [], "any", false, false, false, 31), "id", [], "any", false, false, false, 31), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["doctorClass"]) || array_key_exists("doctorClass", $context) ? $context["doctorClass"] : (function () { throw new RuntimeError('Variable "doctorClass" does not exist.', 31, $this->source); })()), "html", null, true);
        yield "\">
                                <option value=\"\">Choose a doctor...</option>
                                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 33, $this->source); })()), "doctorEmail", [], "any", false, false, false, 33), "vars", [], "any", false, false, false, 33), "choices", [], "any", false, false, false, 33));
        foreach ($context['_seq'] as $context["_key"] => $context["choice"]) {
            // line 34
            yield "                                    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "value", [], "any", false, false, false, 34), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "label", [], "any", false, false, false, 34), "html", null, true);
            yield "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['choice'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "                            </select>
                            ";
        // line 37
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 37, $this->source); })()), "doctorEmail", [], "any", false, false, false, 37), "vars", [], "any", false, false, false, 37), "errors", [], "any", false, false, false, 37)) > 0)) {
            // line 38
            yield "                                <div class=\"invalid-feedback d-block\">
                                    ";
            // line 39
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "doctorEmail", [], "any", false, false, false, 39), "vars", [], "any", false, false, false, 39), "errors", [], "any", false, false, false, 39));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 40
                yield "                                        <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 40), "html", null, true);
                yield "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            yield "                                </div>
                            ";
        }
        // line 44
        yield "                            <small class=\"form-text text-muted d-block mt-2\">
                                <i class=\"fas fa-info-circle\"></i> Only active doctors are available for booking.
                            </small>
                        </div>

                        <div class=\"mb-3\">
                            ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 50, $this->source); })()), "appointmentDate", [], "any", false, false, false, 50), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 51
        $context["dateClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "appointmentDate", [], "any", false, false, false, 51), "vars", [], "any", false, false, false, 51), "errors", [], "any", false, false, false, 51)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 52
        yield "                            <input type=\"datetime-local\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "appointmentDate", [], "any", false, false, false, 52), "vars", [], "any", false, false, false, 52), "full_name", [], "any", false, false, false, 52), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "appointmentDate", [], "any", false, false, false, 52), "vars", [], "any", false, false, false, 52), "id", [], "any", false, false, false, 52), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["dateClass"]) || array_key_exists("dateClass", $context) ? $context["dateClass"] : (function () { throw new RuntimeError('Variable "dateClass" does not exist.', 52, $this->source); })()), "html", null, true);
        yield "\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "appointmentDate", [], "any", false, false, false, 52), "vars", [], "any", false, false, false, 52), "value", [], "any", false, false, false, 52), "html", null, true);
        yield "\">
                            ";
        // line 53
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "appointmentDate", [], "any", false, false, false, 53), "vars", [], "any", false, false, false, 53), "errors", [], "any", false, false, false, 53)) > 0)) {
            // line 54
            yield "                                <div class=\"invalid-feedback d-block\">
                                    ";
            // line 55
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 55, $this->source); })()), "appointmentDate", [], "any", false, false, false, 55), "vars", [], "any", false, false, false, 55), "errors", [], "any", false, false, false, 55));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 56
                yield "                                        <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 56), "html", null, true);
                yield "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            yield "                                </div>
                            ";
        }
        // line 60
        yield "                        </div>

                        <div class=\"mb-3\">
                            ";
        // line 63
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 63, $this->source); })()), "notes", [], "any", false, false, false, 63), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                            ";
        // line 64
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 64, $this->source); })()), "notes", [], "any", false, false, false, 64), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 64, $this->source); })()), "notes", [], "any", false, false, false, 64), "vars", [], "any", false, false, false, 64), "errors", [], "any", false, false, false, 64)) > 0)) ? ("form-control is-invalid") : ("form-control"))]]);
        yield "
                            ";
        // line 65
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 65, $this->source); })()), "notes", [], "any", false, false, false, 65), "vars", [], "any", false, false, false, 65), "errors", [], "any", false, false, false, 65)) > 0)) {
            // line 66
            yield "                                <div class=\"invalid-feedback d-block\">
                                    ";
            // line 67
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "notes", [], "any", false, false, false, 67), "vars", [], "any", false, false, false, 67), "errors", [], "any", false, false, false, 67));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 68
                yield "                                        <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 68), "html", null, true);
                yield "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            yield "                                </div>
                            ";
        }
        // line 72
        yield "                        </div>

                        <div class=\"d-grid gap-2\">
                            <button type=\"submit\" class=\"btn btn-primary btn-lg\">Book Appointment</button>
                            <a href=\"";
        // line 76
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"btn btn-secondary\">Cancel</a>
                        </div>
                    ";
        // line 78
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), 'form_end', ["render_rest" => false]);
        yield "
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .invalid-feedback {
        display: block !important;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
        font-weight: 500;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
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
        return "appointment/new.html.twig";
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
        return array (  282 => 78,  277 => 76,  271 => 72,  267 => 70,  258 => 68,  254 => 67,  251 => 66,  249 => 65,  245 => 64,  241 => 63,  236 => 60,  232 => 58,  223 => 56,  219 => 55,  216 => 54,  214 => 53,  203 => 52,  201 => 51,  197 => 50,  189 => 44,  185 => 42,  176 => 40,  172 => 39,  169 => 38,  167 => 37,  164 => 36,  153 => 34,  149 => 33,  139 => 31,  137 => 30,  133 => 29,  128 => 27,  124 => 26,  121 => 25,  115 => 21,  106 => 19,  102 => 18,  97 => 15,  95 => 14,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Book an Appointment{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-primary text-white\">
                    <h2 class=\"mb-0\">Book an Appointment</h2>
                </div>
                <div class=\"card-body\">
                    {% if form.vars.errors|length > 0 %}
                        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                            <strong><i class=\"fas fa-exclamation-circle me-2\"></i> Please fix the following errors:</strong>
                            <ul class=\"mb-0 mt-2\">
                                {% for error in form.vars.errors %}
                                    <li>{{ error.message }}</li>
                                {% endfor %}
                            </ul>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                        </div>
                    {% endif %}

                    {{ form_start(form, {'attr': {'novalidate': 'novalidate'}}) }}
                        {{ form_widget(form._token) }}
                        <div class=\"mb-3\">
                            {{ form_label(form.doctorEmail, null, {'label_attr': {'class': 'form-label'}}) }}
                            {% set doctorClass = form.doctorEmail.vars.errors|length > 0 ? 'form-select is-invalid' : 'form-select' %}
                            <select name=\"{{ form.doctorEmail.vars.full_name }}\" id=\"{{ form.doctorEmail.vars.id }}\" class=\"{{ doctorClass }}\">
                                <option value=\"\">Choose a doctor...</option>
                                {% for choice in form.doctorEmail.vars.choices %}
                                    <option value=\"{{ choice.value }}\">{{ choice.label }}</option>
                                {% endfor %}
                            </select>
                            {% if form.doctorEmail.vars.errors|length > 0 %}
                                <div class=\"invalid-feedback d-block\">
                                    {% for error in form.doctorEmail.vars.errors %}
                                        <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                    {% endfor %}
                                </div>
                            {% endif %}
                            <small class=\"form-text text-muted d-block mt-2\">
                                <i class=\"fas fa-info-circle\"></i> Only active doctors are available for booking.
                            </small>
                        </div>

                        <div class=\"mb-3\">
                            {{ form_label(form.appointmentDate, null, {'label_attr': {'class': 'form-label'}}) }}
                            {% set dateClass = form.appointmentDate.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                            <input type=\"datetime-local\" name=\"{{ form.appointmentDate.vars.full_name }}\" id=\"{{ form.appointmentDate.vars.id }}\" class=\"{{ dateClass }}\" value=\"{{ form.appointmentDate.vars.value }}\">
                            {% if form.appointmentDate.vars.errors|length > 0 %}
                                <div class=\"invalid-feedback d-block\">
                                    {% for error in form.appointmentDate.vars.errors %}
                                        <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                    {% endfor %}
                                </div>
                            {% endif %}
                        </div>

                        <div class=\"mb-3\">
                            {{ form_label(form.notes, null, {'label_attr': {'class': 'form-label'}}) }}
                            {{ form_widget(form.notes, {'attr': {'class': form.notes.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control'}}) }}
                            {% if form.notes.vars.errors|length > 0 %}
                                <div class=\"invalid-feedback d-block\">
                                    {% for error in form.notes.vars.errors %}
                                        <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                    {% endfor %}
                                </div>
                            {% endif %}
                        </div>

                        <div class=\"d-grid gap-2\">
                            <button type=\"submit\" class=\"btn btn-primary btn-lg\">Book Appointment</button>
                            <a href=\"{{ path('appointment_index') }}\" class=\"btn btn-secondary\">Cancel</a>
                        </div>
                    {{ form_end(form, {'render_rest': false}) }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .invalid-feedback {
        display: block !important;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
        font-weight: 500;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
</style>
{% endblock %}
", "appointment/new.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\appointment\\new.html.twig");
    }
}
