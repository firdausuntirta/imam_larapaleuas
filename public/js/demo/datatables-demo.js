// Call the dataTables jQuery plugin
$(document).ready(function () {
    $("#dataTable").DataTable({
        ordering: true,
        columnDefs: [{ targets: [6], orderable: false }],
    });
});
