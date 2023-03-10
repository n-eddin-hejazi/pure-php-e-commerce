<?php 
global $pageTitle;
$pageTitle = 'Profile ' . auth()->name; 
include view_path() . 'admin/layouts/header.view.php'; ?>   
<br>
<div class="flex flex-col items-center gap-10">
    <div class="w-full bg-white border border-1 border-gray-300">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">User Profile</h3>
            </div>
            <div class="flex flex-col">
                <div class="flex items-center mb-2">
                    <span class="text-gray-600 text-sm">Name:</span>
                    <span class="ml-2 text-gray-900 text-sm"><?= auth()->name; ?></span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-gray-600 text-sm">Username:</span>
                    <span class="ml-2 text-gray-900 text-sm"><?= auth()->username; ?></span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-gray-600 text-sm">Email:</span>
                    <span class="ml-2 text-gray-900 text-sm"><?= auth()->email; ?></span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-gray-600 text-sm">Last Login:</span>
                    <span class="ml-2 text-gray-900 text-sm"><?= auth()->last_login; ?></span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-gray-600 text-sm">Created at:</span>
                    <span class="ml-2 text-gray-900 text-sm"><?= auth()->created_at; ?></span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-gray-600 text-sm">Updated at:</span>
                    <span class="ml-2 text-gray-900 text-sm"><?= auth()->updated_at; ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-white border border-1 border-gray-300">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit User Profile</h3>
            </div>
            <form action="<?= admin_url() ?>/profile/edit" method="POST" class="mx-auto flex flex-col justify-between gap-3">
                <div>
                    <input id="name" name="name" type="text" autocomplete="name" value="<?= auth()->name ?>" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Name">
                    <?php if (session()->hasFlash('name_errors')): ?>
                            <p class="text-xs text-red-500">
                                <?= session()->getFlash('name_errors')[0]; ?>
                            </p>
                    <?php endif; ?>
                </div>

                <div>
                    <input id="username" name="username" type="text" autocomplete="username" value="<?= auth()->username ?>" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username">
                    <?php if (session()->hasFlash('username_errors')): ?>
                            <p class="text-xs text-red-500">
                                <?= session()->getFlash('username_errors')[0]; ?>
                            </p>
                    <?php endif; ?>
                </div>           
        
                <div>
                    <button type="submit" class="uppercase tracking-widest group w-full py-2 px-4 border border-transparent text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                    </button>
                </div>

            </form>
        </div>
    </div>


</div>





<?php include view_path() . 'admin/layouts/footer.view.php'; ?>   