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

/* dashboard/admin.html.twig */
class __TwigTemplate_1f9784cf4ae5926c859d92701d054e70 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/admin.html.twig"));

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

        yield "Admin Dashboard - PinkShield";
        
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
    .dashboard-container {
        margin-top: 20px;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-header p {
        margin: 10px 0 0 0;
        opacity: 0.95;
        font-size: 1.1rem;
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

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 30px;
    }

    .action-btn {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(196, 30, 58, 0.3);
        color: white;
    }

    .quick-access-section {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-top: 30px;
    }

    .quick-access-section h4 {
        color: #2C3E50;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quick-access-section h4 i {
        color: #C41E3A;
    }

    .grid-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 30px 20px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .grid-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 145
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 146
        yield "<div class=\"dashboard-container\">
    <div class=\"dashboard-header\">
        <h1><i class=\"fas fa-shield-alt\"></i> Admin Dashboard</h1>
        <p><i class=\"fas fa-cog\"></i> System Management & User Administration</p>
    </div>

    <!-- Statistics Grid -->
    <div class=\"grid-stats\">
        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-users\"></i>
                </div>
                <div class=\"stat-label\">Total Users</div>
                <div class=\"stat-number\">";
        // line 160
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalUsers"]) || array_key_exists("totalUsers", $context) ? $context["totalUsers"] : (function () { throw new RuntimeError('Variable "totalUsers" does not exist.', 160, $this->source); })()), "html", null, true);
        yield "</div>
                <a href=\"";
        // line 161
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
        yield "\" class=\"action-btn\" style=\"margin-top: 10px; font-size: 0.9rem;\">
                    <i class=\"fas fa-list\"></i> Manage Users
                </a>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-user-md\"></i>
                </div>
                <div class=\"stat-label\">Total Doctors</div>
                <div class=\"stat-number\">";
        // line 173
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalDoctors"]) || array_key_exists("totalDoctors", $context) ? $context["totalDoctors"] : (function () { throw new RuntimeError('Variable "totalDoctors" does not exist.', 173, $this->source); })()), "html", null, true);
        yield "</div>
                <a href=\"";
        // line 174
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_index");
        yield "\" class=\"action-btn\" style=\"margin-top: 10px; font-size: 0.9rem;\">
                    <i class=\"fas fa-list\"></i> Manage Doctors
                </a>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-user-shield\"></i>
                </div>
                <div class=\"stat-label\">Total Admins</div>
                <div class=\"stat-number\">";
        // line 186
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalAdmins"]) || array_key_exists("totalAdmins", $context) ? $context["totalAdmins"] : (function () { throw new RuntimeError('Variable "totalAdmins" does not exist.', 186, $this->source); })()), "html", null, true);
        yield "</div>
                <a href=\"";
        // line 187
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_index");
        yield "\" class=\"action-btn\" style=\"margin-top: 10px; font-size: 0.9rem;\">
                    <i class=\"fas fa-list\"></i> Manage Admins
                </a>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-check-circle\"></i>
                </div>
                <div class=\"stat-label\">System Status</div>
                <div style=\"font-size: 1.2rem; color: #28a745; font-weight: 700; margin: 10px 0;\">Active</div>
                <small class=\"text-muted\">All systems operational</small>
            </div>
        </div>
    </div>

    <!-- Quick Access Section -->
    <div class=\"quick-access-section\">
        <h4><i class=\"fas fa-plus-circle\"></i> Quick Actions</h4>
        <div class=\"action-buttons\">
            <a href=\"";
        // line 209
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_new");
        yield "\" class=\"action-btn\">
                <i class=\"fas fa-user-plus\"></i> Add New User
            </a>
            <a href=\"";
        // line 212
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_new");
        yield "\" class=\"action-btn\">
                <i class=\"fas fa-user-md\"></i> Add New Doctor
            </a>
            <a href=\"";
        // line 215
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_new");
        yield "\" class=\"action-btn\">
                <i class=\"fas fa-user-shield\"></i> Add New Admin
            </a>
        </div>
    </div>

    <!-- Management Sections -->
    <div style=\"margin-top: 40px;\">
        <div class=\"row\">
            <div class=\"col-md-4\">
                <div style=\"background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); height: 100%;\">
                    <h5 style=\"color: #2C3E50; font-weight: 700; margin-bottom: 15px;\">
                        <i class=\"fas fa-users-cog\" style=\"color: #C41E3A; margin-right: 10px;\"></i> User Management
                    </h5>
                    <p class=\"text-muted small\">Manage patient accounts, permissions, and access control.</p>
                    <a href=\"";
        // line 230
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
        yield "\" class=\"action-btn\" style=\"margin-top: 15px; width: 100%; text-align: center;\">
                        <i class=\"fas fa-arrow-right\"></i> Manage Users
                    </a>
                </div>
            </div>

            <div class=\"col-md-4\">
                <div style=\"background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); height: 100%;\">
                    <h5 style=\"color: #2C3E50; font-weight: 700; margin-bottom: 15px;\">
                        <i class=\"fas fa-hospital-user\" style=\"color: #C41E3A; margin-right: 10px;\"></i> Doctor Management
                    </h5>
                    <p class=\"text-muted small\">Manage healthcare professionals, specialties, and credentials.</p>
                    <a href=\"";
        // line 242
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_index");
        yield "\" class=\"action-btn\" style=\"margin-top: 15px; width: 100%; text-align: center;\">
                        <i class=\"fas fa-arrow-right\"></i> Manage Doctors
                    </a>
                </div>
            </div>

            <div class=\"col-md-4\">
                <div style=\"background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); height: 100%;\">
                    <h5 style=\"color: #2C3E50; font-weight: 700; margin-bottom: 15px;\">
                        <i class=\"fas fa-comments\" style=\"color: #C41E3A; margin-right: 10px;\"></i> Blog & Appointments
                    </h5>
                    <p class=\"text-muted small\">Oversee community discussions and global appointment schedule.</p>
                    <div class=\"d-flex flex-column gap-2\">
                        <a href=\"";
        // line 255
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_manage_blog");
        yield "\" class=\"btn btn-outline-primary btn-sm\">
                            Manage Blog
                        </a>
                        <a href=\"";
        // line 258
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"btn btn-outline-primary btn-sm\">
                            All Appointments
                        </a>
                        <a href=\"";
        // line 261
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_health_logs");
        yield "\" class=\"btn btn-outline-primary btn-sm\">
                            Health Tracks
                        </a>
                        <a href=\"";
        // line 264
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_health_stats");
        yield "\" class=\"btn btn-outline-primary btn-sm\">
                            Health Stats
                        </a>
                    </div>
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
        return "dashboard/admin.html.twig";
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
        return array (  403 => 264,  397 => 261,  391 => 258,  385 => 255,  369 => 242,  354 => 230,  336 => 215,  330 => 212,  324 => 209,  299 => 187,  295 => 186,  280 => 174,  276 => 173,  261 => 161,  257 => 160,  241 => 146,  231 => 145,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Admin Dashboard - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    .dashboard-container {
        margin-top: 20px;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-header p {
        margin: 10px 0 0 0;
        opacity: 0.95;
        font-size: 1.1rem;
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

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 30px;
    }

    .action-btn {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(196, 30, 58, 0.3);
        color: white;
    }

    .quick-access-section {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        margin-top: 30px;
    }

    .quick-access-section h4 {
        color: #2C3E50;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quick-access-section h4 i {
        color: #C41E3A;
    }

    .grid-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 30px 20px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .grid-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"dashboard-container\">
    <div class=\"dashboard-header\">
        <h1><i class=\"fas fa-shield-alt\"></i> Admin Dashboard</h1>
        <p><i class=\"fas fa-cog\"></i> System Management & User Administration</p>
    </div>

    <!-- Statistics Grid -->
    <div class=\"grid-stats\">
        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-users\"></i>
                </div>
                <div class=\"stat-label\">Total Users</div>
                <div class=\"stat-number\">{{ totalUsers }}</div>
                <a href=\"{{ path('user_index') }}\" class=\"action-btn\" style=\"margin-top: 10px; font-size: 0.9rem;\">
                    <i class=\"fas fa-list\"></i> Manage Users
                </a>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-user-md\"></i>
                </div>
                <div class=\"stat-label\">Total Doctors</div>
                <div class=\"stat-number\">{{ totalDoctors }}</div>
                <a href=\"{{ path('doctor_index') }}\" class=\"action-btn\" style=\"margin-top: 10px; font-size: 0.9rem;\">
                    <i class=\"fas fa-list\"></i> Manage Doctors
                </a>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-user-shield\"></i>
                </div>
                <div class=\"stat-label\">Total Admins</div>
                <div class=\"stat-number\">{{ totalAdmins }}</div>
                <a href=\"{{ path('admin_index') }}\" class=\"action-btn\" style=\"margin-top: 10px; font-size: 0.9rem;\">
                    <i class=\"fas fa-list\"></i> Manage Admins
                </a>
            </div>
        </div>

        <div class=\"stat-card\">
            <div class=\"card-body\">
                <div class=\"card-icon\">
                    <i class=\"fas fa-check-circle\"></i>
                </div>
                <div class=\"stat-label\">System Status</div>
                <div style=\"font-size: 1.2rem; color: #28a745; font-weight: 700; margin: 10px 0;\">Active</div>
                <small class=\"text-muted\">All systems operational</small>
            </div>
        </div>
    </div>

    <!-- Quick Access Section -->
    <div class=\"quick-access-section\">
        <h4><i class=\"fas fa-plus-circle\"></i> Quick Actions</h4>
        <div class=\"action-buttons\">
            <a href=\"{{ path('user_new') }}\" class=\"action-btn\">
                <i class=\"fas fa-user-plus\"></i> Add New User
            </a>
            <a href=\"{{ path('doctor_new') }}\" class=\"action-btn\">
                <i class=\"fas fa-user-md\"></i> Add New Doctor
            </a>
            <a href=\"{{ path('admin_new') }}\" class=\"action-btn\">
                <i class=\"fas fa-user-shield\"></i> Add New Admin
            </a>
        </div>
    </div>

    <!-- Management Sections -->
    <div style=\"margin-top: 40px;\">
        <div class=\"row\">
            <div class=\"col-md-4\">
                <div style=\"background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); height: 100%;\">
                    <h5 style=\"color: #2C3E50; font-weight: 700; margin-bottom: 15px;\">
                        <i class=\"fas fa-users-cog\" style=\"color: #C41E3A; margin-right: 10px;\"></i> User Management
                    </h5>
                    <p class=\"text-muted small\">Manage patient accounts, permissions, and access control.</p>
                    <a href=\"{{ path('user_index') }}\" class=\"action-btn\" style=\"margin-top: 15px; width: 100%; text-align: center;\">
                        <i class=\"fas fa-arrow-right\"></i> Manage Users
                    </a>
                </div>
            </div>

            <div class=\"col-md-4\">
                <div style=\"background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); height: 100%;\">
                    <h5 style=\"color: #2C3E50; font-weight: 700; margin-bottom: 15px;\">
                        <i class=\"fas fa-hospital-user\" style=\"color: #C41E3A; margin-right: 10px;\"></i> Doctor Management
                    </h5>
                    <p class=\"text-muted small\">Manage healthcare professionals, specialties, and credentials.</p>
                    <a href=\"{{ path('doctor_index') }}\" class=\"action-btn\" style=\"margin-top: 15px; width: 100%; text-align: center;\">
                        <i class=\"fas fa-arrow-right\"></i> Manage Doctors
                    </a>
                </div>
            </div>

            <div class=\"col-md-4\">
                <div style=\"background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); height: 100%;\">
                    <h5 style=\"color: #2C3E50; font-weight: 700; margin-bottom: 15px;\">
                        <i class=\"fas fa-comments\" style=\"color: #C41E3A; margin-right: 10px;\"></i> Blog & Appointments
                    </h5>
                    <p class=\"text-muted small\">Oversee community discussions and global appointment schedule.</p>
                    <div class=\"d-flex flex-column gap-2\">
                        <a href=\"{{ path('admin_manage_blog') }}\" class=\"btn btn-outline-primary btn-sm\">
                            Manage Blog
                        </a>
                        <a href=\"{{ path('appointment_index') }}\" class=\"btn btn-outline-primary btn-sm\">
                            All Appointments
                        </a>
                        <a href=\"{{ path('admin_health_logs') }}\" class=\"btn btn-outline-primary btn-sm\">
                            Health Tracks
                        </a>
                        <a href=\"{{ path('admin_health_stats') }}\" class=\"btn btn-outline-primary btn-sm\">
                            Health Stats
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "dashboard/admin.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\dashboard\\admin.html.twig");
    }
}
