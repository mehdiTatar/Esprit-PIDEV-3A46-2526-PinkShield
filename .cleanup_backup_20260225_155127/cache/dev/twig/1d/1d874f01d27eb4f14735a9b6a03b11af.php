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

/* doctor/form.html.twig */
class __TwigTemplate_ee020398cf3833cb0173ece207862bda extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "doctor/form.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 3, $this->source); })()), "html", null, true);
        yield " - PinkShield";
        
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
        yield "<div class=\"row justify-content-center\">
    <div class=\"col-md-6\">
        <div class=\"card shadow-lg\">
            <div class=\"card-body p-5\">
                <h2 class=\"mb-4\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 10, $this->source); })()), "html", null, true);
        yield "</h2>

                ";
        // line 12
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 12, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        yield "
                ";
        // line 13
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 13, $this->source); })()), "_token", [], "any", false, false, false, 13), 'widget');
        yield "
                    ";
        // line 14
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 14, $this->source); })()), "vars", [], "any", false, false, false, 14), "errors", [], "any", false, false, false, 14)) > 0)) {
            // line 15
            yield "                        <div class=\"alert alert-danger\" role=\"alert\">
                            <strong>Please fix the following errors:</strong>
                            <ul class=\"mb-0\">
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
                        </div>
                    ";
        }
        // line 24
        yield "
                    <div class=\"mb-3\">
                        ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "email", [], "any", false, false, false, 26), 'label');
        yield "
                        ";
        // line 27
        $context["emailClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "email", [], "any", false, false, false, 27), "vars", [], "any", false, false, false, 27), "errors", [], "any", false, false, false, 27)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 28
        yield "                        <input type=\"text\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "email", [], "any", false, false, false, 28), "vars", [], "any", false, false, false, 28), "full_name", [], "any", false, false, false, 28), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "email", [], "any", false, false, false, 28), "vars", [], "any", false, false, false, 28), "id", [], "any", false, false, false, 28), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["emailClass"]) || array_key_exists("emailClass", $context) ? $context["emailClass"] : (function () { throw new RuntimeError('Variable "emailClass" does not exist.', 28, $this->source); })()), "html", null, true);
        yield "\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "email", [], "any", false, false, false, 28), "vars", [], "any", false, false, false, 28), "value", [], "any", false, false, false, 28), "html", null, true);
        yield "\">
                        ";
        // line 29
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 29, $this->source); })()), "email", [], "any", false, false, false, 29), "vars", [], "any", false, false, false, 29), "errors", [], "any", false, false, false, 29)) > 0)) {
            // line 30
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 31, $this->source); })()), "email", [], "any", false, false, false, 31), "vars", [], "any", false, false, false, 31), "errors", [], "any", false, false, false, 31));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 32
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 32), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            yield "                            </div>
                        ";
        }
        // line 36
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "fullName", [], "any", false, false, false, 39), 'label');
        yield "
                        ";
        // line 40
        $context["fullNameClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "fullName", [], "any", false, false, false, 40), "vars", [], "any", false, false, false, 40), "errors", [], "any", false, false, false, 40)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 41
        yield "                        <input type=\"text\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "fullName", [], "any", false, false, false, 41), "vars", [], "any", false, false, false, 41), "full_name", [], "any", false, false, false, 41), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "fullName", [], "any", false, false, false, 41), "vars", [], "any", false, false, false, 41), "id", [], "any", false, false, false, 41), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["fullNameClass"]) || array_key_exists("fullNameClass", $context) ? $context["fullNameClass"] : (function () { throw new RuntimeError('Variable "fullNameClass" does not exist.', 41, $this->source); })()), "html", null, true);
        yield "\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "fullName", [], "any", false, false, false, 41), "vars", [], "any", false, false, false, 41), "value", [], "any", false, false, false, 41), "html", null, true);
        yield "\">
                        ";
        // line 42
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), "fullName", [], "any", false, false, false, 42), "vars", [], "any", false, false, false, 42), "errors", [], "any", false, false, false, 42)) > 0)) {
            // line 43
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 44
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 44, $this->source); })()), "fullName", [], "any", false, false, false, 44), "vars", [], "any", false, false, false, 44), "errors", [], "any", false, false, false, 44));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 45
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 45), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "                            </div>
                        ";
        }
        // line 49
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 52
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "speciality", [], "any", false, false, false, 52), 'label');
        yield "
                        ";
        // line 53
        $context["specialityClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "speciality", [], "any", false, false, false, 53), "vars", [], "any", false, false, false, 53), "errors", [], "any", false, false, false, 53)) > 0)) ? ("form-select is-invalid") : ("form-select"));
        // line 54
        yield "                        <select name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "speciality", [], "any", false, false, false, 54), "vars", [], "any", false, false, false, 54), "full_name", [], "any", false, false, false, 54), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 54, $this->source); })()), "speciality", [], "any", false, false, false, 54), "vars", [], "any", false, false, false, 54), "id", [], "any", false, false, false, 54), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["specialityClass"]) || array_key_exists("specialityClass", $context) ? $context["specialityClass"] : (function () { throw new RuntimeError('Variable "specialityClass" does not exist.', 54, $this->source); })()), "html", null, true);
        yield "\">
                            <option value=\"\">Select a speciality...</option>
                            ";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 56, $this->source); })()), "speciality", [], "any", false, false, false, 56), "vars", [], "any", false, false, false, 56), "choices", [], "any", false, false, false, 56));
        foreach ($context['_seq'] as $context["_key"] => $context["choice"]) {
            // line 57
            yield "                                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "value", [], "any", false, false, false, 57), "html", null, true);
            yield "\" ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "value", [], "any", false, false, false, 57) == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 57, $this->source); })()), "speciality", [], "any", false, false, false, 57), "vars", [], "any", false, false, false, 57), "value", [], "any", false, false, false, 57))) {
                yield "selected";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "label", [], "any", false, false, false, 57), "html", null, true);
            yield "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['choice'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        yield "                        </select>
                        ";
        // line 60
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 60, $this->source); })()), "speciality", [], "any", false, false, false, 60), "vars", [], "any", false, false, false, 60), "errors", [], "any", false, false, false, 60)) > 0)) {
            // line 61
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 62
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), "speciality", [], "any", false, false, false, 62), "vars", [], "any", false, false, false, 62), "errors", [], "any", false, false, false, 62));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 63
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 63), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            yield "                            </div>
                        ";
        }
        // line 67
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 70
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 70, $this->source); })()), "address", [], "any", false, false, false, 70), 'label');
        yield "
                        ";
        // line 71
        $context["addressClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 71, $this->source); })()), "address", [], "any", false, false, false, 71), "vars", [], "any", false, false, false, 71), "errors", [], "any", false, false, false, 71)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 72
        yield "                        <input type=\"text\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "address", [], "any", false, false, false, 72), "vars", [], "any", false, false, false, 72), "full_name", [], "any", false, false, false, 72), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "address", [], "any", false, false, false, 72), "vars", [], "any", false, false, false, 72), "id", [], "any", false, false, false, 72), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["addressClass"]) || array_key_exists("addressClass", $context) ? $context["addressClass"] : (function () { throw new RuntimeError('Variable "addressClass" does not exist.', 72, $this->source); })()), "html", null, true);
        yield "\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 72, $this->source); })()), "address", [], "any", false, false, false, 72), "vars", [], "any", false, false, false, 72), "value", [], "any", false, false, false, 72), "html", null, true);
        yield "\">
                        ";
        // line 73
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 73, $this->source); })()), "address", [], "any", false, false, false, 73), "vars", [], "any", false, false, false, 73), "errors", [], "any", false, false, false, 73)) > 0)) {
            // line 74
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), "address", [], "any", false, false, false, 75), "vars", [], "any", false, false, false, 75), "errors", [], "any", false, false, false, 75));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 76
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 76), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            yield "                            </div>
                        ";
        }
        // line 80
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 83
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 83, $this->source); })()), "phone", [], "any", false, false, false, 83), 'label');
        yield "
                        ";
        // line 84
        $context["phoneClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 84, $this->source); })()), "phone", [], "any", false, false, false, 84), "vars", [], "any", false, false, false, 84), "errors", [], "any", false, false, false, 84)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 85
        yield "                        <input type=\"text\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 85, $this->source); })()), "phone", [], "any", false, false, false, 85), "vars", [], "any", false, false, false, 85), "full_name", [], "any", false, false, false, 85), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 85, $this->source); })()), "phone", [], "any", false, false, false, 85), "vars", [], "any", false, false, false, 85), "id", [], "any", false, false, false, 85), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["phoneClass"]) || array_key_exists("phoneClass", $context) ? $context["phoneClass"] : (function () { throw new RuntimeError('Variable "phoneClass" does not exist.', 85, $this->source); })()), "html", null, true);
        yield "\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 85, $this->source); })()), "phone", [], "any", false, false, false, 85), "vars", [], "any", false, false, false, 85), "value", [], "any", false, false, false, 85), "html", null, true);
        yield "\">
                        ";
        // line 86
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 86, $this->source); })()), "phone", [], "any", false, false, false, 86), "vars", [], "any", false, false, false, 86), "errors", [], "any", false, false, false, 86)) > 0)) {
            // line 87
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 88
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 88, $this->source); })()), "phone", [], "any", false, false, false, 88), "vars", [], "any", false, false, false, 88), "errors", [], "any", false, false, false, 88));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 89
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 89), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 91
            yield "                            </div>
                        ";
        }
        // line 93
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 96
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 96, $this->source); })()), "password", [], "any", false, false, false, 96), 'label');
        yield "
                        ";
        // line 97
        $context["passwordClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 97, $this->source); })()), "password", [], "any", false, false, false, 97), "vars", [], "any", false, false, false, 97), "errors", [], "any", false, false, false, 97)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 98
        yield "                        <input type=\"password\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 98, $this->source); })()), "password", [], "any", false, false, false, 98), "vars", [], "any", false, false, false, 98), "full_name", [], "any", false, false, false, 98), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 98, $this->source); })()), "password", [], "any", false, false, false, 98), "vars", [], "any", false, false, false, 98), "id", [], "any", false, false, false, 98), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["passwordClass"]) || array_key_exists("passwordClass", $context) ? $context["passwordClass"] : (function () { throw new RuntimeError('Variable "passwordClass" does not exist.', 98, $this->source); })()), "html", null, true);
        yield "\">
                        ";
        // line 99
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 99, $this->source); })()), "password", [], "any", false, false, false, 99), "vars", [], "any", false, false, false, 99), "errors", [], "any", false, false, false, 99)) > 0)) {
            // line 100
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 101
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 101, $this->source); })()), "password", [], "any", false, false, false, 101), "vars", [], "any", false, false, false, 101), "errors", [], "any", false, false, false, 101));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 102
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 102), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            yield "                            </div>
                        ";
        }
        // line 106
        yield "                    </div>

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
                        <a href=\"";
        // line 110
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 110, $this->source); })()), "vars", [], "any", false, false, false, 110), "data", [], "any", false, false, false, 110), "id", [], "any", false, false, false, 110)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_index");
        } else {
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login");
        }
        yield "\" class=\"btn btn-secondary\">Cancel</a>
                    </div>
                ";
        // line 112
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 112, $this->source); })()), 'form_end', ["render_rest" => false]);
        yield "
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
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>
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
        return "doctor/form.html.twig";
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
        return array (  427 => 112,  418 => 110,  412 => 106,  408 => 104,  399 => 102,  395 => 101,  392 => 100,  390 => 99,  381 => 98,  379 => 97,  375 => 96,  370 => 93,  366 => 91,  357 => 89,  353 => 88,  350 => 87,  348 => 86,  337 => 85,  335 => 84,  331 => 83,  326 => 80,  322 => 78,  313 => 76,  309 => 75,  306 => 74,  304 => 73,  293 => 72,  291 => 71,  287 => 70,  282 => 67,  278 => 65,  269 => 63,  265 => 62,  262 => 61,  260 => 60,  257 => 59,  242 => 57,  238 => 56,  228 => 54,  226 => 53,  222 => 52,  217 => 49,  213 => 47,  204 => 45,  200 => 44,  197 => 43,  195 => 42,  184 => 41,  182 => 40,  178 => 39,  173 => 36,  169 => 34,  160 => 32,  156 => 31,  153 => 30,  151 => 29,  140 => 28,  138 => 27,  134 => 26,  130 => 24,  125 => 21,  116 => 19,  112 => 18,  107 => 15,  105 => 14,  101 => 13,  97 => 12,  92 => 10,  86 => 6,  76 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}{{ title }} - PinkShield{% endblock %}

