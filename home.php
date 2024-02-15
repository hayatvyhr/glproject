<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>crud dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/styles.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!--google fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <style>
    body,
    html {
        line-height: 1.8;
        font-family: 'Poppins', sans-serif;
        color: #555e58;
        text-transform: capitalize;
        font-weight: 400;
        margin: 0px;
        padding: 0px;
    }

    .custom-scrollbar {
        overflow: auto;
        scrollbar-width: thin;
        scrollbar-color: #4285f4 #f8f9fa;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 12px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #4285f4;
        border-radius: 6px;
        border: 3px solid #f8f9fa;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background-color: #f8f9fa;
        border-radius: 6px;
    }

    .card {
        text-align: center;
        /* Pour centrer horizontalement */
    }

    .graph-container {
        display: inline-block;
        /* Pour centrer horizontalement */
        margin: 0 auto;
        /* Pour centrer horizontalement dans la div parent (table-wrapper) */
    }


    /*==========================================================
  material-icon font-style
  ================================*/
    .graph-container {
        width: 100%;
        max-width: 500px;
        height: 400px;
        margin: 20px auto;
        /* Marge pour l'espacement */
        /* Ajoutez d'autres styles personnalisés pour les courbes statistiques selon vos besoins */
    }

    /* Styles pour les div contenant les nombres de réclamations, demandes et filières */
    .panel {
        margin: 10px;
        padding: 15px;
        text-align: center;
        border-radius: 10px;
        /* Ajoutez d'autres styles personnalisés pour les div des nombres selon vos besoins */
    }

    .panel-heading {
        font-size: 1.2em;
        background-color: #428bca;
        /* Couleur d'arrière-plan du titre */
        color: #fff;
        /* Couleur du texte du titre */
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .panel-body {
        font-size: 1.5em;
    }

    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: url(https://example.com/MaterialIcons-Regular.eot);
        /* For IE6-8 */
        src: local('Material Icons'),
            local('MaterialIcons-Regular'),
            url(https://example.com/MaterialIcons-Regular.woff2) format('woff2'),
            url(https://example.com/MaterialIcons-Regular.woff) format('woff'),
            url(https://example.com/MaterialIcons-Regular.ttf) format('truetype');
    }

    body {
        font-family: 'Arial', sans-serif;
        background: url('images/back.jpg') no-repeat center center fixed;
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        height: 100%;
    }



    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        /* Preferred icon size */
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;

        /* Support for all WebKit browsers. */
        -webkit-font-smoothing: antialiased;
        /* Support for Safari and Chrome. */
        text-rendering: optimizeLegibility;

        /* Support for Firefox. */
        -moz-osx-font-smoothing: grayscale;

        /* Support for IE. */
        font-feature-settings: 'liga';
    }

    /*==========================================================
  material-icon font-style end
  ================================*/

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h3,
    .h4 {
        font-weight: 400;
        line-height: 1.5em;
    }

    p {
        font-size: 15px;
        margin: 12px 0 0;
        line-height: 24px;
    }

    a {
        color: #333;
        font-weight: 400;

    }


    ul,
    ol {
        padding: 0px;
        margin: 0px;
        list-style: none;
    }

    a,
    a:hover,
    a:focus {
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }


    .wrapper {
        position: relative;
        width: 100%;
        overflow: auto;
    }

    /*=========sidebar---design------*/

    #sidebar {
        position: fixed;
        height: 100% !important;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 11;
        width: 260px;
        overflow: auto;
        transition: all 0.3s;
        background-color: #fff;
        box-shadow: 0 0 30px 0 rgba(200 200 200 / 20%);
    }


    @media only screen and (min-width:992px) {
        #sidebar.active {
            left: -260px;
            height: 100% !important;
            position: absolute !important;
            overflow: visible !important;
            top: 0;
            z-index: 666;
            float: left !important;
            bottom: 0 !important;
        }

        #content {
            width: calc(100% - 260px);
            position: relative;
            float: right;
            transition: all 0.3s;
        }

        #content.active {
            width: 100%;
        }

    }

    body::-webkit-scrollbar {
        width: 10px;
    }

    body::-webkit-scrollbar-track {
        background-color: #cfe2f3;
    }

    body::-webkit-scrollbar-thumb {
        background-color: #8c9bb9;
        border-radius: 6px;
    }

    body::-webkit-scrollbar-thumb:hover {
        background-color: #2980b9;
    }


    #sidebar::-webkit-scrollbar {
        width: 5px;
        border-radius: 10px;
        background-color: #eee;
        display: none;
    }

    #sidebar::-webkit-scrollbar-thumbs {
        width: 5px;
        border-radius: 10px;
        background-color: #333;
        display: none;
    }

    #sidebar:hover::-webkit-scrollbar-thumbs {
        display: block;
    }

    #sidebar:hover::-webkit-scrollbar {
        display: block;
    }

    #sidebar .sidebar-header {
        padding: 50px;
        background-color: #fff;
    }

    .sidebar-header h3 {
        color: #333;
        font-size: 17px;
        margin: 0px;
        text-transform: uppercase;
        transition: all 0.5s ease;
        font-weight: 600;
    }

    .sidebar-header h3 img {
        width: 45px;
        margin-right: 10px;
    }

    #sidebar ul li {
        padding: 2px 0px;
    }

    #sidebar ul li.active>a {
        color: #4c7cf3;
        background-color: #DBE5FD;
    }


    #sidebar ul li.active>a i {
        color: #4c7cf3;
    }



    #sidebar ul li a:hover {
        color: #4c7cf3;
        background-color: #DBE5FD;
    }


    .dropdown-toggle::after {
        position: absolute;
        right: 22px;
        top: 18px;
        color: #777777;
    }

    #sidebar ul li.dropdown {
        position: sticky;
    }


    #sidebar ul.component {
        padding: 20px 0px;
    }

    #sidebar ul li a {
        padding: 5px 10px 5px 20px;
        line-height: 30px;
        font-size: 15px;
        position: relative;
        font-weight: 400;
        display: block;
        color: #777777;
        text-transform: capitalize;
    }

    #sidebar ul li a i {
        position: relative;
        margin-right: 10px;
        top: 6px;
    }


    /*=========sidebar---design- end-----*/


    /*========main-content- navbardesign -start-----*/

    #content {
        position: relative;
        transition: all 0.5s;
        background-attachment: #f9fafc;
    }


    .top-navbar {
        width: 100%;
        z-index: 9;
        position: relative;
        padding: 15px 30px;
        background-color: #8aaaef;
    }

    .xd-topbar {
        width: 100%;
        position: relative;
    }

    input[type="search"] {
        background-color: white;
        color: #fff;
        padding-left: 20px;
        border: none;
        border-radius: 50px 0px 0px 50px;
    }

    .input-group-append {
        margin-left: -1px;
    }


    .xp-searchbar .btn {
        background-color: #325ebc;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        border-radius: 0 50px 50px 0;
        padding: 4px 15px;
    }


    .xp-breadcrumbbar .page-title {
        font-size: 20px;
        color: #fff;
        margin-bottom: 0;
        margin-top: 0;
    }

    .breadcrumb {
        display: inline-flex;
        background-color: transparent;
        margin: 0;
        padding: 10px 0 0;
    }

    .breadcrumb .breadcrumb-item a {
        color: #777777;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }


    .breadcrumb-item+.breadcrumb-item {
        padding-left: .5rem;
    }

    .main-content {
        padding: 30px 30px 0px 30px;
    }

    .navbar {
        background-color: #8aaaef;
        color: #fff;
    }

    .navbar-brand {
        color: #fff;
    }

    .navbar button {
        background-color: transparent;
        border: none;
    }

    .navbar button span {
        color: #fff;
    }

    .xp-menubar {
        border-radius: 50%;
        width: 45px;
        height: 45px;
        line-height: 45px;
        text-align: center;
        margin-right: 20px;
        border: none;
        color: #fff;
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0.09);
    }


    .xp-menubar span {
        margin: 9px;
        padding: 0px;
        transform: rotate(90deg);
    }

    .navbar-nav>li.active {
        color: #fff;
        border-radius: 4px;
        background-color: rgba(0, 0, 0, 0.08);
    }

    .navbar-nav>li>a {
        color: #fff;
    }

    .navbar .notification {
        position: absolute;
        top: 2px;
        right: 3px;
        display: block;
        font-size: 9px;
        border: 0;
        background-color: #2bcd72;
        min-width: 15px;
        text-align: center;
        padding: 1px 5px;
        height: 15px;
        border-radius: 2px;
        line-height: 14px;
    }

    @media (max-width:768px) {
        .xp-searchbar {
            margin-top: 20px;
        }
    }

    .navbar-nav>li.show .dropdown-menu {
        transform: translate3d(0, 0, 0);
        opacity: 1;
        display: block;
        visibility: visible;
    }

    .dropdown-menu {
        border: 0;
        box-shadow: 0 2px 5px 0 rgba(0 0 0 / 26%);
        transform: translate3d(0, -20px, 0);
        visibility: hidden;
        position: absolute !important;
        transition: all 150ms linear;
        display: block;
        min-width: 15rem;
        right: 0;
        left: auto;
        opacity: 0;
    }

    .small-menu {
        min-width: 10rem;
    }


    .dropdown-menu li>a {
        font-size: 13px;
        padding: 10px 20px;
        margin: 0 5px;
        border-radius: 2px;
        font-weight: 400;
        transition: all 150ms linear;
    }


    .dropdown-menu li>a .material-icons {
        position: relative;
        top: 3px;
        color: #777;
        margin-right: 6px;
        font-size: 16px;

    }

    .navbar-nav>.active>a:focus {
        color: #fff;
        background-color: rgba(0, 0, 0, 0.08);
    }

    .navbar-nav li a {
        position: relative;
        display: block;
        padding: 4px 10px !important;
    }

    .nav-item .nav-link .material-icons {
        position: relative;
        top: 10px;
        font-size: 19px;
    }

    .xp-user-live {
        position: absolute;
        bottom: 5px;
        right: 9px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #353b48;
        background-color: #4c7cf3;
    }


    .table-wrapper {
        background-color: #fff;
        /* padding: 20px 25px; */
        margin: 6px 0px 40px 0px;
        width: 100%;
        overflow: auto;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    }

    .table-title {
        background: #8aaaef;
        color: #fff;
        position: sticky;
        top: 0;
        width: 100%;
        left: 0;
        padding: 10px 30px;
        border-radius: 0px 0px 0 0;
    }


    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }


    .pagination li.disabled i {
        color: #ccc;

    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px;
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    /*--table design end----*/


    /*-------modal-style start------*/
    .modal .modal-dialog {
        max-width: 400px;
    }

    .modal .modal-header,
    .modal .modal-body,
    .modal .modal-footer {
        padding: 20px 30px;
    }

    .modal .modal-content {
        border-radius: 3px;
    }

    .modal .modal-footer {
        background: #ecf0f1;
        border-radius: 0 0 3px 3px;
    }

    .modal .modal-title {
        display: inline-block;
    }

    .modal .form-control {
        border-radius: 2px;
        box-shadow: none;
        border-color: #dddddd;
    }

    .modal textarea.form-control {
        resize: vertical;
    }

    .modal .btn {
        border-radius: 2px;
        min-width: 100px;
    }

    .modal form label {
        font-weight: normal;
    }



    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    /* Style pour augmenter la largeur de la colonne "Actions" */
    .table .actions-column {
        width: 150px;
        /* Vous pouvez ajuster la largeur selon vos besoins */
    }




    /*-------footer design end------*/



    #sidebar.show-nav,
    .body-overlay.show-nav {
        transform: translatex(0%);
        opacity: 1;
        display: block;
        visibility: visible;
        z-index: 15;
    }




    /*========main-content- navbardesign -end-----*/


    @media only screen and (max-width:992px) {
        #sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            z-index: 10;
            width: 260px;
            transform: translatex(-100%);
            transition: all 150ms linear;
            box-shadow: none !important;
        }

        .body-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            visibility: hidden;
            opacity: 0;
            z-index: 3;
            transition: all 150ms linear;
            background-color: rgba(0, 0, 0, 0.5);
        }
    }



    /* rec_btn  */
    #openFormBtn,
    #button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        width: 115px;
        border-radius: 10px;
    }


    #openFormBtn:hover {
        background-color: #45a049;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        text-align: left;
        width: 90%;
        padding: 8px;
        margin-bottom: 16px;
        box-sizing: border-box;
    }


    /* Modal styles */
    .modal2 {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content2 {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 45%;
        height: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        position: absolute;
        top: 20%;
        left: 60%;
        transform: translate(-50%, -50%);
    }


    /* Close button style */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    </style>

    <div class="wrapper">


        <div class="body-overlay"></div>

        <!-------------------------sidebar------------>
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="images/law.png" class="img-fluid" />
            </div>




            <ul class="list-unstyled components">
                <li class="dropdown">
                    <a href="#demandesEnAttente" class="dashboard"><i class="material-icons">dashboard</i>
                        <span>Demandes en attente</span></a>
                </li>


                <li class="dropdown">
                    <a href="#historiques">
                        <i class="material-icons">apps</i><span>Historiques</span></a>
                </li>

                <li class="dropdown">
                    <a href="#reclamation" onclick="scrollToSection('reclamations')">
                        <i class="material-icons">library_books</i>Réclamations</a>
                </li>

                <li class="">
                    <a href="#statistiques" onclick="scrollToSection('Statistiques')">
                        <i class="material-icons">equalizer</i><span>Statistiques</span></a>

                </li>


            </ul>


        </nav>




        <!--------page-content---------------->

        <div id="content">

            <!--top--navbar----design--------->

            <div class="top-navbar">
                <div class="xp-topbar">

                    <!-- Start XP Row -->
                    <div class="row">
                        <!-- Start XP Col -->
                        <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                            <div class="xp-menubar">
                                <span class="material-icons text-white">signal_cellular_alt
                                </span>
                            </div>
                        </div>
                        <!-- End XP Col -->

                        <!-- Start XP Col -->
                        <div class="col-md-5 col-lg-3 order-3 order-md-2">
                            <div class="xp-searchbar">
                                <form>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                            <div class="xp-profilebar text-right">
                                <nav class="navbar p-0">
                                    <ul class="nav navbar-nav flex-row ml-auto">
                                        <li class="dropdown nav-item active">
                                        </li>
                                        <li class="nav-item">
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="#" data-toggle="dropdown">
                                                <img src="img/user.png" style="width:40px; border-radius:50%;" />
                                                <span class="xp-user-live"></span>
                                            </a>
                                            <ul class="dropdown-menu small-menu">
                                                <li>

                                                    <a href="logout.php"><span class="material-icons">
                                                            logout</span>Logout</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>


                                </nav>

                            </div>
                        </div>
                        <!-- End XP Col -->

                    </div>
                    <!-- End XP Row -->

                </div>


            </div>



            <!--------main-content------------->

            <div class="main-content">
                <div class="row">

                    <div class="col-md-12">
                        <div class="table-wrapper">
                            <div class="table-title" id="demandesEnAttente">
                                <div class="row">
                                    <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                        <h2 class="ml-lg-2" style="font-size :25px;">Demandes en attente</h2>
                                    </div>

                                </div>
                            </div>
                            <br><br>
                            <script>
                            function filterTable(inputId, tableId) {
                                var input, filter, table, tr, td, i, txtValue;
                                input = document.getElementById(inputId);
                                filter = input.value.toUpperCase();
                                table = document.getElementById(tableId);
                                tr = table.getElementsByTagName("tr");

                                for (i = 0; i < tr.length; i++) {
                                    var display = "none";

                                    for (var j = 0; j < tr[i].cells.length; j++) {
                                        td = tr[i].cells[j];
                                        if (td) {
                                            txtValue = td.textContent || td.innerText;
                                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                display = "";
                                                break;
                                            }
                                        }
                                    }

                                    tr[i].style.display = display;
                                }
                            }

                            $(document).ready(function() {
                                $("#searchInput").on("input", function() {
                                    filterTable("searchInput", "dataTable");
                                });
                            });


                            function filterTable2(inputId, tableId) {
                                var input, filter, table, tr, td, i, txtValue;
                                input = document.getElementById(inputId);
                                filter = input.value.toUpperCase();
                                table = document.getElementById(tableId);
                                tr = table.getElementsByTagName("tr");

                                for (i = 0; i < tr.length; i++) {
                                    var display = "none";

                                    for (var j = 0; j < tr[i].cells.length; j++) {
                                        td = tr[i].cells[j];
                                        if (td) {
                                            txtValue = td.textContent || td.innerText;
                                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                display = "";
                                                break;
                                            }
                                        }
                                    }

                                    tr[i].style.display = display;
                                }
                            }

                            $(document).ready(function() {
                                $("#searchInput2").on("input", function() {
                                    filterTable2("searchInput2", "HistoryTable");
                                });
                            });
                            </script>
                            </head>

                            <body style="display: flex; flex-direction:column;gap: 20px;">
                                <div
                                    style="width: 90%;margin: auto;min-height: 250px;color: rgb(112,179,245);;border-radius: 15px;">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 col-xxl-9">
                                            <div class="card shadow">
                                                <div
                                                    class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3">
                                                    <h5 class="display-6 text-nowrap text-capitalize mb-0"
                                                        style="font-family: Poppins, sans-serif;font-size: 16.88px;font-weight: bold;">
                                                        Demandes</h5>
                                                    <div class="input-group input-group-sm w-auto">
                                                        <input id="searchInput" class="form-control form-control-sm"
                                                            type="text" placeholder="Search">
                                                        <button class="btn btn-outline-primary btn-sm" type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                                class="bi bi-search mb-1">
                                                                <path
                                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="dataTable" class="table table-striped table-hover"
                                                            style="">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nom</th>
                                                                    <th>Code Apogee</th>
                                                                    <th>Demande</th>
                                                                    <th>Details</th>
                                                                    <th class="text-center actions-column" ;">Actions
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="border-radius: 9px;">

                                                                <?php
                                                                // Database configuration
                                                                $host = "127.0.0.1";
                                                                $username = "root";
                                                                $database = "gestionetudiants";
                                                                $port = "3306";

                                                                // Create connection
                                                                $conn = new mysqli($host, $username, "", $database, $port);

                                                                // Check connection
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }

                                                                // Separate demands and history based on dateReponse
                                                                $demands = [];
                                                                $history = [];

                                                                // Simulate fetching data from the database
                                                                $sql = "SELECT e.email, D.id, e.nomEtudiant, e.codeapogee, D.typeDemandeID, D.dateReponse, D.details FROM Demande D LEFT JOIN etudiant e ON D.etudiantId = e.id";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        if ($row['dateReponse'] != null) {
                                                                            // Add to history
                                                                            $history[] = $row;
                                                                        } else {
                                                                            // Add to demands
                                                                            $demands[] = $row;
                                                                        }
                                                                    }

                                                                    // Display demands
                                                                    foreach ($demands as $row) {
                                                                        echo "<tr style=\"border-radius: 5px;background: rgba(222,226,230,0.33);\">";
                                                                        echo "<td class=\"text-truncate\" style=\"max-width: 200px;background: #00000000;\">{$row['nomEtudiant']}</td>";
                                                                        echo "<td class=\"text-truncate\" style=\"max-width: 200px;background: rgba(255,255,255,0);\">{$row['codeapogee']}</td>";
                                                                        echo "<td style=\"background: rgba(255,255,255,0);\">{$row['typeDemandeID']}</td>";
                                                                        echo "<td style=\"background: rgba(255,255,255,0);\">{$row['details']}</td>";
                                                                        echo '<td style="background: rgba(255,255,255,0); display:flex;flex-direction:row;justify-content:center">
                                                    <div class="btn-group" role="group">';
                                                                        echo '<form method="post" action="process.php">
                                                        <input type="hidden" name="demand_id" value="' . $row['id'] . '">
                                                        <input type="hidden" name="email" value="' . $row['email'] . '">
                                                        <input type="hidden" name="demandeID" value="' . $row['id'] . '">
                                                        <button class="btn btn-primary btn-success" type="submit" style="width: 150px" name="accept">Accepter</button>
                                                        <button class="btn btn-primary btn-danger" type="submit" style="width: 150px" name="decline">Refuser</button>
                                                        <button class="btn btn-primary btn-block" type="submit" style="width: 150px" name="download">Telecharger</button>
                                                    </form>';
                                                                        echo '</div>
                                                </td>';
                                                                        echo "</tr>";
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='5'>No data found</td></tr>";
                                                                }
                                                                $conn->close();
                                                                ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <nav>
                                                        <ul
                                                            class="pagination pagination-sm mb-0 justify-content-center">
                                                            <li class="page-item"><a class="page-link"
                                                                    aria-label="Previous" href="#"><span
                                                                        aria-hidden="true">«</span></a></li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" aria-label="Next"
                                                                    href="#"><span aria-hidden="true">»</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br><br>

                                <!------------------------------>
                                <div class="table-title" id="historiques">
                                    <div class="row">
                                        <div
                                            class=" col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                            <h2 class="ml-lg-2" style="font-size :25px;">Demandes traités</h2>
                                        </div>

                                    </div>
                                </div>
                                <br><br>
                                <!-------------------------------------->
                                <div
                                    style="width: 90%;margin: auto;min-height: 250px;color: rgb(112,179,245);border-radius: 15px;">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 col-xxl-9">
                                            <div class="card shadow">
                                                <div
                                                    class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3">
                                                    <h5 class="display-6 text-nowrap text-capitalize mb-0"
                                                        style="font-family: Poppins, sans-serif;font-size: 16.88px;font-weight: bold;">
                                                        Historique</h5>
                                                    <div class="input-group input-group-sm w-auto">
                                                        <input id="searchInput2" class="form-control form-control-sm"
                                                            type="text" placeholder="Search">
                                                        <button class="btn btn-outline-primary btn-sm" type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                                class="bi bi-search mb-1">
                                                                <path
                                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="HistoryTable"
                                                            class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nom</th>
                                                                    <th>Code Apogee</th>
                                                                    <th>Demande</th>
                                                                    <th>Date-reponse</th>
                                                                    <th>Details</th>
                                                                    <th class="text-center">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="border-radius: 9px;">

                                                                <?php
                                                                // Database configuration
                                                                $host = "127.0.0.1";
                                                                $username = "root";
                                                                $database = "gestionetudiants";
                                                                $port = "3306";

                                                                // Create connection
                                                                $conn = new mysqli($host, $username, "", $database, $port);

                                                                // Check connection
                                                                if ($conn->connect_error) {
                                                                    die("Connection failed: " . $conn->connect_error);
                                                                }

                                                                // Separate demands and history based on dateReponse
                                                                $demands = [];
                                                                $history = [];

                                                                // Simulate fetching data from the database
                                                                $sql = "SELECT D.id, e.nomEtudiant, e.codeapogee, D.typeDemandeID, D.dateReponse, D.details, D.isValidated FROM Demande D LEFT JOIN etudiant e ON D.etudiantId = e.id";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        if ($row['dateReponse'] != null) {
                                                                            // Add to history
                                                                            $history[] = $row;
                                                                        } else {
                                                                            // Add to demands
                                                                            $demands[] = $row;
                                                                        }
                                                                    }

                                                                    // Display history
                                                                    foreach ($history as $row) {
                                                                        echo "<tr style=\"border-radius: 5px;background: rgba(222,226,230,0.33);\">";
                                                                        echo "<td class=\"text-truncate\" style=\"max-width: 200px;background: #00000000;\">{$row['nomEtudiant']}</td>";
                                                                        echo "<td class=\"text-truncate\" style=\"max-width: 200px;background: rgba(255,255,255,0);\">{$row['codeapogee']}</td>";
                                                                        echo "<td style=\"background: rgba(255,255,255,0);\">{$row['typeDemandeID']}</td>";
                                                                        echo "<td style=\"background: rgba(255,255,255,0);\">{$row['dateReponse']}</td>";
                                                                        echo "<td style=\"background: rgba(255,255,255,0);\">{$row['details']}</td>";
                                                                        echo '<td style="background: rgba(255,255,255,0); display:flex;flex-direction:row;justify-content:center">';
                                                                        if ($row['isValidated'] == 1) {
                                                                            echo '<center><p style="color:green;padding:5px;margin: auto">Demande Acceptée</p></center>';
                                                                        } elseif ($row['isValidated'] == 0) {
                                                                            echo '<center><p style="color:red;padding:5px;margin: auto">Demande Reffusée</p></center>';
                                                                        }
                                                                        echo '<form method="post" action="process.php">
                                                                            <input type="hidden" name="demand_id" value="' . $row['id'] . '">
                                                                            <input type="hidden" name="demandeID" value="' . $row['id'] . '">
                                                                            <button class="btn btn-primary btn-block" type="submit" style="width: 150px" name="download">Telecharger</button>
                                                                        </form>';
                                                                        echo '</td>';
                                                                        echo "</tr>";
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='5'>No data found</td></tr>";
                                                                }
                                                                $conn->close();
                                                                ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <nav>
                                                        <ul
                                                            class="pagination pagination-sm mb-0 justify-content-center">
                                                            <li class="page-item"><a class="page-link"
                                                                    aria-label="Previous" href="#"><span
                                                                        aria-hidden="true">«</span></a></li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" aria-label="Next"
                                                                    href="#"><span aria-hidden="true">»</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal" tabindex="-1"
                                    aria-labelledby="detailsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailsModalLabel">Demande Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p id="detailsContent"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                                <script>
                                // Update the modal content with the details when the modal is shown
                                var detailsModal = document.getElementById('detailsModal');
                                detailsModal.addEventListener('show.bs.modal', function(event) {
                                    var button = event.relatedTarget;
                                    var details = button.getAttribute('data-details');
                                    var detailsContent = detailsModal.querySelector('#detailsContent');
                                    detailsContent.textContent = details;
                                });
                                </script><br><br><br>


                                <!-- reclamation -->


                                <?php
                                $host = "127.0.0.1";
                                $username = "root";
                                $password = "";
                                $database = "gestionetudiants";
                                $port = 3306;
                                $conn = new mysqli($host, $username, $password, $database, $port);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $query = "SELECT r.id, r.demandeID, r.dateSubmission, r.details, e.nomEtudiant, e.email
                        FROM reclamation r
                        JOIN etudiant e ON r.etudiantID = e.id";
                                $result = $conn->query($query);

                                if (!$result) {
                                    die("Error in query: " . $conn->error);
                                }
                                ?>


                                <script>
                                function filterTable3(inputId, tableId) {
                                    var input, filter, table, tr, td, i, txtValue;
                                    input = document.getElementById(inputId);
                                    filter = input.value.toUpperCase();
                                    table = document.getElementById(tableId);
                                    tr = table.getElementsByTagName("tr");

                                    for (i = 0; i < tr.length; i++) {
                                        var display = "none";

                                        for (var j = 0; j < tr[i].cells.length; j++) {
                                            td = tr[i].cells[j];
                                            if (td) {
                                                txtValue = td.textContent || td.innerText;
                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                    display = "";
                                                    break;
                                                }
                                            }
                                        }

                                        tr[i].style.display = display;
                                    }
                                }

                                $(document).ready(function() {
                                    $("#searchInput3").on("input", function() {
                                        filterTable3("searchInput3", "dataTable3");
                                    });
                                });
                                </script>
                                <div class="table-title" id="reclamation">
                                    <div class="row">
                                        <div
                                            class=" col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                            <h2 class="ml-lg-2" style="font-size: 2em;">Reclamation</h2>
                                        </div>

                                    </div>
                                </div>
                                <br><br>
                                <div
                                    style="width: 90%;margin: auto;min-height: 250px;color: rgb(112,179,245);border-radius: 15px;">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-10 col-xxl-9" style="flex: 0 0 auto;width: 100%;">
                                            <div class="card shadow">
                                                <div
                                                    class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3">
                                                    <h5 class="display-6 text-nowrap text-capitalize mb-0"
                                                        style="font-family: Poppins, sans-serif;font-size: 16.88px;font-weight: bold;">
                                                        Reclamation</h5>
                                                    <div class="input-group input-group-sm w-auto">
                                                        <input id="searchInput3" class="form-control form-control-sm"
                                                            type="text" placeholder="Search">
                                                        <button class="btn btn-outline-primary btn-sm" type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                                class="bi bi-search mb-1">
                                                                <path
                                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="dataTable3"
                                                                class="table table-striped table-hover" style=""
                                                                width="90%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Demande ID</th>
                                                                        <th>Date Submission</th>
                                                                        <th>Details</th>
                                                                        <th>Nom Etudiant</th>
                                                                        <th>Email</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody style="border-radius: 9px;">
                                                                    <?php
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<tr>";
                                                                        echo "<td>{$row['demandeID']}</td>";
                                                                        echo "<td>{$row['dateSubmission']}</td>";
                                                                        echo "<td>{$row['details']}</td>";
                                                                        echo "<td>{$row['nomEtudiant']}</td>";
                                                                        echo "<td>{$row['email']}</td>";
                                                                        echo "<td><button id=\"openFormBtn\" onclick=\"openPopup('{$row['email']}')\">E-mail</button></td>";
                                                                        echo "<td><button style=\"background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            background-color : rgb(115,139,182);
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;    border-radius: 10px;
            cursor: pointer;\" onclick=\"generatePDFAndSend('{$row['email']}', '{$row['demandeID']}')\">Réenvoyer</button></td>";

                                                                        echo "</tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>


                                                            <div id="contactForm" class="modal2">

                                                                <!-- Modal content -->
                                                                <div class="modal-content2">
                                                                    <span class="close"
                                                                        onclick="closeForm()">&times;</span>
                                                                    <h2>Rédigez votre message</h2>
                                                                    <form action="send_email.php" method="post">
                                                                        <label for="subject">Subject:</label>
                                                                        <input type="text" id="subject" name="subject"
                                                                            required><br>

                                                                        <label for="message">Message:</label>
                                                                        <textarea id="message" name="message"
                                                                            required></textarea><br>

                                                                        <input type="hidden" id="recipientEmail"
                                                                            name="recipientEmail" value="">
                                                                        <input type="button" id="button" value="Submit"
                                                                            onclick="sendEmail()">
                                                                    </form>

                                                                    <?php
                                                                    if (isset($_GET['email_sent'])) {
                                                                        echo '<p>Email sent successfully!</p>';
                                                                    }
                                                                    ?>
                                                                </div>

                                                            </div>


                                                            <?php
                                                            // Close the database connection
                                                            $conn->close();
                                                            ?>
                                                            <script>
                                                            // Function to open the contact form
                                                            function openPopup(email) {
                                                                document.getElementById('recipientEmail').value = email;
                                                                document.getElementById('contactForm').style.display =
                                                                    'block';
                                                            }

                                                            function closeForm() {
                                                                document.getElementById('contactForm').style.display =
                                                                    'none';
                                                            }

                                                            window.onclick = function(event) {
                                                                var modal = document.getElementById('contactForm');
                                                                if (event.target == modal) {
                                                                    modal.style.display = 'none';
                                                                }
                                                            }
                                                            </script>
                                                            <script>
                                                            function sendEmail() {
                                                                // Get form data
                                                                var subject = document.getElementById('subject').value;
                                                                var message = document.getElementById('message').value;
                                                                var recipientEmail = document.getElementById(
                                                                    'recipientEmail').value;

                                                                // Create an XMLHttpRequest object
                                                                var xhr = new XMLHttpRequest();

                                                                // Specify the POST request details
                                                                xhr.open('POST', 'send_email.php', true);
                                                                xhr.setRequestHeader('Content-type',
                                                                    'application/x-www-form-urlencoded');

                                                                // Define the callback function to handle the response
                                                                xhr.onreadystatechange = function() {
                                                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                                                        // Handle the response, e.g., display a success message
                                                                        var response = xhr.responseText;
                                                                        alert(
                                                                            response
                                                                        ); // You can replace this with your logic
                                                                    }
                                                                };

                                                                // Prepare the data to be sent
                                                                var data = 'subject=' + encodeURIComponent(subject) +
                                                                    '&message=' + encodeURIComponent(message) +
                                                                    '&recipientEmail=' + encodeURIComponent(
                                                                        recipientEmail);

                                                                // Send the request with the form data
                                                                xhr.send(data);
                                                            }




                                                            function generatePDFAndSend(email, demandeID) {
                                                                // Create an XMLHttpRequest object
                                                                var xhr = new XMLHttpRequest();

                                                                // Specify the POST request details
                                                                xhr.open('POST', 'generator_pdf_email.php', true);
                                                                xhr.setRequestHeader('Content-type',
                                                                    'application/x-www-form-urlencoded');

                                                                // Define the callback function to handle the response
                                                                xhr.onreadystatechange = function() {
                                                                    if (xhr.readyState == 4) {
                                                                        if (xhr.status == 200) {
                                                                            var response = xhr.responseText;
                                                                            alert(
                                                                                response
                                                                            ); // You can replace this with your logic
                                                                        } else {
                                                                            alert('Error: ' + xhr.status + ' ' + xhr
                                                                                .statusText);
                                                                        }
                                                                    }
                                                                };

                                                                xhr.onerror = function() {
                                                                    alert('Network error occurred.');
                                                                };

                                                                // Prepare the data to be sent
                                                                var data = 'email=' + encodeURIComponent(email) +
                                                                    '&demandeID=' + encodeURIComponent(demandeID);

                                                                // Send the request with the email data
                                                                xhr.send(data);
                                                            }
                                                            </script>



                                                        </div>
                                                        <div class="card-footer">
                                                            <nav>
                                                                <ul
                                                                    class="pagination pagination-sm mb-0 justify-content-center">
                                                                    <li class="page-item"><a class="page-link"
                                                                            aria-label="Previous" href="#"><span
                                                                                aria-hidden="true">«</span></a></li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="#">1</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="#">2</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="#">3</a>
                                                                    </li>
                                                                    <li class="page-item"><a class="page-link"
                                                                            aria-label="Next" href="#"><span
                                                                                aria-hidden="true">»</span></a></li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>

                                            <!-- fin reclamation -->





                                            <!-- fin reclamation  -->












                                            <br><br><br>
                                            <div class="table-title" id="statistiques">
                                                <div class="row">
                                                    <div
                                                        class=" col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                                        <h2 class="ml-lg-2" style="font-size :25px;">
                                                            Statistiques</h2>

                                                    </div>

                                                </div>

                                            </div>

                                            <?php include "database.php";


                                            // Get counts from the database

                                            $reclamationCountQuery = "SELECT COUNT(*) AS totalReclamations FROM reclamation";
                                            $demandeCountQuery = "SELECT COUNT(*) AS totalDemandes FROM demande";
                                            $filierCountQuery = "SELECT COUNT(DISTINCT filiere) AS totalFilieres FROM etudiant";

                                            $reclamationCountResult = mysqli_query($conn, $reclamationCountQuery);
                                            $demandeCountResult = mysqli_query($conn, $demandeCountQuery);
                                            $filierCountResult = mysqli_query($conn, $filierCountQuery);

                                            $totalReclamations = mysqli_fetch_assoc($reclamationCountResult)['totalReclamations'];
                                            $totalDemandes = mysqli_fetch_assoc($demandeCountResult)['totalDemandes'];
                                            $totalFilieres = mysqli_fetch_assoc($filierCountResult)['totalFilieres'];

                                            ?>





                                            <html>
                                            <link rel="stylesheet" href="style.css">

                                            <head>
                                                <script type="text/javascript"
                                                    src="https://www.gstatic.com/charts/loader.js">
                                                </script>
                                                <script type="text/javascript">
                                                google.charts.load('current', {
                                                    'packages': ['bar']
                                                });
                                                google.charts.setOnLoadCallback(drawChart);

                                                function drawChart() {
                                                    // Function 1: Bar Chart for Number of Students by Filiere
                                                    var data1 = google.visualization.arrayToDataTable([
                                                        ['Filiere', 'Nombre Etudiants'],
                                                        <?php
                                                            include "database.php"; // Make sure the database connection is established

                                                            $reclamationQuery = "SELECT filiere, COUNT(*) AS etudiants FROM etudiant GROUP BY filiere";
                                                            $etdquert = mysqli_query($conn, $reclamationQuery);

                                                            while ($etudiant = mysqli_fetch_array($etdquert)) {
                                                            ?>['<?php echo $etudiant['filiere']; ?>',
                                                            <?php echo $etudiant['etudiants']; ?>],
                                                        <?php
                                                            }
                                                            ?>
                                                    ]);

                                                    var options1 = {
                                                        chart: {
                                                            title: 'STATISTIQUE',
                                                            subtitle: 'Nombre des etudiants par Filiere',
                                                        },
                                                        titleTextStyle: {
                                                            color: '#4285f4', // Couleur du titre
                                                            fontSize: 20, // Taille du titre
                                                            bold: true // Gras ou non
                                                        },
                                                        subtitleTextStyle: {
                                                            color: 'grey', // Couleur du sous-titre
                                                            fontSize: 16 // Taille du sous-titre
                                                        },
                                                        hAxis: {
                                                            title: 'Filiere',
                                                            titleTextStyle: {
                                                                color: '#4285f4', // Couleur du titre de l'axe horizontal (Filiere)
                                                                fontSize: 18 // Taille du titre de l'axe horizontal
                                                            }
                                                        },
                                                        vAxis: {
                                                            title: 'Nombre Etudiants',
                                                            titleTextStyle: {
                                                                color: 'grey', // Couleur du titre de l'axe vertical (Nombre Etudiants)
                                                                fontSize: 18 // Taille du titre de l'axe vertical
                                                            }
                                                        },
                                                        bars: 'vertical' // Required for Material Bar Charts.
                                                    };

                                                    var chart1 = new google.charts.Bar(document.getElementById(
                                                        'barchart_material1'));
                                                    chart1.draw(data1, google.charts.Bar.convertOptions(
                                                        options1));

                                                    // Function 2: Bar Chart for Reclamation and Demand by Date
                                                    var data2 = google.visualization.arrayToDataTable([
                                                        ['dateSubmission', 'Réclamation', 'demande'],

                                                        <?php
                                                            $reclamationQuery = "SELECT DATE(dateSubmission) AS date, ROUND(COUNT(*)) AS reclamations FROM reclamation GROUP BY DATE(dateSubmission)";
                                                            $demandeQuery = "SELECT DATE(dateSubmission) AS date, ROUND(COUNT(*)) AS demandes FROM demande GROUP BY DATE(dateSubmission)";

                                                            $reclamationRes = mysqli_query($conn, $reclamationQuery);
                                                            $demandeRes = mysqli_query($conn, $demandeQuery);

                                                            $reclamationData = [];
                                                            while ($reclamation = mysqli_fetch_array($reclamationRes)) {
                                                                $reclamationData[$reclamation['date']] = $reclamation['reclamations'];
                                                            }

                                                            $demandeData = [];
                                                            while ($demande = mysqli_fetch_array($demandeRes)) {
                                                                $demandeData[$demande['date']] = $demande['demandes'];
                                                            }

                                                            $dates = array_unique(array_merge(array_keys($reclamationData), array_keys($demandeData)));

                                                            foreach ($dates as $date) {
                                                            ?>['<?php echo $date; ?>',
                                                            <?php echo $reclamationData[$date] ?? 0; ?>,
                                                            <?php echo $demandeData[$date] ?? 0; ?>],
                                                        <?php
                                                            }
                                                            ?>
                                                    ]);

                                                    var options2 = {
                                                        chart: {
                                                            title: 'STATISTIQUE',
                                                            subtitle: 'Réclamation et demande par date',
                                                        },
                                                        titleTextStyle: {
                                                            color: '#4285f4', // Couleur du titre
                                                            fontSize: 20, // Taille du titre
                                                            bold: true // Gras ou non
                                                        },
                                                        subtitleTextStyle: {
                                                            color: 'grey', // Couleur du sous-titre
                                                            fontSize: 16 // Taille du sous-titre
                                                        },
                                                        hAxis: {
                                                            title: 'DateSubmission',
                                                            titleTextStyle: {
                                                                color: '#4285f4', // Couleur du titre de l'axe horizontal (Filiere)
                                                                fontSize: 18 // Taille du titre de l'axe horizontal
                                                            }
                                                        },
                                                        bars: 'vertical' // Required for Material Bar Charts.
                                                    };

                                                    var chart2 = new google.charts.Bar(document.getElementById(
                                                        'barchart_material2'));
                                                    chart2.draw(data2, google.charts.Bar.convertOptions(
                                                        options2));
                                                }
                                                </script>
                                            </head>

                                            <body>
                                                <div class="parent" style="background-color:white;">


                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-6">
                                                            <div class="panel panel-default font-med">
                                                                <div class="panel-heading text-muted  text-nowrap">
                                                                    Reclamation</div>
                                                                <div class="panel-body">
                                                                    <?php echo $totalReclamations; ?></div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6">
                                                            <div class="panel panel-default font-med">
                                                                <div class="panel-heading text-muted  text-nowrap">
                                                                    Demande</div>

                                                                <div class="panel-body">
                                                                    <?php echo $totalDemandes; ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6">
                                                            <div class="panel panel-default font-med">
                                                                <div class="panel-heading text-muted  text-nowrap">
                                                                    Filiere</div>

                                                                <div class="panel-body">
                                                                    <?php echo $totalFilieres; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card d-flex justify-content-center" style=" border:none;">
                                                    <div class="d-flex justify-content-center">

                                                        <div class=" div7 graph-container col-md-6 custom-scrollbar "
                                                            id="barchart_material1"
                                                            style=" width: 100%;width: 500px;height: 400px; overflow: auto;">
                                                            <?php include "database.php"; ?></div>
                                                        <div class="div8 graph-container col-md-6 custom-scrollbar"
                                                            id="barchart_material2"
                                                            style=" width:100%;width: 500px; height: 400px; overflow: auto;">
                                                            <?php include "database.php"; ?></div>

                                                    </div>
                                                </div>
                                            </body>

                                            </html>

                                        </div>


                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Details Modal -->
                    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel">Demande Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id="detailsContent"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                    <script>
                    // Update the modal content with the details when the modal is shown
                    var detailsModal = document.getElementById('detailsModal');
                    detailsModal.addEventListener('show.bs.modal', function(event) {
                        var button = event.relatedTarget;
                        var details = button.getAttribute('data-details');
                        var detailsContent = detailsModal.querySelector('#detailsContent');
                        detailsContent.textContent = details;
                    });
                    </script>
</body>

</html>
</div>
</div>


</div>

</div>
</div>
</body>

</html>
</div>

</div>


<!----------html code compleate----------->









<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    $(".xp-menubar").on('click', function() {
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
    });

    $(".xp-menubar,.body-overlay").on('click', function() {
        $('#sidebar,.body-overlay').toggleClass('show-nav');
    });

});
</script>





</body>

</html>