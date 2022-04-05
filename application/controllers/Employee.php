<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller{

public function __construct(){
    	parent:: __construct();
    	$this->load->model('Common_Model','cmodel');

    	
  Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed




	}
	public function index(){
		
     $tablename="employee_details";
     $where=array('is_delete'=>0);
		$res=$this->cmodel->getdata($tablename,$where);
		//print_r($res);
		 $response['status']=202;
				
		 $response['data']=$res;
		echo json_encode($response);
					exit;
		
	}
	public function add(){ 
	 
	$data=file_get_contents("php://input");
    $data1= json_decode($data);
     //print_r($data1);exit;
    
		$firstname=$data1->firstname;
		$lastname=$data1->lastname;
		$email=$data1->email;
		$address=$data1->address;
		$department=$data1->department;
		
		$dataEmp=array(
			'firstname'=>$firstname,
			'lastname'=>$lastname,
			'email'=>$email,
			'address'=>$address,
			'department'=>$department,
			'password'=>md5(123456),
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'is_delete'=>0

		);
	//	print_r($dataEmp);exit;
		$tablename='employee_details';
		$res=$this->cmodel->insertData($dataEmp);

		
		if($res>0){
			$response['status']=200;
			$response['data']=null;
			echo json_encode($response);
			exit;
		}


	}
	public function get(){


		$empId=$this->input->get('emp_id');
		$firstname=$this->input->get('firstname');
		$lastname=$this->input->get('lastname');
		$email=$this->input->get('email');
		$address=$this->input->get('address');
		$department=$this->input->get('department');
		$dataArray=array(
			'firstname'=>$firstname,
			'lastname'=>$lastname,
			'email'=>$email,
			'address'=>$address,
			'department'=>$department,
			'password'=>123456,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'is_delete'=>0

		);
		$where=array('emp_id'=>$empId);
		$res=$this->cmodel->getrowarray('employee_details',$where);
		if(!empty($res)){
      $response['status']=201;
			$response['data']=$res;
			echo json_encode($response);
			exit;

		}
		//print_r($res);
	}
	public function edit($empId){
		
    //echo $id;exit;
    $data=file_get_contents("php://input");
    $data1= json_decode($data);
     //print_r($data1);exit;
    
		$firstname=$data1->firstname;
		$lastname=$data1->lastname;
		$email=$data1->email;
		$address=$data1->address;
		$department=$data1->department;
		$dataArray=array(
			'firstname'=>$firstname,
			'lastname'=>$lastname,
			'email'=>$email,
			'address'=>$address,
			'department'=>$department,
			//'password'=>123456,
			//'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			//'is_delete'=>0

		);
		$where=array('emp_id'=>$empId);
		$tablename="employee_details";
		
		$res=$this->cmodel->updateData($where,$dataArray,$tablename);
		if($res){

				$response['status']=201;
			$response['data']=null;
			echo json_encode($response);
			exit;
		}
	}

	public function delete(){
       	$empId=$this->input->get('emp_id');
       	$dataArray=array('is_delete'=>1);
       	$where=array('emp_id'=>$empId);
       	$tablename="employee_details";
       	$res=$this->cmodel->updateData($where,$dataArray,$tablename);
		if($res){

				$response['status']=201;
			$response['data']=null;
			echo json_encode($response);
			exit;
		}

	}




}