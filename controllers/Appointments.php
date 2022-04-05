<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class appointments extends Controller
{


    // 
    public function index()
    {
        $this->loadModel('Appointment');
        $appointments = $this->Appointment->getAll();
        echo json_encode($appointments);
        die();
        $this->render('index', compact('appointments'));
    }
    public function addAppointment()
    {
        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
        $acc = $this->Appointment->create($data);
        if ($acc) {
            $appointment = $this->Appointment->get($data->Reference);;

            echo json_encode(['success', $appointment]);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function findAppointment($DateConsult)
    {
        $this->loadModel('Appointment');
        // $data = json_decode(file_get_contents("php://input"));
        $result = $this->Appointment->find($DateConsult);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    }
    public function update($id)
    {
        // die(var_dump($id));
        
        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
        // die(var_dump($data));
        $acc = $this->Appointment->update($data, $id);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function delete($id)
    {
        $this->loadModel('Appointment');
        // $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Appointment->delete($id);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    public function get($Reference)
    {
        $this->loadModel('Appointment');
        $acc = $this->Appointment->get($Reference);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function find($id)
    {
        
        $this->LoadModel('Appointment');
        $result = $this->Appointment->getOne($id);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }
}
