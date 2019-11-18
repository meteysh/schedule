Необходимо реализовать расписание поездок курьеров с центрального склада в Ростове-на-Дону в регионы России. Можно реализовать на чистом php или на любом фреймфорке. Данные должны храниться в базе данных в 3х таблицах:

Таблица с курьерами

Таблица с регионами с указанием длительности поездки в каждый регион в одну сторону

Таблица расписания поездок в регионы

Список регионов, в которые осуществляются перевозки:

Санкт-Петербург

Уфа

Нижний Новгород

Владимир

Кострома

Екатеринбург

Ковров

Воронеж

Самара

Астрахань

Необходимый функционал:

Форма добавления данных о поездке курьера с полями:

Курьер

Пункт назначения

Дата выезда с центрального склада

Планируемое время прибытия (рассчитывается автоматически по данным из таблицы 2)

Кнопка для формирования отчета по поездкам по курьерам на текущую дату с полями:

Курьер

Место нахождения на текущий день

Дата выезда

Дата прибытия

Кнопка для формирования отчета по свободным курьерам на текущую дату с полями:

Курьер

Планируемая дата поездки (если есть)

Один курьер может находиться одновременно только в одной поездке. 
Базу изначально необходимо заполнить тестовыми данными при помощи скрипта. Курьеров - минимум 10.