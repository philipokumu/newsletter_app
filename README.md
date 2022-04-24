## About this Ecommerce application

The application showcases a no frills light weight newsletter application made with Laravel and Vue 3. The backend uses Laravel, and frontend uses Vue Js.

## Setup

You can setup this application using docker:

### Docker Setup

1. Run entrypoint file(Only for initial setup on your machine)

```
./entrypoint.sh
```

2. If you want to reopen the application i.e. after initial setup, use this command:

```
docker-compose -f docker-compose.yml up -d
```

3. Front end link: http://localhost:8084

## Points of improvement in the application

-   Better frontend validation of fields
-   Caching to improve speed and scalability

## Notable features of the application

-   All endpoints are created using the Test Driven Development approach
