<?php

class buyerController extends Controller {

	public function index()
	{		
		$data['title'] = 'Buyer';
		$data['text'] = 'Data insert';
        $search_data = array();
        if($_POST){
            $search_data = $_POST;
        }
		$data['buyers'] = $this->model('Buyer')->getAll($search_data);

		$this->view('templates/header', $data);
		$this->view('buyers/index', $data);
		$this->view('templates/footer');
	}

	public function create()
	{
		$data['title'] = 'Buyer create';
		$this->view('templates/header', $data);
		$this->view('buyers/create');
	}

	public function store()
	{
		$data  = $_POST;
        $errors = [];
	
        if (!is_numeric($_POST['amount'])) {
            $errors['amount'] = 'amount is only numbers.';
        }
        if (!preg_match('/^[a-z0-9 ]+$/i', $_POST['buyer'])) {
            $errors['buyer'] = 'Buyer is only  text, spaces and numbers.';
        }
        if (!preg_match('/^[a-z ]+$/i', $_POST['city'])) {
            $errors['city'] = 'City is only text and numbers.';
        }
        if (strlen($_POST['buyer']) > 20) {
            $errors['buyer'] = 'Buyer is no more than 20 characters .';
        }
        if (strlen($_POST['note']) > 30) {
            $errors['note'] = 'Note is no more than 30 characters .';
        }
        if (!ctype_alpha($_POST['receipt_id'])) {
            $errors['receipt_id'] = 'receipt_id is only  text.';
        }
        $post_items = "";
        foreach($_POST['items'] as $items){
            if (!ctype_alpha($items)) {
                $errors['items'] = 'items is only  text.';
            }else{
                $post_items .= $items . ",";
            }
        }
        $post_items = rtrim($post_items, ',');
        $data['items'] = $post_items;
        $emailaddress = $_POST['buyer_email'];
        
        if (!filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
            // invalid emailaddress
            $errors['buyer_email'] = 'Valid Email is required.';
        }
        if (!preg_match('/^[0-9 ]+$/i', $_POST['phone'])) {
            $errors['phone'] = 'phone is only numbers.';
        }
        if (!preg_match('/^[0-9 ]+$/i', $_POST['entry_by'])) {
            $errors['entry_by'] = 'entry_by is only numbers.';
        }
        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            //user IP address
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            $data['buyer_ip'] = $ip;

            //hash with receipt_id
            $secretkey = "Test";
            $data['hash_key'] = hash( "sha512", $secretkey . $data['receipt_id']);

            //local date 
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
            $dt = $dt->format('Y-m-d');
            $data['entry_at'] = $dt;
            $this->model('Buyer')->store($data);
            $data['success'] = true;
            $data['message'] = 'Success!';
        }
        
        echo json_encode($data);
		//$this->redirect('buyer');
	}


}