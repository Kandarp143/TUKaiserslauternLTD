// magic.js
$(document).ready(function () {
    // process the form
    $('#msform').submit(function (event) {
        //prepareing data
        var data = new FormData($("#msform"));
        alert(data);
        // process the form
        $.ajax({
            type: $('#msform').attr('method'), // define the type of HTTP verb we want to use (POST for our form)
            url: $('#msform').attr('action'), // the url where we want to POST
            data: data, // our data object
            // contentType: "application/json",//note the contentType defintion
            // dataType: "json",
            // encode: true
        })
        // using the done promise callback
            .done(function (data) {
                // log data to the console so we can see
                console.log(data);

                // here we will handle errors and validation messages
                alert(data);
                if (!data.success) {
                    alert('not done');
                } else {

                    alert('done');
                }
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});