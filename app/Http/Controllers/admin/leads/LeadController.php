<?php

namespace App\Http\Controllers\admin\leads;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Repositories\leads\LeadInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;


class LeadController extends Controller
{
    protected $leadinterface;
    public function __construct(LeadInterface $leadinterface)
    {
        $this->leadinterface = $leadinterface;
    }


    public function import(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Excel::import(new LeadsImport, $request->file('file'));

        return redirect()->route('leads.all')->with('success', 'Leads imported successfully.');
    }

    public function leadstatus(Request $request)
    {
        return $this->leadinterface->leadstatus($request->slug);
    }

    public function index()
    {
        return $this->leadinterface->index();
    }
    public function poolindex()
    {
        return $this->leadinterface->poolindex();
    }
    public function assigned()
    {
        return $this->leadinterface->assigned();
    }
    public function assignedtoday()
    {
        return $this->leadinterface->assignedtoday();
    }
    public function status(Request $request)
    {
        return $this->leadinterface->status($request->status);
    }
    public function create()
    {
        return $this->leadinterface->create();
    }
    public function store(LeadRequest $data)
    {
        return $this->leadinterface->store($data);
    }
    public function edit(Request $request)
    {
        return  $this->leadinterface->edit($request->id);
    }
    public function update(LeadRequest $data)
    {
        return  $this->leadinterface->update($data);
    }

    public function delete(Request $request)
    {
        return  $this->leadinterface->delete($request);
    }

    public function extract()
    {
        return $this->leadinterface->extract();
    }
    public function assign()
    {

        return  $this->leadinterface->assign();
    }
    public function assignleadcount(Request $request)
    {
        return  $this->leadinterface->unassignleadcount($request->value);
    }
    public function assignstore(Request $request)
    {
        return  $this->leadinterface->assignstore($request);
    }
    public function donwloadsampleexcel()
    {
        return  $this->leadinterface->donwloadsampleexcel();
    }
    public function filter(Request $request)
    {
        return  $this->leadinterface->filter($request->all());
    }
    public function extractFilter(Request $request)
    {
        return  $this->leadinterface->extractFilter($request->all());
    }
    public function payment()
    {
        return  $this->leadinterface->payment();
    }
    public function makeCall(Request $request)
    {
       
    }

    public function phase(Request $request){
        return $this->leadinterface->phase($request);
    }

    public function existproject(Request $request){
        return $this->leadinterface->existproject($request->id);
    }

    
}
