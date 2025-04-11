@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }

    input {
        width: 75% !important;
    }

    select {
        width: 75% !important;
    }

    textarea {
        width: 75% !important;
    }
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add New Lead</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('leads.store')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">

                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">
                                                Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter  Name" id="firstNameinput">
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>

                                    <!--end col-->

                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Phone
                                                Number</label>
                                            <input type="tel" class="form-control onlyNumeric" name="phone" placeholder="Enter mobile number" id="phonenumberInput" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <div class="error-message" id="phone-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" name="email" placeholder="example@gmail.com" id="emailidInput">
                                            <div class="error-message" id="email-error"></div>

                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Have Demat Account ? </label>
                                            <select name="demate" class="form-control">
                                                <option value="">Select </option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>

                                            </select>
                                            <div class="error-message" id="demate-error"></div>

                                        </div>
                                    </div> -->

                                    <input type="hidden" id="pagename" value="0">
                                    <input type="hidden" id="next" value="0">
                                    <input type="hidden" id="prev" value="0">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Select Status </label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                @if(!empty($status))
                                                @foreach($status as $list)
                                                <option value="{{$list->status}}">{{$list->status}}</option>

                                                @endforeach()

                                                @endif()


                                            </select>
                                            <div class="error-message" id="status-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Select Source </label>
                                            <select name="source" class="form-control">
                                                <option value="">Select Source</option>
                                                @if(!empty($source))
                                                @foreach($source as $list)
                                                <option value="{{$list->source}}">{{$list->source}}</option>

                                                @endforeach()

                                                @endif()


                                            </select>
                                            <div class="error-message" id="source-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">How Much Fund Customer Have</label>
                                            <input type="text" class="form-control" name="funds" placeholder="How Much Fund Customer Have">
                                            <div class="error-message" id="funds-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Next Follow Up </label>
                                            <input type="date" class="form-control" id="followUpInput" name="followup" placeholder="How Much Fund Customer Have">

                                            <div class="error-message" id="status-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Description</label>
                                            <textarea type="text" class="form-control" name="description" placeholder="Description" id="description"></textarea>
                                            <div class="error-message" id="description-error"></div>

                                        </div>
                                    </div>







                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div style="text-align: center;">
                                            <div class="text-success" id="success"></div>

                                            <button type="submit" style="
    width: 20%;
" class="btn btn-dark" id="changetext">Submit</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>





                    </div>
                </div>
            </div> <!-- end col -->


        </div>
    </div>
</div> <!-- end col -->
</div>
<!-- end col -->

<script src="{{asset('admin/js/ajax/leads.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const followUpInput = document.getElementById('followUpInput');
        const today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format
        followUpInput.setAttribute('min', today);
    });
</script>
</div>
@endsection