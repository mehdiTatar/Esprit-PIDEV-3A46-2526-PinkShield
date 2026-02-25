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

/* notification/index.html.twig */
class __TwigTemplate_7e9b5192a70e46cc095d7d29825fab81 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "notification/index.html.twig"));

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

        yield "Notifications - PinkShield";
        
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
    .notifications-header {
        margin-bottom: 40px;
    }

    .notifications-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .notifications-header h1 i {
        color: var(--primary);
    }

    .notifications-header p {
        color: #6b7280;
        font-size: 1.05rem;
    }

    .notification-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-width: 100%;
    }

    .notification-item {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .notification-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: var(--primary);
    }

    .notification-item.unread {
        background-color: rgba(196, 30, 58, 0.05);
        border-left: 4px solid var(--primary);
    }

    .notification-icon {
        font-size: 1.5rem;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(196, 30, 58, 0.1);
        border-radius: 8px;
        flex-shrink: 0;
        color: var(--primary);
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 5px 0;
    }

    .notification-message {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0 0 8px 0;
    }

    .notification-time {
        font-size: 0.85rem;
        color: #9ca3af;
    }

    .notification-type {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 10px;
        text-transform: capitalize;
    }

    .notification-type.info {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .notification-type.success {
        background-color: #dcfce7;
        color: #16a34a;
    }

    .notification-type.warning {
        background-color: #fef3c7;
        color: #b45309;
    }

    .notification-type.danger {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: white;
        border-radius: 12px;
        border: 2px dashed var(--border);
    }

    .empty-state-icon {
        font-size: 3.5rem;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #6b7280;
        margin-bottom: 10px;
    }

    .empty-state-text {
        color: #9ca3af;
        font-size: 1rem;
    }

    .notification-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
    }

    .btn-small {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-mark-read {
        background-color: var(--primary);
        color: white;
    }

    .btn-mark-read:hover {
        background-color: #8B1428;
    }

    .btn-mark-read.disabled {
        background-color: #d1d5db;
        cursor: default;
    }

    @media (max-width: 768px) {
        .notification-item {
            flex-direction: column;
            gap: 10px;
        }

        .notification-actions {
            width: 100%;
        }

        .btn-small {
            flex: 1;
        }

        .notifications-header h1 {
            font-size: 1.6rem;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 201
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 202
        yield "<div class=\"notifications-header\">
    <h1><i class=\"fas fa-bell\"></i> Notifications</h1>
    <p>Stay updated with your latest notifications</p>
</div>

";
        // line 207
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["notifications"]) || array_key_exists("notifications", $context) ? $context["notifications"] : (function () { throw new RuntimeError('Variable "notifications" does not exist.', 207, $this->source); })())) > 0)) {
            // line 208
            yield "    <div class=\"notification-list\" id=\"notificationsList\">
        ";
            // line 209
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["notifications"]) || array_key_exists("notifications", $context) ? $context["notifications"] : (function () { throw new RuntimeError('Variable "notifications" does not exist.', 209, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["notification"]) {
                // line 210
                yield "            <div class=\"notification-item ";
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "isRead", [], "any", false, false, false, 210)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "unread";
                }
                yield "\" data-notification-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "id", [], "any", false, false, false, 210), "html", null, true);
                yield "\">
                <div class=\"notification-icon\">
                    <i class=\"";
                // line 212
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "icon", [], "any", false, false, false, 212), "html", null, true);
                yield "\"></i>
                </div>
                <div class=\"notification-content\">
                    <h3 class=\"notification-title\">
                        ";
                // line 216
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "title", [], "any", false, false, false, 216), "html", null, true);
                yield "
                        <span class=\"notification-type ";
                // line 217
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "type", [], "any", false, false, false, 217), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "type", [], "any", false, false, false, 217), "html", null, true);
                yield "</span>
                    </h3>
                    <p class=\"notification-message\">";
                // line 219
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "message", [], "any", false, false, false, 219), "html", null, true);
                yield "</p>
                    <span class=\"notification-time\">";
                // line 220
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "createdAt", [], "any", false, false, false, 220), "M d, Y H:i"), "html", null, true);
                yield "</span>
                </div>
                ";
                // line 222
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "isRead", [], "any", false, false, false, 222)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 223
                    yield "                    <div class=\"notification-actions\">
                        <button class=\"btn-small btn-mark-read\" onclick=\"markAsRead(this, ";
                    // line 224
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notification"], "id", [], "any", false, false, false, 224), "html", null, true);
                    yield ")\">
                            <i class=\"fas fa-check\"></i> Mark as read
                        </button>
                    </div>
                ";
                }
                // line 229
                yield "            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['notification'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 231
            yield "    </div>
";
        } else {
            // line 233
            yield "    <div class=\"empty-state\">
        <div class=\"empty-state-icon\">
            <i class=\"fas fa-bell-slash\"></i>
        </div>
        <h3 class=\"empty-state-title\">No Notifications</h3>
        <p class=\"empty-state-text\">You're all caught up! You don't have any notifications at the moment.</p>
    </div>
";
        }
        // line 241
        yield "
