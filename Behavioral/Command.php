<?php
// Command (Команда)
interface Command {
    public function execute();
}

// ConcreteCommand (Конкретная команда) - Открытие файла
class OpenFileCommand implements Command {
    private $file;

    public function __construct(FileReceiver $file) {
        $this->file = $file;
    }

    public function execute() {
        $this->file->open();
    }
}

// ConcreteCommand (Конкретная команда) - Сохранение файла
class SaveFileCommand implements Command {
    private $file;

    public function __construct(FileReceiver $file) {
        $this->file = $file;
    }

    public function execute() {
        $this->file->save();
    }
}

// Receiver (Получатель, Исполнитель)
class FileReceiver {
    private $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function open() {
        echo "Файл {$this->filename} открыт\n";
    }

    public function save() {
        echo "Файл {$this->filename} сохранен\n";
    }
}

// Invoker (Инициатор)
class FileInvoker {
    private $command;

    public function setCommand(Command $command) {
        $this->command = $command;
    }

    public function execute() {
        $this->command->execute();
    }
}

// Клиентский код
$fileReceiver = new FileReceiver("document.txt");
$openCommand = new OpenFileCommand($fileReceiver);
$saveCommand = new SaveFileCommand($fileReceiver);

$invoker = new FileInvoker();

$invoker->setCommand($openCommand);
$invoker->execute(); // Вывод: Файл document.txt открыт

$invoker->setCommand($saveCommand);
$invoker->execute(); // Вывод: Файл document.txt сохранен


/*
 * Пример симуляции паттерна "Команда" в реальной жизни: Представьте, что у вас есть программное приложение с различными действиями, которые пользователь может выполнять, такими как открытие файла, сохранение файла, копирование текста и т. д.
 * Каждое действие может быть реализовано как команда, а пользовательская интерфейсная часть приложения (инициатор) отправляет команды для выполнения.
 *
 *
 *
 * В данном примере мы создали интерфейс Command, представляющий команду, и две конкретные команды OpenFileCommand и SaveFileCommand, реализующие этот интерфейс.
 * Затем мы создали класс FileReceiver, который представляет получателя команды, в данном случае - файл, с методами open() и save().
 * Класс FileInvoker используется для выполнения команд.
 * Клиентский код может связывать команды с их получателями и вызывать команды через FileInvoker, не завися от конкретной реализации команд и их получателей.
 */
