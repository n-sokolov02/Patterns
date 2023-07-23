<?php

// Observer (Подписчик)
interface Observer {
    public function update(string $message);
}

// Subject (Издатель)
interface Subject {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify(string $message);
}

// ConcreteObserver (Конкретный подписчик)
class User implements Observer {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function update(string $message) {
        echo "Пользователь {$this->name} получил уведомление: {$message}\n";
    }
}

// ConcreteSubject (Конкретный издатель)
class OnlineStore implements Subject {
    private $observers = [];

    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer) {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function notify(string $message) {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }

    public function setDiscount(string $discount) {
        // При изменении скидки уведомляем всех подписчиков
        $this->notify("Действует скидка {$discount}");
    }
}

// Клиентский код
$store = new OnlineStore();

// Создаем пользователей и добавляем их в список подписчиков
$user1 = new User("John");
$user2 = new User("Jane");
$store->attach($user1);
$store->attach($user2);

// Устанавливаем скидку и уведомляем подписчиков
$store->setDiscount("10%"); // Вывод: Пользователь John получил уведомление: Действует скидка 10%
//        Пользователь Jane получил уведомление: Действует скидка 10%

// Удаляем одного из подписчиков
$store->detach($user2);

// Устанавливаем новую скидку и уведомляем оставшихся подписчиков
$store->setDiscount("20%"); // Вывод: Пользователь John получил уведомление: Действует скидка 20%


/*
 * Пример симуляции паттерна "Наблюдатель" в реальной жизни: Представьте, что у вас есть интернет-магазин, и вы хотите уведомлять всех своих зарегистрированных пользователей о скидках и акциях.
 * В этом случае, каждый зарегистрированный пользователь будет подписчиком (подписчиками) нашего издателя (интернет-магазина), и он будет получать уведомления об изменениях в ценах и акциях.
 *
 *
 *
 * В данном примере мы создали издателя OnlineStore и подписчиков User.
 * Издатель содержит список подписчиков ($observers) и методы для управления ими.
 * Когда изменяется скидка в магазине (setDiscount()), он уведомляет всех своих подписчиков с помощью метода notify().
 * Подписчики, реализуя интерфейс Observer, могут получать уведомления об изменениях и реагировать на них.
 * **/