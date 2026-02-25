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

/* blog/index.html.twig */
class __TwigTemplate_080270a408495aea70945fd162722804 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/index.html.twig"));

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

        yield "Medical Blog & Forum";
        
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
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1 class=\"h2 text-danger fw-bold\">Medical Blog & Forum</h1>
        ";
        // line 9
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "user", [], "any", false, false, false, 9)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 10
            yield "            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_new");
            yield "\" class=\"btn btn-danger\">
                <i class=\"fas fa-plus\"></i> New Post
            </a>
        ";
        }
        // line 14
        yield "    </div>

    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "flashes", ["success"], "method", false, false, false, 16));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 17
            yield "        <div class=\"alert alert-success\">
            ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        yield "
    <!-- Search and Sort Section -->
    <div class=\"card mb-4 shadow-sm\">
        <div class=\"card-body\">
            <div class=\"row g-3\">
                <div class=\"col-md-6\">
                    <form method=\"GET\" class=\"d-flex gap-2\" id=\"searchForm\">
                        <input 
                            type=\"text\" 
                            name=\"search\" 
                            class=\"form-control\" 
                            placeholder=\"Search by title, content, or author...\" 
                            value=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 33, $this->source); })()), "html", null, true);
        yield "\"
                        >
                        <input type=\"hidden\" name=\"sortBy\" value=\"";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 35, $this->source); })()), "html", null, true);
        yield "\">
                        <button type=\"submit\" class=\"btn btn-danger\">
                            <i class=\"fas fa-search\"></i> Search
                        </button>
                        ";
        // line 39
        if ((($tmp = (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 39, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 40
            yield "                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index", ["sortBy" => (isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 40, $this->source); })())]), "html", null, true);
            yield "\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-times\"></i> Clear
                            </a>
                        ";
        }
        // line 44
        yield "                    </form>
                </div>
                <div class=\"col-md-6\">
                    <form method=\"GET\" class=\"d-flex gap-2\">
                        <select name=\"sortBy\" class=\"form-select\" onchange=\"this.form.submit()\">
                            <option value=\"date_newest\" ";
        // line 49
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 49, $this->source); })()) == "date_newest")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-clock\"></i> Newest First
                            </option>
                            <option value=\"date_oldest\" ";
        // line 52
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 52, $this->source); })()) == "date_oldest")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-clock\"></i> Oldest First
                            </option>
                            <option value=\"title_asc\" ";
        // line 55
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 55, $this->source); })()) == "title_asc")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-sort-alpha-down\"></i> Title A-Z
                            </option>
                            <option value=\"title_desc\" ";
        // line 58
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 58, $this->source); })()) == "title_desc")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-sort-alpha-up\"></i> Title Z-A
                            </option>
                            <option value=\"author\" ";
        // line 61
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 61, $this->source); })()) == "author")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-user\"></i> Author
                            </option>
                        </select>
                        <input type=\"hidden\" name=\"search\" value=\"";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 65, $this->source); })()), "html", null, true);
        yield "\">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class=\"mb-3\">
        <span class=\"badge bg-info\">";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 74, $this->source); })())), "html", null, true);
        yield " Post(s) Found</span>
        ";
        // line 75
        if ((($tmp = (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 75, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 76
            yield "            <span class=\"text-muted\">Searching for: \"<strong>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 76, $this->source); })()), "html", null, true);
            yield "</strong>\"</span>
        ";
        }
        // line 78
        yield "    </div>

    <div class=\"row\">
        ";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 81, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 82
            yield "            <div class=\"col-md-6 mb-4\">
                <div class=\"card h-100 shadow-sm overflow-hidden\">
                    ";
            // line 84
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "imagePath", [], "any", false, false, false, 84)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 85
                yield "                        <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "imagePath", [], "any", false, false, false, 85), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 85), "html", null, true);
                yield "\" class=\"card-img-top\" style=\"height: 200px; object-fit: cover;\">
                    ";
            } else {
                // line 87
                yield "                        <div class=\"card-img-top bg-light d-flex align-items-center justify-content-center\" style=\"height: 200px;\">
                            <i class=\"fas fa-image text-secondary\" style=\"font-size: 3rem;\"></i>
                        </div>
                    ";
            }
            // line 91
            yield "                    <div class=\"card-body\">
                        <h5 class=\"card-title\">";
            // line 92
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 92), "html", null, true);
            yield "</h5>
                        <h6 class=\"card-subtitle mb-2 text-muted\">
                            By ";
            // line 94
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "authorName", [], "any", false, false, false, 94), "html", null, true);
            yield " (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "authorRole", [], "any", false, false, false, 94), "html", null, true);
            yield ") 
                            on ";
            // line 95
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 95), "M d, Y"), "html", null, true);
            yield "
                        </h6>
                        <p class=\"card-text\">";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "content", [], "any", false, false, false, 97), 0, 150), "html", null, true);
            yield "...</p>
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <a href=\"";
            // line 99
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 99)]), "html", null, true);
            yield "\" class=\"btn btn-outline-danger btn-sm\">Read More</a>
                            <span class=\"badge bg-secondary\">";
            // line 100
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "comments", [], "any", false, false, false, 100)), "html", null, true);
            yield " Comments</span>
                        </div>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 105
        if (!$context['_iterated']) {
            // line 106
            yield "            <div class=\"col-12\">
                <div class=\"alert alert-info text-center\">
                    ";
            // line 108
            if ((($tmp = (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 108, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 109
                yield "                        No posts found matching \"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 109, $this->source); })()), "html", null, true);
                yield "\"
                    ";
            } else {
                // line 111
                yield "                        No posts yet. Be the first to share something!
                    ";
            }
            // line 113
            yield "                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['post'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 116
        yield "    </div>
</div>

<style>
    .card {
        border-color: #e0e0e0;
    }
    
    .badge {
        padding: 0.5rem 0.75rem;
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
        return "blog/index.html.twig";
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
        return array (  322 => 116,  314 => 113,  310 => 111,  304 => 109,  302 => 108,  298 => 106,  296 => 105,  286 => 100,  282 => 99,  277 => 97,  272 => 95,  266 => 94,  261 => 92,  258 => 91,  252 => 87,  244 => 85,  242 => 84,  238 => 82,  233 => 81,  228 => 78,  222 => 76,  220 => 75,  216 => 74,  204 => 65,  195 => 61,  187 => 58,  179 => 55,  171 => 52,  163 => 49,  156 => 44,  148 => 40,  146 => 39,  139 => 35,  134 => 33,  120 => 21,  111 => 18,  108 => 17,  104 => 16,  100 => 14,  92 => 10,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Medical Blog & Forum{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"d-flex justify-content-between align-items-center mb-4\">
        <h1 class=\"h2 text-danger fw-bold\">Medical Blog & Forum</h1>
        {% if app.user %}
            <a href=\"{{ path('blog_new') }}\" class=\"btn btn-danger\">
                <i class=\"fas fa-plus\"></i> New Post
            </a>
        {% endif %}
    </div>

    {% for message in app.flashes('success') %}
        <div class=\"alert alert-success\">
            {{ message }}
        </div>
    {% endfor %}

    <!-- Search and Sort Section -->
    <div class=\"card mb-4 shadow-sm\">
        <div class=\"card-body\">
            <div class=\"row g-3\">
                <div class=\"col-md-6\">
                    <form method=\"GET\" class=\"d-flex gap-2\" id=\"searchForm\">
                        <input 
                            type=\"text\" 
                            name=\"search\" 
                            class=\"form-control\" 
                            placeholder=\"Search by title, content, or author...\" 
                            value=\"{{ search }}\"
                        >
                        <input type=\"hidden\" name=\"sortBy\" value=\"{{ sortBy }}\">
                        <button type=\"submit\" class=\"btn btn-danger\">
                            <i class=\"fas fa-search\"></i> Search
                        </button>
                        {% if search %}
                            <a href=\"{{ path('blog_index', {'sortBy': sortBy}) }}\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-times\"></i> Clear
                            </a>
                        {% endif %}
                    </form>
                </div>
                <div class=\"col-md-6\">
                    <form method=\"GET\" class=\"d-flex gap-2\">
                        <select name=\"sortBy\" class=\"form-select\" onchange=\"this.form.submit()\">
                            <option value=\"date_newest\" {% if sortBy == 'date_newest' %}selected{% endif %}>
                                <i class=\"fas fa-clock\"></i> Newest First
                            </option>
                            <option value=\"date_oldest\" {% if sortBy == 'date_oldest' %}selected{% endif %}>
                                <i class=\"fas fa-clock\"></i> Oldest First
                            </option>
                            <option value=\"title_asc\" {% if sortBy == 'title_asc' %}selected{% endif %}>
                                <i class=\"fas fa-sort-alpha-down\"></i> Title A-Z
                            </option>
                            <option value=\"title_desc\" {% if sortBy == 'title_desc' %}selected{% endif %}>
                                <i class=\"fas fa-sort-alpha-up\"></i> Title Z-A
                            </option>
                            <option value=\"author\" {% if sortBy == 'author' %}selected{% endif %}>
                                <i class=\"fas fa-user\"></i> Author
                            </option>
                        </select>
                        <input type=\"hidden\" name=\"search\" value=\"{{ search }}\">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class=\"mb-3\">
        <span class=\"badge bg-info\">{{ posts|length }} Post(s) Found</span>
        {% if search %}
            <span class=\"text-muted\">Searching for: \"<strong>{{ search }}</strong>\"</span>
        {% endif %}
    </div>

    <div class=\"row\">
        {% for post in posts %}
            <div class=\"col-md-6 mb-4\">
                <div class=\"card h-100 shadow-sm overflow-hidden\">
                    {% if post.imagePath %}
                        <img src=\"{{ post.imagePath }}\" alt=\"{{ post.title }}\" class=\"card-img-top\" style=\"height: 200px; object-fit: cover;\">
                    {% else %}
                        <div class=\"card-img-top bg-light d-flex align-items-center justify-content-center\" style=\"height: 200px;\">
                            <i class=\"fas fa-image text-secondary\" style=\"font-size: 3rem;\"></i>
                        </div>
                    {% endif %}
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">{{ post.title }}</h5>
                        <h6 class=\"card-subtitle mb-2 text-muted\">
                            By {{ post.authorName }} ({{ post.authorRole }}) 
                            on {{ post.createdAt|date('M d, Y') }}
                        </h6>
                        <p class=\"card-text\">{{ post.content|slice(0, 150) }}...</p>
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <a href=\"{{ path('blog_show', {'id': post.id}) }}\" class=\"btn btn-outline-danger btn-sm\">Read More</a>
                            <span class=\"badge bg-secondary\">{{ post.comments|length }} Comments</span>
                        </div>
                    </div>
                </div>
            </div>
        {% else %}
            <div class=\"col-12\">
                <div class=\"alert alert-info text-center\">
                    {% if search %}
                        No posts found matching \"{{ search }}\"
                    {% else %}
                        No posts yet. Be the first to share something!
                    {% endif %}
                </div>
            </div>
        {% endfor %}
    </div>
</div>

<style>
    .card {
        border-color: #e0e0e0;
    }
    
    .badge {
        padding: 0.5rem 0.75rem;
    }
</style>
{% endblock %}
", "blog/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\blog\\index.html.twig");
    }
}
