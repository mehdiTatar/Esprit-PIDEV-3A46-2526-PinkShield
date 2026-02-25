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

/* dashboard/admin_health_stats.html.twig */
class __TwigTemplate_3bf5eb339c31e8bbc35bccebfb68ca20 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/admin_health_stats.html.twig"));

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

        yield "Health Statistics - Admin";
        
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
    .health-stats-container {
        margin-top: 20px;
    }

    .health-stats-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .health-stats-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .health-stats-header p {
        opacity: 0.95;
        margin: 0;
    }

    .stat-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: white;
        border-left: 5px solid #C41E3A;
        margin-bottom: 20px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
    }

    .stat-card .card-body {
        padding: 25px;
        text-align: center;
    }

    .card-icon {
        font-size: 2.5rem;
        color: #C41E3A;
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #C41E3A;
        margin: 10px 0;
    }

    .stat-label {
        color: #2C3E50;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .insight-box {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .insight-box h5 {
        color: #2C3E50;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .insight-box p {
        margin-bottom: 0;
        color: #555;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        flex: 1;
        min-width: 150px;
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 111
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 112
        yield "<div class=\"health-stats-container\">
    <div class=\"health-stats-header\">
        <h2><i class=\"fas fa-chart-bar\"></i> Health Statistics & Insights</h2>
        <p>Aggregate analytics from all user health tracking entries</p>
    </div>

    <div class=\"stats-grid\">
        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\"><i class=\"fas fa-database\"></i></div>
                <div class=\"stat-label\">Total Entries</div>
                <div class=\"stat-number\">";
        // line 123
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 123, $this->source); })()), "html", null, true);
        yield "</div>
                <small class=\"text-muted\">Health log entries recorded</small>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\"><i class=\"fas fa-smile\"></i></div>
                <div class=\"stat-label\">Average Mood</div>
                <div class=\"stat-number\">";
        // line 132
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgMood"]) || array_key_exists("avgMood", $context) ? $context["avgMood"] : (function () { throw new RuntimeError('Variable "avgMood" does not exist.', 132, $this->source); })()), "html", null, true);
        yield "<small style=\"font-size: 0.6em;\">/5</small></div>
                <small class=\"text-muted\">Aggregate mood level</small>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\"><i class=\"fas fa-gauge-high\"></i></div>
                <div class=\"stat-label\">Average Stress</div>
                <div class=\"stat-number\">";
        // line 141
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgStress"]) || array_key_exists("avgStress", $context) ? $context["avgStress"] : (function () { throw new RuntimeError('Variable "avgStress" does not exist.', 141, $this->source); })()), "html", null, true);
        yield "<small style=\"font-size: 0.6em;\">/5</small></div>
                <small class=\"text-muted\">Aggregate stress level</small>
            </div>
        </div>
    </div>

    <div class=\"insight-box\">
        <h5><i class=\"fas fa-lightbulb me-2\"></i>Key Insights</h5>
        <p>
            ";
        // line 150
        if (((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 150, $this->source); })()) == 0)) {
            // line 151
            yield "                No health data available yet. Users can start logging their mood and stress levels from their dashboard.
            ";
        } else {
            // line 153
            yield "                Based on ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 153, $this->source); })()), "html", null, true);
            yield " recorded entries:
                <br>
                ";
            // line 155
            if (((isset($context["avgMood"]) || array_key_exists("avgMood", $context) ? $context["avgMood"] : (function () { throw new RuntimeError('Variable "avgMood" does not exist.', 155, $this->source); })()) >= 4)) {
                // line 156
                yield "                    ✓ Users report <strong>positive mood levels</strong> (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgMood"]) || array_key_exists("avgMood", $context) ? $context["avgMood"] : (function () { throw new RuntimeError('Variable "avgMood" does not exist.', 156, $this->source); })()), "html", null, true);
                yield "/5)
                ";
            } elseif ((            // line 157
(isset($context["avgMood"]) || array_key_exists("avgMood", $context) ? $context["avgMood"] : (function () { throw new RuntimeError('Variable "avgMood" does not exist.', 157, $this->source); })()) >= 3)) {
                // line 158
                yield "                    • Users report <strong>neutral mood levels</strong> (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgMood"]) || array_key_exists("avgMood", $context) ? $context["avgMood"] : (function () { throw new RuntimeError('Variable "avgMood" does not exist.', 158, $this->source); })()), "html", null, true);
                yield "/5)
                ";
            } else {
                // line 160
                yield "                    ⚠ Users report <strong>lower mood levels</strong> (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgMood"]) || array_key_exists("avgMood", $context) ? $context["avgMood"] : (function () { throw new RuntimeError('Variable "avgMood" does not exist.', 160, $this->source); })()), "html", null, true);
                yield "/5) - Consider wellness outreach
                ";
            }
            // line 162
            yield "                <br>
                ";
            // line 163
            if (((isset($context["avgStress"]) || array_key_exists("avgStress", $context) ? $context["avgStress"] : (function () { throw new RuntimeError('Variable "avgStress" does not exist.', 163, $this->source); })()) >= 4)) {
                // line 164
                yield "                    ⚠ Average stress level is <strong>high</strong> (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgStress"]) || array_key_exists("avgStress", $context) ? $context["avgStress"] : (function () { throw new RuntimeError('Variable "avgStress" does not exist.', 164, $this->source); })()), "html", null, true);
                yield "/5) - May benefit from wellness programs
                ";
            } elseif ((            // line 165
(isset($context["avgStress"]) || array_key_exists("avgStress", $context) ? $context["avgStress"] : (function () { throw new RuntimeError('Variable "avgStress" does not exist.', 165, $this->source); })()) >= 3)) {
                // line 166
                yield "                    • Users report <strong>moderate stress</strong> (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgStress"]) || array_key_exists("avgStress", $context) ? $context["avgStress"] : (function () { throw new RuntimeError('Variable "avgStress" does not exist.', 166, $this->source); })()), "html", null, true);
                yield "/5)
                ";
            } else {
                // line 168
                yield "                    ✓ Users report <strong>low stress levels</strong> (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["avgStress"]) || array_key_exists("avgStress", $context) ? $context["avgStress"] : (function () { throw new RuntimeError('Variable "avgStress" does not exist.', 168, $this->source); })()), "html", null, true);
                yield "/5)
                ";
            }
            // line 170
            yield "            ";
        }
        // line 171
        yield "        </p>
    </div>
    </div>

    <div class=\"action-buttons\">
        <a href=\"";
        // line 176
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_health_logs");
        yield "\" class=\"btn btn-primary\">
            <i class=\"fas fa-list\"></i> View All Health Logs
        </a>
        <a href=\"";
        // line 179
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
        return "dashboard/admin_health_stats.html.twig";
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
        return array (  329 => 179,  323 => 176,  316 => 171,  313 => 170,  307 => 168,  301 => 166,  299 => 165,  294 => 164,  292 => 163,  289 => 162,  283 => 160,  277 => 158,  275 => 157,  270 => 156,  268 => 155,  262 => 153,  258 => 151,  256 => 150,  244 => 141,  232 => 132,  220 => 123,  207 => 112,  197 => 111,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Health Statistics - Admin{% endblock %}

{% block stylesheets %}
<style>
    .health-stats-container {
        margin-top: 20px;
    }

    .health-stats-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .health-stats-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .health-stats-header p {
        opacity: 0.95;
        margin: 0;
    }

    .stat-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: white;
        border-left: 5px solid #C41E3A;
        margin-bottom: 20px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
    }

    .stat-card .card-body {
        padding: 25px;
        text-align: center;
    }

    .card-icon {
        font-size: 2.5rem;
        color: #C41E3A;
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #C41E3A;
        margin: 10px 0;
    }

    .stat-label {
        color: #2C3E50;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .insight-box {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .insight-box h5 {
        color: #2C3E50;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .insight-box p {
        margin-bottom: 0;
        color: #555;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .action-buttons .btn {
        flex: 1;
        min-width: 150px;
    }
