<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Phase;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index() {}
    public function create() {}

    public function store(TaskRequest $request)
    {


      

        try {
            $data['phase_id'] =  $request->post('phase_id');
            $data['lead_id'] =  $request->post('lead_id');
            $data['task_name'] =  $request->post('task_name');
            $data['pending_task_name'] =  $request->post('pending_task_name');
            $data['pending_task_date'] =  $request->post('pending_task_date');
            $data['task_status'] =  $request->post('task_status');
            $data['project_status'] =  $request->post('project_status');
            $data['description'] =  $request->post('description');
            $data['completed_date'] =  $request->post('completed_date');
            $data['created_at'] = now();

            // Associate the task with the authenticated user
            $data['user_id'] = Auth::user()->id;

            // Handle the file upload
            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');
                $filename = time() . '_' . $file->getClientOriginalName();
                $uploadPath = public_path('uploads/screenshots'); // Full path to 'public/uploads/screenshots'

                // Ensure the directory exists
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Move the file to the specified folder
                $file->move($uploadPath, $filename);

                // Save the relative path in the database
                $data['screenshot'] = 'uploads/screenshots/' . $filename;
            }

                 

            // Create the task
            $task = Task::insert($data);
            // get the phase name
            $phasename =  Phase::find($data['phase_id']);
            $emailData = [
                'phase_id' => $data['phase_id'],
                'phase_name' =>$phasename->phase_name,
                'pending_task_date'=>   $data['pending_task_date'],
                'lead_id' => $data['lead_id'],
                'task_name' => $data['task_name'],
                'task_status' => $data['task_status'],
                'project_status' => $data['project_status'],
                'description' => $data['description'],
                'completed_date' => $data['completed_date'],
                'screenshot' => isset($data['screenshot']) ? $data['screenshot'] : null,
            ];

            $to_name = Auth::user()->name;
            $title = $to_name . "  Reporting on " . date('d/m/Y');
            $to_email =  'bhavesh.kapoor@volvrit.com';
            $cc_emails = ['amit.gupta@volvrit.com', 'amit.taneja@volvrit.com','satyajit.gupta@volvrit.com']; // Add multiple CC email addresses

            if (Mail::send('emails.reporting', $emailData   , function ($message) use ($to_name, $to_email ,  $title,$cc_emails) {
                $message->to($to_email, 'Volvrit')
                    ->subject($title);
                $message->from('volvritreporting@gmail.com')->cc($cc_emails);
            })) {
                return response()->json(['code' => 200, 'message' => 'Code has been sent to your email!']);
            } else {
                return response()->json(['code' => 401, 'message' => 'Something went wrong with email server please try again later!']);
            }


            return response()->json([
                'code' => 200,
                'message' => 'Task Submitted successfully',
                'data' => $task
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create task',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update() {}
    public function destroy() {}
}
