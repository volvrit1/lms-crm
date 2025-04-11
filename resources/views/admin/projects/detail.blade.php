@extends('admin.layout')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

@section('content')
<style>
    .progress-count:hover {
        background: #f6f0f0e3;
        padding: 5px 9px;
        border-radius: 8px;
        cursor: pointer;
    }

    .customBorder {
        border: 1px dotted #1c1c2b3d;
        padding: 8px 12px;
    }

    .content {
        min-height: 250px;
        padding: 0.75rem 1.5rem 0px 1.5rem;
        margin-right: auto;
        margin-left: auto;
    }

    .box {
        position: relative;
        margin-bottom: 1.5rem;
        width: 100%;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 0px;
        -webkit-transition: .5s;
        transition: .5s;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-shadow: 0 0 30px 0 rgba(82, 63, 105, 0.05);
        box-shadow: 0 0 30px 0 rgba(82, 63, 105, 0.05);
    }

    .box-controls {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: reverse;
        flex-direction: row-reverse;
    }

    .theme-primary .text-primary {
        color: #3762EA !important;
    }

    .icon i {
        width: 60px;
        height: 60px;
        text-align: center;
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.2);
        line-height: 60px;
        border-radius: 100%;
        margin-right: 30px;
    }

    .box-body {
        padding: 1.5rem;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        border-radius: 10px;
    }

    .pt-0 {
        padding-top: 0px !important;
    }

    .pull-right {
        float: right;
    }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<h1 class="text-uppercase">Project Phases </h1>
<hr>


