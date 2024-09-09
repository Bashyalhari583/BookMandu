
<div class="container mx-auto mt-24 max-w-md p-8 bg-white shadow-lg rounded-lg">
        <div class="header-box bg-blue-800 text-white p-4 rounded-t-lg text-center">
            <h2 class="text-2xl font-bold">Verify Your Email</h2>
        </div>

        <div class="verification-box bg-white p-6 rounded-b-lg">
            <div class="text-green-600 mb-4"><?php echo $msg ?? '' ?></div>
            <p class="mb-4">Enter Code Within <?php echo $expire ?? '' ?> minutes</p>
            <form method="post" action="/verify_email">
                <div class="mb-4">
                    <input type="hidden" name="id" value="<?php echo $id ?? '' ?>">
                    <label for="verificationCode" class="text-blue-800">Enter the Verification Code:</label>
                    <input type="text" class="form-control block w-full mt-2 px-3 py-2 border border-gray-300 rounded" id="verificationCode" name="verification_code" placeholder="Verification Code" required>
                </div>
                <div class="text-red-600 mb-4"><?php echo $error ?? '' ?></div>
                <div class="text-center">
                    <input type="submit" class="verify bg-blue-800 text-white py-2 px-6 rounded hover:bg-blue-700 transition-transform transform hover:scale-105 cursor-pointer" value="Verify">
                </div>
            </form>
            <form method="post" action="/resend_otp" class="mt-4  flex justify-center">
                <input name="id" value="<?php echo $id ??'' ?>" hidden>
                <input type="submit" class="resend bg-gray-400 text-white py-2 px-6 rounded hover:bg-gray-500 transition-transform transform hover:scale-105 cursor-pointer" value="Resend OTP">
            </form>
        </div>
    </div>

