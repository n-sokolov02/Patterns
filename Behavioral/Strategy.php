<?php

// Strategy (Стратегия)
interface ImageCompression {
    public function compress(string $imagePath): string;
}

// ConcreteStrategy (Конкретная стратегия) - JPEG сжатие
class JPEGCompression implements ImageCompression {
    public function compress(string $imagePath): string {
        // Логика сжатия изображения в формате JPEG
        return "Изображение сжато в формате JPEG: {$imagePath}";
    }
}

// ConcreteStrategy (Конкретная стратегия) - PNG сжатие
class PNGCompression implements ImageCompression {
    public function compress(string $imagePath): string {
        // Логика сжатия изображения в формате PNG
        return "Изображение сжато в формате PNG: {$imagePath}";
    }
}

// Context (Контекст)
class ImageProcessor {
    private $compressionStrategy;

    public function setCompressionStrategy(ImageCompression $compressionStrategy) {
        $this->compressionStrategy = $compressionStrategy;
    }

    public function processImage(string $imagePath): string {
        return $this->compressionStrategy->compress($imagePath);
    }
}

// Клиентский код
$imageProcessor = new ImageProcessor();

// Используем JPEG сжатие
$imageProcessor->setCompressionStrategy(new JPEGCompression());
echo $imageProcessor->processImage("image.jpg"); // Вывод: Изображение сжато в формате JPEG: image.jpg

// Используем PNG сжатие
$imageProcessor->setCompressionStrategy(new PNGCompression());
echo $imageProcessor->processImage("image.png"); // Вывод: Изображение сжато в формате PNG: image.png


/*
 * Пример симуляции паттерна "Стратегия" в реальной жизни: Представьте, что у вас есть приложение для обработки изображений, и вы хотите реализовать различные алгоритмы для сжатия изображений.
 * Вы можете создать различные классы, реализующие интерфейс "Сжатие изображения", такие как JPEGCompression, PNGCompression, и т. д.
 * Затем ваше приложение будет использовать контекст для выбора нужного алгоритма сжатия в зависимости от потребностей пользователя.
 *
 *
 *
 * В данном примере мы создали интерфейс ImageCompression, представляющий стратегию для сжатия изображений, и две конкретные стратегии JPEGCompression и PNGCompression, реализующие этот интерфейс.
 * Затем мы создали контекст ImageProcessor, который содержит ссылку на интерфейс стратегии и использует выбранную стратегию для сжатия изображений.
 * Клиентский код может динамически менять стратегию, просто устанавливая новую стратегию через метод setCompressionStrategy().**/