<script>
    function markAsRead(button, notificationId) {
        fetch(`";
        // line 244
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("notification_mark_read", ["id" => 0]);
        yield "`.replace('0', notificationId), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const item = button.closest('.notification-item');
                item.classList.remove('unread');
                button.disabled = true;
                button.classList.add('disabled');
                button.innerHTML = '<i class=\"fas fa-check-circle\"></i> Read';
            }
        })
        .catch(error => console.error('Error:', error));
    }
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
        return "notification/index.html.twig";
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
        return array (  389 => 244,  384 => 241,  374 => 233,  370 => 231,  363 => 229,  355 => 224,  352 => 223,  350 => 222,  345 => 220,  341 => 219,  334 => 217,  330 => 216,  323 => 212,  313 => 210,  309 => 209,  306 => 208,  304 => 207,  297 => 202,  287 => 201,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Notifications - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    .notifications-header {
        margin-bottom: 40px;
    }

    .notifications-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .notifications-header h1 i {
        color: var(--primary);
    }

    .notifications-header p {
        color: #6b7280;
        font-size: 1.05rem;
    }

    .notification-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        max-width: 100%;
    }

    .notification-item {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .notification-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: var(--primary);
    }

    .notification-item.unread {
        background-color: rgba(196, 30, 58, 0.05);
        border-left: 4px solid var(--primary);
    }

    .notification-icon {
        font-size: 1.5rem;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(196, 30, 58, 0.1);
        border-radius: 8px;
        flex-shrink: 0;
        color: var(--primary);
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 5px 0;
    }

    .notification-message {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0 0 8px 0;
    }

    .notification-time {
        font-size: 0.85rem;
        color: #9ca3af;
    }

    .notification-type {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 10px;
        text-transform: capitalize;
    }

    .notification-type.info {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .notification-type.success {
        background-color: #dcfce7;
        color: #16a34a;
    }

    .notification-type.warning {
        background-color: #fef3c7;
        color: #b45309;
    }

    .notification-type.danger {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: white;
        border-radius: 12px;
        border: 2px dashed var(--border);
    }

    .empty-state-icon {
        font-size: 3.5rem;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #6b7280;
        margin-bottom: 10px;
    }

    .empty-state-text {
        color: #9ca3af;
        font-size: 1rem;
    }

    .notification-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
    }

    .btn-small {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-mark-read {
        background-color: var(--primary);
        color: white;
    }

    .btn-mark-read:hover {
        background-color: #8B1428;
    }

    .btn-mark-read.disabled {
        background-color: #d1d5db;
        cursor: default;
    }

    @media (max-width: 768px) {
        .notification-item {
            flex-direction: column;
            gap: 10px;
        }

        .notification-actions {
            width: 100%;
        }

        .btn-small {
            flex: 1;
        }

        .notifications-header h1 {
            font-size: 1.6rem;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"notifications-header\">
    <h1><i class=\"fas fa-bell\"></i> Notifications</h1>
    <p>Stay updated with your latest notifications</p>
</div>

{% if notifications|length > 0 %}
    <div class=\"notification-list\" id=\"notificationsList\">
        {% for notification in notifications %}
            <div class=\"notification-item {% if not notification.isRead %}unread{% endif %}\" data-notification-id=\"{{ notification.id }}\">
                <div class=\"notification-icon\">
                    <i class=\"{{ notification.icon }}\"></i>
                </div>
                <div class=\"notification-content\">
                    <h3 class=\"notification-title\">
                        {{ notification.title }}
                        <span class=\"notification-type {{ notification.type }}\">{{ notification.type }}</span>
                    </h3>
                    <p class=\"notification-message\">{{ notification.message }}</p>
                    <span class=\"notification-time\">{{ notification.createdAt|date('M d, Y H:i') }}</span>
                </div>
                {% if not notification.isRead %}
                    <div class=\"notification-actions\">
                        <button class=\"btn-small btn-mark-read\" onclick=\"markAsRead(this, {{ notification.id }})\">
                            <i class=\"fas fa-check\"></i> Mark as read
                        </button>
                    </div>
                {% endif %}
            </div>
        {% endfor %}
    </div>
{% else %}
    <div class=\"empty-state\">
        <div class=\"empty-state-icon\">
            <i class=\"fas fa-bell-slash\"></i>
        </div>
        <h3 class=\"empty-state-title\">No Notifications</h3>
        <p class=\"empty-state-text\">You're all caught up! You don't have any notifications at the moment.</p>
    </div>
{% endif %}

<script>
    function markAsRead(button, notificationId) {
        fetch(`{{ path('notification_mark_read', {id: 0}) }}`.replace('0', notificationId), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const item = button.closest('.notification-item');
                item.classList.remove('unread');
                button.disabled = true;
                button.classList.add('disabled');
                button.innerHTML = '<i class=\"fas fa-check-circle\"></i> Read';
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
{% endblock %}
", "notification/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\notification\\index.html.twig");
    }
}
