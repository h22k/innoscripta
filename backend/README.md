# Laravel

## Sources
I have used 3 different sources as asked from me, these sources can be counted as NewsAPI, The Guardian and New York Times.

## Structure
I have all I need about the news sources inside of `config/news.php`,
I suggest you to take a look to get a better understanding.
I used Schedule Task that sends a request to the 3 different sources once in every minute,
which Cronjob service triggers, and as can be seen in the artisan command that I have written,
I put all the data fetching process to the queue and monitor that process from the Horizon.
Inside of `storage/logs`,  you will find `laravel.log` and `cron.log` files. You can follow the Cronjob and Schedule Task process' from there.

## PHP
Since I have used PHP 8.2 >, I have tried to follow trends and integrated them in to my code.

- Match statement | `app/Components/News/NewsClientFactory.php`
- Constructor property promotion | `app/Components/News/NewsContext.php`
- Readonly keyword | `app/Components/News/NewsClientFactory.php`

## Testing
I wrote some tests for Auth process, so that you guys can run tests.
Only thing you should do for running tests is run `docker compose exec backend bash` and after that `php artisan test` inside of container bash.

## ENV
I have added some keys to `.enx.example` that you must fill them for fetching news from sources. 
_**I did not check wheter keys are valid!**_

## Tools
- Laravel Horizon to monitor queue processes.

## HTTP Client
I have also used pool method for the HTTP Requests so with the async structure, it gave me some performance.
I have created seperate HTTP clients for all sources with macro method that Laravel's HTTP's macroable trait has.
Apart from those, I have created some exception classes and tried to catch them with global handlers.
And I also have a fixed response structure that you can find in `app/Http/Response/ApiResponse.php` .

## Process
In short the proccess is as follows, http client sends a requests, than converter takes the response and converts it into a befiting form for the database.
After that, processor takes the information - author,  category,  source,  news - and saves them to the database.

## Code Quality
I have tried to follow the SOLID, KISS and DRY principles as much as I can and also followed some design patterns that I will talk more about  in a little bit and I thought were useful.

- As for the model filtering, I have used filter classes to make the
  code more readable and easier to test, you can take a look at them at
  `app/Filters`.
- With using dependency injection, I have validated the inputs inside FormRequest classes.
- Created some traits for the classes that I have used the same methods inside.
- Since data structures are not same for data I have fetched from the sources, I have used Strategy Pattern inside of Converter class. You can see it in `app/Components/News/Converters`.
- I have followed Factory Pattern. You can also find this in `app/Components/News/*Factory.php`.
