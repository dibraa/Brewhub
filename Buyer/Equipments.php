<?php
declare(strict_types=1);

session_start();

function bh_fetch_products_from_session(): array
{
  $products = $_SESSION['bh_products'] ?? [];
  if (!is_array($products)) {
    return [];
  }

  $out = [];
  foreach ($products as $p) {
    if (!is_array($p)) {
      continue;
    }
    $id = (int) ($p['id'] ?? 0);
    if ($id <= 0) {
      continue;
    }
    $out[] = [
      'id' => $id,
      'name' => (string) ($p['name'] ?? ''),
      'category' => (string) ($p['category'] ?? ''),
      'price' => (float) ($p['price'] ?? 0),
      'image' => (string) ($p['image'] ?? ''),
    ];
  }

  return $out;
}

function bh_cache_product_from_post(int $productId): void
{
  if ($productId <= 0) {
    return;
  }

  $name = trim((string) ($_POST['product_name'] ?? ''));
  $category = trim((string) ($_POST['product_category'] ?? ''));
  $image = trim((string) ($_POST['product_image'] ?? ''));
  $price = (float) ($_POST['product_price'] ?? 0);

  if ($name === '' && $price <= 0 && $category === '' && $image === '') {
    return;
  }

  if (!isset($_SESSION['bh_product_cache']) || !is_array($_SESSION['bh_product_cache'])) {
    $_SESSION['bh_product_cache'] = [];
  }

  $_SESSION['bh_product_cache'][$productId] = [
    'id' => $productId,
    'name' => $name,
    'category' => $category,
    'price' => $price,
    'image' => $image,
  ];
}

if (!isset($_SESSION['bh_cart']) || !is_array($_SESSION['bh_cart'])) {
  $_SESSION['bh_cart'] = [];
}

$flash = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
  $action = (string) ($_POST['action'] ?? '');
  $productId = (int) ($_POST['product_id'] ?? 0);

  if ($productId > 0 && ($action === 'add_to_cart' || $action === 'buy_now')) {
    bh_cache_product_from_post($productId);
    $cart = (array) $_SESSION['bh_cart'];
    $cart[$productId] = (int) ($cart[$productId] ?? 0) + 1;
    $_SESSION['bh_cart'] = $cart;

    $flash = ($action === 'buy_now')
      ? 'Added to cart. Buy Now flow coming soon.'
      : 'Added to cart.';
  }
}

$cartCount = array_sum(array_map('intval', (array) $_SESSION['bh_cart']));

$allProducts = bh_fetch_products_from_session();

$products = array_values(array_filter($allProducts, function ($p): bool {
  $category = strtolower((string) ($p['category'] ?? ''));
  if ($category === '') {
    return false;
  }
  return strpos($category, 'equip') !== false;
}));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Equipments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../Style.css?v=20260423" rel="stylesheet">

  </head>
