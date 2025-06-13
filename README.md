# Pizza Order API

API para gestionar pedidos de pizzas usando Symfony, Doctrine y DTOs para la transferencia de datos.

---

## Descripción

Este proyecto permite crear y consultar pedidos de pizzas con sus ingredientes, precio y detalles. Usa entidades Doctrine para la persistencia, y DTOs para estructurar la salida JSON de manera limpia y evitar ciclos de serialización.

---

## Tecnologías usadas

- PHP 8+
- Symfony 6+
- Doctrine ORM
- Symfony Serializer
- API REST JSON

---

## Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/tu_usuario/tu_repositorio.git
cd tu_repositorio
composer install
DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_name"
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony serve
