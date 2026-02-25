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

/* rating/doctors_list.html.twig */
class __TwigTemplate_30067d18bb0b0a8247538f6dec2bb79f extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "rating/doctors_list.html.twig"));

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

        yield "Rate Doctors - PinkShield";
        
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
    .doctors-container {
        margin-top: 30px;
    }

    .page-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        margin: 10px 0 0 0;
        opacity: 0.95;
        font-size: 1rem;
    }

    .doctor-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: white;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
    }

    .doctor-card-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 15px 20px;
    }

    .doctor-info {
        padding: 20px;
    }

    .doctor-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 10px 0;
    }

    .doctor-detail {
        font-size: 0.95rem;
        color: #6b7280;
        margin: 5px 0;
    }

    .doctor-detail span {
        color: #1f2937;
        font-weight: 600;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 15px 0;
    }

    .rating-stars {
        font-size: 1.1rem;
    }

    .rating-text {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .btn-rate {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-rate:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        text-decoration: none;
    }

    .btn-rate-update {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
        font-weight: 600;
    }

    .btn-rate-update:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
        text-decoration: none;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: auto;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
    }

    .doctor-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }

    .no-doctors {
        text-align: center;
        padding: 40px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .no-doctors i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 15px;
    }

    .no-doctors p {
        color: #6b7280;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 30px 20px;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .doctors-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 185
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 186
        yield "<div class=\"doctors-container\">
    <div class=\"page-header\">
        <h1><i class=\"fas fa-star\"></i> Rate Our Doctors</h1>
        <p>Share your experience and help other patients find the right doctor</p>
    </div>

    ";
        // line 192
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 192, $this->source); })()), "flashes", ["success"], "method", false, false, false, 192));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 193
            yield "        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <i class=\"fas fa-check-circle me-2\"></i>
            <strong>Success!</strong> ";
            // line 195
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 199
        yield "
    ";
        // line 200
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["doctors"]) || array_key_exists("doctors", $context) ? $context["doctors"] : (function () { throw new RuntimeError('Variable "doctors" does not exist.', 200, $this->source); })())) > 0)) {
            // line 201
            yield "        <div class=\"doctors-grid\">
            ";
            // line 202
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["doctors"]) || array_key_exists("doctors", $context) ? $context["doctors"] : (function () { throw new RuntimeError('Variable "doctors" does not exist.', 202, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["doctor"]) {
                // line 203
                yield "                <div class=\"doctor-card\">
                    <div class=\"doctor-card-header\">
                        <div>
                            <i class=\"fas fa-stethoscope me-2\"></i>
                            <strong>";
                // line 207
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "fullName", [], "any", false, false, false, 207), "html", null, true);
                yield "</strong>
                        </div>
                        <span class=\"status-badge status-";
                // line 209
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "status", [], "any", false, false, false, 209)), "html", null, true);
                yield "\">
                            ";
                // line 210
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "status", [], "any", false, false, false, 210) == "active")) {
                    // line 211
                    yield "                                <i class=\"fas fa-check-circle me-1\"></i>Active
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 212
$context["doctor"], "status", [], "any", false, false, false, 212) == "inactive")) {
                    // line 213
                    yield "                                <i class=\"fas fa-times-circle me-1\"></i>Inactive
                            ";
                } else {
                    // line 215
                    yield "                                <i class=\"fas fa-ban me-1\"></i>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "status", [], "any", false, false, false, 215)), "html", null, true);
                    yield "
                            ";
                }
                // line 217
                yield "                        </span>
                    </div>
                    <div class=\"doctor-info\">
                        <p class=\"doctor-name\">";
                // line 220
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "speciality", [], "any", false, false, false, 220), "html", null, true);
                yield "</p>
                        <div class=\"doctor-detail\">
                            <i class=\"fas fa-envelope me-2\"></i>
                            <span>";
                // line 223
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "email", [], "any", false, false, false, 223), "html", null, true);
                yield "</span>
                        </div>
                        ";
                // line 225
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "phone", [], "any", false, false, false, 225)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 226
                    yield "                            <div class=\"doctor-detail\">
                                <i class=\"fas fa-phone me-2\"></i>
                                <span>";
                    // line 228
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "phone", [], "any", false, false, false, 228), "html", null, true);
                    yield "</span>
                            </div>
                        ";
                }
                // line 231
                yield "                        ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "address", [], "any", false, false, false, 231)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 232
                    yield "                            <div class=\"doctor-detail\">
                                <i class=\"fas fa-map-marker-alt me-2\"></i>
                                <span>";
                    // line 234
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "address", [], "any", false, false, false, 234), "html", null, true);
                    yield "</span>
                            </div>
                        ";
                }
                // line 237
                yield "
                        <!-- Rating Display -->
                        <div class=\"rating-display\">
                            ";
                // line 240
                $context["doctorRating"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctorRatings"]) || array_key_exists("doctorRatings", $context) ? $context["doctorRatings"] : (function () { throw new RuntimeError('Variable "doctorRatings" does not exist.', 240, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "id", [], "any", false, false, false, 240), [], "array", false, false, false, 240);
                // line 241
                yield "                            ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctorRating"]) || array_key_exists("doctorRating", $context) ? $context["doctorRating"] : (function () { throw new RuntimeError('Variable "doctorRating" does not exist.', 241, $this->source); })()), "average", [], "any", false, false, false, 241)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 242
                    yield "                                <div class=\"rating-stars\">
                                    ";
                    // line 243
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 244
                        yield "                                        ";
                        if (($context["i"] <= Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctorRating"]) || array_key_exists("doctorRating", $context) ? $context["doctorRating"] : (function () { throw new RuntimeError('Variable "doctorRating" does not exist.', 244, $this->source); })()), "average", [], "any", false, false, false, 244)))) {
                            // line 245
                            yield "                                            <i class=\"fas fa-star\" style=\"color: #ffc107;\"></i>
                                        ";
                        } else {
                            // line 247
                            yield "                                            <i class=\"fas fa-star\" style=\"color: #ddd;\"></i>
                                        ";
                        }
                        // line 249
                        yield "                                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 250
                    yield "                                </div>
                                <div class=\"rating-text\">
                                    ";
                    // line 252
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctorRating"]) || array_key_exists("doctorRating", $context) ? $context["doctorRating"] : (function () { throw new RuntimeError('Variable "doctorRating" does not exist.', 252, $this->source); })()), "average", [], "any", false, false, false, 252), 1), "html", null, true);
                    yield "/5.0 (";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctorRating"]) || array_key_exists("doctorRating", $context) ? $context["doctorRating"] : (function () { throw new RuntimeError('Variable "doctorRating" does not exist.', 252, $this->source); })()), "count", [], "any", false, false, false, 252), "html", null, true);
                    yield " reviews)
                                </div>
                            ";
                } else {
                    // line 255
                    yield "                                <div class=\"rating-text\">
                                    <i class=\"fas fa-star\" style=\"color: #ddd;\"></i> No ratings yet
                                </div>
                            ";
                }
                // line 259
                yield "                        </div>

                        <!-- Rate Button -->
                        <div style=\"margin-top: 20px;\">
                            ";
                // line 263
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["doctorRating"]) || array_key_exists("doctorRating", $context) ? $context["doctorRating"] : (function () { throw new RuntimeError('Variable "doctorRating" does not exist.', 263, $this->source); })()), "userRating", [], "any", false, false, false, 263)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 264
                    yield "                                <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("rating_rate_doctor", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "id", [], "any", false, false, false, 264)]), "html", null, true);
                    yield "\" class=\"btn btn-rate-update w-100\">
                                    <i class=\"fas fa-edit me-2\"></i> Update Your Rating
                                </a>
                            ";
                } else {
                    // line 268
                    yield "                                <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("rating_rate_doctor", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["doctor"], "id", [], "any", false, false, false, 268)]), "html", null, true);
                    yield "\" class=\"btn btn-rate w-100\">
                                    <i class=\"fas fa-star me-2\"></i> Rate This Doctor
                                </a>
                            ";
                }
                // line 272
                yield "                        </div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['doctor'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 276
            yield "        </div>
    ";
        } else {
            // line 278
            yield "        <div class=\"no-doctors\">
            <i class=\"fas fa-inbox\"></i>
            <p>No doctors available to rate at this time.</p>
        </div>
    ";
        }
        // line 283
        yield "</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "rating/doctors_list.html.twig";
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
        return array (  488 => 283,  481 => 278,  477 => 276,  468 => 272,  460 => 268,  452 => 264,  450 => 263,  444 => 259,  438 => 255,  430 => 252,  426 => 250,  420 => 249,  416 => 247,  412 => 245,  409 => 244,  405 => 243,  402 => 242,  399 => 241,  397 => 240,  392 => 237,  386 => 234,  382 => 232,  379 => 231,  373 => 228,  369 => 226,  367 => 225,  362 => 223,  356 => 220,  351 => 217,  345 => 215,  341 => 213,  339 => 212,  336 => 211,  334 => 210,  330 => 209,  325 => 207,  319 => 203,  315 => 202,  312 => 201,  310 => 200,  307 => 199,  297 => 195,  293 => 193,  289 => 192,  281 => 186,  271 => 185,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Rate Doctors - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    .doctors-container {
        margin-top: 30px;
    }

    .page-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(196, 30, 58, 0.2);
    }

    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        margin: 10px 0 0 0;
        opacity: 0.95;
        font-size: 1rem;
    }

    .doctor-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background: white;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(196, 30, 58, 0.15);
    }

    .doctor-card-header {
        background: linear-gradient(135deg, #C41E3A 0%, #8B1428 100%);
        color: white;
        padding: 15px 20px;
    }

    .doctor-info {
        padding: 20px;
    }

    .doctor-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 10px 0;
    }

    .doctor-detail {
        font-size: 0.95rem;
        color: #6b7280;
        margin: 5px 0;
    }

    .doctor-detail span {
        color: #1f2937;
        font-weight: 600;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 15px 0;
    }

    .rating-stars {
        font-size: 1.1rem;
    }

    .rating-text {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .btn-rate {
        background-color: #C41E3A;
        border-color: #C41E3A;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-rate:hover {
        background-color: #8B1428;
        border-color: #8B1428;
        text-decoration: none;
    }

    .btn-rate-update {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
        font-weight: 600;
    }

    .btn-rate-update:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
        text-decoration: none;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: auto;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
    }

    .doctor-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }

    .no-doctors {
        text-align: center;
        padding: 40px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .no-doctors i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 15px;
    }

    .no-doctors p {
        color: #6b7280;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 30px 20px;
        }

        .page-header h1 {
            font-size: 1.8rem;
        }

        .doctors-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"doctors-container\">
    <div class=\"page-header\">
        <h1><i class=\"fas fa-star\"></i> Rate Our Doctors</h1>
        <p>Share your experience and help other patients find the right doctor</p>
    </div>

    {% for message in app.flashes('success') %}
        <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
            <i class=\"fas fa-check-circle me-2\"></i>
            <strong>Success!</strong> {{ message }}
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
        </div>
    {% endfor %}

    {% if doctors|length > 0 %}
        <div class=\"doctors-grid\">
            {% for doctor in doctors %}
                <div class=\"doctor-card\">
                    <div class=\"doctor-card-header\">
                        <div>
                            <i class=\"fas fa-stethoscope me-2\"></i>
                            <strong>{{ doctor.fullName }}</strong>
                        </div>
                        <span class=\"status-badge status-{{ doctor.status|lower }}\">
                            {% if doctor.status == 'active' %}
                                <i class=\"fas fa-check-circle me-1\"></i>Active
                            {% elseif doctor.status == 'inactive' %}
                                <i class=\"fas fa-times-circle me-1\"></i>Inactive
                            {% else %}
                                <i class=\"fas fa-ban me-1\"></i>{{ doctor.status|capitalize }}
                            {% endif %}
                        </span>
                    </div>
                    <div class=\"doctor-info\">
                        <p class=\"doctor-name\">{{ doctor.speciality }}</p>
                        <div class=\"doctor-detail\">
                            <i class=\"fas fa-envelope me-2\"></i>
                            <span>{{ doctor.email }}</span>
                        </div>
                        {% if doctor.phone %}
                            <div class=\"doctor-detail\">
                                <i class=\"fas fa-phone me-2\"></i>
                                <span>{{ doctor.phone }}</span>
                            </div>
                        {% endif %}
                        {% if doctor.address %}
                            <div class=\"doctor-detail\">
                                <i class=\"fas fa-map-marker-alt me-2\"></i>
                                <span>{{ doctor.address }}</span>
                            </div>
                        {% endif %}

                        <!-- Rating Display -->
                        <div class=\"rating-display\">
                            {% set doctorRating = doctorRatings[doctor.id] %}
                            {% if doctorRating.average %}
                                <div class=\"rating-stars\">
                                    {% for i in 1..5 %}
                                        {% if i <= doctorRating.average|round %}
                                            <i class=\"fas fa-star\" style=\"color: #ffc107;\"></i>
                                        {% else %}
                                            <i class=\"fas fa-star\" style=\"color: #ddd;\"></i>
                                        {% endif %}
                                    {% endfor %}
                                </div>
                                <div class=\"rating-text\">
                                    {{ doctorRating.average|round(1) }}/5.0 ({{ doctorRating.count }} reviews)
                                </div>
                            {% else %}
                                <div class=\"rating-text\">
                                    <i class=\"fas fa-star\" style=\"color: #ddd;\"></i> No ratings yet
                                </div>
                            {% endif %}
                        </div>

                        <!-- Rate Button -->
                        <div style=\"margin-top: 20px;\">
                            {% if doctorRating.userRating %}
                                <a href=\"{{ path('rating_rate_doctor', {id: doctor.id}) }}\" class=\"btn btn-rate-update w-100\">
                                    <i class=\"fas fa-edit me-2\"></i> Update Your Rating
                                </a>
                            {% else %}
                                <a href=\"{{ path('rating_rate_doctor', {id: doctor.id}) }}\" class=\"btn btn-rate w-100\">
                                    <i class=\"fas fa-star me-2\"></i> Rate This Doctor
                                </a>
                            {% endif %}
                        </div>
                    </div>
                </div>
            {% endfor %}
        </div>
    {% else %}
        <div class=\"no-doctors\">
            <i class=\"fas fa-inbox\"></i>
            <p>No doctors available to rate at this time.</p>
        </div>
    {% endif %}
</div>
{% endblock %}
", "rating/doctors_list.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\rating\\doctors_list.html.twig");
    }
}
