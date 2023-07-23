<?php
// State (Состояние)
interface MobileState {
public function powerButtonPress();
public function callButtonPress();
public function volumeButtonPress();
}

// ConcreteState (Конкретное состояние) - Телефон включен
class OnState implements MobileState {
public function powerButtonPress() {
echo "Телефон выключается\n";
return new OffState();
}

public function callButtonPress() {
echo "Звоним\n";
}

public function volumeButtonPress() {
echo "Громкость меняется\n";
}
}

// ConcreteState (Конкретное состояние) - Телефон выключен
class OffState implements MobileState {
public function powerButtonPress() {
echo "Телефон включается\n";
return new OnState();
}

public function callButtonPress() {
echo "Телефон выключен. Невозможно звонить\n";
}

public function volumeButtonPress() {
echo "Телефон выключен. Невозможно регулировать громкость\n";
}
}

// Context (Контекст) - Мобильный телефон
class MobilePhone {
private $state;

public function __construct() {
$this->state = new OffState(); // Начальное состояние - телефон выключен
}

public function setState(MobileState $state) {
$this->state = $state;
}

public function powerButtonPress() {
$this->state = $this->state->powerButtonPress();
}

public function callButtonPress() {
$this->state->callButtonPress();
}

public function volumeButtonPress() {
$this->state->volumeButtonPress();
}
}

// Клиентский код
$phone = new MobilePhone();

$phone->callButtonPress(); // Вывод: Телефон выключен. Невозможно звонить

$phone->powerButtonPress(); // Вывод: Телефон включается
$phone->callButtonPress(); // Вывод: Звоним

$phone->powerButtonPress(); // Вывод: Телефон выключается
$phone->volumeButtonPress(); // Вывод: Громкость меняется

/*
 * Пример симуляции паттерна "Состояние" в реальной жизни: Представьте, что у вас есть телефон с различными состояниями (включен, выключен, звонок, режим "не беспокоить" и т. д.).
 * В зависимости от текущего состояния, телефон может реагировать по-разному на нажатия клавиш и вызовы.
 *
 *
 *
 * В данном примере у нас есть интерфейс MobileState, представляющий состояние мобильного телефона, и две конкретные реализации этого интерфейса - OnState (телефон включен) и OffState (телефон выключен).
 * Класс MobilePhone представляет контекст и содержит ссылку на текущее состояние.
 * Клиентский код может вызывать методы callButtonPress(), powerButtonPress() и volumeButtonPress() для телефона, и он будет реагировать соответственно в зависимости от текущего состояния.
 */