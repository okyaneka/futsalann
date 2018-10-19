$(window).bind("load", function() {
    $('#field-table').DataTable({ sort:false });

    $('#facility-table').DataTable({ sort:false });

    CKEDITOR.replace('field-description');
});