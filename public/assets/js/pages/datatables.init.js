

$(document).ready(function() {
    $("#datatable").DataTable();
    var table = $("#datatable-buttons").DataTable({
        lengthChange: 1,
        buttons: ["copy", "excel", "pdf"]
    });

    table.buttons().container().appendTo("#datatable-buttons_wrapper .dataTables_length");

    // Add delete button
    // $('<button id="delete-selected" class="btn btn-danger ms-2">Delete Selected</button>').appendTo("#datatable-buttons_wrapper .dataTables_length");

    $(".dataTables_length select").addClass("form-select form-select-sm");
    $("#datatable-buttons_length label").addClass("px-2");
    $("#datatable-buttons_length").css({
        "display": "flex",
        "align-items": "center"
    });

    // Show modal on delete button click
    $('#delete-selected').on('click', function(e) {
        e.preventDefault();
        var selectedCount = $('.check-items:checked').length;
        if (selectedCount > 0) {
            $('#deleteConfirmationModal').modal('show');
        } else {
            alert('Please select at least one item to delete.');
        }
    });

    // Confirm deletion
    $('#confirm-delete').on('click', function() {
        var ids = [];
        $('.check-items:checked').each(function() {
            ids.push($(this).val());
        });

        $('input:hidden[name=delete-ids]').val(ids);
        console.log(ids);
        document.forms["delete-form"].submit();
    });
});

$('.check-all').on('click', function() {
    if ($(this).prop('checked') == true) {
        $('.check-items').each(function() {
            $(this).prop('checked', true);
        });
    } else {
        $('.check-items').each(function() {
            $(this).prop('checked', false);
        });
    }
});