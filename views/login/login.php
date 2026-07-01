<section class="flex grow justify-center items-center">
    <div class="w-[20%] h-140 rounded-3xl">
        <h2 class="text-center pt-15 text-blue-900 text-[50px]">ล็อคอิน</h2>
        <form onsubmit="login(event)">
            <div class="flex flex-col items-center text-[19px] w-full">
                <fieldset class="border rounded-lg border-blue-900 w-full">
                    <legend >Email</legend>
                    <input class="text-[16px] box-border focus:outline-none w-full max-w-full pl-2" type="email" name="email" id="email" require>
                </fieldset>

                <fieldset class="border rounded-lg border-blue-900 w-full">
                    <legend >รหัสผ่าน</legend>
                    <input class="text-[16px] box-border focus:outline-none w-full max-w-full pl-2" type="password" name="password" id="password" autocomplete="off" require>
                </fieldset>
                <button class="cursor-pointer text-[20px] text-white pl-10 pr-10 pt-5 pb-5 mt-5 bg-blue-900 rounded-2xl" type="submit">ล็อคอิน</button>
                <p>or</p>
                <p>ยังไม่มีบัญชี <a class="text-blue-900"href="./?views=register">สมัครสมาชิก</a></p>
            </div>
        </form>
    </div>
</section>

<script src="<?= BASE_URL ?>./assets/js/scripts/login.js"></script>