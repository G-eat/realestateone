$(function() {
    $('#articles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/data/articles',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'city', name: 'city' },
            { data: 'address', name: 'address' },
            { data: 'type', name: 'type' },
            { data: 'phonenumber', name: 'phonenumber' },
            { data: 'action', name: 'action', searchable: false, orderable: false },
        ]
    });
});

$("#articles-table").on("click", ".deleteButton", function () {
    var is_confirmed = confirm(`Are you sure you want to delete this article?`);
    if (is_confirmed === true) {
        var id = $(this).data("id");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
            {
                url: "article/delete/"+id,
                type: 'delete',
                data: {
                    "id": id
                },
                success: function (response)
                {
                    $("#articles-table").DataTable().ajax.reload(null, false );
                    toastr.success('You deleted article.', 'Success Alert', {timeOut: 5000});
                },
                error: function(xhr) {
                    //console.log(xhr);
                    toastr.error('Something goes wrong, please try again after some minutes.', 'Inconceivable!', {timeOut: 5000});
                }
            });
    }
});

