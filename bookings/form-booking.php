<?php

session_start();

if (!isset($_SESSION['ssLoginHotel'])) {
    header('Location: ../auth/login.php');
    exit();
}

require_once '../config/config.php';
require_once '../config/function.php';
require_once '../module/mode-bookings.php';

$title = 'Bookings | Hotel';
include_once '../template/header.php';
include_once '../template/sidebar.php';
include_once '../template/navbar.php';

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $id = $_GET['id'];
    $sqlEdit = "SELECT * FROM bookings WHERE id = $id";
    $roomType = getData($sqlEdit)[0];
} else {
    $msg = '';
}

$alert = '';

if (isset($_POST['simpan'])) {
    if ($msg != '') {
        if (updateBooking($_POST)) {
            $_SESSION['success_message'] = 'Data berhasil diupdate.';
            echo "<script>
                document.location.href = 'index.php';
            </script>";
        }
    } else {
        if (insertBooking($_POST)) {
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
                                Data berhasil ditambahkan.
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
    <div class="max-w-(--breakpoint-2xl) mx-auto p-4 sm:p-6 lg:p-8">
        <div x-data="{ pageName: `<?= $msg != '' ? 'Edit' : 'Tambah' ?> Boooking`}">
            <?php require_once '../template/partials/breadcrumb.php'; ?>
        </div>


        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <form method="post">
                <div class="flex justify-between items-center px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-white/90">
                        <?= $msg != '' ? 'Edit' : 'Input' ?> Data
                    </h3>
                    <button type="reset" name="reset"
                        class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-error-500 shadow-theme-xs hover:bg-error-600">
                        Reset
                    </button>

                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <div class="flex flex-col sm:flex-row gap-5 mb-5 ">

                        <div class="flex-1">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Guest
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="guest_id" required
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" data-price=""
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Pilih Tamu
                                        </option>
                                        <?php
                                        $guests = getData("SELECT * FROM guest");
                                        foreach ($guests as $guest) { ?>
                                            <option value="<?= $msg != '' ? $guest['id'] : null ?>"
                                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                <?= $guest['id'] ?> | <?= $guest['name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Room
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="room_id" required id="roomSelect"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" data-price=""
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Pilih Kamar
                                        </option>
                                        <?php
                                        $rooms = getData("SELECT * FROM rooms WHERE status = 'available'");

                                        foreach ($rooms as $room) {
                                            $type_id = $room['type_id'];
                                            $roomTypes = getData("SELECT * FROM room_types WHERE id = $type_id");
                                            foreach ($roomTypes as $rt) { ?>
                                                <option value="<?= $room['id'] ?>" data-price="<?= $rt['price'] ?>"
                                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    <?= $room['room_number'] ?>
                                                </option>
                                            <?php }
                                        } ?>
                                    </select>
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col sm:flex-row gap-5 mb-5">

                        <div class="flex-1">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Check In
                                </label>

                                <div class="relative">
                                    <input type="date" placeholder="Select date" name="check_in" required
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        onclick="this.showPicker()" />
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                fill="" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Check Out
                                </label>

                                <div class="relative">
                                    <input type="date" placeholder="Select date" name="check_out" required
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        onclick="this.showPicker()" />
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                fill="" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Malam
                                </label>
                                <input type="number" id="nights" name="nights" readonly
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Status
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="status" required
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">

                                        <option value="available"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Available
                                        </option>
                                        <option value="checked_in"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Checked In
                                        </option>
                                        <option value="checked_out"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Checked Out
                                        </option>
                                        <option value="cancelled"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Cancelled
                                        </option>

                                    </select>
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div>
                        <label class="mb-1.5 block text-2xl font-bold text-gray-700 dark:text-gray-400">
                            TOTAL
                        </label>
                        <input type="text" name="total_price" readonly id="price"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>

                    <button type="submit" name="simpan"
                        class="w-full rounded-lg bg-brand-500 py-3 px-5 text-base font-medium text-white hover:bg-brand-600 focus:outline-hidden">
                        Simpan
                    </button>
                </div>


            </form>

        </div>


    </div>
</main>

<script>
    const checkIn = document.querySelector('input[name="check_in"]');
    const checkOut = document.querySelector('input[name="check_out"]');
    const nightsInput = document.getElementById("nights");

    function calculateNights() {
        if (checkIn.value && checkOut.value) {
            const inDate = new Date(checkIn.value);
            const outDate = new Date(checkOut.value);
            const diff = (outDate - inDate) / (1000 * 3600 * 24);
            nightsInput.value = diff > 0 ? diff : 0;
        }
    }

    checkIn.addEventListener("change", calculateNights);
    checkOut.addEventListener("change", calculateNights);

    function calculatePrice() {
        let price = parseFloat(this.selectedOptions[0].getAttribute("data-price"));
        let nights = parseInt(nightsInput.value) || 0;

        let totalPrice = nights * price;
        document.getElementById("price").value = totalPrice;
    }

    document.getElementById("roomSelect").addEventListener("change", calculatePrice);

</script>



<?php include '../template/footer.php'; ?>