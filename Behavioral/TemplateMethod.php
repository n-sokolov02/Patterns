<?php
// AbstractClass (Абстрактный класс) - Figure
abstract class Figure {
    // Шаблонный метод для рисования фигуры
    public function draw() {
        $this->drawOutline();
        $this->drawInternal();
    }

    // Абстрактные методы - вариативные шаги
    abstract protected function drawOutline();
    abstract protected function drawInternal();
}

// ConcreteClass (Конкретный класс) - Rectangle
class Rectangle extends Figure {
    protected function drawOutline() {
        echo "Рисуем контур прямоугольника\n";
    }

    protected function drawInternal() {
        echo "Рисуем закрашенную область прямоугольника\n";
    }
}

// ConcreteClass (Конкретный класс) - Circle
class Circle extends Figure {
    protected function drawOutline() {
        echo "Рисуем контур круга\n";
    }

    protected function drawInternal() {
        echo "Рисуем закрашенную область круга\n";
    }
}

// Клиентский код
$rectangle = new Rectangle();
$circle = new Circle();

$rectangle->draw();
/* Вывод:
   Рисуем контур прямоугольника
   Рисуем закрашенную область прямоугольника
*/

$circle->draw();
/* Вывод:
   Рисуем контур круга
   Рисуем закрашенную область круга
*/


/*
 * Пример симуляции шаблонного метода в реальной жизни: Представьте, что у вас есть приложение для рисования фигур, и вы хотите определить общий алгоритм для рисования фигур, но вариантность в том, как рисуется каждая фигура.
 * Вы можете создать абстрактный класс "Figure" с методом "draw()", который определяет общие шаги рисования фигуры.
 * Затем вы создаете конкретные классы, например "Rectangle" и "Circle", которые расширяют "Figure" и реализуют метод "draw()" для рисования конкретных фигур.
 *
 *
 *
 * В данном примере абстрактный класс Figure определяет шаблонный метод draw(), который объединяет шаги рисования фигуры.
 * Методы drawOutline() и drawInternal() объявлены абстрактными, чтобы предоставить вариативные шаги для наследников.
 * Классы Rectangle и Circle наследуют Figure и реализуют абстрактные методы для конкретной отрисовки прямоугольника и круга.
 * Клиентский код может использовать метод draw() без знания о деталях рисования конкретных фигур.
 */



//  ОБЛЕГЧЁННЫЙ ПРИМЕР

// Абстрактный класс с шаблонным методом
abstract class AbstractClass {
    // Шаблонный метод, определяющий общий алгоритм
    public function templateMethod() {
        $this->stepOne();
        $this->stepTwo();
        $this->stepThree();
    }

    // Абстрактные методы, которые должны быть реализованы в наследниках
    abstract protected function stepOne();
    abstract protected function stepTwo();
    abstract protected function stepThree();
}

// Конкретный класс A
class ConcreteClassA extends AbstractClass {
    protected function stepOne() {
        echo "Step One in Concrete Class A.\n";
    }

    protected function stepTwo() {
        echo "Step Two in Concrete Class A.\n";
    }

    protected function stepThree() {
        echo "Step Three in Concrete Class A.\n";
    }
}

// Конкретный класс B
class ConcreteClassB extends AbstractClass {
    protected function stepOne() {
        echo "Step One in Concrete Class B.\n";
    }

    protected function stepTwo() {
        echo "Step Two in Concrete Class B.\n";
    }

    protected function stepThree() {
        echo "Step Three in Concrete Class B.\n";
    }
}

// Используем паттерн Шаблонный метод
$objectA = new ConcreteClassA();
$objectA->templateMethod();

$objectB = new ConcreteClassB();
$objectB->templateMethod();
