<?php
session_start();

// Check if the color is selected
if (isset($_POST['color'])) {
    $_SESSION['color'] = $_POST['color'];
} elseif (isset($_POST['reset'])) {
    unset($_SESSION['color']);
}

// Include the header and navigation menu
include 'header.php';
include 'menu.php';
?>

    <div class="container">
    <h1>Page 1</h1>
    <hr>

    <form action="" method="post">
        <label for="color">Select your favorite color:</label>
         <!-- JavaScript event handler. It's saying that, when the value of this dropdown menu is changed (onchange), it should submit the form  -->
         <!-- Source : https://5balloons.info/submit-form-on-change-of-select-box-option -->
        <select name="color" id="color" onchange="this.form.submit()">
            <option value="#f2f2f2">White</option>
            <option value="#ffb3b3">Red</option>
            <option value="#ccffcc">Green</option>
            <option value="#cce0ff">Blue</option>
            <option value=" #ffff99">Yellow</option>
        </select>
    
        <input type="submit" name="reset" value="Reset">
    </form>
    </div>

<?php
// Include the footer
include 'footer.php';
?>
