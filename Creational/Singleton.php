<?php

class DatabaseConnection {
    private static $instance; // Статическая переменная для хранения экземпляра класса
    private $connection;

    private function __construct() {
        // Приватный конструктор
        // Инициализация соединения с базой данных
        $this->connection = mysqli_connect('localhost', 'username', 'password', 'database');
    }

    public static function getInstance(): DatabaseConnection {
        // Статический метод для получения экземпляра класса
        if (!isset(self::$instance)) {
            // Если экземпляр еще не создан, создаем новый экземпляр
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

// Клиентский код
$connection1 = DatabaseConnection::getInstance();
$connection2 = DatabaseConnection::getInstance();

// $connection1 и $connection2 ссылаются на один и тот же экземпляр класса
var_dump($connection1 === $connection2); // Выведет true

$connection = $connection1->getConnection();
// Используем соединение с базой данных...

/*
 * Пример симуляции паттерна "Одиночка" в реальной жизни: Предположим, у нас есть класс DatabaseConnection, который предоставляет соединение с базой данных.
 * В приложении может быть только одно соединение с базой данных, и мы хотим обеспечить глобальный доступ к этому соединению из всех частей кода.
 *
 *
 *
 * В данном примере у нас есть класс DatabaseConnection, который реализует паттерн "Одиночка".
 * У этого класса есть статическая переменная $instance, которая хранит единственный экземпляр класса.
 * Конструктор класса приватный, что предотвращает создание экземпляров извне.
 * Вместо этого мы используем статический метод getInstance(), который проверяет, существует ли уже экземпляр класса.
 * Если экземпляр уже создан, метод возвращает его, если нет - создает новый экземпляр и возвращает его.
 * Клиентский код вызывает статический метод getInstance() для получения единственного экземпляра класса DatabaseConnection. В результате $connection1 и $connection2 ссылаются на один и тот же экземпляр, что подтверждается выводом true при сравнении их по ссылке.
 */




//  ОБЛЕГЧЁННЫЙ ВАРИАНТ

// Пример простейшего класса Одиночка (Singleton)
class Singleton {
    private static $instance;

    // Защищаем конструктор от создания через оператор "new"
    private function __construct() {}

    // Защищаем от создания через клонирование
    private function __clone() {}

    // Защищаем от создания через unserialize
    private function __wakeup() {}

    // Метод для получения экземпляра класса
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Метод, который демонстрирует, что одиночка работает
    public function showMessage() {
        echo "Hello, I am a Singleton!\n";
    }
}

// Используем класс Одиночка для получения экземпляра и вызова метода showMessage
$instance1 = Singleton::getInstance();
$instance1->showMessage();

$instance2 = Singleton::getInstance();
$instance2->showMessage();

// Проверяем, что экземпляры одинаковые
var_dump($instance1 === $instance2); // Выведет bool(true), потому что это один и тот же объект
