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

/* wishlist/index.html.twig */
class __TwigTemplate_077c65be1adef17b39b200a5e05c2f92 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "wishlist/index.html.twig"));

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

        yield "My Wishlist - PinkShield";
        
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
    .wishlist-header {
        margin-bottom: 40px;
    }

    .wishlist-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .wishlist-header h1 i {
        color: var(--primary);
    }

    .wishlist-header p {
        color: #6b7280;
        font-size: 1.05rem;
    }

    .wishlist-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .wishlist-table thead {
        background: linear-gradient(135deg, rgba(196, 30, 58, 0.1) 0%, rgba(255, 182, 193, 0.1) 100%);
        border-bottom: 2px solid var(--border);
    }

    .wishlist-table th {
        padding: 20px;
        text-align: left;
        font-weight: 700;
        color: #1f2937;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .wishlist-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background-color 0.2s;
    }

    .wishlist-table tbody tr:hover {
        background-color: rgba(196, 30, 58, 0.05);
    }

    .wishlist-table td {
        padding: 20px;
        vertical-align: middle;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-icon {
        font-size: 2rem;
        color: var(--primary);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(196, 30, 58, 0.1);
        border-radius: 8px;
    }

    .product-details h4 {
        margin: 0 0 5px 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f2937;
    }

    .product-details p {
        margin: 0;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
    }

    .added-date {
        color: #9ca3af;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-primary-small {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary-small:hover {
        background-color: #8B1428;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-danger-small {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-danger-small:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
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
        margin-bottom: 20px;
    }

    .btn-browse {
        background-color: var(--primary);
        color: white;
        padding: 10px 24px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: all 0.2s;
    }

    .btn-browse:hover {
        background-color: #8B1428;
        color: white;
        text-decoration: none;
    }

    .summary-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 25px;
        margin-top: 30px;
        text-align: center;
    }

    .summary-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }

    .summary-items {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .wishlist-table {
            font-size: 0.9rem;
        }

        .wishlist-table th,
        .wishlist-table td {
            padding: 12px;
        }

        .product-info {
            gap: 8px;
        }

        .product-icon {
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
        }

        .product-details h4 {
            font-size: 0.95rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary-small,
        .btn-danger-small {
            width: 100%;
            padding: 6px 8px;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 258
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 259
        yield "<div class=\"wishlist-header\">
    <h1><i class=\"fas fa-heart\"></i> My Wishlist</h1>
    <p>Products you're interested in purchasing</p>
</div>

";
        // line 265
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["bundleSuggestions"]) || array_key_exists("bundleSuggestions", $context) ? $context["bundleSuggestions"] : (function () { throw new RuntimeError('Variable "bundleSuggestions" does not exist.', 265, $this->source); })())) > 0)) {
            // line 266
            yield "    <div class=\"summary-card\" style=\"background: #fffbe6; border: 2px solid #ffc107; margin-bottom: 30px;\">
        <div class=\"summary-title\" style=\"color: #c41e3a;\">Special Offer: Smart Bundle Deals</div>
        ";
            // line 268
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["bundleSuggestions"]) || array_key_exists("bundleSuggestions", $context) ? $context["bundleSuggestions"] : (function () { throw new RuntimeError('Variable "bundleSuggestions" does not exist.', 268, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["bundle"]) {
                // line 269
                yield "            <div class=\"mb-4 p-3\" style=\"border-bottom: 1px dashed #ffc107;\">
                <div><strong>";
                // line 270
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["bundle"], "wishlistItem", [], "any", false, false, false, 270), "product", [], "any", false, false, false, 270), "name", [], "any", false, false, false, 270), "html", null, true);
                yield "</strong> + <strong>";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["bundle"], "companion", [], "any", false, false, false, 270), "name", [], "any", false, false, false, 270), "html", null, true);
                yield "</strong></div>
                <div class=\"text-muted mb-2\">Category: ";
                // line 271
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["bundle"], "wishlistItem", [], "any", false, false, false, 271), "product", [], "any", false, false, false, 271), "category", [], "any", false, false, false, 271), "html", null, true);
                yield "</div>
                <div>
                    <span style=\"text-decoration: line-through; color: #9ca3af; font-size: 1.1rem;\">\$";
                // line 273
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["bundle"], "originalPrice", [], "any", false, false, false, 273), 2), "html", null, true);
                yield "</span>
                    <span style=\"color: #c41e3a; font-size: 1.3rem; font-weight: bold; margin-left: 10px;\">\$";
                // line 274
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, $context["bundle"], "bundlePrice", [], "any", false, false, false, 274), 2), "html", null, true);
                yield "</span>
                    <span class=\"badge bg-warning text-dark ms-2\">15% OFF</span>
                </div>
                <p class=\"text-muted mt-2 mb-0\">Bundle these products for maximum savings!</p>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['bundle'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 280
            yield "    </div>
