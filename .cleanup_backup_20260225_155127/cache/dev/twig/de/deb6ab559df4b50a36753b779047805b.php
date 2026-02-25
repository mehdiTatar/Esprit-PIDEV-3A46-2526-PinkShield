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

/* user/index.html.twig */
class __TwigTemplate_dff4dd4358a723cde4ea7ff288f1d76a extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "user/index.html.twig"));

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

        yield "Users - PinkShield";
        
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
    <div class=\"col-12\">
        <h1 class=\"mb-4\">Users Management</h1>
        <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_new");
        yield "\" class=\"btn btn-primary mb-3\">Add New User</a>
    </div>
</div>

<!-- Advanced Search Form -->
<div class=\"card mb-4\">
    <div class=\"card-header bg-secondary\">
        <h5 class=\"mb-0\">Advanced Search</h5>
    </div>
    <div class=\"card-body\">
        <form method=\"get\" action=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
        yield "\" class=\"row g-3\">
            <div class=\"col-md-6\">
                <label for=\"search_id\" class=\"form-label\">Search by ID:</label>
                <input type=\"text\" class=\"form-control\" id=\"search_id\" name=\"search_id\" value=\"";
        // line 22
        yield (((array_key_exists("searchId", $context) &&  !(null === $context["searchId"]))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["searchId"], "html", null, true)) : (""));
        yield "\" placeholder=\"Enter user ID\">
            </div>
            <div class=\"col-md-6 d-flex align-items-end\">
                <button type=\"submit\" class=\"btn btn-info me-2\">Search</button>
                <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
        yield "\" class=\"btn btn-secondary\">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class=\"table-responsive\">
    <table class=\"table table-striped table-hover\">
        <thead class=\"table-dark\">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["users"]) || array_key_exists("users", $context) ? $context["users"] : (function () { throw new RuntimeError('Variable "users" does not exist.', 45, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 46
            yield "                <tr>
                    <td>";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 47), "html", null, true);
            yield "</td>
                    <td>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 48), "html", null, true);
            yield "</td>
                    <td>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "fullName", [], "any", false, false, false, 49), "html", null, true);
            yield "</td>
                    <td>";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "phone", [], "any", false, false, false, 50), "html", null, true);
            yield "</td>
                    <td>
                        <span class=\"badge bg-";
            // line 52
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "status", [], "any", false, false, false, 52) == "active")) ? ("success") : ("danger"));
            yield "\">
                            ";
            // line 53
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["user"], "status", [], "any", false, false, false, 53)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["user"], "status", [], "any", false, false, false, 53)), "html", null, true)) : ("Active"));
            yield "
                        </span>
                    </td>
                    <td>
                        <a href=\"";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 57)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-info\">View</a>
                        <a href=\"";
            // line 58
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 58)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-warning\">Edit</a>
                        ";
            // line 59
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["user"], "status", [], "any", false, false, false, 59) == "active")) {
                // line 60
                yield "                            <form action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_deactivate", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 60)]), "html", null, true);
                yield "\" method=\"POST\" style=\"display:inline;\">
                                <button type=\"submit\" class=\"btn btn-sm btn-warning\" onclick=\"return confirm('Deactivate this user?')\">Deactivate</button>
                            </form>
                        ";
            } else {
                // line 64
                yield "                            <form action=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_activate", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 64)]), "html", null, true);
                yield "\" method=\"POST\" style=\"display:inline;\">
                                <button type=\"submit\" class=\"btn btn-sm btn-success\">Activate</button>
                            </form>
                        ";
            }
            // line 68
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 68)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure you want to permanently delete this user?')\">Delete</a>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 71
        if (!$context['_iterated']) {
            // line 72
            yield "                <tr>
                    <td colspan=\"6\" class=\"text-center\">No users found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        yield "        </tbody>
    </table>
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
        return "user/index.html.twig";
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
        return array (  220 => 76,  211 => 72,  209 => 71,  200 => 68,  192 => 64,  184 => 60,  182 => 59,  178 => 58,  174 => 57,  167 => 53,  163 => 52,  158 => 50,  154 => 49,  150 => 48,  146 => 47,  143 => 46,  138 => 45,  116 => 26,  109 => 22,  103 => 19,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Users - PinkShield{% endblock %}

{% block body %}
<div class=\"row\">
    <div class=\"col-12\">
        <h1 class=\"mb-4\">Users Management</h1>
        <a href=\"{{ path('user_new') }}\" class=\"btn btn-primary mb-3\">Add New User</a>
    </div>
</div>

<!-- Advanced Search Form -->
<div class=\"card mb-4\">
    <div class=\"card-header bg-secondary\">
        <h5 class=\"mb-0\">Advanced Search</h5>
    </div>
    <div class=\"card-body\">
        <form method=\"get\" action=\"{{ path('user_index') }}\" class=\"row g-3\">
            <div class=\"col-md-6\">
                <label for=\"search_id\" class=\"form-label\">Search by ID:</label>
                <input type=\"text\" class=\"form-control\" id=\"search_id\" name=\"search_id\" value=\"{{ searchId ?? '' }}\" placeholder=\"Enter user ID\">
            </div>
            <div class=\"col-md-6 d-flex align-items-end\">
                <button type=\"submit\" class=\"btn btn-info me-2\">Search</button>
                <a href=\"{{ path('user_index') }}\" class=\"btn btn-secondary\">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class=\"table-responsive\">
    <table class=\"table table-striped table-hover\">
        <thead class=\"table-dark\">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {% for user in users %}
                <tr>
                    <td>{{ user.id }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.fullName }}</td>
                    <td>{{ user.phone }}</td>
                    <td>
                        <span class=\"badge bg-{{ user.status == 'active' ? 'success' : 'danger' }}\">
                            {{ user.status ? user.status|capitalize : 'Active' }}
                        </span>
                    </td>
                    <td>
                        <a href=\"{{ path('user_show', {id: user.id}) }}\" class=\"btn btn-sm btn-info\">View</a>
                        <a href=\"{{ path('user_edit', {id: user.id}) }}\" class=\"btn btn-sm btn-warning\">Edit</a>
                        {% if user.status == 'active' %}
                            <form action=\"{{ path('user_deactivate', {id: user.id}) }}\" method=\"POST\" style=\"display:inline;\">
                                <button type=\"submit\" class=\"btn btn-sm btn-warning\" onclick=\"return confirm('Deactivate this user?')\">Deactivate</button>
                            </form>
                        {% else %}
                            <form action=\"{{ path('user_activate', {id: user.id}) }}\" method=\"POST\" style=\"display:inline;\">
                                <button type=\"submit\" class=\"btn btn-sm btn-success\">Activate</button>
                            </form>
                        {% endif %}
                        <a href=\"{{ path('user_delete', {id: user.id}) }}\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure you want to permanently delete this user?')\">Delete</a>
                    </td>
                </tr>
            {% else %}
                <tr>
                    <td colspan=\"6\" class=\"text-center\">No users found</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
{% endblock %}
", "user/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\user\\index.html.twig");
    }
}
