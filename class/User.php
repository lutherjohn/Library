<?php
class User{
	private $_db,
			$_data,
			$_sessionName,
			$_isLoggedIn,
			$_cookieName;
	
	public function __construct($user = null){
		$this->_db = DB::getInstance();
		
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');
		
		
		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);
				if($this->find($user)){
					$this->_isLoggedIn = true;
				}
				else{
					// process Logout
				}
			}
		}
		else{
			$this->find($user);
		}
		
	}
	
	/**
	update
	**/	
	public function update($fields = array(), $id = null){
		
		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->id;
		}
		
		if(!$this->_db->update('users', $id, $fields)){
			throw new Exception('There was a problem updating.');
		}
	}
	/**insert query for registration to database**/
	public function create_personnel($fields = array()){
		if(!$this->_db->insert('tbl_personnel', $fields)){
			throw new Exception('Adding personnel Failed, Please check your statement!!');
		}
	}

	public function create_student($fields = array()){
		if(!$this->_db->insert('tbl_student', $fields)){
			throw new Exception('Adding Student Failed, Please check your statement!!');
		}
	}	

	public function create_books($fields = array()){
		if(!$this->_db->insert('tbl_books', $fields)){
			throw new Exception('Adding Books Failed, Please check your statement!!');
		}
	}

	public function create_books_category($fields = array()){
		if(!$this->_db->insert('tbl_book_category', $fields)){
			throw new Exception('Adding Books Category Failed, Please check your statement!!');
		}
	}

	public function create_book_publisher($fields = array()){
		if(!$this->_db->insert('tbl_book_publisher', $fields)){
			throw new Exception('Adding Books Publisher Failed, Please check your statement!!');
		}
	}
	
	public function create_book_borrow($fields = array()){
		if(!$this->_db->insert('tbl_book_borrow', $fields)){
			throw new Exception('Book Borrow Failed, Please check your statement!!');
		}
	}
	
	public function create_book_unreturn($fields = array()){
		if(!$this->_db->insert('tbl_book_unreturn', $fields)){
			throw new Exception('Book Unreturn Failed, Please check your statement!!');
		}
	}
	
	public function create_book_reserved($fields = array()){
		if(!$this->_db->insert('tbl_book_reserved', $fields)){
			throw new Exception('Book reservation Failed, Please check your statement!!');
		}
	}
		
	public function create_users($fields = array()){
		if(!$this->_db->insert('users', $fields)){
			throw new Exception('Adding users Failed, Please check your statement!!');
		}
	}
	
	public function find($user = null){
		if($user){
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->get('users', array($field, '=', $user));
			
			if($data->count()){
				
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	
	
	
	
	/**Log in process**/
	public function login($username = null, $password = null, $remember = false){
		
		
		if(!$username && !$password && $this->exists()){
			Session::put($this->_sessionName, $this->data()->id);
		}
		else{
			$user = $this->find($username);
			
			if($user){
				if($this->data()->password === Hash::make($password, $this->data()->salt)){
					Session::put($this->_sessionName, $this->data()->id);
					
					if($remember){
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));
						
						if(!$hashCheck->count()){
							$this->_db->insert('users_session',array(
								'user_id' => $this->data()->id,
								'hash' => $hash						
							));
						}
						else{
							$hash = $hashCheck->first()->hash;
						}
						
						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					
					return true;
				}
			}
			
			
		}
		
		return false;
	}
	
	public function hasPermission($key){
		$group = $this->_db->get('groups', array('id', '=', $this->data()->group));
		
		if($group->count()){
			$permissions = json_decode($group->first()->permissions, true);
			if($permissions[$key] == true){
				return true;
			}
		}
		return false;
	}
	
	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}
	
	public function logout(){
		
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
		
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}
	
	public function data(){
		return $this->_data;
	}
	
	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}
}