<?php 
namespace App\Repositories\leads;

interface LeadInterface{
    public function index();
    public function poolindex();
    public function extract();
    public function assign();
    public function payment();
    public function leadstatus($data);
    public function assigned();
    public function assignedtoday();
    public function store($data);
    public function edit($data);
    public function create();
    public  function delete($data);
    public  function update($data);
    public  function status($data);
    public  function unassignleadcount($data);
    public  function filter($data);
    public  function extractFilter($data);
    public  function assignstore($data);
    public  function donwloadsampleexcel();
    public function phase($data);
    public function existproject($data);

}

?>
