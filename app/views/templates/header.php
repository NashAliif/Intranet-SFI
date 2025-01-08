<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?= PUBLIC_PATH; ?>/css/bootstrap.min.css">
    <!-- Icons -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="<?= PUBLIC_PATH; ?>/icons/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= PUBLIC_PATH; ?>/css/style.css">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-size: 0.9rem;
        }

        body {
            display: grid;
            grid-template-columns: 16%;
            grid-template-rows: 7%;
            grid-template-areas: "sidebar navbar"
                "sidebar content"
                "sidebar footer";
        }

        #sidebar {
            grid-area: sidebar;
        }

        #navbar {
            grid-area: navbar;
        }

        #content {
            grid-area: content;
        }

        #footer {
            grid-area: footer;
        }
    </style>
</head>

<body class="bg-white">