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