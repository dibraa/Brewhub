<?php
declare(strict_types=1);

session_start();

// Initialize orders session if not exists
if (!isset($_SESSION['bh_orders']) || !is_array($_SESSION['bh_orders'])) {
  $_SESSION['bh_orders'] = [];
}

// Demo orders for display
$demoOrders = [
  [
    'id' => 'ORD-2024-001',
    'date' => '2024-04-20',
    'items' => 3,
    'total' => 1177.00,
    'status' => 'Delivered',
    'payment' => 'COD',
    'customer_name' => 'Juan Dela Cruz',
    'customer_phone' => '09123456789',
    'customer_address' => '123 Main St, Manila',
    'products' => [
      ['name' => 'Arabica Coffee Beans', 'qty' => 2, 'price' => 450.00],
      ['name' => 'Espresso Machine', 'qty' => 1, 'price' => 277.00],
    ],
  ],
  [
    'id' => 'ORD-2024-002',
    'date' => '2024-04-18',
    'items' => 2,
    'total' => 678.00,
    'status' => 'In Transit',
    'payment' => 'GCash',
    'customer_name' => 'Maria Santos',
    'customer_phone' => '09187654321',
    'customer_address' => '456 Oak Ave, Quezon City',
    'products' => [
      ['name' => 'Coffee Cups Set', 'qty' => 1, 'price' => 350.00],
      ['name' => 'Coffee Filters', 'qty' => 1, 'price' => 328.00],
    ],
  ],
  [
    'id' => 'ORD-2024-003',
    'date' => '2024-04-15',
    'items' => 5,
    'total' => 2547.00,
    'status' => 'Processing',
    'payment' => 'Card',
    'customer_name' => 'Pedro Reyes',
    'customer_phone' => '09198765432',
    'customer_address' => '789 Pine Rd, Makati',
    'products' => [
      ['name' => 'Coffee Grinder', 'qty' => 1, 'price' => 899.00],
      ['name' => 'Milk Frother', 'qty' => 2, 'price' => 450.00],
      ['name' => 'Coffee Beans', 'qty' => 2, 'price' => 374.00],
    ],
  ],
];

$orders = count($_SESSION['bh_orders']) > 0 ? $_SESSION['bh_orders'] : $demoOrders;

