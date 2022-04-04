<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

http_response_code(200);

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

        return substr(bin2hex($uid), 0, $lenght);
    }
    public function create()
    {

        $Reference = $this->uniquReference();

        $data = json_decode(file_get_contents("php://input"));




        $this->loadModel('Pasien');
        $status = $this->Pasien->create($data, $Reference);
        // die(var_dump($status));
        if ($status) {
            //    echo json_encode(array('status' => 'success'));
            echo json_encode([http_response_code(200), $Reference]);
        } else {
            //    echo json_encode(array('status' => 'error'));
            // echo json_encode(http_response_code(500));
            // echo ("Error");
            return http_response_code(500);
        }
    }
    public function lgoin()
    {

        $data = json_decode(file_get_contents("php://input"));


        $this->loadModel('Pasien');
        $result = $this->Pasien->find($data->Reference);

        if ($result) {
            echo json_encode(['success', $data->Reference]);
        } else {
            echo json_encode([http_response_code(500), "Not found"]);
        }
    }
}
