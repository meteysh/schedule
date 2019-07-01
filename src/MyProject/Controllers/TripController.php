<?php

namespace MyProject\Controllers;
use MyProject\Services\Db;
use MyProject\View\View;

class TripController
{
    private $view;

    private $db;

    private $toDay;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
        $this->toDay = date('Y-m-d');
    }

    public function tripreport()
    {
        $sortField = false;
        if($_GET['switch'] == true){ $sortField = true;}
        $sortField === false ?$sortWay = 'c.secondname' : $sortWay = 'r.region'; 

        $sqlReport = 'SELECT t.id, c.firstname, c.secondname, r.id AS reg_id, 
                                region, t.date_dep, t.date_arrive FROM timing t            
                                    JOIN couriers c ON t.id_couriers = c.id
                                        JOIN regions r ON t.id_regions = r.id ORDER BY '.$sortWay ;        
        $reportTable = $this->db->query($sqlReport);

        $toBase = new MainController;

        $this->toDay = date('Y-m-d');
        //echo "<pre>"; var_dump($this->toDay  );die; echo "</pre>";
        foreach($reportTable as $key => &$itemArr){
              /*в новый элемент добавляем дату прибытия на базу*/              
            $itemArr['datetobase']= $toBase->calcDate($itemArr['date_arrive'], $itemArr['reg_id']); 

            $itemArr['location'] = $this->tripCalc($itemArr['date_dep'], $itemArr['date_arrive'], $itemArr['reg_id'], $itemArr['region'] );

            if(  !(strtotime($this->toDay) >= strtotime($itemArr['date_dep']) && strtotime($this->toDay) <= strtotime($itemArr['datetobase'])) ){

            $itemArr['date_dep'] = '--';

            $itemArr['datetobase'] = '--';
            }
        }
        

        

        $reportTableFree = $this->db->query('SELECT  secondname, firstname, date_dep
                                FROM couriers c LEFT OUTER JOIN timing t ON c.id = t.id_couriers');

            foreach($reportTableFree as &$date){ 
                                
            if( ($date['date_dep'] ) < date('Y-m-d') ) { 
                $date['date_dep'] = 'не планируется' ; 
            } 
        }

        $this->view->renderHtml('main/resulttrip.php', ['reportTable' => $reportTable, 'tripCalc' => $tripCalc, 'reportTableFree' => $reportTableFree]);
    }

    public function tripcalc($dateDep, $dateArrive, $regId, $region)
    {
        
        

        $time = new MainController;
        
        $dateToBase = $time->calcDate($dateArrive, $regId); // дата прибытия на базу со стартом из региона
       
        if(strtotime($this->toDay) >= strtotime($dateDep) && strtotime($this->toDay) <= strtotime($dateToBase) ){

            return $region;
        }
        else{
            return 'На базе';
        }
    }
}
