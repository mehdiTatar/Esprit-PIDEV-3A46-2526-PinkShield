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

/* dashboard/admin_health_logs.html.twig */
class __TwigTemplate_00d3c0d71c892ad1cf0eb9966a72f399 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/admin_health_logs.html.twig"));

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

        yield "Health Logs - Admin";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "<style>
    .health-logs-container {
        margin-top: 20px;
    }

    .health-logs-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .health-logs-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .health-logs-header p {
        opacity: 0.95;
        margin: 0;
    }

    .logs-table {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .logs-table table {
        margin-bottom: 0;
    }

    .logs-table thead {
        background-color: #f8f9fa;
        border-bottom: 2px solid #C41E3A;
    }

    .logs-table thead th {
        color: #2C3E50;
        font-weight: 700;
        padding: 15px;
    }

    .logs-table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
    }

    .logs-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .mood-badge, .stress-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        text-align: center;
        width: 40px;
    }

    .mood-badge.high, .stress-badge.high {
        background-color: #dc3545;
        color: white;
    }

    .mood-badge.medium, .stress-badge.medium {
        background-color: #ffc107;
        color: #2C3E50;
    }

    .mood-badge.low, .stress-badge.low {
        background-color: #28a745;
        color: white;
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 88
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 89
        yield "<div class=\"health-logs-container\">
    <div class=\"health-logs-header\">
        <h2><i class=\"fas fa-heartbeat\"></i> User Health Logs</h2>
        <p>View and manage all patient health tracking entries</p>
    </div>

    ";
        // line 95
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 95, $this->source); })()), "flashes", ["success"], "method", false, false, false, 95));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 96
            yield "        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <i class=\"fas fa-check-circle me-2\"></i>";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        yield "
    <div class=\"logs-table\">
        <div class=\"table-responsive\">
            <table class=\"table\">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Email</th>
                        <th>Mood</th>
                        <th>Stress</th>
                        <th>Activities</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 117
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["logs"]) || array_key_exists("logs", $context) ? $context["logs"] : (function () { throw new RuntimeError('Variable "logs" does not exist.', 117, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
            // line 118
            yield "                        <tr>
                            <td><strong>#";
            // line 119
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "id", [], "any", false, false, false, 119), "html", null, true);
            yield "</strong></td>
                            <td>";
            // line 120
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "userEmail", [], "any", false, false, false, 120), "html", null, true);
            yield "</td>
                            <td>
                                <span class=\"mood-badge ";
            // line 122
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "mood", [], "any", false, false, false, 122) >= 4)) {
                yield "high";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "mood", [], "any", false, false, false, 122) == 3)) {
                yield "medium";
            } else {
                yield "low";
            }
            yield "\">
                                    ";
            // line 123
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "mood", [], "any", false, false, false, 123), "html", null, true);
            yield "/5
                                </span>
                            </td>
                            <td>
                                <span class=\"stress-badge ";
            // line 127
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "stress", [], "any", false, false, false, 127) >= 4)) {
                yield "high";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "stress", [], "any", false, false, false, 127) == 3)) {
                yield "medium";
            } else {
                yield "low";
            }
            yield "\">
                                    ";
            // line 128
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "stress", [], "any", false, false, false, 128), "html", null, true);
            yield "/5
                                </span>
                            </td>
                            <td>
                                <small>";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "activities", [], "any", false, false, false, 132)), 0, 50), "html", null, true);
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["log"], "activities", [], "any", false, false, false, 132) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["log"], "activities", [], "any", false, false, false, 132)) > 50))) {
                yield "...";
            }
            yield "</small>
                            </td>
                            <td>";
            // line 134
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["log"], "createdAt", [], "any", false, false, false, 134)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["log"], "createdAt", [], "any", false, false, false, 134), "M d, Y H:i"), "html", null, true)) : ("N/A"));
            yield "</td>
                            <td>
                                <a href=\"";
            // line 136
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_health_log_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["log"], "id", [], "any", false, false, false, 136)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Delete this health log?');\">
                                    <i class=\"fas fa-trash\"></i> Delete
                                </a>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 141
        if (!$context['_iterated']) {
            // line 142
            yield "                        <tr>
                            <td colspan=\"7\" class=\"text-center text-muted py-4\">
                                <i class=\"fas fa-inbox\"></i> No health logs found in the database.
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['log'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        yield "                </tbody>
            </table>
        </div>
    </div>

    <div class=\"mt-4\">
        <a href=\"";
        // line 154
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_health_stats");
        yield "\" class=\"btn btn-outline-primary\">
            <i class=\"fas fa-chart-bar\"></i> View Statistics
        </a>
        <a href=\"";
        // line 157
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"btn btn-outline-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Back to Dashboard
        </a>
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
        return "dashboard/admin_health_logs.html.twig";
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
        return array (  328 => 157,  322 => 154,  314 => 148,  303 => 142,  301 => 141,  291 => 136,  286 => 134,  278 => 132,  271 => 128,  261 => 127,  254 => 123,  244 => 122,  239 => 120,  235 => 119,  232 => 118,  227 => 117,  209 => 101,  199 => 97,  196 => 96,  192 => 95,  184 => 89,  174 => 88,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Health Logs - Admin{% endblock %}

{% block stylesheets %}
<style>
    .health-logs-container {
        margin-top: 20px;
    }

    .health-logs-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .health-logs-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .health-logs-header p {
        opacity: 0.95;
        margin: 0;
    }

    .logs-table {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .logs-table table {
        margin-bottom: 0;
    }

    .logs-table thead {
        background-color: #f8f9fa;
        border-bottom: 2px solid #C41E3A;
    }

    .logs-table thead th {
        color: #2C3E50;
        font-weight: 700;
        padding: 15px;
    }

    .logs-table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
    }

    .logs-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .mood-badge, .stress-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        text-align: center;
        width: 40px;
    }

    .mood-badge.high, .stress-badge.high {
        background-color: #dc3545;
        color: white;
    }

    .mood-badge.medium, .stress-badge.medium {
        background-color: #ffc107;
        color: #2C3E50;
    }

    .mood-badge.low, .stress-badge.low {
        background-color: #28a745;
        color: white;
    }
</style>
{% endblock %}

{% block body %}
<div class=\"health-logs-container\">
    <div class=\"health-logs-header\">
        <h2><i class=\"fas fa-heartbeat\"></i> User Health Logs</h2>
        <p>View and manage all patient health tracking entries</p>
    </div>

    {% for message in app.flashes('success') %}
        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <i class=\"fas fa-check-circle me-2\"></i>{{ message }}
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    {% endfor %}

    <div class=\"logs-table\">
        <div class=\"table-responsive\">
            <table class=\"table\">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Email</th>
                        <th>Mood</th>
                        <th>Stress</th>
                        <th>Activities</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {% for log in logs %}
                        <tr>
                            <td><strong>#{{ log.id }}</strong></td>
                            <td>{{ log.userEmail }}</td>
                            <td>
                                <span class=\"mood-badge {% if log.mood >= 4 %}high{% elseif log.mood == 3 %}medium{% else %}low{% endif %}\">
                                    {{ log.mood }}/5
                                </span>
                            </td>
                            <td>
                                <span class=\"stress-badge {% if log.stress >= 4 %}high{% elseif log.stress == 3 %}medium{% else %}low{% endif %}\">
                                    {{ log.stress }}/5
                                </span>
                            </td>
                            <td>
                                <small>{{ log.activities|e|slice(0,50) }}{% if log.activities and log.activities|length > 50 %}...{% endif %}</small>
                            </td>
                            <td>{{ log.createdAt ? log.createdAt|date('M d, Y H:i') : 'N/A' }}</td>
                            <td>
                                <a href=\"{{ path('admin_health_log_delete', {'id': log.id}) }}\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Delete this health log?');\">
                                    <i class=\"fas fa-trash\"></i> Delete
                                </a>
                            </td>
                        </tr>
                    {% else %}
                        <tr>
                            <td colspan=\"7\" class=\"text-center text-muted py-4\">
                                <i class=\"fas fa-inbox\"></i> No health logs found in the database.
                            </td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>

    <div class=\"mt-4\">
        <a href=\"{{ path('admin_health_stats') }}\" class=\"btn btn-outline-primary\">
            <i class=\"fas fa-chart-bar\"></i> View Statistics
        </a>
        <a href=\"{{ path('admin_dashboard') }}\" class=\"btn btn-outline-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Back to Dashboard
        </a>
    </div>
</div>
{% endblock %}
", "dashboard/admin_health_logs.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\dashboard\\admin_health_logs.html.twig");
    }
}
