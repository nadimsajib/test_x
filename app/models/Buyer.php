<?php

class Buyer {

	private $db;
	private $table = 'buyers';

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAll($data = array())
	{
        $query = "SELECT * FROM {$this->table} ";
        if(!empty($data)){
            if(!empty($data['from_date']) && !empty($data['to_date'])){
                $query .= "WHERE entry_at BETWEEN '{$data['from_date']}' AND '{$data['to_date']}'";
            }
            else if(!empty($data['to_date'])){
                $query .= "WHERE entry_at <= '{$data['to_date']}'";
            }
            else if(!empty($data['from_date'])){
                $query .= "WHERE entry_at >= '{$data['from_date']}'";
            }
        }
        //print_r($query);exit;
		$this->db->query($query);
		return $this->db->resultSet();
	}

	public function store($data)
	{
        $query =  "INSERT INTO {$this->table} (";
        foreach($data as $key=>$value){
            $query .= " $key,";
        }
        $query = rtrim($query, ',');
        $query .= " ) VALUES (";
        foreach($data as $key=>$value){
            $query .= " '$value',";
        }
        $query = rtrim($query, ',');
        $query .= " ) ";
		$this->db->query($query);
        //print_r($this->db);exit;

		return $this->db->execute();
	}

	public function edit($id)
	{
		$this->db->query("SELECT * FROM {$this->table} WHERE id = {$id}");
		return $this->db->single();
	}

	public function update($id, $name, $email)
	{
		$this->db->query("UPDATE {$this->table} SET name = :name, email = :email WHERE id = {$id}");

		$this->db->bind(':name', $name);
		$this->db->bind(':email', $email);

		return $this->db->execute();
	}

	public function destroy($id)
	{
		$this->db->query("DELETE FROM {$this->table} WHERE id = {$id}");
		return $this->db->execute();
	}

}