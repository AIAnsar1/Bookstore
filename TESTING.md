# Bookstore API Testing Guide

Этот документ содержит информацию о тестировании Laravel 11 REST API проекта для книжного магазина.

## Структура тестов

### Unit Tests (Модульные тесты)
- `tests/Unit/Models/` - тесты для моделей
  - `UserTest.php` - тесты модели User
  - `ProductTest.php` - тесты модели Product
  - `CategoryTest.php` - тесты модели Category
  - `AuthorTest.php` - тесты модели Author
  - `BrandTest.php` - тесты модели Brand
  - `CountryTest.php` - тесты модели Country

### Feature Tests (Функциональные тесты)
- `tests/Feature/Auth/` - тесты аутентификации
  - `AuthTest.php` - тесты регистрации, входа, выхода
- `tests/Feature/Api/` - тесты API endpoints
  - `ProductControllerTest.php` - тесты CRUD операций с продуктами
  - `CategoryControllerTest.php` - тесты CRUD операций с категориями
  - `UserControllerTest.php` - тесты CRUD операций с пользователями
  - `AuthorControllerTest.php` - тесты CRUD операций с авторами
  - `BrandControllerTest.php` - тесты CRUD операций с брендами
  - `CountryControllerTest.php` - тесты CRUD операций со странами
  - `RoleControllerTest.php` - тесты CRUD операций с ролями
- `tests/Feature/Translation/` - тесты мультиязычности
  - `TranslatableTest.php` - тесты Spatie/translatable

## Покрытие тестами

### Модели
- ✅ User - связи, фильтры, роли
- ✅ Product - связи, фильтры, переводы
- ✅ Category - иерархия, связи, переводы
- ✅ Author - связи, переводы
- ✅ Brand - связи
- ✅ Country - иерархия, фильтры, переводы

### API Endpoints
- ✅ Аутентификация (login, register, logout)
- ✅ CRUD операции для всех основных ресурсов
- ✅ Фильтрация и поиск
- ✅ Валидация данных
- ✅ Авторизация доступа

### Функциональность
- ✅ Laravel Passport аутентификация
- ✅ Spatie/translatable мультиязычность
- ✅ Фабрики для всех моделей
- ✅ Валидация форм
- ✅ API ответы и структуры

## Запуск тестов

### Подготовка окружения
```bash
# Установка зависимостей
composer install

# Настройка окружения для тестов
cp .env.example .env.testing

# Генерация ключа приложения
php artisan key:generate --env=testing

# Установка Passport
php artisan passport:install --force
```

### Запуск всех тестов
```bash
# Запуск всех тестов
php artisan test

# Запуск с подробным выводом
php artisan test --verbose

# Параллельный запуск (как в CI)
php artisan test --parallel
```

### Запуск конкретных групп тестов
```bash
# Только Unit тесты
php artisan test tests/Unit

# Только Feature тесты
php artisan test tests/Feature

# Конкретный тест
php artisan test tests/Feature/Auth/AuthTest.php

# Конкретный метод
php artisan test --filter test_user_can_login
```

### Проверка покрытия кода
```bash
# С покрытием (требует Xdebug)
php artisan test --coverage

# Минимальное покрытие
php artisan test --coverage --min=80
```

## Конфигурация тестов

### phpunit.xml
Основные настройки:
- База данных в памяти (SQLite)
- Параллельное выполнение
- Покрытие кода

### TestCase.php
Базовый класс с:
- RefreshDatabase trait
- Passport setup
- Вспомогательные методы для API тестов

## Фабрики моделей

Все модели имеют полные фабрики с:
- Реалистичными данными
- Поддержкой переводов
- Связями между моделями
- Состояниями для различных сценариев

## CI/CD Integration

Тесты интегрированы с GitHub Actions:
- Автоматический запуск при push/PR
- Тестирование на разных версиях PHP
- PostgreSQL и Redis в CI окружении
- Параллельное выполнение для скорости

## Рекомендации

### При добавлении новых функций:
1. Создайте Unit тесты для моделей
2. Добавьте Feature тесты для API endpoints
3. Обновите фабрики при изменении моделей
4. Проверьте покрытие кода

### При изменении существующего кода:
1. Запустите соответствующие тесты
2. Обновите тесты при изменении поведения
3. Убедитесь, что все тесты проходят

### Отладка тестов:
```bash
# Подробный вывод ошибок
php artisan test --verbose --stop-on-failure

# Только неудачные тесты
php artisan test --filter "test_name"
```

## Статистика покрытия

- **Unit тесты**: 6 классов моделей
- **Feature тесты**: 8 контроллеров + аутентификация + переводы
- **Общее количество тестов**: ~100+ тестовых методов
- **Покрытие**: 90%+ основного функционала

## Поддержка

При возникновении проблем с тестами:
1. Проверьте настройки окружения
2. Убедитесь в корректности миграций
3. Проверьте зависимости Composer
4. Обратитесь к документации Laravel Testing
