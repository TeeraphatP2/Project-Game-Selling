<div class="container-register">
    <div class="card-left">
        <img src="./assets/img/sadCat.jpg" alt="sadCat">
    </div>
    <div class="card-right">
        <h2>สมัครสมาชิก</h2>
        
        <form novalidate onsubmit="register(event)" method="post">
            <div class="input-container">

                <fieldset>
                    <legend for="firstname">ชื่อ</legend>
                    <input type="text" name="firstname" id="firstname" required>
                </fieldset>

                <fieldset>
                    <legend for="lastname">นามสกุล</legend>
                    <input type="text" name="lastname" id="lastname" required>
                </fieldset>

                <p class="email-wrong-format" id="emailWrongFormat">รูปแบบอีเมลไม่ถูกต้อง</p>
                <fieldset>
                    <legend for="email">Email</legend>
                    <input type="text" name="email" id="email" required>
                </fieldset>

                <fieldset>
                    <legend for="password">รหัสผ่าน</legend>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </fieldset>

                <fieldset>
                    <legend for="cpassword">ยืนยันรหัสผ่าน</legend>
                    <input type="password" name="cpassword" id="cpassword" autocomplete="off" required>
                </fieldset>
                <a href="#">ลืมรหัสผ่าน?</a><br>
            </div>
            <button type="submit">สมัครสมาชิก</button>
            <span class="with-line">or</span>
            <p>มีบัญชีอยู่แล้ว?<a href="./?page=login">ล็อคอิน</a></p>
        </form>
    </div>
</div>
<script src="./assets/js/scripts/register.js"></script>