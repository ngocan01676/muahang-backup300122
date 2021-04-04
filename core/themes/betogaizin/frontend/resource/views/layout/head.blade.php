<html>
<head>
    <title>Demo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/theme/betogaizin/desktop/css/normalize.css">
    <link rel="stylesheet" href="/theme/betogaizin/desktop/css/style.css">
    <style>
        .category-menu-level02 , .category-menu-level03{
            display: none;
        }

        .is-active .category-menu-level02{
            display: block;
        }
        .is-active > .category-menu-level03{
            display: block !important;
        }
    </style>
</head>
<body>
