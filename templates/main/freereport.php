<?php include __DIR__ . '/../header.php'; ?>
    <h1>Формирование отчета по свободным курьерам на текущую дату</h1> 
        <form>
            <div class="form-group col-3">
                <label for="courier3">Курьер</label>
                <input type="text" class="form-control" id="courier3" placeholder="Фамилия">
            </div>
            <div class="form-group col-3">
                <label for="date3">Планируемая дата поездки (если есть)</label>
                <input type="date" class="form-control" id="date3" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Отчет</button>
        </form>
<?php include __DIR__ . '/../footer.php'; ?>