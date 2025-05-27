<?php
// Disable error display to prevent HTML output
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Log errors to a file
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

session_start();
header('Content-Type: application/json');

// Log request for debugging
error_log('Checkout.php accessed at ' . date('Y-m-d H:i:s'));

if (!isset($_SESSION['id'])) {
    error_log('Checkout error: User not logged in at ' . date('Y-m-d H:i:s'));
    echo json_encode(['success' => false, 'message' => 'Please log in to checkout.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? [];
$payment_method = $input['payment_method'] ?? '';
$total_amount = $input['total_amount'] ?? 0;

error_log('Checkout input at ' . date('Y-m-d H:i:s') . ': ' . print_r($input, true));

if (empty($cart) || !in_array($payment_method, ['Credit/Debit Card', 'GCash', 'Cash on Delivery']) || $total_amount <= 0) {
    error_log('Checkout error: Invalid checkout data at ' . date('Y-m-d H:i:s'));
    echo json_encode(['success' => false, 'message' => 'Invalid checkout data.']);
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'street_style'); // example
if ($conn->connect_error) {
    error_log('Checkout error: Database connection failed at ' . date('Y-m-d H:i:s') . ' - ' . $conn->connect_error);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$conn->begin_transaction();
try {
    $stmt = $conn->prepare("INSERT INTO orders (id, total_amount, payment_method, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param('ids', $_SESSION['id'], $total_amount, $payment_method);
    if (!$stmt->execute()) {
        throw new Exception('Failed to insert order: ' . $stmt->error);
    }
    $order_id = $conn->insert_id;

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        if (!isset($item['id'], $item['quantity'], $item['price'])) {
            throw new Exception('Invalid cart item data');
        }
        $stmt->bind_param('iiid', $order_id, $item['id'], $item['quantity'], $item['price']);
        if (!$stmt->execute()) {
            throw new Exception('Failed to insert order item: ' . $stmt->error);
        }
    }

    $conn->commit();
    error_log('Checkout success: Order ID ' . $order_id . ' at ' . date('Y-m-d H:i:s'));
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    error_log('Checkout error at ' . date('Y-m-d H:i:s') . ': ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Checkout failed: ' . $e->getMessage()]);
}

$conn->close();
?>