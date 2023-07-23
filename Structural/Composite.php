<?php


// Component (Общий интерфейс компонента)
interface Task {
    public function execute(): void;
}

// Leaf (Листовой элемент)
class SingleTask implements Task {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function execute(): void {
        echo "Выполнение отдельной задачи: " . $this->name . "\n";
    }
}

// Composite (Составной элемент)
class TaskList implements Task {
    private $tasks = [];

    public function addTask(Task $task): void {
        $this->tasks[] = $task;
    }

    public function removeTask(Task $task): void {
        $index = array_search($task, $this->tasks);
        if ($index !== false) {
            unset($this->tasks[$index]);
        }
    }

    public function execute(): void {
        echo "Выполнение списка задач:\n";
        foreach ($this->tasks as $task) {
            $task->execute();
        }
    }
}

// Клиентский код
$task1 = new SingleTask("Задача 1");
$task2 = new SingleTask("Задача 2");
$task3 = new SingleTask("Задача 3");

$taskList1 = new TaskList();
$taskList1->addTask($task1);
$taskList1->addTask($task2);

$taskList2 = new TaskList();
$taskList2->addTask($task3);

$taskList3 = new TaskList();
$taskList3->addTask($taskList1);
$taskList3->addTask($taskList2);

$taskList3->execute();


/*
 * Пример симуляции паттерна "Компоновщик" в реальной жизни: Предположим, у нас есть задачи проекта, которые могут представляться как отдельные задачи, так и наборы подзадач, состоящих из других задач.
 * Мы хотим иметь возможность обрабатывать как отдельные задачи, так и их композиции единообразно.
 *
 *
 *
 * В данном примере у нас есть интерфейс Task, который представляет компонент (классы SingleTask и TaskList реализуют этот интерфейс).
 * Класс SingleTask представляет листовой элемент, представляющий отдельную задачу.
 * Класс TaskList представляет составной элемент, который может содержать другие компоненты (как листы, так и другие композиты).
 * Клиентский код создает различные листья (отдельные задачи) и композиты (списки задач) и добавляет их в композиты.
 * Затем клиентский код вызывает метод execute() для композита, и все элементы структуры выводятся на экран единообразно, без необходимости знать, является ли компонент листом или композитом.
 * Таким образом, мы использовали паттерн "Компоновщик", чтобы работать с отдельными задачами и списками задач единообразно в структуре иерархических компонентов.
 */