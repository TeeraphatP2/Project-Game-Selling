<div class="container-homepage">
    <?php 
    if(isset($_SESSION['success'])){
        echo "<h2>{$_SESSION['success']}</h2>";
        session_unset();
    }
    ?>
    <h2>hello homepage</h2>
    <h2>สวัสดี</h2>
</div>