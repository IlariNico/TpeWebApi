<?php
require_once './app/models/product.model.php';
require_once './app/views/api.view.php';
class productController{
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new productModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    function verify($data){
        return (empty($data->nombre) || empty($data->imagen) || empty($data->descripcion)|| empty($data->marca)|| empty($data->precio)|| empty($data->id_categoria));
    }

    private function getData() {
        return json_decode($this->data);
    }

  
    function modProd($params = null){
        $id=-1;
        if(count($params)==1)
            $id=$params[':ID'];
        if(is_numeric($id)&&$id>0){
            $product=$this->getData();
            $productdb=$this->model->get($id);
            $code=200;
            if($productdb!=false){
                if($this->verify($product)){
                    $code=400;
                    return $this->view->response("Complete los datos", $code);
                }
            
                else{
                    $this->model->modify($product,$id);
                    $product = $this->model->get($id);
                    $this->view->response($product, $code);
                }
            }
            else{
                $code=404;
                return $this->view->response("Id incorrecto", $code);
            }
        }
        else{
            $code=400;
            return $this->view->response("peticion incorrecta", $code);
        }
    }

    function insertProd($params = null) {
        $product = $this->getData();
        $code=201;
        if ($this->verify($product)) {
            $code=400;
            $this->view->response("Complete los datos", $code);
        } else {
            $id = $this->model->insert($product);
            $product = $this->model->get($id);
            $this->view->response($product, $code);
        }
    }

    function array_sort($array){
        
        $order= SORT_ASC;
        if(isset($_GET['orderby'])){
            if(($_GET['orderby']=="nombre")||($_GET['orderby']=="precio")||($_GET['orderby']=="ID")||($_GET['orderby']=="descripcion")||
                ($_GET['orderby']=="marca")||($_GET['orderby']=="id_categoria"))
                {
                    $orderby= $_GET['orderby'];
                    if(isset($_GET['desc'])&empty($_GET['desc']))
                        $order= SORT_DESC;
                    $aux=array();
                    if($orderby!="ID"){
                        foreach($array as $k=>$v){
                            $aux[$k]=strtolower($v->$orderby);
                        }
                        array_multisort($aux,$order,$array);
                    }
                    return $array;
                }
            else{
                return null;
            }
                
        }
        else 
            return $array;
        
       
    }
    
    function array_filter($array){
        $aux=null;
        if(isset($_GET['nombre'])&&(!empty($_GET['nombre']))){
            $filter=$_GET['nombre'];
            
            $aux=array();
            
            foreach($array as $key){
                if(($key->nombre)==$filter){
                    
                    array_push($aux,$key);
                }
            }
            return $aux;
        }
        return $array;
    }

    function paginate_array($array,$page,$pagination){
        if($page==null||$pagination==null){
            return $array;
        }
        
        $aux=array();
        $num=0;
        foreach($array as $key=>$v){
            if(($key>=$page*$pagination)&&($num<$pagination)){
                array_push($aux,$array[$key]);
                $num++;
                
            }
        }
        
        if($num<$pagination){
            return $aux;
        }
        
        return $aux;
    }

    function getPage(){
        $page=null;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        return $page;
    }

    function getPagination(){
        $pagination=null;
        if((isset($_GET['pagelimit'])))
            $pagination=$_GET['pagelimit'];
        return $pagination;
    }

    function getProducts($params = null) {
        $products = $this->model->getAll();
        $page = $this->getPage();
        $pagination = $this->getPagination();
        if((is_numeric($page)&&is_numeric($pagination))||($page==null&&$pagination==null)){
            $products=$this->array_sort($products);
            if($products==null){
                
                $code=400;
                return $this->view->response("peticion incorrecta",$code);
                
                
            }
            if($page>=0&&$pagination>=0){
                $products=$this->paginate_array($products,$page,$pagination);
                $products=$this->array_filter($products);
                $code=200;
            }
        }
        else{
            $code=400;
            return $this->view->response("peticion incorrecta",$code);
        }
        if(($products==null)){
            $code=404;
        }
        return $this->view->response($products,$code);
    }

    function getProduct($params = null) {
        
        
        $id=$params[':ID'];
        if(is_numeric($id)){
            $product = $this->model->get($id);
            $code=200;
            if($product==null){
                $code=404;
                return $this->view->response("id incorrecto",$code);
            }
            return $this->view->response($product,$code);
        }
        else{
            $code=400;
            return $this->view->response("peticion incorrecta",$code);
        }

    }

    function delProduct($params = null){
        $id=-1;
        if(count($params)==1)
            $id=$params[':ID'];
        if(is_numeric($id)&&$id>0){
            $product=$this->model->get($id);
            $code=200;
            if($product==null){
                $code=404;
                return $this->view->response("id incorrecto",$code);
            }
            $this->model->delete($id);
            return $this->view->response($product,$code);
        }
        else{
            $code=400;
            return $this->view->response("peticion incorrecta",$code);
        }
    }

}

