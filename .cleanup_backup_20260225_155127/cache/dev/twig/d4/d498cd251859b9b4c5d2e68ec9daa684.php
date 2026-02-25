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

/* tracking/edit.html.twig */
class __TwigTemplate_eb010364e5cc6cb0cfa0347d3464c4f6 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tracking/edit.html.twig"));

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

        yield "Edit Tracking Entry - PinkShield";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container mt-5 mb-5\">
    <div class=\"row\">
        <div class=\"col-md-8 offset-md-2\">
            <h1 class=\"mb-4\"><i class=\"fas fa-edit me-2\"></i>Edit Health Tracking Entry</h1>

            <div class=\"card\">
                <div class=\"card-header bg-warning text-white\">
                    <h5 class=\"mb-0\">Modify Your Entry for ";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 13, $this->source); })()), "date", [], "any", false, false, false, 13), "d M Y"), "html", null, true);
        yield "</h5>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\">
                        <div class=\"mb-3\">
                            <label for=\"mood\" class=\"form-label\">Mood (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"mood\" name=\"mood\" min=\"1\" max=\"10\" value=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 20, $this->source); })()), "mood", [], "any", false, false, false, 20), "html", null, true);
        yield "\">
                                <span class=\"input-group-text ms-2\"><span id=\"moodValue\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 21, $this->source); })()), "mood", [], "any", false, false, false, 21), "html", null, true);
        yield "</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Bad, 10 = Excellent</small>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"stress\" class=\"form-label\">Stress Level (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"stress\" name=\"stress\" min=\"1\" max=\"10\" value=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 29, $this->source); })()), "stress", [], "any", false, false, false, 29), "html", null, true);
        yield "\">
                                <span class=\"input-group-text ms-2\"><span id=\"stressValue\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 30, $this->source); })()), "stress", [], "any", false, false, false, 30), "html", null, true);
        yield "</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Relaxed, 10 = Very Stressed</small>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"anxiety_level\" class=\"form-label\">Anxiety Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"anxiety_level\" name=\"anxiety_level\" min=\"1\" max=\"10\" value=\"";
        // line 39
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "anxietyLevel", [], "any", true, true, false, 39) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 39, $this->source); })()), "anxietyLevel", [], "any", false, false, false, 39)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 39, $this->source); })()), "anxietyLevel", [], "any", false, false, false, 39), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"focus_level\" class=\"form-label\">Focus Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"focus_level\" name=\"focus_level\" min=\"1\" max=\"10\" value=\"";
        // line 45
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "focusLevel", [], "any", true, true, false, 45) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 45, $this->source); })()), "focusLevel", [], "any", false, false, false, 45)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 45, $this->source); })()), "focusLevel", [], "any", false, false, false, 45), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"motivation_level\" class=\"form-label\">Motivation Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"motivation_level\" name=\"motivation_level\" min=\"1\" max=\"10\" value=\"";
        // line 54
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "motivationLevel", [], "any", true, true, false, 54) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 54, $this->source); })()), "motivationLevel", [], "any", false, false, false, 54)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 54, $this->source); })()), "motivationLevel", [], "any", false, false, false, 54), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"social_interaction_level\" class=\"form-label\">Social Interaction (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"social_interaction_level\" name=\"social_interaction_level\" min=\"1\" max=\"10\" value=\"";
        // line 60
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "socialInteractionLevel", [], "any", true, true, false, 60) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 60, $this->source); })()), "socialInteractionLevel", [], "any", false, false, false, 60)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 60, $this->source); })()), "socialInteractionLevel", [], "any", false, false, false, 60), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"sleep_hours\" class=\"form-label\">Sleep Hours (0-24):</label>
                                    <input type=\"number\" class=\"form-control\" id=\"sleep_hours\" name=\"sleep_hours\" min=\"0\" max=\"24\" step=\"0.5\" value=\"";
        // line 69
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "sleepHours", [], "any", true, true, false, 69) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 69, $this->source); })()), "sleepHours", [], "any", false, false, false, 69)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 69, $this->source); })()), "sleepHours", [], "any", false, false, false, 69), "html", null, true)) : (""));
        yield "\" placeholder=\"Hours slept\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"energy_level\" class=\"form-label\">Energy Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"energy_level\" name=\"energy_level\" min=\"1\" max=\"10\" value=\"";
        // line 75
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "energyLevel", [], "any", true, true, false, 75) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 75, $this->source); })()), "energyLevel", [], "any", false, false, false, 75)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 75, $this->source); })()), "energyLevel", [], "any", false, false, false, 75), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"appetite_level\" class=\"form-label\">Appetite Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"appetite_level\" name=\"appetite_level\" min=\"1\" max=\"10\" value=\"";
        // line 84
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "appetiteLevel", [], "any", true, true, false, 84) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 84, $this->source); })()), "appetiteLevel", [], "any", false, false, false, 84)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 84, $this->source); })()), "appetiteLevel", [], "any", false, false, false, 84), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"physical_activity_level\" class=\"form-label\">Physical Activity (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"physical_activity_level\" name=\"physical_activity_level\" min=\"1\" max=\"10\" value=\"";
        // line 90
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "physicalActivityLevel", [], "any", true, true, false, 90) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 90, $this->source); })()), "physicalActivityLevel", [], "any", false, false, false, 90)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 90, $this->source); })()), "physicalActivityLevel", [], "any", false, false, false, 90), "html", null, true)) : (5));
        yield "\">
                                </div>
                            </div>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"water_intake\" class=\"form-label\">Water Intake (%):</label>
                            <input type=\"number\" class=\"form-control\" id=\"water_intake\" name=\"water_intake\" min=\"0\" max=\"100\" value=\"";
        // line 97
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "waterIntake", [], "any", true, true, false, 97) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 97, $this->source); })()), "waterIntake", [], "any", false, false, false, 97)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 97, $this->source); })()), "waterIntake", [], "any", false, false, false, 97), "html", null, true)) : (""));
        yield "\" placeholder=\"Percentage of daily goal\">
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"activities\" class=\"form-label\">Activities:</label>
                            <textarea class=\"form-control\" id=\"activities\" name=\"activities\" rows=\"3\" placeholder=\"Describe your activities\">";
        // line 102
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "activities", [], "any", true, true, false, 102) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 102, $this->source); })()), "activities", [], "any", false, false, false, 102)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 102, $this->source); })()), "activities", [], "any", false, false, false, 102), "html", null, true)) : (""));
        yield "</textarea>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"symptoms\" class=\"form-label\">Symptoms:</label>
                            <textarea class=\"form-control\" id=\"symptoms\" name=\"symptoms\" rows=\"3\" placeholder=\"Any symptoms or health concerns\">";
        // line 107
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tracking"] ?? null), "symptoms", [], "any", true, true, false, 107) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 107, $this->source); })()), "symptoms", [], "any", false, false, false, 107)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 107, $this->source); })()), "symptoms", [], "any", false, false, false, 107), "html", null, true)) : (""));
        yield "</textarea>
                        </div>

                        <div class=\"mb-3\">
                            <div class=\"form-check\">
                                <input class=\"form-check-input\" type=\"checkbox\" id=\"medication_taken\" name=\"medication_taken\" value=\"1\" ";
        // line 112
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["tracking"]) || array_key_exists("tracking", $context) ? $context["tracking"] : (function () { throw new RuntimeError('Variable "tracking" does not exist.', 112, $this->source); })()), "medicationTaken", [], "any", false, false, false, 112)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "checked";
        }
        yield ">
                                <label class=\"form-check-label\" for=\"medication_taken\">
                                    Medication Taken
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class=\"d-flex gap-2\">
                            <button type=\"submit\" class=\"btn btn-warning\">
                                <i class=\"fas fa-save me-2\"></i>Save Changes
                            </button>
                            <a href=\"";
        // line 125
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("tracking_index");
        yield "\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-times me-2\"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update mood display
    document.getElementById('mood').addEventListener('input', function() {
        document.getElementById('moodValue').textContent = this.value;
    });

    // Update stress display
    document.getElementById('stress').addEventListener('input', function() {
        document.getElementById('stressValue').textContent = this.value;
    });
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "tracking/edit.html.twig";
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
        return array (  259 => 125,  241 => 112,  233 => 107,  225 => 102,  217 => 97,  207 => 90,  198 => 84,  186 => 75,  177 => 69,  165 => 60,  156 => 54,  144 => 45,  135 => 39,  123 => 30,  119 => 29,  108 => 21,  104 => 20,  94 => 13,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Tracking Entry - PinkShield{% endblock %}

{% block body %}
<div class=\"container mt-5 mb-5\">
    <div class=\"row\">
        <div class=\"col-md-8 offset-md-2\">
            <h1 class=\"mb-4\"><i class=\"fas fa-edit me-2\"></i>Edit Health Tracking Entry</h1>

            <div class=\"card\">
                <div class=\"card-header bg-warning text-white\">
                    <h5 class=\"mb-0\">Modify Your Entry for {{ tracking.date|date('d M Y') }}</h5>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\">
                        <div class=\"mb-3\">
                            <label for=\"mood\" class=\"form-label\">Mood (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"mood\" name=\"mood\" min=\"1\" max=\"10\" value=\"{{ tracking.mood }}\">
                                <span class=\"input-group-text ms-2\"><span id=\"moodValue\">{{ tracking.mood }}</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Bad, 10 = Excellent</small>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"stress\" class=\"form-label\">Stress Level (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"stress\" name=\"stress\" min=\"1\" max=\"10\" value=\"{{ tracking.stress }}\">
                                <span class=\"input-group-text ms-2\"><span id=\"stressValue\">{{ tracking.stress }}</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Relaxed, 10 = Very Stressed</small>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"anxiety_level\" class=\"form-label\">Anxiety Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"anxiety_level\" name=\"anxiety_level\" min=\"1\" max=\"10\" value=\"{{ tracking.anxietyLevel ?? 5 }}\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"focus_level\" class=\"form-label\">Focus Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"focus_level\" name=\"focus_level\" min=\"1\" max=\"10\" value=\"{{ tracking.focusLevel ?? 5 }}\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"motivation_level\" class=\"form-label\">Motivation Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"motivation_level\" name=\"motivation_level\" min=\"1\" max=\"10\" value=\"{{ tracking.motivationLevel ?? 5 }}\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"social_interaction_level\" class=\"form-label\">Social Interaction (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"social_interaction_level\" name=\"social_interaction_level\" min=\"1\" max=\"10\" value=\"{{ tracking.socialInteractionLevel ?? 5 }}\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"sleep_hours\" class=\"form-label\">Sleep Hours (0-24):</label>
                                    <input type=\"number\" class=\"form-control\" id=\"sleep_hours\" name=\"sleep_hours\" min=\"0\" max=\"24\" step=\"0.5\" value=\"{{ tracking.sleepHours ?? '' }}\" placeholder=\"Hours slept\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"energy_level\" class=\"form-label\">Energy Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"energy_level\" name=\"energy_level\" min=\"1\" max=\"10\" value=\"{{ tracking.energyLevel ?? 5 }}\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"appetite_level\" class=\"form-label\">Appetite Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"appetite_level\" name=\"appetite_level\" min=\"1\" max=\"10\" value=\"{{ tracking.appetiteLevel ?? 5 }}\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"physical_activity_level\" class=\"form-label\">Physical Activity (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"physical_activity_level\" name=\"physical_activity_level\" min=\"1\" max=\"10\" value=\"{{ tracking.physicalActivityLevel ?? 5 }}\">
                                </div>
                            </div>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"water_intake\" class=\"form-label\">Water Intake (%):</label>
                            <input type=\"number\" class=\"form-control\" id=\"water_intake\" name=\"water_intake\" min=\"0\" max=\"100\" value=\"{{ tracking.waterIntake ?? '' }}\" placeholder=\"Percentage of daily goal\">
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"activities\" class=\"form-label\">Activities:</label>
                            <textarea class=\"form-control\" id=\"activities\" name=\"activities\" rows=\"3\" placeholder=\"Describe your activities\">{{ tracking.activities ?? '' }}</textarea>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"symptoms\" class=\"form-label\">Symptoms:</label>
                            <textarea class=\"form-control\" id=\"symptoms\" name=\"symptoms\" rows=\"3\" placeholder=\"Any symptoms or health concerns\">{{ tracking.symptoms ?? '' }}</textarea>
                        </div>

                        <div class=\"mb-3\">
                            <div class=\"form-check\">
                                <input class=\"form-check-input\" type=\"checkbox\" id=\"medication_taken\" name=\"medication_taken\" value=\"1\" {% if tracking.medicationTaken %}checked{% endif %}>
                                <label class=\"form-check-label\" for=\"medication_taken\">
                                    Medication Taken
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class=\"d-flex gap-2\">
                            <button type=\"submit\" class=\"btn btn-warning\">
                                <i class=\"fas fa-save me-2\"></i>Save Changes
                            </button>
                            <a href=\"{{ path('tracking_index') }}\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-times me-2\"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update mood display
    document.getElementById('mood').addEventListener('input', function() {
        document.getElementById('moodValue').textContent = this.value;
    });

    // Update stress display
    document.getElementById('stress').addEventListener('input', function() {
        document.getElementById('stressValue').textContent = this.value;
    });
</script>
{% endblock %}
", "tracking/edit.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\tracking\\edit.html.twig");
    }
}
