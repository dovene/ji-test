<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Produits</title>
</head>
<body>
<?php include 'header.inc.php'; ?>
<main>
    <div class="product-listing">
        <aside class="sidebar">
            <h2>Shop By</h2>
            <p>______________________</p>
            <div class="filter">
                <!-- Filter content remains the same -->
            </div>
        </aside>
        <div class="products">
            <div class="banner">
                <img src="pack/ressources/img-03.png" alt="Banner">
            </div>
            <div class="row under-banner">
                <div class="col-md-1"><label>150 item(s)</label></div>
                <div class="col-md-8"></div>
                <div class="col-md-3">
                    <!-- Banner images remain the same -->
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="row">
                        <?php
                        // Number of products per page
                        $productsPerPage = 6;
                        // Determine the current page
                        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        // Calculate the offset
                        $offset = ($currentPage - 1) * $productsPerPage;

                        // Open the CSV file
                        if (($handle = fopen("prod.csv", "r")) !== FALSE) {
                            // Read the first line to get the column headers
                            $headers = fgetcsv($handle, 1000);
                            // Product counter
                            $count = 0;
                            // Loop to read lines and display them based on the current page
                            while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                                // Verify that the number of elements matches
                                if (count($headers) == count($data)) {
                                    if ($count >= $offset && $count < $offset + $productsPerPage) {
                                        // Associate data with column headers
                                        $product = array_combine($headers, $data);
                                        // Display the products
                                        echo '<div class="col-md-4">';
                                        echo '<div class="p-3 border bg-light text-center product-item">';
                                        echo '<img src="' . $product['image'] . '" class="img-fluid" alt="' . $product['nom'] . '">';
                                        echo '<h5>' . $product['nom'] . '</h5>';
                                        echo '<p>€ ' . $product['prix'] . '</p>';
                                        echo '<button onclick="addToCart(\'' . $product['id'] . '\', \'' . $product['nom'] . '\', ' . $product['prix'] . ', \'' . $product['image'] . '\')">Add to Cart</button>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    $count++;
                                }
                            }
                            fclose($handle);
                        } else {
                            echo "Erreur lors de l'ouverture du fichier CSV.";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="pagination">
                <?php
                // Calculate the total number of products
                if (($handle = fopen("prod.csv", "r")) !== FALSE) {
                    fgetcsv($handle, 1000); // Skip the headers
                    $totalProducts = 0;
                    while (fgetcsv($handle, 1000)) {
                        $totalProducts++;
                    }
                    fclose($handle);
                }

                // Calculate the total number of pages
                $totalPages = ceil($totalProducts / $productsPerPage);

                // Display pagination links
                if ($currentPage > 1) {
                    echo '<a href="?page=' . ($currentPage - 1) . '">&laquo; Previous</a>';
                }
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $currentPage) {
                        echo '<strong>' . $i . '</strong>';
                    } else {
                        echo '<a href="?page=' . $i . '">' . $i . '</a>';
                    }
                }
                if ($currentPage < $totalPages) {
                    echo '<a href="?page=' . ($currentPage + 1) . '">Next &raquo;</a>';
                }
                ?>
            </div>
            <div class="row pied">
                <div class="col-md-10">
                    <img src="pack/ressources/img-14.png">
                    <img src="pack/ressources/img-15.png">
                    <img src="pack/ressources/img-16.png">
                    <img src="pack/ressources/img-17.png">
                </div>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.inc.php'; ?>
<script src="cart.js"></script>
</body>
</html>
