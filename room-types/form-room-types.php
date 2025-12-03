<?php

session_start();

if (!isset($_SESSION['ssLoginHotel'])) {
    header('Location: ../auth/login.php');
    exit();
}

require_once '../config/config.php';
require_once '../config/function.php';
require_once '../module/mode-room-types.php';


$title = "Tambah Room Type | Hotel";
include_once '../template/header.php';
include_once '../template/sidebar.php';
include_once '../template/navbar.php';

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $id = $_GET['id'];
    $sqlEdit = "SELECT * FROM room_types WHERE id = $id";
    $roomType = getData($sqlEdit)[0];
} else {
    $msg = '';
}

$alert = '';

if (isset($_POST['simpan'])) {
    if ($msg != '') {
        if (updateRoomsType($_POST)) {
            $_SESSION['success_message'] = 'Data berhasil diupdate.';
            echo "<script>
                document.location.href = 'index.php';
            </script>";
        }
    } else {
        if (insertRoomType($_POST)) {
            $alert = '<div x-data="{ 
                show: false, 
                progress: 100,
                duration: 3000,
                init() {
                    this.$nextTick(() => {
                        this.show = true;
                        const interval = 50;
                        const decrement = (interval / this.duration) * 100;
                        const timer = setInterval(() => {
                            this.progress -= decrement;
                            if (this.progress <= 0) {
                                clearInterval(timer);
                                this.show = false;
                            }
                        }, interval);
                    });
                }
            }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-full opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-full opacity-0"
            class="fixed bottom-6 right-6 z-50 w-96 max-w-[calc(100vw-3rem)]">
            
            <div class="rounded-xl border border-success-500 bg-success-50 shadow-lg dark:border-success-500/30 dark:bg-success-500/15">
                <div class="p-4">
                    <div class="flex items-start gap-3">
                        <div class="-mt-0.5 text-success-500">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.70186 12.0001C3.70186 7.41711 7.41711 3.70186 12.0001 3.70186C16.5831 3.70186 20.2984 7.41711 20.2984 12.0001C20.2984 16.5831 16.5831 20.2984 12.0001 20.2984C7.41711 20.2984 3.70186 16.5831 3.70186 12.0001ZM12.0001 1.90186C6.423 1.90186 1.90186 6.423 1.90186 12.0001C1.90186 17.5772 6.423 22.0984 12.0001 22.0984C17.5772 22.0984 22.0984 17.5772 22.0984 12.0001C22.0984 6.423 17.5772 1.90186 12.0001 1.90186ZM15.6197 10.7395C15.9712 10.388 15.9712 9.81819 15.6197 9.46672C15.2683 9.11525 14.6984 9.11525 14.347 9.46672L11.1894 12.6243L9.6533 11.0883C9.30183 10.7368 8.73198 10.7368 8.38051 11.0883C8.02904 11.4397 8.02904 12.0096 8.38051 12.3611L10.553 14.5335C10.7217 14.7023 10.9507 14.7971 11.1894 14.7971C11.428 14.7971 11.657 14.7023 11.8257 14.5335L15.6197 10.7395Z"
                                fill="" />
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">
                                Success!
                            </h4>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Tipe Kamar berhasil ditambahkan.
                            </p>
                        </div>

                        <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="h-1 w-full overflow-hidden rounded-b-xl bg-success-200 dark:bg-success-500/20">
                    <div class="h-full bg-success-500 transition-all duration-[50ms] ease-linear" 
                         :style="`width: ${progress}%`"></div>
                </div>
            </div>
        </div>';
        }
    }
}
?>

<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: `<?= $msg != '' ? 'Edit' : 'Tambah' ?> Room Type`}">
            <?php require_once '../template/partials/breadcrumb.php'; ?>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <form action="" method="post">
                <div class="flex justify-between items-center px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-white/90">
                        <?= $msg != '' ? 'Edit' : 'Input' ?> Data
                    </h3>

                    <div class="flex gap-2">
                        <button type="reset" name="reset"
                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-error-500 shadow-theme-xs hover:bg-error-600">
                            Reset
                        </button>
                        <button type="submit" name="simpan"
                            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                            Save
                        </button>
                    </div>

                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">


                    <input type="text" name="id" value="<?= $msg != '' ? $roomType['id'] : null ?>" hidden />

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Name<span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="name" value="<?= $msg != '' ? $roomType['name'] : null ?>"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description<span class="text-error-500">*</span>
                        </label>
                        <textarea name="description" placeholder="Enter Description..." type="text" rows="6"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"><?= $msg != '' ? $roomType['description'] : null ?></textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Price<span class="text-error-500">*</span>
                        </label>
                        <input name="price" type="text" oninput="validateNumericInput(this)"
                            value="<?= $msg != '' ? $roomType['price'] : null ?>"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                </div>
            </form>
        </div>

    </div>
</main>

<!-- Toast Container -->
<?php
if ($alert != '') {
    echo $alert;
}
?>

<?php include_once '../template/footer.php'; ?>