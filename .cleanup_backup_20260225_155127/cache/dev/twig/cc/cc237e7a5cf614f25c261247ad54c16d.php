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

/* parapharmacy/index.html.twig */
class __TwigTemplate_7e9ac55b9fe23de20a1c6be3e53e3804 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "parapharmacy/index.html.twig"));

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

        yield "Parapharmacy Products - PinkShield";
        
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
    .products-header {
        margin-bottom: 40px;
    }

    .products-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .products-header h1 i {
        color: var(--primary);
    }

    .products-header p {
        color: #6b7280;
        font-size: 1.05rem;
    }

    .search-filter-bar {
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
    }

    .sort-box {
        min-width: 200px;
    }

    .search-box input, .sort-box select {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s;
        background-color: white;
    }

    .search-box input:focus, .sort-box select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .product-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        border-color: var(--primary);
    }

    .product-header {
        background: linear-gradient(135deg, rgba(196, 30, 58, 0.1) 0%, rgba(255, 182, 193, 0.1) 100%);
        padding: 25px 20px;
        border-bottom: 2px solid var(--border);
        text-align: center;
    }

    .product-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .product-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .product-body {
        padding: 20px;
    }

    .product-description {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
        min-height: 45px;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
    }

    .product-unit {
        font-size: 0.8rem;
        color: #9ca3af;
        font-weight: 500;
    }

    .btn-view {
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

    .btn-view:hover {
        background-color: #8B1428;
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }

    .btn-wishlist {
        background-color: white;
        color: var(--primary);
        border: 2px solid var(--primary);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-wishlist:hover {
        background-color: var(--primary);
        color: white;
        transform: scale(1.05);
    }

    .btn-wishlist.in-wishlist {
        background-color: var(--primary);
        color: white;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--border);
        padding-top: 15px;
        gap: 8px;
    }

    .product-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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

    .stats-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        min-width: 150px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 5px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .products-header h1 {
            font-size: 1.6rem;
        }

        .search-filter-bar {
            flex-direction: column;
        }

        .search-box {
            min-width: 100%;
        }
    }
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 274
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 275
        yield "<div class=\"products-header\">
    <h1><i class=\"fas fa-pills\"></i> Parapharmacy Products</h1>
    <p>Browse and manage pharmaceutical products and medical supplies</p>
</div>

<!-- Statistics -->
<div class=\"stats-bar\">
    <div class=\"stat-card\">
        <div class=\"stat-value\">";
        // line 283
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 283, $this->source); })())), "html", null, true);
        yield "</div>
        <div class=\"stat-label\">Total Products</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"stat-value\">";
        // line 287
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 287, $this->source); })())) > 0)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, Twig\Extension\CoreExtension::first($this->env->getCharset(), (isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 287, $this->source); })())), "price", [], "any", false, false, false, 287), "html", null, true)) : ("0"));
        yield "</div>
        <div class=\"stat-label\">Starting Price</div>
    </div>
</div>

<!-- Search Bar and Sort -->
<div class=\"search-filter-bar\">
    <div class=\"search-box\">
        <input type=\"text\" id=\"searchInput\" placeholder=\"Search products by name...\">
    </div>
    <div class=\"sort-box\">
        <select id=\"sortInput\">
            <option value=\"name-asc\">Sort by Name (A-Z)</option>
            <option value=\"name-desc\">Sort by Name (Z-A)</option>
            <option value=\"price-asc\">Price: Low to High</option>
            <option value=\"price-desc\">Price: High to Low</option>
        </select>
    </div>
</div>

