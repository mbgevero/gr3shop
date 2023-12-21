<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    $name = $_POST["name"];
    $address = $_POST["address"];
    $contactNumber = $_POST["contact_number"];

    // Validate the input if needed

    // Assume that you have a user ID stored in the session
    $userId = $_SESSION["user_id"];

    // Insert order details into the orders table
    $insertOrderQuery = mysqli_query($conn, "INSERT INTO orders (user_id, name, address, contact_number) VALUES ($userId, '$name', '$address', '$contactNumber')");

    if ($insertOrderQuery) {
        // Get the order ID
        $orderId = mysqli_insert_id($conn);

        // Move items from cart to order_items table
        $moveCartItemsQuery = mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity) SELECT $orderId, id, quantity FROM cart WHERE user_id = $userId");

        if ($moveCartItemsQuery) {
            // Clear the cart
            mysqli_query($conn, "DELETE FROM cart WHERE user_id = $userId");

            // Redirect to a thank you page or order confirmation
            header('Location: thank_you.php');
            exit();
        } else {
            $checkoutError = "Error processing order. Please try again.";
        }
    } else {
        $checkoutError = "Error processing order. Please try again.";
    }
}

// Fetch cart items for display
$userId = $_SESSION["user_id"];
$cartItemsQuery = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $userId");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <!-- Include your header if needed -->

    <div class="container">
        <h1>Checkout</h1>

        <!-- Display checkout error if any -->
        <?php if (isset($checkoutError)) : ?>
            <div class="error-message"><?php echo $checkoutError; ?></div>
        <?php endif; ?>

        <!-- Display cart items -->
        <?php if (mysqli_num_rows($cartItemsQuery) > 0) : ?>
            <h2>Cart Items</h2>
            <ul>
                <?php while ($cartItem = mysqli_fetch_assoc($cartItemsQuery)) : ?>
                    <li><?php echo $cartItem['product_name']; ?> - <?php echo $cartItem['quantity']; ?> units</li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

        <!-- Checkout form -->
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="address">Address:</label>
            <input type="text" name="address" required>

            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" required>

            <input type="submit" name="submit" value="Place Order">
        </form>
    </div>

    <!-- Include your footer if needed -->
</body>
</html>