";
        }
        // line 282
        yield "
";
        // line 283
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["wishlistItems"]) || array_key_exists("wishlistItems", $context) ? $context["wishlistItems"] : (function () { throw new RuntimeError('Variable "wishlistItems" does not exist.', 283, $this->source); })())) > 0)) {
            // line 284
            yield "    <!-- Wishlist Table -->
    <div style=\"overflow-x: auto;\">
        <table class=\"wishlist-table\">
            <thead>
                <tr>
                    <th style=\"width: 40%;\">Product</th>
                    <th style=\"width: 15%;\">Price</th>
                    <th style=\"width: 20%;\">Added Date</th>
                    <th style=\"width: 25%;\">Actions</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 296
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["wishlistItems"]) || array_key_exists("wishlistItems", $context) ? $context["wishlistItems"] : (function () { throw new RuntimeError('Variable "wishlistItems" does not exist.', 296, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 297
                yield "                    <tr data-wishlist-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 297), "html", null, true);
                yield "\">
                        <td>
                            <div class=\"product-info\">
                                <div class=\"product-icon\">
                                    <i class=\"fas fa-capsules\"></i>
                                </div>
                                <div class=\"product-details\">
                                    <h4>";
                // line 304
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 304), "name", [], "any", false, false, false, 304), "html", null, true);
                yield "</h4>
                                    <p>";
                // line 305
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 305), "description", [], "any", false, false, false, 305), 0, 50), "html", null, true);
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 305), "description", [], "any", false, false, false, 305)) > 50)) ? ("...") : (""));
                yield "</p>
                                </div>
                            </div>
                        </td>
                        <td class=\"price\">\$";
                // line 309
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 309), "price", [], "any", false, false, false, 309), "html", null, true);
                yield "</td>
                        <td class=\"added-date\">";
                // line 310
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "addedAt", [], "any", false, false, false, 310), "M d, Y"), "html", null, true);
                yield "</td>
                        <td>
                            <div class=\"action-buttons\">
                                <button class=\"btn-primary-small\" onclick=\"buyProduct('";
                // line 313
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 313), "id", [], "any", false, false, false, 313), "html", null, true);
                yield "', '";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 313), "name", [], "any", false, false, false, 313), "html", null, true);
                yield "')\">
                                    <i class=\"fas fa-shopping-cart\"></i> Buy
                                </button>
                                <button class=\"btn-danger-small\" onclick=\"removeFromWishlist(this, ";
                // line 316
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 316), "html", null, true);
                yield ")\">
                                    <i class=\"fas fa-trash\"></i> Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 323
            yield "            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class=\"summary-card\">
        <div class=\"summary-title\">Wishlist Summary</div>
        <div class=\"summary-items\">";
            // line 330
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["wishlistItems"]) || array_key_exists("wishlistItems", $context) ? $context["wishlistItems"] : (function () { throw new RuntimeError('Variable "wishlistItems" does not exist.', 330, $this->source); })())), "html", null, true);
            yield " ";
            yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["wishlistItems"]) || array_key_exists("wishlistItems", $context) ? $context["wishlistItems"] : (function () { throw new RuntimeError('Variable "wishlistItems" does not exist.', 330, $this->source); })())) == 1)) ? ("item") : ("items"));
            yield " in your wishlist</div>
        <div style=\"font-size: 1.1rem; color: #6b7280; margin-bottom: 15px;\">
            <strong>Total Value:</strong>
        </div>
        <div style=\"font-size: 2rem; font-weight: 900; color: var(--primary); margin-bottom: 20px;\">
            \$<span id=\"total-price\">";
            // line 336
            $context["total"] = 0.0;
            // line 337
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["wishlistItems"]) || array_key_exists("wishlistItems", $context) ? $context["wishlistItems"] : (function () { throw new RuntimeError('Variable "wishlistItems" does not exist.', 337, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 338
                $context["total"] = ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 338, $this->source); })()) + ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, true, false, 338), "price", [], "any", true, true, false, 338)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "product", [], "any", false, false, false, 338), "price", [], "any", false, false, false, 338), 0)) : (0)));
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 340
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::round(((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 340, $this->source); })()) * 100)) / $this->extensions['Twig\Extension\CoreExtension']->formatNumber(100, 2)), "html", null, true);
            yield "</span>
        </div>
        <a href=\"";
            // line 342
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("parapharmacy_index");
            yield "\" class=\"btn-browse\">
            <i class=\"fas fa-shopping-bag me-2\"></i> Continue Shopping
        </a>
    </div>
