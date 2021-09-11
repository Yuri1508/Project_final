<?php
require_once '../classes/Database.class.php';

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ====================================================================== -->
    <!-- bootstrap framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- ====================================================================== -->
    <!-- DataTables framework -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.2/datatables.min.css" />
    <style>
        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            color: white;
        }
    </style>
    <title>Admin</title>
</head>

<body>

    <!-- My Navbar -->
    <?php require_once '../includes/navbar.php'; ?>

    <div class="container-fluid" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center text-dark font-weight-normal my-3">ADMIN</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4 class="mt-2 text-dark">Produits exposés</h4>
            </div>

            <!-- return button in admin panel -->
            <div class="col-md-6">
                <?php

                if (isset($_SESSION['uname'])) {
                ?>
                    <button name="submit" class="btn btn-danger m-1 float-md-end"><a href='welcome.php'>Retour</a></button>
                <?php
                } else {
                    echo "<script>location.href='login.php'</script>";
                }
                ?>
                <button type="button" class="btn btn-primary m-1 float-md-end" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fas fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Ajouter Produits</button>
                <a href="action.php?export=excel" class="btn btn-success m-1 float-md-end"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Exporter vers Excel</a>
            </div>
        </div>

        <hr class="my-1">

        <!-- Display data table with Ajax -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" id="showProducts">
                    <h3 class="text-center text-success" style="margin-top: 150px;"> Chargement... </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- End Display data table with Ajax -->


    <!-- Add Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModalLabel">Ajouter Un Nouveau Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body mx-4">
                    <form id="form-data" action="" method="POST">

                        <div class="form-group">
                            <label for="product" class="form-label">Nom du produit :</label>
                            <input type="text" class="form-control" name="product" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description du produit :</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Prix du produit :</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" class="btn btn-primary btn-block" value="Ajouter Produit">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Anuler </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End Add Modal -->


    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Modifier Un Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body mx-4">
                    <form id="edit-form-data" action="" method="POST">

                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="product" class="form-label">Nom du produit :</label>
                            <input type="text" class="form-control" id="product" name="product" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description du produit :</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Prix du produit :</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="update" id="update" class="btn btn-primary btn-block" value="Modifier Produit">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Anuler </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End Edit Modal -->


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>

    <!-- bootstrap framework for grid and button -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <!-- font for my button -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- framework for my crud table -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.2/datatables.min.js"></script>

    <!-- sweetAlert for my alert condition -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- displaying data with ajax -->
    <script src="../assets/js/ajax.js"></script>
</body>

</html>