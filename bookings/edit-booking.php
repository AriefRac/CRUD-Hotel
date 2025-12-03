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



$booking_id = $_GET['id'];

$sqlEdit = "SELECT * FROM bookings WHERE id = $booking_id";
$booking = getData($sqlEdit)[0];

$status = $booking['status'];

$guest_id = $booking['guest_id'];
$guest = getData("SELECT * FROM guest WHERE id = $guest_id")[0];



if (isset($_POST['update'])) {
    if (updateBooking($_POST)) {
        $_SESSION['success_message'] = 'Data berhasil diupdate.';
        echo "<script>
                document.location.href = 'index.php';
            </script>";
    }
}

?>


<main>
    <div class="max-w-(--breakpoint-2xl) mx-auto p-4 sm:p-6 lg:p-8">
        <div x-data="{ pageName: `Edit Boooking`}">
            <?php require_once '../template/partials/breadcrumb.php'; ?>
        </div>


        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <form method="post">
                <input type="text" name="id" value="<?= $booking['id'] ?>" hidden />
                <div class="flex justify-between items-center px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-xl font-medium text-gray-800 dark:text-white/90">
                        Edit Data
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

                                <input type="text" name="guest_id" value="<?= $guest['id'] ?>" hidden />
                                <input type="text" value="<?= $guest['id'] ?> | <?= $guest['name'] ?>" readonly
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
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
                                        value="<?= $booking['check_in'] ?>"
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
                                        value="<?= $booking['check_out'] ?>"
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
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                            <?= selectStatus1($status) ?>>
                                            Available
                                        </option>
                                        <option value="checked_in"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                            <?= selectStatus2($status) ?>>
                                            Checked In
                                        </option>
                                        <option value="checked_out"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                            <?= selectStatus3($status) ?>>
                                            Checked Out
                                        </option>
                                        <option value="cancelled"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                            <?= selectStatus4($status) ?>>
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
                        <input type="text" name="total_price" readonly id="price" value="<?= $booking['total_price'] ?>"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    </div>

                    <button type="submit" name="update"
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