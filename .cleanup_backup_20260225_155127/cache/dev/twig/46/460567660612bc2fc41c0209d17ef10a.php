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

/* blog/comment_edit.html.twig */
class __TwigTemplate_723f6a11c4d3b841c12ad4394887f0e3 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/comment_edit.html.twig"));

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

        yield "Edit Comment";
        
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
    <nav aria-label=\"breadcrumb\">
        <ol class=\"breadcrumb\">
            <li class=\"breadcrumb-item\"><a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index");
        yield "\">Blog</a></li>
            <li class=\"breadcrumb-item\"><a href=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 10, $this->source); })()), "blogPost", [], "any", false, false, false, 10), "id", [], "any", false, false, false, 10)]), "html", null, true);
        yield "\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 10, $this->source); })()), "blogPost", [], "any", false, false, false, 10), "title", [], "any", false, false, false, 10), "html", null, true);
        yield "</a></li>
            <li class=\"breadcrumb-item active\" aria-current=\"page\">Edit Comment</li>
        </ol>
    </nav>

    <div class=\"row justify-content-center\">
        <div class=\"col-md-8\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-danger text-white\">
                    <h3 class=\"mb-0\">Edit Comment</h3>
                </div>
                <div class=\"card-body\">
                    <div class=\"mb-4\">
                        <h6 class=\"text-muted\">Author: <strong>";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 23, $this->source); })()), "authorName", [], "any", false, false, false, 23), "html", null, true);
        yield "</strong></h6>
                        <small class=\"text-muted\">Posted: ";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 24, $this->source); })()), "createdAt", [], "any", false, false, false, 24), "M d, Y H:i"), "html", null, true);
        yield "</small>
                    </div>

                    <form method=\"POST\">
                        <div class=\"mb-3\">
                            <label for=\"content\" class=\"form-label\">Comment Content</label>
                            <textarea 
                                id=\"content\"
                                name=\"content\" 
                                class=\"form-control\" 
                                rows=\"5\" 
                                placeholder=\"Edit your comment...\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 35, $this->source); })()), "content", [], "any", false, false, false, 35), "html", null, true);
        yield "</textarea>
                        </div>

                        <div class=\"d-flex gap-2\">
                            <button type=\"submit\" class=\"btn btn-danger\">Update Comment</button>
                            <a href=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["comment"]) || array_key_exists("comment", $context) ? $context["comment"] : (function () { throw new RuntimeError('Variable "comment" does not exist.', 40, $this->source); })()), "blogPost", [], "any", false, false, false, 40), "id", [], "any", false, false, false, 40)]), "html", null, true);
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
        return "blog/comment_edit.html.twig";
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
        return array (  138 => 40,  130 => 35,  116 => 24,  112 => 23,  94 => 10,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Comment{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <nav aria-label=\"breadcrumb\">
        <ol class=\"breadcrumb\">
            <li class=\"breadcrumb-item\"><a href=\"{{ path('blog_index') }}\">Blog</a></li>
            <li class=\"breadcrumb-item\"><a href=\"{{ path('blog_show', {id: comment.blogPost.id}) }}\">{{ comment.blogPost.title }}</a></li>
            <li class=\"breadcrumb-item active\" aria-current=\"page\">Edit Comment</li>
        </ol>
    </nav>

    <div class=\"row justify-content-center\">
        <div class=\"col-md-8\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-danger text-white\">
                    <h3 class=\"mb-0\">Edit Comment</h3>
                </div>
                <div class=\"card-body\">
                    <div class=\"mb-4\">
                        <h6 class=\"text-muted\">Author: <strong>{{ comment.authorName }}</strong></h6>
                        <small class=\"text-muted\">Posted: {{ comment.createdAt|date('M d, Y H:i') }}</small>
                    </div>

                    <form method=\"POST\">
                        <div class=\"mb-3\">
                            <label for=\"content\" class=\"form-label\">Comment Content</label>
                            <textarea 
                                id=\"content\"
                                name=\"content\" 
                                class=\"form-control\" 
                                rows=\"5\" 
                                placeholder=\"Edit your comment...\">{{ comment.content }}</textarea>
                        </div>

                        <div class=\"d-flex gap-2\">
                            <button type=\"submit\" class=\"btn btn-danger\">Update Comment</button>
                            <a href=\"{{ path('blog_show', {id: comment.blogPost.id}) }}\" class=\"btn btn-secondary\">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "blog/comment_edit.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\blog\\comment_edit.html.twig");
    }
}
