<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Controller
 * @author      Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model("siam_akademik_model");
        //$this->load->model('rest_ws_model');        
    }

    function read_get($id=0){
        if(!empty($id))
        {
            $data = $this->db->get_where("pegawai", ['id' => $id])->row_array();
        }
        else
        {
            $data = $this->db->get("pegawai")->result();
        }
        $hasil = array("status"=>"success","data"=>$data);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($hasil), 200); 
    }
    function generate_post(){
        $input = $this->input->post("nama");
        if(!empty($input))
        {
            $nama_lengkap = rtrim($input);
            $all = explode(" ", $nama_lengkap);
            $jumlah_array = count($all);
            if($jumlah_array>1)
            {
                $depan = strtolower($all[0]).".".strtolower($all[$jumlah_array-1]);
            }
            else
            {
                $depan = strtolower($all[0]);
            }

            $cek = "SELECT * FROM pegawai WHERE username LIKE '$depan%' ORDER BY id DESC LIMIT 1";
            $cek_data = $this->db->query($cek);
            if($cek_data->num_rows()>0)
            {
                //$terakhir = substr($cek_data->row()->username, -1);
                $terakhir = preg_replace("/[^0-9]/", '', $cek_data->row()->username);

                if($terakhir)
                {
                    $sambung = $terakhir+1;
                }
                else
                {
                    $sambung = 1;
                }
            }
            else
            {
                $sambung = "";
            }

            $username = $depan.$sambung;
            $email = $username."@kalimat.ai";
            $data = array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'email' => $email
            );

            $this->db->insert('pegawai', $data);
            $id = $this->db->insert_id();
            $data = $this->db->get_where("pegawai", ['id' => $id])->row_array();
            $hasil = array("status"=>"success","data"=>$data);
        }
        else
        {
            $hasil = array("status"=>"error","error"=>"Inputan tidak sesuai");
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($hasil), 200); 
    }
}