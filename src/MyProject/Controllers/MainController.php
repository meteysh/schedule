<?php

namespace MyProject\Controllers;
use MyProject\Services\Db;
use MyProject\View\View;

class MainController
{
    private $view;

    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

// Создает массивы в диапазоне дат : выехал-вернулся  и сравнивает пересечения, если нашлось - выдает false

    public function chekdate($regId, $dateDep, $dateArrive, $dateDepTab, $dateArriveTab)
    {
        
      $transDate =  function ( $date) { return date('Y-m-d', $date); }; // callback функция              

        $dateLast = $this->calcDate($dateArrive, $regId); // дата прибытия на базу со стартом из региона

        $dateLastTab = $this->calcDate($dateArriveTab, $regId); // дата прибытия на базу со стартом из региона

        $arr1 = array_map($transDate, range (strtotime($dateDep), strtotime($dateLast), 86400)  ); // создаем массив диапазаона дата старт и возврата
        
        $arr2 = array_map($transDate,range (strtotime($dateDepTab), strtotime($dateLastTab), 86400)  );//создаем массив диапазаона дата старт и возврата из таблицы
        
        $arrayResult = array_intersect ($arr1,$arr2);       //пересечение массивов
        
        if(empty($arrayResult)){

            return true;
        }
        else{
             return false; 
        }
          
    }

    public function addtodb($courier, $city, $date1, $date2)
    {
        $paramsTiming = array(
            'id_couriers' => $courier,   // берем данные из формы
            'id_regions' => $city,
            'date_dep' => $date1,
            'date_arrive' => $date2
        );
        //подставляем в запрос через связку 
        $sqlTiming = "
            INSERT INTO timing SET         
            id_couriers = :id_couriers,
            id_regions = :id_regions,
            date_dep = :date_dep,
            date_arrive = :date_arrive";
        
        $this->db->query($sqlTiming, $paramsTiming); //добавляем в базу

    }

    public function add()
    {
        $cities = $this->db->query('SELECT id, region FROM regions'); //передаем города в вид
        
        $couriers = $this->db->query('SELECT id, firstname, secondname FROM couriers'); //передаем курьеров в вид
        
        $calc = new Maincontroller(); 

        $courierErr = false;
        
        if ( !empty($_GET['courier'])     // если все четыре поля заполнены - отправляем в базу
                    &&!empty($_GET['city']) 
                        && !empty($_GET['date1']) 
                            && !empty($_GET['date2']) )
        {
            /*ищем курьера в таблице расписания*/
            $timing = $this->db->query('SELECT id_couriers, date_dep, date_arrive FROM timing 
                        WHERE id_couriers=:id_couriers ', ['id_couriers' => $_GET['courier'] ]); 
            if(!empty($timing)){   /*если не нашли- смело добавляем! */

                /*выбираем поочередно курьеров по ID и у каждого найденного курьера смотрим совпадает ли диапазон 
                дат с уже назначенными датами для поездки из таблицы*/
            
                foreach($timing as $courier){
                    //заносим в массив  совпадения по датам как true/false
                $arrCourier[] = $this->chekdate($courier['id_couriers'], $_GET['date1'], $_GET['date2'], $courier['date_dep'], $courier['date_arrive']);
            
                }
                    //в базу отправим только если не найдется в таблице у данного курьера поездки на это время
                    if(!in_array(false , $arrCourier, true)){  
                
                        $this->addtodb($_GET['courier'], $_GET['city'], $_GET['date1'], $_GET['date2'] );   //добавляем в базу

                    }
                    else {
                        $courierErr = true;
                    }
            }
            else {   /*не нашли и смело добавляем! */
                $this->addtodb($_GET['courier'], $_GET['city'], $_GET['date1'], $_GET['date2'] );   //добавляем в базу
            }

            unset($_GET['courier']); // после отправки в базу сбрасываем форму
            unset($_GET['city']);
            unset($_GET['date1']);
            unset($_GET['date2']);
        }
        
        $this->view->renderHtml('main/add.php', ['couriers' => $couriers, 'cities' => $cities, 
                        'dateArrive' => $dateArrive, 'calc' => $calc, 'courierErr'=> $courierErr] );
    }

    public function calcDate( $date , int $regId){
        
        $arrayDate = $this->db->query('SELECT time FROM regions WHERE id = :id', ['id' => $regId]);
        
        foreach ($arrayDate as $element){
            $hours = $element;   // получаем количество часов из массива после базы
        }
        
        $workDays = (int)ceil($hours['time']/8); // считаем рабочие дни от времени
        
        $objDate = date_create($date); // создаем объект

        $weekend = 0;

            for ($i = $workDays; $i>0; $i--)
            { 
                   
            date_modify($objDate, '1 day'); // день +
            
            $startDateTemp = date_format($objDate, 'Y-m-d'); // обратно в формат string
            
            $chekDay = (int)date('w', strtotime($startDateTemp)); // считываем день недели
            
            ($chekDay == 0 || $chekDay ==6)? $weekend++ : ''; // количество выходных
            }
           
        $addDate = $workDays + $weekend;  // рабочие дни + выходные
			
        $startDate = date_create($date); // создаем объект

		date_modify( $startDate, $addDate.' days');  //прибавляем дни к исходной дате
        
		return date_format($startDate, 'Y-m-d') ; die;// выводим итоговую дату в нужном формате

    }

    
}
