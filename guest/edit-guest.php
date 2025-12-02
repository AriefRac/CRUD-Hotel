<?php

session_start();

if (!isset($_SESSION['ssLoginHotel'])) {
    header('Location: ../auth/login.php');
    exit();
}

require_once '../config/config.php';
require_once '../config/function.php';
require_once '../module/mode-guest.php';


$title = "Tambah Guest - Hotel";
include_once '../template/header.php';
include_once '../template/sidebar.php';
include_once '../template/navbar.php';

$guest_id = $_GET['id'];

$sqlEdit = "SELECT * FROM guest WHERE guest_id = $guest_id";
$guest = getData($sqlEdit)[0];


if (isset($_POST['update'])) {
    if (updateGuest($_POST)) {
        $_SESSION['success_message'] = 'Guest berhasil diupdate.';
        echo "<script>
                document.location.href = 'data-guest.php';
            </script>";
    }
}

?>

<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: `Tambah Guest`}">
            <?php require_once '../template/partials/breadcrumb.php'; ?>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <form action="" method="post">
                <div class="flex justify-between items-center px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-white/90">
                        Edit Data Guest
                    </h3>

                    <div class="flex gap-2">
                        <button type="submit" name="update"
                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            + Update Guest
                        </button>
                    </div>

                </div>
                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Id<span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="id" value="<?= $guest['guest_id'] ?>" readonly
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Name<span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="name" value="<?= $guest['name'] ?>"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Phone<span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="phone" value="<?= $guest['phone'] ?>"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>
                    <div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            NIK<span class="text-error-500">*</span>
                        </label>
                        <input name="nik" type="text" oninput="validateNumericInput(this)"
                            value="<?= $guest['nik'] ?>"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 " />
                    </div>
                    <div>
                        <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Address<span class="text-error-500">*</span>
                        </label>
                        <textarea name="address" rows="6"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"><?= $guest['address'] ?></textarea>
                        </div>
                        <div>
                            <span
                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
</main>



<?php include_once '../template/footer.php'; ?>