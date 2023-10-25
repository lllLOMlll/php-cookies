  <?php
  session_start();

  $products = array(
    "Pizza" => 12.99,
    "Poutine" => 6.99,
    "Hot-Dog" => 0.99,
    "Hamburger" => 5.99,
    "Giro" => 6.99,
    "Coke" => 1.99,
  );

  // Saving the array in a $_SESSION in the variable $products so I can access it in 'confirmation' and 'checkout
  // $products is storred in $_SESSION
  $_SESSION['products'] = $products; 

  if (isset($_SESSION['order']) && $_SESSION['remember']) {
    $order = $_SESSION['order'];
  } else {
    //Empty array
    $order = array();
  }

  // I need this to check if the total number of items is greater than 2 ($order = $_POST['quantity'];)
  $totalItems = array_sum($order);
  // By default, we assume there is no error
  $error = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order = $_POST['quantity'];
    $remember = isset($_POST['remember']);
    // I'm using $_SESSSION (superglobal) to be able to access those data on different pages of the website.
    $_SESSION['order'] = $order;
    $_SESSION['remember'] = $remember;

    $totalItems = array_sum($order);

    foreach ($order as $name => $quantity) {
      // Cast $quantity to an integer so the 0 will not be considered a string
      $quantity = (int)$quantity; 

      // Quantity validation
      if ($quantity < 0 || $quantity > 50) {
        $error = true;
        break;
      }
    }

    if (!$error && $totalItems >= 2) {
      header("Location: confirmation.php");
      exit;
    }
  }

  // Include the header and navigation menu
  include 'header.php';
  include 'menu.php';
  ?>

  <div class="container">
    <h1>Major Restaurant - Order Page</h1>
    <hr>
    <br>

    <!-- htmlspecialchars() function is used to sanitize the value and ensure that special characters in the URL are properly encoded. -->
    <form method="post" action="#">
      <!-- TABLE -->
      <table>
        <thead>
          <tr>
            <th>Item</th>
            <th class="text-center">Price (CAD$)</th>
            <th class="text-center">Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($products as $name => $price): ?>
            <tr>
              <!-- Displaying NAME -->
              <td><?php echo $name; ?></td>
              <!-- Displaying PRICE -->
              <td class="text-center"><?php echo $price; ?></td>
              <!-- Displaying QUANTITY -->
              <td>
                <!-- Set the default value for quantity (0) if the value is not already set -->
                <!-- The name is changing on each iteration of the loop creating an associative array of Name/Quantity -->
                <input type="number" name="quantity[<?php echo $name; ?>]" value="<?php echo isset($order[$name]) ? (int)$order[$name] : 0; ?>">
                <!-- VALIDATION -->
                <?php
                $quantity = isset($order[$name]) ? (int)$order[$name] : 0;


                if ($quantity < 0 || $quantity > 50) {
                  echo '<span style="color: red;">Invalid quantity. Please enter a number between 0 and 50.</span>';
                  $error = true;
                }
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <br>

      <!-- INPUT -->
      <input type="checkbox" id="remember" name="remember">
      <label for="remember">Remember my order</label><br>
      <input type="submit" name="submit" value="Submit">
    </form>
    <br>

    <?php
    // Display the error message if there are not enough items
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $error) {
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $totalItems < 2) {
      echo "<p class='bold-and-red'>You must purchase at least 2 items</p>";
    }
    ?>
  </div>

  <!-- Include the footer -->
  <?php 
  include 'footer.php';
  ?>
