<?php include __DIR__ . '/../header.php'; ?>
    <h1>Форма добавления данных о поездке курьера </h1>  
            <form name="timing" action="" method="get">
                <div class="col-auto col-3">
                    <label class="mr-sm-2" for="courier">Курьер</label>
                    <select name="courier" class="custom-select mr-sm-2" id="courier" >
                        <option selected>Выберите</option>
                        <?php foreach ($couriers as $courier): ?>
                            <option value="<?=$courier[id]?>"
                            <?=!empty($_GET) && $_GET["courier"]==$courier[id]?" selected=\"selected\"":""?> >
                                    <?=$courier[firstname].' '.$courier[secondname]?> </option>
                        <?php endforeach; ?>
                    </select>
                    <?if($courierErr){?><p class='text-danger'>У выбранного курьера уже намечена поездка на выбранные даты</p><?};?>
                </div>
                <div class="col-auto col-3">
                    <label class="mr-sm-2" for="city">Пункт назначения</label>
                    <select name="city" class="custom-select mr-sm-2" id="city" onChange='document.timing.submit();'>
                        <option selected>Выберите</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?=$city[id]?>"
                            <? if(!empty($_GET) && $_GET["city"]==$city[id]){ echo " selected=\"selected\""; $cityId = $city[id];} 
                               else {"";}?>><?=$city[region]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-3">
                    <label for="date1">Дата выезда с центрального склада</label>
                    <input type="date" name="date1" class="form-control" id="date1" 
                                value="<?if($_GET['date1']!=''){ echo $_GET['date1'];}?>"  onChange='document.timing.submit();' >
                </div>
                <div class="form-group col-3">
                    <label for="date2">Планируемая дата прибытия</label>  
                    <input type="date" style="pointer-events: none;" name="date2" 
                                value="<?if(!empty($_GET['date1']) && !empty($cityId)){ echo $calc->calcDate($_GET['date1'], $cityId);}?>" 
                                        class="form-control" id="date2" >
                </div>
                
                <button type="submit" class="btn btn-primary ">Добавить</button>
                
            </form>
            
<?php include __DIR__ . '/../footer.php'; ?>