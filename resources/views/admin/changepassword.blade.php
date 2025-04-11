@extends('admin.layout')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<!-- start page title -->
<style>
    .error{
        color:red;
    }
</style>

<!-- end page title -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Change Password</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <form id="addstaff" method="post">
                    @csrf()
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Current Password</label>
                                <input type="text" class="form-control" name="current_password" id="current_password">
                                <span class="error" id="current_password_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">New Password</label>
                                <input type="text" class="form-control" name="new_password" id="new_password">
                                <span class="error" id="new_password_error"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Confirm Password</label>
                                <input type="text" class="form-control" name="confirm_password" id="confirm_password">
                                <span class="error" id="confirm_password_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <span class="error" id="commonerror"></span>
                        <span class="success text-success" id="success"></span>

                            <div class="hstack gap-2 ">
                                <button type="submit" class="btn btn-success">Submit</button>


                            </div>

                        </div>
                    </div>

                </form>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

</div>
<!-- container-fluid -->
</div>
<!-- End Page-content -->


<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1');
</script>

<script>
    //  add modal
    $(document).on('submit', '#addstaff', function(ev) {
        $('.error').html('');

        ev.preventDefault(); // Prevent browers default submit.
        var formData = new FormData(this);
        var error = false;

        if (error == false) {
            $.ajax({
                url: "{{ url('admin/users/update-password') }}",
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".hstackloader").html('<lord-icon src="https://cdn.lordicon.com/dpinvufc.json" trigger="loop" colors="primary:#4bb543,secondary:#4bb543" style="width:50px;"> </lord-icon>');
                    $(".hstack").css('display', 'none');
                    $(".error").text('');
                },
                success: function(result) {
                    $(".hstack").css('display', 'block');

                    if (result.code == 200) {
                        $('#success').html(result.message);
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 1000)
                    } else if (result.code == 401) {
                        $.each(result.message, function(prefix, val) {
                            $('#' + prefix + '_error').text(val[0]);
                        });
                    } else {

                        $('#commonerror').html(result.message);
                    }
                },
                error: function(xhr) {
                    $(".hstack").css('display', 'flex');
                },
                complete: function() {
                    $(".hstack").css('display', 'flex');
                    $(".hstackloader").text('');
                },
            })
        }
    })
</script>

@endsection()