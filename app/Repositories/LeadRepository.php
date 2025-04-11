<?php

namespace App\Repositories;

use App\Models\AssignLead;
use App\Models\GlobalModel;
use App\Models\LeadFollowUpModel;
use App\Models\LeadHistory;
use App\Models\leadModel;
use App\Models\Leads;
use App\Models\PaidAmountModel;
use App\Models\Phase;
use App\Models\PoolHistory;
use App\Models\SourceModel;
use App\Models\ProjectQuotation;

use App\Models\StatusModel;
use App\Models\User;
use App\Repositories\leads\LeadInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PDO;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class LeadRepository implements LeadInterface
{
    public function index()
    {
        $data['users'] = User::whereNotIn('role', ['admin', 'compliance'])->get();
        $data['source']  = SourceModel::all();
        $data['status']  = StatusModel::all();

        $data['leads'] = leadModel::with(['assignleads.user'])->orderby('id', 'desc')->paginate(40);
        if (Auth::user()->role != 'admin' ) {
            $userId =  Auth::user()->id;

            $data['leads'] = leadModel::whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            })->with(['assignleads.user'])->orderByRaw('updated_at IS NULL DESC, updated_at DESC')
                ->orderBy('id', 'desc')->paginate(40);
        }
        // GlobalModel::getDataOrderByiDesc('leads');
        return view('admin.leads.list', $data);
    }
    public function poolindex()
    {
        $data['users'] = User::whereNotIn('role', ['admin', 'compliance'])->get();
        $data['source']  = SourceModel::all();
        $data['status']  = StatusModel::all();

        $leadsdata = leadModel::where('in_pool', 1)->with(['assignleads.user']);
        $data['totalcount'] =  $leadsdata->count();

        $data['leads'] =  $leadsdata->orderby('id', 'desc')->paginate(40);
        if (Auth::user()->role != 'admin') {
            $userId =  Auth::user()->id;

            $data['leads'] = leadModel::whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            })->with(['assignleads.user'])->orderByRaw('updated_at IS NULL DESC, updated_at DESC')
                ->orderBy('id', 'desc')->paginate(40);
        }
        // GlobalModel::getDataOrderByiDesc('leads');
        return view('admin.leads.pool', $data);
    }

    public function extract()
    {
        $data['users'] = User::whereNotIn('role', ['admin', 'compliance'])->get();
        $data['source']  = SourceModel::all();
        $data['status']  = StatusModel::all();
        return view('admin.leads.extract', $data);
    }
    public function assigned()
    {
        // Retrieve source and status data
        $data['source'] = SourceModel::all();
        $data['status'] = StatusModel::all();
        $data['users'] = User::whereNotIn('role', ['admin', 'compliance'])->get();

        // Get the user ID and role
        $userId = Auth::user()->id;
        $role = Auth::user()->role;

        // Prepare the query
        $query = leadModel::query();

        // If the user is not an admin, filter leads by the assigned employee ID
        if ($role != 'admin') {
            $query->whereHas('assignleads', function ($q) use ($userId) {
                $q->where('employee_id', $userId);
            });
        }

        // Order by updated_at in descending order, with nulls first
        $query->with(['assignleads.user'])
            ->orderByRaw('updated_at IS NULL DESC, updated_at DESC')
            ->orderBy('id', 'desc');

        // Paginate the results
        $data['leads'] = $query->paginate(25);

        // Return the view with the data
        return view('admin.leads.list', $data);
    }
    public function assignedtoday()
    {
        // Retrieve source and status data
        $data['source'] = SourceModel::all();
        $data['status'] = StatusModel::all();

        // Get the user ID and role
        $userId = Auth::user()->id;
        $role = Auth::user()->role;

        // Prepare the query
        $query = leadModel::query();

        // If the user is not an admin, filter leads by the assigned employee ID
        if ($role != 'admin') {
            $query->whereHas('assignleads', function ($q) use ($userId) {
                $q->where('employee_id', $userId);
                $q->whereDate('created_at', now());
            });
        }

        // Order by updated_at in descending order, with nulls first
        $query->with(['assignleads.user'])
            ->orderByRaw('updated_at IS NULL DESC, updated_at DESC')
            ->orderBy('id', 'desc');

        // Paginate the results
        $data['leads'] = $query->paginate(25);

        // Return the view with the data
        return view('admin.leads.list', $data);
    }

    public function payment()
    {
        $data['quotations'] = ProjectQuotation::with(['phasename', 'leadInfo'])->orderby('id', 'desc')->get();
        // $data['leads'] = PaidAmountModel::with('leads')->orderby('paymen_received.id', 'desc')->get();
        return view('admin.leads.payment', $data);
    }
    public function assign(): View
    {
        // get total number of unassign leads
        $data['unassignleadscount'] = Leads::where('in_pool', 0)->leftjoin('assignleads', 'assignleads.lead_id', 'leads.id')->whereNull('assignleads.lead_id')->count();

        $data['leads'] = GlobalModel::getDataOrderByiDesc('leads');
        $data['users'] = GlobalModel::getDataOrderByiDesc('users', 'role', 'admin', '!=');
        $data['sources'] = GlobalModel::getDataOrderByiDesc('sources');
        return view('admin.leads.assign', $data);
    }
    public function unassignleadcount($data)
    {
        return $count['unassignleadscount'] = Leads::where('in_pool', 0)->leftjoin('assignleads', 'assignleads.lead_id', 'leads.id')->where('leads.is_duplicate', 0)->where('leads.source', $data)->whereNull('assignleads.lead_id')->count();
    }
    public function create(): View
    {
        $data['source']  = SourceModel::all();
        $data['status']  = StatusModel::all();

        return view('admin.leads.create', $data);
    }

    public  function delete($data)
    {
        $type = $data['type'];
        if ($type == 'activate') {
            return  leadModel::where('id', $data['id'])->update(['flag' => 1]);
        }
        if ($type == 'removes') {
            // return  PaidAmountModel::where('id', $data['id'])->delete();
            return  ProjectQuotation::where('id', $data['id'])->delete();
        }
        if ($type == 'deactivate') {
            return  leadModel::where('id', $data['id'])->update(['flag' => 0]);
        }


        if ($type == 'approve') {
            // return  PaidAmountModel::where('id', $data['id'])->update(['status' => 'Approved', 'approved_or_reject_date' => now()]);
            return  ProjectQuotation::where('id', $data['id'])->update(['status' => 1, 'approved_or_reject_date' => now()]);
        }
        if ($type == 'declined') {
            // return  PaidAmountModel::where('id', $data['id'])->update(['status' => 'Declined', 'approved_or_reject_date' => now()]);
            return  ProjectQuotation::where('id', $data['id'])->update(['status' => 2, 'approved_or_reject_date' => now()]);
        }

        if ($type == 'remove') {
            return  leadModel::where('id', $data['id'])->delete();
        }
    }

    public  function edit($data)
    {
        $lead['users'] = GlobalModel::getDataOrderByiDesc('users', 'role', 'admin', '!=');
        $lead['source']  = SourceModel::all();
        $lead['status']  = StatusModel::all();
        $lead['lead'] =  leadModel::editfunction($data);

        if (Auth::user()->role == 'admin') {
            $lead['phase']  =  Phase::where('lead_id', $data)->get();
            $lead['phase_receipts']  =  ProjectQuotation::with('phasename')->where('lead_id', $data)->get();
        } else {
            $lead['phase']  =  Phase::where('lead_id', $data)->where('add_by', Auth::user()->id)->get();
            $lead['phase_receipts']  =  ProjectQuotation::with('phasename')->where('add_by', Auth::user()->id)->where('lead_id', $data)->get();
        }



        $lead['leadhistory'] = LeadHistory::join('users', 'users.id', 'lead_history.add_by')->where('lead_history.lead_id', $data)->select('lead_history.*', 'users.name', 'users.role')->orderby('lead_history.id', 'asc')->get();

        //   
        $lead['callgiven'] = LeadHistory::join('users', 'users.id', 'lead_history.add_by')->where('lead_history.lead_id', $data)->where('lead_history.status', 'Call given')->select('lead_history.*', 'users.name', 'users.role')->orderby('lead_history.id', 'asc')->get();





        $lead['followup'] = LeadFollowUpModel::join('users', 'users.id', 'leads_followups.add_by')->where('leads_followups.lead_id', $data)->select('leads_followups.*', 'users.name', 'users.role')->orderby('leads_followups.id', 'desc')->get();



        $lead['payment'] = PaidAmountModel::join('users', 'users.id', 'paymen_received.add_by')->select('paymen_received.*', 'users.name', 'users.role')->where('lead_id', $data)->orderby('paymen_received.id', 'desc')->get();

        $query = leadModel::query();
        $role = Auth::user()->role;
        $userId = Auth::user()->id;
        $lead['readonly'] = '';



        // If the user is not an admin, filter leads by the assigned employee ID
        if ($role != 'admin') {
            $lead['readonly'] = 'readonly';

            $query->whereHas('assignleads', function ($q) use ($userId) {
                $q->where('employee_id', $userId);
            });
        }

        // Order by updated_at in descending order, with nulls first
        $query->with(['assignleads.user'])
            ->orderByRaw('updated_at IS NULL DESC, updated_at DESC')
            ->orderBy('id', 'desc');

        $nextOrPrevious = $query->pluck('id')->toArray();
        // Find the current lead's index in the array
        $currentIndex = array_search($data, $nextOrPrevious);

        // Determine the previous and next lead IDs
        $lead['previousLeadId'] = $nextOrPrevious[$currentIndex - 1] ?? $data;
        $lead['nextLeadId'] = $nextOrPrevious[$currentIndex + 1] ?? $data;


        return view('admin.leads.edit', $lead);
    }

    public function store($data)
    {
        $addby = Auth::user()->id;

        // Check for duplicate leads based on email and phone
        $duplicate = leadModel::where('email', $data['email'])
            ->orWhere('phone', $data['phone'])
            ->exists();

        $status = $duplicate ? '1' : '0';

        // $status = $duplicate ? 'Duplicate' : $data['status'];

        $data1['name'] = $data['name'];
        $data1['phone'] = $data['phone'];
        $data1['email'] = $data['email'];
        $data1['status'] = $data['status'];
        $data1['is_duplicate'] = $status;
        $data1['description'] = $data['description'];
        $data1['source'] = $data['source'];
        $data1['funds'] = $data['funds'] ?? '';
        $data1['demate'] = $data['demate'] ?? '';
        $data1['followup'] = $data['followup'] ?? '';
        $data1['add_by'] = $addby;
        $data1['created_at'] = now();
        $data1['unique_id'] = GlobalModel::getlastGFCode('leads');

        $query = leadModel::insertGetId($data1);

        if ($query) {
            if (!empty($data['followup'])) {
                LeadFollowUpModel::insert([
                    'lead_id' => $query,
                    'date' => $data['followup'],
                    'description' => $data['description'],
                    'add_by' => $addby,
                    'created_at' => now(),
                    'status' => $status,
                ]);
            }
            return response()->json(['code' => 200, 'message' => 'Lead has been created successfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public function update($data)
    {
        $addby =  Auth::user()->id;
        $status =  $data['status'] ?? '';

        $leadid = $data['user_id'];
        $data1['name'] =  $data['name'];
        $data1['phone'] =  $data['phone'];
        $data1['email'] =  $data['email'];
        $data1['status'] = $status;
        $data1['description'] =  $data['description'] ?? '';
        $data1['source'] =  $data['source'] ?? '';
        $data1['funds'] = $data['funds'] ?? '';
        $data1['demate'] =  $data['demate'] ?? '';
        $data1['updated_at'] = now();
        $getlastFollowUpdate =  leadModel::where('id', $leadid)->first();

        if ($getlastFollowUpdate->followup != $data['followup']) {
            $data1['followup'] = $data['followup'];
        }




        if ($data['employee_id'] != '') {

            $matchThese = ['lead_id' => $leadid];
            AssignLead::updateOrCreate($matchThese, ['employee_id' => $data['employee_id'], 'assign_by' => Auth::user()->id, 'lead_id' => $leadid]);
        }

        if ($getlastFollowUpdate->followup != $data['followup']) {
            LeadFollowUpModel::insert(['lead_id' => $leadid, 'date' => $data['followup'], 'description' => $data['description'], 'add_by' => $addby, 'created_at' => now(), 'status' =>  $status]);
        }
        if ($getlastFollowUpdate->followup == $data['followup'] && $getlastFollowUpdate->description != $data['description']) {
            // then store store descitption
            LeadHistory::insert(['lead_id' => $leadid, 'created_at' => now(), 'description' => $data['description'], 'add_by' => $addby, 'status' =>  $status]);
        }
        if (isset($data['paidamount']) && $data['paidamount'] > 0) {
            PaidAmountModel::insert(['lead_id' => $leadid, 'created_at' => now(), 'status' => 'pending', 'add_by' => $addby, 'payment' => $data['paidamount']]);
        }
        $query = leadModel::where('id', $leadid)->update($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' =>  'Lead has been updated succussfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    public function status($data)
    {
        $role = Auth::user()->role;
        $statusOptions = ['today', 'paid', 'modifiedtoday', 'todayfollowup', 'duplicate'];

        // Validate role and status data
        if (!in_array($data, $statusOptions)) {
            return abort(404);
        }
        $leads['source'] = SourceModel::all();
        $leads['status'] = StatusModel::all();

        $leads['users'] = User::whereNotIn('role', ['admin', 'compliance'])->get();

        $query = leadModel::with(['assignleads.user']);

        if (Auth::user()->role != 'admin') {
            $userId = Auth::user()->id;
            $query->whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            });
        }

        // Apply filters based on the status data
        switch ($data) {
            case 'today':
                $query->whereDate('created_at', now());
                break;
            case 'paid':
                $query->where('status', $data);
                break;
            case 'modifiedtoday':
                $query->whereDate('updated_at', now());
                break;
            case 'todayfollowup':
                date_default_timezone_set('Asia/Kolkata');
                $query->whereDate('followup', date('Y-m-d'));
                break;
            case 'duplicate':
                $query->where('is_duplicate', 1);
                break;
        }

        $leads['leads'] = $query->orderBy('id', 'desc')->paginate(25);

        return view('admin.leads.list', $leads);
    }



    public function filter($data)
    {
        $query = leadModel::with(['assignleads.user']);

        if (!in_array(Auth::user()->role,['admin','Manager'])) {
            $userId = Auth::user()->id;
            $query->whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            });
        }

        if (isset($data['employee_id'])) {
            $empid = $data['employee_id'];
            $query->whereHas('assignleads', function ($q) use ($empid) {
                $q->whereIn('employee_id', $empid);
            });
        }


        if (isset($data['status'])) {
            $query->whereIn('leads.status', $data['status']);
        }
        $createdat = $data['created'];

        if (isset($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('leads.unique_id', 'like', '%' . trim($data['search']) . '%')
                    ->orWhere('leads.phone', 'like', '%' . trim($data['search']) . '%')
                    ->orWhere('leads.name', 'like',  trim($data['search']) . '%');
            });
        }

        if (isset($data['source'])) {
            $query->whereIn('leads.source', $data['source']);
        }

        if (isset($data['from'])) {
            if ($createdat == 2) {
                $query->whereDate('leads.updated_at', '>=', $data['from']);
            } elseif ($createdat == 3) {
                $query->whereDate('leads.created_at', '>=', $data['from']);
                $query->whereNull('leads.updated_at');
            } else {
                $query->whereDate('leads.created_at', '>=', $data['from']);
            }
        }
        if (isset($data['to'])) {
            if ($createdat == 2) {
                $query->whereDate('leads.updated_at', '<=', $data['to']);
            } elseif ($createdat == 3) {
                $query->whereDate('leads.created_at', '<=', $data['to']);
                $query->whereNull('leads.updated_at');
            } else {
                $query->whereDate('leads.created_at', '<=', $data['to']);
            }
        }
        $totalCount = $query->count();

        $data['leads'] = $query->orderby('leads.id', 'desc')->get();

        $table = (string)view('admin.leads.table', $data)->render();
        return response()->json(['code' => 215, 'data' => $table, 'totalcount' => $totalCount]);
    }
    public function leadstatus($data)
    {
        
        $query = leadModel::with(['assignleads.user']);
        
        if (Auth::user()->role != 'admin') {
            $userId = Auth::user()->id;
            $query->whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            });
        }



        if (isset($data)) {
                if(Str::contains($data,'-')){
                 $data=   str_replace('-',' ',$data);
                }
                
                


            $query->whereIn('leads.status', [Str::title($data)]);
        }


        $lead['leads'] = $query->orderby('leads.id', 'desc')->paginate(50);
        return view('admin.leads.list', $lead);
    }
    public function extractFilter($data)
    {
        $query = leadModel::with(['assignleads.user'])->where('in_pool', 0);

        if (Auth::user()->role != 'admin') {
            $userId = Auth::user()->id;
            $query->whereHas('assignleads', function ($query) use ($userId) {
                $query->where('employee_id', $userId);
            });
        }

        if (isset($data['employee_id'])) {
            $empid = $data['employee_id'];
            $query->whereHas('assignleads', function ($q) use ($empid) {
                $q->whereIn('employee_id', $empid);
            });
        }


        if (isset($data['status'])) {
            $query->whereIn('leads.status', $data['status']);
        }
        $createdat = $data['created'];

        if (isset($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('leads.unique_id', 'like', '%' . trim($data['search']) . '%')
                    ->orWhere('leads.phone', 'like', '%' . trim($data['search']) . '%');
            });
        }

        if (isset($data['source'])) {
            $query->whereIn('leads.source', $data['source']);
        }

        if (isset($data['from'])) {
            if ($createdat == 2) {
                $query->whereDate('leads.updated_at', '>=', $data['from']);
            } elseif ($createdat == 3) {
                $query->whereDate('leads.created_at', '>=', $data['from']);
                $query->whereNull('leads.updated_at');
            } else {
                $query->whereDate('leads.created_at', '>=', $data['from']);
            }
        }
        if (isset($data['to'])) {
            if ($createdat == 2) {
                $query->whereDate('leads.updated_at', '<=', $data['to']);
            } elseif ($createdat == 3) {
                $query->whereDate('leads.created_at', '<=', $data['to']);
                $query->whereNull('leads.updated_at');
            } else {
                $query->whereDate('leads.created_at', '<=', $data['to']);
            }
        }

        $gettotalleads =  $query->select('id')->orderby('leads.id', 'desc')->count();
        if (isset($data['description'])) {
            // if descriotion is 1 means i have to delete the description and if it is 2 then do not delete
            // let us suppose if it 1  now check the leads and check their description in 
            $extractedLeads = $query->select('id')->orderby('leads.id', 'desc')->get();
            if (!empty($extractedLeads)) {
                foreach ($extractedLeads as $list) {
                    // now check in followupleads;
                    PoolHistory::insert(['lead_id' => $list->id, 'user_id' => $list->assignleads->employee_id, 'created_at' => now()]);
                    Leads::where('id', $list->id)->update(['in_pool' => 1, 'with_whom_pool' => $list->assignleads->employee_id]);
                    if ($data['description'] ==  1) {
                        LeadFollowUpModel::where('lead_id', $list->id)->whereIn('add_by', $data['employee_id'])->delete();
                    }
                    AssignLead::where('lead_id', $list->id)->delete();
                    if (isset($data['transferto'])) {
                        AssignLead::insert(['lead_id' => $list->id, 'employee_id' => $data['transferto'], 'created_at' => now(), 'assign_by' => Auth::user()->id, 'status' => 'Pending']);
                    }
                }
            }
        }


        $totalCount = $gettotalleads . ' leads and Extracted Successfully';

        $data['leads'] = $query->orderby('leads.id', 'desc')->get();



        $table = (string)view('admin.leads.table', $data)->render();
        return response()->json(['code' => 215, 'data' => $table, 'totalcount' => $totalCount]);
    }
    public function assignstore($data)
    {
        $getLeadsQuery = Leads::where('in_pool', 0)->leftJoin('assignleads', 'assignleads.lead_id', 'leads.id')
            ->whereNull('assignleads.lead_id');

        if ($data['source'] != null) {
            $getLeadsQuery->where('leads.source', $data['source']);
        }

        $getLeads = $getLeadsQuery->limit($data['count'])->select('leads.*')->get();

        if (!empty($getLeads)) {
            $insertData = [];
            $currentTime = now();
            $assignBy = Auth::user()->id;

            foreach ($getLeads as $leadlist) {
                $insertData[] = [
                    'employee_id' => $data['user_id'],
                    'lead_id' => $leadlist->id,
                    'created_at' => $currentTime,
                    'assign_by' => $assignBy,
                    'status' => 'Pending'
                ];
            }

            // Bulk insert to improve performance
            AssignLead::insert($insertData);
        }

        return response()->json(['code' => 200, 'message' => 'Leads Assign Successfully!']);
    }

    public function donwloadsampleexcel()
    {
        $filePath = public_path('sample/sample-leads.xlsx');
        return Response::download($filePath, 'sample-leads.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function phase($data)
    {

        $insert['total_amount']  = $data['totalSettlement'];
        $insert['lead_id'] =  $data['lead_id'];
        $insert['phase_name'] = $data['settlementfor'];
        $insert['add_by'] = Auth::user()->id;

        if ($data->hasFile('quotation')) {
            $file = $data->file('quotation');
            if ($file->isValid()) {
                $imageName = time() . '.pdf';
                $file->move(public_path('uploads/quotations/'), $imageName);
                $insert['quotation_pdf'] = "uploads/quotations/$imageName";
            } else {
                throw new \Exception("Invalid quotation file.");
            }
        } else {

            throw new \Exception("Quotation file is missing.");
        }
        if ($data->hasFile('recepit')) {
            $file = $data->file('recepit');
            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                // Use the real extension in the filename
                $imageName = time() . '.' . $extension;                $file->move(public_path('uploads/receipts/'), $imageName);
                $insert2['recepit'] = "uploads/receipts/$imageName";
            } else {
                throw new \Exception("Invalid quotation file.");
            }
        }
        $insert['created_at'] = now();
        $check =  Phase::where('lead_id', $data['lead_id'])->first();
        if (empty($check)) {
            $insert['main'] = 1;
        }

        $PhaseId = Phase::insertGetId($insert);

        //  now store the value  in the phase one

        $insert2['phase_id'] = $PhaseId;
        $insert2['amount'] = $data['advancePayment'] ?? 0;
        $insert2['balance'] = $data['balance'];
        $insert2['created_at'] = now();
        $insert2['lead_id'] =  $data['lead_id'];
        $insert2['add_by'] = Auth::user()->id;

        $phaseAdded =   ProjectQuotation::insert($insert2);
        if ($phaseAdded) {
            return response()->json(['code' => 200, 'message' => 'Quotation upploaded Successfully!']);
        } else {
            return response()->json(['code' => 500, 'message' => 'Something went wrong please try again ']);
        }
    }


    protected function handleFileUpload($file)
    {
        if ($file && $file->isValid()) {
            $imageName = time() . '.pdf';
            $file->move(public_path('uploads/quotations/'), $imageName);
            return "uploads/quotations/$imageName";
        }
    }

    public function existproject($id)
    {
        // $quotation =  ProjectQuotation::with('phasename')->where('lead_id', $id)->get();
        $quotation =  Phase::where('lead_id', $id)->get();
        if (count($quotation) > 0) {
            $data['phases'] =  $quotation;
            $tableView = view('admin.projects.table', $data)->render();
            // fetch phase
            return response()->json(['code' => 200, 'message' => $tableView]);
        } else {
            return response()->json(['code' => 401, 'message' => 'Oops! No Project has been alloted yet']);
        }
    }
}
