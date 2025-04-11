<?php

namespace App\Repositories;

use App\Models\Phase;
use App\Models\ProjectDevelopers;
use App\Models\ProjectQuotation;
use App\Models\Task;
use App\Models\User;
use App\Repositories\Project\ProjectInterface;
use Illuminate\Support\Facades\Auth;

class ProjectRepository implements ProjectInterface
{

    public function index()
    {
        // now get those project that has verified by admin once the payment has been done

        // now show the project on the bases of their role 
        // if the role is admin 
        $role  = Auth::user()->role;
        if ($role == 'admin') {
            $data['projects'] = Phase::whereMain('1')->get();
        } else {
            $loogedIn =  Auth::user()->id;
            $data['projects'] =  Phase::with(['developers:id,user_id,status,phase_id'])->whereHas('developers', function ($q) use ($loogedIn) {
                $q->where('user_id', $loogedIn);
            })->orderBy('id', 'desc')->get();
        }



        return view('admin.projects.list', $data);
    }
    public function detail($id)
    {


        $role  = Auth::user()->role;
        $data['lead_id']  =  $id;

        if ($role == 'admin') {
            $totalCount  =  Task::where('lead_id', $id)->count();
            $data['phases'] = Phase::where([['lead_id', $id]])->get();
            $wholestatus   = Task::selectRaw('task_status , COUNT(*) AS statuscount')->whereIn('task_status', ['Completed', 'Pending', 'Work in progress'])->where('lead_id', $id)->groupBy('task_status')->pluck('statuscount', 'task_status');
        } else {
            $loogedIn =  Auth::user()->id;
            $totalCount  =  Task::where('user_id', $loogedIn)->where('lead_id', $id)->count();
            $wholestatus   = Task::selectRaw('task_status , COUNT(*) AS statuscount')->where('user_id', $loogedIn)->whereIn('task_status', ['Completed', 'Pending', 'Work in progress'])->where('lead_id', $id)->groupBy('task_status')->pluck('statuscount', 'task_status');

            $data['phases'] =  Phase::with(['developers:id,user_id,status,phase_id'])->whereHas('developers', function ($q) use ($loogedIn) {
                $q->where('user_id', $loogedIn);
            })->where([['lead_id', $id]])->orderBy('id', 'desc')->get();
        }
        $allstatus = [
            'completed' => $wholestatus->get('Completed', 0),
            'pending' => $wholestatus->get('Pending', 0),
            'work_in_progress' => $wholestatus->get('Work in progress', 0)
        ];
        $data['overallstatus']  = $allstatus;

        // $data['phases'] = Phase::->get();
        $data['developer'] = User::where('role', 'Developer')->get();
        $data['ui'] = User::where('role', 'UI UX Designer')->get();
        $data['digitalmarketing'] = User::where('role', 'Digital Marketing')->get();
         $data['alltask'] = Phase::with(['tasks', 'tasks.users' => function ($q) {
            $q->select('id', 'name', 'role');
        }])->select('id', 'phase_name')->where([['lead_id', $id]])->get()->map(function($phase){
            $phase->recent_task= $phase->tasks->sortByDesc('id')->take(5);;
            return $phase;
        });
        $data['totalCount']  =  $totalCount;


        return view('admin.projects.detail', $data);
    }

    public function getbalance($phaseId)
    {
        $balance =    ProjectQuotation::where('phase_id', $phaseId)->where('status', 1)->sum('balance');

        $totalamount =    Phase::where('id', $phaseId)->first();

        $lead['phase_receipts']  =  ProjectQuotation::with('phasename')->where('phase_id', $phaseId)->orderby('id', 'desc')->get();
        $paymentBalance =  view('admin.projects.payment', $lead)->render();
        $whole = ['balance' => $balance ?? $totalamount->total_amount, 'table' => $paymentBalance, 'lead_id' => $totalamount->lead_id, 'overallprojectCost' => $totalamount->total_amount];


        return $this->sendJsonResponse(200, 'Balance Fecteched Successfully', $whole);
    }

    public function sendJsonResponse($code, $message, $data = [])
    {

        return response()->json(['code' => $code, 'message' => $message, 'data' => $data], $code);
    }

    public function updatepayment($request)
    {
        $insert['amount'] =  $request['paidamount'];
        $balance = $request['lastamount'] -  $request['paidamount'];
        $insert['balance'] = $balance;
        $insert['phase_id'] = $request['phase_id'];
        $insert['lead_id'] = $request['lead_id2'];
        $insert['add_by'] = Auth::user()->id;


        if (isset($request['recepit'])) {
            $file = $request['recepit']; // Accessing the file from the array
            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                // Use the real extension in the filename
                $imageName = time() . '.' . $extension;

                $file->move(public_path('uploads/receipts/'), $imageName);
                $insert['recepit'] = "uploads/receipts/$imageName";
            } else {
                throw new \Exception("Invalid quotation file.");
            }
        }
        $insert['created_at'] = now();
        $phaseAdded = ProjectQuotation::insert($insert);


        if ($phaseAdded) {
            return response()->json(['code' => 200, 'message' => 'Payment added Successfully!']);
        } else {
            return response()->json(['code' => 500, 'message' => 'Something went wrong please try again ']);
        }
    }

    public function members($data)
    {
        $data['members'] = ProjectDevelopers::with('users')->where('phase_id', $data['id'])->get();
        $memberView =  view('admin.projects.members', $data)->render();
        return response()->json(['code' => 200, 'members' => $memberView]);
    }
    public function assign($data)
    {

        if (isset($data['uiux']) && !empty($data['uiux'])) {
            foreach ($data['uiux'] as $list) {
                $save = [
                    'user_id' => $list,
                    'phase_id' => $data['phase_id'],
                    'delivery_date' => $data['uiuxdate'],
                ];

                // Update or create the record
                ProjectDevelopers::updateOrCreate(
                    [
                        'user_id' => $list,
                        'phase_id' => $data['phase_id'],
                        'delivery_date' => $data['uiuxdate']
                    ],
                    $save
                );
            }
        }


        if (isset($data['developer']) && !empty($data['developer'])) {
            foreach ($data['developer'] as $list) {
                $save = [
                    'user_id' => $list,
                    'phase_id' => $data['phase_id'],
                    'delivery_date' => $data['developerdate'],
                ];

                // Update or create the record
                ProjectDevelopers::updateOrCreate(
                    [
                        'user_id' => $list,
                        'phase_id' => $data['phase_id'],
                        'delivery_date' => $data['developerdate']
                    ],
                    $save
                );
            }
        }

        if (isset($data['digitalmarketer']) && !empty($data['digitalmarketer'])) {
            foreach ($data['digitalmarketer'] as $list) {
                $save = [
                    'user_id' => $list,
                    'phase_id' => $data['phase_id'],
                    'delivery_date' => $data['digitalmarketerdate'],
                ];

                // Update or create the record
                ProjectDevelopers::updateOrCreate(
                    [
                        'user_id' => $list,
                        'phase_id' => $data['phase_id'],
                        'delivery_date' => $data['digitalmarketerdate']
                    ],
                    $save
                );
            }
        }
        return response()->json(['code' => 200, 'message' => 'Project Assign successfully!']);
    }
}
