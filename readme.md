# Module 27. Gallery

Настройки соединения к базе данных (БД) находятся в файле 'config/db_config.php'. Измените их на свои.

Данные базы храняться в папке DB_Dump в двух вариантых:
- В папке Tables скрипты для создания таблиц по отдельности
- В папке Full_Schema один скрипт, востанавливает БД полностью.

У уже включенных в БД пользователей пароль 'password', а логины можно увидеть кликнув меню "Users"

## Внимание!
После отпарвки комментария для возврата к галерии выберите меню "Gallery", т.к. при этом Location перегружается для показа нового комментария (история сбрасывается), из-за этого кнопка браузера "Назад" вернет в пустоту.

    Файлы изображений записываются на диск (имена файлов шифруются), а комментарии хранятся в БД.
