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

/* auth/register_doctor.html.twig */
class __TwigTemplate_d2069449ae28ce5004a41e4da45e4dbd extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "auth/register_doctor.html.twig"));

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

        yield "Register as Doctor - PinkShield";
        
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
    body {
        background: white !important;
        background-attachment: fixed !important;
        min-height: 100vh;
    }

    .navbar {
        background: rgba(255, 255, 255, 0.95) !important;
    }

    aside.sidebar {
        display: none !important;
    }

    main {
        margin-left: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px !important;
        padding-top: 100px !important;
        min-height: 100vh;
    }

    .container-desktop {
        max-width: 100% !important;
        padding: 0 !important;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-doctor-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
    }

    .register-doctor-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        max-width: 1100px;
        width: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .register-doctor-branding {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .register-doctor-branding h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 20px 0 10px;
        letter-spacing: -0.5px;
    }

    .register-doctor-branding p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
    }

    .logo-svg {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.15));
    }

    .benefits {
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
    }

    .benefit-item i {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .register-doctor-form-wrapper {
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        max-height: auto;
        overflow-y: visible;
    }

    .button-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 25px;
    }

    .register-doctor-form-wrapper h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-label {
        margin-bottom: 5px !important;
    }

    .form-control, .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f9fafb;
        width: 100%;
    }

    .form-control::placeholder {
        color: #d1d5db;
    }

    .form-control:focus, .form-select:focus {
        border-color: #C41E3A;
        box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        outline: none;
        background-color: white;
    }

    .form-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .form-label i {
        color: #C41E3A;
        font-size: 1rem;
        width: 16px;
    }

    .btn-register-doctor {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-top: 25px;
        font-size: 0.95rem;
        display: inline-block;
        text-align: center;
        width: 100%;
        border: none;
        cursor: pointer;
    }

    .btn-register-doctor:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(196, 30, 58, 0.35);
        text-decoration: none;
    }

    .btn-back {
        background-color: #f3f4f6;
        border: 2px solid #C41E3A;
        color: #C41E3A;
        text-decoration: none;
        font-weight: 600;
        padding: 11px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
        width: 100%;
        text-align: center;
        margin-top: 12px;
    }

    .btn-back:hover {
        background-color: #C41E3A;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
    }

    .login-section {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e5e7eb;
        text-align: center;
    }

    .login-section p {
        color: #6b7280;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .btn-login {
        background-color: #f3f4f6;
        border: 2px solid #C41E3A;
        color: #C41E3A;
        text-decoration: none;
        font-weight: 600;
        padding: 11px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
    }

    .btn-login:hover {
        background-color: #C41E3A;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
    }

    .alert {
        margin-bottom: 20px;
        border: none;
        border-radius: 8px;
        border-left: 4px solid #ef4444;
        background-color: #fee2e2;
        color: #7f1d1d;
        padding: 12px 15px;
    }

    .alert-dismissible .btn-close {
        padding: 0.5rem;
    }

    .invalid-feedback {
        display: block !important;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
        font-weight: 500;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .form-select.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    @media (max-width: 768px) {
        main {
            min-height: calc(100vh - 50px);
        }

        .register-doctor-container {
            grid-template-columns: 1fr;
        }

        .register-doctor-branding {
            padding: 35px 25px;
            order: 2;
        }

        .register-doctor-form-wrapper {
            padding: 35px 25px;
            order: 1;
        }

        .register-doctor-branding h2 {
            font-size: 1.8rem;
        }

        .benefits {
            display: none;
        }

        .register-doctor-wrapper {
            padding: 15px;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 337
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 338
        yield "<div class=\"register-doctor-wrapper\">
    <div class=\"register-doctor-container\">
        <!-- Left Side - Branding -->
        <div class=\"register-doctor-branding\">
            <svg class=\"logo-svg\" viewBox=\"0 0 200 200\" xmlns=\"http://www.w3.org/2000/svg\">
                <!-- Shield shape with heart -->
                <defs>
                    <linearGradient id=\"shieldGradient\" x1=\"0%\" y1=\"0%\" x2=\"100%\" y2=\"100%\">
                        <stop offset=\"0%\" style=\"stop-color:#FFB6C1;stop-opacity:1\" />
                        <stop offset=\"100%\" style=\"stop-color:#FF69B4;stop-opacity:1\" />
                    </linearGradient>
                </defs>
                <!-- Outer shield -->
                <path d=\"M 100 20 C 100 20 60 40 60 90 C 60 130 100 170 100 170 C 100 170 140 130 140 90 C 140 40 100 20 100 20 Z\" 
                      fill=\"none\" stroke=\"#C41E3A\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>
                <!-- Inner shield -->
                <path d=\"M 100 25 C 100 25 65 42 65 90 C 65 127 100 162 100 162 C 100 162 135 127 135 90 C 135 42 100 25 100 25 Z\" 
                      fill=\"url(#shieldGradient)\" opacity=\"0.8\"/>
                <!-- Heart inside shield -->
                <path d=\"M 100 75 C 100 75 92 68 86 68 C 80 68 76 72 76 78 C 76 85 85 95 100 110 C 115 95 124 85 124 78 C 124 72 120 68 114 68 C 108 68 100 75 100 75 Z\" 
                      fill=\"white\" stroke=\"white\" stroke-width=\"1\"/>
            </svg>
            <h2>PinkShield</h2>
            <p>Medical Care Management System</p>
            
            <div class=\"benefits\">
                <div class=\"benefit-item\">
                    <i class=\"fas fa-shield-alt\"></i>
                    <span>Secure & Encrypted</span>
                </div>
                <div class=\"benefit-item\">
                    <i class=\"fas fa-lock\"></i>
                    <span>Privacy Protected</span>
                </div>
                <div class=\"benefit-item\">
                    <i class=\"fas fa-clock\"></i>
                    <span>24/7 Access</span>
                </div>
                <div class=\"benefit-item\">
                    <i class=\"fas fa-stethoscope\"></i>
                    <span>Doctor Network</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Doctor Registration Form -->
        <div class=\"register-doctor-form-wrapper\">
            <h3><i class=\"fas fa-stethoscope me-2\"></i> Doctor Registration</h3>

            ";
        // line 387
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 387, $this->source); })()), 'form_start', ["attr" => ["novalidate" => "novalidate"]]);
        yield "
            ";
        // line 388
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 388, $this->source); })()), "_token", [], "any", false, false, false, 388), 'widget');
        yield "
                ";
        // line 389
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 389, $this->source); })()), "vars", [], "any", false, false, false, 389), "errors", [], "any", false, false, false, 389)) > 0)) {
            // line 390
            yield "                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                        <strong><i class=\"fas fa-exclamation-circle me-2\"></i> Please fix the following errors:</strong>
                        <ul class=\"mb-0 mt-2\">
                            ";
            // line 393
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 393, $this->source); })()), "vars", [], "any", false, false, false, 393), "errors", [], "any", false, false, false, 393));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 394
                yield "                                <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 394), "html", null, true);
                yield "</li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 396
            yield "                        </ul>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                ";
        }
        // line 400
        yield "
                <div class=\"form-group\">
                    ";
        // line 402
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 402, $this->source); })()), "email", [], "any", false, false, false, 402), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 403
        $context["emailClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 403, $this->source); })()), "email", [], "any", false, false, false, 403), "vars", [], "any", false, false, false, 403), "errors", [], "any", false, false, false, 403)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 404
        yield "                    <input type=\"text\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 404, $this->source); })()), "email", [], "any", false, false, false, 404), "vars", [], "any", false, false, false, 404), "full_name", [], "any", false, false, false, 404), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 404, $this->source); })()), "email", [], "any", false, false, false, 404), "vars", [], "any", false, false, false, 404), "id", [], "any", false, false, false, 404), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["emailClass"]) || array_key_exists("emailClass", $context) ? $context["emailClass"] : (function () { throw new RuntimeError('Variable "emailClass" does not exist.', 404, $this->source); })()), "html", null, true);
        yield "\" placeholder=\"your@email.com\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 404, $this->source); })()), "email", [], "any", false, false, false, 404), "vars", [], "any", false, false, false, 404), "value", [], "any", false, false, false, 404), "html", null, true);
        yield "\">
                    ";
        // line 405
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 405, $this->source); })()), "email", [], "any", false, false, false, 405), "vars", [], "any", false, false, false, 405), "errors", [], "any", false, false, false, 405)) > 0)) {
            // line 406
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 407
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 407, $this->source); })()), "email", [], "any", false, false, false, 407), "vars", [], "any", false, false, false, 407), "errors", [], "any", false, false, false, 407));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 408
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 408), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 410
            yield "                        </div>
                    ";
        }
        // line 412
        yield "                </div>

                <div class=\"form-group\">
                    ";
        // line 415
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 415, $this->source); })()), "fullName", [], "any", false, false, false, 415), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 416
        $context["fullNameClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 416, $this->source); })()), "fullName", [], "any", false, false, false, 416), "vars", [], "any", false, false, false, 416), "errors", [], "any", false, false, false, 416)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 417
        yield "                    <input type=\"text\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 417, $this->source); })()), "fullName", [], "any", false, false, false, 417), "vars", [], "any", false, false, false, 417), "full_name", [], "any", false, false, false, 417), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 417, $this->source); })()), "fullName", [], "any", false, false, false, 417), "vars", [], "any", false, false, false, 417), "id", [], "any", false, false, false, 417), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["fullNameClass"]) || array_key_exists("fullNameClass", $context) ? $context["fullNameClass"] : (function () { throw new RuntimeError('Variable "fullNameClass" does not exist.', 417, $this->source); })()), "html", null, true);
        yield "\" placeholder=\"Dr. Full Name\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 417, $this->source); })()), "fullName", [], "any", false, false, false, 417), "vars", [], "any", false, false, false, 417), "value", [], "any", false, false, false, 417), "html", null, true);
        yield "\">
                    ";
        // line 418
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 418, $this->source); })()), "fullName", [], "any", false, false, false, 418), "vars", [], "any", false, false, false, 418), "errors", [], "any", false, false, false, 418)) > 0)) {
            // line 419
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 420
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 420, $this->source); })()), "fullName", [], "any", false, false, false, 420), "vars", [], "any", false, false, false, 420), "errors", [], "any", false, false, false, 420));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 421
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 421), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 423
            yield "                        </div>
                    ";
        }
        // line 425
        yield "                </div>

                <div class=\"form-group\">
                    ";
        // line 428
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 428, $this->source); })()), "speciality", [], "any", false, false, false, 428), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 429
        $context["specialityClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 429, $this->source); })()), "speciality", [], "any", false, false, false, 429), "vars", [], "any", false, false, false, 429), "errors", [], "any", false, false, false, 429)) > 0)) ? ("form-select is-invalid") : ("form-select"));
        // line 430
        yield "                    <select name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 430, $this->source); })()), "speciality", [], "any", false, false, false, 430), "vars", [], "any", false, false, false, 430), "full_name", [], "any", false, false, false, 430), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 430, $this->source); })()), "speciality", [], "any", false, false, false, 430), "vars", [], "any", false, false, false, 430), "id", [], "any", false, false, false, 430), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["specialityClass"]) || array_key_exists("specialityClass", $context) ? $context["specialityClass"] : (function () { throw new RuntimeError('Variable "specialityClass" does not exist.', 430, $this->source); })()), "html", null, true);
        yield "\">
                        <option value=\"\">Select a speciality...</option>
                        ";
        // line 432
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 432, $this->source); })()), "speciality", [], "any", false, false, false, 432), "vars", [], "any", false, false, false, 432), "choices", [], "any", false, false, false, 432));
        foreach ($context['_seq'] as $context["_key"] => $context["choice"]) {
            // line 433
            yield "                            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "value", [], "any", false, false, false, 433), "html", null, true);
            yield "\" ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "value", [], "any", false, false, false, 433) == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 433, $this->source); })()), "speciality", [], "any", false, false, false, 433), "vars", [], "any", false, false, false, 433), "value", [], "any", false, false, false, 433))) {
                yield "selected";
            }
            yield ">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["choice"], "label", [], "any", false, false, false, 433), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['choice'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 435
        yield "                    </select>
                    ";
        // line 436
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 436, $this->source); })()), "speciality", [], "any", false, false, false, 436), "vars", [], "any", false, false, false, 436), "errors", [], "any", false, false, false, 436)) > 0)) {
            // line 437
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 438
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 438, $this->source); })()), "speciality", [], "any", false, false, false, 438), "vars", [], "any", false, false, false, 438), "errors", [], "any", false, false, false, 438));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 439
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 439), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 441
            yield "                        </div>
                    ";
        }
        // line 443
        yield "                </div>

                ";
        // line 445
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "address", [], "any", true, true, false, 445)) {
            // line 446
            yield "                    <div class=\"form-group\">
                        ";
            // line 447
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 447, $this->source); })()), "address", [], "any", false, false, false, 447), 'label', ["label_attr" => ["class" => "form-label"]]);
            yield "
                        ";
            // line 448
            $context["addressClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 448, $this->source); })()), "address", [], "any", false, false, false, 448), "vars", [], "any", false, false, false, 448), "errors", [], "any", false, false, false, 448)) > 0)) ? ("form-control is-invalid") : ("form-control"));
            // line 449
            yield "                        <input type=\"text\" name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 449, $this->source); })()), "address", [], "any", false, false, false, 449), "vars", [], "any", false, false, false, 449), "full_name", [], "any", false, false, false, 449), "html", null, true);
            yield "\" id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 449, $this->source); })()), "address", [], "any", false, false, false, 449), "vars", [], "any", false, false, false, 449), "id", [], "any", false, false, false, 449), "html", null, true);
            yield "\" class=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["addressClass"]) || array_key_exists("addressClass", $context) ? $context["addressClass"] : (function () { throw new RuntimeError('Variable "addressClass" does not exist.', 449, $this->source); })()), "html", null, true);
            yield "\" placeholder=\"Your address\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 449, $this->source); })()), "address", [], "any", false, false, false, 449), "vars", [], "any", false, false, false, 449), "value", [], "any", false, false, false, 449), "html", null, true);
            yield "\">
                        ";
            // line 450
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 450, $this->source); })()), "address", [], "any", false, false, false, 450), "vars", [], "any", false, false, false, 450), "errors", [], "any", false, false, false, 450)) > 0)) {
                // line 451
                yield "                            <div class=\"invalid-feedback\">
                                ";
                // line 452
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 452, $this->source); })()), "address", [], "any", false, false, false, 452), "vars", [], "any", false, false, false, 452), "errors", [], "any", false, false, false, 452));
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 453
                    yield "                                    <i class=\"fas fa-times-circle me-1\"></i>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 453), "html", null, true);
                    yield "
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 455
                yield "                            </div>
                        ";
            }
            // line 457
            yield "                    </div>
                ";
        }
        // line 459
        yield "
                ";
        // line 460
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "phone", [], "any", true, true, false, 460)) {
            // line 461
            yield "                    <div class=\"form-group\">
                        ";
            // line 462
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 462, $this->source); })()), "phone", [], "any", false, false, false, 462), 'label', ["label_attr" => ["class" => "form-label"]]);
            yield "
                        ";
            // line 463
            $context["phoneClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 463, $this->source); })()), "phone", [], "any", false, false, false, 463), "vars", [], "any", false, false, false, 463), "errors", [], "any", false, false, false, 463)) > 0)) ? ("form-control is-invalid") : ("form-control"));
            // line 464
            yield "                        <input type=\"text\" name=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 464, $this->source); })()), "phone", [], "any", false, false, false, 464), "vars", [], "any", false, false, false, 464), "full_name", [], "any", false, false, false, 464), "html", null, true);
            yield "\" id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 464, $this->source); })()), "phone", [], "any", false, false, false, 464), "vars", [], "any", false, false, false, 464), "id", [], "any", false, false, false, 464), "html", null, true);
            yield "\" class=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["phoneClass"]) || array_key_exists("phoneClass", $context) ? $context["phoneClass"] : (function () { throw new RuntimeError('Variable "phoneClass" does not exist.', 464, $this->source); })()), "html", null, true);
            yield "\" placeholder=\"+1 (555) 000-0000\" value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 464, $this->source); })()), "phone", [], "any", false, false, false, 464), "vars", [], "any", false, false, false, 464), "value", [], "any", false, false, false, 464), "html", null, true);
            yield "\">
                        ";
            // line 465
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 465, $this->source); })()), "phone", [], "any", false, false, false, 465), "vars", [], "any", false, false, false, 465), "errors", [], "any", false, false, false, 465)) > 0)) {
                // line 466
                yield "                            <div class=\"invalid-feedback\">
                                ";
                // line 467
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 467, $this->source); })()), "phone", [], "any", false, false, false, 467), "vars", [], "any", false, false, false, 467), "errors", [], "any", false, false, false, 467));
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 468
                    yield "                                    <i class=\"fas fa-times-circle me-1\"></i>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 468), "html", null, true);
                    yield "
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 470
                yield "                            </div>
                        ";
            }
            // line 472
            yield "                    </div>
                ";
        }
        // line 474
        yield "
                <div class=\"form-group\">
                    ";
        // line 476
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 476, $this->source); })()), "password", [], "any", false, false, false, 476), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 477
        $context["passwordClass"] = (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 477, $this->source); })()), "password", [], "any", false, false, false, 477), "vars", [], "any", false, false, false, 477), "errors", [], "any", false, false, false, 477)) > 0)) ? ("form-control is-invalid") : ("form-control"));
        // line 478
        yield "                    <input type=\"password\" name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 478, $this->source); })()), "password", [], "any", false, false, false, 478), "vars", [], "any", false, false, false, 478), "full_name", [], "any", false, false, false, 478), "html", null, true);
        yield "\" id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 478, $this->source); })()), "password", [], "any", false, false, false, 478), "vars", [], "any", false, false, false, 478), "id", [], "any", false, false, false, 478), "html", null, true);
        yield "\" class=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["passwordClass"]) || array_key_exists("passwordClass", $context) ? $context["passwordClass"] : (function () { throw new RuntimeError('Variable "passwordClass" does not exist.', 478, $this->source); })()), "html", null, true);
        yield "\">
                    ";
        // line 479
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 479, $this->source); })()), "password", [], "any", false, false, false, 479), "vars", [], "any", false, false, false, 479), "errors", [], "any", false, false, false, 479)) > 0)) {
            // line 480
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 481
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 481, $this->source); })()), "password", [], "any", false, false, false, 481), "vars", [], "any", false, false, false, 481), "errors", [], "any", false, false, false, 481));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 482
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 482), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 484
            yield "                        </div>
                    ";
        }
        // line 486
        yield "                </div>

                <div class=\"button-group\">
                    <button type=\"submit\" class=\"btn-register-doctor\">
                        <i class=\"fas fa-user-check me-2\"></i> Complete Registration
                    </button>
                    <a href=\"";
        // line 492
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("register");
        yield "\" class=\"btn-back\">
                        <i class=\"fas fa-arrow-left me-2\"></i> Back to Type Selection
                    </a>
                </div>
            ";
        // line 496
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 496, $this->source); })()), 'form_end', ["render_rest" => false]);
        yield "

            <div class=\"login-section\">
                <p>Already have an account?</p>
                <a href=\"";
        // line 500
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("login");
        yield "\" class=\"btn-login\">
                    <i class=\"fas fa-sign-in-alt me-2\"></i> Sign In
                </a>
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
        return "auth/register_doctor.html.twig";
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
        return array (  836 => 500,  829 => 496,  822 => 492,  814 => 486,  810 => 484,  801 => 482,  797 => 481,  794 => 480,  792 => 479,  783 => 478,  781 => 477,  777 => 476,  773 => 474,  769 => 472,  765 => 470,  756 => 468,  752 => 467,  749 => 466,  747 => 465,  736 => 464,  734 => 463,  730 => 462,  727 => 461,  725 => 460,  722 => 459,  718 => 457,  714 => 455,  705 => 453,  701 => 452,  698 => 451,  696 => 450,  685 => 449,  683 => 448,  679 => 447,  676 => 446,  674 => 445,  670 => 443,  666 => 441,  657 => 439,  653 => 438,  650 => 437,  648 => 436,  645 => 435,  630 => 433,  626 => 432,  616 => 430,  614 => 429,  610 => 428,  605 => 425,  601 => 423,  592 => 421,  588 => 420,  585 => 419,  583 => 418,  572 => 417,  570 => 416,  566 => 415,  561 => 412,  557 => 410,  548 => 408,  544 => 407,  541 => 406,  539 => 405,  528 => 404,  526 => 403,  522 => 402,  518 => 400,  512 => 396,  503 => 394,  499 => 393,  494 => 390,  492 => 389,  488 => 388,  484 => 387,  433 => 338,  423 => 337,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Register as Doctor - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    body {
        background: white !important;
        background-attachment: fixed !important;
        min-height: 100vh;
    }

    .navbar {
        background: rgba(255, 255, 255, 0.95) !important;
    }

    aside.sidebar {
        display: none !important;
    }

    main {
        margin-left: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px !important;
        padding-top: 100px !important;
        min-height: 100vh;
    }

    .container-desktop {
        max-width: 100% !important;
        padding: 0 !important;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-doctor-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
    }

    .register-doctor-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        max-width: 1100px;
        width: 100%;
        background: white;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .register-doctor-branding {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .register-doctor-branding h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 20px 0 10px;
        letter-spacing: -0.5px;
    }

    .register-doctor-branding p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
    }

    .logo-svg {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.15));
    }

    .benefits {
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
    }

    .benefit-item i {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .register-doctor-form-wrapper {
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        max-height: auto;
        overflow-y: visible;
    }

    .button-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 25px;
    }

    .register-doctor-form-wrapper h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-label {
        margin-bottom: 5px !important;
    }

    .form-control, .form-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f9fafb;
        width: 100%;
    }

    .form-control::placeholder {
        color: #d1d5db;
    }

    .form-control:focus, .form-select:focus {
        border-color: #C41E3A;
        box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        outline: none;
        background-color: white;
    }

    .form-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .form-label i {
        color: #C41E3A;
        font-size: 1rem;
        width: 16px;
    }

    .btn-register-doctor {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-top: 25px;
        font-size: 0.95rem;
        display: inline-block;
        text-align: center;
        width: 100%;
        border: none;
        cursor: pointer;
    }

    .btn-register-doctor:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(196, 30, 58, 0.35);
        text-decoration: none;
    }

    .btn-back {
        background-color: #f3f4f6;
        border: 2px solid #C41E3A;
        color: #C41E3A;
        text-decoration: none;
        font-weight: 600;
        padding: 11px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
        width: 100%;
        text-align: center;
        margin-top: 12px;
    }

    .btn-back:hover {
        background-color: #C41E3A;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
    }

    .login-section {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e5e7eb;
        text-align: center;
    }

    .login-section p {
        color: #6b7280;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .btn-login {
        background-color: #f3f4f6;
        border: 2px solid #C41E3A;
        color: #C41E3A;
        text-decoration: none;
        font-weight: 600;
        padding: 11px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: inline-block;
        font-size: 0.95rem;
    }

    .btn-login:hover {
        background-color: #C41E3A;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
    }

    .alert {
        margin-bottom: 20px;
        border: none;
        border-radius: 8px;
        border-left: 4px solid #ef4444;
        background-color: #fee2e2;
        color: #7f1d1d;
        padding: 12px 15px;
    }

    .alert-dismissible .btn-close {
        padding: 0.5rem;
    }

    .invalid-feedback {
        display: block !important;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
        font-weight: 500;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .form-select.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    @media (max-width: 768px) {
        main {
            min-height: calc(100vh - 50px);
        }

        .register-doctor-container {
            grid-template-columns: 1fr;
        }

        .register-doctor-branding {
            padding: 35px 25px;
            order: 2;
        }

        .register-doctor-form-wrapper {
            padding: 35px 25px;
            order: 1;
        }

        .register-doctor-branding h2 {
            font-size: 1.8rem;
        }

        .benefits {
            display: none;
        }

        .register-doctor-wrapper {
            padding: 15px;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"register-doctor-wrapper\">
    <div class=\"register-doctor-container\">
        <!-- Left Side - Branding -->
        <div class=\"register-doctor-branding\">
            <svg class=\"logo-svg\" viewBox=\"0 0 200 200\" xmlns=\"http://www.w3.org/2000/svg\">
                <!-- Shield shape with heart -->
                <defs>
                    <linearGradient id=\"shieldGradient\" x1=\"0%\" y1=\"0%\" x2=\"100%\" y2=\"100%\">
                        <stop offset=\"0%\" style=\"stop-color:#FFB6C1;stop-opacity:1\" />
                        <stop offset=\"100%\" style=\"stop-color:#FF69B4;stop-opacity:1\" />
                    </linearGradient>
                </defs>
                <!-- Outer shield -->
                <path d=\"M 100 20 C 100 20 60 40 60 90 C 60 130 100 170 100 170 C 100 170 140 130 140 90 C 140 40 100 20 100 20 Z\" 
                      fill=\"none\" stroke=\"#C41E3A\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>
                <!-- Inner shield -->
                <path d=\"M 100 25 C 100 25 65 42 65 90 C 65 127 100 162 100 162 C 100 162 135 127 135 90 C 135 42 100 25 100 25 Z\" 
                      fill=\"url(#shieldGradient)\" opacity=\"0.8\"/>
                <!-- Heart inside shield -->
                <path d=\"M 100 75 C 100 75 92 68 86 68 C 80 68 76 72 76 78 C 76 85 85 95 100 110 C 115 95 124 85 124 78 C 124 72 120 68 114 68 C 108 68 100 75 100 75 Z\" 
                      fill=\"white\" stroke=\"white\" stroke-width=\"1\"/>
            </svg>
            <h2>PinkShield</h2>
            <p>Medical Care Management System</p>
            
            <div class=\"benefits\">
                <div class=\"benefit-item\">
                    <i class=\"fas fa-shield-alt\"></i>
                    <span>Secure & Encrypted</span>
                </div>
                <div class=\"benefit-item\">
                    <i class=\"fas fa-lock\"></i>
                    <span>Privacy Protected</span>
                </div>
                <div class=\"benefit-item\">
                    <i class=\"fas fa-clock\"></i>
                    <span>24/7 Access</span>
                </div>
                <div class=\"benefit-item\">
                    <i class=\"fas fa-stethoscope\"></i>
                    <span>Doctor Network</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Doctor Registration Form -->
        <div class=\"register-doctor-form-wrapper\">
            <h3><i class=\"fas fa-stethoscope me-2\"></i> Doctor Registration</h3>

            {{ form_start(form, {'attr': {'novalidate': 'novalidate'}}) }}
            {{ form_widget(form._token) }}
                {% if form.vars.errors|length > 0 %}
                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                        <strong><i class=\"fas fa-exclamation-circle me-2\"></i> Please fix the following errors:</strong>
                        <ul class=\"mb-0 mt-2\">
                            {% for error in form.vars.errors %}
                                <li>{{ error.message }}</li>
                            {% endfor %}
                        </ul>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                {% endif %}

                <div class=\"form-group\">
                    {{ form_label(form.email, null, {'label_attr': {'class': 'form-label'}}) }}
                    {% set emailClass = form.email.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                    <input type=\"text\" name=\"{{ form.email.vars.full_name }}\" id=\"{{ form.email.vars.id }}\" class=\"{{ emailClass }}\" placeholder=\"your@email.com\" value=\"{{ form.email.vars.value }}\">
                    {% if form.email.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.email.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                <div class=\"form-group\">
                    {{ form_label(form.fullName, null, {'label_attr': {'class': 'form-label'}}) }}
                    {% set fullNameClass = form.fullName.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                    <input type=\"text\" name=\"{{ form.fullName.vars.full_name }}\" id=\"{{ form.fullName.vars.id }}\" class=\"{{ fullNameClass }}\" placeholder=\"Dr. Full Name\" value=\"{{ form.fullName.vars.value }}\">
                    {% if form.fullName.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.fullName.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                <div class=\"form-group\">
                    {{ form_label(form.speciality, null, {'label_attr': {'class': 'form-label'}}) }}
                    {% set specialityClass = form.speciality.vars.errors|length > 0 ? 'form-select is-invalid' : 'form-select' %}
                    <select name=\"{{ form.speciality.vars.full_name }}\" id=\"{{ form.speciality.vars.id }}\" class=\"{{ specialityClass }}\">
                        <option value=\"\">Select a speciality...</option>
                        {% for choice in form.speciality.vars.choices %}
                            <option value=\"{{ choice.value }}\" {% if choice.value == form.speciality.vars.value %}selected{% endif %}>{{ choice.label }}</option>
                        {% endfor %}
                    </select>
                    {% if form.speciality.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.speciality.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                {% if form.address is defined %}
                    <div class=\"form-group\">
                        {{ form_label(form.address, null, {'label_attr': {'class': 'form-label'}}) }}
                        {% set addressClass = form.address.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"text\" name=\"{{ form.address.vars.full_name }}\" id=\"{{ form.address.vars.id }}\" class=\"{{ addressClass }}\" placeholder=\"Your address\" value=\"{{ form.address.vars.value }}\">
                        {% if form.address.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback\">
                                {% for error in form.address.vars.errors %}
                                    <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>
                {% endif %}

                {% if form.phone is defined %}
                    <div class=\"form-group\">
                        {{ form_label(form.phone, null, {'label_attr': {'class': 'form-label'}}) }}
                        {% set phoneClass = form.phone.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                        <input type=\"text\" name=\"{{ form.phone.vars.full_name }}\" id=\"{{ form.phone.vars.id }}\" class=\"{{ phoneClass }}\" placeholder=\"+1 (555) 000-0000\" value=\"{{ form.phone.vars.value }}\">
                        {% if form.phone.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback\">
                                {% for error in form.phone.vars.errors %}
                                    <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>
                {% endif %}

                <div class=\"form-group\">
                    {{ form_label(form.password, null, {'label_attr': {'class': 'form-label'}}) }}
                    {% set passwordClass = form.password.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control' %}
                    <input type=\"password\" name=\"{{ form.password.vars.full_name }}\" id=\"{{ form.password.vars.id }}\" class=\"{{ passwordClass }}\">
                    {% if form.password.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.password.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                <div class=\"button-group\">
                    <button type=\"submit\" class=\"btn-register-doctor\">
                        <i class=\"fas fa-user-check me-2\"></i> Complete Registration
                    </button>
                    <a href=\"{{ path('register') }}\" class=\"btn-back\">
                        <i class=\"fas fa-arrow-left me-2\"></i> Back to Type Selection
                    </a>
                </div>
            {{ form_end(form, {'render_rest': false}) }}

            <div class=\"login-section\">
                <p>Already have an account?</p>
                <a href=\"{{ path('login') }}\" class=\"btn-login\">
                    <i class=\"fas fa-sign-in-alt me-2\"></i> Sign In
                </a>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "auth/register_doctor.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\auth\\register_doctor.html.twig");
    }
}
