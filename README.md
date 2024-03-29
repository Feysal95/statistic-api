# Сервис статистики

Сервис предоставляет API для учета статистики посещений сайта с разбиением по странам. Он разработан с использованием [Symfony Framework](https://symfony.com/)

## Развёртывание для разработки

```shell
git clone https://github.com/Feysal95/statistic-api
cd statistic-api
```

Развернуть проект:
```shell
./dc install
```
- Команда установит образы контейнеров
- Установит композер зависимости
- Поднимет контейнеры


### Остановить контейнеры

```shell
./dc down
```

### Поднять контейнеры

```shell
./dc up
```

### Запуск тестов

```shell
./dc tests
```

Для тестов поднимается отдельный контейнер с тестовой средой

### Зайти в bash php

```shell
./dc bash
```

## Адреса

* http://localhost/api/docs - локальное Swagger-описание endpoint'ов

## Инструменты разработчика
В проекте используются следующие инструменты:

* PHP Code Style Fixer: Для автоматической правки стилевых ошибок в PHP-коде.
* PHPStan: Для статического анализа кода и поиска потенциальных ошибок.

## Обработка ошибок
* В сервисе добавлена обработка ошибок. На каждую существующую ошибку, в том числе и на ошибку валидации, написан свой хендлер, который обрабатывает соответствующее исключение и возвращает корректный JSON-формат ошибки.
* Все 500 ошибки логируются дополнительно в соответствующем хендлере.
* Список стран валидируется в соответствии со стандартом https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2



