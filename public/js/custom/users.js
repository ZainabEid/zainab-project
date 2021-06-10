$(document).ready(function () {

    /* add multi phones functions */

    // added input field for extra phones
    $('body').on('click', '#add-phone', function (e) {
        e.preventDefault();

        var url =  $(this).data('url');

        $.ajax({
            type: "get",
            url: url,
            success: function (extra_phone) {

                $('#all-phones').append(extra_phone);
            }
        });

    });// end of add phone field

    // delete the added input field for the phone
    $('body').on('click', '.cancelPhone', function () {
        $(this).parent('div .extra-phones').remove();
    });// end of cancel phone




    /*   popup form handling   */

    //append the needed form view
    $('#popup-modal').on('show.bs.modal', function (e) {

        var btn = $(e.relatedTarget); // get the clicked button  add or edit

        var url = btn.data('url'); // should be route to create or edit

        $.ajax({
            url: url,
            success: function (view) {

                // append  comming view
                $('.modal-content').empty().append(view);
            }
        });
    });

    // add new_user to UserController@create
    $('body').on('click', '.add-user', function (e) {
        e.preventDefault();

        var url = $('#create-user-form').data('url');

        var form = $('#create-user-form')[0];
        var form_data = new FormData(form);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });

        $.ajax({
            url: url,
            method: 'post',
            processData: false, // when remove it :  Uncaught TypeError: Illegal invocation
            contentType: false, // when remove it : cant see any data "name,mail,phone is required"
            data: form_data,
            success: function (user_row) {

                // console.log(user_row);

                // get the last tr user_index
                var prev_index = Number($('#users-table tr:last .table-index span').text().replace(/./g, ''));
                console.log('prev_index: ' + new_index);



                // append the new user row to the table
                $('#users-table tbody').append(user_row);

                //close the modal if no error
                $('#popup-modal').modal('toggle');
                $('.modal-content').empty();



                // insert the new user index
                var new_index = prev_index + 1;
                console.log('new_index: ' + new_index);
                $('#users-table tr:last  .table-index span').text(new_index + '.');

            },
            error: function (reject) {

                // var error = response.responseJSON.errors;
                // console.log(reject.responseJSON.errors);

                if (reject.status === 422) {
                    var errors = reject.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                        console.log(  key + "_error"+ " : "+ val[0]);
                    });
                }



            }

        });



    }); // end of create user form

    // updated form_data to UserController@update
    $(document).on('click', '.update-record', function (e) {

        e.preventDefault();

        var url = $('#update-user-form').data('url');
        var user_id = $('#update-user-form').data('user-id')

        var form = $('#update-user-form')[0];
        var form_data = new FormData(form);

        // // // Display the key/value pairs
        // for (var pair of form_data.entries()) {

        //     form_data.append(pair[0],pair[1])
        //     .log(pair[0] + ', ' + pair[1]);
        // }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            }
        });
        form_data.append('_method', 'put'); // php does not parse multi part form data unless the request method is POST
        $.ajax({
            url: url,
            type: 'post',
            data: form_data,
            processData: false,
            contentType: false,
            success: function (updated_row) {


                //close the modal
                $('#popup-modal').modal('toggle');
                $('.modal-content').empty();

                console.log(  $("#user" + user_id  ).html())

                  $("#user" + user_id  ).replaceWith(updated_row);


            },
            error: function (reject) {

                if (reject.status === 422) {
                    var errors = reject.responseJSON.errors;
                    $.each(errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                        console.log(  key + "_error"+ " : "+ val[0]);
                    });
                }
            }

        });



    }); // end of create user form

    // close the form and remove all data that were in it
    $('body').on('click', '.cancel', function () {
        if (confirm('Are you sure?')) {
            $('.modal-content').empty();
        }
    });// end of cancel form

    // preview uploaded photo when new photo is uploaded
    $('body').on('change', '#photo-uploader', function () {
        var file = $('#photo-uploader')[0].files[0];
        if (file) {
            $('#uploaded-photo-preview').attr('src', URL.createObjectURL(file));
        }
    });



    /* handling user table buttons - delete */

    // delete user
    $("body").on("submit", '.remove-user-btn', function (e) {
        e.preventDefault();

        var url = $(this).data('url');

        if (confirm('Really delete?')) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                }
            });

            $.ajax({
                type: "delete",
                url: url,
                success: function (result) {
                    $('#user' + result.user_id).remove();
                    // need to update the index
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    });

});// end of document ready

