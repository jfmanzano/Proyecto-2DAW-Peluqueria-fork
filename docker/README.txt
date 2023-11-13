
Set up containers in production environment:
    $> env $(cat .env.prod) docker-compose up -d

Set up containers in development environment:
    $> env $(cat .env.dev) docker-compose up