<body class="dashboard-page">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
    <div class="container-fluid px-4 px-lg-5 bh-nav-container">
      <a class="navbar-brand bh-brand" href="Dashboard.php">Brewhub</a>

      <div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions">
        <a class="btn bh-icon-btn" href="../Profile.php" aria-label="Profile">
          <i class="bi bi-person"></i>
        </a>
		<a class="btn bh-icon-btn position-relative" href="Cart.php" aria-label="Cart">
          <i class="bi bi-bag"></i>
			<span class="bh-cart-count"><?php echo (int) $cartCount; ?></span>
        </a>
        <button class="navbar-toggler border-0 shadow-none p-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse justify-content-center order-md-2" id="navbarNav">
        <ul class="navbar-nav align-items-md-center gap-md-4 gap-lg-5 bh-nav-links">
          <li class="nav-item">
            <a class="nav-link" href="Dashboard.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Categories</a>
            <ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
              <li><a class="dropdown-item" href="CoffeeIngredients.php">Coffee &amp; Ingredients</a></li>
              <li><a class="dropdown-item" href="CupsPackaging.php">Cups &amp; Packaging</a></li>
              <li><a class="dropdown-item active" aria-current="page" href="Equipments.php">Equipments</a></li>
              <li><a class="dropdown-item" href="Pastry.php">Pastry</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Orders.php">Orders</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="dashboard-main">
    <section class="dashboard-hero">
      <div class="dashboard-hero-overlay"></div>
      <div class="container-fluid px-5 py-5 position-relative">
        <div class="dashboard-hero-content">
          <p class="hero-kicker mb-2">Product Category</p>
          <h1 class="display-5 fw-semibold mb-3">Equipments</h1>
          <p class="lead mb-0">Browse espresso machines, grinders, brewers, and cafe equipment.</p>
        </div>
      </div>
    </section>

  <div class="container-fluid px-5 pb-5 mt-4 products-grid">
    <?php if ($flash): ?>
      <div class="alert alert-warning border-0" role="alert">
        <?php echo htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?>
      </div>
    <?php endif; ?>

    <div class="row g-4 mt-3">
      <?php if (count($products) === 0): ?>
        <div class="col-12">
          <div class="bh-section-card">
            <div class="d-flex align-items-center gap-2">
              <span class="bh-card-icon"><i class="bi bi-inbox"></i></span>
              <div>
                <div class="fw-bold">No products found</div>
                <div class="text-muted">Add products to your database later — they will show here.</div>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <?php foreach ($products as $p): ?>
          <?php
            $id = (int) ($p['id'] ?? 0);
            $name = (string) ($p['name'] ?? '');
            $category = strtoupper((string) ($p['category'] ?? 'Equipments'));
            $price = (float) ($p['price'] ?? 0);
            $image = (string) ($p['image'] ?? '../Assets/Carousel.png');
            $description = 'A premium ' . $name . ' built for busy cafe operations. Durable performance and dependable results for daily use.';
          ?>

          <div class="col-12 col-sm-6 col-lg-4">
            <div
              class="bh-product-card h-100 js-product-preview"
              role="button"
              tabindex="0"
              data-product-id="<?php echo $id; ?>"
              data-name="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"
              data-category="<?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>"
              data-price="₱<?php echo number_format($price, 2); ?>"
              data-image="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>"
              data-description="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>"
            >
              <div class="bh-product-media">
                <img class="bh-product-img" src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
              </div>
              <div class="bh-product-body">
                <div class="bh-product-top">
                  <h3 class="bh-product-title"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h3>
                  <div class="bh-product-price">₱<?php echo number_format($price, 2); ?></div>
                </div>
                <div class="bh-product-meta">
                  <span class="bh-product-badge"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div class="bh-product-actions">
                  <form method="post" class="m-0">
                    <input type="hidden" name="action" value="add_to_cart">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_category" value="<?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars((string) $price, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" class="btn bh-btn bh-btn-primary btn-sm"><i class="bi bi-bag-plus me-1"></i>Add to cart</button>
                  </form>
                  <form method="post" class="m-0">
                    <input type="hidden" name="action" value="buy_now">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_category" value="<?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars((string) $price, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" class="btn bh-btn bh-btn-ghost btn-sm"><i class="bi bi-lightning-charge me-1"></i>Buy now</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="bh-preview-backdrop" id="bhProductPreview" hidden>
    <div class="bh-preview-dialog" role="dialog" aria-modal="true" aria-labelledby="bhPreviewTitle">
      <div class="bh-product-card bh-preview-card">
        <button type="button" class="bh-preview-close" id="bhPreviewClose" aria-label="Close preview">
          <i class="bi bi-x-lg"></i>
        </button>

        <div class="bh-product-media">
          <img class="bh-product-img" id="bhPreviewImage" src="" alt="">
        </div>

        <div class="bh-product-body">
          <div class="bh-product-top">
            <h3 class="bh-product-title" id="bhPreviewTitle"></h3>
            <div class="bh-product-price" id="bhPreviewPrice"></div>
          </div>

          <div class="bh-product-meta">
            <span class="bh-product-badge" id="bhPreviewCategory"></span>
          </div>

          <form class="bh-preview-form" onsubmit="return false;">
            <label class="bh-preview-label" for="bhPreviewDescription">Description</label>
            <textarea class="form-control bh-preview-description" id="bhPreviewDescription" rows="4" readonly></textarea>
          </form>

          <div class="bh-product-actions bh-preview-actions">
            <form method="post" class="m-0">
              <input type="hidden" name="action" value="add_to_cart">
              <input type="hidden" name="product_id" id="bhPreviewAddProductId" value="">
              <input type="hidden" name="product_name" id="bhPreviewAddProductName" value="">
              <input type="hidden" name="product_category" id="bhPreviewAddProductCategory" value="">
              <input type="hidden" name="product_price" id="bhPreviewAddProductPrice" value="">
              <input type="hidden" name="product_image" id="bhPreviewAddProductImage" value="">
              <button type="submit" class="btn bh-btn bh-btn-primary btn-sm"><i class="bi bi-bag-plus me-1"></i>Add to cart</button>
            </form>
            <form method="post" class="m-0">
              <input type="hidden" name="action" value="buy_now">
              <input type="hidden" name="product_id" id="bhPreviewBuyProductId" value="">
              <input type="hidden" name="product_name" id="bhPreviewBuyProductName" value="">
              <input type="hidden" name="product_category" id="bhPreviewBuyProductCategory" value="">
              <input type="hidden" name="product_price" id="bhPreviewBuyProductPrice" value="">
              <input type="hidden" name="product_image" id="bhPreviewBuyProductImage" value="">
              <button type="submit" class="btn bh-btn bh-btn-ghost btn-sm"><i class="bi bi-lightning-charge me-1"></i>Buy now</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </main>

  <footer class="bh-footer-bar px-4 px-lg-5 py-4 mt-5">
    <div class="container-fluid bh-footer-bar-container">
      <div class="bh-footer-bar-left">
        <div class="bh-footer-bar-logo-box">
          <img src="../Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-bar-logo">
        </div>

        <div class="bh-footer-bar-meta">
          <div class="bh-footer-bar-copy">&copy; 2026 Brewhub</div>
          <div class="bh-footer-bar-legal" aria-label="Legal links">
            <a class="bh-footer-bar-legal-link" href="#">Terms</a>
            <a class="bh-footer-bar-legal-link" href="#">Privacy</a>
            <a class="bh-footer-bar-legal-link" href="#">Cookies</a>
          </div>
        </div>
      </div>

      <nav class="bh-footer-bar-nav" aria-label="Footer navigation">
        <a class="bh-footer-bar-link" href="Dashboard.php">Home</a>
        <a class="bh-footer-bar-link" href="Orders.php">Orders</a>
        <a class="bh-footer-bar-link" href="CoffeeIngredients.php">Coffee &amp; Ingredients</a>
        <a class="bh-footer-bar-link" href="CupsPackaging.php">Cups &amp; Packaging</a>
        <a class="bh-footer-bar-link" href="Equipments.php">Equipments</a>
        <a class="bh-footer-bar-link" href="Pastry.php">Pastry</a>
      </nav>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="product-preview.js"></script>
</body>
</html>
