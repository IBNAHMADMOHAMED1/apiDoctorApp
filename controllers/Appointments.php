<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class appointments extends Controller{
    public function index(){
        $this->loadModel('Appointment');
        $appointments = $this->Appointment->getAll();
        echo json_encode($appointments);
       die();
        $this->render('index', compact('appointments'));
    }
    public function create(){
        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
        $acc= $this->Appointment->create($data);
        if ($acc ) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function findAppointment($id){
        $this->loadModel('Appointment');
        // $data = json_decode(file_get_contents("php://input"));
        $result= $this->Appointment->find($id);
        if ($result) 
            {
                echo json_encode($result);

            } else {
                echo json_encode(array('status' => 'Not found'));
            }
         
    }
    public function update($id){
        // die(var_dump($id));
        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
        $acc= $this->Appointment->update($data,$id);
        if ($acc ) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function delete(){
        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
        $acc= $this->Appointment->delete($data->id);
        if ($acc ) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}