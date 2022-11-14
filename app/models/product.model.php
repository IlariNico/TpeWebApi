<?php
class productModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_tpe;charset=utf8', 'root', '');
    }

    function getAll(){
        $query=$this->db->prepare("SELECT * FROM `productos`");
        $query->execute();
        $products=$query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function get($id){
        $query=$this->db->prepare("SELECT * FROM `productos` WHERE id=?");
        $query->execute([$id]);
        $product=$query->fetch(PDO::FETCH_OBJ);
        return $product;
    }
    
    function delete($id){
        $query=$this->db->prepare("DELETE FROM `productos` WHERE id=?");
        $query->execute([$id]);
    }

    function modify($data,$id){
        $query=$this->db->prepare("UPDATE productos SET nombre=?,imagen=?,descripcion=?,marca=?,precio=?,id_categoria=? WHERE ID=?");
        $query->execute([$data->nombre,$data->imagen,$data->descripcion,$data->marca,$data->precio,$data->id_categoria,$id]);
       
    }

    function insert($data){
        $query=$this->db->prepare("INSERT INTO `productos`( `nombre`, `imagen`, `descripcion`, `marca`, `precio`, `id_categoria`) VALUES (?,?,?,?,?,?)");
        $query->execute([$data->nombre,$data->imagen,$data->descripcion,$data->marca,$data->precio,$data->id_categoria]);
        return  $this->db->lastInsertId();
    }
}