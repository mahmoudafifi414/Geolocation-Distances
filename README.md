## About Environment

- Laravel Framework 10.21.0
- PHP v8.2
- PositionStack geolocation api provider

## How To Run This Project

1- In the main folder run "docker compose up -d --build"

2- In the src folder:

- Create your own .env file (you should take it from .env.example).
- Fill **POSITIONSTACK_API_KEY** env variable with your own position stack api key.
- Run: "composer install".
- Go inside the container by "docker exec -it php-app bash"
- Run inside the container: "php artisan app:list-location-distances" -> to run the custom command.
- You should get the results in table, and you should get the distances.csv file inside "storage/app".
- About the previous point you may need to give permission inside storage folder by for example "chmod -R 777 ./storage"
## Notes

- The Entire Location logic inside "src/LocationBundle" Folder.
- Sometimes "PositionStack" provider return 400 so please retry again until it return results.
- We send request per location because we can't send batch location to be processed once because our position stack plan api key is send one request only.

## Tests

- We apply only unit test, so you can find it in Tests/Unit Folder
- To run it run inside the container the command "./vendor/bin/phpunit"