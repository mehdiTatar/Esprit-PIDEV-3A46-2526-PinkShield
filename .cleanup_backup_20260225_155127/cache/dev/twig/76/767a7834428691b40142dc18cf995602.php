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

/* blog/form.html.twig */
class __TwigTemplate_68dd04fa0a3a7639f3747791fe2e4b8f extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/form.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["action"]) || array_key_exists("action", $context) ? $context["action"] : (function () { throw new RuntimeError('Variable "action" does not exist.', 3, $this->source); })()), "html", null, true);
        yield " Post";
        
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
        <div class=\"col-md-8\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-danger text-white\">
                    <h2 class=\"mb-0 h4\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["action"]) || array_key_exists("action", $context) ? $context["action"] : (function () { throw new RuntimeError('Variable "action" does not exist.', 11, $this->source); })()), "html", null, true);
        yield " Blog Post</h2>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\" enctype=\"multipart/form-data\">
                        <div class=\"mb-3\">
                            <label for=\"title\" class=\"form-label\">Title</label>
                            <input type=\"text\" name=\"title\" id=\"title\" class=\"form-control\" value=\"";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 17, $this->source); })()), "title", [], "any", false, false, false, 17), "html", null, true);
        yield "\">
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"content\" class=\"form-label\">Content</label>
                            <textarea name=\"content\" id=\"content\" class=\"form-control\" rows=\"10\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 21, $this->source); })()), "content", [], "any", false, false, false, 21), "html", null, true);
        yield "</textarea>
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"image\" class=\"form-label\">Featured Image</label>
                            <input type=\"file\" name=\"image\" id=\"image\" class=\"form-control\" accept=\"image/*\">
                            <small class=\"text-muted\">Supported formats: JPG, PNG, GIF, WebP (Max 5MB)</small>
                            ";
        // line 27
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 27, $this->source); })()), "imagePath", [], "any", false, false, false, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 28
            yield "                                <div class=\"mt-2\">
                                    <img src=\"";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 29, $this->source); })()), "imagePath", [], "any", false, false, false, 29), "html", null, true);
            yield "\" alt=\"Current image\" style=\"max-height: 150px; border-radius: 5px;\">
                                    <p class=\"text-muted mt-2\"><small>Current image</small></p>
                                </div>
                            ";
        }
        // line 33
        yield "                        </div>
                        <div class=\"d-grid gap-2 d-md-flex justify-content-md-end\">
                            <a href=\"";
        // line 35
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index");
        yield "\" class=\"btn btn-secondary me-md-2\">Cancel</a>
                            <button type=\"submit\" class=\"btn btn-danger\">";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["action"]) || array_key_exists("action", $context) ? $context["action"] : (function () { throw new RuntimeError('Variable "action" does not exist.', 36, $this->source); })()), "html", null, true);
        yield " Post</button>
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
        return "blog/form.html.twig";
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
        return array (  138 => 36,  134 => 35,  130 => 33,  123 => 29,  120 => 28,  118 => 27,  109 => 21,  102 => 17,  93 => 11,  86 => 6,  76 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ action }} Post{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"row justify-content-center\">
        <div class=\"col-md-8\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-danger text-white\">
                    <h2 class=\"mb-0 h4\">{{ action }} Blog Post</h2>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\" enctype=\"multipart/form-data\">
                        <div class=\"mb-3\">
                            <label for=\"title\" class=\"form-label\">Title</label>
                            <input type=\"text\" name=\"title\" id=\"title\" class=\"form-control\" value=\"{{ post.title }}\">
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"content\" class=\"form-label\">Content</label>
                            <textarea name=\"content\" id=\"content\" class=\"form-control\" rows=\"10\">{{ post.content }}</textarea>
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"image\" class=\"form-label\">Featured Image</label>
                            <input type=\"file\" name=\"image\" id=\"image\" class=\"form-control\" accept=\"image/*\">
                            <small class=\"text-muted\">Supported formats: JPG, PNG, GIF, WebP (Max 5MB)</small>
                            {% if post.imagePath %}
                                <div class=\"mt-2\">
                                    <img src=\"{{ post.imagePath }}\" alt=\"Current image\" style=\"max-height: 150px; border-radius: 5px;\">
                                    <p class=\"text-muted mt-2\"><small>Current image</small></p>
                                </div>
                            {% endif %}
                        </div>
                        <div class=\"d-grid gap-2 d-md-flex justify-content-md-end\">
                            <a href=\"{{ path('blog_index') }}\" class=\"btn btn-secondary me-md-2\">Cancel</a>
                            <button type=\"submit\" class=\"btn btn-danger\">{{ action }} Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "blog/form.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\blog\\form.html.twig");
    }
}
