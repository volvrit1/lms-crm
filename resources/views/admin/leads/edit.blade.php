@extends('admin.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    table thead {
        background-color: black;
        color: white;
    }

    input {
        width: 75% !important;
    }

    .modal-lg,
    .modal-xl {
        width: 1460px !important;
    }

    .modal-header {
        background-color: #343a40;
        color: #fff;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #343a40;
        box-shadow: 0 0 5px rgba(52, 58, 64, 0.8);
    }

    .btn-dark {
        background-color: #343a40;
        border-color: #343a40;
    }

    .btn-dark:hover {
        background-color: #495057;
        border-color: #495057;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal input {
        width: 100% !important;

    }

    .custom-icon {
        margin-right: 5px;
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
                        <h4 class="card-title mb-0 flex-grow-1">Update {{$lead->name ?? ''}} </h4>
                        </br>
                        @if(Auth::user()->role =='admin')
                        <a href="{{route('leads.all')}}" style="width: 10%;" class="btn btn-dark">Back</a>
                        @else

                        <a href="{{route('leads.assigned')}}" style="width: 10%;" class="btn btn-dark">Back</a>

                        @endif()
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('leads.update')}}" id="companyadminedit" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">
                                                Name</label>
                                            <input type="text" class="form-control" value="{{$lead->name?? ''}}" name="name" placeholder="Enter Manager Name" id="firstNameinput" >
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{$lead->id}}">

                                    <!--end col-->

                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Phone
                                                Number</label>
                                            <input type="tel" class="form-control onlyNumeric" name="phone" placeholder="Enter mobile number" id="phonenumberInput" value="{{$lead->phone?? ''}}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" {{$readonly}}>


                                            <div class="error-message" id="phone-error"></div>

                                        </div>
                                    </div>

                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Email
                                                Address</label>
                                            <input type="text" class="form-control" value="{{$lead->email ?? ''}}" name="email" placeholder="example@gmail.com" id="emailidInput" >
                                            <div class="error-message" id="email-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->

                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Have Demat Account ? </label>
                                            <select name="demate" class="form-control">
                                                <option value="">Select </option>
                                                <option value="1" @if(!empty($lead->demate) && $lead->demate == 1) selected @endif>Yes</option>
                                                <option value="0" @if( $lead->demate == 0) selected @endif>No</option>
                                            </select>
                                            <div class="error-message" id="demate-error"></div>

                                        </div>
                                    </div> -->
                                    <!--end col-->




                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">How Much Fund Customer Have</label>
                                            <input type="text" class="form-control" name="funds" value="{{$lead->funds ?? ''}}" placeholder="How Much Fund Customer Have">
                                            <div class="error-message" id="funds-error"></div>

                                        </div>
                                    </div>
                                    @if(in_array(Auth::user()->role ,['Manager','admin']) )
                                    @php
                                    $assignleads = DB::table('assignleads')->where('lead_id',$lead->id)->first();
                                    @endphp
                                    <div class="col-md-6">
                                        <label class="form-label"> Assign Employee</label>
                                        <select name="employee_id" class="form-control" required>
                                            <option value="">Select Employee</option>
                                            @if(!empty($users))
                                            @foreach($users as $list)
                                            <option value="{{$list->id}}" @if(!empty($assignleads)) @if($assignleads->employee_id == $list->id){{'selected'}} @endif() @endif()>{{$list->name ?? ''}} ({{$list->role ?? ''}})</option>
                                            @endforeach()

                                            @endif


                                        </select>
                                    </div>

                                    @endif()

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Select Status </label>
                                            <select name="status" class="form-control" onchange="changestatus(this.value)">
                                                <option value="">Select Status</option>
                                                @if(!empty($status))
                                                @foreach($status as $list)
                                                <option value="{{$list->status}}" @if(!empty($lead->status) && $lead->status == $list->status) selected @endif>{{$list->status}}</option>

                                                @endforeach()
                                                <option value="Paid">Add More Amount</option>


                                                @endif()


                                            </select>
                                            <div class="error-message" id="status-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6" style="display: none;" id="paymentsection">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Paid Amount</label>
                                            <input type="tel" id="paidamount" class="form-control" name="paidamount" placeholder="Paid Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            <div class="error-message" id="funds-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Select Source </label>
                                            <select name="source" class="form-control" {{$readonly}}>
                                                <option value="">Select Source</option>
                                                @if(!empty($source))
                                                @foreach($source as $list)
                                                <option value="{{$list->source}}" @if(!empty($lead->source) && $lead->source == $list->source) selected @endif>{{$list->source}}</option>

                                                @endforeach()

                                                @endif()


                                            </select>
                                            <div class="error-message" id="source-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Next Follow Up </label>
                                            <input type="date" class="form-control" value="{{$lead->followup ?? ''}}" id="followUpInput" name="followup" placeholder="How Much Fund Customer Have">
                                            <div class="error-message" id="status-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Description</label>
                                            <textarea type="text" class="form-control" name="description" placeholder="Description" id="description">{{$lead->description ?? ''}}</textarea>
                                            <div class="error-message" id="description-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5">
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#settlementModal">
                                            Add Project Settlement
                                        </button>
                                        <button type="button" onclick="getLeadPaymentInfo('{{$lead->id}}')" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#paymentModel">
                                            Update Payment
                                        </button>
                                    </div>
                                    <input type="hidden" id="pagename">
                                    <input type="hidden" id="next" value="{{$previousLeadId}}">
                                    <input type="hidden" id="prev" value="{{$nextLeadId}}">




                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div style="text-align: center;">
                                            <div class="text-success" id="success"></div>

                                            <button type="submit" style="width: 10%;" class="btn btn-dark" onclick="savename('same')" id="changetext">Save</button> &nbsp;&nbsp;&nbsp;
                                            <button type="submit" style="width: 15%;" class="btn btn-dark " onclick="savename('next')" id="save-next-btn">Save & Next</button>
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
<div class="modal fade" id="settlementModal" tabindex="-1" aria-labelledby="settlementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="settlementModalLabel">Add Project Settlement</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="settlementForm" enctype="multipart/form-data" method="post">
                    @csrf()
                    <!-- Project Settlement Section -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="totalSettlement" class="form-label">Total Settlement</label>
                            <input type="number" onkeydown="settleamount()" onkeyup="settleamount()" class="form-control" id="totalSettlement" name="totalSettlement"
                                placeholder="Enter total settlement amount" required>
                            <input type="hidden" name="lead_id" value="{{$lead->id ?? ''}}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="totalSettlement" class="form-label"> Project Name / Settlement For</label>
                            <input type="text" class="form-control" id="settlementfor" name="settlementfor"
                                placeholder="Enter  Project Name / settlement for" required>
                        </div>
                        <!-- Upload Quotation Section -->
                        <div class="mb-3 col-md-6">
                            <label for="quotation" class="form-label">Upload Quotation</label>
                            <input type="file" class="form-control" accept="application/pdf" id="quotation" name="quotation" required>
                        </div>

                        <!-- Advance / Payment Receipt Section -->
                        <div class="mb-3 col-md-6">
                            <label for="advancePayment" class="form-label">Advance </label>
                            <input type="number" onkeydown="settleamount()" onkeyup="settleamount()" class="form-control" id="advancePayment" name="advancePayment"
                                placeholder="Enter payment receipt details" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="quotation" class="form-label">Upload Advance Receipt </label>
                            <input type="file" class="form-control" id="advanceRecepit" name="recepit" required>
                        </div>
                        <!-- Balance Section -->
                        <div class="mb-3 col-md-6">
                            <label for="balance" class="form-label">Balance</label>
                            <input type="number" readonly class="form-control" id="balance" name="balance"
                                placeholder="Enter the remaining balance" required>
                        </div>

                        <!-- Installment / Final Balance Section -->


                        <!-- Modal Footer with Submit Button -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" id="submitform"><i class="bi bi-check-circle custom-icon"></i>Submit Settlement</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentModel" tabindex="-1" aria-labelledby="settlementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="settlementModalLabel">Update Payment </h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <!-- test bro -->
                <div class="appendView">

                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lead Conversation </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">SNo</th>
                                        <th scope="col">Add By</th>
                                        <th scope="col">Conversation</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($leadhistory))
                                    @foreach($leadhistory as $key=> $hisorylist)
                                    <tr>
                                        <th scope="row">{{ ++ $key}}</th>
                                        <td>{{$hisorylist->name}}-<b> {{$hisorylist->role}}</b></td>
                                        <td>{{$hisorylist->description ?? ''}}</td>
                                        <td>{{$hisorylist->status ?? ''}}</td>
                                        <td>{{$hisorylist->created_at ?? ''}}</td>
                                    </tr>

                                    @endforeach()


                                    @endif()



                                </tbody>
                            </table>


                        </div>





                    </div>
                </div>
            </div> <!-- end col -->


            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex " style="background-color: black; color:white !important;">
                        <h4 class="card-title mb-0 flex-grow-1 text-white">Project Settlement </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">SNo</th>
                                        <th scope="col">Settlment For</th>
                                        <th scope="col">Total Settlement</th>
                                        <th scope="col">View Quotation</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($phase))
                                    @foreach($phase as $key=> $hisorylist)
                                    <tr>
                                        <th scope="row">{{ ++ $key}}</th>
                                        <td><b> {{$hisorylist->phase_name}}</b></td>
                                        <td>₹ {{$hisorylist->total_amount ?? ''}}</td>
                                        <td>
                                            <a href="{{url($hisorylist->quotation_pdf)}}" target="_blank">View</a>
                                        </td>
                                        <td>{{$hisorylist->created_at ?? ''}}</td>
                                    </tr>

                                    @endforeach()


                                    @endif()



                                </tbody>
                            </table>


                        </div>





                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex " style="background-color: black; color:white !important;">
                        <h4 class="card-title mb-0 flex-grow-1 text-white">Project Payment </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">SNo</th>
                                        <th scope="col">Phase Name</th>
                                        <th scope="col">Phase Amount Summary</th>
                                        <th scope="col">Phase Balance</th>
                                        <th scope="col">View Receipt</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($phase_receipts))
                                    @foreach($phase_receipts as $key=> $hisorylist2)
                                    <tr>
                                        <th scope="row">{{ ++ $key}}</th>

                                        <td><b> {{$hisorylist2->phasename['phase_name'] ?? ''}}</b></td>
                                        <td>₹ {{$hisorylist2->amount ?? ''}}</td>
                                        <td> ₹ {{$hisorylist2->balance ?? ''}}</td>
                                        <td>
                                            @if(!empty($hisorylist2->recepit))
                                            <a href="{{url($hisorylist2->recepit)}}" target="_blank">View</a>
                                            @endif()
                                        </td>
                                        <td>
                                            @if($hisorylist2->status ==0 )
                                            <span class="text-warning">Pending </span>

                                            @elseif($hisorylist2->status ==2)
                                            <span class="text-danger">Declined</span>

                                            @else
                                            <span class="text-success">Approved</span>

                                            @endif()
                                        </td>
                                        <td>{{$hisorylist2->created_at ?? ''}}</td>
                                    </tr>

                                    @endforeach()


                                    @endif()




                                </tbody>
                            </table>


                        </div>





                    </div>
                </div>
            </div> <!-- end col -->


            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Call Given </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">SNo</th>
                                        <th scope="col">Add By</th>
                                        <th scope="col">Conversation</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($callgiven))
                                    @foreach($callgiven as $key=> $hisorylist)
                                    <tr>
                                        <th scope="row">{{ ++ $key}}</th>
                                        <td>{{$hisorylist->name}}-<b> {{$hisorylist->role}}</b></td>
                                        <td>{{$hisorylist->description ?? ''}}</td>
                                        <td>{{$hisorylist->status ?? ''}}</td>
                                        <td>{{$hisorylist->created_at ?? ''}}</td>
                                    </tr>

                                    @endforeach()


                                    @endif()



                                </tbody>
                            </table>


                        </div>





                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lead Follow Ups </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">SNo</th>
                                        <th scope="col">Add By</th>
                                        <th scope="col">Next Follow Up Date</th>
                                        <th scope="col">Conversation</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($followup))
                                    @foreach($followup as $key=> $hisorylist)
                                    <tr>
                                        <th scope="row">{{ ++ $key}}</th>
                                        <td>{{$hisorylist->name}}-<b> {{$hisorylist->role}}</b></td>
                                        <td>{{$hisorylist->date ?? ''}}</td>
                                        <td>{{$hisorylist->description ?? ''}}</td>
                                        <td>{{$hisorylist->status ?? ''}}</td>
                                        <td>{{$hisorylist->created_at ?? ''}}</td>
                                    </tr>
                                    @endforeach()

                                    @endif()


                                </tbody>
                            </table>


                        </div>





                    </div>
                </div>
            </div> <!-- end col -->


            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Payment </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">SNo</th>
                                        <th scope="col">Add By</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($payment))
                                    @foreach($payment as $key=> $hisorylist)
                                    <tr>
                                        <th scope="row">{{ ++ $key}}</th>
                                        <td>{{$hisorylist->name}}-<b> {{$hisorylist->role}}</b></td>
                                        <td>{{$hisorylist->payment ?? ''}}</td>
                                        <td>
                                            @php
                                            $color = 'warning';
                                            @endphp

                                            @if($hisorylist->status =='Approved')
                                            @php
                                            $color = 'success';
                                            @endphp
                                            @elseif($hisorylist->status =='Declined')
                                            @php
                                            $color = 'danger';
                                            @endphp
                                            @endif

                                            <span class="btn btn-{{$color}} btn-sm">{{$hisorylist->status ?? ''}}</span></br>

                                            @if($hisorylist->status !='pending')
                                            <span class="mt-4">
                                                {{ date('d-m-Y', strtotime($hisorylist->approved_or_reject_date)) }}
                                            </span>
                                            @endif()
                                        </td>
                                        <td>{{$hisorylist->created_at ?? ''}}</td>
                                    </tr>
                                    @endforeach()

                                    @endif()


                                </tbody>
                            </table>


                        </div>





                    </div>
                </div>
            </div> <!-- end col -->



        </div>
    </div>
</div> <!-- end col -->

<script src="{{asset('admin/js/ajax/leads.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#settlementForm').on('submit', function(e) {
            e.preventDefault();
            $('#submitform').html('please wait.....');


            var formData = new FormData(this);

            $.ajax({
                url: '{{route("leads.phase.quoatation")}}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#submitform').html('Submit Settlement');

                    alert(response.message);
                    if (response.code == 200) {
                        setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 1000)
                    }
                    // Handle success response
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('An error occurred: ' + error);
                }
            });
        });
    });

    function settleamount() {

        // now first of all we have to get the total settlement
        let totalSettlement = document.getElementById('totalSettlement').value;
        let advance = document.getElementById('advancePayment').value;
        if (advance != 0 && advance != '') {
            $('#advanceRecepit').attr('required', true);
        } else {
            $('#advanceRecepit').attr('required', false);

        }
        let FindDifference = Number(totalSettlement - advance);
        document.getElementById('balance').value = FindDifference;
    }
</script>



</div>
@endsection