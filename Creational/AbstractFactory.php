<?php
// Abstract Factory (Абстрактная фабрика) - Мебельный стиль
interface FurnitureStyle {
    public function createChair(): Chair;
    public function createTable(): Table;
    // Дополнительные методы для создания других элементов мебели
}

// Concrete Factory (Конкретная фабрика) - Классический стиль
class ClassicFurnitureStyle implements FurnitureStyle {
    public function createChair(): Chair {
        return new ClassicChair();
    }

    public function createTable(): Table {
        return new ClassicTable();
    }
    // Реализация методов для создания других элементов мебели в классическом стиле
}

// Concrete Factory (Конкретная фабрика) - Современный стиль
class ModernFurnitureStyle implements FurnitureStyle {
    public function createChair(): Chair {
        return new ModernChair();
    }

    public function createTable(): Table {
        return new ModernTable();
    }
    // Реализация методов для создания других элементов мебели в современном стиле
}

// Abstract Product (Абстрактный продукт) - Стул
interface Chair {
    public function getName(): string;
}

// Concrete Product (Конкретный продукт) - Классический стул
class ClassicChair implements Chair {
    public function getName(): string {
        return "Классический стул";
    }
}

// Concrete Product (Конкретный продукт) - Современный стул
class ModernChair implements Chair {
    public function getName(): string {
        return "Современный стул";
    }
}

// Abstract Product (Абстрактный продукт) - Стол
interface Table {
    public function getName(): string;
}

// Concrete Product (Конкретный продукт) - Классический стол
class ClassicTable implements Table {
    public function getName(): string {
        return "Классический стол";
    }
}

// Concrete Product (Конкретный продукт) - Современный стол
class ModernTable implements Table {
    public function getName(): string {
        return "Современный стол";
    }
}

// Клиентский код
function createFurniture(FurnitureStyle $style) {
    $chair = $style->createChair();
    $table = $style->createTable();

    echo "Создана мебель в стиле: " . get_class($chair) . " и " . get_class($table) . "\n";
}

$classicStyle = new ClassicFurnitureStyle();
$modernStyle = new ModernFurnitureStyle();

createFurniture($classicStyle);
createFurniture($modernStyle);


/*
 * Пример симуляции паттерна "Абстрактная фабрика" в реальной жизни: Представьте, что у вас есть приложение для создания мебели.
 * Вам нужно создавать мебель разных стилей (например, классический и современный) и каждый стиль включает различные элементы мебели (стулья, столы, шкафы и т. д.).
 * Вы можете использовать абстрактную фабрику для создания продуктов каждого стиля и обеспечения их совместимости в рамках стиля.
 *
 *
 *
 * В данном примере у нас есть интерфейс FurnitureStyle, который определяет абстрактные методы для создания стула и стола в определенном стиле мебели.
 * Затем создаются две конкретные фабрики - ClassicFurnitureStyle и ModernFurnitureStyle, которые реализуют методы создания продуктов в соответствующих стилях.
 * Каждая фабрика создает продукты своего семейства (классические или современные стулья и столы).
 * Клиентский код использует абстрактную фабрику для создания мебели разных стилей, не зависимо от их конкретных классов.
 */


//  ОБЛЕГЧЕННЫЙ ВАРИАНТ

// Абстрактный класс для продукта ProductA
abstract class ProductA {
    abstract public function getName();
}

// Два конкретных класса для продукта ProductA - Variant1 и Variant2
class ProductA_Variant1 extends ProductA {
    public function getName() {
        return "Product A - Variant 1";
    }
}

class ProductA_Variant2 extends ProductA {
    public function getName() {
        return "Product A - Variant 2";
    }
}

// Абстрактный класс для продукта ProductB
abstract class ProductB {
    abstract public function getName();
}

// Два конкретных класса для продукта ProductB - Variant1 и Variant2
class ProductB_Variant1 extends ProductB {
    public function getName() {
        return "Product B - Variant 1";
    }
}

class ProductB_Variant2 extends ProductB {
    public function getName() {
        return "Product B - Variant 2";
    }
}

// Абстрактная фабрика для создания семейства продуктов
abstract class AbstractFactory {
    abstract public function createProductA();
    abstract public function createProductB();
}

// Конкретная фабрика для создания семейства продуктов вариантов Variant1
class Variant1Factory extends AbstractFactory {
    public function createProductA() {
        return new ProductA_Variant1();
    }

    public function createProductB() {
        return new ProductB_Variant1();
    }
}

// Конкретная фабрика для создания семейства продуктов вариантов Variant2
class Variant2Factory extends AbstractFactory {
    public function createProductA() {
        return new ProductA_Variant2();
    }

    public function createProductB() {
        return new ProductB_Variant2();
    }
}

// Используем абстрактную фабрику для создания продуктов
function clientCode(AbstractFactory $factory) {
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productA->getName() . "\n";
    echo $productB->getName() . "\n";
}

// Создаем экземпляр абстрактной фабрики и вызываем клиентский код
echo "Using Variant1 Factory:\n";
clientCode(new Variant1Factory());

echo "\nUsing Variant2 Factory:\n";
clientCode(new Variant2Factory());
