<div class="container-login">
    <div class="card-login">
        <h2>ล็อคอิน</h2>
        <form onsubmit="login(event)">
            <div class="input-container">
                <fieldset>
                    <legend for="email">Email</legend>
                    <input type="email" name="email" id="email" require>
                </fieldset>
                <fieldset>
                    <legend for="password">รหัสผ่าน</legend>
                    <input type="password" name="password" id="password" autocomplete="off" require>
                </fieldset>
            </div>
            <button type="submit">ล็อคอิน</button>
            <span class="with-line">or</span>
            <p>ยังไม่มีบัญชี<a href="./?page=register">สมัครสมาชิก</a></p>
        </form>
    </div>
</div>
<script src="<?= BASE_URL ?>./assets/scripts/login.js"></script>