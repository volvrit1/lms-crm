<?php

use App\Http\Controllers\admin\leads\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::prefix('admin/leads')->middleware([AuthenticateMiddleware::class])->group(function(){
    Route::get('/',[LeadController::class,'index'])->name('leads.all');
    Route::get('/pool-leads',[LeadController::class,'poolindex'])->name('leads.pool');
    Route::get('/status/{status}',[LeadController::class,'status']);
    Route::get('/create',[LeadController::class,'create'])->name('leads.create');
    Route::post('/store',[LeadController::class,'store'])->name('leads.store');
    Route::get('/edit/{id}',[LeadController::class,'edit']);
    Route::post('/update',[LeadController::class,'update'])->name('leads.update');
    Route::post('/delete/{id}',[LeadController::class,'delete']);
    Route::post('/import', [LeadController::class, 'import'])->name('leads.import');
    Route::get('/assign', [LeadController::class, 'assign'])->name('leads.assign');
    Route::get('/lead-status/{slug}', [LeadController::class, 'leadstatus'])->name('leads.status');

    Route::post('/assignleadcount', [LeadController::class, 'assignleadcount']);
    Route::get('/assigned', [LeadController::class, 'assigned'])->name('leads.assigned');
    Route::get('/today-leads', [LeadController::class, 'assignedtoday'])->name('leads.assigned.today');
    Route::post('/assignstore', [LeadController::class, 'assignstore'])->name('leads.assignstore');
    Route::post('/filterdata', [LeadController::class, 'filter'])->name('filter.leads');
    Route::get('/payment', [LeadController::class, 'payment'])->name('lead.payments');
    Route::get('/donwloadsampleexcel', [LeadController::class, 'donwloadsampleexcel'])->name('leads.sample-excel');
    Route::post('/make-call', [LeadController::class, 'makeCall'])->name('make-call');
    Route::get('/extract', [LeadController::class, 'extract'])->name('leads.extract');
    Route::post('/extract-leads', [LeadController::class, 'extractFilter'])->name('extract.leads');
    Route::post('/project-phase',[LeadController::class,'phase'])->name('leads.phase.quoatation');
    Route::post('/exist-project',[LeadController::class,'existproject']);

});





?>