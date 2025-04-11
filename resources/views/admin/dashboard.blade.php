@extends('admin.layout')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .ff-secondary {
        color: white !important;
    }

    .fw-medium {
        color: white !important;

    }

    .card-body2 {
        background-color: #5d87ff;
        border-bottom: 1px solid #ccc;
        padding: 10px;
        border-radius: 34px;
        height: 158px !important;
    }

    .text-decoration-underline text-white {
        color: black
    }


    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #ccc;
        padding: 10px;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }

    .table {
        width: 100%;
        margin: 20px 0;
    }

    .table th,
    .table td {
        padding: 8px 12px;
        text-align: left;
    }

    .table th {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 20px 0;
    }

    .card-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #ccc;
        padding: 10px;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }

    .table {
        width: 100%;
        margin: 20px 0;
    }

    .table th,
    .table td {
        padding: 8px 12px;
    }
</style>
@section('content')

@feature('admin_panel')

<div class="row">
    <div class="col-lg-3 ">
        <!-- card -->
        <div class="card card-animate " style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body  ">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Total Leads </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_all ?? 0}}">{{$lead_count_all ?? 0}}</span></h4>
                        <a href="{{route('leads.all')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->

    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium    text-truncate mb-0"> Today Modified</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_modifiedtoday ?? 0}}">{{$lead_count_modifiedtoday ?? 0}}</span></h4>
                        <a href="{{url('admin/leads/status/modifiedtoday')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->
    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Today Follow-ups </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_today_followup ?? 0}}">{{$lead_count_today_followup ?? 0}}</span></h4>
                        <a href="{{url('admin/leads/status/todayfollowup')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->
    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Total Sales </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$topFiveSalesSum ?? 0}}">₹ {{$topFiveSalesSum ?? 0}}</span></h4>

                        @feature('admin_panel')

                        <a href="{{route('admin.sales')}}" class="text-decoration-underline text-white">View </a>

                        @endfeature()

                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->


</div>


<div class="row">
    <!-- <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Sales Overview</h5>
                    </div>
                    <div>
                        <select class="form-select">
                            <option value="1">March 2023</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                        </select>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div> -->


    <div class="col-lg-4 col-md-4">

        <div class="card card-animate">

            <div class="card-body card-body2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="card-title mb-9 fw-semibold" style="color: white;"> Total Users </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-dark" style="color: white;"><span class="counter-value" data-target="{{$riskcount ?? 0}}" style="color: white;  font-size:29px;">{{$company_admin ?? 0}}</span></h4>
                        <a href="{{url('admin/users/all')}}" style="color: white !important;" class="text-decoration-underline ">View </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- <div class="col-lg-4 col-md-4">
        <div class="card card-animate">
            <div class="card-body card-body2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="card-title mb-9 fw-semibold" style="color:white"> Total Risk Assesment </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4 " style="color: white;  font-size:29px;"><span class="counter-value" data-target="{{$riskcount ?? 0}}">{{$riskcount ?? 0}}</span></h4>
                        <a href="{{route('risk.all')}}" class="text-decoration-underline " style="color:white">View </a>
                    </div>

                </div>
            </div>
        </div>

    </div> -->
    <!-- <div class="col-lg-4 col-md-4">
        <div class="card card-animate">
            <div class="card-body card-body2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="card-title mb-9 fw-semibold" style="color:white">Total Service Aggrement </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4 " style="color: white;  font-size:29px;"><span class="counter-value" data-target="{{$serviceaggrementcount ?? 0}}">{{$serviceaggrementcount ?? 0}}</span></h4>
                        <a href="{{route('serviceagreement.all')}}" class="text-decoration-underline " style="color:white">View </a>
                    </div>

                </div>
            </div>
        </div>
    </div> -->

</div>
<!-- <div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Recent Transactions</h5>
                </div>
                <ul class="timeline-widget mb-0 position-relative mb-n5">
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">Payment was made of $64.95 to Michael</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal">#ML-3467</a>
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                            <span class="timeline-badge-border d-block flex-shrink-0"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New arrival recorded
                        </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">Payment Done</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Assigned</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Priority</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Budget</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">1</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                    <span class="fw-normal">Web Designer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Elite Admin</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">2</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$24.5k</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">3</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                                    <span class="fw-normal">Project Manager</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger rounded-3 fw-semibold">High</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$12.8k</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">4</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                                    <span class="fw-normal">Frontend Engineer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">Hosting Press HTML</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-success rounded-3 fw-semibold">Critical</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">$2.4k</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->
</div>


@endfeature

