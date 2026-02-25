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

/* rating/rate_doctor.html.twig */
class __TwigTemplate_4e355f7f7e4a8134a2c2735ce2b79070 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "rating/rate_doctor.html.twig"));

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

        yield "Rate Doctor - PinkShield";
        
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
    .rate-doctor-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
    }

    .page-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
        text-align: center;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .page-header p {
        margin: 0;
        opacity: 0.95;
    }

    .doctor-info-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-left: 5px solid #C41E3A;
    }

    .doctor-info-card h3 {
        color: #1f2937;
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .doctor-info-item {
        display: flex;
        align-items: center;
        margin: 8px 0;
        color: #6b7280;
    }

    .doctor-info-item i {
        color: #C41E3A;
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }

    .doctor-info-label {
        font-weight: 600;
        color: #1f2937;
        margin-right: 8px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .form-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 10px;
        display: block;
        font-size: 1rem;
    }

    .required::after {
        content: \" *\";
        color: #dc3545;
    }

    .form-select,
    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #C41E3A;
        box-shadow: 0 0 0 0.2rem rgba(196, 30, 58, 0.15);
    }

    .form-control {
        min-height: 100px;
        resize: vertical;
    }

    .star-rating-display {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }

    .star-rating-display .stars {
        font-size: 2rem;
        display: flex;
        gap: 5px;
    }

    .star-rating-display .star {
        cursor: pointer;
        color: #ddd;
        transition: color 0.2s ease;
    }

    .star-rating-display .star:hover,
    .star-rating-display .star.selected {
        color: #ffc107;
    }

    .star-label {
        color: #6b7280;
        font-size: 0.9rem;
        min-width: 100px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .btn-submit {
        flex: 1;
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .btn-submit:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        text-decoration: none;
    }

    .btn-cancel {
        flex: 1;
        background-color: #f0f0f0;
        border: 2px solid #e5e7eb;
        color: #6b7280;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1rem;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: #e5e7eb;
        color: #1f2937;
        text-decoration: none;
    }

    .form-errors {
        background-color: #fee;
        border: 1px solid #fcc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        color: #c33;
    }

    .form-errors ul {
        margin: 0;
        padding-left: 20px;
    }

    .form-errors li {
        margin: 5px 0;
    }

    .help-text {
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .rate-doctor-container {
            margin: 20px auto;
            padding: 0;
        }

        .form-card {
            border-radius: 0;
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .page-header {
            padding: 30px 20px;
        }

        .page-header h1 {
            font-size: 1.6rem;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 249
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 250
        yield "<div class=\"rate-doctor-container\">
    <div class=\"page-header\">
        <h1><i class=\"fas fa-star\"></i> ";
        // line 252
        yield (((($tmp = (isset($context["isEdit"]) || array_key_exists("isEdit", $context) ? $context["isEdit"] : (function () { throw new RuntimeError('Variable "isEdit" does not exist.', 252, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Update Your Rating") : ("Rate This Doctor"));
        yield "</h1>
        <p>Share your experience to help other patients</p>
    </div>

    <!-- Doctor Info -->
    <div class=\"doctor-info-card\">
        <h3>";
        // line 258
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 258, $this->source); })()), "fullName", [], "any", false, false, false, 258), "html", null, true);
        yield "</h3>
        <div class=\"doctor-info-item\">
            <i class=\"fas fa-briefcase\"></i>
            <span>";
        // line 261
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 261, $this->source); })()), "speciality", [], "any", false, false, false, 261), "html", null, true);
        yield "</span>
        </div>
        <div class=\"doctor-info-item\">
            <i class=\"fas fa-envelope\"></i>
            <span>";
        // line 265
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 265, $this->source); })()), "email", [], "any", false, false, false, 265), "html", null, true);
        yield "</span>
        </div>
        ";
        // line 267
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 267, $this->source); })()), "phone", [], "any", false, false, false, 267)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 268
            yield "            <div class=\"doctor-info-item\">
                <i class=\"fas fa-phone\"></i>
                <span>";
            // line 270
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 270, $this->source); })()), "phone", [], "any", false, false, false, 270), "html", null, true);
            yield "</span>
            </div>
        ";
        }
        // line 273
        yield "        ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 273, $this->source); })()), "address", [], "any", false, false, false, 273)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 274
            yield "            <div class=\"doctor-info-item\">
                <i class=\"fas fa-map-marker-alt\"></i>
                <span>";
            // line 276
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctor"]) || array_key_exists("doctor", $context) ? $context["doctor"] : (function () { throw new RuntimeError('Variable "doctor" does not exist.', 276, $this->source); })()), "address", [], "any", false, false, false, 276), "html", null, true);
            yield "</span>
            </div>
        ";
        }
        // line 279
        yield "    </div>

    <!-- Rating Form -->
    <div class=\"form-card\">
        <h2 class=\"form-title\">Your Feedback</h2>

        ";
        // line 285
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 285, $this->source); })()), "vars", [], "any", false, false, false, 285), "errors", [], "any", false, false, false, 285)) > 0)) {
            // line 286
            yield "            <div class=\"form-errors\">
                <strong><i class=\"fas fa-exclamation-circle me-2\"></i>Please fix the following:</strong>
                <ul>
                    ";
            // line 289
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 289, $this->source); })()), "vars", [], "any", false, false, false, 289), "errors", [], "any", false, false, false, 289), "form_errors", [], "any", false, false, false, 289));
            foreach ($context['_seq'] as $context["field"] => $context["errors"]) {
                // line 290
                yield "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["errors"]);
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 291
                    yield "                            <li>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 291), "html", null, true);
                    yield "</li>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 293
                yield "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['field'], $context['errors'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 294
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 294, $this->source); })()), "children", [], "any", false, false, false, 294));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 295
                yield "                        ";
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 295), "errors", [], "any", false, false, false, 295)) > 0)) {
                    // line 296
                    yield "                            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 296), "errors", [], "any", false, false, false, 296));
                    foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                        // line 297
                        yield "                                <li>";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["child"], "vars", [], "any", false, false, false, 297), "label", [], "any", false, false, false, 297), "html", null, true);
                        yield ": ";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 297), "html", null, true);
                        yield "</li>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 299
                    yield "                        ";
                }
                // line 300
                yield "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['child'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 301
            yield "                </ul>
            </div>
        ";
        }
        // line 304
        yield "
        ";
        // line 305
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 305, $this->source); })()), 'form_start');
        yield "

        <!-- Rating Field -->
        <div class=\"form-group\">
            <label class=\"form-label\">Overall Rating</label>
            ";
        // line 310
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 310, $this->source); })()), "rating", [], "any", false, false, false, 310), 'widget', ["attr" => ["class" => "form-select"]]);
        yield "
            ";
        // line 311
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 311, $this->source); })()), "rating", [], "any", false, false, false, 311), "vars", [], "any", false, false, false, 311), "errors", [], "any", false, false, false, 311)) > 0)) {
            // line 312
            yield "                <div class=\"text-danger mt-2 small\">
                    ";
            // line 313
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 313, $this->source); })()), "rating", [], "any", false, false, false, 313), "vars", [], "any", false, false, false, 313), "errors", [], "any", false, false, false, 313));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 314
                yield "                        <i class=\"fas fa-exclamation-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 314), "html", null, true);
                yield "
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 316
            yield "                </div>
            ";
        }
        // line 318
        yield "            <p class=\"help-text\">
                <i class=\"fas fa-info-circle me-1\"></i>
                Please select a rating from ⭐ Poor to ⭐⭐⭐⭐⭐ Excellent
            </p>
        </div>

        <!-- Comment Field -->
        <div class=\"form-group\">
            <label class=\"form-label\">Additional Comments</label>
            ";
        // line 327
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 327, $this->source); })()), "comment", [], "any", false, false, false, 327), 'widget', ["attr" => ["class" => "form-control", "placeholder" => "Share your experience with this doctor...", "rows" => 5]]);
        yield "
            ";
        // line 328
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 328, $this->source); })()), "comment", [], "any", false, false, false, 328), "vars", [], "any", false, false, false, 328), "errors", [], "any", false, false, false, 328)) > 0)) {
            // line 329
            yield "                <div class=\"text-danger mt-2 small\">
                    ";
            // line 330
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 330, $this->source); })()), "comment", [], "any", false, false, false, 330), "vars", [], "any", false, false, false, 330), "errors", [], "any", false, false, false, 330));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 331
                yield "                        <i class=\"fas fa-exclamation-circle me-1\"></i>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["error"], "message", [], "any", false, false, false, 331), "html", null, true);
                yield "
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 333
            yield "                </div>
            ";
        }
        // line 335
        yield "            <p class=\"help-text\">
                <i class=\"fas fa-info-circle me-1\"></i>
                Optional - up to 1000 characters. Help other patients by sharing details about your experience.
            </p>
        </div>

        <!-- Hidden CSRF field -->
        ";
        // line 342
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 342, $this->source); })()), 'rest');
        yield "

        <!-- Form Actions -->
        <div class=\"form-actions\">
            <button type=\"submit\" class=\"btn-submit\">
                <i class=\"fas fa-";
        // line 347
        yield (((($tmp = (isset($context["isEdit"]) || array_key_exists("isEdit", $context) ? $context["isEdit"] : (function () { throw new RuntimeError('Variable "isEdit" does not exist.', 347, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("save") : ("star"));
        yield " me-2\"></i>
                ";
        // line 348
        yield (((($tmp = (isset($context["isEdit"]) || array_key_exists("isEdit", $context) ? $context["isEdit"] : (function () { throw new RuntimeError('Variable "isEdit" does not exist.', 348, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Update Rating") : ("Submit Rating"));
        yield "
            </button>
            <a href=\"";
        // line 350
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("rating_doctors_list");
        yield "\" class=\"btn-cancel\">
                <i class=\"fas fa-times me-2\"></i>
                Cancel
            </a>
        </div>

        ";
        // line 356
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 356, $this->source); })()), 'form_end');
        yield "
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
        return "rating/rate_doctor.html.twig";
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
        return array (  587 => 356,  578 => 350,  573 => 348,  569 => 347,  561 => 342,  552 => 335,  548 => 333,  539 => 331,  535 => 330,  532 => 329,  530 => 328,  526 => 327,  515 => 318,  511 => 316,  502 => 314,  498 => 313,  495 => 312,  493 => 311,  489 => 310,  481 => 305,  478 => 304,  473 => 301,  467 => 300,  464 => 299,  453 => 297,  448 => 296,  445 => 295,  440 => 294,  434 => 293,  425 => 291,  420 => 290,  416 => 289,  411 => 286,  409 => 285,  401 => 279,  395 => 276,  391 => 274,  388 => 273,  382 => 270,  378 => 268,  376 => 267,  371 => 265,  364 => 261,  358 => 258,  349 => 252,  345 => 250,  335 => 249,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Rate Doctor - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    .rate-doctor-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
    }

    .page-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
        text-align: center;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .page-header p {
        margin: 0;
        opacity: 0.95;
    }

    .doctor-info-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-left: 5px solid #C41E3A;
    }

    .doctor-info-card h3 {
        color: #1f2937;
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .doctor-info-item {
        display: flex;
        align-items: center;
        margin: 8px 0;
        color: #6b7280;
    }

    .doctor-info-item i {
        color: #C41E3A;
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }

    .doctor-info-label {
        font-weight: 600;
        color: #1f2937;
        margin-right: 8px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .form-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 10px;
        display: block;
        font-size: 1rem;
    }

    .required::after {
        content: \" *\";
        color: #dc3545;
    }

    .form-select,
    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #C41E3A;
        box-shadow: 0 0 0 0.2rem rgba(196, 30, 58, 0.15);
    }

    .form-control {
        min-height: 100px;
        resize: vertical;
    }

    .star-rating-display {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }

    .star-rating-display .stars {
        font-size: 2rem;
        display: flex;
        gap: 5px;
    }

    .star-rating-display .star {
        cursor: pointer;
        color: #ddd;
        transition: color 0.2s ease;
    }

    .star-rating-display .star:hover,
    .star-rating-display .star.selected {
        color: #ffc107;
    }

    .star-label {
        color: #6b7280;
        font-size: 0.9rem;
        min-width: 100px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .btn-submit {
        flex: 1;
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .btn-submit:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        text-decoration: none;
    }

    .btn-cancel {
        flex: 1;
        background-color: #f0f0f0;
        border: 2px solid #e5e7eb;
        color: #6b7280;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1rem;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: #e5e7eb;
        color: #1f2937;
        text-decoration: none;
    }

    .form-errors {
        background-color: #fee;
        border: 1px solid #fcc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        color: #c33;
    }

    .form-errors ul {
        margin: 0;
        padding-left: 20px;
    }

    .form-errors li {
        margin: 5px 0;
    }

    .help-text {
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .rate-doctor-container {
            margin: 20px auto;
            padding: 0;
        }

        .form-card {
            border-radius: 0;
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .page-header {
            padding: 30px 20px;
        }

        .page-header h1 {
            font-size: 1.6rem;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"rate-doctor-container\">
    <div class=\"page-header\">
        <h1><i class=\"fas fa-star\"></i> {{ isEdit ? 'Update Your Rating' : 'Rate This Doctor' }}</h1>
        <p>Share your experience to help other patients</p>
    </div>

    <!-- Doctor Info -->
    <div class=\"doctor-info-card\">
        <h3>{{ doctor.fullName }}</h3>
        <div class=\"doctor-info-item\">
            <i class=\"fas fa-briefcase\"></i>
            <span>{{ doctor.speciality }}</span>
        </div>
        <div class=\"doctor-info-item\">
            <i class=\"fas fa-envelope\"></i>
            <span>{{ doctor.email }}</span>
        </div>
        {% if doctor.phone %}
            <div class=\"doctor-info-item\">
                <i class=\"fas fa-phone\"></i>
                <span>{{ doctor.phone }}</span>
            </div>
        {% endif %}
        {% if doctor.address %}
            <div class=\"doctor-info-item\">
                <i class=\"fas fa-map-marker-alt\"></i>
                <span>{{ doctor.address }}</span>
            </div>
        {% endif %}
    </div>

    <!-- Rating Form -->
    <div class=\"form-card\">
        <h2 class=\"form-title\">Your Feedback</h2>

        {% if form.vars.errors|length > 0 %}
            <div class=\"form-errors\">
                <strong><i class=\"fas fa-exclamation-circle me-2\"></i>Please fix the following:</strong>
                <ul>
                    {% for field, errors in form.vars.errors.form_errors %}
                        {% for error in errors %}
                            <li>{{ error.message }}</li>
                        {% endfor %}
                    {% endfor %}
                    {% for child in form.children %}
                        {% if child.vars.errors|length > 0 %}
                            {% for error in child.vars.errors %}
                                <li>{{ child.vars.label }}: {{ error.message }}</li>
                            {% endfor %}
                        {% endif %}
                    {% endfor %}
                </ul>
            </div>
        {% endif %}

        {{ form_start(form) }}

        <!-- Rating Field -->
        <div class=\"form-group\">
            <label class=\"form-label\">Overall Rating</label>
            {{ form_widget(form.rating, {attr: {class: 'form-select'}}) }}
            {% if form.rating.vars.errors|length > 0 %}
                <div class=\"text-danger mt-2 small\">
                    {% for error in form.rating.vars.errors %}
                        <i class=\"fas fa-exclamation-circle me-1\"></i>{{ error.message }}
                    {% endfor %}
                </div>
            {% endif %}
            <p class=\"help-text\">
                <i class=\"fas fa-info-circle me-1\"></i>
                Please select a rating from ⭐ Poor to ⭐⭐⭐⭐⭐ Excellent
            </p>
        </div>

        <!-- Comment Field -->
        <div class=\"form-group\">
            <label class=\"form-label\">Additional Comments</label>
            {{ form_widget(form.comment, {attr: {class: 'form-control', placeholder: 'Share your experience with this doctor...', rows: 5}}) }}
            {% if form.comment.vars.errors|length > 0 %}
                <div class=\"text-danger mt-2 small\">
                    {% for error in form.comment.vars.errors %}
                        <i class=\"fas fa-exclamation-circle me-1\"></i>{{ error.message }}
                    {% endfor %}
                </div>
            {% endif %}
            <p class=\"help-text\">
                <i class=\"fas fa-info-circle me-1\"></i>
                Optional - up to 1000 characters. Help other patients by sharing details about your experience.
            </p>
        </div>

        <!-- Hidden CSRF field -->
        {{ form_rest(form) }}

        <!-- Form Actions -->
        <div class=\"form-actions\">
            <button type=\"submit\" class=\"btn-submit\">
                <i class=\"fas fa-{{ isEdit ? 'save' : 'star' }} me-2\"></i>
                {{ isEdit ? 'Update Rating' : 'Submit Rating' }}
            </button>
            <a href=\"{{ path('rating_doctors_list') }}\" class=\"btn-cancel\">
                <i class=\"fas fa-times me-2\"></i>
                Cancel
            </a>
        </div>

        {{ form_end(form) }}
    </div>
</div>
{% endblock %}
", "rating/rate_doctor.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\rating\\rate_doctor.html.twig");
    }
}
