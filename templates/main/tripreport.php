<?php include __DIR__ . '/../header.php'; ?>
        <h1> Формирование отчета по поездкам по курьерам на текущую дату</h1> 
        <form>
            <div class="form-group col-3">
                <label for="courier">Курьер</label>
                <input type="text" class="form-control" id="courier" placeholder="Фамилия">
            </div>
            <div class="form-group col-3">
                <label for="point1">Место нахождения на текущий день</label>
                <input type="text" class="form-control" id="point1" placeholder="город">
            </div>
            <div class="form-group col-3">
                <label for="date2">Дата выезда</label>
                <input type="date" class="form-control" id="date2" placeholder="">
            </div>
            <div class="form-group col-3">
                <label for="date3">Дата прибытия</label>
                <input type="date" class="form-control" id="date3" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Отчет</button>
        </form>
<?php include __DIR__ . '/../footer.php'; ?>