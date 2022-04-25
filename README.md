## About this Ecommerce application

The application showcases a no frills light weight newsletter application made with Laravel and Vue 3. The backend uses Laravel, and frontend uses Vue Js.

## Setup

You can setup this application using docker:

### Docker Setup

1. If you would want to run the project on a different port, consider changing MIX_APP_URL in .env.example. Current setup uses port 8084
2. Run entrypoint file(Only for initial setup on your machine)

```
./entrypoint.sh
```

3. Front end link: http://localhost:8084/login
4. If you don't see any subscribers after login in to the site, reload page. This is a work around because of the asynchronous request. I will fix the logic later on.

### Reopen application(if need be)

If you want to reopen the application i.e. after initial setup, use this command:

```
docker-compose -f docker-compose.yml up -d
```

## Points of improvement in the application

-   Better frontend validation of fields
-   Frontend routes and authentication needs streamlining
-   Caching to improve speed and scalability
-   PSR-2 compliance

## Notable features of the application

-   All endpoints are created using the Test Driven Development approach
