<?php
session_start();

// Initializing the $viewCount
if (isset($_COOKIE['view_count'])) {
    $viewCount = $_COOKIE['view_count'] + 1;
} else {
    $viewCount = 1;
}

// SETTNG THE COOKIE
// Check if the view count reached 20, then delete the cookie
if ($viewCount === 20) {
    setcookie('view_count', '', time() - 3600); // Putting the expiration date in the past. Deleting the cookie
    $viewCount = 1;
} else {
    setcookie('view_count', $viewCount, time() + (86400 * 30)); // Cookie expiration time: 30 days
}

// Include the header and navigation menu
include 'header.php';
include 'menu.php';
?>
<div class="container">
<h1>Page 2</h1>
<hr>

<p>Number of views: <?php echo $viewCount; ?></p>
</div>
<?php
echo '<div class="container text-center" style="font-weight: bold">';
// 5, 10 and 15 visits
if ($viewCount === 5) {
    echo "<p>Visit #5 - I am impressed!</p>";
    echo '</div>';
} elseif ($viewCount === 10) {
    echo "<p>Visit #10 - I am really impressed!</p>";
    echo '</div>';
} elseif ($viewCount === 15) {
    echo "<p>Visit #15 - I am REALLY REALLY REALLY impressed. GOOD JOB!</p>";
    echo '</div>';
} else {
    echo '</div>';
}

// Include the footer
include 'footer.php';
?>
