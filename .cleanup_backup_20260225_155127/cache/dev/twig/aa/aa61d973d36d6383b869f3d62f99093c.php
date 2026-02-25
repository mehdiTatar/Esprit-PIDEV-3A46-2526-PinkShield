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

/* admin/manage_blog.html.twig */
class __TwigTemplate_946acf367d624e38dbe5c4469597ad5a extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/manage_blog.html.twig"));

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

        yield "Manage Blog Posts - PinkShield";
        
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
    <div class=\"row mb-4\">
        <div class=\"col-12\">
            <h1 class=\"mb-4\">
                <i class=\"fas fa-book\"></i> Manage Blog Posts
            </h1>
        </div>
    </div>

    ";
        // line 15
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "flashes", ["success"], "method", false, false, false, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "flashes", ["success"], "method", false, false, false, 16));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 17
                yield "            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                <i class=\"fas fa-check-circle me-2\"></i>";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            yield "    ";
        }
        // line 23
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
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 35, $this->source); })()), "html", null, true);
        yield "\"
                        >
                        <input type=\"hidden\" name=\"sortBy\" value=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 37, $this->source); })()), "html", null, true);
        yield "\">
                        <button type=\"submit\" class=\"btn btn-primary\">
                            <i class=\"fas fa-search\"></i> Search
                        </button>
                        ";
        // line 41
        if ((($tmp = (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 41, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 42
            yield "                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_manage_blog", ["sortBy" => (isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 42, $this->source); })())]), "html", null, true);
            yield "\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-times\"></i> Clear
                            </a>
                        ";
        }
        // line 46
        yield "                    </form>
                </div>
                <div class=\"col-md-6\">
                    <form method=\"GET\" class=\"d-flex gap-2\">
                        <select name=\"sortBy\" class=\"form-select\" onchange=\"this.form.submit()\">
                            <option value=\"date_newest\" ";
        // line 51
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 51, $this->source); })()) == "date_newest")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-clock\"></i> Newest First
                            </option>
                            <option value=\"date_oldest\" ";
        // line 54
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 54, $this->source); })()) == "date_oldest")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-clock\"></i> Oldest First
                            </option>
                            <option value=\"title_asc\" ";
        // line 57
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 57, $this->source); })()) == "title_asc")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-sort-alpha-down\"></i> Title A-Z
                            </option>
                            <option value=\"title_desc\" ";
        // line 60
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 60, $this->source); })()) == "title_desc")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-sort-alpha-up\"></i> Title Z-A
                            </option>
                            <option value=\"author\" ";
        // line 63
        if (((isset($context["sortBy"]) || array_key_exists("sortBy", $context) ? $context["sortBy"] : (function () { throw new RuntimeError('Variable "sortBy" does not exist.', 63, $this->source); })()) == "author")) {
            yield "selected";
        }
        yield ">
                                <i class=\"fas fa-user\"></i> Author
                            </option>
                        </select>
                        <input type=\"hidden\" name=\"search\" value=\"";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 67, $this->source); })()), "html", null, true);
        yield "\">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class=\"mb-3\">
        <span class=\"badge bg-info\">";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 76, $this->source); })())), "html", null, true);
        yield " Post(s) Found</span>
        ";
        // line 77
        if ((($tmp = (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 77, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 78
            yield "            <span class=\"text-muted\">Searching for: \"<strong>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 78, $this->source); })()), "html", null, true);
            yield "</strong>\"</span>
        ";
        }
        // line 80
        yield "    </div>

    <!-- Blog Posts Table -->
    <div class=\"table-responsive\">
        <table class=\"table table-striped table-hover\">
            <thead class=\"table-dark\">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 97
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 97, $this->source); })())) > 0)) {
            // line 98
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["posts"]) || array_key_exists("posts", $context) ? $context["posts"] : (function () { throw new RuntimeError('Variable "posts" does not exist.', 98, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 99
                yield "                        <tr>
                            <td>#";
                // line 100
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 100), "html", null, true);
                yield "</td>
                            <td>
                                <strong>";
                // line 102
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "title", [], "any", false, false, false, 102), "html", null, true);
                yield "</strong>
                                ";
                // line 103
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["post"], "imagePath", [], "any", false, false, false, 103)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 104
                    yield "                                    <i class=\"fas fa-image text-danger ms-2\" title=\"Has image\"></i>
                                ";
                }
                // line 106
                yield "                            </td>
                            <td>";
                // line 107
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "authorName", [], "any", false, false, false, 107), "html", null, true);
                yield "</td>
                            <td>
                                <span class=\"badge bg-secondary\">";
                // line 109
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "authorRole", [], "any", false, false, false, 109), "html", null, true);
                yield "</span>
                            </td>
                            <td>
                                <small>";
                // line 112
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "createdAt", [], "any", false, false, false, 112), "d/m/Y H:i"), "html", null, true);
                yield "</small>
                            </td>
                            <td>
                                <span class=\"badge bg-info\">";
                // line 115
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["post"], "comments", [], "any", false, false, false, 115)), "html", null, true);
                yield "</span>
                            </td>
                            <td>
                                <a 
                                    href=\"";
                // line 119
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 119)]), "html", null, true);
                yield "\" 
                                    class=\"btn btn-sm btn-info\"
                                    title=\"View Post\"
                                >
                                    <i class=\"fas fa-eye\"></i>
                                </a>
                                <form 
                                    method=\"POST\" 
                                    style=\"display: inline;\"
                                    onsubmit=\"return confirm('Are you sure you want to delete this post and all its comments?');\"
                                >
                                    <input type=\"hidden\" name=\"deleteId\" value=\"";
                // line 130
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["post"], "id", [], "any", false, false, false, 130), "html", null, true);
                yield "\">
                                    <button type=\"submit\" class=\"btn btn-sm btn-danger\" title=\"Delete Post\">
                                        <i class=\"fas fa-trash\"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['post'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 138
            yield "                ";
        } else {
            // line 139
            yield "                    <tr>
                        <td colspan=\"7\" class=\"text-center py-4\">
                            <i class=\"fas fa-inbox text-muted\" style=\"font-size: 2rem;\"></i>
                            <p class=\"text-muted mt-2\">
                                ";
            // line 143
            if ((($tmp = (isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 143, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 144
                yield "                                    No posts found matching \"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["search"]) || array_key_exists("search", $context) ? $context["search"] : (function () { throw new RuntimeError('Variable "search" does not exist.', 144, $this->source); })()), "html", null, true);
                yield "\"
                                ";
            } else {
                // line 146
                yield "                                    No blog posts yet
                                ";
            }
            // line 148
            yield "                            </p>
                        </td>
                    </tr>
                ";
        }
        // line 152
        yield "            </tbody>
        </table>
    </div>

    <!-- Back Button -->
    <div class=\"mt-4\">
        <a href=\"";
        // line 158
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"btn btn-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Back to Dashboard
        </a>
        <a href=\"";
        // line 161
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_new");
        yield "\" class=\"btn btn-primary\">
            <i class=\"fas fa-plus\"></i> Create New Post
        </a>
    </div>
</div>

<style>
    .table-responsive {
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .table {
        margin-bottom: 0;
    }

    .card {
        border: none;
    }

    .badge {
        padding: 0.5rem 0.75rem;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
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
        return "admin/manage_blog.html.twig";
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
        return array (  367 => 161,  361 => 158,  353 => 152,  347 => 148,  343 => 146,  337 => 144,  335 => 143,  329 => 139,  326 => 138,  312 => 130,  298 => 119,  291 => 115,  285 => 112,  279 => 109,  274 => 107,  271 => 106,  267 => 104,  265 => 103,  261 => 102,  256 => 100,  253 => 99,  248 => 98,  246 => 97,  227 => 80,  221 => 78,  219 => 77,  215 => 76,  203 => 67,  194 => 63,  186 => 60,  178 => 57,  170 => 54,  162 => 51,  155 => 46,  147 => 42,  145 => 41,  138 => 37,  133 => 35,  119 => 23,  116 => 22,  106 => 18,  103 => 17,  98 => 16,  96 => 15,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Manage Blog Posts - PinkShield{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"row mb-4\">
        <div class=\"col-12\">
            <h1 class=\"mb-4\">
                <i class=\"fas fa-book\"></i> Manage Blog Posts
            </h1>
        </div>
    </div>

    {% if app.flashes('success') %}
        {% for message in app.flashes('success') %}
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                <i class=\"fas fa-check-circle me-2\"></i>{{ message }}
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
            </div>
        {% endfor %}
    {% endif %}

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
                        <button type=\"submit\" class=\"btn btn-primary\">
                            <i class=\"fas fa-search\"></i> Search
                        </button>
                        {% if search %}
                            <a href=\"{{ path('admin_manage_blog', {'sortBy': sortBy}) }}\" class=\"btn btn-secondary\">
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

    <!-- Blog Posts Table -->
    <div class=\"table-responsive\">
        <table class=\"table table-striped table-hover\">
            <thead class=\"table-dark\">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {% if posts|length > 0 %}
                    {% for post in posts %}
                        <tr>
                            <td>#{{ post.id }}</td>
                            <td>
                                <strong>{{ post.title }}</strong>
                                {% if post.imagePath %}
                                    <i class=\"fas fa-image text-danger ms-2\" title=\"Has image\"></i>
                                {% endif %}
                            </td>
                            <td>{{ post.authorName }}</td>
                            <td>
                                <span class=\"badge bg-secondary\">{{ post.authorRole }}</span>
                            </td>
                            <td>
                                <small>{{ post.createdAt|date('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <span class=\"badge bg-info\">{{ post.comments|length }}</span>
                            </td>
                            <td>
                                <a 
                                    href=\"{{ path('blog_show', {'id': post.id}) }}\" 
                                    class=\"btn btn-sm btn-info\"
                                    title=\"View Post\"
                                >
                                    <i class=\"fas fa-eye\"></i>
                                </a>
                                <form 
                                    method=\"POST\" 
                                    style=\"display: inline;\"
                                    onsubmit=\"return confirm('Are you sure you want to delete this post and all its comments?');\"
                                >
                                    <input type=\"hidden\" name=\"deleteId\" value=\"{{ post.id }}\">
                                    <button type=\"submit\" class=\"btn btn-sm btn-danger\" title=\"Delete Post\">
                                        <i class=\"fas fa-trash\"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    {% endfor %}
                {% else %}
                    <tr>
                        <td colspan=\"7\" class=\"text-center py-4\">
                            <i class=\"fas fa-inbox text-muted\" style=\"font-size: 2rem;\"></i>
                            <p class=\"text-muted mt-2\">
                                {% if search %}
                                    No posts found matching \"{{ search }}\"
                                {% else %}
                                    No blog posts yet
                                {% endif %}
                            </p>
                        </td>
                    </tr>
                {% endif %}
            </tbody>
        </table>
    </div>

    <!-- Back Button -->
    <div class=\"mt-4\">
        <a href=\"{{ path('admin_dashboard') }}\" class=\"btn btn-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Back to Dashboard
        </a>
        <a href=\"{{ path('blog_new') }}\" class=\"btn btn-primary\">
            <i class=\"fas fa-plus\"></i> Create New Post
        </a>
    </div>
</div>

<style>
    .table-responsive {
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .table {
        margin-bottom: 0;
    }

    .card {
        border: none;
    }

    .badge {
        padding: 0.5rem 0.75rem;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
</style>
{% endblock %}
", "admin/manage_blog.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\admin\\manage_blog.html.twig");
    }
}
