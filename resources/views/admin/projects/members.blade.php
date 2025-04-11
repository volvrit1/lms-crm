<div class="card">
    <div class="card-header py-3">
        <h6 class="mb-0 fw-bold ">Allocated Task Members &nbsp;&nbsp;&nbsp;&nbsp; 
            
        @if (Auth::user()->role =='admin')
            
       <button onclick="showsProjectsegment()" class="btn btn-sm  btn-info">Assign Project</button> </h6>
       @endif
    </div>

    <div class="card-body">

        <div class="flex-grow-1 mem-list">
            @if($members->isNotEmpty())
            @foreach ($members as $list )
            <div class="py-2 d-flex align-items-center border-bottom">

                <div class="d-flex ms-2 align-items-center flex-fill">

                    <div class="d-flex flex-column ps-2">
                        <h6 class="fw-bold mb-0">{{$list->users[0]->name ?? ''}}  - ( <b>{{$list->status }}</b>)</h6>
                        <span class="small text-muted">{{$list->users[0]->role ?? ''}}</span>
                        <span class="small text-muted">Expected Delivery :  {{$list->delivery_date}}</span>
                    </div>
                </div>
                @if (Auth::user()->role =='admin')
                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>

                @endif()
            </div>

            @endforeach


            @else
            <div class="py-2 d-flex align-items-center border-bottom">

                <div class="d-flex ms-2 align-items-center flex-fill">

                    <div class="d-flex flex-column ps-2">
                        <h6 class="fw-bold mb-0">No one assign on this project !</h6>
                    </div>
                </div>
            </div>

            @endif



        </div>
    </div>
</div> <!-- .card: My Timeline -->

<script>
    function showsProjectsegment() {
        $('#projectassign').show();
        $('html, body').animate({
            scrollTop: $('#projectassign').offset().top
        }, 100);
    }
</script>