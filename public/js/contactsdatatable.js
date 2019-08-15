$(function() {
    $('#contactsus-table').DataTable({
        processing: true,
        serverSide: true,
        order : [[0, 'desc']],
        ajax: '/admin/data/contactsus',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'subject', name: 'subject' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', searchable: false, orderable: false },
        ]
    });
});

$("#contactsus-table").on("click", ".deleteButton", function () {
    var is_confirmed = confirm(`Are you sure you want to delete this contact?`);
    if (is_confirmed === true) {
        var id = $(this).data("id");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
            {
                url: "contact/delete/"+id,
                type: 'delete',
                data: {
                    "id": id
                },
                success: function (response)
                {
                    $("#contactsus-table").DataTable().ajax.reload(null, false );
                    toastr.success('You deleted contact.', 'Success Alert', {timeOut: 5000});
                },
                error: function(xhr) {
                    //console.log(xhr);
                    toastr.error('Something goes wrong, please try again after some minutes.', 'Inconceivable!', {timeOut: 5000});
                }
            });
    }
});
