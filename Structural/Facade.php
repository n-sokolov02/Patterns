<?php


// Subsystem 1 (Подсистема 1)
class ProductStock {
    public function checkAvailability($productId): bool {
        // Логика проверки наличия товара по идентификатору
        return true;
    }
}

// Subsystem 2 (Подсистема 2)
class ShippingCalculator {
    public function calculateShippingCost($address): float {
        // Логика расчета стоимости доставки по адресу
        return 5.0;
    }
}

// Subsystem 3 (Подсистема 3)
class PaymentProcessor {
    public function processPayment($amount): bool {
        // Логика обработки оплаты
        return true;
    }
}

// Facade (Фасад)
class OrderFacade {
    private $productStock;
    private $shippingCalculator;
    private $paymentProcessor;

    public function __construct() {
        $this->productStock = new ProductStock();
        $this->shippingCalculator = new ShippingCalculator();
        $this->paymentProcessor = new PaymentProcessor();
    }

    public function placeOrder($productId, $address, $amount): bool {
        if ($this->productStock->checkAvailability($productId)) {
            $shippingCost = $this->shippingCalculator->calculateShippingCost($address);
            $totalAmount = $amount + $shippingCost;

            if ($this->paymentProcessor->processPayment($totalAmount)) {
                // Генерация заказа и дополнительная логика
                echo "Заказ успешно оформлен!\n";
                return true;
            } else {
                echo "Ошибка обработки оплаты.\n";
            }
        } else {
            echo "Товар отсутствует на складе.\n";
        }

        return false;
    }
}

// Клиентский код
$orderFacade = new OrderFacade();
$orderFacade->placeOrder(123, "ул. Примерная, д. 10", 50.0);


/*
 * Пример симуляции паттерна "Фасад" в реальной жизни: Предположим, у нас есть сложная система для оформления заказа в интернет-магазине, которая включает в себя проверку наличия товара, расчет стоимости доставки, обработку оплаты и генерацию заказа.
 * Мы хотим предоставить клиентам простой интерфейс для оформления заказа без необходимости знать о сложной логике подсистемы.
 *
 *
 *
 * В данном примере у нас есть три подсистемы (ProductStock, ShippingCalculator и PaymentProcessor), каждая из которых представляет сложную логику выполнения своих задач.
 * Затем мы создаем фасад OrderFacade, который предоставляет простой интерфейс для оформления заказа.
 * Клиентский код вызывает метод placeOrder() на фасаде, а фасад уже обращается к необходимым подсистемам, скрывая сложность их работы от клиента.
 * Таким образом, клиентский код может оформить заказ без необходимости знать о том, как проверить наличие товара, рассчитать стоимость доставки и обработать оплату.
 * Все это обрабатывается фасадом в едином интерфейсе для клиента.
 * Паттерн "Фасад" позволяет упростить взаимодействие с сложными системами, делая код более понятным, поддерживаемым и расширяемым.
 */



//  ОБЛЕГЧЁННЫЙ ПРИМЕР

// Сложная подсистема с несколькими классами
class Order {
    public function calculateTotal() {
        // Логика для расчета общей стоимости заказа
        return 100;
    }
}

class PaymentProcessor {
    public function processPayment($amount) {
        // Логика для обработки платежа
        echo "Payment processed for amount: $amount USD\n";
    }
}

class EmailService {
    public function sendConfirmationEmail() {
        // Логика для отправки подтверждения по электронной почте
        echo "Confirmation email sent.\n";
    }
}

// Класс Фасада, предоставляющий простой интерфейс для взаимодействия с подсистемой
class PaymentFacade {
    private $order;
    private $paymentProcessor;
    private $emailService;

    public function __construct() {
        $this->order = new Order();
        $this->paymentProcessor = new PaymentProcessor();
        $this->emailService = new EmailService();
    }

    public function processOrder() {
        $totalAmount = $this->order->calculateTotal();
        $this->paymentProcessor->processPayment($totalAmount);
        $this->emailService->sendConfirmationEmail();
    }
}

// Используем простейший пример паттерна Фасад
$paymentFacade = new PaymentFacade();
$paymentFacade->processOrder();
