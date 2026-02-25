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

/* blog/show.html.twig */
class __TwigTemplate_b5149ac0051eacf6331afb7cee9f9a5b extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/show.html.twig"));

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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 3, $this->source); })()), "title", [], "any", false, false, false, 3), "html", null, true);
        
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
            <li class=\"breadcrumb-item active\" aria-current=\"page\">";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 10, $this->source); })()), "title", [], "any", false, false, false, 10), "html", null, true);
        yield "</li>
        </ol>
    </nav>

    <div class=\"card shadow-sm mb-5\">
        ";
        // line 15
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 15, $this->source); })()), "imagePath", [], "any", false, false, false, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "            <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 16, $this->source); })()), "imagePath", [], "any", false, false, false, 16), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 16, $this->source); })()), "title", [], "any", false, false, false, 16), "html", null, true);
            yield "\" class=\"card-img-top\" style=\"max-height: 400px; object-fit: cover;\">
        ";
        }
        // line 18
        yield "        <div class=\"card-body\">
            <div class=\"d-flex justify-content-between align-items-start mb-3\">
                <h1 class=\"h2 text-danger fw-bold\">";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 20, $this->source); })()), "title", [], "any", false, false, false, 20), "html", null, true);
        yield "</h1>
                ";
        // line 21
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 21, $this->source); })()), "user", [], "any", false, false, false, 21) && ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 21, $this->source); })()), "user", [], "any", false, false, false, 21), "userIdentifier", [], "any", false, false, false, 21) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 21, $this->source); })()), "authorEmail", [], "any", false, false, false, 21)) || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")))) {
            // line 22
            yield "                    <div>
                        <a href=\"";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 23, $this->source); })()), "id", [], "any", false, false, false, 23)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-secondary\">Edit</a>
                        <a href=\"";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 24, $this->source); })()), "id", [], "any", false, false, false, 24)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </div>
                ";
        }
        // line 27
        yield "            </div>
            
            <div class=\"text-muted mb-4\">
                <i class=\"fas fa-user\"></i> ";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 30, $this->source); })()), "authorName", [], "any", false, false, false, 30), "html", null, true);
        yield " 
                <span class=\"mx-2\">|</span>
                <i class=\"fas fa-calendar\"></i> ";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 32, $this->source); })()), "createdAt", [], "any", false, false, false, 32), "M d, Y H:i"), "html", null, true);
        yield "
                <span class=\"mx-2\">|</span>
                <span class=\"badge bg-info text-dark\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 34, $this->source); })()), "authorRole", [], "any", false, false, false, 34), "html", null, true);
        yield "</span>
            </div>

            <div class=\"post-content mb-5\" style=\"white-space: pre-wrap; line-height: 1.6;\">
                ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 38, $this->source); })()), "content", [], "any", false, false, false, 38), "html", null, true);
        yield "
            </div>

            <hr>

            <h3 class=\"h4 text-danger mb-4\">Comments (";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 43, $this->source); })()), "comments", [], "any", false, false, false, 43)), "html", null, true);
        yield ")</h3>
            
            <div class=\"comments-list mt-4\">
                ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["post"]) || array_key_exists("post", $context) ? $context["post"] : (function () { throw new RuntimeError('Variable "post" does not exist.', 46, $this->source); })()), "comments", [], "any", false, false, false, 46));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 47
            yield "                    <div class=\"card mb-3 bg-light\">
                        <div class=\"card-body\">
                            <div class=\"d-flex justify-content-between align-items-start\">
                                <div>
                                    <strong>";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "authorName", [], "any", false, false, false, 51), "html", null, true);
            yield "</strong>
                                    <small class=\"text-muted d-block\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 52), "M d, Y H:i"), "html", null, true);
            yield "</small>
                                </div>
                                ";
            // line 54
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 55
                yield "                                    <div>
                                        <a href=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 56)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-warning\">Edit</a>
                                        <a href=\"";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 57)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Delete this comment?')\">Delete</a>
                                    </div>
                                ";
            }
            // line 60
            yield "                            </div>
                            <p class=\"mb-0 mt-2\">";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "content", [], "any", false, false, false, 61), "html", null, true);
            yield "</p>
                        </div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        // line 64
        if (!$context['_iterated']) {
            // line 65
            yield "                    <p class=\"text-muted\">No comments yet. Share your thoughts!</p>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        yield "            </div>

            ";
        // line 69
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 69, $this->source); })()), "user", [], "any", false, false, false, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 70
            yield "                <div class=\"add-comment mt-5\">
                    <h4 class=\"text-danger\">Add a Comment</h4>
                    <form method=\"post\">
                        <div class=\"mb-3\">
                            <textarea name=\"comment\" class=\"form-control\" rows=\"3\" placeholder=\"Write your comment here...\"></textarea>
                        </div>
                        <button type=\"submit\" class=\"btn btn-danger\">Submit Comment</button>
                    </form>
                </div>
            ";
        } else {
            // line 80
            yield "                <div class=\"alert alert-info mt-5\">
                    Please <a href=\"";
            // line 81
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login");
            yield "\">login</a> to add a comment.
                </div>
            ";
        }
        // line 84
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
        return "blog/show.html.twig";
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
        return array (  253 => 84,  247 => 81,  244 => 80,  232 => 70,  230 => 69,  226 => 67,  219 => 65,  217 => 64,  209 => 61,  206 => 60,  200 => 57,  196 => 56,  193 => 55,  191 => 54,  186 => 52,  182 => 51,  176 => 47,  171 => 46,  165 => 43,  157 => 38,  150 => 34,  145 => 32,  140 => 30,  135 => 27,  129 => 24,  125 => 23,  122 => 22,  120 => 21,  116 => 20,  112 => 18,  104 => 16,  102 => 15,  94 => 10,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ post.title }}{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <nav aria-label=\"breadcrumb\">
        <ol class=\"breadcrumb\">
            <li class=\"breadcrumb-item\"><a href=\"{{ path('blog_index') }}\">Blog</a></li>
            <li class=\"breadcrumb-item active\" aria-current=\"page\">{{ post.title }}</li>
        </ol>
    </nav>

    <div class=\"card shadow-sm mb-5\">
        {% if post.imagePath %}
            <img src=\"{{ post.imagePath }}\" alt=\"{{ post.title }}\" class=\"card-img-top\" style=\"max-height: 400px; object-fit: cover;\">
        {% endif %}
        <div class=\"card-body\">
            <div class=\"d-flex justify-content-between align-items-start mb-3\">
                <h1 class=\"h2 text-danger fw-bold\">{{ post.title }}</h1>
                {% if app.user and (app.user.userIdentifier == post.authorEmail or is_granted('ROLE_ADMIN')) %}
                    <div>
                        <a href=\"{{ path('blog_edit', {'id': post.id}) }}\" class=\"btn btn-sm btn-outline-secondary\">Edit</a>
                        <a href=\"{{ path('blog_delete', {'id': post.id}) }}\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </div>
                {% endif %}
            </div>
            
            <div class=\"text-muted mb-4\">
                <i class=\"fas fa-user\"></i> {{ post.authorName }} 
                <span class=\"mx-2\">|</span>
                <i class=\"fas fa-calendar\"></i> {{ post.createdAt|date('M d, Y H:i') }}
                <span class=\"mx-2\">|</span>
                <span class=\"badge bg-info text-dark\">{{ post.authorRole }}</span>
            </div>

            <div class=\"post-content mb-5\" style=\"white-space: pre-wrap; line-height: 1.6;\">
                {{ post.content }}
            </div>

            <hr>

            <h3 class=\"h4 text-danger mb-4\">Comments ({{ post.comments|length }})</h3>
            
            <div class=\"comments-list mt-4\">
                {% for comment in post.comments %}
                    <div class=\"card mb-3 bg-light\">
                        <div class=\"card-body\">
                            <div class=\"d-flex justify-content-between align-items-start\">
                                <div>
                                    <strong>{{ comment.authorName }}</strong>
                                    <small class=\"text-muted d-block\">{{ comment.createdAt|date('M d, Y H:i') }}</small>
                                </div>
                                {% if is_granted('ROLE_ADMIN') %}
                                    <div>
                                        <a href=\"{{ path('comment_edit', {id: comment.id}) }}\" class=\"btn btn-sm btn-outline-warning\">Edit</a>
                                        <a href=\"{{ path('comment_delete', {id: comment.id}) }}\" class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Delete this comment?')\">Delete</a>
                                    </div>
                                {% endif %}
                            </div>
                            <p class=\"mb-0 mt-2\">{{ comment.content }}</p>
                        </div>
                    </div>
                {% else %}
                    <p class=\"text-muted\">No comments yet. Share your thoughts!</p>
                {% endfor %}
            </div>

            {% if app.user %}
                <div class=\"add-comment mt-5\">
                    <h4 class=\"text-danger\">Add a Comment</h4>
                    <form method=\"post\">
                        <div class=\"mb-3\">
                            <textarea name=\"comment\" class=\"form-control\" rows=\"3\" placeholder=\"Write your comment here...\"></textarea>
                        </div>
                        <button type=\"submit\" class=\"btn btn-danger\">Submit Comment</button>
                    </form>
                </div>
            {% else %}
                <div class=\"alert alert-info mt-5\">
                    Please <a href=\"{{ path('login') }}\">login</a> to add a comment.
                </div>
            {% endif %}
        </div>
    </div>
</div>
{% endblock %}
", "blog/show.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\blog\\show.html.twig");
    }
}