$cartCount = array_sum(array_map('intval', (array) ($_SESSION['bh_cart'] ?? [])));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Orders</title>
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
            <a class="nav-link dropdown-toggle" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Categories</a>
            <ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
              <li><a class="dropdown-item" href="CoffeeIngredients.php">Coffee &amp; Ingredients</a></li>
              <li><a class="dropdown-item" href="CupsPackaging.php">Cups &amp; Packaging</a></li>
              <li><a class="dropdown-item" href="Equipments.php">Equipments</a></li>
              <li><a class="dropdown-item" href="Pastry.php">Pastry</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Orders.php">Orders</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="dashboard-main">
    <div class="container-fluid px-4 px-lg-5 py-4">
      <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h1 class="cart-title mb-1">My Orders</h1>
              <p class="cart-subtitle mb-0">Track and manage your orders</p>
            </div>
            <a href="Dashboard.php" class="btn bh-btn bh-btn-ghost btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Back to Home
            </a>
          </div>

          <?php if (count($orders) === 0): ?>
            <div class="bh-section-card text-center py-5">
              <i class="bi bi-inbox" style="font-size: 4rem; color: rgba(150, 75, 0, 0.3);"></i>
              <h3 class="mt-3 mb-2">No orders yet</h3>
              <p class="text-muted mb-4">Start shopping to see your orders here!</p>
              <a href="Dashboard.php" class="btn bh-btn bh-btn-primary">
                <i class="bi bi-shop me-2"></i>Start Shopping
              </a>
            </div>
          <?php else: ?>
            <div class="bh-section-card">
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 orders-table">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Items</th>
                      <th>Total</th>
                      <th>Payment</th>
                      <th>Status</th>
                      <th class="text-end">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orders as $order): ?>
                      <tr>
                        <td>
                          <strong class="order-id"><?php echo htmlspecialchars($order['id'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($order['date'])); ?></td>
                        <td><?php echo (int) $order['items']; ?> item<?php echo $order['items'] !== 1 ? 's' : ''; ?></td>
                        <td><strong>₱<?php echo number_format((float) $order['total'], 2); ?></strong></td>
                        <td>
                          <span class="payment-badge payment-<?php echo strtolower($order['payment']); ?>">
                            <?php echo htmlspecialchars($order['payment'], ENT_QUOTES, 'UTF-8'); ?>
                          </span>
                        </td>
                        <td>
                          <?php
                            $statusClass = 'status-default';
                            if ($order['status'] === 'Delivered') {
                              $statusClass = 'status-delivered';
                            } elseif ($order['status'] === 'In Transit') {
                              $statusClass = 'status-transit';
                            } elseif ($order['status'] === 'Processing') {
                              $statusClass = 'status-processing';
                            }
                          ?>
                          <span class="order-status <?php echo $statusClass; ?>">
                            <?php echo htmlspecialchars($order['status'], ENT_QUOTES, 'UTF-8'); ?>
                          </span>
                        </td>
                        <td class="text-end">
                          <button type="button" class="btn bh-btn bh-btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal" data-order='<?php echo htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8'); ?>'>
                            <i class="bi bi-eye me-1"></i>View
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php endif; ?>
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

  <!-- Order Details Modal -->
  <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <p class="mb-2"><strong>Order ID:</strong> <span id="modalOrderId"></span></p>
              <p class="mb-2"><strong>Date:</strong> <span id="modalOrderDate"></span></p>
              <p class="mb-2"><strong>Status:</strong> <span id="modalOrderStatus"></span></p>
            </div>
            <div class="col-md-6">
              <p class="mb-2"><strong>Payment Method:</strong> <span id="modalPayment"></span></p>
              <p class="mb-2"><strong>Total Amount:</strong> <span id="modalTotal"></span></p>
            </div>
          </div>
          <hr>
          <h6 class="mb-3">Customer Information</h6>
          <p class="mb-2"><strong>Name:</strong> <span id="modalCustomerName"></span></p>
          <p class="mb-2"><strong>Phone:</strong> <span id="modalCustomerPhone"></span></p>
          <p class="mb-2"><strong>Address:</strong> <span id="modalCustomerAddress"></span></p>
          <hr>
          <h6 class="mb-3">Order Items</h6>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Product</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-end">Price</th>
                  <th class="text-end">Subtotal</th>
                </tr>
              </thead>
              <tbody id="modalOrderItems"></tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bh-btn bh-btn-ghost" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const orderModal = document.getElementById('orderModal');
      orderModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const order = JSON.parse(button.getAttribute('data-order'));
        
        document.getElementById('modalOrderId').textContent = order.id;
        document.getElementById('modalOrderDate').textContent = new Date(order.date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        document.getElementById('modalOrderStatus').innerHTML = `<span class="order-status status-${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span>`;
        document.getElementById('modalPayment').innerHTML = `<span class="payment-badge payment-${order.payment.toLowerCase()}">${order.payment}</span>`;
        document.getElementById('modalTotal').innerHTML = `<strong>₱${parseFloat(order.total).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</strong>`;
        document.getElementById('modalCustomerName').textContent = order.customer_name;
        document.getElementById('modalCustomerPhone').textContent = order.customer_phone;
        document.getElementById('modalCustomerAddress').textContent = order.customer_address;
        
        const itemsHtml = order.products.map(product => `
          <tr>
            <td>${product.name}</td>
            <td class="text-center">${product.qty}</td>
            <td class="text-end">₱${parseFloat(product.price).toFixed(2)}</td>
            <td class="text-end">₱${(product.qty * product.price).toFixed(2)}</td>
          </tr>
        `).join('');
        document.getElementById('modalOrderItems').innerHTML = itemsHtml;
      });
    });
  </script>
</body>
</html>