@if(in_array(Auth::user()->role ,['Manager','BDE','Senior BDE']) )
<div class="row">
    <div class="col-lg-3 ">
        <!-- card -->
        <div class="card card-animate " style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Total Leads </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_all ?? 0}}">{{$lead_count_all ?? 0}}</span></h4>
                        <a href="{{route('leads.all')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->

    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium    text-truncate mb-0"> Today Modified</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_modifiedtoday ?? 0}}">{{$lead_count_modifiedtoday ?? 0}}</span></h4>
                        <a href="{{url('admin/leads/status/modifiedtoday')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->
    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Today Follow-ups </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_today_followup ?? 0}}">{{$lead_count_today_followup ?? 0}}</span></h4>
                        <a href="{{url('admin/leads/status/todayfollowup')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->
    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Total Sales </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$topFiveSalesSum ?? 0}}">{{$topFiveSalesSum ?? 0}}</span></h4>


                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->


</div>
@endif()

@if(Auth::user()->role =='Compliance')

<div class="row">
    <div class="col-lg-3 ">
        <!-- card -->
        <div class="card card-animate " style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <!-- <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Total Risk Assesment </p>
                    </div>

                </div> -->
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$riskcount ?? 0}}">{{$riskcount ?? 0}}</span></h4>
                        <a href="{{route('risk.all')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->

    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium    text-truncate mb-0"> Total Service Aggrement</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$serviceaggrementcount ?? 0}}">{{$serviceaggrementcount ?? 0}}</span></h4>
                        <a href="{{route('serviceagreement.all')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->
    <div class="col-lg-3">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Exipred Service Aggrement </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$serviceaggrementexpiry ?? 0}}">{{$serviceaggrementexpiry ?? 0}}</span></h4>
                        <a href="{{route('serviceagreement.expired')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->



</div>


@endif()
@if(Auth::user()->role =='admin')
<div class="container m-auto">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>Sales Chart</h4><hr>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <canvas id="salesChart" width="800" height="400"></canvas>

        </div>
    </div>

</div>
@endif()

@php
use Carbon\Carbon;

$currentMonth = Carbon::now()->month;
$currentYear = Carbon::now()->year;

$topFiveSales = DB::table('project_quotations as pr')
->join('leads as l', 'pr.lead_id', '=', 'l.id')
->join('users as u', 'pr.add_by', '=', 'u.id')
->select(
'pr.add_by',
'u.name as user_name',
DB::raw('SUM(pr.amount) as total_payment'),
DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m") as month')
)
->where('pr.status', 1)
->whereMonth('pr.approved_or_reject_date', $currentMonth)
->whereYear('pr.approved_or_reject_date', $currentYear)
->groupBy('pr.add_by', 'u.name', DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'))
->orderBy('total_payment', 'desc')
->limit(5)
->get();


// Fetch the top 5 sales data for the current month and year
        $topFiveSales2 = DB::table('project_quotations as pr')
            ->join('leads as l', 'pr.lead_id', '=', 'l.id')
            ->join('users as u', 'pr.add_by', '=', 'u.id')
            ->select(
                'u.name as user_name',
                DB::raw('SUM(pr.amount) as total_payment'),
                DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m") as month')
            )
            ->where('pr.status', 1)
            ->groupBy('pr.add_by', 'u.name', DB::raw('DATE_FORMAT(pr.approved_or_reject_date, "%Y-%m")'))
            ->orderBy('total_payment', 'desc')
            ->limit(5)
            ->get();

        // Prepare data for Chart.js
        $labels = $topFiveSales2->map(function($item) {
            return $item->user_name . ' (' . $item->month . ')';
        })->toArray();
        
        $data = $topFiveSales2->pluck('total_payment')->toArray();
    @endphp

@if(Auth::user()->role !='Compliance')
<div class="row ml-5" style="margin-left: 130px;">
    <div class="col-md-9" style="font-weight: 900; color:black;">

        <div class="card card-body2" style="
    background: #f0ebeb;
    /* color: white; */
">
            <div class="card-header align-items-center d-flex ">
                <h4 class="card-title mb-0 flex-grow-1">Leader Board</h4>

            </div><!-- end card header -->

            <div class="live-preview">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0" style="border: 0.1px solid black;">
                        <thead>
                            <tr>
                                <th>SNO</th>
                                <!-- <th>Company name</th> -->
                                <th> Name</th>
                                <th>Payment</th>
                                <th>Month</th>


                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($topFiveSales))

                            @foreach($topFiveSales as $key=>$list)

                            <tr>
                                <th>{{++$key}}</th>
                                <td>{{$list->user_name ?? ''}}</td>
                                <td>₹ {{$list->total_payment ?? ''}}</td>
                                <td>{{$list->month ?? ''}}</td>




                            </tr>
                            @endforeach()
                            @endif()

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endif()



<script>
    document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('salesChart').getContext('2d');

            const salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Total Payment',
                        data: @json($data),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Total Payment: ' + context.formattedValue;
                                },
                                afterLabel: function(context) {
                                    return 'Month: ' + context.label.split('(')[1].replace(')', '');
                                }
                            }
                        }
                    }
                }
            });
        });
</script>

@endsection