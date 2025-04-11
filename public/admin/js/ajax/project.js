function showdetail(id){
    $('#phase_id').val(id);
    $('#projectassign').hide();
    $('#members').html('Please wait.....');

    $.ajax({
        method: 'POST',
        url: window.origin + '/admin/projects/members',
        data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
        },
        success: function (res) {
            if(res.code ==200){
                    $('#members').html(res.members);
                    $('#uploadtasksubmitss').html(res.members);
                
            }
        },
        error: function (xhr, status, error) {
            console.error('Error: ' + error);  // Handle AJAX errors
            alert('An error occurred while processing the request.');
        }
    });
}

function submitForm(formData) {
    let location = window.location.href;

    if ($('#pagename').val() === 'next') {
        location = window.location.origin + '/admin/leads/edit/' + $('#next').val();
    }
    $('#uploadtasksubmits').html('Please wait.....').attr('disabled', true);


    $('#changetext').html('Please wait ....').attr('disabled', true);
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');
    $('.hidesection').addClass('hidesection');
    $('.pagination').css('display', 'none');

    $.ajax({
        method: 'POST',
        url: formData.attr('action'),
        data: new FormData(formData[0]),
        processData: false,
        contentType: false,
        success: function (res) {

            $('#changetext').html('Submit').attr('disabled', false);
            $('#uploadtasksubmits').html('Submit').attr('disabled', false);
            if (res.code == 200) {
                $('#success').html(res.message);
                toastr.options.timeOut = 10000;
                toastr.success(res.message);
                // showsuccess(res.message);
                setTimeout(() => {
                    window.location.href = location;

                }, 1000);
            } else {

                $('#uploadtasksubmits').html('Submit').attr('disabled', false);

                if (res.code == 215) {
                    $('#appendleads').html(res.data);
                    $('#totalcount').addClass('col-md-4 alert alert-info');
                    $('#totalcount').html(`Total: ${res.totalcount} leads`);
                } else {
                    if (res.code == 216) {
                        $('#appendleads').html(res.data);
                        $('#totalcount').addClass('col-md-4 alert alert-info');
                        $('#totalcount').html(`Total Sales:  ₹ ${res.totalcount} `);
                    } else {
                        $('#password-error').html(res.message);
                        $('.error-message').addClass('text-danger');
                    }

                }

            }
        },
        error: function (xhr, status, error) {
            $('#changetext').html('Submit').attr('disabled', false);
            $('#uploadtasksubmits').html('Submit').attr('disabled', false);

            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    var inputField = $('[name="' + key + '"]');
                    var errorContainer = $('#' + key + '-error');
                    errorContainer.html(value[0]).addClass('text-danger');
                    inputField.addClass('is-invalid');
                });
            } else {
                alert("An error occurred. Please try again later.");
            }
        }
    });
}

// Event listener for form submission
$('#companyadmin, #companyadminedit,#uploadTask').on('submit', function (e) {
    e.preventDefault();
    submitForm($(this));
});