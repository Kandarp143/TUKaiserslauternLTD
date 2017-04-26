/**
 * Created by Kandarp on 4/24/2017.
 */
//for select
$(document).ready(function () {

    $("#reload").click(function () {
        table.state.clear();
        window.location.reload();
    });

    // Setup - add a text input to each footer cell
    $('#listmol tfoot th').each(function () {

        var title = $(this).text();
        if (title != '') {
            $(this).html('<input type="text" size="1" />');
        }
    });

    // DataTable
    $('#listmol').DataTable({
        stateSave: true
    });
    var table = $('#listmol').DataTable();
    $('#listmol tfoot tr').appendTo('#listmol thead');

    // Apply the search
    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });


    table.columns([4, 5, 6]).every(function () {
        var column = this;
        var select = $('<select><option value=""></option></select>')
            .appendTo($(column.footer()).empty())
            .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );

                column
                    .search(val ? '^' + val + '$' : '', true, false)
                    .draw();
            });
        column.data().unique().sort().each(function (d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
        });

    });
});