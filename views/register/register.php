<div class="flex grow justify-center items-center">
    <div class="w-2xl">
        <img class="rounded-s-2xl"src="./assets/img/sadCat.jpg" alt="sadCat">
    </div>
    <div class="w-2xl rounded-e-2xl">
        <h2 class="text-center text-[50px] text-blue-900">สมัครสมาชิก</h2>
        
        <form novalidate onsubmit="register(event)" method="post">
            <div class="text-[19px] pl-50 pr-50">

                <fieldset class="border border-blue-900 rounded-xl">
                    <legend for="firstname">ชื่อ</legend>
                    <input class="w-full focus:outline-none pl-2" type="text" name="firstname" id="firstname" required>
                </fieldset>

                <fieldset class="border border-blue-900 rounded-xl">
                    <legend for="lastname">นามสกุล</legend>
                    <input class="w-full focus:outline-none pl-2" type="text" name="lastname" id="lastname" required>
                </fieldset>

                <p class="hidden text-red-900" id="emailWrongFormat">รูปแบบอีเมลไม่ถูกต้อง</p>
                <fieldset class="border border-blue-900 rounded-xl">
                    <legend for="email">Email</legend>
                    <input class="w-full focus:outline-none pl-2" type="text" name="email" id="email" required>
                </fieldset>

                <fieldset class="border border-blue-900 rounded-xl">
                    <legend for="password">รหัสผ่าน</legend>
                    <input class="w-full focus:outline-none pl-2" type="password" name="password" id="password" autocomplete="off" required>
                </fieldset>

                <fieldset class="border border-blue-900 rounded-xl">
                    <legend for="cpassword">ยืนยันรหัสผ่าน</legend>
                    <input class="w-full focus:outline-none pl-2" type="password" name="cpassword" id="cpassword" autocomplete="off" required>
                </fieldset>
                <a class="block text-right mt-5 text-gray-900 " href="#">ลืมรหัสผ่าน?</a><br>
                
                <button class="block mx-auto cursor-pointer pl-10 pr-10 pt-5 pb-5 rounded-3xl border-none bg-blue-900 text-[20px] text-white" type="submit">สมัครสมาชิก</button>
                <span class="block text-center">or</span>
                <p class="block text-center">มีบัญชีอยู่แล้ว? <a class="text-blue-900"href="./?views=login">ล็อคอิน</a></p>
            </div>
            
        </form>
    </div>
</div>
<script src="./assets/js/scripts/register.js"></script>