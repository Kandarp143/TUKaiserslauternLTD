/**
 * Created by Kandarp on 4/24/2017.
 */
/*for saved data retrive*/
var data = null;
$(document).ready(function () {
    /* apply datatable to table */
    var table = $('#listmol').DataTable({
        stateSave: true,
        // "pagingType": "input"
        // "pagingType": "scrolling"
    });

    /*add text input to each footer cell*/
    $('#listmol tfoot th').each(function () {
        var title = $(this).text();
        if (title != '') {
            $(this).html('<input type="text" size="1" />');
        }
    });

    /* append footer to header*/
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
    /*getting filtered data for default state*/
    data = table.rows().data();
    /*getting filtered data for save state*/
    table.on('search.dt', function () {
        //number of filtered rows
        console.log(table.rows().nodes().length);
        //filtered rows data as arrays
        data = table.rows({filter: 'applied'}).data();
        // console.log(JSON.parse(JSON.stringify(d)));
        // console.log(parsed_data.success);
    });
    /* reload button - state refresh*/
    $("#reload").click(function () {
        table.state.clear();
        window.location.reload();
    });


});


function setState() {
    var ids = Array();
    Object.keys(data).forEach(function (key) {
        if (!isNaN(data[key][0])) {
            ids.push(data[key][0]);
        }
    });
    localStorage.setItem("stored_ids", JSON.stringify(ids));
    // alert(ids);
}
