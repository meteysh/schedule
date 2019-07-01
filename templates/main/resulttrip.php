<?php include __DIR__ . '/../header.php'; ?>

<form method="GET">
    <p>По умолчанию сортировка в отчете по поездкам идет по курьерам, <br>для сортировки по регионам поставьте галочку</p>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="switch1" name='switch' value='true'>
        <label class="form-check-label" for="switch1">По региону</label>
    </div>
    <br>
    <button type="submit" name = "buttonOne" value="submit" class="btn btn-primary ">Отчет по поездкам</button>
    <button type="submit" name = "buttonTwo" value="submit" class="btn btn-primary ">Отчет по свободным курьерам</button>
</form>
<? if (!empty($_GET['buttonOne'])){?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Курьер</th>
      <th scope="col">Место нахождения на текущий день</th>
      <th scope="col">Дата выезда</th>
      <th scope="col">Дата прибытия на базу</th>
    </tr>
  </thead>
  <tbody> 
    <?php foreach ($reportTable as $rep): ?>
        <tr>
            <th scope="row"><?=$rep['id']?></th>
            <td><?=$rep['secondname'].' '.$rep['firstname']?></td>
            <td><?=$rep['location']?></td>
            <td><?=$rep['date_dep']?></td>
            <td><?=$rep['datetobase']?></td>
        </tr>                       
    <?php endforeach; ?>
  </tbody>
</table>
<? } ?> 

<? if (!empty($_GET['buttonTwo'])){?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Курьер</th>
      <th scope="col">Дата планируемой поездки</th>
    </tr>
  </thead>
  <tbody> 
    <?php foreach ($reportTableFree as $repo): ?>
        <tr>
            <td><?=$repo['secondname'].' '.$repo['firstname']?></td>
            <td><?= $repo['date_dep']=== NULL ? 'Свободен': $repo['date_dep']?></td>
        </tr>                       
    <?php endforeach; ?>
  </tbody>
</table>
<? } ?> 
<?php include __DIR__ . '/../footer.php'; ?>