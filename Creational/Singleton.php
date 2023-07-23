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