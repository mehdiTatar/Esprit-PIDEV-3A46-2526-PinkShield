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

/* base.html.twig */
class __TwigTemplate_570409c852bc839d5b0541c4505b875d extends Template
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

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"csrf-token\" content=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(""), "html", null, true);
        yield "\">
        <title>";
        // line 7
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
        <link rel=\"icon\" href=\"";
        // line 8
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/colored-logo.png"), "html", null, true);
        yield "\">
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\">
        ";
        // line 11
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 12
        yield "        ";
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 13
        yield "        <style>
            :root {
                --primary: #C41E3A;
                --primary-dark: #8B1428;
                --secondary: #dc2626;
                --light-bg: #f9fafb;
                --border: #e5e7eb;
                --text-dark: #1f2937;
                --text-gray: #6b7280;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html, body {
                height: 100%;
            }

            body {
                background-color: var(--light-bg);
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
                color: var(--text-dark);
                line-height: 1.6;
                display: flex;
                flex-direction: column;
            }

            /* Navbar Styling */
            .navbar {
                background: #FFF0F2;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                border-bottom: 2px solid #FFD6E0;
                padding: 1rem 0;
                position: sticky;
                top: 0;
                z-index: 1030;
            }

            .navbar-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 700;
                color: var(--primary) !important;
                font-size: 1.25rem;
                letter-spacing: -0.3px;
                text-decoration: none;
            }

            .navbar-brand img {
                height: 32px;
                width: auto;
            }

            .nav-link {
                color: var(--text-gray) !important;
                font-weight: 500;
                font-size: 0.95rem;
                padding: 0.5rem 1rem !important;
                border-radius: 6px;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .nav-link:hover {
                color: var(--primary) !important;
                background-color: rgba(196, 30, 58, 0.05);
            }

            .nav-link.active {
                color: var(--primary) !important;
                background-color: rgba(196, 30, 58, 0.1);
                font-weight: 600;
            }

            .navbar-toggler {
                border: none;
            }

            .navbar-toggler:focus {
                box-shadow: none;
            }

            .dropdown-menu {
                border: 1px solid var(--border);
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                border-radius: 8px;
                margin-top: 8px;
            }

            .dropdown-item {
                color: var(--text-dark);
                font-weight: 500;
                padding: 0.7rem 1rem;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .dropdown-item:hover {
                background-color: rgba(196, 30, 58, 0.05);
                color: var(--primary);
            }

            .btn-primary {
                background-color: var(--primary);
                border-color: var(--primary);
                font-weight: 600;
                padding: 0.5rem 1.2rem;
                border-radius: 6px;
                transition: all 0.2s;
            }

            .btn-primary:hover {
                background-color: var(--primary-dark);
                border-color: var(--primary-dark);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
            }

            .btn-outline-primary {
                color: var(--primary);
                border-color: var(--primary);
                font-weight: 600;
            }

            .btn-outline-primary:hover {
                background-color: var(--primary);
                border-color: var(--primary);
            }

            /* Role Badge */
            .role-badge {
                display: inline-block;
                padding: 0.25rem 0.7rem;
                border-radius: 6px;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.4px;
                margin-left: 8px;
            }

            .role-admin {
                background: rgba(196, 30, 58, 0.15);
                color: var(--primary);
            }

            .role-doctor {
                background: rgba(34, 197, 94, 0.15);
                color: #16a34a;
            }

            .role-user {
                background: rgba(59, 130, 246, 0.15);
                color: #3b82f6;
            }

            /* Notification Badge */
            .notification-badge {
                position: relative;
                display: flex;
                align-items: center;
                cursor: pointer;
                font-size: 1.3rem;
                color: var(--text-gray);
                transition: all 0.2s ease;
                padding: 8px 12px;
                border-radius: 8px;
            }

            .notification-badge:hover {
                color: var(--primary);
                background-color: rgba(196, 30, 58, 0.05);
            }

            .notification-badge .badge {
                position: absolute;
                top: 0;
                right: 0;
                background-color: #ef4444;
                color: white;
                font-size: 0.65rem;
                padding: 0.25rem 0.5rem;
                border-radius: 10px;
                font-weight: 700;
                min-width: 20px;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.7;
                }
            }

            .notification-dropdown {
                min-width: 380px !important;
            }

            .notification-dropdown .dropdown-header {
                background-color: rgba(196, 30, 58, 0.05);
                color: var(--primary);
                font-weight: 700;
                padding: 1rem;
                border-radius: 8px 8px 0 0;
            }

            .notification-dropdown .dropdown-item {
                padding: 0.9rem 1rem;
                border-bottom: 1px solid var(--border);
                white-space: normal;
            }

            .notification-dropdown .dropdown-item:last-child {
                border-bottom: none;
                border-radius: 0 0 8px 8px;
            }

            .notification-item {
                display: flex;
                align-items: flex-start;
                gap: 10px;
            }

            .notification-icon {
                font-size: 1.1rem;
                color: var(--primary);
                flex-shrink: 0;
                margin-top: 2px;
            }

            .notification-content {
                flex: 1;
            }

            .notification-content small {
                display: block;
                line-height: 1.4;
            }

            /* Sidebar */
            .sidebar {
                background: #FFF0F2;
                border-right: 2px solid #FFD6E0;
                position: fixed;
                left: 0;
                top: 60px;
                width: 260px;
                height: calc(100vh - 60px);
                overflow-y: auto;
                padding: 0;
                z-index: 1020;
            }

            .sidebar-logo {
                padding: 24px 20px;
                border-bottom: 2px solid #FFD6E0;
                text-align: center;
            }

            .sidebar-logo a {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                text-decoration: none;
            }

            .sidebar-logo img {
                height: 40px;
                width: auto;
            }

            .sidebar-logo span {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--primary);
            }

            .sidebar-section {
                padding: 20px 0;
            }

            .sidebar-section-title {
                padding: 0 20px;
                margin-bottom: 10px;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: var(--text-gray);
            }

            .sidebar-nav {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 10px 20px;
                color: var(--text-gray);
                text-decoration: none;
                font-weight: 500;
                font-size: 0.95rem;
                transition: all 0.2s;
                border-left: 3px solid transparent;
            }

            .sidebar-link:hover {
                color: var(--primary);
                background-color: rgba(196, 30, 58, 0.05);
                border-left-color: var(--primary);
            }

            .sidebar-link.active {
                color: var(--primary);
                background-color: rgba(196, 30, 58, 0.1);
                border-left-color: var(--primary);
                font-weight: 600;
            }

            .sidebar-link i {
                width: 20px;
                text-align: center;
            }

            /* Main Content */
            main {
                flex: 1;
                margin-left: 260px;
                margin-top: 60px;
                overflow-y: auto;
            }

            .container-desktop {
                max-width: 1200px;
                margin: 0 auto;
                padding: 40px 30px;
                width: 100%;
            }

            /* Alert Styling */
            .alert {
                border: none;
                border-radius: 8px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 12px;
                border-left: 4px solid;
            }

            .alert-success {
                background-color: #dcfce7;
                color: #166534;
                border-left-color: #22c55e;
            }

            .alert-danger {
                background-color: #fee2e2;
                color: #b91c1c;
                border-left-color: #ef4444;
            }

            .alert-warning {
                background-color: #fef3c7;
                color: #b45309;
                border-left-color: #f59e0b;
            }

            .alert-info {
                background-color: #dbeafe;
                color: #1e40af;
                border-left-color: #3b82f6;
            }

            /* Responsive */
            @media (max-width: 991px) {
                .sidebar {
                    width: 0;
                    transform: translateX(-100%);
                    transition: all 0.3s ease;
                }

                .sidebar.show {
                    width: 260px;
                    transform: translateX(0);
                }

                main {
                    margin-left: 0;
                }
            }

            @media (max-width: 768px) {
                .container-desktop {
                    padding: 20px 15px;
                }

                .navbar-brand span {
                    display: none;
                }

                .nav-link span {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <!-- Professional Navbar -->
        <nav class=\"navbar navbar-expand-lg\">
            <div class=\"container-fluid px-4\">
                <a class=\"navbar-brand\" href=\"";
        // line 440
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\">
                    <img src=\"";
        // line 441
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/colored-logo.png"), "html", null, true);
        yield "\" alt=\"PinkShield\">
                    <span>PinkShield</span>
                </a>

                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\" aria-label=\"Toggle navigation\">
                    <i class=\"fas fa-bars\"></i>
                </button>

                <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                    <ul class=\"navbar-nav ms-auto align-items-center gap-2\">
                        ";
        // line 451
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 451, $this->source); })()), "user", [], "any", false, false, false, 451)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 452
            yield "                            <!-- Notification Bell -->
                            <li class=\"nav-item dropdown\">
                                <button class=\"btn btn-link nav-link notification-badge p-0\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" id=\"notificationBell\">
                                    <i class=\"fas fa-bell\"></i>
                                    <span class=\"badge\" id=\"notificationBadge\">0</span>
                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-end notification-dropdown\" id=\"notificationDropdown\">
                                    <li class=\"dropdown-header fw-bold\">
                                        <i class=\"fas fa-bell me-2\"></i>Notifications
                                        <span class=\"badge bg-danger float-end\" id=\"unreadCount\">0 New</span>
                                    </li>
                                    <li id=\"notificationsContainer\"></li>
                                    <li><hr class=\"dropdown-divider m-0\"></li>
                                    <li><a class=\"dropdown-item text-center text-primary\" href=\"";
            // line 465
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("notifications_index");
            yield "\"><small><i class=\"fas fa-bell me-1\"></i>View all notifications</small></a></li>
                                </ul>
                            </li>

                            <!-- Profile Dropdown -->
                            <li class=\"nav-item dropdown\">
                                <button class=\"btn btn-outline-primary dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-user\"></i>
                                    <span class=\"d-none d-md-inline ms-2\">";
            // line 473
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 473, $this->source); })()), "user", [], "any", false, false, false, 473), "userIdentifier", [], "any", false, false, false, 473), "html", null, true);
            yield "</span>
                                    ";
            // line 474
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 475
                yield "                                        <span class=\"role-badge role-admin\">Admin</span>
                                    ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 477
                yield "                                        <span class=\"role-badge role-doctor\">Doctor</span>
                                    ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 479
                yield "                                        <span class=\"role-badge role-user\">Patient</span>
                                    ";
            }
            // line 481
            yield "                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    ";
            // line 483
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 484
                yield "                                        <li><a class=\"dropdown-item\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 484, $this->source); })()), "user", [], "any", false, false, false, 484), "id", [], "any", false, false, false, 484)]), "html", null, true);
                yield "\"><i class=\"fas fa-cog me-2\"></i>Settings</a></li>
                                    ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 486
                yield "                                        <li><a class=\"dropdown-item\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 486, $this->source); })()), "user", [], "any", false, false, false, 486), "id", [], "any", false, false, false, 486)]), "html", null, true);
                yield "\"><i class=\"fas fa-cog me-2\"></i>Settings</a></li>
                                    ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 488
                yield "                                        <li><a class=\"dropdown-item\" href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 488, $this->source); })()), "user", [], "any", false, false, false, 488), "id", [], "any", false, false, false, 488)]), "html", null, true);
                yield "\"><i class=\"fas fa-cog me-2\"></i>Settings</a></li>
                                    ";
            }
            // line 490
            yield "                                    <li><hr class=\"dropdown-divider\"></li>
                                    <li><a class=\"dropdown-item text-danger\" href=\"";
            // line 491
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("logout");
            yield "\"><i class=\"fas fa-sign-out-alt me-2\"></i>Logout</a></li>
                                </ul>
                            </li>

                        ";
        } else {
            // line 496
            yield "                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"";
            // line 497
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login");
            yield "\">
                                    <i class=\"fas fa-sign-in-alt\"></i> <span>Login</span>
                                </a>
                            </li>
                            <li class=\"nav-item\">
                                <a href=\"";
            // line 502
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("register");
            yield "\" class=\"btn btn-primary btn-sm\">
                                    <i class=\"fas fa-user-plus me-1\"></i> <span>Register</span>
                                </a>
                            </li>
                        ";
        }
        // line 507
        yield "                    </ul>
                </div>
            </div>
        </nav>

        <!-- Professional Sidebar -->
        ";
        // line 513
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 513, $this->source); })()), "user", [], "any", false, false, false, 513)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 514
            yield "        <aside class=\"sidebar\" id=\"sidebar\">
            <div class=\"sidebar-logo\">
                <a href=\"";
            // line 516
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
            yield "\">
                    <img src=\"";
            // line 517
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/colored-logo.png"), "html", null, true);
            yield "\" alt=\"PinkShield\">
                    <span>PinkShield</span>
                </a>
            </div>

            ";
            // line 522
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 523
                yield "                <div class=\"sidebar-section\">
                    <div class=\"sidebar-section-title\">Administration</div>
                    <nav class=\"sidebar-nav\">
                        <a class=\"sidebar-link ";
                // line 526
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 526, $this->source); })()), "request", [], "any", false, false, false, 526), "attributes", [], "any", false, false, false, 526), "get", ["_route"], "method", false, false, false, 526) == "admin_dashboard")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
                yield "\">
                            <i class=\"fas fa-chart-line\"></i> Dashboard
                        </a>
                        <a class=\"sidebar-link\" href=\"";
                // line 529
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_index");
                yield "\">
                            <i class=\"fas fa-users\"></i> Users
                        </a>
                        <a class=\"sidebar-link\" href=\"";
                // line 532
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_index");
                yield "\">
                            <i class=\"fas fa-stethoscope\"></i> Doctors
                        </a>
                        <a class=\"sidebar-link\" href=\"";
                // line 535
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
                yield "\">
                            <i class=\"fas fa-calendar\"></i> Appointments
                        </a>
                        <a class=\"sidebar-link\" href=\"";
                // line 538
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index");
                yield "\">
                            <i class=\"fas fa-newspaper\"></i> Blog
                        </a>
                    </nav>
                </div>

            ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_DOCTOR")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 545
                yield "                <div class=\"sidebar-section\">
                    <div class=\"sidebar-section-title\">Doctor</div>
                    <nav class=\"sidebar-nav\">
                        <a class=\"sidebar-link ";
                // line 548
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 548, $this->source); })()), "request", [], "any", false, false, false, 548), "attributes", [], "any", false, false, false, 548), "get", ["_route"], "method", false, false, false, 548) == "doctor_dashboard")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("doctor_dashboard");
                yield "\">
                            <i class=\"fas fa-chart-line\"></i> Dashboard
                        </a>
                        <a class=\"sidebar-link ";
                // line 551
                if ((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 551, $this->source); })()), "request", [], "any", false, false, false, 551), "attributes", [], "any", false, false, false, 551), "get", ["_route"], "method", false, false, false, 551)) && is_string($_v1 = "appointment_") && str_starts_with($_v0, $_v1))) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
                yield "\">
                            <i class=\"fas fa-calendar\"></i> Appointments
                        </a>
                        <a class=\"sidebar-link ";
                // line 554
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 554, $this->source); })()), "request", [], "any", false, false, false, 554), "attributes", [], "any", false, false, false, 554), "get", ["_route"], "method", false, false, false, 554) == "parapharmacy_index")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("parapharmacy_index");
                yield "\">
                            <i class=\"fas fa-pills\"></i> Parapharmacy
                        </a>
                        <a class=\"sidebar-link\" href=\"";
                // line 557
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index");
                yield "\">
                            <i class=\"fas fa-comments\"></i> Forum
                        </a>
                    </nav>
                </div>

            ";
            } elseif ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 564
                yield "                <div class=\"sidebar-section\">
                    <div class=\"sidebar-section-title\">Patient Dashboard</div>
                    <nav class=\"sidebar-nav\">
                        <a class=\"sidebar-link ";
                // line 567
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 567, $this->source); })()), "request", [], "any", false, false, false, 567), "attributes", [], "any", false, false, false, 567), "get", ["_route"], "method", false, false, false, 567) == "user_dashboard")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_dashboard");
                yield "\">
                            <i class=\"fas fa-home\"></i> Home
                        </a>
                        <a class=\"sidebar-link ";
                // line 570
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 570, $this->source); })()), "request", [], "any", false, false, false, 570), "attributes", [], "any", false, false, false, 570), "get", ["_route"], "method", false, false, false, 570) == "notifications_index")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("notifications_index");
                yield "\">
                            <i class=\"fas fa-bell\"></i> Notifications
                        </a>
                        <a class=\"sidebar-link ";
                // line 573
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 573, $this->source); })()), "request", [], "any", false, false, false, 573), "attributes", [], "any", false, false, false, 573), "get", ["_route"], "method", false, false, false, 573) == "tracking_index")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("tracking_index");
                yield "\">
                            <i class=\"fas fa-heartbeat\"></i> Health Tracking
                        </a>
                        <a class=\"sidebar-link ";
                // line 576
                if ((is_string($_v2 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 576, $this->source); })()), "request", [], "any", false, false, false, 576), "attributes", [], "any", false, false, false, 576), "get", ["_route"], "method", false, false, false, 576)) && is_string($_v3 = "appointment_") && str_starts_with($_v2, $_v3))) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointment_index");
                yield "\">
                            <i class=\"fas fa-calendar\"></i> Appointments
                        </a>
                        <a class=\"sidebar-link ";
                // line 579
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 579, $this->source); })()), "request", [], "any", false, false, false, 579), "attributes", [], "any", false, false, false, 579), "get", ["_route"], "method", false, false, false, 579) == "parapharmacy_index")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("parapharmacy_index");
                yield "\">
                            <i class=\"fas fa-pills\"></i> Pharmacy
                        </a>
                        <a class=\"sidebar-link ";
                // line 582
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 582, $this->source); })()), "request", [], "any", false, false, false, 582), "attributes", [], "any", false, false, false, 582), "get", ["_route"], "method", false, false, false, 582) == "wishlist_index")) {
                    yield "active";
                }
                yield "\" href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("wishlist_index");
                yield "\">
                            <i class=\"fas fa-heart\"></i> My Wishlist
                        </a>
                        <a class=\"sidebar-link\" href=\"";
                // line 585
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_index");
                yield "\">
                            <i class=\"fas fa-book\"></i> Blog
                        </a>
                    </nav>
                </div>
            ";
            }
            // line 591
            yield "        </aside>
        ";
        }
        // line 593
        yield "
        <!-- Main Content -->
        <main>
            <div class=\"container-desktop\">
                <!-- Flash Messages -->
                ";
        // line 598
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 598, $this->source); })()), "flashes", [], "any", false, false, false, 598));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 599
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 600
                yield "                        <div class=\"alert alert-";
                yield ((($context["label"] == "error")) ? ("danger") : (((($context["label"] == "success")) ? ("success") : ("warning"))));
                yield " alert-dismissible fade show mb-4\" role=\"alert\">
                            <div>
                                ";
                // line 602
                if (($context["label"] == "error")) {
                    yield "<i class=\"fas fa-exclamation-circle\"></i>
                                ";
                } elseif ((                // line 603
$context["label"] == "success")) {
                    yield "<i class=\"fas fa-check-circle\"></i>
                                ";
                } else {
                    // line 604
                    yield "<i class=\"fas fa-info-circle\"></i>";
                }
                // line 605
                yield "                            </div>
                            <div>";
                // line 606
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "</div>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 610
            yield "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 611
        yield "
                ";
        // line 612
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 613
        yield "            </div>
        </main>

        <!-- Scripts -->
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
        <script>
            document.querySelectorAll('.navbar-collapse a:not(.dropdown-toggle)').forEach(link => {
                link.addEventListener('click', function() {
                    const collapse = document.querySelector('.navbar-collapse');
                    if (collapse?.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(collapse)?.hide();
                    }
                });
            });

            // Load notifications
            function loadNotifications() {
                // Only load if user is authenticated (check if notification elements exist)
                const badgeEl = document.getElementById('notificationBadge');
                if (!badgeEl) return;

                fetch('";
        // line 634
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("notifications_api_list");
        yield "')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to load notifications');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data || !data.notifications) return;
                        
                        const unreadCountEl = document.getElementById('unreadCount');
                        const containerEl = document.getElementById('notificationsContainer');

                        badgeEl.textContent = data.unreadCount > 0 ? data.unreadCount : '0';
                        unreadCountEl.textContent = data.unreadCount + (data.unreadCount === 1 ? ' New' : ' New');

                        if (data.notifications.length === 0) {
                            containerEl.innerHTML = '<li class=\"dropdown-item text-center text-muted\"><small>No notifications</small></li>';
                        } else {
                            containerEl.innerHTML = data.notifications.slice(0, 5).map(notif => `
                                <li class=\"dropdown-item \${notif.isRead ? '' : 'fw-bold'}\">
                                    <div class=\"notification-item\">
                                        <div class=\"notification-icon\">
                                            <i class=\"\${notif.icon}\"></i>
                                        </div>
                                        <div class=\"notification-content\">
                                            <small><strong>\${notif.title}</strong></small>
                                            <small class=\"text-muted\">\${notif.createdAt}</small>
                                        </div>
                                    </div>
                                </li>
                            `).join('');
                        }
                    })
                    .catch(error => console.log('Notifications unavailable:', error));
            }

            // Load notifications on page load
            ";
        // line 672
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 672, $this->source); })()), "user", [], "any", false, false, false, 672)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 673
            yield "            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', loadNotifications);
            } else {
                loadNotifications();
            }

            // Refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);
            ";
        }
        // line 682
        yield "        </script>
    </body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "PinkShield - Medical Management System";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 12
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 612
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  1010 => 612,  994 => 12,  978 => 11,  961 => 7,  950 => 682,  939 => 673,  937 => 672,  896 => 634,  873 => 613,  871 => 612,  868 => 611,  862 => 610,  852 => 606,  849 => 605,  846 => 604,  841 => 603,  837 => 602,  831 => 600,  826 => 599,  822 => 598,  815 => 593,  811 => 591,  802 => 585,  792 => 582,  782 => 579,  772 => 576,  762 => 573,  752 => 570,  742 => 567,  737 => 564,  727 => 557,  717 => 554,  707 => 551,  697 => 548,  692 => 545,  682 => 538,  676 => 535,  670 => 532,  664 => 529,  654 => 526,  649 => 523,  647 => 522,  639 => 517,  635 => 516,  631 => 514,  629 => 513,  621 => 507,  613 => 502,  605 => 497,  602 => 496,  594 => 491,  591 => 490,  585 => 488,  579 => 486,  573 => 484,  571 => 483,  567 => 481,  563 => 479,  559 => 477,  555 => 475,  553 => 474,  549 => 473,  538 => 465,  523 => 452,  521 => 451,  508 => 441,  504 => 440,  75 => 13,  72 => 12,  70 => 11,  64 => 8,  60 => 7,  56 => 6,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"csrf-token\" content=\"{{ csrf_token('') }}\">
        <title>{% block title %}PinkShield - Medical Management System{% endblock %}</title>
        <link rel=\"icon\" href=\"{{ asset('images/colored-logo.png') }}\">
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\">
        {% block stylesheets %}{% endblock %}
        {% block javascripts %}{% endblock %}
        <style>
            :root {
                --primary: #C41E3A;
                --primary-dark: #8B1428;
                --secondary: #dc2626;
                --light-bg: #f9fafb;
                --border: #e5e7eb;
                --text-dark: #1f2937;
                --text-gray: #6b7280;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html, body {
                height: 100%;
            }

            body {
                background-color: var(--light-bg);
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
                color: var(--text-dark);
                line-height: 1.6;
                display: flex;
                flex-direction: column;
            }

            /* Navbar Styling */
            .navbar {
                background: #FFF0F2;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                border-bottom: 2px solid #FFD6E0;
                padding: 1rem 0;
                position: sticky;
                top: 0;
                z-index: 1030;
            }

            .navbar-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 700;
                color: var(--primary) !important;
                font-size: 1.25rem;
                letter-spacing: -0.3px;
                text-decoration: none;
            }

            .navbar-brand img {
                height: 32px;
                width: auto;
            }

            .nav-link {
                color: var(--text-gray) !important;
                font-weight: 500;
                font-size: 0.95rem;
                padding: 0.5rem 1rem !important;
                border-radius: 6px;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .nav-link:hover {
                color: var(--primary) !important;
                background-color: rgba(196, 30, 58, 0.05);
            }

            .nav-link.active {
                color: var(--primary) !important;
                background-color: rgba(196, 30, 58, 0.1);
                font-weight: 600;
            }

            .navbar-toggler {
                border: none;
            }

            .navbar-toggler:focus {
                box-shadow: none;
            }

            .dropdown-menu {
                border: 1px solid var(--border);
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                border-radius: 8px;
                margin-top: 8px;
            }

            .dropdown-item {
                color: var(--text-dark);
                font-weight: 500;
                padding: 0.7rem 1rem;
                transition: all 0.2s;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .dropdown-item:hover {
                background-color: rgba(196, 30, 58, 0.05);
                color: var(--primary);
            }

            .btn-primary {
                background-color: var(--primary);
                border-color: var(--primary);
                font-weight: 600;
                padding: 0.5rem 1.2rem;
                border-radius: 6px;
                transition: all 0.2s;
            }

            .btn-primary:hover {
                background-color: var(--primary-dark);
                border-color: var(--primary-dark);
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
            }

            .btn-outline-primary {
                color: var(--primary);
                border-color: var(--primary);
                font-weight: 600;
            }

            .btn-outline-primary:hover {
                background-color: var(--primary);
                border-color: var(--primary);
            }

            /* Role Badge */
            .role-badge {
                display: inline-block;
                padding: 0.25rem 0.7rem;
                border-radius: 6px;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.4px;
                margin-left: 8px;
            }

            .role-admin {
                background: rgba(196, 30, 58, 0.15);
                color: var(--primary);
            }

            .role-doctor {
                background: rgba(34, 197, 94, 0.15);
                color: #16a34a;
            }

            .role-user {
                background: rgba(59, 130, 246, 0.15);
                color: #3b82f6;
            }

            /* Notification Badge */
            .notification-badge {
                position: relative;
                display: flex;
                align-items: center;
                cursor: pointer;
                font-size: 1.3rem;
                color: var(--text-gray);
                transition: all 0.2s ease;
                padding: 8px 12px;
                border-radius: 8px;
            }

            .notification-badge:hover {
                color: var(--primary);
                background-color: rgba(196, 30, 58, 0.05);
            }

            .notification-badge .badge {
                position: absolute;
                top: 0;
                right: 0;
                background-color: #ef4444;
                color: white;
                font-size: 0.65rem;
                padding: 0.25rem 0.5rem;
                border-radius: 10px;
                font-weight: 700;
                min-width: 20px;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.7;
                }
            }

            .notification-dropdown {
                min-width: 380px !important;
            }

            .notification-dropdown .dropdown-header {
                background-color: rgba(196, 30, 58, 0.05);
                color: var(--primary);
                font-weight: 700;
                padding: 1rem;
                border-radius: 8px 8px 0 0;
            }

            .notification-dropdown .dropdown-item {
                padding: 0.9rem 1rem;
                border-bottom: 1px solid var(--border);
                white-space: normal;
            }

            .notification-dropdown .dropdown-item:last-child {
                border-bottom: none;
                border-radius: 0 0 8px 8px;
            }

            .notification-item {
                display: flex;
                align-items: flex-start;
                gap: 10px;
            }

            .notification-icon {
                font-size: 1.1rem;
                color: var(--primary);
                flex-shrink: 0;
                margin-top: 2px;
            }

            .notification-content {
                flex: 1;
            }

            .notification-content small {
                display: block;
                line-height: 1.4;
            }

            /* Sidebar */
            .sidebar {
                background: #FFF0F2;
                border-right: 2px solid #FFD6E0;
                position: fixed;
                left: 0;
                top: 60px;
                width: 260px;
                height: calc(100vh - 60px);
                overflow-y: auto;
                padding: 0;
                z-index: 1020;
            }

            .sidebar-logo {
                padding: 24px 20px;
                border-bottom: 2px solid #FFD6E0;
                text-align: center;
            }

            .sidebar-logo a {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                text-decoration: none;
            }

            .sidebar-logo img {
                height: 40px;
                width: auto;
            }

            .sidebar-logo span {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--primary);
            }

            .sidebar-section {
                padding: 20px 0;
            }

            .sidebar-section-title {
                padding: 0 20px;
                margin-bottom: 10px;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: var(--text-gray);
            }

            .sidebar-nav {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 10px 20px;
                color: var(--text-gray);
                text-decoration: none;
                font-weight: 500;
                font-size: 0.95rem;
                transition: all 0.2s;
                border-left: 3px solid transparent;
            }

            .sidebar-link:hover {
                color: var(--primary);
                background-color: rgba(196, 30, 58, 0.05);
                border-left-color: var(--primary);
            }

            .sidebar-link.active {
                color: var(--primary);
                background-color: rgba(196, 30, 58, 0.1);
                border-left-color: var(--primary);
                font-weight: 600;
            }

            .sidebar-link i {
                width: 20px;
                text-align: center;
            }

            /* Main Content */
            main {
                flex: 1;
                margin-left: 260px;
                margin-top: 60px;
                overflow-y: auto;
            }

            .container-desktop {
                max-width: 1200px;
                margin: 0 auto;
                padding: 40px 30px;
                width: 100%;
            }

            /* Alert Styling */
            .alert {
                border: none;
                border-radius: 8px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 12px;
                border-left: 4px solid;
            }

            .alert-success {
                background-color: #dcfce7;
                color: #166534;
                border-left-color: #22c55e;
            }

            .alert-danger {
                background-color: #fee2e2;
                color: #b91c1c;
                border-left-color: #ef4444;
            }

            .alert-warning {
                background-color: #fef3c7;
                color: #b45309;
                border-left-color: #f59e0b;
            }

            .alert-info {
                background-color: #dbeafe;
                color: #1e40af;
                border-left-color: #3b82f6;
            }

            /* Responsive */
            @media (max-width: 991px) {
                .sidebar {
                    width: 0;
                    transform: translateX(-100%);
                    transition: all 0.3s ease;
                }

                .sidebar.show {
                    width: 260px;
                    transform: translateX(0);
                }

                main {
                    margin-left: 0;
                }
            }

            @media (max-width: 768px) {
                .container-desktop {
                    padding: 20px 15px;
                }

                .navbar-brand span {
                    display: none;
                }

                .nav-link span {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <!-- Professional Navbar -->
        <nav class=\"navbar navbar-expand-lg\">
            <div class=\"container-fluid px-4\">
                <a class=\"navbar-brand\" href=\"{{ path('home') }}\">
                    <img src=\"{{ asset('images/colored-logo.png') }}\" alt=\"PinkShield\">
                    <span>PinkShield</span>
                </a>

                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\" aria-label=\"Toggle navigation\">
                    <i class=\"fas fa-bars\"></i>
                </button>

                <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                    <ul class=\"navbar-nav ms-auto align-items-center gap-2\">
                        {% if app.user %}
                            <!-- Notification Bell -->
                            <li class=\"nav-item dropdown\">
                                <button class=\"btn btn-link nav-link notification-badge p-0\" type=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" id=\"notificationBell\">
                                    <i class=\"fas fa-bell\"></i>
                                    <span class=\"badge\" id=\"notificationBadge\">0</span>
                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-end notification-dropdown\" id=\"notificationDropdown\">
                                    <li class=\"dropdown-header fw-bold\">
                                        <i class=\"fas fa-bell me-2\"></i>Notifications
                                        <span class=\"badge bg-danger float-end\" id=\"unreadCount\">0 New</span>
                                    </li>
                                    <li id=\"notificationsContainer\"></li>
                                    <li><hr class=\"dropdown-divider m-0\"></li>
                                    <li><a class=\"dropdown-item text-center text-primary\" href=\"{{ path('notifications_index') }}\"><small><i class=\"fas fa-bell me-1\"></i>View all notifications</small></a></li>
                                </ul>
                            </li>

                            <!-- Profile Dropdown -->
                            <li class=\"nav-item dropdown\">
                                <button class=\"btn btn-outline-primary dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-user\"></i>
                                    <span class=\"d-none d-md-inline ms-2\">{{ app.user.userIdentifier }}</span>
                                    {% if is_granted('ROLE_ADMIN') %}
                                        <span class=\"role-badge role-admin\">Admin</span>
                                    {% elseif is_granted('ROLE_DOCTOR') %}
                                        <span class=\"role-badge role-doctor\">Doctor</span>
                                    {% elseif is_granted('ROLE_USER') %}
                                        <span class=\"role-badge role-user\">Patient</span>
                                    {% endif %}
                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    {% if is_granted('ROLE_ADMIN') %}
                                        <li><a class=\"dropdown-item\" href=\"{{ path('admin_edit', {id: app.user.id}) }}\"><i class=\"fas fa-cog me-2\"></i>Settings</a></li>
                                    {% elseif is_granted('ROLE_DOCTOR') %}
                                        <li><a class=\"dropdown-item\" href=\"{{ path('doctor_edit', {id: app.user.id}) }}\"><i class=\"fas fa-cog me-2\"></i>Settings</a></li>
                                    {% elseif is_granted('ROLE_USER') %}
                                        <li><a class=\"dropdown-item\" href=\"{{ path('user_edit', {id: app.user.id}) }}\"><i class=\"fas fa-cog me-2\"></i>Settings</a></li>
                                    {% endif %}
                                    <li><hr class=\"dropdown-divider\"></li>
                                    <li><a class=\"dropdown-item text-danger\" href=\"{{ path('logout') }}\"><i class=\"fas fa-sign-out-alt me-2\"></i>Logout</a></li>
                                </ul>
                            </li>

                        {% else %}
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"{{ path('login') }}\">
                                    <i class=\"fas fa-sign-in-alt\"></i> <span>Login</span>
                                </a>
                            </li>
                            <li class=\"nav-item\">
                                <a href=\"{{ path('register') }}\" class=\"btn btn-primary btn-sm\">
                                    <i class=\"fas fa-user-plus me-1\"></i> <span>Register</span>
                                </a>
                            </li>
                        {% endif %}
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Professional Sidebar -->
        {% if app.user %}
        <aside class=\"sidebar\" id=\"sidebar\">
            <div class=\"sidebar-logo\">
                <a href=\"{{ path('home') }}\">
                    <img src=\"{{ asset('images/colored-logo.png') }}\" alt=\"PinkShield\">
                    <span>PinkShield</span>
                </a>
            </div>

            {% if is_granted('ROLE_ADMIN') %}
                <div class=\"sidebar-section\">
                    <div class=\"sidebar-section-title\">Administration</div>
                    <nav class=\"sidebar-nav\">
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'admin_dashboard' %}active{% endif %}\" href=\"{{ path('admin_dashboard') }}\">
                            <i class=\"fas fa-chart-line\"></i> Dashboard
                        </a>
                        <a class=\"sidebar-link\" href=\"{{ path('user_index') }}\">
                            <i class=\"fas fa-users\"></i> Users
                        </a>
                        <a class=\"sidebar-link\" href=\"{{ path('doctor_index') }}\">
                            <i class=\"fas fa-stethoscope\"></i> Doctors
                        </a>
                        <a class=\"sidebar-link\" href=\"{{ path('appointment_index') }}\">
                            <i class=\"fas fa-calendar\"></i> Appointments
                        </a>
                        <a class=\"sidebar-link\" href=\"{{ path('blog_index') }}\">
                            <i class=\"fas fa-newspaper\"></i> Blog
                        </a>
                    </nav>
                </div>

            {% elseif is_granted('ROLE_DOCTOR') %}
                <div class=\"sidebar-section\">
                    <div class=\"sidebar-section-title\">Doctor</div>
                    <nav class=\"sidebar-nav\">
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'doctor_dashboard' %}active{% endif %}\" href=\"{{ path('doctor_dashboard') }}\">
                            <i class=\"fas fa-chart-line\"></i> Dashboard
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') starts with 'appointment_' %}active{% endif %}\" href=\"{{ path('appointment_index') }}\">
                            <i class=\"fas fa-calendar\"></i> Appointments
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'parapharmacy_index' %}active{% endif %}\" href=\"{{ path('parapharmacy_index') }}\">
                            <i class=\"fas fa-pills\"></i> Parapharmacy
                        </a>
                        <a class=\"sidebar-link\" href=\"{{ path('blog_index') }}\">
                            <i class=\"fas fa-comments\"></i> Forum
                        </a>
                    </nav>
                </div>

            {% elseif is_granted('ROLE_USER') %}
                <div class=\"sidebar-section\">
                    <div class=\"sidebar-section-title\">Patient Dashboard</div>
                    <nav class=\"sidebar-nav\">
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'user_dashboard' %}active{% endif %}\" href=\"{{ path('user_dashboard') }}\">
                            <i class=\"fas fa-home\"></i> Home
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'notifications_index' %}active{% endif %}\" href=\"{{ path('notifications_index') }}\">
                            <i class=\"fas fa-bell\"></i> Notifications
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'tracking_index' %}active{% endif %}\" href=\"{{ path('tracking_index') }}\">
                            <i class=\"fas fa-heartbeat\"></i> Health Tracking
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') starts with 'appointment_' %}active{% endif %}\" href=\"{{ path('appointment_index') }}\">
                            <i class=\"fas fa-calendar\"></i> Appointments
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'parapharmacy_index' %}active{% endif %}\" href=\"{{ path('parapharmacy_index') }}\">
                            <i class=\"fas fa-pills\"></i> Pharmacy
                        </a>
                        <a class=\"sidebar-link {% if app.request.attributes.get('_route') == 'wishlist_index' %}active{% endif %}\" href=\"{{ path('wishlist_index') }}\">
                            <i class=\"fas fa-heart\"></i> My Wishlist
                        </a>
                        <a class=\"sidebar-link\" href=\"{{ path('blog_index') }}\">
                            <i class=\"fas fa-book\"></i> Blog
                        </a>
                    </nav>
                </div>
            {% endif %}
        </aside>
        {% endif %}

        <!-- Main Content -->
        <main>
            <div class=\"container-desktop\">
                <!-- Flash Messages -->
                {% for label, messages in app.flashes %}
                    {% for message in messages %}
                        <div class=\"alert alert-{{ label == 'error' ? 'danger' : (label == 'success' ? 'success' : 'warning') }} alert-dismissible fade show mb-4\" role=\"alert\">
                            <div>
                                {% if label == 'error' %}<i class=\"fas fa-exclamation-circle\"></i>
                                {% elseif label == 'success' %}<i class=\"fas fa-check-circle\"></i>
                                {% else %}<i class=\"fas fa-info-circle\"></i>{% endif %}
                            </div>
                            <div>{{ message }}</div>
                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                        </div>
                    {% endfor %}
                {% endfor %}

                {% block body %}{% endblock %}
            </div>
        </main>

        <!-- Scripts -->
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
        <script>
            document.querySelectorAll('.navbar-collapse a:not(.dropdown-toggle)').forEach(link => {
                link.addEventListener('click', function() {
                    const collapse = document.querySelector('.navbar-collapse');
                    if (collapse?.classList.contains('show')) {
                        bootstrap.Collapse.getInstance(collapse)?.hide();
                    }
                });
            });

            // Load notifications
            function loadNotifications() {
                // Only load if user is authenticated (check if notification elements exist)
                const badgeEl = document.getElementById('notificationBadge');
                if (!badgeEl) return;

                fetch('{{ path('notifications_api_list') }}')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to load notifications');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data || !data.notifications) return;
                        
                        const unreadCountEl = document.getElementById('unreadCount');
                        const containerEl = document.getElementById('notificationsContainer');

                        badgeEl.textContent = data.unreadCount > 0 ? data.unreadCount : '0';
                        unreadCountEl.textContent = data.unreadCount + (data.unreadCount === 1 ? ' New' : ' New');

                        if (data.notifications.length === 0) {
                            containerEl.innerHTML = '<li class=\"dropdown-item text-center text-muted\"><small>No notifications</small></li>';
                        } else {
                            containerEl.innerHTML = data.notifications.slice(0, 5).map(notif => `
                                <li class=\"dropdown-item \${notif.isRead ? '' : 'fw-bold'}\">
                                    <div class=\"notification-item\">
                                        <div class=\"notification-icon\">
                                            <i class=\"\${notif.icon}\"></i>
                                        </div>
                                        <div class=\"notification-content\">
                                            <small><strong>\${notif.title}</strong></small>
                                            <small class=\"text-muted\">\${notif.createdAt}</small>
                                        </div>
                                    </div>
                                </li>
                            `).join('');
                        }
                    })
                    .catch(error => console.log('Notifications unavailable:', error));
            }

            // Load notifications on page load
            {% if app.user %}
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', loadNotifications);
            } else {
                loadNotifications();
            }

            // Refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);
            {% endif %}
        </script>
    </body>
</html>
", "base.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\base.html.twig");
    }
}
