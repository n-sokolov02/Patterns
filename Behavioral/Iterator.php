<?php

// Iterator (Итератор)
interface TaskIterator {
    public function hasNext(): bool;
    public function next();
}

// ConcreteIterator (Конкретный итератор) для списка задач
class TaskListIterator implements TaskIterator {
    private $tasks;
    private $position = 0;

    public function __construct(array $tasks) {
        $this->tasks = $tasks;
    }

    public function hasNext(): bool {
        return $this->position < count($this->tasks);
    }

    public function next() {
        $task = $this->tasks[$this->position];
        $this->position++;
        return $task;
    }
}

// Aggregate (Коллекция)
interface TaskCollection {
    public function getIterator(): TaskIterator;
}

// ConcreteAggregate (Конкретная коллекция) - Список задач
class TaskList implements TaskCollection {
    private $tasks = [];

    public function addTask($task) {
        $this->tasks[] = $task;
    }

    public function getIterator(): TaskIterator {
        return new TaskListIterator($this->tasks);
    }
}

// Создание коллекции и добавление задач
$taskList = new TaskList();
$taskList->addTask("Подготовить отчет");
$taskList->addTask("Провести встречу");
$taskList->addTask("Определить план проекта");

// Получение итератора и обход коллекции
$iterator = $taskList->getIterator();
while ($iterator->hasNext()) {
    $task = $iterator->next();
    echo "Задача: " . $task . "\n";
}
/*
 * Пример симуляции паттерна "Итератор" в реальной жизни: Представьте, что у вас есть приложение для управления списком задач.
 * Коллекция задач может представлять собой массив, связный список или другую структуру данных.
 * Итератор позволяет последовательно перебирать задачи независимо от их фактической реализации в коллекции.
 *
 *
 *
 * В данном примере у нас есть интерфейс TaskIterator, представляющий итератор для перебора задач, и его конкретная реализация TaskListIterator, которая работает с массивом задач.
 * Коллекция задач представлена интерфейсом TaskCollection и его конкретной реализацией TaskList, которая содержит массив задач.
 * Приложение использует итератор для перебора задач в коллекции без зависимости от её фактической реализации.
 */



//  ОБЛЕГЧЁННЫЙ ВАРИАНТ

// Класс SimpleIterator, представляющий коллекцию целых чисел
class SimpleIterator implements Iterator {
    private $position = 0;
    private $array = array(1, 2, 3, 4, 5);

    // Метод, который возвращает текущий элемент
    public function current() {
        return $this->array[$this->position];
    }

    // Метод, который возвращает текущий ключ
    public function key() {
        return $this->position;
    }

    // Метод, который переходит к следующему элементу
    public function next() {
        $this->position++;
    }

    // Метод, который проверяет, есть ли еще элементы в коллекции
    public function valid() {
        return isset($this->array[$this->position]);
    }

    // Метод, который переходит к первому элементу
    public function rewind() {
        $this->position = 0;
    }
}

// Используем паттерн Итератор
$iterator = new SimpleIterator();

// Перебираем элементы коллекции с помощью итератора
foreach ($iterator as $key => $value) {
    echo "Key: $key, Value: $value\n";
}