<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <h4 class="card-title text-uppercase text-center">Task Statistics</h4>
                <div class="statistics">
                    <div class="row">
                        <div class="col-md-6 bg-dark text-white col-6 text-center">
                            <div class="stats-box mb-4 p-2">
                                <p>Total Tasks</p>
                                <h3 class="text-white">{{$totalCount}}</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-6 bg-warning col-6 text-center">
                            <div class="stats-box mb-4 p-2">
                                <p class="text-white">Pending Tasks</p>
                                <h3>{{$overallstatus['pending']}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <p><i class="fa-regular fa-circle-dot text-purple me-2"></i>Completed Tasks <span class="float-end">{{$overallstatus['completed']}}</span></p>
                    <p><i class="fa-regular fa-circle-dot text-warning me-2"></i>Work in Progress <span class="float-end">{{$overallstatus['work_in_progress']}}</span></p>
                   
                    <p><i class="fa-regular fa-circle-dot text-danger me-2"></i>Pending Tasks <span class="float-end">{{$overallstatus['pending']}}</span></p>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix  g-3">
    <div class="col-lg-12 col-md-12 flex-column">
        <div class="row g-3 row-deck">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-header py-3">
                        <h6 class="mb-0 fw-bold ">Phases Name</h6>
                    </div>
                    <div class="card-body mem-list">

                        @if($phases)
                        @foreach($phases as $list)
                        <div class="progress-count mb-3" style="
    border: 2px dotted black;
    padding: 3px;
">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="mb-0 fw-bold d-flex align-items-center">{{$list->phase_name ?? ''}}</h6>
                                <!-- <span class="small text-muted">02/07</span></br> -->
                                <button class="btn btn-sm btn-info" onclick="showdetail('{{$list->id}}')">View </button>
                            </div>
                            <!-- <div class="progress" style="height: 10px;">
                                <div class="progress-bar light-info-bg" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> -->
                        </div>
                        @endforeach()
                        @endif()

                    </div>
                </div>
            </div>


            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12" id="members">

            </div>
            <div class="col-lg-4 d-flex align-items-stretch" style="height:500px;">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold">Recent Activity</h5>
                        </div>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                        @if($alltask->isNotEmpty())
                         @foreach ($alltask as $index=>$list )
                         @foreach ($list->recent_task as $key=>$show )



                            <li class="timeline-item d-flex position-relative overflow-hidden">

                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">{{substr($show->users->name , 0,2)}}</span>

                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">Task Submit by {{$show->users->name ?? ''}} for <span class="text-primary"> {{$list->phase_name}} </span></br>
                                    <span class="d-flex text-muted">

                                    {{ \Carbon\Carbon::parse($show->created_at)->diffForHumans() }}
                                    
                                    </span>
                                </div>

                            </li>
                            @endforeach 
                            @endforeach 
                            @endif()
                          
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="projectassign" style="display:none;">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Assign this project</h4>

                    </div><!-- end card header -->

                    <div class="card-body">
                        <form id="companyadmin" method="POST" action="{{ route('project.assign') }}">
                            @csrf()

                            <input type="hidden" name="phase_id" id="phase_id">
                            <div class="live-preview">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>Select Desinger</label>
                                                <select class="form-control" name="uiux[]" id="employee" style="width: 100%" multiple>
                                                    <option value="">Select Ui/Ux</option>

                                                    @if(!empty($ui))
                                                    @foreach($ui as $list)
                                                    <option value="{{$list->id}}">{{$list->name}}- {{$list->role}}</option>
                                                    @endforeach()
                                                    @endif()
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Desinger Delivery Date</label>
                                                <input type="date" class="form-control" name="uiuxdate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>Select Developer</label>
                                                <select class="form-control" name="developer[]" id="employee" style="width: 100%" multiple>
                                                    <option value="">Select Developer</option>

                                                    @if(!empty($developer))
                                                    @foreach($developer as $list)
                                                    <option value="{{$list->id}}">{{$list->name}}- {{$list->role}}</option>
                                                    @endforeach()
                                                    @endif()
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Developer Delivery Date</label>
                                                <input type="date" class="form-control" name="developerdate">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <label>Select Digital Marketer</label>
                                                <select class="form-control" name="digitalmarketer[]" id="employee" style="width: 100%" multiple>
                                                    <option value="">Select Digital Marketer</option>

                                                    @if(!empty($digitalmarketing))
                                                    @foreach($digitalmarketing as $list)
                                                    <option value="{{$list->id}}">{{$list->name}}- {{$list->role}}</option>
                                                    @endforeach()
                                                    @endif()
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Digital Marketer Delivery Date</label>
                                                <input type="date" class="form-control" name="digitalmarketerdate">
                                            </div>
                                        </div>


                                    </div>


                                </div>



                                <div class="col-md-3">


                                </div>


                                <div class="col-md-12 mt-5 text-center">
                                    <button type="submit" class="btn btn-primary " id="changetext">Assign Project</button>



                                </div>
                            </div>
                    </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>


    <div class="row mt-3">

        <h3>TASK SUBMISSIONS / Upload Daily work Reporting <a href="#" class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Upload Work</a>
        </h3>

        <hr>
        @if($alltask->isNotEmpty())
        @foreach ($alltask as $index=>$list )


        <div class="alert alert-info text-center text-uppercase text-bold card">
            {{$list->phase_name ?? ''}}
        </div>
        @foreach ($list->tasks as $taskIndex=>$taslist )
        <div class="col-md-4 card">
            <div class="card p-4 bg-dark text-white">
                <div class="d-flex  d-flex justify-content-between">
                    <div class="div">
                        {{$taslist->task_name ?? ''}}
                    </div>
                    @php
                    $taskStatus = $taslist->task_status ;
                    $message = '';
                    if($taskStatus == 'Pending'){
                    $message = 'warning';
                    }else if($taskStatus =='Work in progress'){
                    $message = 'info';
                    }else{
                    $message = 'success';

                    }


                    @endphp
                    <div class="div ">
                        <div class="btn btn-{{$message}} btn-sm"> {{$taslist->task_status ?? ''}}</div>
                    </div>
                </div>
            </div>

            <div class="">
                {!! $taslist->description ?? '' !!}
            </div>
            <div class="">
              <b>FILE :   <a href="{{asset($taslist->screenshot)}}" target="__blank">View</a></b>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        - {{date('Y M d', strtotime( $taslist->created_at ?? '')) }}

                    </div>
                    <div class="col-md-6 text-italic">
                        - {{$taslist->users->name ?? ''}}
                    </div>
                </div>

            </div>

        </div>
        @endforeach()
        @endforeach
        @endif()

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Your Work</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" id="uploadTask" action="{{route('task.store')}}">
                @csrf()
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6  customBorder">
                            <div class="form-group">
                                <label for="selectphase">Select Phase</label>
                                <select class="form-control" name="phase_id" id="selectphase" style="width: 100%">
                                    <option value="">Select Phase</option>
                                    @if($phases->isNotEmpty())
                                    @foreach ( $phases as $list )
                                    <option value="{{$list->id ?? ''}}">{{$list->phase_name ?? ''}}</option>

                                    @endforeach()



                                    @endif()


                                </select>
                                <div class="error-message" id="phase_id-error"></div>

                            </div>
                        </div>
                        <div class="col-md-6 customBorder ">
                            <div class="form-group">
                                <label for="workFile">Task Name</label>
                                <input type="text" placeholder="Enter task name" name="task_name" class="form-control" id="workFile">
                                <div class="error-message" id="task_name-error"></div>

                            </div>
                        </div>

                        <div class="col-md-6 customBorder mt-4">
                            <div class="form-group">
                                <label for="screenshot">Upload Screenshort / Api Collection </label>
                                <input type="file"  class="form-control" name="screenshot" id="screenshot">
                                <div class="error-message" id="screenshot-error"></div>

                            </div>
                        </div>
                        <div class="col-md-6 customBorder mt-4">
                            <div class="form-group">
                                <label for="date">Date </label>
                                <input type="date" value="{{date('Y-m-d')}}" name="completed_date" class="form-control" id="date">
                                <div class="error-message" id="completed_date-error"></div>

                            </div>
                        </div>


                        <div class="col-md-6 mt-2 customBorder">
                            <div class="form-group">
                                <label for="task_status">Task Status </label>
                                <select class="form-control" name="task_status" id="task_status" style="width: 100%">
                                    <option value="">Select Status</option>

                                    <option value="Completed">Completed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Work in progress">Work in progress</option>

                                </select>
                                <div class="error-message" id="task_status-error"></div>

                            </div>
                        </div>
                        <input type="hidden" name="lead_id" id="lead_id" value="{{$lead_id}}">

                        <div class="col-md-6 mt-2 customBorder">
                            <div class="form-group">
                                <label for="pendingtaskname">Pending Task Name</label>
                                <input type="text" class="form-control" name="pending_task_name" placeholder="Enter Pending Task Name" id="pendingtaskname">
                                <div class="error-message" id="pending_task_name-error"></div>

                            </div>
                        </div>
                        <div class="col-md-6 mt-2 customBorder">
                            <div class="form-group">
                                <label for="taskDate">Pending Task Date</label>
                                <input type="date" class="form-control" name="pending_task_date" id="taskDate">
                                <div class="error-message" id="pending_task_date-error"></div>

                            </div>
                        </div>
                        <div class="col-md-6 mt-2 customBorder">
                            <div class="form-group">
                                <label for="project_status">Overall Project Status </label>
                                <select class="form-control" name="project_status" id="project_status" style="width: 100%">
                                    <option value="">Select Overall Project Status</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Pending" selected>Pending</option>
                                    <option value="Work in progress">Work in progress</option>

                                </select>
                                <div class="error-message" id="project_status-error"></div>

                            </div>
                        </div>
                        <div class="col-md-12 customBorder  mt-4">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="editor" rows="7" placeholder="Describe your work along with the link"></textarea>
                            </div>
                        </div>
                        <div class="error-message" id="description-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="uploadtasksubmits">Submit</button>
                </div>
        </div>
        </form>

    </div>
</div>

</div>
<script src="{{ asset('admin/js/ajax/project.js') }}"></script>
<script>
    $(document).ready(function() {
        $('select').selectize({
            plugins: ['remove_button'],
            sortField: 'text'
        });
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            alert("sas");
            console.error(error);
        });
</script>
@endsection