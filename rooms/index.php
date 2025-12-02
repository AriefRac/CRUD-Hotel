<?php

session_start();

if (!isset($_SESSION['ssLoginHotel'])) {
    header('Location: ../auth/login.php');
    exit();
}

require_once '../config/config.php';
require_once '../config/function.php';
require_once '../module/mode-rooms.php';

$title = "Data Room | Hotel";
include_once '../template/header.php';
include_once '../template/sidebar.php';
include_once '../template/navbar.php';

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
} else {
    $msg = '';    
}

$alert = '';

if ($msg == 'deleted') {
    $id = $_GET['id'];
    deleteRoom($id);
}


if (isset($_SESSION['success_message'])) {
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
                            ' . htmlspecialchars($_SESSION['success_message']) . '
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
    
    unset($_SESSION['success_message']);
}

?>


<main>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: `Data Rooms`}">
            <?php require_once '../template/partials/breadcrumb.php'; ?>
        </div>

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <a href="form-rooms.php"
                        class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        + Add Room
                    </a>
                </div>

                <!-- Table Start -->
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">
                            <table class="min-w-full">
                                <!-- Table Head -->
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Room Number
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Type Room
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Status
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Action
                                                </p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <!-- Table Body -->
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    <?php
                                        $data = getData("SELECT * FROM rooms");

                                        foreach ($data as $d) : ?>
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <div>
                                                        <span
                                                            class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                            <?= $d['room_number'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <div>
                                                        <span
                                                            class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                            <?php
                                                                $typeId = $d['type_id'];
                                                                $roomType = getData("SELECT * FROM room_types WHERE id = $typeId")[0];
                                                            ?>
                                                            <?= $roomType['name'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <div>
                                                        <?php
                                                            $status = $d['status'];
                                                            if($status === 'available') {
                                                                
                                                            }
                                                        ?>
                                                        <span
                                                            class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                            <?= $status ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center gap-5">
                                                <a href="form-rooms.php?id=<?= $d['id']?>&msg=editing"
                                                    class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-warning-500 shadow-theme-xs hover:bg-warning-600">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M9.77692 3.24224C9.91768 3.17186 10.0834 3.17186 10.2241 3.24224L15.3713 5.81573L10.3359 8.33331C10.1248 8.43888 9.87626 8.43888 9.66512 8.33331L4.6298 5.81573L9.77692 3.24224ZM3.70264 7.0292V13.4124C3.70264 13.6018 3.80964 13.775 3.97903 13.8597L9.25016 16.4952L9.25016 9.7837C9.16327 9.75296 9.07782 9.71671 8.99432 9.67496L3.70264 7.0292ZM10.7502 16.4955V9.78396C10.8373 9.75316 10.923 9.71683 11.0067 9.67496L16.2984 7.0292V13.4124C16.2984 13.6018 16.1914 13.775 16.022 13.8597L10.7502 16.4955ZM9.41463 17.4831L9.10612 18.1002C9.66916 18.3817 10.3319 18.3817 10.8949 18.1002L16.6928 15.2013C17.3704 14.8625 17.7984 14.17 17.7984 13.4124V6.58831C17.7984 5.83076 17.3704 5.13823 16.6928 4.79945L10.8949 1.90059C10.3319 1.61908 9.66916 1.61907 9.10612 1.90059L9.44152 2.57141L9.10612 1.90059L3.30823 4.79945C2.63065 5.13823 2.20264 5.83076 2.20264 6.58831V13.4124C2.20264 14.17 2.63065 14.8625 3.30823 15.2013L9.10612 18.1002L9.41463 17.4831Z"
                                                            fill="" />
                                                    </svg>
                                                    Edit
                                                </a >
                                                <a href="?id=<?= $d['id']?>&msg=deleted" onclick="return confirm('Anda yakin ingin menghapus Barang ini?')" title="delete barang"
                                                    class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-error-500 shadow-theme-xs hover:bg-error-600">
                                                    <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M9.77692 3.24224C9.91768 3.17186 10.0834 3.17186 10.2241 3.24224L15.3713 5.81573L10.3359 8.33331C10.1248 8.43888 9.87626 8.43888 9.66512 8.33331L4.6298 5.81573L9.77692 3.24224ZM3.70264 7.0292V13.4124C3.70264 13.6018 3.80964 13.775 3.97903 13.8597L9.25016 16.4952L9.25016 9.7837C9.16327 9.75296 9.07782 9.71671 8.99432 9.67496L3.70264 7.0292ZM10.7502 16.4955V9.78396C10.8373 9.75316 10.923 9.71683 11.0067 9.67496L16.2984 7.0292V13.4124C16.2984 13.6018 16.1914 13.775 16.022 13.8597L10.7502 16.4955ZM9.41463 17.4831L9.10612 18.1002C9.66916 18.3817 10.3319 18.3817 10.8949 18.1002L16.6928 15.2013C17.3704 14.8625 17.7984 14.17 17.7984 13.4124V6.58831C17.7984 5.83076 17.3704 5.13823 16.6928 4.79945L10.8949 1.90059C10.3319 1.61908 9.66916 1.61907 9.10612 1.90059L9.44152 2.57141L9.10612 1.90059L3.30823 4.79945C2.63065 5.13823 2.20264 5.83076 2.20264 6.58831V13.4124C2.20264 14.17 2.63065 14.8625 3.30823 15.2013L9.10612 18.1002L9.41463 17.4831Z"
                                                            fill="" />
                                                    </svg>
                                                    Delete
                                                </a >
                                            </div>
                                        </td>

                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php echo $alert; ?>
</main>

<?php

require_once '../template/footer.php';

?>