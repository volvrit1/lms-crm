<?php

namespace App\Http\Controllers\admin\project;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectInterface;
    public function __construct(ProjectInterface $projectInterface)
    {
        $this->projectInterface = $projectInterface;
    }

    public function index()
    {
        return $this->projectInterface->index();
    }

    public function detail(Request $request)
    {
        return  $this->projectInterface->detail($request->id);
    }

    public function getbalance(Request $request)
    {
        return  $this->projectInterface->getbalance($request->id);
    }
    public function updatepayment(Request $request)
    {
        return  $this->projectInterface->updatepayment($request->all());
    }
    public function members(Request $request){
        return  $this->projectInterface->members($request->all());

    }
    public  function assign(Request $request){
        return  $this->projectInterface->assign($request->all());

    }
}
