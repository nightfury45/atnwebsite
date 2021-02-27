<?php
		echo '<p>Stock View only mode</p>'; 
		# Heroku credential 
		$host_heroku = "ec2-52-70-67-123.compute-1.amazonaws.com";
		$db_heroku = "d18ccjsmc2b6fp";
		$user_heroku = "tohgxktdsqguyu";
		$pw_heroku = "7432a249a31fd290580d1ffeffbbbc8856f74377bc9cbdee3abb24529e2e43de";
		# Create connection to Heroku Postgres
		$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
		$pg_heroku = pg_connect($conn_string);
		
		if (!$pg_heroku)
		{
			die('Error: Could not connect: ' . pg_last_error());
		}
class Db_Class{
    private $table_name = 'stock';
    function createItem(){
        $sql = "INSERT INTO stock(productid,productname,productprice,productamount) VALUES('".$this->cleanData($_POST['productid'])."','".$this->cleanData($_POST['productname'])."','".$this->cleanData($_POST['productprice'])."','".$this->cleanData($_POST['productamount'])."')";
        return pg_affected_rows(pg_query($sql));
    }

    function getStock(){             
        $sql ="select * from stock";
        return pg_query($sql);
    } 

    function deleteStock(){    
  
         $sql ="delete from stock where id='".$this->cleanData($_POST['productid'])."'";
        return pg_query($sql);
    } 

    function editStock($data=array()){       
     
        $sql = "update stock set productid='".$this->cleanData($_POST['productid'])."',productname='".$this->cleanData($_POST['productname'])."', productprice='".$this->cleanData($_POST['productprice'])."',productamount='".$this->cleanData($_POST['productamount'])."' where id = '".$this->cleanData($_POST['productid'])."' ";
        return pg_affected_rows(pg_query($sql));        
    }
?>