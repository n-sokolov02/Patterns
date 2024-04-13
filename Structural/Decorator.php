<?php
// Component (Компонент)
interface Coffee {
    public function cost(): float;
    public function description(): string;
} //можно не использовать вроде !!!

// ConcreteComponent (Конкретный компонент)
class SimpleCoffee implements Coffee {
    public function cost(): float {
        return 2.0;
    }

    public function description(): string {
        return "Простой кофе";
    }
}

// Decorator (Декоратор)
abstract class CoffeeDecorator implements Coffee {
    protected $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function cost(): float {
        return $this->coffee->cost();
    }

    public function description(): string {
        return $this->coffee->description();
    }
}

// ConcreteDecorator (Конкретный декоратор)
class MilkDecorator extends CoffeeDecorator {
    public function cost(): float {
        return parent::cost() + 1.0;
    }

    public function description(): string {
        return parent::description() . ", с молоком";
    }
}
// 2nd ConcreteDecorator (2-ой Конкретный декоратор)
class SyrupDecorator extends CoffeeDecorator {
    public function cost(): float {
        return parent::cost() + 0.5;
    }

    public function description(): string {
        return parent::description() . ", с сиропом";
    }
}

// Клиентский код
$coffee = new SimpleCoffee();
echo $coffee->description() . ", стоимость: $" . $coffee->cost() . "\n";

$coffeeWithMilk = new MilkDecorator($coffee);
echo $coffeeWithMilk->description() . ", стоимость: $" . $coffeeWithMilk->cost() . "\n";

$coffeeWithSyrup = new SyrupDecorator($coffee);
echo $coffeeWithSyrup->description() . ", стоимость: $" . $coffeeWithSyrup->cost() . "\n";

$coffeeWithMilkAndSyrup = new SyrupDecorator($coffeeWithMilk);
echo $coffeeWithMilkAndSyrup->description() . ", стоимость: $" . $coffeeWithMilkAndSyrup->cost() . "\n";

/*
 * Пример симуляции паттерна "Декоратор" в реальной жизни: Предположим, у нас есть класс Coffee, который представляет базовый напиток.
 * Мы хотим иметь возможность добавлять различные ингредиенты (молоко, сиропы и т. д.) к базовому напитку, чтобы создавать разнообразные кофейные напитки.
 *
 *
 *
 * В данном примере у нас есть интерфейс Coffee, который представляет компонент (классы SimpleCoffee, MilkDecorator, и SyrupDecorator реализуют этот интерфейс).
 * Класс SimpleCoffee представляет конкретный компонент - простой кофе.
 * Класс CoffeeDecorator представляет декоратор, абстрактный класс, который реализует интерфейс Coffee.
 * У него есть ссылка на компонент, который мы оборачиваем. Конкретные декораторы MilkDecorator и SyrupDecorator добавляют молоко и сиропы к базовому кофе соответственно.
 * Клиентский код создает объекты различных декораторов и оборачивает их вокруг простого кофе. Затем клиентский код вызывает методы cost() и description(), чтобы получить общую стоимость и описание кофе с добавленными декораторами.
 * Таким образом, мы использовали паттерн "Декоратор", чтобы динамически добавлять новую функциональность (молоко, сиропы) к базовому объекту (простой кофе) без необходимости изменения его класса.
 * Это позволяет нам создавать разнообразные кофейные напитки с помощью различных комбинаций декораторов.
 */



//  ОБЛЕГЧЁННЫЙ ВАРИАНТ

// Интерфейс Coffee
interface Coffee {
    public function getCost();
    public function getDescription();
}

// Конкретный класс SimpleCoffee, представляющий простой кофе
class SimpleCoffee implements Coffee {
    public function getCost() {
        return 5;
    }

    public function getDescription() {
        return "Simple Coffee";
    }
}

// Конкретный декоратор MilkDecorator, добавляющий молоко
class MilkDecorator implements Coffee {
    private $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function getCost() {
        return $this->coffee->getCost() + 2;
    }

    public function getDescription() {
        return $this->coffee->getDescription() . ", Milk";
    }
}

// Конкретный декоратор SugarDecorator, добавляющий сахар
class SugarDecorator implements Coffee {
    private $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function getCost() {
        return $this->coffee->getCost() + 1;
    }

    public function getDescription() {
        return $this->coffee->getDescription() . ", Sugar";
    }
}

// Используем простейший пример паттерна Декоратор
$coffee = new SimpleCoffee();
echo "Cost: " . $coffee->getCost() . " USD\n";
echo "Description: " . $coffee->getDescription() . "\n";

$coffeeWithMilk = new MilkDecorator($coffee);
echo "Cost: " . $coffeeWithMilk->getCost() . " USD\n";
echo "Description: " . $coffeeWithMilk->getDescription() . "\n";

$coffeeWithMilkAndSugar = new SugarDecorator($coffeeWithMilk);
echo "Cost: " . $coffeeWithMilkAndSugar->getCost() . " USD\n";
echo "Description: " . $coffeeWithMilkAndSugar->getDescription() . "\n";