";
        // line 307
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 307, $this->source); })())) > 0)) {
            // line 308
            yield "    <!-- Products Grid -->
    <div class=\"products-grid\" id=\"productsGrid\">
        ";
            // line 310
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["products"]) || array_key_exists("products", $context) ? $context["products"] : (function () { throw new RuntimeError('Variable "products" does not exist.', 310, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 311
                yield "            <div class=\"product-card\" data-product-name=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 311)), "html", null, true);
                yield "\" data-product-id=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "id", [], "any", false, false, false, 311), "html", null, true);
                yield "\">
                <div class=\"product-header\">
                    <div class=\"product-icon\">
                        <i class=\"fas fa-capsules\"></i>
                    </div>
                    <h3 class=\"product-name\">";
                // line 316
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 316), "html", null, true);
                yield "</h3>
                </div>
                <div class=\"product-body\">
                    <p class=\"product-description\">
                        ";
                // line 320
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", true, true, false, 320)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 320), "No description available")) : ("No description available")), 0, 100), "html", null, true);
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", true, true, false, 320)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 320), "")) : (""))) > 100)) ? ("...") : (""));
                yield "
                    </p>
                    <div class=\"product-footer\">
                        <div>
                            <div class=\"product-price\">\$";
                // line 324
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 324), "html", null, true);
                yield "</div>
                            <div class=\"product-unit\">per unit</div>
                        </div>
                        <div class=\"product-actions\">
                            <button class=\"btn-view\" onclick=\"showProductDetails('";
                // line 328
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "id", [], "any", false, false, false, 328), "html", null, true);
                yield "', '";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 328), "html", null, true);
                yield "', '";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 328), "html", null, true);
                yield "', '";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", true, true, false, 328)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 328), "No description")) : ("No description")), "html", null, true);
                yield "')\">
                                <i class=\"fas fa-eye me-1\"></i> View
                            </button>
                            ";
                // line 331
                if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 332
                    yield "                                <button class=\"btn-wishlist wishlist-btn\" data-product-id=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "id", [], "any", false, false, false, 332), "html", null, true);
                    yield "\" onclick=\"toggleWishlist(this, ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["product"], "id", [], "any", false, false, false, 332), "html", null, true);
                    yield ")\">
                                    <i class=\"fas fa-heart\"></i>
                                </button>
                            ";
                }
                // line 336
                yield "                        </div>
                    </div>
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['product'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 341
            yield "    </div>
";
        } else {
            // line 343
            yield "    <!-- Empty State -->
    <div class=\"empty-state\">
        <div class=\"empty-state-icon\">
            <i class=\"fas fa-inbox\"></i>
        </div>
        <h3 class=\"empty-state-title\">No Products Available</h3>
        <p class=\"empty-state-text\">Products will appear here once they are added to the parapharmacy catalog.</p>
    </div>
";
        }
        // line 352
        yield "
<!-- Product Details Modal (Optional) -->
<div id=\"productModal\" style=\"display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); z-index: 1000; padding: 20px;\">
    <div style=\"background: white; border-radius: 12px; max-width: 500px; margin: 50px auto; padding: 30px; position: relative;\">
        <button onclick=\"closeProductDetails()\" style=\"position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 1.5rem; cursor: pointer;\">×</button>
        <h2 id=\"modalTitle\" style=\"color: var(--primary); margin-top: 0;\"></h2>
        <p id=\"modalDescription\" style=\"color: #6b7280; line-height: 1.6;\"></p>
        <div style=\"border-top: 2px solid var(--border); padding-top: 20px; margin-top: 20px;\">
            <label style=\"color: #6b7280; font-size: 0.9rem; font-weight: 600;\">Price</label>
            <div id=\"modalPrice\" style=\"font-size: 2rem; font-weight: 800; color: var(--primary);\"></div>
        </div>
    </div>
</div>

