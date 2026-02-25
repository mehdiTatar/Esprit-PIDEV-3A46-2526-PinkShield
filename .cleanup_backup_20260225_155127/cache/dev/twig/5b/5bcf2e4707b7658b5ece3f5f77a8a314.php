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

/* emails/appointment_completed.html.twig */
class __TwigTemplate_d1d158f1e0c0d28564d6709e8d5b0a23 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "emails/appointment_completed.html.twig"));

        // line 1
        yield "<h2>Appointment Completed</h2>
<p>Dear Dr. ";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 2, $this->source); })()), "doctorName", [], "any", false, false, false, 2), "html", null, true);
        yield ",</p>
<p>The appointment on <strong>";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 3, $this->source); })()), "appointmentDate", [], "any", false, false, false, 3), "M d, Y H:i"), "html", null, true);
        yield "</strong> with patient <strong>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 3, $this->source); })()), "patientName", [], "any", false, false, false, 3), "html", null, true);
        yield "</strong> has been completed. Please find the invoice attached.</p>

<h3>Parapharmacie Items</h3>
";
        // line 6
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 6, $this->source); })()), "parapharmacies", [], "any", false, false, false, 6)) > 0)) {
            // line 7
            yield "<table style=\"width:100%; border-collapse: collapse;\">
    <thead>
        <tr style=\"background:#c41e3a; color:#fff;\">
            <th style=\"padding:8px; text-align:left;\">Product</th>
            <th style=\"padding:8px; text-align:left;\">Description</th>
            <th style=\"padding:8px; text-align:right;\">Price</th>
        </tr>
    </thead>
    <tbody>
        ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 16, $this->source); })()), "parapharmacies", [], "any", false, false, false, 16));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 17
                yield "            <tr>
                <td style=\"padding:8px; border-bottom:1px solid #eee;\">";
                // line 18
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 18), "html", null, true);
                yield "</td>
                <td style=\"padding:8px; border-bottom:1px solid #eee;\">";
                // line 19
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, false, 19), "html", null, true);
                yield "</td>
                <td style=\"padding:8px; border-bottom:1px solid #eee; text-align:right;\">\$";
                // line 20
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 20), 2, ".", ","), "html", null, true);
                yield "</td>
            </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            yield "    </tbody>
</table>
";
        } else {
            // line 26
            yield "<p>No parapharmacie items for this appointment.</p>
";
        }
        // line 28
        yield "
<p>Best regards,<br>PinkShield Team</p>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "emails/appointment_completed.html.twig";
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
        return array (  106 => 28,  102 => 26,  97 => 23,  88 => 20,  84 => 19,  80 => 18,  77 => 17,  73 => 16,  62 => 7,  60 => 6,  52 => 3,  48 => 2,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<h2>Appointment Completed</h2>
<p>Dear Dr. {{ appointment.doctorName }},</p>
<p>The appointment on <strong>{{ appointment.appointmentDate|date('M d, Y H:i') }}</strong> with patient <strong>{{ appointment.patientName }}</strong> has been completed. Please find the invoice attached.</p>

<h3>Parapharmacie Items</h3>
{% if appointment.parapharmacies|length > 0 %}
<table style=\"width:100%; border-collapse: collapse;\">
    <thead>
        <tr style=\"background:#c41e3a; color:#fff;\">
            <th style=\"padding:8px; text-align:left;\">Product</th>
            <th style=\"padding:8px; text-align:left;\">Description</th>
            <th style=\"padding:8px; text-align:right;\">Price</th>
        </tr>
    </thead>
    <tbody>
        {% for item in appointment.parapharmacies %}
            <tr>
                <td style=\"padding:8px; border-bottom:1px solid #eee;\">{{ item.name }}</td>
                <td style=\"padding:8px; border-bottom:1px solid #eee;\">{{ item.description }}</td>
                <td style=\"padding:8px; border-bottom:1px solid #eee; text-align:right;\">\${{ item.price|number_format(2, '.', ',') }}</td>
            </tr>
        {% endfor %}
    </tbody>
</table>
{% else %}
<p>No parapharmacie items for this appointment.</p>
{% endif %}

<p>Best regards,<br>PinkShield Team</p>", "emails/appointment_completed.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\emails\\appointment_completed.html.twig");
    }
}
