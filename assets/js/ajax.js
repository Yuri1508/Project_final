// All my Ajax Request is here

$(document).ready(function() {

    showAllProducts();

    // show all data in table
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