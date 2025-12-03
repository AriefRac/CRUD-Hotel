<?php

session_start();

if (!isset($_SESSION['ssLoginHotel'])) {
  header('Location: auth/login.php');
  exit();
}

require_once 'config/config.php';
require_once 'config/function.php';

$title = 'Dashboard | Hotel';
include_once 'template/header.php';
include_once 'template/sidebar.php';
include_once 'template/navbar.php';

// count data

?>
<!-- ===== Main Content Start ===== -->
<main>
  <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
    <div class="grid grid-cols-12 gap-4 md:gap-6">
      <div class="col-span-12 space-y-6">
        <!-- Metric Group One -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
          <!-- Metric Item Start -->
          <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
              <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                  fill="" />
              </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
              <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Bookings</span>
                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                  <?php
                  $bookings = mysqli_query($koneksi, "SELECT * FROM bookings");
                  $bk = mysqli_num_rows($bookings);
                  echo $bk;
                  ?>
                </h4>
              </div>
            </div>
          </div>
          <!-- Metric Item End -->

          <!-- Metric Item Start -->
          <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
              <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                  fill="" />
              </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
              <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Guest</span>
                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                  <?php
                  $guest = mysqli_query($koneksi, "SELECT * FROM guest");
                  $gt = mysqli_num_rows($guest);
                  echo $gt;
                  ?>
                </h4>
              </div>


            </div>
          </div>
          <!-- Metric Item End -->
          <!-- Metric Item Start -->
          <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
              <!-- Rooms Icon -->
              <!-- Rooms Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                class="text-gray-800 dark:text-white/90">
                <path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8" />
                <path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4" />
                <path d="M12 4v6" />
                <path d="M2 18h20" />
              </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
              <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Rooms</span>
                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                  <?php
                  $rooms = mysqli_query($koneksi, "SELECT * FROM rooms");
                  $rm = mysqli_num_rows($rooms);
                  echo $rm;
                  ?>
                </h4>
              </div>
            </div>

          </div>
          <!-- Metric Item End -->

          <!-- Metric Item Start -->
          <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
              <!-- Rooms Icon -->
              <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" clip-rule="evenodd" 
    d="M4 5.75C4 5.33579 4.33579 5 4.75 5H19.25C19.6642 5 20 5.33579 20 5.75C20 6.16421 19.6642 6.5 19.25 6.5H4.75C4.33579 6.5 4 6.16421 4 5.75ZM4 11.75C4 11.3358 4.33579 11 4.75 11H19.25C19.6642 11 20 11.3358 20 11.75C20 12.1642 19.6642 12.5 19.25 12.5H4.75C4.33579 12.5 4 12.1642 4 11.75ZM4 17.75C4 17.3358 4.33579 17 4.75 17H19.25C19.6642 17 20 17.3358 20 17.75C20 18.1642 19.6642 18.5 19.25 18.5H4.75C4.33579 18.5 4 18.1642 4 17.75Z" 
    fill="" />
</svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
              <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Room Types</span>
                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                  <?php
                  $roomTypes = mysqli_query($koneksi, "SELECT * FROM room_types");
                  $rt = mysqli_num_rows($roomTypes);
                  echo $rt;
                  ?>
                </h4>
              </div>
            </div>
          </div>
          <!-- Metric Item End -->

        </div>
        <!-- Metric Group One -->
      </div>
    </div>
  </div>
</main>
<!-- ===== Main Content End ===== -->


<?php include 'template/footer.php'; ?>