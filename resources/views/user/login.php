<div class="flex items-center flex-col w-[40px]">
    <div class="mb-4 text-2xl ">
        <h1><?= $title ?? '' ?></h1>
    </div>
</div>
<div>
    <form class="max-w-sm mx-auto" method="post" action="/login">
        <input type="hidden" name="token" value="<?= get_csrf_token(); ?>">
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input value="<?= old('email') ?>" name="email" type="email" id="email"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
               <?= set_validation_class('email') ?> "
                   placeholder="name@flowbite.com"/>
            <div class="text-red-800"><?= get_errors('email') ?></div>
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
            <input value="<?= old('password') ?>" name="password" type="password" id="password"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
               <?= set_validation_class('password') ?>  "/>
            <div class="text-red-800"><?= get_errors('password') ?></div>
        </div>
        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Login
        </button>
    </form>
</div>
<?php
session()->remove('form_data');
session()->remove('form_errors');
?>