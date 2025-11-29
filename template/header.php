<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Dashboard'; ?></title>
    
    <!-- TailAdmin CSS -->
    <link href="<?= $main_url ?>asset/tailadmin/build/style.css" rel="stylesheet">
    
    <!-- Alpine.js (required for TailAdmin interactivity) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="dark:bg-boxdark-2 dark:text-bodydark">