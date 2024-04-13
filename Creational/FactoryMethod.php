<?php
// Product (Продукт) - Интерфейс для создания врагов
interface Enemy {
    public function attack();
}

// ConcreteProduct (Конкретный продукт) - Класс для создания обычного врага
class NormalEnemy implements Enemy {
    public function attack() {
        echo "Обычный враг атакует!\n";
    }
}

// ConcreteProduct (Конкретный продукт) - Класс для создания сильного врага
class StrongEnemy implements Enemy {
    public function attack() {
        echo "Сильный враг атакует!\n";
    }
}

// Creator (Создатель) - Абстрактный класс для создания врагов
abstract class EnemyCreator {
    // Фабричный метод
    abstract public function createEnemy(): Enemy;

    public function someMethod() {
        // Какая-то общая логика
        $enemy = $this->createEnemy();
        $enemy->attack();
    }
}

// ConcreteCreator (Конкретный создатель) - Создание обычных врагов
class NormalEnemyCreator extends EnemyCreator {
    public function createEnemy(): Enemy {
        return new NormalEnemy();
    }
}

// ConcreteCreator (Конкретный создатель) - Создание сильных врагов
class StrongEnemyCreator extends EnemyCreator {
    public function createEnemy(): Enemy {
        return new StrongEnemy();
    }
}

// Клиентский код
$normalEnemyCreator = new NormalEnemyCreator();
$normalEnemyCreator->someMethod(); // Выведет: Обычный враг атакует!

$strongEnemyCreator = new StrongEnemyCreator();
$strongEnemyCreator->someMethod(); // Выведет: Сильный враг атакует!

/*
 * Пример симуляции паттерна "Фабричный метод" в реальной жизни: Предположим, у вас есть игра, в которой есть различные типы врагов.
 * Каждый тип врага является отдельным классом, и вам нужно создавать их динамически в зависимости от некоторых условий.
 * Вы можете использовать "Фабричный метод", чтобы определить интерфейс для создания врагов и позволить подклассам определять, какого типа врагов они хотят создавать.
 *
 *
 *
 *  В данном примере у нас есть интерфейс Enemy, определяющий общий интерфейс для всех типов врагов.
 *  Классы NormalEnemy и StrongEnemy являются конкретными продуктами, реализующими интерфейс Enemy.
 *  Затем у нас есть абстрактный класс EnemyCreator, который представляет абстрактного создателя, и у него есть абстрактный фабричный метод createEnemy(), который должен быть реализован подклассами.
 *  Конкретные создатели NormalEnemyCreator и StrongEnemyCreator реализуют фабричный метод и создают соответствующих врагов.
 *  Клиентский код создает объекты врагов через создателей и вызывает метод someMethod(), который демонстрирует общую логику и вызывает фабричный метод для создания врагов. В результате каждый создатель создает врагов своего типа и выполняет их атаку.
 */



//  ОБЛЕГЧЕННЫЙ ВАРИАНТ

// Базовый класс Product
class Product {
    public function getName() {
        return "Generic Product";
    }
}

// Подкласс ProductA
class ProductA extends Product {
    public function getName() {
        return "Product A";
    }
}

// Подкласс ProductB
class ProductB extends Product {
    public function getName() {
        return "Product B";
    }
}

// Фабрика для создания объектов классов ProductA и ProductB
class ProductFactory {
    public static function createProduct($type) {
        switch ($type) {
            case 'A':
                return new ProductA();
            case 'B':
                return new ProductB();
            default:
                throw new InvalidArgumentException("Invalid product type: $type");
        }
    }
}

// Используем фабрику для создания объектов
$productA = ProductFactory::createProduct('A');
$productB = ProductFactory::createProduct('B');

// Выводим имена продуктов
echo $productA->getName(); // Выведет "Product A"
echo $productB->getName(); // Выведет "Product B"
