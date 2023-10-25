<?php
session_start();

// The use cannot access this page is he did not order
if (!isset($_SESSION['order'])) {
  header("Location: form.php");
  exit;
}

$order = $_SESSION['order'];
$products = $_SESSION['products']; 

// Include the header and navigation menu
include 'header.php';
include 'menu.php';
?>

<div class="container">
  <h1>Major Restaurant - Receipt</h1>
  <hr>
  <h3>You receipt:</h3>
  <div class="ms-4">
    <?php 
    $totalCost = 0;
    foreach($order as $name => $quantity): ?>
      <?php 
    // Only displaying purchased items
      if ($quantity != 0) {
        echo $quantity . "&nbsp;&nbsp;" .  $name . " => ";
        $cost = $products[$name] * $quantity; 
        echo $cost . "$<br>";
        $totalCost += $cost;

      }

      ?>

    <?php endforeach; 
    echo "<div class='fw-bold'>TOTAL => " .$totalCost . "$</div>";
    ?>

  </div>
</div>

<?php
// Once done with session data, clear it
session_unset();
session_destroy();
?>

<!-- FOOTER -->
<?php 
// Include the footer
include 'footer.php';
?>
