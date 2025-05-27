<?php
session_start();
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "street_style";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$action = $_POST['action'] ?? '';
$id = $_SESSION['id'] ?? null;

// Handle guest cart
if (!$id && !isset($_SESSION['guest_cart'])) {
    $_SESSION['guest_cart'] = [];
}

function mergeGuestCartToUser($pdo, $id) {
    if (isset($_SESSION['guest_cart']) && !empty($_SESSION['guest_cart'])) {
        foreach ($_SESSION['guest_cart'] as $item) {
            $stmt = $pdo->prepare('SELECT * FROM cart_items WHERE id = ? AND product_id = ?');
            $stmt->execute([$id, $item['product_id']]);
            if ($row = $stmt->fetch()) {
                $stmt = $pdo->prepare('UPDATE cart_items SET quantity = quantity + ? WHERE id = ? AND product_id = ?');
                $stmt->execute([$item['quantity'], $id, $item['product_id']]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO cart_items (id, product_id, quantity) VALUES (?, ?, ?)');
                $stmt->execute([$id, $item['product_id'], $item['quantity']]);
            }
        }
        $_SESSION['guest_cart'] = [];
    }
}

switch ($action) {
    case 'add_to_cart':
        $product_id = (int)($_POST['product_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 1);

        if ($product_id <= 0 || $quantity <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
            exit();
        }

        // Check if product exists
        $stmt = $pdo->prepare('SELECT * FROM products WHERE product_id = ?');
        $stmt->execute([$product_id]);
        if (!$stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Product not found']);
            exit();
        }

        if ($id) {
            // Handle logged-in user
            $stmt = $pdo->prepare('SELECT * FROM cart_items WHERE id = ? AND product_id = ?');
            $stmt->execute([$id, $product_id]);
            if ($row = $stmt->fetch()) {
                $stmt = $pdo->prepare('UPDATE cart_items SET quantity = quantity + ? WHERE id = ? AND product_id = ?');
                $stmt->execute([$quantity, $user_id, $product_id]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO cart_items (id, product_id, quantity) VALUES (?, ?, ?)');
                $stmt->execute([$id, $product_id, $quantity]);
            }
        } else {
            // Handle guest user
            $guest_cart = $_SESSION['guest_cart'];
            $existing_item = array_filter($guest_cart, fn($item) => $item['product_id'] == $product_id);
            if ($existing_item) {
                $index = key($existing_item);
                $_SESSION['guest_cart'][$index]['quantity'] += $quantity;
            } else {
                $_SESSION['guest_cart'][] = ['product_id' => $product_id, 'quantity' => $quantity];
            }
        }

        echo json_encode(['success' => true, 'message' => 'Added to cart']);
        break;

    case 'get_cart':
        $cart_items = [];
        if ($id) {
            $stmt = $pdo->prepare('
                SELECT ci.cart_item_id, ci.quantity, p.product_id, p.name, p.price, p.image
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.product_id
                WHERE ci.id = ?
            ');
            $stmt->execute([$user_id]);
            $cart_items = $stmt->fetchAll();
        } else {
            $guest_cart = $_SESSION['guest_cart'] ?? [];
            foreach ($guest_cart as $item) {
                $stmt = $pdo->prepare('SELECT product_id, name, price, image FROM products WHERE product_id = ?');
                $stmt->execute([$item['product_id']]);
                $product = $stmt->fetch();
                if ($product) {
                    $cart_items[] = [
                        'cart_item_id' => null,
                        'quantity' => $item['quantity'],
                        'product_id' => $product['product_id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image' => $product['image']
                    ];
                }
            }
        }

        echo json_encode(['success' => true, 'cart' => $cart_items]);
        break;

    case 'update_quantity':
        $cart_item_id = (int)($_POST['cart_item_id'] ?? 0);
        $quantity = (int)($_POST['quantity'] ?? 0);

        if ($id && $cart_item_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid cart item']);
            exit();
        }

        if ($id) {
            if ($quantity == 0) {
                $stmt = $pdo->prepare('DELETE FROM cart_items WHERE cart_item_id = ? AND id = ?');
                $stmt->execute([$cart_item_id, $id]);
            } else {
                $stmt = $pdo->prepare('UPDATE cart_items SET quantity = ? WHERE cart_item_id = ? AND id = ?');
                $stmt->execute([$quantity, $cart_item_id, $id]);
            }
        } else {
            $product_id = (int)($_POST['product_id'] ?? 0);
            $guest_cart = $_SESSION['guest_cart'];
            $index = array_search($product_id, array_column($guest_cart, 'product_id'));
            if ($index !== false) {
                if ($quantity == 0) {
                    unset($_SESSION['guest_cart'][$index]);
                    $_SESSION['guest_cart'] = array_values($_SESSION['guest_cart']);
                } else {
                    $_SESSION['guest_cart'][$index]['quantity'] = $quantity;
                }
            }
        }

        echo json_encode(['success' => true, 'message' => 'Cart updated']);
        break;

    case 'remove_from_cart':
        $cart_item_id = (int)($_POST['cart_item_id'] ?? 0);

        if ($id && $cart_item_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid cart item']);
            exit();
        }

        if ($id) {
            $stmt = $pdo->prepare('DELETE FROM cart_items WHERE cart_item_id = ? AND id = ?');
            $stmt->execute([$cart_item_id, $id]);
        } else {
            $product_id = (int)($_POST['product_id'] ?? 0);
            $guest_cart = $_SESSION['guest_cart'];
            $index = array_search($product_id, array_column($guest_cart, 'product_id'));
            if ($index !== false) {
                unset($_SESSION['guest_cart'][$index]);
                $_SESSION['guest_cart'] = array_values($_SESSION['guest_cart']);
            }
        }

        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
        break;

    case 'clear_cart':
        if ($id) {
            $stmt = $pdo->prepare('DELETE FROM cart_items WHERE id = ?');
            $stmt->execute([$id]);
        } else {
            $_SESSION['guest_cart'] = [];
        }

        echo json_encode(['success' => true, 'message' => 'Cart cleared']);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
?>