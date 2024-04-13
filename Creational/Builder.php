<?php
// Product (Продукт) - Отчет
class Report {
    private $title;
    private $header;
    private $table;

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setHeader($header) {
        $this->header = $header;
    }

    public function setTable($table) {
        $this->table = $table;
    }

    public function show() {
        echo "Заголовок: " . $this->title . "\n";
        echo "Шапка: " . $this->header . "\n";
        echo "Таблица: " . $this->table . "\n";
    }
}

// Builder (Строитель) - Интерфейс для создания отчета
interface ReportBuilder {
    public function setTitle();
    public function setHeader();
    public function setTable();
    public function getReport(): Report;
}

// ConcreteBuilder (Конкретный строитель) - Создание отчета в стиле "Простой"
class SimpleReportBuilder implements ReportBuilder {
    private $report;

    public function __construct() {
        $this->report = new Report();
    }

    public function setTitle() {
        $this->report->setTitle("Простой отчет");
    }

    public function setHeader() {
        $this->report->setHeader("Простая шапка");
    }

    public function setTable() {
        $this->report->setTable("Простая таблица");
    }

    public function getReport(): Report {
        return $this->report;
    }
}

// ConcreteBuilder (Конкретный строитель) - Создание отчета в стиле "Сложный"
class ComplexReportBuilder implements ReportBuilder {
    private $report;

    public function __construct() {
        $this->report = new Report();
    }

    public function setTitle() {
        $this->report->setTitle("Сложный отчет");
    }

    public function setHeader() {
        $this->report->setHeader("Сложная шапка");
    }

    public function setTable() {
        $this->report->setTable("Сложная таблица");
    }

    public function getReport(): Report {
        return $this->report;
    }
}

// Director (Директор) - Управление процессом сборки отчета
class ReportDirector {
    private $builder;

    public function __construct(ReportBuilder $builder) {
        $this->builder = $builder;
    }

    public function buildReport() {
        $this->builder->setTitle();
        $this->builder->setHeader();
        $this->builder->setTable();
    }

    public function getReport(): Report {
        return $this->builder->getReport();
    }
}

// Клиентский код
$simpleBuilder = new SimpleReportBuilder();
$complexBuilder = new ComplexReportBuilder();

$director = new ReportDirector($simpleBuilder);
$director->buildReport();
$simpleReport = $director->getReport();
$simpleReport->show();

/*
 * Пример симуляции паттерна "Строитель" в реальной жизни: Представьте, что у вас есть класс для создания сложных отчетов.
 * Отчеты могут иметь различные стили, форматы, заголовки, таблицы и т. д.
 * Вы можете использовать шаблон "Строитель", чтобы создавать отчеты с разными конфигурациями, а директор может управлять процессом сборки отчетов в зависимости от выбранной конфигурации.
 *
 *
 *
 * В данном примере у нас есть класс Report, представляющий отчет, и интерфейс ReportBuilder, определяющий методы для создания отчета в различных стилях.
 * У нас есть конкретный строитель - SimpleReportBuilder, который реализуют интерфейс ReportBuilder и создают отчеты в простом и сложном стиле соответственно.
 * Также у нас есть класс ReportDirector, который управляет процессом сборки отчета с помощью строителя.
 * Клиентский код создает отчеты в разных стилях с помощью директора и строителей.
 */


//  ОБЛЕГЧЁННЫЙ ВАРИАНТ

// Класс продукта
class Product {
    private $name;
    private $size;
    private $color;

    public function setName($name) {
        $this->name = $name;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getDescription() {
        return "Product: {$this->name}, Size: {$this->size}, Color: {$this->color}";
    }
}

// Интерфейс строителя продукта
interface ProductBuilder {
    public function setName($name);
    public function setSize($size);
    public function setColor($color);
    public function getProduct();
}

// Конкретный строитель продукта
class ConcreteProductBuilder implements ProductBuilder {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function setName($name) {
        $this->product->setName($name);
    }

    public function setSize($size) {
        $this->product->setSize($size);
    }

    public function setColor($color) {
        $this->product->setColor($color);
    }

    public function getProduct() {
        return $this->product;
    }
}

// Директор, который управляет процессом создания продукта
class Director {
    public function buildProduct(ProductBuilder $builder) {
        $builder->setName('Sample Product');
        $builder->setSize('Large');
        $builder->setColor('Red');
    }
}

// Используем паттерн Строитель
$builder = new ConcreteProductBuilder();
$director = new Director();

$director->buildProduct($builder);
$product = $builder->getProduct();

echo $product->getDescription();
