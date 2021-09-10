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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- ====================================================================== -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.2/datatables.min.css" />
    <!-- ====================================================================== -->
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
            <div class="col-md-6">
                <?php

                    if (isset($_SESSION['uname']))
                    {
                ?>
                    <button name="submit" class="btn btn-danger m-1 float-md-end"><a href='welcome.php'>Retour</a></button>
                <?php 
                    }
                    else {
                        echo "<script>location.href='login.php'</script>";
                    }
                ?>
                <button type="button" class="btn btn-primary m-1 float-md-end" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fas fa-shopping-cart" aria-hidden="true"></i>&nbsp;&nbsp;Ajouter Produits</button>
                <a href="action.php?export=excel" class="btn btn-success m-1 float-md-end"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Exporter vers Excel</a>
            </div>
        </div>

        <hr class="my-1">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" id="showProducts">
                    <h3 class="text-center text-success" style="margin-top: 150px;"> Chargement... </h3>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
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


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.2/datatables.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            showAllProducts();

            function showAllProducts() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $("#showProducts").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }

            // InsertData ajax request
            $("#insert").click(function(e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();

                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(response) {
                            Swal.fire(
                                'Bravo  !',
                                'Votre produit à bien été ajouté !',
                                'success'
                            )

                            $("#AddModal").modal('hide');
                            $("#form-data")[0].reset();

                            showAllProducts();
                        }
                    });
                }
            });

            // Edit Data
            $("body").on("click", ".editBtn", function(e) {
                e.preventDefault();

                edit_id = $(this).attr('id');

                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function(response) {
                        data = JSON.parse(response);

                        $("#id").val(data.id);
                        $("#product").val(data.name_product);
                        $("#description").val(data.description_product);
                        $("#price").val(data.price_product);
                    }
                });
            });

            // UpdateData ajax request
            $("#update").click(function(e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();

                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function(response) {
                            Swal.fire(
                                'Bravo !',
                                'Votre produit à bien été modifier !',
                                'success'
                            )

                            $("#EditModal").modal('hide');
                            $("#edit-form-data")[0].reset();

                            showAllProducts();
                        }
                    });
                }
            });

            // DeleteData ajax request
            $("body").on("click", ".deleteBtn", function(e) {
                e.preventDefault();

                var tr = $(this).closest('tr');
                delete_id = $(this).attr('id');

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Libre à vous",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, suprimer !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: {
                                delete_id: delete_id
                            },
                            success: function(response) {
                                tr.css('background-color', '#ff6666');
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                                showAllProducts();
                            }
                        });
                    }
                });
            });

            // Show Data
            $("body").on("click", ".infoBtn", function(e) {
                e.preventDefault();

                info_id = $(this).attr('id');

                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        info_id: info_id
                    },
                    success: function(response) {
                        data = JSON.parse(response);

                        Swal.fire({
                            title: '<strong>Infos Du Produit : N°(' + data.id + ')</strong>',
                            type: 'info',
                            html: '<b>Nom Du Produit : </b>' + data.name_product + '<br><b>Description Du Produit : </b>' + data.description_product + '</br><b>Prix Du Produit : </b>' + data.price_product,
                            showCancelButton: true,
                        })
                    }
                });
            });
        });
    </script>

</body>

</html>