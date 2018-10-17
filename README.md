Тестовое задание.

Миграции :
> php yii migrate

> php yii migrate --migrationPath=@yii/rbac/migrations

Добавить роли:
> php yii rbac/init

Добавить пользователя-администратора admin@eno.test 111111 :
> php yii misc/create-admin

Добавить роль администратора определенному пользователю :
> php yii rbac/set-administrator {user_id}

Фронтенд по основному адресу
Бекенд по /backend

См. файл конфига nginx nginx.conf.sample