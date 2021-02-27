<?php
include_once('connection.php'); 
class Db_Class{
    private $table_name = 'stock';
    function createUser(){
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