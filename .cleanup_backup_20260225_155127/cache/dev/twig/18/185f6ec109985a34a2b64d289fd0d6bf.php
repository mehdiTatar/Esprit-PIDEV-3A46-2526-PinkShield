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

/* appointment/invoice-template.html.twig */
class __TwigTemplate_3ab8bfca04ad307f26bf7faa69eed9cd extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointment/invoice-template.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Invoice - ";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["invoiceNumber"]) || array_key_exists("invoiceNumber", $context) ? $context["invoiceNumber"] : (function () { throw new RuntimeError('Variable "invoiceNumber" does not exist.', 6, $this->source); })()), "html", null, true);
        yield "</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
        }
        .company-info h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .company-info p {
            color: #666;
            font-size: 12px;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h3 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .invoice-info p {
            margin: 5px 0;
            font-size: 12px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .patient-doctor-info {
            display: flex;
            gap: 40px;
            margin-bottom: 30px;
        }
        .info-block {
            flex: 1;
        }
        .info-block p {
            margin: 5px 0;
            font-size: 12px;
        }
        .info-block strong {
            display: block;
            margin-top: 10px;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background-color: #007bff;
            color: white;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #007bff;
        }
        .total-row {
            display: flex;
            justify-content: flex-end;
            gap: 40px;
            margin: 10px 0;
            font-size: 12px;
        }
        .total-label {
            width: 150px;
            text-align: right;
            font-weight: bold;
        }
        .total-value {
            width: 100px;
            text-align: right;
        }
        .grand-total {
            display: flex;
            justify-content: flex-end;
            gap: 40px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #333;
        }
        .grand-total-label {
            width: 150px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            color: #007bff;
        }
        .grand-total-value {
            width: 100px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            color: #007bff;
        }
        .appointment-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .appointment-details p {
            margin: 8px 0;
            font-size: 12px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .empty-message {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class=\"container\">
        <!-- Header -->
        <div class=\"header\">
            <div class=\"company-info\">
                <h1>PinkShield</h1>
                <p>Medical & Consulting Services</p>
            </div>
            <div class=\"invoice-info\">
                <h3>INVOICE</h3>
                <p><strong>Invoice #:</strong> ";
        // line 180
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["invoiceNumber"]) || array_key_exists("invoiceNumber", $context) ? $context["invoiceNumber"] : (function () { throw new RuntimeError('Variable "invoiceNumber" does not exist.', 180, $this->source); })()), "html", null, true);
        yield "</p>
                <p><strong>Date:</strong> ";
        // line 181
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate((isset($context["invoiceDate"]) || array_key_exists("invoiceDate", $context) ? $context["invoiceDate"] : (function () { throw new RuntimeError('Variable "invoiceDate" does not exist.', 181, $this->source); })()), "M d, Y"), "html", null, true);
        yield "</p>
            </div>
        </div>

        <!-- Patient & Doctor Info -->
        <div class=\"patient-doctor-info\">
            <div class=\"info-block\">
                <strong>BILL TO:</strong>
                <p><strong>Patient:</strong> ";
        // line 189
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 189, $this->source); })()), "patientName", [], "any", false, false, false, 189), "html", null, true);
        yield "</p>
                <p><strong>Email:</strong> ";
        // line 190
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 190, $this->source); })()), "patientEmail", [], "any", false, false, false, 190), "html", null, true);
        yield "</p>
            </div>
            <div class=\"info-block\">
                <strong>SERVICE PROVIDER:</strong>
                <p><strong>Doctor:</strong> ";
        // line 194
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 194, $this->source); })()), "doctorName", [], "any", false, false, false, 194), "html", null, true);
        yield "</p>
                <p><strong>Email:</strong> ";
        // line 195
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 195, $this->source); })()), "doctorEmail", [], "any", false, false, false, 195), "html", null, true);
        yield "</p>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class=\"section\">
            <div class=\"section-title\">APPOINTMENT DETAILS</div>
            <div class=\"appointment-details\">
                <p><strong>Date & Time:</strong> ";
        // line 203
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 203, $this->source); })()), "appointmentDate", [], "any", false, false, false, 203), "M d, Y H:i"), "html", null, true);
        yield "</p>
                <p><strong>Status:</strong> <span style=\"text-transform: capitalize; font-weight: bold; color: ";
        // line 204
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 204, $this->source); })()), "status", [], "any", false, false, false, 204) == "confirmed")) {
            yield "#28a745";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 204, $this->source); })()), "status", [], "any", false, false, false, 204) == "pending")) {
            yield "#ffc107";
        } else {
            yield "#dc3545";
        }
        yield ";\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 204, $this->source); })()), "status", [], "any", false, false, false, 204), "html", null, true);
        yield "</span></p>
                ";
        // line 205
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 205, $this->source); })()), "notes", [], "any", false, false, false, 205)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 206
            yield "                    <p><strong>Notes:</strong> ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 206, $this->source); })()), "notes", [], "any", false, false, false, 206), "html", null, true);
            yield "</p>
                ";
        }
        // line 208
        yield "            </div>
        </div>

        <!-- Products/Items -->
        <div class=\"section\">
            <div class=\"section-title\">PARAPHARMACIE ITEMS</div>
            ";
        // line 214
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 214, $this->source); })()), "parapharmacies", [], "any", false, false, false, 214)) > 0)) {
            // line 215
            yield "                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th style=\"text-align: right;\">Unit Price</th>
                            <th style=\"text-align: right;\">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
            // line 225
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["appointment"]) || array_key_exists("appointment", $context) ? $context["appointment"] : (function () { throw new RuntimeError('Variable "appointment" does not exist.', 225, $this->source); })()), "parapharmacies", [], "any", false, false, false, 225));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 226
                yield "                            <tr>
                                <td>";
                // line 227
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 227), "html", null, true);
                yield "</td>
                                <td>";
                // line 228
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "description", [], "any", true, true, false, 228)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "description", [], "any", false, false, false, 228), "-")) : ("-")), "html", null, true);
                yield "</td>
                                <td style=\"text-align: right;\">\$";
                // line 229
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 229), 2, ".", ","), "html", null, true);
                yield "</td>
                                <td style=\"text-align: right;\">\$";
                // line 230
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "price", [], "any", false, false, false, 230), 2, ".", ","), "html", null, true);
                yield "</td>
                            </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 233
            yield "                    </tbody>
                </table>
            ";
        } else {
            // line 236
            yield "                <div class=\"empty-message\">No parapharmacie items for this appointment.</div>
            ";
        }
        // line 238
        yield "        </div>

        <!-- Total Section -->
        <div class=\"total-section\">
            <div class=\"grand-total\">
                <div class=\"grand-total-label\">TOTAL AMOUNT:</div>
                <div class=\"grand-total-value\">\$";
        // line 244
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 244, $this->source); })()), 2, ".", ","), "html", null, true);
        yield "</div>
            </div>
        </div>

        <!-- Footer -->
        <div class=\"footer\">
            <p>Thank you for choosing PinkShield Medical Services.</p>
            <p>This invoice is valid and officially issued for the appointment service provided.</p>
            <p>Generated on ";
        // line 252
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "M d, Y H:i"), "html", null, true);
        yield "</p>
        </div>
    </div>
