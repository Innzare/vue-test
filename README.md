# База данных mysql
База данных состоит из одной таблицы workers со следующими полями
``` 
 - id FKEY, INT NOT NULL
 - name VARCHAR NULL
 - department VARCHAR NULL
 - expierence VARCHAR NULL
 - phone VARCHAR NULL
```
Дамп БД лежит в `stuff/vue-test.sql`

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Setup project for work with backend
```
Загрузить миграцию `stuff/vue-test.sql`
Отредактировать конфиги доступа к БД, если надо в `api/config.php`
Сбилдить проект и открыть его на локальном хостинге.
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
