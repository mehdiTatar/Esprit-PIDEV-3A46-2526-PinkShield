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

/* admin/index.html.twig */
class __TwigTemplate_104a96802d23ddfac63b4b9ef566a4b0 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/index.html.twig"));

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

        yield "Admins - PinkShield";
        
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
        <h1 class=\"mb-4\">Admins Management</h1>
        <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_new");
        yield "\" class=\"btn btn-primary mb-3\">Add New Admin</a>
    </div>
</div>

<div class=\"table-responsive\">
    <table class=\"table table-striped table-hover\">
        <thead class=\"table-dark\">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["admins"]) || array_key_exists("admins", $context) ? $context["admins"] : (function () { throw new RuntimeError('Variable "admins" does not exist.', 23, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 24
            yield "                <tr>
                    <td>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "id", [], "any", false, false, false, 25), "html", null, true);
            yield "</td>
                    <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "email", [], "any", false, false, false, 26), "html", null, true);
            yield "</td>
                    <td>
                        <a href=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "id", [], "any", false, false, false, 28)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-info\">View</a>
                        <a href=\"";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "id", [], "any", false, false, false, 29)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-warning\">Edit</a>
                        <a href=\"";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "id", [], "any", false, false, false, 30)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        // line 33
        if (!$context['_iterated']) {
            // line 34
            yield "                <tr>
                    <td colspan=\"3\" class=\"text-center\">No admins found</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['admin'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
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
        return "admin/index.html.twig";
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
        return array (  151 => 38,  142 => 34,  140 => 33,  132 => 30,  128 => 29,  124 => 28,  119 => 26,  115 => 25,  112 => 24,  107 => 23,  90 => 9,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Admins - PinkShield{% endblock %}

{% block body %}
<div class=\"row\">
    <div class=\"col-12\">
        <h1 class=\"mb-4\">Admins Management</h1>
        <a href=\"{{ path('admin_new') }}\" class=\"btn btn-primary mb-3\">Add New Admin</a>
    </div>
</div>

<div class=\"table-responsive\">
    <table class=\"table table-striped table-hover\">
        <thead class=\"table-dark\">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {% for admin in admins %}
                <tr>
                    <td>{{ admin.id }}</td>
                    <td>{{ admin.email }}</td>
                    <td>
                        <a href=\"{{ path('admin_show', {id: admin.id}) }}\" class=\"btn btn-sm btn-info\">View</a>
                        <a href=\"{{ path('admin_edit', {id: admin.id}) }}\" class=\"btn btn-sm btn-warning\">Edit</a>
                        <a href=\"{{ path('admin_delete', {id: admin.id}) }}\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </td>
                </tr>
            {% else %}
                <tr>
                    <td colspan=\"3\" class=\"text-center\">No admins found</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
{% endblock %}
", "admin/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\admin\\index.html.twig");
    }
}
