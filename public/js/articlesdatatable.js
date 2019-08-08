
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
        alert($(this).data("id"));
    }
});

$(document).ready(function(){
    $('.button-left').click(function(){
        $('.sidebar').toggleClass('fliph');
    });
});