<script>
    // Store original product order
    let allProducts = [];

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterAndSort();
    });

    // Sort functionality
    document.getElementById('sortInput').addEventListener('change', function() {
        filterAndSort();
    });

    function filterAndSort() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const sortValue = document.getElementById('sortInput').value;
        const products = document.querySelectorAll('.product-card');
        
        // Filter
        let visibleProducts = [];
        products.forEach(product => {
            const productName = product.getAttribute('data-product-name');
            if (productName.includes(searchTerm)) {
                product.style.display = '';
                visibleProducts.push(product);
            } else {
                product.style.display = 'none';
            }
        });

        // Sort visible products
        visibleProducts.sort((a, b) => {
            const nameA = a.getAttribute('data-product-name');
            const nameB = b.getAttribute('data-product-name');
            const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('\$', ''));
            const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('\$', ''));

            switch(sortValue) {
                case 'name-asc':
                    return nameA.localeCompare(nameB);
                case 'name-desc':
                    return nameB.localeCompare(nameA);
                case 'price-asc':
                    return priceA - priceB;
                case 'price-desc':
                    return priceB - priceA;
                default:
                    return 0;
            }
        });

        // Reorder DOM elements
        const grid = document.getElementById('productsGrid');
        visibleProducts.forEach(product => {
            grid.appendChild(product);
        });
    }

    // Modal functions
    function showProductDetails(id, name, price, description) {
        document.getElementById('modalTitle').textContent = name;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('modalPrice').textContent = '\$' + price;
        document.getElementById('productModal').style.display = 'block';
    }

    function closeProductDetails() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('productModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });

    // Wishlist functionality
    function toggleWishlist(button, productId) {
        // Prevent multiple clicks during request
        if (button.disabled) return;
        
        button.disabled = true;
        const isInWishlist = button.classList.contains('in-wishlist');
        const url = isInWishlist 
            ? `";
        // line 452
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("wishlist_remove_by_product", ["productId" => 0]);
        yield "`.replace('0', productId)
            : `";
        // line 453
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("wishlist_add", ["productId" => 0]);
        yield "`.replace('0', productId);
        
        // Get CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name=\"csrf-token\"]')?.getAttribute('content') || '';
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: '_token=' + encodeURIComponent(csrfToken)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: \${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (isInWishlist) {
                    button.classList.remove('in-wishlist');
                } else {
                    button.classList.add('in-wishlist');
                }
                // Show success notification
                alert(data.message);
            } else {
                console.error('Error:', data.message);
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update wishlist. Please try again.');
            // Revert on error
            if (isInWishlist) {
                button.classList.add('in-wishlist');
            } else {
                button.classList.remove('in-wishlist');
            }
        })
        .finally(() => {
            button.disabled = false;
        });
    }

    // Initialize wishlist buttons on page load
    document.addEventListener('DOMContentLoaded', function() {
        const wishlistButtons = document.querySelectorAll('.wishlist-btn');
        wishlistButtons.forEach(button => {
            const productId = button.dataset.productId;
            fetch(`";
        // line 506
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("wishlist_check", ["productId" => 0]);
        yield "`.replace('0', productId), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: \${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.inWishlist) {
                    button.classList.add('in-wishlist');
                }
            })
            .catch(error => {
                console.error('Error checking wishlist:', error);
                // Don't show the button as broken if check fails
            });
        });
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
        return "parapharmacy/index.html.twig";
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
        return array (  664 => 506,  608 => 453,  604 => 452,  502 => 352,  491 => 343,  487 => 341,  477 => 336,  467 => 332,  465 => 331,  453 => 328,  446 => 324,  438 => 320,  431 => 316,  420 => 311,  416 => 310,  412 => 308,  410 => 307,  387 => 287,  380 => 283,  370 => 275,  360 => 274,  86 => 6,  76 => 5,  59 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Parapharmacy Products - PinkShield{% endblock %}

{% block stylesheets %}
<style>
    .products-header {
        margin-bottom: 40px;
    }

    .products-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .products-header h1 i {
        color: var(--primary);
    }

    .products-header p {
        color: #6b7280;
        font-size: 1.05rem;
    }

    .search-filter-bar {
        margin-bottom: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
    }

    .sort-box {
        min-width: 200px;
    }

    .search-box input, .sort-box select {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.2s;
        background-color: white;
    }

    .search-box input:focus, .sort-box select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .product-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        border-color: var(--primary);
    }

    .product-header {
        background: linear-gradient(135deg, rgba(196, 30, 58, 0.1) 0%, rgba(255, 182, 193, 0.1) 100%);
        padding: 25px 20px;
        border-bottom: 2px solid var(--border);
        text-align: center;
    }

    .product-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .product-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .product-body {
        padding: 20px;
    }

    .product-description {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
        min-height: 45px;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
    }

    .product-unit {
        font-size: 0.8rem;
        color: #9ca3af;
        font-weight: 500;
    }

    .btn-view {
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

    .btn-view:hover {
        background-color: #8B1428;
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }

    .btn-wishlist {
        background-color: white;
        color: var(--primary);
        border: 2px solid var(--primary);
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-wishlist:hover {
        background-color: var(--primary);
        color: white;
        transform: scale(1.05);
    }

    .btn-wishlist.in-wishlist {
        background-color: var(--primary);
        color: white;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--border);
        padding-top: 15px;
        gap: 8px;
    }

    .product-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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

    .stats-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        min-width: 150px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 5px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .products-header h1 {
            font-size: 1.6rem;
        }

        .search-filter-bar {
            flex-direction: column;
        }

        .search-box {
            min-width: 100%;
        }
    }
</style>
{% endblock %}

{% block body %}
<div class=\"products-header\">
    <h1><i class=\"fas fa-pills\"></i> Parapharmacy Products</h1>
    <p>Browse and manage pharmaceutical products and medical supplies</p>
</div>

<!-- Statistics -->
<div class=\"stats-bar\">
    <div class=\"stat-card\">
        <div class=\"stat-value\">{{ products|length }}</div>
        <div class=\"stat-label\">Total Products</div>
    </div>
    <div class=\"stat-card\">
        <div class=\"stat-value\">{{ products|length > 0 ? products|first.price : '0' }}</div>
        <div class=\"stat-label\">Starting Price</div>
    </div>
</div>

<!-- Search Bar and Sort -->
<div class=\"search-filter-bar\">
    <div class=\"search-box\">
        <input type=\"text\" id=\"searchInput\" placeholder=\"Search products by name...\">
    </div>
    <div class=\"sort-box\">
        <select id=\"sortInput\">
            <option value=\"name-asc\">Sort by Name (A-Z)</option>
            <option value=\"name-desc\">Sort by Name (Z-A)</option>
            <option value=\"price-asc\">Price: Low to High</option>
            <option value=\"price-desc\">Price: High to Low</option>
        </select>
    </div>
</div>

{% if products|length > 0 %}
    <!-- Products Grid -->
    <div class=\"products-grid\" id=\"productsGrid\">
        {% for product in products %}
            <div class=\"product-card\" data-product-name=\"{{ product.name|lower }}\" data-product-id=\"{{ product.id }}\">
                <div class=\"product-header\">
                    <div class=\"product-icon\">
                        <i class=\"fas fa-capsules\"></i>
                    </div>
                    <h3 class=\"product-name\">{{ product.name }}</h3>
                </div>
                <div class=\"product-body\">
                    <p class=\"product-description\">
                        {{ product.description|default('No description available')|slice(0, 100) }}{{ product.description|default('')|length > 100 ? '...' : '' }}
                    </p>
                    <div class=\"product-footer\">
                        <div>
                            <div class=\"product-price\">\${{ product.price }}</div>
                            <div class=\"product-unit\">per unit</div>
                        </div>
                        <div class=\"product-actions\">
                            <button class=\"btn-view\" onclick=\"showProductDetails('{{ product.id }}', '{{ product.name }}', '{{ product.price }}', '{{ product.description|default('No description') }}')\">
                                <i class=\"fas fa-eye me-1\"></i> View
                            </button>
                            {% if is_granted('ROLE_USER') %}
                                <button class=\"btn-wishlist wishlist-btn\" data-product-id=\"{{ product.id }}\" onclick=\"toggleWishlist(this, {{ product.id }})\">
                                    <i class=\"fas fa-heart\"></i>
                                </button>
                            {% endif %}
                        </div>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
{% else %}
    <!-- Empty State -->
    <div class=\"empty-state\">
        <div class=\"empty-state-icon\">
            <i class=\"fas fa-inbox\"></i>
        </div>
        <h3 class=\"empty-state-title\">No Products Available</h3>
        <p class=\"empty-state-text\">Products will appear here once they are added to the parapharmacy catalog.</p>
    </div>
{% endif %}

<!-- Product Details Modal (Optional) -->
<div id=\"productModal\" style=\"display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); z-index: 1000; padding: 20px;\">
    <div style=\"background: white; border-radius: 12px; max-width: 500px; margin: 50px auto; padding: 30px; position: relative;\">
        <button onclick=\"closeProductDetails()\" style=\"position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 1.5rem; cursor: pointer;\">×</button>
        <h2 id=\"modalTitle\" style=\"color: var(--primary); margin-top: 0;\"></h2>
        <p id=\"modalDescription\" style=\"color: #6b7280; line-height: 1.6;\"></p>
        <div style=\"border-top: 2px solid var(--border); padding-top: 20px; margin-top: 20px;\">
            <label style=\"color: #6b7280; font-size: 0.9rem; font-weight: 600;\">Price</label>
            <div id=\"modalPrice\" style=\"font-size: 2rem; font-weight: 800; color: var(--primary);\"></div>
        </div>
    </div>
</div>

<script>
    // Store original product order
    let allProducts = [];

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterAndSort();
    });

    // Sort functionality
    document.getElementById('sortInput').addEventListener('change', function() {
        filterAndSort();
    });

    function filterAndSort() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const sortValue = document.getElementById('sortInput').value;
        const products = document.querySelectorAll('.product-card');
        
        // Filter
        let visibleProducts = [];
        products.forEach(product => {
            const productName = product.getAttribute('data-product-name');
            if (productName.includes(searchTerm)) {
                product.style.display = '';
                visibleProducts.push(product);
            } else {
                product.style.display = 'none';
            }
        });

        // Sort visible products
        visibleProducts.sort((a, b) => {
            const nameA = a.getAttribute('data-product-name');
            const nameB = b.getAttribute('data-product-name');
            const priceA = parseFloat(a.querySelector('.product-price').textContent.replace('\$', ''));
            const priceB = parseFloat(b.querySelector('.product-price').textContent.replace('\$', ''));

            switch(sortValue) {
                case 'name-asc':
                    return nameA.localeCompare(nameB);
                case 'name-desc':
                    return nameB.localeCompare(nameA);
                case 'price-asc':
                    return priceA - priceB;
                case 'price-desc':
                    return priceB - priceA;
                default:
                    return 0;
            }
        });

        // Reorder DOM elements
        const grid = document.getElementById('productsGrid');
        visibleProducts.forEach(product => {
            grid.appendChild(product);
        });
    }

    // Modal functions
    function showProductDetails(id, name, price, description) {
        document.getElementById('modalTitle').textContent = name;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('modalPrice').textContent = '\$' + price;
        document.getElementById('productModal').style.display = 'block';
    }

    function closeProductDetails() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('productModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });

    // Wishlist functionality
    function toggleWishlist(button, productId) {
        // Prevent multiple clicks during request
        if (button.disabled) return;
        
        button.disabled = true;
        const isInWishlist = button.classList.contains('in-wishlist');
        const url = isInWishlist 
            ? `{{ path('wishlist_remove_by_product', {productId: 0}) }}`.replace('0', productId)
            : `{{ path('wishlist_add', {productId: 0}) }}`.replace('0', productId);
        
        // Get CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name=\"csrf-token\"]')?.getAttribute('content') || '';
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: '_token=' + encodeURIComponent(csrfToken)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: \${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (isInWishlist) {
                    button.classList.remove('in-wishlist');
                } else {
                    button.classList.add('in-wishlist');
                }
                // Show success notification
                alert(data.message);
            } else {
                console.error('Error:', data.message);
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update wishlist. Please try again.');
            // Revert on error
            if (isInWishlist) {
                button.classList.add('in-wishlist');
            } else {
                button.classList.remove('in-wishlist');
            }
        })
        .finally(() => {
            button.disabled = false;
        });
    }

    // Initialize wishlist buttons on page load
    document.addEventListener('DOMContentLoaded', function() {
        const wishlistButtons = document.querySelectorAll('.wishlist-btn');
        wishlistButtons.forEach(button => {
            const productId = button.dataset.productId;
            fetch(`{{ path('wishlist_check', {productId: 0}) }}`.replace('0', productId), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: \${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.inWishlist) {
                    button.classList.add('in-wishlist');
                }
            })
            .catch(error => {
                console.error('Error checking wishlist:', error);
                // Don't show the button as broken if check fails
            });
        });
    });
</script>
{% endblock %}
", "parapharmacy/index.html.twig", "C:\\Users\\driss\\Downloads\\PinkShield-main (1)\\PinkShield-main\\templates\\parapharmacy\\index.html.twig");
    }
}