";
        } else {
            // line 347
            yield "    <!-- Empty State -->
    <div class=\"empty-state\">
        <div class=\"empty-state-icon\">
            <i class=\"fas fa-heart\"></i>
        </div>
        <h3 class=\"empty-state-title\">Your Wishlist is Empty</h3>
        <p class=\"empty-state-text\">Start adding products to your wishlist to keep track of items you'd like to purchase.</p>
        <a href=\"";
            // line 354
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("parapharmacy_index");
            yield "\" class=\"btn-browse\">
            <i class=\"fas fa-shopping-bag me-2\"></i> Browse Products
        </a>
    </div>
";
        }
        // line 359
        yield "
<script>
    function removeFromWishlist(button, wishlistId) {
        if (confirm('Are you sure you want to remove this item from your wishlist?')) {
            fetch(`";
        // line 363
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("wishlist_remove", ["wishlistId" => 0]);
        yield "`.replace('0', wishlistId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = button.closest('tr');
                    const priceText = row.querySelector('.price').textContent.trim();
                    const price = parseFloat(priceText.replace(/[\$,]/g, ''));
                    
                    // Update total
                    const totalPriceEl = document.getElementById('total-price');
                    const currentTotal = parseFloat(totalPriceEl.textContent.replace(/,/g, ''));
                    const newTotal = currentTotal - price;
                    totalPriceEl.textContent = newTotal.toFixed(2).replace(/\\B(?=(\\d{3})+(?!\\d))/g, \",\");
                    
                    row.style.opacity = '0.5';
                    row.style.textDecoration = 'line-through';
                    setTimeout(() => {
                        row.remove();
                        // Refresh page if empty
                        if (document.querySelectorAll('tbody tr').length === 0) {
                            location.reload();
                        }
                    }, 300);
                }
            });
        }
    }

    function buyProduct(productId, productName) {
        alert('Thank you for your interest in ' + productName + '! Purchase feature coming soon.');
        // Future: implement actual purchase functionality
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
        return "wishlist/index.html.twig";
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
        return array (  549 => 363,  543 => 359,  535 => 354,  526 => 347,  518 => 342,  513 => 340,  507 => 338,  503 => 337,  501 => 336,  491 => 330,  482 => 323,  469 => 316,  461 => 313,  455 => 310,  451 => 309,  443 => 305,  439 => 304,  428 => 297,  424 => 296,  410 => 284,  408 => 283,  405 => 282,  401 => 280,  389 => 274,  385 => 273,  380 => 271,  374 => 270,  371 => 269,  367 => 268,  363 => 266,  361 => 265,  354 => 259,  344 => 258,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}My Wishlist - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    .wishlist-header {
        margin-bottom: 40px;
    }

    .wishlist-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .wishlist-header h1 i {
        color: var(--primary);
    }

    .wishlist-header p {
        color: #6b7280;
        font-size: 1.05rem;
    }

    .wishlist-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .wishlist-table thead {
        background: linear-gradient(135deg, rgba(196, 30, 58, 0.1) 0%, rgba(255, 182, 193, 0.1) 100%);
        border-bottom: 2px solid var(--border);
    }

    .wishlist-table th {
        padding: 20px;
        text-align: left;
        font-weight: 700;
        color: #1f2937;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .wishlist-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background-color 0.2s;
    }

    .wishlist-table tbody tr:hover {
        background-color: rgba(196, 30, 58, 0.05);
    }

    .wishlist-table td {
        padding: 20px;
        vertical-align: middle;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-icon {
        font-size: 2rem;
        color: var(--primary);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(196, 30, 58, 0.1);
        border-radius: 8px;
    }

    .product-details h4 {
        margin: 0 0 5px 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #1f2937;
    }

    .product-details p {
        margin: 0;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
    }

    .added-date {
        color: #9ca3af;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-primary-small {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary-small:hover {
        background-color: #8B1428;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-danger-small {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-danger-small:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
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
        margin-bottom: 20px;
    }

    .btn-browse {
        background-color: var(--primary);
        color: white;
        padding: 10px 24px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: all 0.2s;
    }

    .btn-browse:hover {
        background-color: #8B1428;
        color: white;
        text-decoration: none;
    }

    .summary-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 25px;
        margin-top: 30px;
        text-align: center;
    }

    .summary-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }

    .summary-items {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .wishlist-table {
            font-size: 0.9rem;
        }

        .wishlist-table th,
        .wishlist-table td {
            padding: 12px;
        }

        .product-info {
            gap: 8px;
        }

        .product-icon {
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
        }

        .product-details h4 {
            font-size: 0.95rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary-small,
        .btn-danger-small {
            width: 100%;
            padding: 6px 8px;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"wishlist-header\">
    <h1><i class=\"fas fa-heart\"></i> My Wishlist</h1>
    <p>Products you're interested in purchasing</p>
</div>

{# Smart Bundle Deals UI #}
{% if bundleSuggestions|length > 0 %}
    <div class=\"summary-card\" style=\"background: #fffbe6; border: 2px solid #ffc107; margin-bottom: 30px;\">
        <div class=\"summary-title\" style=\"color: #c41e3a;\">Special Offer: Smart Bundle Deals</div>
        {% for bundle in bundleSuggestions %}
            <div class=\"mb-4 p-3\" style=\"border-bottom: 1px dashed #ffc107;\">
                <div><strong>{{ bundle.wishlistItem.product.name }}</strong> + <strong>{{ bundle.companion.name }}</strong></div>
                <div class=\"text-muted mb-2\">Category: {{ bundle.wishlistItem.product.category }}</div>
                <div>
                    <span style=\"text-decoration: line-through; color: #9ca3af; font-size: 1.1rem;\">\${{ bundle.originalPrice|number_format(2) }}</span>
                    <span style=\"color: #c41e3a; font-size: 1.3rem; font-weight: bold; margin-left: 10px;\">\${{ bundle.bundlePrice|number_format(2) }}</span>
                    <span class=\"badge bg-warning text-dark ms-2\">15% OFF</span>
                </div>
                <p class=\"text-muted mt-2 mb-0\">Bundle these products for maximum savings!</p>
            </div>
        {% endfor %}
    </div>
{% endif %}

{% if wishlistItems|length > 0 %}
    <!-- Wishlist Table -->
    <div style=\"overflow-x: auto;\">
        <table class=\"wishlist-table\">
            <thead>
                <tr>
                    <th style=\"width: 40%;\">Product</th>
                    <th style=\"width: 15%;\">Price</th>
                    <th style=\"width: 20%;\">Added Date</th>
                    <th style=\"width: 25%;\">Actions</th>
                </tr>
            </thead>
            <tbody>
                {% for item in wishlistItems %}
                    <tr data-wishlist-id=\"{{ item.id }}\">
                        <td>
                            <div class=\"product-info\">
                                <div class=\"product-icon\">
                                    <i class=\"fas fa-capsules\"></i>
                                </div>
                                <div class=\"product-details\">
                                    <h4>{{ item.product.name }}</h4>
                                    <p>{{ item.product.description|slice(0, 50) }}{{ item.product.description|length > 50 ? '...' : '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class=\"price\">\${{ item.product.price }}</td>
                        <td class=\"added-date\">{{ item.addedAt|date('M d, Y') }}</td>
                        <td>
                            <div class=\"action-buttons\">
                                <button class=\"btn-primary-small\" onclick=\"buyProduct('{{ item.product.id }}', '{{ item.product.name }}')\">
                                    <i class=\"fas fa-shopping-cart\"></i> Buy
                                </button>
                                <button class=\"btn-danger-small\" onclick=\"removeFromWishlist(this, {{ item.id }})\">
                                    <i class=\"fas fa-trash\"></i> Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class=\"summary-card\">
        <div class=\"summary-title\">Wishlist Summary</div>
        <div class=\"summary-items\">{{ wishlistItems|length }} {{ wishlistItems|length == 1 ? 'item' : 'items' }} in your wishlist</div>
        <div style=\"font-size: 1.1rem; color: #6b7280; margin-bottom: 15px;\">
            <strong>Total Value:</strong>
        </div>
        <div style=\"font-size: 2rem; font-weight: 900; color: var(--primary); margin-bottom: 20px;\">
            \$<span id=\"total-price\">
            {%- set total = 0.0 -%}
            {%- for item in wishlistItems -%}
                {%- set total = total + (item.product.price|default(0)) -%}
            {%- endfor -%}
            {{ (total * 100)|round / 100|number_format(2) }}</span>
        </div>
        <a href=\"{{ path('parapharmacy_index') }}\" class=\"btn-browse\">
            <i class=\"fas fa-shopping-bag me-2\"></i> Continue Shopping
        </a>
    </div>
{% else %}
    <!-- Empty State -->
    <div class=\"empty-state\">
        <div class=\"empty-state-icon\">
            <i class=\"fas fa-heart\"></i>
        </div>
        <h3 class=\"empty-state-title\">Your Wishlist is Empty</h3>
        <p class=\"empty-state-text\">Start adding products to your wishlist to keep track of items you'd like to purchase.</p>
        <a href=\"{{ path('parapharmacy_index') }}\" class=\"btn-browse\">
            <i class=\"fas fa-shopping-bag me-2\"></i> Browse Products
        </a>
    </div>
{% endif %}

<script>
    function removeFromWishlist(button, wishlistId) {
        if (confirm('Are you sure you want to remove this item from your wishlist?')) {
            fetch(`{{ path('wishlist_remove', {wishlistId: 0}) }}`.replace('0', wishlistId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = button.closest('tr');
                    const priceText = row.querySelector('.price').textContent.trim();
                    const price = parseFloat(priceText.replace(/[\$,]/g, ''));
                    
                    // Update total
                    const totalPriceEl = document.getElementById('total-price');
                    const currentTotal = parseFloat(totalPriceEl.textContent.replace(/,/g, ''));
                    const newTotal = currentTotal - price;
                    totalPriceEl.textContent = newTotal.toFixed(2).replace(/\\B(?=(\\d{3})+(?!\\d))/g, \",\");
                    
                    row.style.opacity = '0.5';
                    row.style.textDecoration = 'line-through';
                    setTimeout(() => {
                        row.remove();
                        // Refresh page if empty
                        if (document.querySelectorAll('tbody tr').length === 0) {
                            location.reload();
                        }
                    }, 300);
                }
            });
        }
    }

    function buyProduct(productId, productName) {
        alert('Thank you for your interest in ' + productName + '! Purchase feature coming soon.');
        // Future: implement actual purchase functionality
    }
</script>
{% endblock %}
", "wishlist/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\wishlist\\index.html.twig");
    }
}
