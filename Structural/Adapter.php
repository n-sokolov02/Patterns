<?php

// Target (Целевой интерфейс)
interface NewPrinter {
    public function printNew();
}

// Adaptee (Адаптируемый класс)
class OldPrinter {
    public function printOld() {
        echo "Старый метод печати\n";
    }
}

// Adapter (Адаптер)
class PrinterAdapter implements NewPrinter {
    private $oldPrinter;

    public function __construct(OldPrinter $oldPrinter) {
        $this->oldPrinter = $oldPrinter;
    }

    public function printNew() {
        // Преобразование вызова метода Target в вызов метода Adaptee
        $this->oldPrinter->printOld();
    }
}

// Клиентский код
$newPrinter = new PrinterAdapter(new OldPrinter());
$newPrinter->printNew(); // Выведет: Старый метод печати


/*
 * Пример симуляции паттерна "Адаптер" в реальной жизни: Предположим, у нас есть класс OldPrinter, который имеет метод printOld(), который мы хотим использовать вместо объекта класса NewPrinter, который имеет метод printNew().
 * Но интерфейсы этих классов несовместимы. Мы можем использовать паттерн "Адаптер", чтобы сделать объект OldPrinter совместимым с интерфейсом NewPrinter.
 *
 *
 *
 * В данном примере у нас есть интерфейс NewPrinter, который является Target и определяет метод printNew().
 * У нас также есть класс OldPrinter, который является Adaptee и имеет метод printOld().
 * Класс PrinterAdapter является Adapter и реализует интерфейс NewPrinter.
 * В его конструкторе мы передаем объект OldPrinter, который мы хотим использовать как Adaptee.
 * Затем в методе printNew() адаптер преобразует вызов метода printNew() из интерфейса Target в вызов метода printOld() из интерфейса Adaptee, обеспечивая совместимость интерфейсов.
 * Клиентский код создает объект PrinterAdapter, передавая в него объект OldPrinter, и затем вызывает метод printNew().
 * В результате метод printOld() из объекта OldPrinter будет вызван через адаптер, и мы получим вывод: "Старый метод печати". Таким образом, мы использовали паттерн "Адаптер", чтобы сделать объект OldPrinter совместимым с интерфейсом NewPrinter.
 */