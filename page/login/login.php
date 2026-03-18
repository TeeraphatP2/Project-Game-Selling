<div class="container-login">
    <div class="card-login">
        <h2>ล็อคอิน</h2>
        <?php
        if (isset($_SESSION['error'])) { 
        ?>
        <h3>
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>        
            </h3>
        <?php }elseif(isset($_SESSION['success'])){ echo $_SESSION['success']; session_destroy();} 
        ?>
        
        <form action="./action/login_db.php" method="POST">
            <div class="input-container">
                <fieldset>
                    <legend for="email">Email</legend>
                    <input type="email" name="email" id="email" require>
                </fieldset>
                <fieldset>
                    <legend for="password">รหัสผ่าน</legend>
                    <input type="password" name="password" id="password" require>
                </fieldset>
            </div>
            <button type="submit">ล็อคอิน</button>
            <span class="with-line">or</span>
            <p>ยังไม่มีบัญชี<a href="./?page=register">สมัครสมาชิก</a></p>
        </form>
    </div>
</div>