</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "appointment/invoice-template.html.twig";
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
        return array (  372 => 252,  361 => 244,  353 => 238,  349 => 236,  344 => 233,  335 => 230,  331 => 229,  327 => 228,  323 => 227,  320 => 226,  316 => 225,  304 => 215,  302 => 214,  294 => 208,  288 => 206,  286 => 205,  274 => 204,  270 => 203,  259 => 195,  255 => 194,  248 => 190,  244 => 189,  233 => 181,  229 => 180,  52 => 6,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Invoice - {{ invoiceNumber }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
        }
        .company-info h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .company-info p {
            color: #666;
            font-size: 12px;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h3 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .invoice-info p {
            margin: 5px 0;
            font-size: 12px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .patient-doctor-info {
            display: flex;
            gap: 40px;
            margin-bottom: 30px;
        }
        .info-block {
            flex: 1;
        }
        .info-block p {
            margin: 5px 0;
            font-size: 12px;
        }
        .info-block strong {
            display: block;
            margin-top: 10px;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background-color: #007bff;
            color: white;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #007bff;
        }
        .total-row {
            display: flex;
            justify-content: flex-end;
            gap: 40px;
            margin: 10px 0;
            font-size: 12px;
        }
        .total-label {
            width: 150px;
            text-align: right;
            font-weight: bold;
        }
        .total-value {
            width: 100px;
            text-align: right;
        }
        .grand-total {
            display: flex;
            justify-content: flex-end;
            gap: 40px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #333;
        }
        .grand-total-label {
            width: 150px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            color: #007bff;
        }
        .grand-total-value {
            width: 100px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            color: #007bff;
        }
        .appointment-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .appointment-details p {
            margin: 8px 0;
            font-size: 12px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .empty-message {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class=\"container\">
        <!-- Header -->
        <div class=\"header\">
            <div class=\"company-info\">
                <h1>PinkShield</h1>
                <p>Medical & Consulting Services</p>
            </div>
            <div class=\"invoice-info\">
                <h3>INVOICE</h3>
                <p><strong>Invoice #:</strong> {{ invoiceNumber }}</p>
                <p><strong>Date:</strong> {{ invoiceDate|date('M d, Y') }}</p>
            </div>
        </div>

        <!-- Patient & Doctor Info -->
        <div class=\"patient-doctor-info\">
            <div class=\"info-block\">
                <strong>BILL TO:</strong>
                <p><strong>Patient:</strong> {{ appointment.patientName }}</p>
                <p><strong>Email:</strong> {{ appointment.patientEmail }}</p>
            </div>
            <div class=\"info-block\">
                <strong>SERVICE PROVIDER:</strong>
                <p><strong>Doctor:</strong> {{ appointment.doctorName }}</p>
                <p><strong>Email:</strong> {{ appointment.doctorEmail }}</p>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class=\"section\">
            <div class=\"section-title\">APPOINTMENT DETAILS</div>
            <div class=\"appointment-details\">
                <p><strong>Date & Time:</strong> {{ appointment.appointmentDate|date('M d, Y H:i') }}</p>
                <p><strong>Status:</strong> <span style=\"text-transform: capitalize; font-weight: bold; color: {% if appointment.status == 'confirmed' %}#28a745{% elseif appointment.status == 'pending' %}#ffc107{% else %}#dc3545{% endif %};\">{{ appointment.status }}</span></p>
                {% if appointment.notes %}
                    <p><strong>Notes:</strong> {{ appointment.notes }}</p>
                {% endif %}
            </div>
        </div>

        <!-- Products/Items -->
        <div class=\"section\">
            <div class=\"section-title\">PARAPHARMACIE ITEMS</div>
            {% if appointment.parapharmacies|length > 0 %}
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th style=\"text-align: right;\">Unit Price</th>
                            <th style=\"text-align: right;\">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% for item in appointment.parapharmacies %}
                            <tr>
                                <td>{{ item.name }}</td>
                                <td>{{ item.description|default('-') }}</td>
                                <td style=\"text-align: right;\">\${{ item.price|number_format(2, '.', ',') }}</td>
                                <td style=\"text-align: right;\">\${{ item.price|number_format(2, '.', ',') }}</td>
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            {% else %}
                <div class=\"empty-message\">No parapharmacie items for this appointment.</div>
            {% endif %}
        </div>

        <!-- Total Section -->
        <div class=\"total-section\">
            <div class=\"grand-total\">
                <div class=\"grand-total-label\">TOTAL AMOUNT:</div>
                <div class=\"grand-total-value\">\${{ total|number_format(2, '.', ',') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class=\"footer\">
            <p>Thank you for choosing PinkShield Medical Services.</p>
            <p>This invoice is valid and officially issued for the appointment service provided.</p>
            <p>Generated on {{ \"now\"|date('M d, Y H:i') }}</p>
        </div>
    </div>
</body>
</html>
", "appointment/invoice-template.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\appointment\\invoice-template.html.twig");
    }
}
