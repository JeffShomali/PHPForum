<?php

class Topic {
     //Initialize the DB variable
     private $db;

     /**
      * Constructor
      */
     public function __construct(){
          $this->db = new Database;
     }

     /**
      *  Get All Topics
      */
      public function getAllTopics(){
           $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
                              INNER JOIN users
                              ON topics.user_id = users.id
                              INNER JOIN categories
                              ON topics.category_id = categories.id;
                              ORDER BY create_date DESC
                               ");
          //Assign Result
          $results = $this->db->resultset();
          return $results;
      }
      /**
       * [Get Total Number of Topics]
       * @return [type] [description]
       */
       public function getTotalTopics(){
		$this->db->query('SELECT * FROM topics');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

      /**
       * [Get Total Number of Categories]
       * @return [type] [description]
       */
      public function getTotalCategories() {
           $this->db->query('SELECT * FROM categories');
           $rows = $this->db->resultset();
           return $this->db->rowCount();
      }

      /**
       * [Get Category By ID]
       * @param  [type] $category_id [description]
       * @return [type]              [description]
       */
      public function getCategory($category_id){
		$this->db->query("SELECT * FROM categories WHERE id = :category_id
		");
		$this->db->bind(':category_id', $category_id);

		//Assign Row
		$row = $this->db->single();

		return $row;
	}

     /**
      * [Get Topics By Category]
      * @param  [type] $category_id [description]
      * @return [type]              [description]
      */
     public function getByCategory($category_id){
		$this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.category_id = :category_id
		");
		$this->db->bind(':category_id', $category_id);

		//Assign Result Set
		$results = $this->db->resultset();

		return $results;
	}

     /**
      * Get Toppics By Username
      * @param  [type] $user_id [description]
      * @return [type]          [description]
      */
     public function getByUser($user_id){
		$this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.user_id = :user_id
		");
		$this->db->bind(':user_id', $user_id);

		//Assign Result Set
		$results = $this->db->resultset();

		return $results;
	}

      /**
       * [getTotalReplies description]
       * @param  [type] $topic_id [description]
       * @return [type]           [description]
       */
      public function getTotalReplies($topic_id) {
           $this->db->query('SELECT * FROM replies WHERE topic_id =' .$topic_id);
           $rows = $this->db->resultset();
           return $this->db->rowCount();
      }

      /**
       * [Get Topic By ID]
       * @param  [type] $id [description]
       * @return [type]     [description]
       */
       public function getTopic($id){
		$this->db->query("SELECT topics.*, users.username, users.name, users.avatar FROM topics
						INNER JOIN users
						ON topics.user_id = users.id
						WHERE topics.id = :id
		");
		$this->db->bind(':id', $id);

		//Assign Row
		$row = $this->db->single();

		return $row;
	}

     /**
      * Get Topic Replies
      * @param  [integer] $topic_id [description]
      * @return [array]           [description]
      */
     public function getReplies($topic_id){
         $this->db->query("SELECT replies.*, users.* FROM replies
                             INNER JOIN users
                             ON replies.user_id = users.id
                             WHERE replies.topic_id = :topic_id
                             ORDER BY create_date ASC
         ");
         $this->db->bind(':topic_id', $topic_id);

         //Assign Result Set
         $results = $this->db->resultset();

         return $results;
    }

    /**
     * [Create Toppic]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    	public function create($data){
    		//Insert Query
    		$this->db->query("INSERT INTO topics (category_id, user_id, title, body,last_activity)
    					   VALUES (:category_id, :user_id, :title,:body,:last_activity)");
    		//Bind Values
    		$this->db->bind(':category_id', $data['category_id']);
    		$this->db->bind(':user_id', $data['user_id']);
    		$this->db->bind(':title', $data['title']);
    		$this->db->bind(':body', $data['body']);
    		$this->db->bind(':last_activity', $data['last_activity']);

          //Execute Query
    		if($this->db->execute()){
    			return true;
    		} else {
    			return false;
    		}
    	}

     /**
      * [reply to topic]
      * @param  [type] $data [description]
      * @return [type]       [description]
      */
	public function reply($data){
		//Insert Query
		$this->db->query("INSERT INTO replies (topic_id, user_id, body)
					VALUES (:topic_id, :user_id, :body)");
		//Bind Values
		$this->db->bind(':topic_id', $data['topic_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':body', $data['body']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}

}//end class
