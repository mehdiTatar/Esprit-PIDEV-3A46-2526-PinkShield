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

/* auth/register_patient.html.twig */
class __TwigTemplate_0eaa14be69709aa9caf71cfefea5e93c extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "auth/register_patient.html.twig"));

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

        yield "Patient Registration - PinkShield";
        
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

    .register-patient-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
    }

    .register-patient-container {
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

    .register-patient-branding {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .register-patient-branding h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 20px 0 10px;
        letter-spacing: -0.5px;
    }

    .register-patient-branding p {
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

    .register-patient-form-wrapper {
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

    .register-patient-form-wrapper h3 {
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

    .form-control {
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

    .form-control:focus {
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-row .form-group {
        margin-bottom: 0;
    }

    .btn-register-patient {
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

    .btn-register-patient:hover {
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 317
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 318
        yield "<div class=\"register-patient-wrapper\">
    <div class=\"register-patient-container\">
        <!-- Left Side - Branding -->
        <div class=\"register-patient-branding\">
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
                    <i class=\"fas fa-user-md\"></i>
                    <span>Expert Support</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Patient Registration Form -->
        <div class=\"register-patient-form-wrapper\">
            <h3><i class=\"fas fa-user-heart me-2\"></i> Patient Registration</h3>

            ";
        // line 367
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 367, $this->source); })()), 'form_start');
        yield "
                ";
        // line 368
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 368, $this->source); })()), "vars", [], "any", false, false, false, 368), "errors", [], "any", false, false, false, 368)) > 0)) {
            // line 369
            yield "                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                        <strong><i class=\"fas fa-exclamation-circle me-2\"></i> Please fix the following errors:</strong>
                        <ul class=\"mb-0 mt-2\">
                            ";
            // line 372
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 372, $this->source); })()), "vars", [], "any", false, false, false, 372), "errors", [], "any", false, false, false, 372));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 373
                yield "                                <li>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 373), "html", null, true);
                yield "</li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 375
            yield "                        </ul>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                ";
        }
        // line 379
        yield "
                <div class=\"form-group\">
                    ";
        // line 381
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 381, $this->source); })()), "email", [], "any", false, false, false, 381), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 382
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 382, $this->source); })()), "email", [], "any", false, false, false, 382), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 382, $this->source); })()), "email", [], "any", false, false, false, 382), "vars", [], "any", false, false, false, 382), "errors", [], "any", false, false, false, 382)) > 0)) ? ("form-control is-invalid") : ("form-control")), "placeholder" => "your@email.com"]]);
        yield "
                    ";
        // line 383
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 383, $this->source); })()), "email", [], "any", false, false, false, 383), "vars", [], "any", false, false, false, 383), "errors", [], "any", false, false, false, 383)) > 0)) {
            // line 384
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 385
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 385, $this->source); })()), "email", [], "any", false, false, false, 385), "vars", [], "any", false, false, false, 385), "errors", [], "any", false, false, false, 385));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 386
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 386), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 388
            yield "                        </div>
                    ";
        }
        // line 390
        yield "                </div>

                <div class=\"form-row\">
                    <div class=\"form-group\">
                        ";
        // line 394
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 394, $this->source); })()), "firstName", [], "any", false, false, false, 394), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                        ";
        // line 395
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 395, $this->source); })()), "firstName", [], "any", false, false, false, 395), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 395, $this->source); })()), "firstName", [], "any", false, false, false, 395), "vars", [], "any", false, false, false, 395), "errors", [], "any", false, false, false, 395)) > 0)) ? ("form-control is-invalid") : ("form-control")), "placeholder" => "First Name"]]);
        yield "
                        ";
        // line 396
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 396, $this->source); })()), "firstName", [], "any", false, false, false, 396), "vars", [], "any", false, false, false, 396), "errors", [], "any", false, false, false, 396)) > 0)) {
            // line 397
            yield "                            <div class=\"invalid-feedback\">
                                ";
            // line 398
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 398, $this->source); })()), "firstName", [], "any", false, false, false, 398), "vars", [], "any", false, false, false, 398), "errors", [], "any", false, false, false, 398));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 399
                yield "                                    <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 399), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 401
            yield "                            </div>
                        ";
        }
        // line 403
        yield "                    </div>
                    <div class=\"form-group\">
                        ";
        // line 405
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 405, $this->source); })()), "lastName", [], "any", false, false, false, 405), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                        ";
        // line 406
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 406, $this->source); })()), "lastName", [], "any", false, false, false, 406), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 406, $this->source); })()), "lastName", [], "any", false, false, false, 406), "vars", [], "any", false, false, false, 406), "errors", [], "any", false, false, false, 406)) > 0)) ? ("form-control is-invalid") : ("form-control")), "placeholder" => "Last Name"]]);
        yield "
                        ";
        // line 407
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 407, $this->source); })()), "lastName", [], "any", false, false, false, 407), "vars", [], "any", false, false, false, 407), "errors", [], "any", false, false, false, 407)) > 0)) {
            // line 408
            yield "                            <div class=\"invalid-feedback\">
                                ";
            // line 409
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 409, $this->source); })()), "lastName", [], "any", false, false, false, 409), "vars", [], "any", false, false, false, 409), "errors", [], "any", false, false, false, 409));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 410
                yield "                                    <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 410), "html", null, true);
                yield "
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 412
            yield "                            </div>
                        ";
        }
        // line 414
        yield "                    </div>
                </div>

                ";
        // line 417
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "address", [], "any", true, true, false, 417)) {
            // line 418
            yield "                    <div class=\"form-group\">
                        ";
            // line 419
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 419, $this->source); })()), "address", [], "any", false, false, false, 419), 'label', ["label_attr" => ["class" => "form-label"]]);
            yield "
                        ";
            // line 420
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 420, $this->source); })()), "address", [], "any", false, false, false, 420), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 420, $this->source); })()), "address", [], "any", false, false, false, 420), "vars", [], "any", false, false, false, 420), "errors", [], "any", false, false, false, 420)) > 0)) ? ("form-control is-invalid") : ("form-control")), "placeholder" => "Your address (optional)"]]);
            yield "
                        ";
            // line 421
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 421, $this->source); })()), "address", [], "any", false, false, false, 421), "vars", [], "any", false, false, false, 421), "errors", [], "any", false, false, false, 421)) > 0)) {
                // line 422
                yield "                            <div class=\"invalid-feedback\">
                                ";
                // line 423
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 423, $this->source); })()), "address", [], "any", false, false, false, 423), "vars", [], "any", false, false, false, 423), "errors", [], "any", false, false, false, 423));
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 424
                    yield "                                    <i class=\"fas fa-times-circle me-1\"></i>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 424), "html", null, true);
                    yield "
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 426
                yield "                            </div>
                        ";
            }
            // line 428
            yield "                    </div>
                ";
        }
        // line 430
        yield "
                <div class=\"form-group\">
                    ";
        // line 432
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 432, $this->source); })()), "phone", [], "any", false, false, false, 432), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 433
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 433, $this->source); })()), "phone", [], "any", false, false, false, 433), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 433, $this->source); })()), "phone", [], "any", false, false, false, 433), "vars", [], "any", false, false, false, 433), "errors", [], "any", false, false, false, 433)) > 0)) ? ("form-control is-invalid") : ("form-control")), "placeholder" => "+1 (555) 000-0000"]]);
        yield "
                    ";
        // line 434
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 434, $this->source); })()), "phone", [], "any", false, false, false, 434), "vars", [], "any", false, false, false, 434), "errors", [], "any", false, false, false, 434)) > 0)) {
            // line 435
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 436
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 436, $this->source); })()), "phone", [], "any", false, false, false, 436), "vars", [], "any", false, false, false, 436), "errors", [], "any", false, false, false, 436));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 437
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 437), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 439
            yield "                        </div>
                    ";
        }
        // line 441
        yield "                </div>

                <div class=\"form-group\">
                    ";
        // line 444
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 444, $this->source); })()), "password", [], "any", false, false, false, 444), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                    ";
        // line 445
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 445, $this->source); })()), "password", [], "any", false, false, false, 445), 'widget', ["attr" => ["class" => (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 445, $this->source); })()), "password", [], "any", false, false, false, 445), "vars", [], "any", false, false, false, 445), "errors", [], "any", false, false, false, 445)) > 0)) ? ("form-control is-invalid") : ("form-control")), "placeholder" => "Enter your password"]]);
        yield "
                    ";
        // line 446
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 446, $this->source); })()), "password", [], "any", false, false, false, 446), "vars", [], "any", false, false, false, 446), "errors", [], "any", false, false, false, 446)) > 0)) {
            // line 447
            yield "                        <div class=\"invalid-feedback\">
                            ";
            // line 448
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 448, $this->source); })()), "password", [], "any", false, false, false, 448), "vars", [], "any", false, false, false, 448), "errors", [], "any", false, false, false, 448));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 449
                yield "                                <i class=\"fas fa-times-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 449), "html", null, true);
                yield "
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 451
            yield "                        </div>
                    ";
        }
        // line 453
        yield "                </div>

                <div class=\"button-group\">
                    <button type=\"submit\" class=\"btn-register-patient\">
                        <i class=\"fas fa-user-check me-2\"></i> Complete Registration
                    </button>
                    <a href=\"";
        // line 459
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("register");
        yield "\" class=\"btn-back\">
                        <i class=\"fas fa-arrow-left me-2\"></i> Back to Type Selection
                    </a>
                </div>
            ";
        // line 463
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 463, $this->source); })()), 'form_end');
        yield "

            <div class=\"login-section\">
                <p>Already have an account?</p>
                <a href=\"";
        // line 467
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
        return "auth/register_patient.html.twig";
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
        return array (  733 => 467,  726 => 463,  719 => 459,  711 => 453,  707 => 451,  698 => 449,  694 => 448,  691 => 447,  689 => 446,  685 => 445,  681 => 444,  676 => 441,  672 => 439,  663 => 437,  659 => 436,  656 => 435,  654 => 434,  650 => 433,  646 => 432,  642 => 430,  638 => 428,  634 => 426,  625 => 424,  621 => 423,  618 => 422,  616 => 421,  612 => 420,  608 => 419,  605 => 418,  603 => 417,  598 => 414,  594 => 412,  585 => 410,  581 => 409,  578 => 408,  576 => 407,  572 => 406,  568 => 405,  564 => 403,  560 => 401,  551 => 399,  547 => 398,  544 => 397,  542 => 396,  538 => 395,  534 => 394,  528 => 390,  524 => 388,  515 => 386,  511 => 385,  508 => 384,  506 => 383,  502 => 382,  498 => 381,  494 => 379,  488 => 375,  479 => 373,  475 => 372,  470 => 369,  468 => 368,  464 => 367,  413 => 318,  403 => 317,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Patient Registration - PinkShield{% endblock %}

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

    .register-patient-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
    }

    .register-patient-container {
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

    .register-patient-branding {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 50px 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .register-patient-branding h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 20px 0 10px;
        letter-spacing: -0.5px;
    }

    .register-patient-branding p {
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

    .register-patient-form-wrapper {
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

    .register-patient-form-wrapper h3 {
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

    .form-control {
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

    .form-control:focus {
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .form-row .form-group {
        margin-bottom: 0;
    }

    .btn-register-patient {
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

    .btn-register-patient:hover {
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"register-patient-wrapper\">
    <div class=\"register-patient-container\">
        <!-- Left Side - Branding -->
        <div class=\"register-patient-branding\">
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
                    <i class=\"fas fa-user-md\"></i>
                    <span>Expert Support</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Patient Registration Form -->
        <div class=\"register-patient-form-wrapper\">
            <h3><i class=\"fas fa-user-heart me-2\"></i> Patient Registration</h3>

            {{ form_start(form) }}
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
                    {{ form_widget(form.email, {'attr': {'class': form.email.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control', 'placeholder': 'your@email.com'}}) }}
                    {% if form.email.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.email.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                <div class=\"form-row\">
                    <div class=\"form-group\">
                        {{ form_label(form.firstName, null, {'label_attr': {'class': 'form-label'}}) }}
                        {{ form_widget(form.firstName, {'attr': {'class': form.firstName.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control', 'placeholder': 'First Name'}}) }}
                        {% if form.firstName.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback\">
                                {% for error in form.firstName.vars.errors %}
                                    <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>
                    <div class=\"form-group\">
                        {{ form_label(form.lastName, null, {'label_attr': {'class': 'form-label'}}) }}
                        {{ form_widget(form.lastName, {'attr': {'class': form.lastName.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control', 'placeholder': 'Last Name'}}) }}
                        {% if form.lastName.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback\">
                                {% for error in form.lastName.vars.errors %}
                                    <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>
                </div>

                {% if form.address is defined %}
                    <div class=\"form-group\">
                        {{ form_label(form.address, null, {'label_attr': {'class': 'form-label'}}) }}
                        {{ form_widget(form.address, {'attr': {'class': form.address.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control', 'placeholder': 'Your address (optional)'}}) }}
                        {% if form.address.vars.errors|length > 0 %}
                            <div class=\"invalid-feedback\">
                                {% for error in form.address.vars.errors %}
                                    <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>
                {% endif %}

                <div class=\"form-group\">
                    {{ form_label(form.phone, null, {'label_attr': {'class': 'form-label'}}) }}
                    {{ form_widget(form.phone, {'attr': {'class': form.phone.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control', 'placeholder': '+1 (555) 000-0000'}}) }}
                    {% if form.phone.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.phone.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                <div class=\"form-group\">
                    {{ form_label(form.password, null, {'label_attr': {'class': 'form-label'}}) }}
                    {{ form_widget(form.password, {'attr': {'class': form.password.vars.errors|length > 0 ? 'form-control is-invalid' : 'form-control', 'placeholder': 'Enter your password'}}) }}
                    {% if form.password.vars.errors|length > 0 %}
                        <div class=\"invalid-feedback\">
                            {% for error in form.password.vars.errors %}
                                <i class=\"fas fa-times-circle me-1\"></i>{{ error.message }}
                            {% endfor %}
                        </div>
                    {% endif %}
                </div>

                <div class=\"button-group\">
                    <button type=\"submit\" class=\"btn-register-patient\">
                        <i class=\"fas fa-user-check me-2\"></i> Complete Registration
                    </button>
                    <a href=\"{{ path('register') }}\" class=\"btn-back\">
                        <i class=\"fas fa-arrow-left me-2\"></i> Back to Type Selection
                    </a>
                </div>
            {{ form_end(form) }}

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
", "auth/register_patient.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\auth\\register_patient.html.twig");
    }
}
