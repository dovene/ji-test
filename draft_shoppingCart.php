<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="draft_shoppingCart.css" rel="stylesheet">
    <title>Draft_ShoppingCart</title>
</head>
<body>
<?php include 'header.inc.php'; ?>
<main>
    <h1>Shopping Cart</h1>
    <table class="cart-table">
        <thead>
        <tr>
            <th>Article</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Sous-total</th>
        </tr>
        </thead>
        <tbody>
        <!-- Cart items will be dynamically inserted here by JavaScript -->
        </tbody>
    </table>
    <div class="summary">
        <div class="order-total">
            <h2>Commande totale</h2>
            <p>Total: €0.00</p>
        </div>
    </div>
</main>
<?php include 'footer.inc.php'; ?>
<script src="cart.js"></script>
</body>
</html>