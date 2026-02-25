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

/* dashboard/doctor.html.twig */
class __TwigTemplate_7ad4a0465dc8c01618a9a7ecfb053fa7 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "dashboard/doctor.html.twig"));

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

        yield "Doctor Dashboard - PinkShield";
        
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

    .stat-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }

    .stat-card-link:hover {
        text-decoration: none;
        color: inherit;
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

    .status-badge.bg-success {
        background-color: #D4EDDA !important;
        color: #155724 !important;
    }

    .status-badge.bg-danger {
        background-color: #F8D7DA !important;
        color: #721C24 !important;
    }

    .status-badge.bg-success.text-white {
        background-color: #28a745 !important;
        color: white !important;
    }

    .status-badge.bg-danger.text-white {
        background-color: #dc3545 !important;
        color: white !important;
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

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .grid-full {
        grid-column: 1 / -1;
    }

    .flex-grow-1 {
        flex-grow: 1;
    }

    .w-100 {
        width: 100%;
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

    // line 267
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 268
        yield "<div class=\"dashboard-container\">
    <div class=\"dashboard-header\">
        <h1><i class=\"fas fa-user-md\"></i> Welcome back, Dr. ";
        // line 270
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 270, $this->source); })()), "user", [], "any", false, false, false, 270), "fullName", [], "any", false, false, false, 270), "html", null, true);
        yield "!</h1>
        <p><i class=\"fas fa-clinic-medical\"></i> Doctor Dashboard - Manage your practice</p>
    </div>

    <div class=\"grid-2\">
        <!-- Profile Card -->
        <div class=\"profile-card\">
            <div class=\"profile-card-header\">
                <i class=\"fas fa-id-badge\"></i>
                <div>
                    <h5 class=\"mb-0\">Your Profile</h5>
                    <small>Professional Information</small>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"profile-info\">
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-user-md\"></i> Full Name</label>
                        <span>";
        // line 288
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 288, $this->source); })()), "user", [], "any", false, false, false, 288), "fullName", [], "any", false, false, false, 288), "html", null, true);
        yield "</span>
                    </div>
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-stethoscope\"></i> Speciality</label>
                        <span>";
        // line 292
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 292), "speciality", [], "any", true, true, false, 292) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 292, $this->source); })()), "user", [], "any", false, false, false, 292), "speciality", [], "any", false, false, false, 292)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 292, $this->source); })()), "user", [], "any", false, false, false, 292), "speciality", [], "any", false, false, false, 292), "html", null, true)) : ("Not specified"));
        yield "</span>
                    </div>
                </div>
                <div class=\"profile-info\">
                    <div class=\"info-item\" style=\"grid-column: 1 / -1;\">
                        <label><i class=\"fas fa-envelope\"></i> Email</label>
                        <span>";
        // line 298
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 298, $this->source); })()), "user", [], "any", false, false, false, 298), "email", [], "any", false, false, false, 298), "html", null, true);
        yield "</span>
                    </div>
                </div>
                <div class=\"profile-info\">
                    <div class=\"info-item\" style=\"grid-column: 1 / -1;\">
                        <label><i class=\"fas fa-toggle-on\"></i> Account Status</label>
                        <div style=\"display: flex; align-items: center; gap: 12px; margin-top: 8px;\">
                            ";
        // line 305
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 305, $this->source); })()), "user", [], "any", false, false, false, 305), "status", [], "any", false, false, false, 305) == "active")) {
            // line 306
            yield "                                <span class=\"status-badge bg-success text-white\" style=\"flex-shrink: 0;\">
                                    <i class=\"fas fa-check-circle\"></i> Active
                                </span>
                            ";
        } else {
            // line 310
            yield "                                <span class=\"status-badge bg-danger text-white\" style=\"flex-shrink: 0;\">
                                    <i class=\"fas fa-times-circle\"></i> Inactive
                                </span>
                            ";
        }
        // line 314
        yield "                        </div>
                    </div>
                </div>
                <div style=\"display: flex; gap: 10px; margin-top: 20px;\">
                    <a href=\"";
        // line 318
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 318, $this->source); })()), "user", [], "any", false, false, false, 318), "id", [], "any", false, false, false, 318)]), "html", null, true);
        yield "\" class=\"btn btn-edit flex-grow-1\">
                        <i class=\"fas fa-edit\"></i> Edit Profile
                    </a>
                    <form method=\"POST\" action=\"";
        // line 321
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_toggle_status", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 321, $this->source); })()), "user", [], "any", false, false, false, 321), "id", [], "any", false, false, false, 321)]), "html", null, true);
        yield "\" style=\"flex-grow: 1;\">
                        <input type=\"hidden\" name=\"_token\" value=\"";
        // line 322
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("toggle-status-" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 322, $this->source); })()), "user", [], "any", false, false, false, 322), "id", [], "any", false, false, false, 322))), "html", null, true);
        yield "\">
                        ";
        // line 323
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 323, $this->source); })()), "user", [], "any", false, false, false, 323), "status", [], "any", false, false, false, 323) == "active")) {
            // line 324
            yield "                            <button type=\"submit\" class=\"btn btn-warning w-100\" onclick=\"return confirm('Set your status to Inactive?');\">
                                <i class=\"fas fa-power-off\"></i> Go Inactive
                            </button>
                        ";
        } else {
            // line 328
            yield "                            <button type=\"submit\" class=\"btn btn-success w-100\" onclick=\"return confirm('Set your status to Active?');\">
                                <i class=\"fas fa-check\"></i> Go Active
                            </button>
                        ";
        }
        // line 332
        yield "                    </form>
                </div>
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
                    Share medical insights and engage with fellow healthcare professionals and patients.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> Medical Discussion Posts</li>
                    <li><i class=\"fas fa-check text-success\"></i> Case Study Sharing</li>
                    <li><i class=\"fas fa-check text-success\"></i> Professional Networking</li>
                </ul>
                <a href=\"";
        // line 355
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
                    Manage patient appointments and confirm your schedule in real-time.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> View Patient Appointments</li>
                    <li><i class=\"fas fa-check text-success\"></i> Confirm Bookings</li>
                    <li><i class=\"fas fa-check text-success\"></i> Patient Communication</li>
                </ul>
                <a href=\"";
        // line 379
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-calendar-alt\"></i> Manage Appointments
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Features -->
    <div class=\"row mt-5\">
        <div class=\"col-md-3 col-sm-6\">
            <a href=\"";
        // line 389
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"stat-card-link\">
                <div class=\"stat-card\">
                    <div class=\"card-body text-center\">
                        <div class=\"card-icon\">
                            <i class=\"fas fa-users\"></i>
                        </div>
                        <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">My Patients</h5>
                        <p class=\"text-muted mb-0\">";
        // line 396
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["patientCount"]) || array_key_exists("patientCount", $context) ? $context["patientCount"] : (function () { throw new RuntimeError('Variable "patientCount" does not exist.', 396, $this->source); })()), "html", null, true);
        yield " Patients</p>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <a href=\"";
        // line 402
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
        yield "\" class=\"stat-card-link\">
                <div class=\"stat-card\">
                    <div class=\"card-body text-center\">
                        <div class=\"card-icon\">
                            <i class=\"fas fa-calendar-alt\"></i>
                        </div>
                        <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Appointments</h5>
                        <p class=\"text-muted mb-0\">";
        // line 409
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["appointmentCount"]) || array_key_exists("appointmentCount", $context) ? $context["appointmentCount"] : (function () { throw new RuntimeError('Variable "appointmentCount" does not exist.', 409, $this->source); })()), "html", null, true);
        yield " Scheduled</p>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-file-prescription\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Prescriptions</h5>
                    <p class=\"text-muted mb-0\">0 Issued</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-award\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Patient Rating</h5>
                    ";
        // line 432
        if ((($tmp = (isset($context["averageRating"]) || array_key_exists("averageRating", $context) ? $context["averageRating"] : (function () { throw new RuntimeError('Variable "averageRating" does not exist.', 432, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 433
            yield "                        <p class=\"text-muted mb-0\" style=\"font-size: 1.3rem;\">
                            ";
            // line 434
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 435
                yield "                                ";
                if (($context["i"] <= Twig\Extension\CoreExtension::round((isset($context["averageRating"]) || array_key_exists("averageRating", $context) ? $context["averageRating"] : (function () { throw new RuntimeError('Variable "averageRating" does not exist.', 435, $this->source); })())))) {
                    // line 436
                    yield "                                    <i class=\"fas fa-star\" style=\"color: #ffc107;\"></i>
                                ";
                } else {
                    // line 438
                    yield "                                    <i class=\"fas fa-star\" style=\"color: #ddd;\"></i>
                                ";
                }
                // line 440
                yield "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 441
            yield "                        </p>
                        <p class=\"text-muted mb-0\" style=\"font-size: 0.9rem; margin-top: 8px;\">";
            // line 442
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((isset($context["averageRating"]) || array_key_exists("averageRating", $context) ? $context["averageRating"] : (function () { throw new RuntimeError('Variable "averageRating" does not exist.', 442, $this->source); })()), 1), "html", null, true);
            yield "/5.0 (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["ratingCount"]) || array_key_exists("ratingCount", $context) ? $context["ratingCount"] : (function () { throw new RuntimeError('Variable "ratingCount" does not exist.', 442, $this->source); })()), "html", null, true);
            yield " reviews)</p>
                    ";
        } else {
            // line 444
            yield "                        <p class=\"text-muted mb-0\">No ratings yet</p>
                    ";
        }
        // line 446
        yield "                </div>
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
        return "dashboard/doctor.html.twig";
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
        return array (  622 => 446,  618 => 444,  611 => 442,  608 => 441,  602 => 440,  598 => 438,  594 => 436,  591 => 435,  587 => 434,  584 => 433,  582 => 432,  556 => 409,  546 => 402,  537 => 396,  527 => 389,  514 => 379,  487 => 355,  462 => 332,  456 => 328,  450 => 324,  448 => 323,  444 => 322,  440 => 321,  434 => 318,  428 => 314,  422 => 310,  416 => 306,  414 => 305,  404 => 298,  395 => 292,  388 => 288,  367 => 270,  363 => 268,  353 => 267,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Doctor Dashboard - PinkShield{% endblock %}

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

    .stat-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }

    .stat-card-link:hover {
        text-decoration: none;
        color: inherit;
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

    .status-badge.bg-success {
        background-color: #D4EDDA !important;
        color: #155724 !important;
    }

    .status-badge.bg-danger {
        background-color: #F8D7DA !important;
        color: #721C24 !important;
    }

    .status-badge.bg-success.text-white {
        background-color: #28a745 !important;
        color: white !important;
    }

    .status-badge.bg-danger.text-white {
        background-color: #dc3545 !important;
        color: white !important;
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

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .grid-full {
        grid-column: 1 / -1;
    }

    .flex-grow-1 {
        flex-grow: 1;
    }

    .w-100 {
        width: 100%;
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
        <h1><i class=\"fas fa-user-md\"></i> Welcome back, Dr. {{ app.user.fullName }}!</h1>
        <p><i class=\"fas fa-clinic-medical\"></i> Doctor Dashboard - Manage your practice</p>
    </div>

    <div class=\"grid-2\">
        <!-- Profile Card -->
        <div class=\"profile-card\">
            <div class=\"profile-card-header\">
                <i class=\"fas fa-id-badge\"></i>
                <div>
                    <h5 class=\"mb-0\">Your Profile</h5>
                    <small>Professional Information</small>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"profile-info\">
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-user-md\"></i> Full Name</label>
                        <span>{{ app.user.fullName }}</span>
                    </div>
                    <div class=\"info-item\">
                        <label><i class=\"fas fa-stethoscope\"></i> Speciality</label>
                        <span>{{ app.user.speciality ?? 'Not specified' }}</span>
                    </div>
                </div>
                <div class=\"profile-info\">
                    <div class=\"info-item\" style=\"grid-column: 1 / -1;\">
                        <label><i class=\"fas fa-envelope\"></i> Email</label>
                        <span>{{ app.user.email }}</span>
                    </div>
                </div>
                <div class=\"profile-info\">
                    <div class=\"info-item\" style=\"grid-column: 1 / -1;\">
                        <label><i class=\"fas fa-toggle-on\"></i> Account Status</label>
                        <div style=\"display: flex; align-items: center; gap: 12px; margin-top: 8px;\">
                            {% if app.user.status == 'active' %}
                                <span class=\"status-badge bg-success text-white\" style=\"flex-shrink: 0;\">
                                    <i class=\"fas fa-check-circle\"></i> Active
                                </span>
                            {% else %}
                                <span class=\"status-badge bg-danger text-white\" style=\"flex-shrink: 0;\">
                                    <i class=\"fas fa-times-circle\"></i> Inactive
                                </span>
                            {% endif %}
                        </div>
                    </div>
                </div>
                <div style=\"display: flex; gap: 10px; margin-top: 20px;\">
                    <a href=\"{{ path('doctor_edit', {id: app.user.id}) }}\" class=\"btn btn-edit flex-grow-1\">
                        <i class=\"fas fa-edit\"></i> Edit Profile
                    </a>
                    <form method=\"POST\" action=\"{{ path('doctor_toggle_status', {id: app.user.id}) }}\" style=\"flex-grow: 1;\">
                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('toggle-status-' ~ app.user.id) }}\">
                        {% if app.user.status == 'active' %}
                            <button type=\"submit\" class=\"btn btn-warning w-100\" onclick=\"return confirm('Set your status to Inactive?');\">
                                <i class=\"fas fa-power-off\"></i> Go Inactive
                            </button>
                        {% else %}
                            <button type=\"submit\" class=\"btn btn-success w-100\" onclick=\"return confirm('Set your status to Active?');\">
                                <i class=\"fas fa-check\"></i> Go Active
                            </button>
                        {% endif %}
                    </form>
                </div>
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
                    Share medical insights and engage with fellow healthcare professionals and patients.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> Medical Discussion Posts</li>
                    <li><i class=\"fas fa-check text-success\"></i> Case Study Sharing</li>
                    <li><i class=\"fas fa-check text-success\"></i> Professional Networking</li>
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
                    Manage patient appointments and confirm your schedule in real-time.
                </p>
                <ul class=\"list-unstyled text-muted\" style=\"font-size: 0.9rem;\">
                    <li><i class=\"fas fa-check text-success\"></i> View Patient Appointments</li>
                    <li><i class=\"fas fa-check text-success\"></i> Confirm Bookings</li>
                    <li><i class=\"fas fa-check text-success\"></i> Patient Communication</li>
                </ul>
                <a href=\"{{ path('appointment_index') }}\" class=\"btn btn-primary w-100 mt-3\">
                    <i class=\"fas fa-calendar-alt\"></i> Manage Appointments
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Features -->
    <div class=\"row mt-5\">
        <div class=\"col-md-3 col-sm-6\">
            <a href=\"{{ path('appointment_index') }}\" class=\"stat-card-link\">
                <div class=\"stat-card\">
                    <div class=\"card-body text-center\">
                        <div class=\"card-icon\">
                            <i class=\"fas fa-users\"></i>
                        </div>
                        <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">My Patients</h5>
                        <p class=\"text-muted mb-0\">{{ patientCount }} Patients</p>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <a href=\"{{ path('appointment_index') }}\" class=\"stat-card-link\">
                <div class=\"stat-card\">
                    <div class=\"card-body text-center\">
                        <div class=\"card-icon\">
                            <i class=\"fas fa-calendar-alt\"></i>
                        </div>
                        <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Appointments</h5>
                        <p class=\"text-muted mb-0\">{{ appointmentCount }} Scheduled</p>
                    </div>
                </div>
            </a>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-file-prescription\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Prescriptions</h5>
                    <p class=\"text-muted mb-0\">0 Issued</p>
                </div>
            </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
            <div class=\"stat-card\">
                <div class=\"card-body text-center\">
                    <div class=\"card-icon\">
                        <i class=\"fas fa-award\"></i>
                    </div>
                    <h5 style=\"color: #2C3E50; margin-bottom: 5px;\">Patient Rating</h5>
                    {% if averageRating %}
                        <p class=\"text-muted mb-0\" style=\"font-size: 1.3rem;\">
                            {% for i in 1..5 %}
                                {% if i <= averageRating|round %}
                                    <i class=\"fas fa-star\" style=\"color: #ffc107;\"></i>
                                {% else %}
                                    <i class=\"fas fa-star\" style=\"color: #ddd;\"></i>
                                {% endif %}
                            {% endfor %}
                        </p>
                        <p class=\"text-muted mb-0\" style=\"font-size: 0.9rem; margin-top: 8px;\">{{ averageRating|round(1) }}/5.0 ({{ ratingCount }} reviews)</p>
                    {% else %}
                        <p class=\"text-muted mb-0\">No ratings yet</p>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "dashboard/doctor.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\dashboard\\doctor.html.twig");
    }
}
