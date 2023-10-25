<?php
session_start();

// The use cannot access this page is he did not order
if (!isset($_SESSION['order'])) {
  header("Location: form.php");
  exit;
}

$order = $_SESSION['order'];
$products = $_SESSION['products']; 
// Initializing total cost
$total = 0; 
?>

<!-- HEADER and NAVIGATION BAR -->
<?php
// Include the header and navigation menu
include 'header.php';
include 'menu.php';
?>

<div class="container">
  <h1>Major Restaurant - Confirmation Page</h1>

  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Price (CAD$)</th>
        <th class="text-center">Total</th>
      </tr>
    </thead>
    <hr>
    <tbody>
      <?php foreach($order as $name => $quantity): ?>
        <tr>
          <!-- Name -->
          <td><?php echo $name; ?></td>
          <!-- Quantity -->
          <td class="text-center"><?php echo $quantity; ?></td>
          <!-- Price -->
          <!-- What is the price at the index [$name] of $product -->
          <td class="text-center"><?php echo $products[$name]; ?></td> 
          <!-- Total cost -->
          <td><?php $cost = $products[$name] * $quantity; echo $cost . "$"; ?></td> 
        </tr>
        <?php $total += $cost; endforeach; ?>
        <tr class="black-horizontal-lines">
          <!-- Total of all items -->
          <td colspan="3" class="text-right fw-bold">TOTAL</td>
          <td class="fw-bold"><?php echo $total . "$"; ?></td>
        </tr>

      </tbody>
    </table>
    <br>

    <form method="get" action="form.php" >
      <input type="submit" value="Back to Order Form">
    </form>
    <br>

    <form method="post" action="checkout.php">
      <input type="submit" name="checkout" value="Check Out">
    </form>
  </div>


  <!-- FOOTER -->
  <?php 
// Include the footer
  include 'footer.php';
  ?>