</style>
{% endblock %}

{% block body %}
<div class=\"health-stats-container\">
    <div class=\"health-stats-header\">
        <h2><i class=\"fas fa-chart-bar\"></i> Health Statistics & Insights</h2>
        <p>Aggregate analytics from all user health tracking entries</p>
    </div>

    <div class=\"stats-grid\">
        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\"><i class=\"fas fa-database\"></i></div>
                <div class=\"stat-label\">Total Entries</div>
                <div class=\"stat-number\">{{ total }}</div>
                <small class=\"text-muted\">Health log entries recorded</small>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\"><i class=\"fas fa-smile\"></i></div>
                <div class=\"stat-label\">Average Mood</div>
                <div class=\"stat-number\">{{ avgMood }}<small style=\"font-size: 0.6em;\">/5</small></div>
                <small class=\"text-muted\">Aggregate mood level</small>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\"><i class=\"fas fa-gauge-high\"></i></div>
                <div class=\"stat-label\">Average Stress</div>
                <div class=\"stat-number\">{{ avgStress }}<small style=\"font-size: 0.6em;\">/5</small></div>
                <small class=\"text-muted\">Aggregate stress level</small>
            </div>
        </div>
    </div>

    <div class=\"insight-box\">
        <h5><i class=\"fas fa-lightbulb me-2\"></i>Key Insights</h5>
        <p>
            {% if total == 0 %}
                No health data available yet. Users can start logging their mood and stress levels from their dashboard.
            {% else %}
                Based on {{ total }} recorded entries:
                <br>
                {% if avgMood >= 4 %}
                    ✓ Users report <strong>positive mood levels</strong> ({{ avgMood }}/5)
                {% elseif avgMood >= 3 %}
                    • Users report <strong>neutral mood levels</strong> ({{ avgMood }}/5)
                {% else %}
                    ⚠ Users report <strong>lower mood levels</strong> ({{ avgMood }}/5) - Consider wellness outreach
                {% endif %}
                <br>
                {% if avgStress >= 4 %}
                    ⚠ Average stress level is <strong>high</strong> ({{ avgStress }}/5) - May benefit from wellness programs
                {% elseif avgStress >= 3 %}
                    • Users report <strong>moderate stress</strong> ({{ avgStress }}/5)
                {% else %}
                    ✓ Users report <strong>low stress levels</strong> ({{ avgStress }}/5)
                {% endif %}
            {% endif %}
        </p>
    </div>
    </div>

    <div class=\"action-buttons\">
        <a href=\"{{ path('admin_health_logs') }}\" class=\"btn btn-primary\">
            <i class=\"fas fa-list\"></i> View All Health Logs
        </a>
        <a href=\"{{ path('admin_dashboard') }}\" class=\"btn btn-outline-secondary\">
            <i class=\"fas fa-arrow-left\"></i> Back to Dashboard
        </a>
    </div>
</div>
{% endblock %}
", "dashboard/admin_health_stats.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\dashboard\\admin_health_stats.html.twig");
    }
}
