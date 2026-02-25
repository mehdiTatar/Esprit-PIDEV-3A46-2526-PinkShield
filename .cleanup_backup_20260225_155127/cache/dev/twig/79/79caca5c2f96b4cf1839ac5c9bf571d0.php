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

/* dashboard/user.html.twig */
class __TwigTemplate_c49e1eee2baaf42dbc8ae6e6c48a78ae extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/user.html.twig"));

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

        yield "Patient Dashboard - PinkShield";
        
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
    }

    .card-icon {
        font-size: 2.5rem;
        color: #C41E3A;
        margin-bottom: 15px;
    }

    .profile-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: white;
        overflow: hidden;
    }

    .profile-card-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 20px;
    }

    .profile-card-header i {
        font-size: 2rem;
        margin-right: 15px;
    }

    .profile-card .card-body {
        padding: 25px;
    }

    .profile-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-item {
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-item label {
        color: #999;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        display: block;
        margin-bottom: 5px;
    }

    .info-item span {
        color: #2C3E50;
        font-size: 1rem;
        font-weight: 500;
    }

    .feature-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: white;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
    }

    .feature-card-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .feature-card-header i {
        font-size: 2rem;
    }

    .feature-card-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .feature-card .card-body {
        padding: 20px;
    }

    .feature-status {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .status-badge {
        background-color: #FFF3CD;
        color: #856404;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .btn-edit {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background-color: #8B1428;
        border-color: #8B1428;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .grid-full {
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 30px 20px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .profile-info {
            grid-template-columns: 1fr;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 199
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 200
        yield "<div class=\"dashboard-container\">
    <div class=\"dashboard-header\">
        <h1><i class=\"fas fa-user-circle\"></i> Welcome back, ";
        // line 202
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 202, $this->source); })()), "user", [], "any", false, false, false, 202), "fullName", [], "any", false, false, false, 202), "html", null, true);
        yield "!</h1>
        <p><i class=\"fas fa-hospital-user\"></i> Patient Dashboard - Manage your healthcare</p>
    </div>

    <div class=\"grid-2\">
        <!-- Profile Card -->
        <div class=\"profile-card\">
            <div class=\"profile-card-header\">
                <i class=\"fas fa-id-card\"></i>
                <div>
                    <h5 class=\"mb-0\">Your Profile</h5>
                    <small>Personal Information</small>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"profile-info\">
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-user\"></i> Full Name</label>
                        <span>";
        // line 220
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 220, $this->source); })()), "user", [], "any", false, false, false, 220), "fullName", [], "any", false, false, false, 220), "html", null, true);
        yield "</span>
                    </div>
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-envelope\"></i> Email</label>
                        <span>";
        // line 224
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 224, $this->source); })()), "user", [], "any", false, false, false, 224), "email", [], "any", false, false, false, 224), "html", null, true);
        yield "</span>
                    </div>
                </div>
                <div class=\"profile-info\">
                    <div class=\"info-item\" style=\"grid-column: 1 / -1;\">
                        <label><i class=\"fas fa-phone\"></i> Phone</label>
                        <span>";
        // line 230
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 230), "phone", [], "any", true, true, false, 230) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 230, $this->source); })()), "user", [], "any", false, false, false, 230), "phone", [], "any", false, false, false, 230)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 230, $this->source); })()), "user", [], "any", false, false, false, 230), "phone", [], "any", false, false, false, 230), "html", null, true)) : ("Not provided"));
        yield "</span>
                    </div>
                </div>
                <a href=\"";
        // line 233
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 233, $this->source); })()), "user", [], "any", false, false, false, 233), "id", [], "any", false, false, false, 233)]), "html", null, true);
        yield "\" class=\"btn btn-edit w-100\">
                    <i class=\"fas fa-edit\"></i> Edit Profile
                </a>
            </div>
        </div>

        <!-- Blog & Forum Card -->
        <div class=\"feature-card\">
            <div class=\"feature-card-header\">
                <i class=\"fas fa-comments\"></i>
                <h5>Blog & Forum</h5>
            </div>
            <div class=\"card-body\">
                <div class=\"feature-status\">
                    <span class=\"status-badge bg-success text-white\"><i class=\"fas fa-check-circle\"></i> Live Now</span>
                </div>
                <p class=\"text-muted mb-3\">
                    Connect with healthcare professionals and patients. Share experiences and get advice from our community.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> Expert Medical Discussions</li>
                    <li><i class=\"fas fa-check text-success\"></i> Patient Support Groups</li>
                    <li><i class=\"fas fa-check text-success\"></i> Health Tips & Articles</li>
                </ul>
                <a href=\"";
        // line 257
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index");
        yield "\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-eye\"></i> View Forum
                </a>
            </div>
        </div>

        <!-- Appointments & Pharmacy Card -->
        <div class=\"feature-card\">
            <div class=\"feature-card-header\">
                <i class=\"fas fa-calendar-check\"></i>
                <h5>Appointments</h5>
            </div>
            <div class=\"card-body\">
                <div class=\"feature-status\">
                    <span class=\"status-badge bg-success text-white\"><i class=\"fas fa-check-circle\"></i> Live Now</span>
                </div>
                <p class=\"text-muted mb-3\">
                    Schedule doctor appointments and manage your medical consultations in one place.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> Book Appointments</li>
                    <li><i class=\"fas fa-check text-success\"></i> Manage Schedule</li>
                    <li><i class=\"fas fa-check text-success\"></i> Medical History</li>
                </ul>
                <a href=\"";
        // line 281
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-calendar-alt\"></i> Manage Appointments
                </a>
            </div>
        </div>

        <!-- Rate Doctors Card -->
        <div class=\"feature-card\">
            <div class=\"feature-card-header\">
                <i class=\"fas fa-star\"></i>
                <h5>Rate Doctors</h5>
            </div>
            <div class=\"card-body\">
                <div class=\"feature-status\">
                    <span class=\"status-badge bg-success text-white\"><i class=\"fas fa-check-circle\"></i> Live Now</span>
                </div>
                <p class=\"text-muted mb-3\">
                    Share your experience with doctors and help other patients make informed decisions.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> View Doctor Profiles</li>
                    <li><i class=\"fas fa-check text-success\"></i> Submit Ratings</li>
                    <li><i class=\"fas fa-check text-success\"></i> Edit Your Reviews</li>
                </ul>
                <a href=\"";
        // line 305
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("rating_doctors_list");
        yield "\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-star\"></i> Rate Doctors Now
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Features -->
    <div class=\"row mt-5\">
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-file-medical\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Medical Records</h5>
                    <p class=\"text-muted mb-0\">Access your health data</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-calendar-alt\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Appointments</h5>
                    <p class=\"text-muted mb-0\">";
        // line 332
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["scheduledAppointments"]) || array_key_exists("scheduledAppointments", $context) ? $context["scheduledAppointments"] : (function () { throw new RuntimeError('Variable "scheduledAppointments" does not exist.', 332, $this->source); })()), "html", null, true);
        yield " Scheduled</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-prescription-bottle\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Prescriptions</h5>
                    <p class=\"text-muted mb-0\">0 Active</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-heartbeat\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Health Score</h5>
                    <p class=\"text-muted mb-0\">Good</p>
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
        return "dashboard/user.html.twig";
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
        return array (  453 => 332,  423 => 305,  396 => 281,  369 => 257,  342 => 233,  336 => 230,  327 => 224,  320 => 220,  299 => 202,  295 => 200,  285 => 199,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Patient Dashboard - PinkShield{% endblock %}

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
    }

    .card-icon {
        font-size: 2.5rem;
        color: #C41E3A;
        margin-bottom: 15px;
    }

    .profile-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: white;
        overflow: hidden;
    }

    .profile-card-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 20px;
    }

    .profile-card-header i {
        font-size: 2rem;
        margin-right: 15px;
    }

    .profile-card .card-body {
        padding: 25px;
    }

    .profile-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-item {
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-item label {
        color: #999;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        display: block;
        margin-bottom: 5px;
    }

    .info-item span {
        color: #2C3E50;
        font-size: 1rem;
        font-weight: 500;
    }

    .feature-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: white;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
    }

    .feature-card-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .feature-card-header i {
        font-size: 2rem;
    }

    .feature-card-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .feature-card .card-body {
        padding: 20px;
    }

    .feature-status {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .status-badge {
        background-color: #FFF3CD;
        color: #856404;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .btn-edit {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        background-color: #8B1428;
        border-color: #8B1428;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .grid-full {
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 30px 20px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .profile-info {
            grid-template-columns: 1fr;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"dashboard-container\">
    <div class=\"dashboard-header\">
        <h1><i class=\"fas fa-user-circle\"></i> Welcome back, {{ app.user.fullName }}!</h1>
        <p><i class=\"fas fa-hospital-user\"></i> Patient Dashboard - Manage your healthcare</p>
    </div>

    <div class=\"grid-2\">
        <!-- Profile Card -->
        <div class=\"profile-card\">
            <div class=\"profile-card-header\">
                <i class=\"fas fa-id-card\"></i>
                <div>
                    <h5 class=\"mb-0\">Your Profile</h5>
                    <small>Personal Information</small>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"profile-info\">
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-user\"></i> Full Name</label>
                        <span>{{ app.user.fullName }}</span>
                    </div>
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-envelope\"></i> Email</label>
                        <span>{{ app.user.email }}</span>
                    </div>
                </div>
                <div class=\"profile-info\">
                    <div class=\"info-item\" style=\"grid-column: 1 / -1;\">
                        <label><i class=\"fas fa-phone\"></i> Phone</label>
                        <span>{{ app.user.phone ?? 'Not provided' }}</span>
                    </div>
                </div>
                <a href=\"{{ path('user_edit', {id: app.user.id}) }}\" class=\"btn btn-edit w-100\">
                    <i class=\"fas fa-edit\"></i> Edit Profile
                </a>
            </div>
        </div>

        <!-- Blog & Forum Card -->
        <div class=\"feature-card\">
            <div class=\"feature-card-header\">
                <i class=\"fas fa-comments\"></i>
                <h5>Blog & Forum</h5>
            </div>
            <div class=\"card-body\">
                <div class=\"feature-status\">
                    <span class=\"status-badge bg-success text-white\"><i class=\"fas fa-check-circle\"></i> Live Now</span>
                </div>
                <p class=\"text-muted mb-3\">
                    Connect with healthcare professionals and patients. Share experiences and get advice from our community.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> Expert Medical Discussions</li>
                    <li><i class=\"fas fa-check text-success\"></i> Patient Support Groups</li>
                    <li><i class=\"fas fa-check text-success\"></i> Health Tips & Articles</li>
                </ul>
                <a href=\"{{ path('blog_index') }}\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-eye\"></i> View Forum
                </a>
            </div>
        </div>

        <!-- Appointments & Pharmacy Card -->
        <div class=\"feature-card\">
            <div class=\"feature-card-header\">
                <i class=\"fas fa-calendar-check\"></i>
                <h5>Appointments</h5>
            </div>
            <div class=\"card-body\">
                <div class=\"feature-status\">
                    <span class=\"status-badge bg-success text-white\"><i class=\"fas fa-check-circle\"></i> Live Now</span>
                </div>
                <p class=\"text-muted mb-3\">
                    Schedule doctor appointments and manage your medical consultations in one place.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> Book Appointments</li>
                    <li><i class=\"fas fa-check text-success\"></i> Manage Schedule</li>
                    <li><i class=\"fas fa-check text-success\"></i> Medical History</li>
                </ul>
                <a href=\"{{ path('appointment_index') }}\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-calendar-alt\"></i> Manage Appointments
                </a>
            </div>
        </div>

        <!-- Rate Doctors Card -->
        <div class=\"feature-card\">
            <div class=\"feature-card-header\">
                <i class=\"fas fa-star\"></i>
                <h5>Rate Doctors</h5>
            </div>
            <div class=\"card-body\">
                <div class=\"feature-status\">
                    <span class=\"status-badge bg-success text-white\"><i class=\"fas fa-check-circle\"></i> Live Now</span>
                </div>
                <p class=\"text-muted mb-3\">
                    Share your experience with doctors and help other patients make informed decisions.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> View Doctor Profiles</li>
                    <li><i class=\"fas fa-check text-success\"></i> Submit Ratings</li>
                    <li><i class=\"fas fa-check text-success\"></i> Edit Your Reviews</li>
                </ul>
                <a href=\"{{ path('rating_doctors_list') }}\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-star\"></i> Rate Doctors Now
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Features -->
    <div class=\"row mt-5\">
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-file-medical\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Medical Records</h5>
                    <p class=\"text-muted mb-0\">Access your health data</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-calendar-alt\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Appointments</h5>
                    <p class=\"text-muted mb-0\">{{ scheduledAppointments }} Scheduled</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-prescription-bottle\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Prescriptions</h5>
                    <p class=\"text-muted mb-0\">0 Active</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-heartbeat\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Health Score</h5>
                    <p class=\"text-muted mb-0\">Good</p>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "dashboard/user.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\dashboard\\user.html.twig");
    }
}
