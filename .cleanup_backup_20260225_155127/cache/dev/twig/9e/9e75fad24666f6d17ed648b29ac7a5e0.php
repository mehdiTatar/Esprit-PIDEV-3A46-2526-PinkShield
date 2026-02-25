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

/* tracking/index.html.twig */
class __TwigTemplate_055c2998bf2ab4057334480b9e136bee extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tracking/index.html.twig"));

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

        yield "Daily Tracking - PinkShield";
        
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
        <div class=\"col-12\">
            <h1 class=\"mb-4\"><i class=\"fas fa-heart me-2\"></i>Daily Health Tracking</h1>
        </div>
    </div>

    <!-- Form Section -->
    <div class=\"row mb-4\">
        <div class=\"col-md-6\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white\">
                    <h5 class=\"mb-0\">Today's Entry</h5>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\" action=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("tracking_index");
        yield "\">
                        <div class=\"mb-3\">
                            <label for=\"mood\" class=\"form-label\">Mood (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"mood\" name=\"mood\" min=\"1\" max=\"10\" value=\"5\">
                                <span class=\"input-group-text ms-2\"><span id=\"moodValue\">5</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Bad, 10 = Excellent</small>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"stress\" class=\"form-label\">Stress Level (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"stress\" name=\"stress\" min=\"1\" max=\"10\" value=\"5\">>
                                <span class=\"input-group-text ms-2\"><span id=\"stressValue\">5</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Relaxed, 10 = Very Stressed</small>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"anxiety_level\" class=\"form-label\">Anxiety Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"anxiety_level\" name=\"anxiety_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"focus_level\" class=\"form-label\">Focus Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"focus_level\" name=\"focus_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"motivation_level\" class=\"form-label\">Motivation Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"motivation_level\" name=\"motivation_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"social_interaction_level\" class=\"form-label\">Social Interaction (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"social_interaction_level\" name=\"social_interaction_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"sleep_hours\" class=\"form-label\">Sleep Hours (0-24):</label>
                                    <input type=\"number\" class=\"form-control\" id=\"sleep_hours\" name=\"sleep_hours\" min=\"0\" max=\"24\" step=\"0.5\" placeholder=\"Hours slept\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"energy_level\" class=\"form-label\">Energy Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"energy_level\" name=\"energy_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"appetite_level\" class=\"form-label\">Appetite Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"appetite_level\" name=\"appetite_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"physical_activity_level\" class=\"form-label\">Physical Activity (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"physical_activity_level\" name=\"physical_activity_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"water_intake\" class=\"form-label\">Water Intake (%):</label>
                                    <input type=\"number\" class=\"form-control\" id=\"water_intake\" name=\"water_intake\" min=\"0\" max=\"100\" placeholder=\"0-100%\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"medication_taken\" class=\"form-label\">Medication Status:</label>
                                    <div class=\"form-check\">
                                        <input class=\"form-check-input\" type=\"checkbox\" id=\"medication_taken\" name=\"medication_taken\" value=\"1\">
                                        <label class=\"form-check-label\" for=\"medication_taken\">
                                            Medication taken today
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"symptoms\" class=\"form-label\">Symptoms & Notes:</label>
                            <textarea id=\"symptoms\" name=\"symptoms\" class=\"form-control\" rows=\"3\" placeholder=\"Any symptoms or health concerns?\"></textarea>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"activities\" class=\"form-label\">Activities & Daily Notes:</label>
                            <textarea id=\"activities\" name=\"activities\" class=\"form-control\" rows=\"3\" placeholder=\"What did you do today? Any notes?\"></textarea>
                        </div>

                        <button type=\"submit\" class=\"btn btn-primary w-100\">
                            <i class=\"fas fa-save me-2\"></i>Save Entry
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class=\"col-md-6\">
            <div class=\"card\">
                <div class=\"card-header bg-success text-white\">
                    <h5 class=\"mb-0\">Your Statistics</h5>
                </div>
                <div class=\"card-body\">
                    ";
        // line 145
        if (((isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 145, $this->source); })()) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 145, $this->source); })()), "averageMood", [], "any", false, false, false, 145))) {
            // line 146
            yield "                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Mood</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: ";
            // line 151
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 151, $this->source); })()), "averageMood", [], "any", false, false, false, 151) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 152
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 152, $this->source); })()), "averageMood", [], "any", false, false, false, 152), 1), "html", null, true);
            yield "/10
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Stress</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar ";
            // line 161
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 161, $this->source); })()), "averageStress", [], "any", false, false, false, 161) > 7)) {
                yield "bg-danger";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 161, $this->source); })()), "averageStress", [], "any", false, false, false, 161) > 5)) {
                yield "bg-warning";
            } else {
                yield "bg-success";
            }
            yield "\" role=\"progressbar\" style=\"width: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 161, $this->source); })()), "averageStress", [], "any", false, false, false, 161) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 162
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 162, $this->source); })()), "averageStress", [], "any", false, false, false, 162), 1), "html", null, true);
            yield "/10
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Anxiety</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: ";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 174, $this->source); })()), "averageAnxiety", [], "any", false, false, false, 174) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 175
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 175, $this->source); })()), "averageAnxiety", [], "any", false, false, false, 175)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 175, $this->source); })()), "averageAnxiety", [], "any", false, false, false, 175), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 176
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Focus</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: ";
            // line 184
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 184, $this->source); })()), "averageFocus", [], "any", false, false, false, 184) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 185
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 185, $this->source); })()), "averageFocus", [], "any", false, false, false, 185)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 185, $this->source); })()), "averageFocus", [], "any", false, false, false, 185), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 186
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Motivation</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: ";
            // line 197
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 197, $this->source); })()), "averageMotivation", [], "any", false, false, false, 197) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 198
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 198, $this->source); })()), "averageMotivation", [], "any", false, false, false, 198)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 198, $this->source); })()), "averageMotivation", [], "any", false, false, false, 198), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 199
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Energy</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: ";
            // line 207
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 207, $this->source); })()), "averageEnergy", [], "any", false, false, false, 207) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 208
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 208, $this->source); })()), "averageEnergy", [], "any", false, false, false, 208)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 208, $this->source); })()), "averageEnergy", [], "any", false, false, false, 208), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 209
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Sleep Hours</h6>
                                    <p class=\"text-center\"><strong>";
            // line 219
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 219, $this->source); })()), "averageSleepHours", [], "any", false, false, false, 219)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 219, $this->source); })()), "averageSleepHours", [], "any", false, false, false, 219), 1), "html", null, true);
                yield "h";
            } else {
                yield "--";
            }
            yield "</strong></p>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Social Interaction</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-secondary\" role=\"progressbar\" style=\"width: ";
            // line 226
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 226, $this->source); })()), "averageSocialInteraction", [], "any", false, false, false, 226) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 227
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 227, $this->source); })()), "averageSocialInteraction", [], "any", false, false, false, 227)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 227, $this->source); })()), "averageSocialInteraction", [], "any", false, false, false, 227), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 228
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Appetite</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: ";
            // line 239
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 239, $this->source); })()), "averageAppetite", [], "any", false, false, false, 239) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 240
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 240, $this->source); })()), "averageAppetite", [], "any", false, false, false, 240)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 240, $this->source); })()), "averageAppetite", [], "any", false, false, false, 240), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 241
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Physical Activity</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: ";
            // line 249
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 249, $this->source); })()), "averagePhysicalActivity", [], "any", false, false, false, 249) / 10) * 100), "html", null, true);
            yield "%;\">
                                            ";
            // line 250
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 250, $this->source); })()), "averagePhysicalActivity", [], "any", false, false, false, 250)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 250, $this->source); })()), "averagePhysicalActivity", [], "any", false, false, false, 250), 1), "html", null, true);
                yield "/10";
            } else {
                yield "--";
            }
            // line 251
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-12\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Water Intake</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: ";
            // line 262
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 262, $this->source); })()), "averageWaterIntake", [], "any", false, false, false, 262), "html", null, true);
            yield "%;\">
                                            ";
            // line 263
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 263, $this->source); })()), "averageWaterIntake", [], "any", false, false, false, 263)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 263, $this->source); })()), "averageWaterIntake", [], "any", false, false, false, 263), 0), "html", null, true);
                yield "%";
            } else {
                yield "--";
            }
            // line 264
            yield "                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class=\"alert alert-info\">
                            <i class=\"fas fa-lightbulb me-2\"></i>
                            <strong>Suggestion:</strong> ";
            // line 273
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["suggestion"]) || array_key_exists("suggestion", $context) ? $context["suggestion"] : (function () { throw new RuntimeError('Variable "suggestion" does not exist.', 273, $this->source); })()), "html", null, true);
            yield "
                        </div>
                    ";
        } else {
            // line 276
            yield "                        <p class=\"text-muted\">No data yet. Start tracking to see your statistics!</p>
                    ";
        }
        // line 278
        yield "                </div>
            </div>
        </div>
    </div>

    <!-- Recent Entries Section -->
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header bg-secondary text-white\">
                    <h5 class=\"mb-0\">Recent Entries</h5>
                </div>
                <div class=\"card-body\">
                    ";
        // line 291
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["recentEntries"]) || array_key_exists("recentEntries", $context) ? $context["recentEntries"] : (function () { throw new RuntimeError('Variable "recentEntries" does not exist.', 291, $this->source); })())) > 0)) {
            // line 292
            yield "                        <div class=\"table-responsive\">
                            <table class=\"table table-hover\">
                                <thead class=\"table-light\">
                                    <tr>
                                        <th>Date</th>
                                        <th>Mood</th>
                                        <th>Stress</th>
                                        <th>Activities</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
            // line 304
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recentEntries"]) || array_key_exists("recentEntries", $context) ? $context["recentEntries"] : (function () { throw new RuntimeError('Variable "recentEntries" does not exist.', 304, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
                // line 305
                yield "                                        <tr>
                                            <td>";
                // line 306
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "date", [], "any", false, false, false, 306), "d M Y"), "html", null, true);
                yield "</td>
                                            <td>
                                                <span class=\"badge bg-";
                // line 308
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "mood", [], "any", false, false, false, 308) >= 7)) {
                    yield "success";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "mood", [], "any", false, false, false, 308) >= 4)) {
                    yield "warning";
                } else {
                    yield "danger";
                }
                yield "\">
                                                    ";
                // line 309
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "mood", [], "any", false, false, false, 309), "html", null, true);
                yield "/10
                                                </span>
                                            </td>
                                            <td>
                                                <span class=\"badge bg-";
                // line 313
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "stress", [], "any", false, false, false, 313) <= 3)) {
                    yield "success";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "stress", [], "any", false, false, false, 313) <= 6)) {
                    yield "warning";
                } else {
                    yield "danger";
                }
                yield "\">
                                                    ";
                // line 314
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "stress", [], "any", false, false, false, 314), "html", null, true);
                yield "/10
                                                </span>
                                            </td>
                                            <td>
                                                <span title=\"";
                // line 318
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "activities", [], "any", false, false, false, 318), "html", null, true);
                yield "\">
                                                    ";
                // line 319
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "activities", [], "any", false, false, false, 319), 0, 50), "html", null, true);
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "activities", [], "any", false, false, false, 319)) > 50)) {
                    yield "...";
                }
                // line 320
                yield "                                                </span>
                                            </td>
                                            <td>
                                                <a href=\"";
                // line 323
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("tracking_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 323)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-warning\" title=\"Edit entry\">
                                                    <i class=\"fas fa-edit\"></i> Edit
                                                </a>
                                                <form method=\"post\" action=\"";
                // line 326
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("tracking_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["entry"], "id", [], "any", false, false, false, 326)]), "html", null, true);
                yield "\" style=\"display:inline;\" onsubmit=\"return confirm('Are you sure you want to delete this entry?');\">
                                                    <button type=\"submit\" class=\"btn btn-sm btn-danger\" title=\"Delete entry\">
                                                        <i class=\"fas fa-trash\"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['entry'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 334
            yield "                                </tbody>
                            </table>
                        </div>
                    ";
        } else {
            // line 338
            yield "                        <p class=\"text-muted text-center\">No tracking entries yet. Start by adding your first entry above!</p>
                    ";
        }
        // line 340
        yield "                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Statistics Section -->
    <div class=\"row mt-5\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header bg-dark text-white\">
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <h5 class=\"mb-0\"><i class=\"fas fa-chart-line me-2\"></i>Advanced Analytics</h5>
                        <span class=\"badge bg-light text-dark\">";
        // line 352
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 352, $this->source); })()), "totalEntries", [], "any", false, false, false, 352), "html", null, true);
        yield " Entries</span>
                    </div>
                </div>
                <div class=\"card-body\">
                    <!-- Tabs for different analytics -->
                    <ul class=\"nav nav-tabs mb-4\" role=\"tablist\">
                        <li class=\"nav-item\" role=\"presentation\">
                            <button class=\"nav-link active\" id=\"trends-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#trends\" type=\"button\" role=\"tab\">Trends</button>
                        </li>
                        <li class=\"nav-item\" role=\"presentation\">
                            <button class=\"nav-link\" id=\"comparison-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#comparison\" type=\"button\" role=\"tab\">Weekly Comparison</button>
                        </li>
                        <li class=\"nav-item\" role=\"presentation\">
                            <button class=\"nav-link\" id=\"insights-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#insights\" type=\"button\" role=\"tab\">Health Insights</button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class=\"tab-content\">
                        <!-- Trends Tab -->
                        <div class=\"tab-pane fade show active\" id=\"trends\" role=\"tabpanel\">
                            <div class=\"row mb-4\">
                                <div class=\"col-md-6\">
                                    <div class=\"card bg-light\">
                                        <div class=\"card-body text-center\">
                                            <h6 class=\"text-muted\">Mood Trend (Last 7 Days)</h6>
                                            <h4>
                                                ";
        // line 379
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 379, $this->source); })()), "moodTrend", [], "any", false, false, false, 379)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 380
            yield "                                                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 380, $this->source); })()), "moodTrend", [], "any", false, false, false, 380) > 0.5)) {
                // line 381
                yield "                                                        <span class=\"text-success\"><i class=\"fas fa-trending-up\"></i> +";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 381, $this->source); })()), "moodTrend", [], "any", false, false, false, 381), 1), "html", null, true);
                yield "</span>
                                                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 382
(isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 382, $this->source); })()), "moodTrend", [], "any", false, false, false, 382) <  -0.5)) {
                // line 383
                yield "                                                        <span class=\"text-danger\"><i class=\"fas fa-trending-down\"></i> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 383, $this->source); })()), "moodTrend", [], "any", false, false, false, 383), 1), "html", null, true);
                yield "</span>
                                                    ";
            } else {
                // line 385
                yield "                                                        <span class=\"text-warning\"><i class=\"fas fa-minus\"></i> Stable</span>
                                                    ";
            }
            // line 387
            yield "                                                ";
        } else {
            // line 388
            yield "                                                    <span class=\"text-muted\">No trend data</span>
                                                ";
        }
        // line 390
        yield "                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <div class=\"card bg-light\">
                                        <div class=\"card-body text-center\">
                                            <h6 class=\"text-muted\">Stress Trend (Last 7 Days)</h6>
                                            <h4>
                                                ";
        // line 399
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 399, $this->source); })()), "stressTrend", [], "any", false, false, false, 399)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 400
            yield "                                                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 400, $this->source); })()), "stressTrend", [], "any", false, false, false, 400) <  -0.5)) {
                // line 401
                yield "                                                        <span class=\"text-success\"><i class=\"fas fa-trending-down\"></i> ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 401, $this->source); })()), "stressTrend", [], "any", false, false, false, 401), 1), "html", null, true);
                yield "</span>
                                                    ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 402
(isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 402, $this->source); })()), "stressTrend", [], "any", false, false, false, 402) > 0.5)) {
                // line 403
                yield "                                                        <span class=\"text-danger\"><i class=\"fas fa-trending-up\"></i> +";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 403, $this->source); })()), "stressTrend", [], "any", false, false, false, 403), 1), "html", null, true);
                yield "</span>
                                                    ";
            } else {
                // line 405
                yield "                                                        <span class=\"text-warning\"><i class=\"fas fa-minus\"></i> Stable</span>
                                                    ";
            }
            // line 407
            yield "                                                ";
        } else {
            // line 408
            yield "                                                    <span class=\"text-muted\">No trend data</span>
                                                ";
        }
        // line 410
        yield "                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <canvas id=\"trendChart\" height=\"80\"></canvas>
                        </div>

                        <!-- Weekly Comparison Tab -->
                        <div class=\"tab-pane fade\" id=\"comparison\" role=\"tabpanel\">
                            <div class=\"table-responsive\">
                                <table class=\"table table-hover table-sm\">
                                    <thead class=\"table-light\">
                                        <tr>
                                            <th>Date</th>
                                            <th>Mood</th>
                                            <th>Stress</th>
                                            <th>Energy</th>
                                            <th>Sleep</th>
                                            <th>Anxiety</th>
                                            <th>Motivation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";
        // line 435
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["weeklyData"]) || array_key_exists("weeklyData", $context) ? $context["weeklyData"] : (function () { throw new RuntimeError('Variable "weeklyData" does not exist.', 435, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
            // line 436
            yield "                                            <tr>
                                                <td><strong>";
            // line 437
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "date", [], "any", false, false, false, 437), "M d"), "html", null, true);
            yield "</strong></td>
                                                <td>
                                                    ";
            // line 439
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["day"], "mood", [], "any", false, false, false, 439)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 440
                yield "                                                        <span class=\"badge bg-info\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "mood", [], "any", false, false, false, 440), 1), "html", null, true);
                yield "/10</span>
                                                    ";
            } else {
                // line 442
                yield "                                                        <span class=\"text-muted\">--</span>
                                                    ";
            }
            // line 444
            yield "                                                </td>
                                                <td>
                                                    ";
            // line 446
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", false, false, false, 446)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 447
                yield "                                                        <span class=\"badge bg-";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", false, false, false, 447) > 7)) {
                    yield "danger";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", false, false, false, 447) > 5)) {
                    yield "warning";
                } else {
                    yield "success";
                }
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", false, false, false, 447), 1), "html", null, true);
                yield "/10</span>
                                                    ";
            } else {
                // line 449
                yield "                                                        <span class=\"text-muted\">--</span>
                                                    ";
            }
            // line 451
            yield "                                                </td>
                                                <td>
                                                    ";
            // line 453
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["day"], "energy", [], "any", false, false, false, 453)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 454
                yield "                                                        <span class=\"badge bg-warning\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "energy", [], "any", false, false, false, 454), 1), "html", null, true);
                yield "/10</span>
                                                    ";
            } else {
                // line 456
                yield "                                                        <span class=\"text-muted\">--</span>
                                                    ";
            }
            // line 458
            yield "                                                </td>
                                                <td>
                                                    ";
            // line 460
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["day"], "sleep", [], "any", false, false, false, 460)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 461
                yield "                                                        <span class=\"badge bg-secondary\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "sleep", [], "any", false, false, false, 461), 1), "html", null, true);
                yield "h</span>
                                                    ";
            } else {
                // line 463
                yield "                                                        <span class=\"text-muted\">--</span>
                                                    ";
            }
            // line 465
            yield "                                                </td>
                                                <td>
                                                    ";
            // line 467
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["day"], "anxiety", [], "any", false, false, false, 467)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 468
                yield "                                                        <span class=\"badge bg-warning\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "anxiety", [], "any", false, false, false, 468), 1), "html", null, true);
                yield "/10</span>
                                                    ";
            } else {
                // line 470
                yield "                                                        <span class=\"text-muted\">--</span>
                                                    ";
            }
            // line 472
            yield "                                                </td>
                                                <td>
                                                    ";
            // line 474
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["day"], "motivation", [], "any", false, false, false, 474)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 475
                yield "                                                        <span class=\"badge bg-success\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "motivation", [], "any", false, false, false, 475), 1), "html", null, true);
                yield "/10</span>
                                                    ";
            } else {
                // line 477
                yield "                                                        <span class=\"text-muted\">--</span>
                                                    ";
            }
            // line 479
            yield "                                                </td>
                                            </tr>
                                        ";
            $context['_iterated'] = true;
        }
        // line 481
        if (!$context['_iterated']) {
            // line 482
            yield "                                            <tr>
                                                <td colspan=\"7\" class=\"text-center text-muted\">No weekly data available</td>
                                            </tr>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['day'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 486
        yield "                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Health Insights Tab -->
                        <div class=\"tab-pane fade\" id=\"insights\" role=\"tabpanel\">
                            <div class=\"row\">
                                <div class=\"col-md-4 mb-3\">
                                    <div class=\"alert alert-warning\">
                                        <strong><i class=\"fas fa-lightbulb me-2\"></i>Sleep Recommendation:</strong>
                                        <p class=\"mt-2 mb-0\">
                                            Your average sleep is <strong>";
        // line 498
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 498, $this->source); })()), "allTime", [], "any", false, false, false, 498), "averageSleepHours", [], "any", false, false, false, 498), 1), "html", null, true);
        yield " hours</strong>.
                                            ";
        // line 499
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 499, $this->source); })()), "allTime", [], "any", false, false, false, 499), "averageSleepHours", [], "any", false, false, false, 499) < 7)) {
            // line 500
            yield "                                                Try to get at least 7-9 hours for better health.
                                            ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 501
(isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 501, $this->source); })()), "allTime", [], "any", false, false, false, 501), "averageSleepHours", [], "any", false, false, false, 501) > 9)) {
            // line 502
            yield "                                                You're getting plenty of sleep. Stay consistent!
                                            ";
        } else {
            // line 504
            yield "                                                Great sleep schedule! Keep it up.
                                            ";
        }
        // line 506
        yield "                                        </p>
                                    </div>
                                </div>

                                <div class=\"col-md-4 mb-3\">
                                    <div class=\"alert alert-info\">
                                        <strong><i class=\"fas fa-water me-2\"></i>Hydration Status:</strong>
                                        <p class=\"mt-2 mb-0\">
                                            Water intake: <strong>";
        // line 514
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 514, $this->source); })()), "allTime", [], "any", false, false, false, 514), "averageWaterIntake", [], "any", false, false, false, 514), 0), "html", null, true);
        yield "%</strong>
                                            ";
        // line 515
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 515, $this->source); })()), "allTime", [], "any", false, false, false, 515), "averageWaterIntake", [], "any", false, false, false, 515) < 50)) {
            // line 516
            yield "                                                You need to drink more water daily!
                                            ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 517
(isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 517, $this->source); })()), "allTime", [], "any", false, false, false, 517), "averageWaterIntake", [], "any", false, false, false, 517) < 80)) {
            // line 518
            yield "                                                Good efforts. Try to reach 100%.
                                            ";
        } else {
            // line 520
            yield "                                                Excellent hydration habits!
                                            ";
        }
        // line 522
        yield "                                        </p>
                                    </div>
                                </div>

                                <div class=\"col-md-4 mb-3\">
                                    <div class=\"alert alert-success\">
                                        <strong><i class=\"fas fa-dumbbell me-2\"></i>Activity Level:</strong>
                                        <p class=\"mt-2 mb-0\">
                                            Physical activity: <strong>";
        // line 530
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 530, $this->source); })()), "allTime", [], "any", false, false, false, 530), "averagePhysicalActivity", [], "any", false, false, false, 530), 1), "html", null, true);
        yield "/10</strong>
                                            ";
        // line 531
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 531, $this->source); })()), "allTime", [], "any", false, false, false, 531), "averagePhysicalActivity", [], "any", false, false, false, 531) < 4)) {
            // line 532
            yield "                                                Increase your physical activity for better health.
                                            ";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 533
(isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 533, $this->source); })()), "allTime", [], "any", false, false, false, 533), "averagePhysicalActivity", [], "any", false, false, false, 533) < 7)) {
            // line 534
            yield "                                                Good activity level. Consider adding more exercise.
                                            ";
        } else {
            // line 536
            yield "                                                Excellent! You're very active.
                                            ";
        }
        // line 538
        yield "                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-12\">
                                    <h6 class=\"mb-3\">Overall Health Score</h6>
                                    ";
        // line 546
        $context["healthScore"] = Twig\Extension\CoreExtension::round((((((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 546, $this->source); })()), "allTime", [], "any", false, false, false, 546), "averageMood", [], "any", false, false, false, 546) / 10) * 20) + ((1 - (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 546, $this->source); })()), "allTime", [], "any", false, false, false, 546), "averageStress", [], "any", false, false, false, 546) / 10)) * 20)) + ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 546, $this->source); })()), "allTime", [], "any", false, false, false, 546), "averageEnergy", [], "any", false, false, false, 546) / 10) * 15)) + ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 546, $this->source); })()), "allTime", [], "any", false, false, false, 546), "averageSleepHours", [], "any", false, false, false, 546) / 9) * 15)) + ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 546, $this->source); })()), "allTime", [], "any", false, false, false, 546), "averagePhysicalActivity", [], "any", false, false, false, 546) / 10) * 15)) + ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["advancedStats"]) || array_key_exists("advancedStats", $context) ? $context["advancedStats"] : (function () { throw new RuntimeError('Variable "advancedStats" does not exist.', 546, $this->source); })()), "allTime", [], "any", false, false, false, 546), "averageWaterIntake", [], "any", false, false, false, 546) / 100) * 15)), 0);
        // line 547
        yield "                                    <div class=\"progress\" style=\"height: 40px;\">
                                        <div class=\"progress-bar bg-";
        // line 548
        if (((isset($context["healthScore"]) || array_key_exists("healthScore", $context) ? $context["healthScore"] : (function () { throw new RuntimeError('Variable "healthScore" does not exist.', 548, $this->source); })()) >= 80)) {
            yield "success";
        } elseif (((isset($context["healthScore"]) || array_key_exists("healthScore", $context) ? $context["healthScore"] : (function () { throw new RuntimeError('Variable "healthScore" does not exist.', 548, $this->source); })()) >= 60)) {
            yield "warning";
        } else {
            yield "danger";
        }
        yield "\" role=\"progressbar\" style=\"width: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["healthScore"]) || array_key_exists("healthScore", $context) ? $context["healthScore"] : (function () { throw new RuntimeError('Variable "healthScore" does not exist.', 548, $this->source); })()), "html", null, true);
        yield "%;\">
                                            <strong>";
        // line 549
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["healthScore"]) || array_key_exists("healthScore", $context) ? $context["healthScore"] : (function () { throw new RuntimeError('Variable "healthScore" does not exist.', 549, $this->source); })()), "html", null, true);
        yield "/100</strong>
                                        </div>
                                    </div>
                                    <p class=\"text-muted small mt-2\">
                                        ";
        // line 553
        if (((isset($context["healthScore"]) || array_key_exists("healthScore", $context) ? $context["healthScore"] : (function () { throw new RuntimeError('Variable "healthScore" does not exist.', 553, $this->source); })()) >= 80)) {
            // line 554
            yield "                                            <i class=\"fas fa-check-circle text-success me-2\"></i>Excellent overall health! Keep maintaining your habits.
                                        ";
        } elseif ((        // line 555
(isset($context["healthScore"]) || array_key_exists("healthScore", $context) ? $context["healthScore"] : (function () { throw new RuntimeError('Variable "healthScore" does not exist.', 555, $this->source); })()) >= 60)) {
            // line 556
            yield "                                            <i class=\"fas fa-exclamation-circle text-warning me-2\"></i>Good health. Focus on improving specific areas.
                                        ";
        } else {
            // line 558
            yield "                                            <i class=\"fas fa-times-circle text-danger me-2\"></i>Health needs improvement. Start with small daily changes.
                                        ";
        }
        // line 560
        yield "                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
    // Update mood value display
    document.getElementById('mood').addEventListener('input', function() {
        document.getElementById('moodValue').textContent = this.value;
    });

    // Update stress value display
    document.getElementById('stress').addEventListener('input', function() {
        document.getElementById('stressValue').textContent = this.value;
    });

    // Chart.js - Trend Chart
    ";
        // line 584
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["weeklyData"]) || array_key_exists("weeklyData", $context) ? $context["weeklyData"] : (function () { throw new RuntimeError('Variable "weeklyData" does not exist.', 584, $this->source); })())) > 0)) {
            // line 585
            yield "    const ctx = document.getElementById('trendChart').getContext('2d');
    const labels = [
        ";
            // line 587
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["weeklyData"]) || array_key_exists("weeklyData", $context) ? $context["weeklyData"] : (function () { throw new RuntimeError('Variable "weeklyData" does not exist.', 587, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
                yield "'";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "date", [], "any", false, false, false, 587), "M d"), "html", null, true);
                yield "'";
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 587)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['day'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 588
            yield "    ];
    
    const moodData = [
        ";
            // line 591
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["weeklyData"]) || array_key_exists("weeklyData", $context) ? $context["weeklyData"] : (function () { throw new RuntimeError('Variable "weeklyData" does not exist.', 591, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["day"], "mood", [], "any", true, true, false, 591) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["day"], "mood", [], "any", false, false, false, 591)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "mood", [], "any", false, false, false, 591), "html", null, true)) : ("null"));
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 591)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['day'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 592
            yield "    ];
    
    const stressData = [
        ";
            // line 595
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["weeklyData"]) || array_key_exists("weeklyData", $context) ? $context["weeklyData"] : (function () { throw new RuntimeError('Variable "weeklyData" does not exist.', 595, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", true, true, false, 595) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", false, false, false, 595)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "stress", [], "any", false, false, false, 595), "html", null, true)) : ("null"));
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 595)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['day'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 596
            yield "    ];
    
    const energyData = [
        ";
            // line 599
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["weeklyData"]) || array_key_exists("weeklyData", $context) ? $context["weeklyData"] : (function () { throw new RuntimeError('Variable "weeklyData" does not exist.', 599, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["day"], "energy", [], "any", true, true, false, 599) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["day"], "energy", [], "any", false, false, false, 599)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["day"], "energy", [], "any", false, false, false, 599), "html", null, true)) : ("null"));
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 599)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['day'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 600
            yield "    ];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Mood',
                    data: moodData,
                    borderColor: '#0dcaf0',
                    backgroundColor: 'rgba(13, 202, 240, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Stress',
                    data: stressData,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Energy',
                    data: energyData,
                    borderColor: '#ffc107',
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Your Health Metrics Trend (Last 7 Days)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10,
                    title: {
                        display: true,
                        text: 'Score'
                    }
                }
            }
        }
    });
    ";
        }
        // line 655
        yield "</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "tracking/index.html.twig";
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
        return array (  1255 => 655,  1198 => 600,  1165 => 599,  1160 => 596,  1127 => 595,  1122 => 592,  1089 => 591,  1084 => 588,  1049 => 587,  1045 => 585,  1043 => 584,  1017 => 560,  1013 => 558,  1009 => 556,  1007 => 555,  1004 => 554,  1002 => 553,  995 => 549,  983 => 548,  980 => 547,  978 => 546,  968 => 538,  964 => 536,  960 => 534,  958 => 533,  955 => 532,  953 => 531,  949 => 530,  939 => 522,  935 => 520,  931 => 518,  929 => 517,  926 => 516,  924 => 515,  920 => 514,  910 => 506,  906 => 504,  902 => 502,  900 => 501,  897 => 500,  895 => 499,  891 => 498,  877 => 486,  868 => 482,  866 => 481,  860 => 479,  856 => 477,  850 => 475,  848 => 474,  844 => 472,  840 => 470,  834 => 468,  832 => 467,  828 => 465,  824 => 463,  818 => 461,  816 => 460,  812 => 458,  808 => 456,  802 => 454,  800 => 453,  796 => 451,  792 => 449,  778 => 447,  776 => 446,  772 => 444,  768 => 442,  762 => 440,  760 => 439,  755 => 437,  752 => 436,  747 => 435,  720 => 410,  716 => 408,  713 => 407,  709 => 405,  703 => 403,  701 => 402,  696 => 401,  693 => 400,  691 => 399,  680 => 390,  676 => 388,  673 => 387,  669 => 385,  663 => 383,  661 => 382,  656 => 381,  653 => 380,  651 => 379,  621 => 352,  607 => 340,  603 => 338,  597 => 334,  583 => 326,  577 => 323,  572 => 320,  567 => 319,  563 => 318,  556 => 314,  546 => 313,  539 => 309,  529 => 308,  524 => 306,  521 => 305,  517 => 304,  503 => 292,  501 => 291,  486 => 278,  482 => 276,  476 => 273,  465 => 264,  458 => 263,  454 => 262,  441 => 251,  434 => 250,  430 => 249,  420 => 241,  413 => 240,  409 => 239,  396 => 228,  389 => 227,  385 => 226,  370 => 219,  358 => 209,  351 => 208,  347 => 207,  337 => 199,  330 => 198,  326 => 197,  313 => 186,  306 => 185,  302 => 184,  292 => 176,  285 => 175,  281 => 174,  266 => 162,  254 => 161,  242 => 152,  238 => 151,  231 => 146,  229 => 145,  102 => 21,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Daily Tracking - PinkShield{% endblock %}

{% block body %}
<div class=\"container mt-5 mb-5\">
    <div class=\"row\">
        <div class=\"col-12\">
            <h1 class=\"mb-4\"><i class=\"fas fa-heart me-2\"></i>Daily Health Tracking</h1>
        </div>
    </div>

    <!-- Form Section -->
    <div class=\"row mb-4\">
        <div class=\"col-md-6\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white\">
                    <h5 class=\"mb-0\">Today's Entry</h5>
                </div>
                <div class=\"card-body\">
                    <form method=\"post\" action=\"{{ path('tracking_index') }}\">
                        <div class=\"mb-3\">
                            <label for=\"mood\" class=\"form-label\">Mood (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"mood\" name=\"mood\" min=\"1\" max=\"10\" value=\"5\">
                                <span class=\"input-group-text ms-2\"><span id=\"moodValue\">5</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Bad, 10 = Excellent</small>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"stress\" class=\"form-label\">Stress Level (1-10):</label>
                            <div class=\"input-group\">
                                <input type=\"range\" class=\"form-range\" id=\"stress\" name=\"stress\" min=\"1\" max=\"10\" value=\"5\">>
                                <span class=\"input-group-text ms-2\"><span id=\"stressValue\">5</span>/10</span>
                            </div>
                            <small class=\"text-muted\">1 = Very Relaxed, 10 = Very Stressed</small>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"anxiety_level\" class=\"form-label\">Anxiety Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"anxiety_level\" name=\"anxiety_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"focus_level\" class=\"form-label\">Focus Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"focus_level\" name=\"focus_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"motivation_level\" class=\"form-label\">Motivation Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"motivation_level\" name=\"motivation_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"social_interaction_level\" class=\"form-label\">Social Interaction (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"social_interaction_level\" name=\"social_interaction_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"sleep_hours\" class=\"form-label\">Sleep Hours (0-24):</label>
                                    <input type=\"number\" class=\"form-control\" id=\"sleep_hours\" name=\"sleep_hours\" min=\"0\" max=\"24\" step=\"0.5\" placeholder=\"Hours slept\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"energy_level\" class=\"form-label\">Energy Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"energy_level\" name=\"energy_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"appetite_level\" class=\"form-label\">Appetite Level (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"appetite_level\" name=\"appetite_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"physical_activity_level\" class=\"form-label\">Physical Activity (1-10):</label>
                                    <input type=\"range\" class=\"form-range\" id=\"physical_activity_level\" name=\"physical_activity_level\" min=\"1\" max=\"10\">
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"water_intake\" class=\"form-label\">Water Intake (%):</label>
                                    <input type=\"number\" class=\"form-control\" id=\"water_intake\" name=\"water_intake\" min=\"0\" max=\"100\" placeholder=\"0-100%\">
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"mb-3\">
                                    <label for=\"medication_taken\" class=\"form-label\">Medication Status:</label>
                                    <div class=\"form-check\">
                                        <input class=\"form-check-input\" type=\"checkbox\" id=\"medication_taken\" name=\"medication_taken\" value=\"1\">
                                        <label class=\"form-check-label\" for=\"medication_taken\">
                                            Medication taken today
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"symptoms\" class=\"form-label\">Symptoms & Notes:</label>
                            <textarea id=\"symptoms\" name=\"symptoms\" class=\"form-control\" rows=\"3\" placeholder=\"Any symptoms or health concerns?\"></textarea>
                        </div>

                        <div class=\"mb-3\">
                            <label for=\"activities\" class=\"form-label\">Activities & Daily Notes:</label>
                            <textarea id=\"activities\" name=\"activities\" class=\"form-control\" rows=\"3\" placeholder=\"What did you do today? Any notes?\"></textarea>
                        </div>

                        <button type=\"submit\" class=\"btn btn-primary w-100\">
                            <i class=\"fas fa-save me-2\"></i>Save Entry
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class=\"col-md-6\">
            <div class=\"card\">
                <div class=\"card-header bg-success text-white\">
                    <h5 class=\"mb-0\">Your Statistics</h5>
                </div>
                <div class=\"card-body\">
                    {% if stats and stats.averageMood %}
                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Mood</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: {{ (stats.averageMood / 10) * 100 }}%;\">
                                            {{ stats.averageMood|round(1) }}/10
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Stress</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar {% if stats.averageStress > 7 %}bg-danger{% elseif stats.averageStress > 5 %}bg-warning{% else %}bg-success{% endif %}\" role=\"progressbar\" style=\"width: {{ (stats.averageStress / 10) * 100 }}%;\">
                                            {{ stats.averageStress|round(1) }}/10
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Anxiety</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: {{ (stats.averageAnxiety / 10) * 100 }}%;\">
                                            {% if stats.averageAnxiety %}{{ stats.averageAnxiety|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Focus</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: {{ (stats.averageFocus / 10) * 100 }}%;\">
                                            {% if stats.averageFocus %}{{ stats.averageFocus|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Motivation</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: {{ (stats.averageMotivation / 10) * 100 }}%;\">
                                            {% if stats.averageMotivation %}{{ stats.averageMotivation|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Energy</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-warning\" role=\"progressbar\" style=\"width: {{ (stats.averageEnergy / 10) * 100 }}%;\">
                                            {% if stats.averageEnergy %}{{ stats.averageEnergy|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Sleep Hours</h6>
                                    <p class=\"text-center\"><strong>{% if stats.averageSleepHours %}{{ stats.averageSleepHours|round(1) }}h{% else %}--{% endif %}</strong></p>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Social Interaction</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-secondary\" role=\"progressbar\" style=\"width: {{ (stats.averageSocialInteraction / 10) * 100 }}%;\">
                                            {% if stats.averageSocialInteraction %}{{ stats.averageSocialInteraction|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Appetite</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: {{ (stats.averageAppetite / 10) * 100 }}%;\">
                                            {% if stats.averageAppetite %}{{ stats.averageAppetite|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-6\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Physical Activity</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: {{ (stats.averagePhysicalActivity / 10) * 100 }}%;\">
                                            {% if stats.averagePhysicalActivity %}{{ stats.averagePhysicalActivity|round(1) }}/10{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-12\">
                                <div class=\"mb-3\">
                                    <h6 class=\"small\">Water Intake</h6>
                                    <div class=\"progress\" style=\"height: 25px;\">
                                        <div class=\"progress-bar bg-primary\" role=\"progressbar\" style=\"width: {{ stats.averageWaterIntake }}%;\">
                                            {% if stats.averageWaterIntake %}{{ stats.averageWaterIntake|round(0) }}%{% else %}--{% endif %}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class=\"alert alert-info\">
                            <i class=\"fas fa-lightbulb me-2\"></i>
                            <strong>Suggestion:</strong> {{ suggestion }}
                        </div>
                    {% else %}
                        <p class=\"text-muted\">No data yet. Start tracking to see your statistics!</p>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Entries Section -->
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header bg-secondary text-white\">
                    <h5 class=\"mb-0\">Recent Entries</h5>
                </div>
                <div class=\"card-body\">
                    {% if recentEntries|length > 0 %}
                        <div class=\"table-responsive\">
                            <table class=\"table table-hover\">
                                <thead class=\"table-light\">
                                    <tr>
                                        <th>Date</th>
                                        <th>Mood</th>
                                        <th>Stress</th>
                                        <th>Activities</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for entry in recentEntries %}
                                        <tr>
                                            <td>{{ entry.date|date('d M Y') }}</td>
                                            <td>
                                                <span class=\"badge bg-{% if entry.mood >= 7 %}success{% elseif entry.mood >= 4 %}warning{% else %}danger{% endif %}\">
                                                    {{ entry.mood }}/10
                                                </span>
                                            </td>
                                            <td>
                                                <span class=\"badge bg-{% if entry.stress <= 3 %}success{% elseif entry.stress <= 6 %}warning{% else %}danger{% endif %}\">
                                                    {{ entry.stress }}/10
                                                </span>
                                            </td>
                                            <td>
                                                <span title=\"{{ entry.activities }}\">
                                                    {{ entry.activities|slice(0, 50) }}{% if entry.activities|length > 50 %}...{% endif %}
                                                </span>
                                            </td>
                                            <td>
                                                <a href=\"{{ path('tracking_edit', {id: entry.id}) }}\" class=\"btn btn-sm btn-warning\" title=\"Edit entry\">
                                                    <i class=\"fas fa-edit\"></i> Edit
                                                </a>
                                                <form method=\"post\" action=\"{{ path('tracking_delete', {id: entry.id}) }}\" style=\"display:inline;\" onsubmit=\"return confirm('Are you sure you want to delete this entry?');\">
                                                    <button type=\"submit\" class=\"btn btn-sm btn-danger\" title=\"Delete entry\">
                                                        <i class=\"fas fa-trash\"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    {% else %}
                        <p class=\"text-muted text-center\">No tracking entries yet. Start by adding your first entry above!</p>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Statistics Section -->
    <div class=\"row mt-5\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header bg-dark text-white\">
                    <div class=\"d-flex justify-content-between align-items-center\">
                        <h5 class=\"mb-0\"><i class=\"fas fa-chart-line me-2\"></i>Advanced Analytics</h5>
                        <span class=\"badge bg-light text-dark\">{{ advancedStats.totalEntries }} Entries</span>
                    </div>
                </div>
                <div class=\"card-body\">
                    <!-- Tabs for different analytics -->
                    <ul class=\"nav nav-tabs mb-4\" role=\"tablist\">
                        <li class=\"nav-item\" role=\"presentation\">
                            <button class=\"nav-link active\" id=\"trends-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#trends\" type=\"button\" role=\"tab\">Trends</button>
                        </li>
                        <li class=\"nav-item\" role=\"presentation\">
                            <button class=\"nav-link\" id=\"comparison-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#comparison\" type=\"button\" role=\"tab\">Weekly Comparison</button>
                        </li>
                        <li class=\"nav-item\" role=\"presentation\">
                            <button class=\"nav-link\" id=\"insights-tab\" data-bs-toggle=\"tab\" data-bs-target=\"#insights\" type=\"button\" role=\"tab\">Health Insights</button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class=\"tab-content\">
                        <!-- Trends Tab -->
                        <div class=\"tab-pane fade show active\" id=\"trends\" role=\"tabpanel\">
                            <div class=\"row mb-4\">
                                <div class=\"col-md-6\">
                                    <div class=\"card bg-light\">
                                        <div class=\"card-body text-center\">
                                            <h6 class=\"text-muted\">Mood Trend (Last 7 Days)</h6>
                                            <h4>
                                                {% if advancedStats.moodTrend %}
                                                    {% if advancedStats.moodTrend > 0.5 %}
                                                        <span class=\"text-success\"><i class=\"fas fa-trending-up\"></i> +{{ advancedStats.moodTrend|round(1) }}</span>
                                                    {% elseif advancedStats.moodTrend < -0.5 %}
                                                        <span class=\"text-danger\"><i class=\"fas fa-trending-down\"></i> {{ advancedStats.moodTrend|round(1) }}</span>
                                                    {% else %}
                                                        <span class=\"text-warning\"><i class=\"fas fa-minus\"></i> Stable</span>
                                                    {% endif %}
                                                {% else %}
                                                    <span class=\"text-muted\">No trend data</span>
                                                {% endif %}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <div class=\"card bg-light\">
                                        <div class=\"card-body text-center\">
                                            <h6 class=\"text-muted\">Stress Trend (Last 7 Days)</h6>
                                            <h4>
                                                {% if advancedStats.stressTrend %}
                                                    {% if advancedStats.stressTrend < -0.5 %}
                                                        <span class=\"text-success\"><i class=\"fas fa-trending-down\"></i> {{ advancedStats.stressTrend|round(1) }}</span>
                                                    {% elseif advancedStats.stressTrend > 0.5 %}
                                                        <span class=\"text-danger\"><i class=\"fas fa-trending-up\"></i> +{{ advancedStats.stressTrend|round(1) }}</span>
                                                    {% else %}
                                                        <span class=\"text-warning\"><i class=\"fas fa-minus\"></i> Stable</span>
                                                    {% endif %}
                                                {% else %}
                                                    <span class=\"text-muted\">No trend data</span>
                                                {% endif %}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <canvas id=\"trendChart\" height=\"80\"></canvas>
                        </div>

                        <!-- Weekly Comparison Tab -->
                        <div class=\"tab-pane fade\" id=\"comparison\" role=\"tabpanel\">
                            <div class=\"table-responsive\">
                                <table class=\"table table-hover table-sm\">
                                    <thead class=\"table-light\">
                                        <tr>
                                            <th>Date</th>
                                            <th>Mood</th>
                                            <th>Stress</th>
                                            <th>Energy</th>
                                            <th>Sleep</th>
                                            <th>Anxiety</th>
                                            <th>Motivation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {% for day in weeklyData %}
                                            <tr>
                                                <td><strong>{{ day.date|date('M d') }}</strong></td>
                                                <td>
                                                    {% if day.mood %}
                                                        <span class=\"badge bg-info\">{{ day.mood|round(1) }}/10</span>
                                                    {% else %}
                                                        <span class=\"text-muted\">--</span>
                                                    {% endif %}
                                                </td>
                                                <td>
                                                    {% if day.stress %}
                                                        <span class=\"badge bg-{% if day.stress > 7 %}danger{% elseif day.stress > 5 %}warning{% else %}success{% endif %}\">{{ day.stress|round(1) }}/10</span>
                                                    {% else %}
                                                        <span class=\"text-muted\">--</span>
                                                    {% endif %}
                                                </td>
                                                <td>
                                                    {% if day.energy %}
                                                        <span class=\"badge bg-warning\">{{ day.energy|round(1) }}/10</span>
                                                    {% else %}
                                                        <span class=\"text-muted\">--</span>
                                                    {% endif %}
                                                </td>
                                                <td>
                                                    {% if day.sleep %}
                                                        <span class=\"badge bg-secondary\">{{ day.sleep|round(1) }}h</span>
                                                    {% else %}
                                                        <span class=\"text-muted\">--</span>
                                                    {% endif %}
                                                </td>
                                                <td>
                                                    {% if day.anxiety %}
                                                        <span class=\"badge bg-warning\">{{ day.anxiety|round(1) }}/10</span>
                                                    {% else %}
                                                        <span class=\"text-muted\">--</span>
                                                    {% endif %}
                                                </td>
                                                <td>
                                                    {% if day.motivation %}
                                                        <span class=\"badge bg-success\">{{ day.motivation|round(1) }}/10</span>
                                                    {% else %}
                                                        <span class=\"text-muted\">--</span>
                                                    {% endif %}
                                                </td>
                                            </tr>
                                        {% else %}
                                            <tr>
                                                <td colspan=\"7\" class=\"text-center text-muted\">No weekly data available</td>
                                            </tr>
                                        {% endfor %}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Health Insights Tab -->
                        <div class=\"tab-pane fade\" id=\"insights\" role=\"tabpanel\">
                            <div class=\"row\">
                                <div class=\"col-md-4 mb-3\">
                                    <div class=\"alert alert-warning\">
                                        <strong><i class=\"fas fa-lightbulb me-2\"></i>Sleep Recommendation:</strong>
                                        <p class=\"mt-2 mb-0\">
                                            Your average sleep is <strong>{{ advancedStats.allTime.averageSleepHours|round(1) }} hours</strong>.
                                            {% if advancedStats.allTime.averageSleepHours < 7 %}
                                                Try to get at least 7-9 hours for better health.
                                            {% elseif advancedStats.allTime.averageSleepHours > 9 %}
                                                You're getting plenty of sleep. Stay consistent!
                                            {% else %}
                                                Great sleep schedule! Keep it up.
                                            {% endif %}
                                        </p>
                                    </div>
                                </div>

                                <div class=\"col-md-4 mb-3\">
                                    <div class=\"alert alert-info\">
                                        <strong><i class=\"fas fa-water me-2\"></i>Hydration Status:</strong>
                                        <p class=\"mt-2 mb-0\">
                                            Water intake: <strong>{{ advancedStats.allTime.averageWaterIntake|round(0) }}%</strong>
                                            {% if advancedStats.allTime.averageWaterIntake < 50 %}
                                                You need to drink more water daily!
                                            {% elseif advancedStats.allTime.averageWaterIntake < 80 %}
                                                Good efforts. Try to reach 100%.
                                            {% else %}
                                                Excellent hydration habits!
                                            {% endif %}
                                        </p>
                                    </div>
                                </div>

                                <div class=\"col-md-4 mb-3\">
                                    <div class=\"alert alert-success\">
                                        <strong><i class=\"fas fa-dumbbell me-2\"></i>Activity Level:</strong>
                                        <p class=\"mt-2 mb-0\">
                                            Physical activity: <strong>{{ advancedStats.allTime.averagePhysicalActivity|round(1) }}/10</strong>
                                            {% if advancedStats.allTime.averagePhysicalActivity < 4 %}
                                                Increase your physical activity for better health.
                                            {% elseif advancedStats.allTime.averagePhysicalActivity < 7 %}
                                                Good activity level. Consider adding more exercise.
                                            {% else %}
                                                Excellent! You're very active.
                                            {% endif %}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-12\">
                                    <h6 class=\"mb-3\">Overall Health Score</h6>
                                    {% set healthScore = ((advancedStats.allTime.averageMood / 10) * 20 + (1 - advancedStats.allTime.averageStress / 10) * 20 + (advancedStats.allTime.averageEnergy / 10) * 15 + (advancedStats.allTime.averageSleepHours / 9) * 15 + (advancedStats.allTime.averagePhysicalActivity / 10) * 15 + (advancedStats.allTime.averageWaterIntake / 100) * 15)|round(0) %}
                                    <div class=\"progress\" style=\"height: 40px;\">
                                        <div class=\"progress-bar bg-{% if healthScore >= 80 %}success{% elseif healthScore >= 60 %}warning{% else %}danger{% endif %}\" role=\"progressbar\" style=\"width: {{ healthScore }}%;\">
                                            <strong>{{ healthScore }}/100</strong>
                                        </div>
                                    </div>
                                    <p class=\"text-muted small mt-2\">
                                        {% if healthScore >= 80 %}
                                            <i class=\"fas fa-check-circle text-success me-2\"></i>Excellent overall health! Keep maintaining your habits.
                                        {% elseif healthScore >= 60 %}
                                            <i class=\"fas fa-exclamation-circle text-warning me-2\"></i>Good health. Focus on improving specific areas.
                                        {% else %}
                                            <i class=\"fas fa-times-circle text-danger me-2\"></i>Health needs improvement. Start with small daily changes.
                                        {% endif %}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
    // Update mood value display
    document.getElementById('mood').addEventListener('input', function() {
        document.getElementById('moodValue').textContent = this.value;
    });

    // Update stress value display
    document.getElementById('stress').addEventListener('input', function() {
        document.getElementById('stressValue').textContent = this.value;
    });

    // Chart.js - Trend Chart
    {% if weeklyData|length > 0 %}
    const ctx = document.getElementById('trendChart').getContext('2d');
    const labels = [
        {% for day in weeklyData %}'{{ day.date|date('M d') }}'{% if not loop.last %}, {% endif %}{% endfor %}
    ];
    
    const moodData = [
        {% for day in weeklyData %}{{ day.mood ?? 'null' }}{% if not loop.last %}, {% endif %}{% endfor %}
    ];
    
    const stressData = [
        {% for day in weeklyData %}{{ day.stress ?? 'null' }}{% if not loop.last %}, {% endif %}{% endfor %}
    ];
    
    const energyData = [
        {% for day in weeklyData %}{{ day.energy ?? 'null' }}{% if not loop.last %}, {% endif %}{% endfor %}
    ];

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Mood',
                    data: moodData,
                    borderColor: '#0dcaf0',
                    backgroundColor: 'rgba(13, 202, 240, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Stress',
                    data: stressData,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Energy',
                    data: energyData,
                    borderColor: '#ffc107',
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Your Health Metrics Trend (Last 7 Days)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10,
                    title: {
                        display: true,
                        text: 'Score'
                    }
                }
            }
        }
    });
    {% endif %}
</script>
{% endblock %}", "tracking/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\tracking\\index.html.twig");
    }
}