{% block body %}
<div class=\"row justify-content-center\">
    <div class=\"col-md-6\">
        <div class=\"card shadow-lg\">
            <div class=\"card-body p-5\">
                <h2 class=\"mb-4\">{{ title }}</h2>

                {{ form_start(form, {'attr': {'novalidate': 'novalidate'}}) }}
                {{ form_widget(form._token) }}
                    {% if form.vars.errors|length > 0 %}
                        <div class=\"alert alert-danger\" role=\"alert\">
                            <strong>Please fix the following errors:</strong>
                            <ul class=\"mb-0\">
                                {% for error in form.vars.errors %}
                                    <li>{{ error.message }}</li>
                                {% endfor %}
                            </ul>
                        </div>
                    {% endif %}

                    <div class=\"mb-3\">
                        {{ form_label(form.email) }}
                        {% set emailClass = form.email.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"text\" name=\"{{ form.email.vars.full_name }}\" id=\"{{ form.email.vars.id }}\" class=\"{{ emailClass }}\" value=\"{{ form.email.vars.value }}\">
                        {% if form.email.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.email.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"mb-3\">
                        {{ form_label(form.fullName) }}
                        {% set fullNameClass = form.fullName.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"text\" name=\"{{ form.fullName.vars.full_name }}\" id=\"{{ form.fullName.vars.id }}\" class=\"{{ fullNameClass }}\" value=\"{{ form.fullName.vars.value }}\">
                        {% if form.fullName.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.fullName.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"mb-3\">
                        {{ form_label(form.speciality) }}
                        {% set specialityClass = form.speciality.vars.errors|length > 0 ? 'form-select is-invalid' : 'form-select' %}
                        <select name=\"{{ form.speciality.vars.full_name }}\" id=\"{{ form.speciality.vars.id }}\" class=\"{{ specialityClass }}\">
                            <option value=\"\">Select a speciality...</option>
                            {% for choice in form.speciality.vars.choices %}
                                <option value=\"{{ choice.value }}\" {% if choice.value == form.speciality.vars.value %}selected{% endif %}>{{ choice.label }}</option>
                            {% endfor %}
                        </select>
                        {% if form.speciality.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.speciality.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"mb-3\">
                        {{ form_label(form.address) }}
                        {% set addressClass = form.address.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"text\" name=\"{{ form.address.vars.full_name }}\" id=\"{{ form.address.vars.id }}\" class=\"{{ addressClass }}\" value=\"{{ form.address.vars.value }}\">
                        {% if form.address.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.address.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"mb-3\">
                        {{ form_label(form.phone) }}
                        {% set phoneClass = form.phone.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"text\" name=\"{{ form.phone.vars.full_name }}\" id=\"{{ form.phone.vars.id }}\" class=\"{{ phoneClass }}\" value=\"{{ form.phone.vars.value }}\">
                        {% if form.phone.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.phone.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"mb-3\">
                        {{ form_label(form.password) }}
                        {% set passwordClass = form.password.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"password\" name=\"{{ form.password.vars.full_name }}\" id=\"{{ form.password.vars.id }}\" class=\"{{ passwordClass }}\">
                        {% if form.password.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.password.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
                        <a href=\"{% if form.vars.data.id %}{{ path('doctor_index') }}{% else %}{{ path('login') }}{% endif %}\" class=\"btn btn-secondary\">Cancel</a>
                    </div>
                {{ form_end(form, {'render_rest': false}) }}
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
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "doctor/form.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\doctor\\form.html.twig");
    }
}
