<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


class Pasiens extends Controller 
{
    /**
     * 
     *
     * @return void
     */

public function uniquReference($lenght = 8)
{

        
        $bytes = random_bytes(ceil($lenght / 2));
        $uid = uniqid($bytes, true);
        
        return substr(bin2hex($uid), 9, $lenght);
        
}
public function create()
{   
    
    $Reference = $this->uniquReference();

    $data = json_decode(file_get_contents("php://input"));
 
    
   
    
    $this->loadModel('Pasien');
   $acc= $this->Pasien->create($data,$Reference);

   if ($acc ) {
       echo json_encode(array('status' => 'success'));
   } else {
       echo json_encode(array('status' => 'error'));
   }
    
}
public function findPasien ()
{
    
        $data = json_decode(file_get_contents("php://input"));
       
        $this->loadModel('Pasien');
        $result= $this->Pasien->find($data->Reference);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(array('status' => 'error'));
        }
      
    
}
}