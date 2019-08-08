$(function() {
    $('#contactsus-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/data/contactsus',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'subject', name: 'subject' },
            { data: 'created_at', name: 'created_at' },
        ]
    });
});

// $("#articles-table").on("click", ".deleteButton", function () {
//     var is_confirmed = confirm(`Are you sure you want to delete this article?`);
//     if (is_confirmed === true) {
//         alert($(this).data("id"));
//     }
// });
