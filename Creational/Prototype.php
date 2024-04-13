<?php

// Prototype (Прототип) - Интерфейс для клонирования объектов
interface DocumentPrototype {
    public function clone(): DocumentPrototype;
}

// ConcretePrototype (Конкретный прототип) - Класс для создания отчетов
class Report implements DocumentPrototype {
    private $title;
    private $content;

    public function __construct($title, $content) {
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function clone(): DocumentPrototype {
        // Создаем клон текущего объекта
        return new Report($this->title, $this->content);
    }
}

// ConcretePrototype (Конкретный прототип) - Класс для создания писем
/*class Letter implements DocumentPrototype {
    private $subject;
    private $body;

    public function __construct($subject, $body) {
        $this->subject = $subject;
        $this->body = $body;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getBody() {
        return $this->body;
    }

    public function clone(): DocumentPrototype {
        // Создаем клон текущего объекта
        return new Letter($this->subject, $this->body);
    }
}
*/

// Клиентский код
$reportPrototype = new Report("Отчет о продажах", "Продажи за текущий месяц: 1000$");

// Генерируем новый отчет путем клонирования прототипа
$newReport = $reportPrototype->clone();

echo "Старый отчет:\n";
echo "Заголовок: " . $reportPrototype->getTitle() . "\n";
echo "Содержимое: " . $reportPrototype->getContent() . "\n";

echo "Новый отчет:\n";
echo "Заголовок: " . $newReport->getTitle() . "\n";
echo "Содержимое: " . $newReport->getContent() . "\n";


/*
 * Пример симуляции паттерна "Прототип" в реальной жизни: Предположим, у нас есть приложение, которое генерирует документы различных типов (например, отчеты, письма и т. д.).
 * Вместо создания каждого нового документа с нуля, мы можем использовать паттерн "Прототип", чтобы клонировать уже существующие документы и затем вносить необходимые изменения в клонированных копиях.
 *
 *
 *
 * В данном примере у нас есть интерфейс DocumentPrototype, определяющий метод clone() для клонирования объектов.
 * Классы Report и Letter являются конкретными прототипами и реализуют этот интерфейс, предоставляя свою реализацию клонирования.
 * Клиентский код создает объекты путем клонирования прототипов Report и Letter и затем изменяет их свойства, чтобы получить новые объекты с нужной информацией.
 * В результате мы можем генерировать новые отчеты и письма на основе существующих прототипов, избегая повторного создания объектов с нуля.
 */


//  ОБЛЕГЧЁННЫЙ ВАРИАНТ

// Класс Product, который будет прототипом для клонирования
class Product implements Cloneable {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    // Метод для установки имени продукта
    public function setName($name) {
        $this->name = $name;
    }

    // Метод для получения имени продукта
    public function getName() {
        return $this->name;
    }

    // Метод для установки цены продукта
    public function setPrice($price) {
        $this->price = $price;
    }

    // Метод для получения цены продукта
    public function getPrice() {
        return $this->price;
    }

    // Метод клонирования объекта
    public function __clone() {}
}

// Создаем объект Product
$product = new Product("Sample Product", 100);

// Клонируем объект Product
$cloneProduct = clone $product;

// Изменяем свойства клонированного объекта
$cloneProduct->setName("Cloned Product");
$cloneProduct->setPrice(150);

// Выводим информацию о продуктах
echo "Original Product: {$product->getName()}, Price: {$product->getPrice()}\n";
echo "Cloned Product: {$cloneProduct->getName()}, Price: {$cloneProduct->getPrice()}\n";
