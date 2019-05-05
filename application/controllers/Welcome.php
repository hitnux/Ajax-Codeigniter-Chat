<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->view('welcome');
	}
    public function room(){
		$currentUser=$this->input->get("user");
		$this->load->model("message");
		$user=$this->addUser($currentUser);
		foreach ($user as $us){ 
			$userinfo=$us; 
		}
		$users=array();
		$messages=$this->message->getAll();
		$viewData = array("user" => $userinfo, "messages" => $messages);
        $this->load->view('room', $viewData);
	}
	private function addUser($username){
		$this->load->model("user");
		return $this->user->addUser($username);
	}
	public function control($username){
		$this->load->model("user");
		return $this->user->find($username);
	}
	public function nickname(){
		$username=$this->input->post("nickname");
		if(strlen($username)>2 and strlen($username)<14){
			$result=$this->control($username);
			if($result){
				echo "true";
			}else{
				echo "dolu";
			}
		}
	}
	public function sendMessage(){
		$userID=$this->input->post("user");
		$text=$this->input->post("message");
		$this->load->model("message");
		$this->message->send($userID,$text);
	}
	public function getMessages(){
		$date=date("Y-m-d h:i:sa",strtotime('-1 second',time()));
		$this->load->model("user");
		$userID=$this->input->post("user");
		$this->load->model("message");
		$result=$this->message->get($userID);
		foreach ($result as $res){ 
			$usernames=$this->user->getUsername($res->user_id);
			foreach ($usernames as $usname){
				echo '<div class="message-card"><b class="message-user">'.$usname->name.':</b>'.$res->text.'</div>';
			}
		}
	}
}
