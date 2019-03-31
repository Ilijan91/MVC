<?php
class SiteController extends Controller {

    public function getCategory(){

        $db=Database::getConnection();
        $res= $db->query("select * from category");
        $cats=[];
        while($cat = $res->fetch(PDO::FETCH_OBJ)){
            $cats[]=$cat;
        }
        return $cats;
    }

    public function getMovies($cat){

        $db=Database::getConnection();
        $filter = $cat == 0 ? "" : " where id_category ={$cat}";
        $res= $db->query("select * from movies{$filter}");
        $movies=[];
        
        while($movie = $res->fetch(PDO::FETCH_OBJ)){
            $movies[]=$movie;
        }
        return $movies;
    }
    public function index(){

        $this->loadView("top",["categoryes"=>$this->getCategory()]);
        $this->loadView("home");
        $this->loadView("footer");

    }

    public function help(){
        
        $this->loadView("top",["categoryes"=>$this->getCategory()]);
        $this->loadView("help");
        $this->loadView("footer");

    }

    public function movies(){
        
        $this->loadView("top",["categoryes"=>$this->getCategory()]);
        $cat=isset($_GET['cat']) ? $_GET['cat'] : 0;
        $this->loadView("movies",["movies"=>$this->getMovies($cat)]);
        $this->loadView("footer");

    }
    
    public function home(){
        
        $this->loadView("top",["categoryes"=>$this->getCategory()]);
        $this->loadView("home");
        $this->loadView("footer");

    }

}