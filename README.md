# IceandFire - Topup Mama

A small set of rest API endpoints using Laravel(PHP), Vue.js, MysQL, Bootstrap, JavaScript, and Css that can be used for listing the names of books along with their authors and comment count, adding and listing anonymous comments for a book, and getting the character list for a book with:

* Display of movies movie data, fetched online from https://anapioficeandfire.com/.
* Book names in the book list endpoint are sorted by release date from earliest to newest 
and each book should be listed along with authors and count of comments.
* Comments are stored in a SQL database.
* The comment list is retrieved in reverse chronological order.
* Comments are retrieved along with the public IP address of the commenter.
and the UTC date & time they were stored.
* Comment length is limited to 500 characters.
* Error responses returned in case of errors.
* Character list endpoint accepts sort parameters to sort by one of name, gender, or age in ascending or descending order.
* Character listendpoint also accepts a filter parameter to filter by gender.
* The response from character list endpoint also returns metadata that contains the total number of
 characters that match the criteria.

You can check it live [on this website](https://iceandfire-topupmama.herokuapp.com/), no authentication needed.

Notice that data in the comment section is dummy data, for demo purposes.

## API endpoints

These endpoints allow you to handle the fetching of data from api end-points implemented.


### Following are the Models
* Comments

##### Comments
* Comments POST Create `api/comment`
` (Route::post('comment', [BookController::class, 'storeComment']))`
* Comments GET Single (Parameters passed via axios to request variable in controller) `api/comments`
` (Route::get('comments', [BookController::class, 'showComments']))`
* Comments GET All `api/get-comments-count`
` (Route::get('get-comments-count', [BookController::class, 'getCommentsCount'])`

##### Books
* Books GET All `api/books`
`(Route::get('books', [BookController::class, 'index']))`

##### Characters
* Post GET Single (Parameters passed via axios to request variable in controller) `api/characters`
` (Route::get('characters', [BookController::class, 'getCharacters']))`


## Main dependencies

Front-end:
* [Vue](https://github.com/vuejs/vue)
* [Axios](https://axios-http.com/docs/intro)
* [VueRouter](https://github.com/vuejs/vue-router)
* [Bootstrap 4](https://github.com/twbs/bootstrap)
* [Laravel Echo](https://github.com/laravel/echo)
* [Laravel Mix](https://github.com/JeffreyWay/laravel-mix)

Back-end:
* [Laravel](https://github.com/laravel/laravel)
* [Guzzle](https://docs.guzzlephp.org/en/stable/)
* [Laravel Sanctum](https://github.com/laravel/sanctum)
* [laravel-vue-i18n-generator](https://github.com/alefesouza/laravel-vue-i18n-generator)


## Steps to run it:

### Common way (NPM)

Rename the .env.example file to .env, and fill it with your local info, then:

Install PHP and JavaScript dependencies:

    composer install
    npm install

Generate Laravel keys:

    php artisan key:generate

Migrate and seed the database:

    php artisan migrate --seed

Compile all the front-end stuff for development:

    npm run watch (For development)

Compile all the front-end stuff for development:

    npm run production (For production)