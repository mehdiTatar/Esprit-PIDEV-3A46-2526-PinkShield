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

/* user/form.html.twig */
class __TwigTemplate_14ca16d349f86fcc29c30a636bff1f17 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/form.html.twig"));

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
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 12, $this->source); })()), 'form_start');
        yield "
                    ";
        // line 13
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 13, $this->source); })()), "vars", [], "any", false, false, false, 13), "errors", [], "any", false, false, false, 13)) > 0)) {
            // line 14
            yield "                        <div class=\"alert alert-danger\" role=\"alert\">
                            <strong>Please fix the following errors:</strong>
                            <ul class=\"mb-0\">
                                ";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 17, $this->source); })()), "vars", [], "any", false, false, false, 17), "errors", [], "any", false, false, false, 17));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 18
                yield "                                    <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 18), "html", null, true);
                yield "</li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            yield "                            </ul>
                        </div>
                    ";
        }
        // line 23
        yield "
                    <div class=\"mb-3\">
                        ";
        // line 25
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 25, $this->source); })()), "email", [], "any", false, false, false, 25), 'label');
        yield "
                        ";
        // line 26
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "email", [], "any", false, false, false, 26), 'widget');
        yield "
                        ";
        // line 27
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 27, $this->source); })()), "email", [], "any", false, false, false, 27), "vars", [], "any", false, false, false, 27), "errors", [], "any", false, false, false, 27)) > 0)) {
            // line 28
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 29, $this->source); })()), "email", [], "any", false, false, false, 29), "vars", [], "any", false, false, false, 29), "errors", [], "any", false, false, false, 29));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 30
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 30), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            yield "                            </div>
                        ";
        }
        // line 34
        yield "                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-6 mb-3\">
                            ";
        // line 38
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 38, $this->source); })()), "firstName", [], "any", false, false, false, 38), 'label');
        yield "
                            ";
        // line 39
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 39, $this->source); })()), "firstName", [], "any", false, false, false, 39), 'widget');
        yield "
                            ";
        // line 40
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "firstName", [], "any", false, false, false, 40), "vars", [], "any", false, false, false, 40), "errors", [], "any", false, false, false, 40)) > 0)) {
            // line 41
            yield "                                <div class=\"invalid-feedback d-block\">
                                    ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), "firstName", [], "any", false, false, false, 42), "vars", [], "any", false, false, false, 42), "errors", [], "any", false, false, false, 42));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 43
                yield "                                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 43), "html", null, true);
                yield "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 45
            yield "                                </div>
                            ";
        }
        // line 47
        yield "                        </div>
                        <div class=\"col-md-6 mb-3\">
                            ";
        // line 49
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 49, $this->source); })()), "lastName", [], "any", false, false, false, 49), 'label');
        yield "
                            ";
        // line 50
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 50, $this->source); })()), "lastName", [], "any", false, false, false, 50), 'widget');
        yield "
                            ";
        // line 51
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "lastName", [], "any", false, false, false, 51), "vars", [], "any", false, false, false, 51), "errors", [], "any", false, false, false, 51)) > 0)) {
            // line 52
            yield "                                <div class=\"invalid-feedback d-block\">
                                    ";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 53, $this->source); })()), "lastName", [], "any", false, false, false, 53), "vars", [], "any", false, false, false, 53), "errors", [], "any", false, false, false, 53));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 54
                yield "                                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 54), "html", null, true);
                yield "
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            yield "                                </div>
                            ";
        }
        // line 58
        yield "                        </div>
                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 62
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 62, $this->source); })()), "address", [], "any", false, false, false, 62), 'label');
        yield "
                        ";
        // line 63
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 63, $this->source); })()), "address", [], "any", false, false, false, 63), 'widget');
        yield "
                        ";
        // line 64
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 64, $this->source); })()), "address", [], "any", false, false, false, 64), "vars", [], "any", false, false, false, 64), "errors", [], "any", false, false, false, 64)) > 0)) {
            // line 65
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 66
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 66, $this->source); })()), "address", [], "any", false, false, false, 66), "vars", [], "any", false, false, false, 66), "errors", [], "any", false, false, false, 66));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 67
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 67), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            yield "                            </div>
                        ";
        }
        // line 71
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 74
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 74, $this->source); })()), "phone", [], "any", false, false, false, 74), 'label');
        yield "
                        ";
        // line 75
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 75, $this->source); })()), "phone", [], "any", false, false, false, 75), 'widget');
        yield "
                        ";
        // line 76
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 76, $this->source); })()), "phone", [], "any", false, false, false, 76), "vars", [], "any", false, false, false, 76), "errors", [], "any", false, false, false, 76)) > 0)) {
            // line 77
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 78
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), "phone", [], "any", false, false, false, 78), "vars", [], "any", false, false, false, 78), "errors", [], "any", false, false, false, 78));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 79
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 79), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            yield "                            </div>
                        ";
        }
        // line 83
        yield "                    </div>

                    <div class=\"mb-3\">
                        ";
        // line 86
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 86, $this->source); })()), "password", [], "any", false, false, false, 86), 'label');
        yield "
                        ";
        // line 87
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 87, $this->source); })()), "password", [], "any", false, false, false, 87), 'widget');
        yield "
                        ";
        // line 88
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 88, $this->source); })()), "password", [], "any", false, false, false, 88), "vars", [], "any", false, false, false, 88), "errors", [], "any", false, false, false, 88)) > 0)) {
            // line 89
            yield "                            <div class=\"invalid-feedback d-block\">
                                ";
            // line 90
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "password", [], "any", false, false, false, 90), "vars", [], "any", false, false, false, 90), "errors", [], "any", false, false, false, 90));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 91
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 91), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            yield "                            </div>
                        ";
        }
        // line 95
        yield "                    </div>

                    <div class=\"d-grid gap-2\">
                        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
                        <a href=\"";
        // line 99
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 99, $this->source); })()), "vars", [], "any", false, false, false, 99), "data", [], "any", false, false, false, 99), "id", [], "any", false, false, false, 99)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
        } else {
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login");
        }
        yield "\" class=\"btn btn-secondary\">Cancel</a>
                    </div>
                ";
        // line 101
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 101, $this->source); })()), 'form_end');
        yield "
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
        return "user/form.html.twig";
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
        return array (  351 => 101,  342 => 99,  336 => 95,  332 => 93,  323 => 91,  319 => 90,  316 => 89,  314 => 88,  310 => 87,  306 => 86,  301 => 83,  297 => 81,  288 => 79,  284 => 78,  281 => 77,  279 => 76,  275 => 75,  271 => 74,  266 => 71,  262 => 69,  253 => 67,  249 => 66,  246 => 65,  244 => 64,  240 => 63,  236 => 62,  230 => 58,  226 => 56,  217 => 54,  213 => 53,  210 => 52,  208 => 51,  204 => 50,  200 => 49,  196 => 47,  192 => 45,  183 => 43,  179 => 42,  176 => 41,  174 => 40,  170 => 39,  166 => 38,  160 => 34,  156 => 32,  147 => 30,  143 => 29,  140 => 28,  138 => 27,  134 => 26,  130 => 25,  126 => 23,  121 => 20,  112 => 18,  108 => 17,  103 => 14,  101 => 13,  97 => 12,  92 => 10,  86 => 6,  76 => 5,  58 => 3,  41 => 1,);
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

                {{ form_start(form) }}
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
                        {{ form_widget(form.email) }}
                        {% if form.email.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback d-block\">
                                {% for error in form.email.vars.errors %}
                                    {{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-6 mb-3\">
                            {{ form_label(form.firstName) }}
                            {{ form_widget(form.firstName) }}
                            {% if form.firstName.vars.errors|length > 0 %}
                                <div class=\"invalid-feedback d-block\">
                                    {% for error in form.firstName.vars.errors %}
                                        {{ error.message }}
                                    {% endfor %}
                                </div>
                            {% endif %}
                        </div>
                        <div class=\"col-md-6 mb-3\">
                            {{ form_label(form.lastName) }}
                            {{ form_widget(form.lastName) }}
                            {% if form.lastName.vars.errors|length > 0 %}
                                <div class=\"invalid-feedback d-block\">
                                    {% for error in form.lastName.vars.errors %}
                                        {{ error.message }}
                                    {% endfor %}
                                </div>
                            {% endif %}
                        </div>
                    </div>

                    <div class=\"mb-3\">
                        {{ form_label(form.address) }}
                        {{ form_widget(form.address) }}
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
                        {{ form_widget(form.phone) }}
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
                        {{ form_widget(form.password) }}
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
                        <a href=\"{% if form.vars.data.id %}{{ path('user_index') }}{% else %}{{ path('login') }}{% endif %}\" class=\"btn btn-secondary\">Cancel</a>
                    </div>
                {{ form_end(form) }}
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "user/form.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\user\\form.html.twig");
    }
}
