<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


## API

- /api/register - регистрация<br>
Заголовок GET-запроса: Accept - application/json<br>
Роут: 
```
    Route::post('register', 'API\RegisterController@register')->name('register_api');
```
Тело запроса:
```
    {
        "name" : "Иван",
        "email" : "email@email.com",
        "password" : "123456",
        "c_password" : "123456",
        "address" : "Тамбов"
    }
```
Ответ:
```
    {
        "success": true,
        "data": {
            "token": "token",
            "name": "asd"
        },
        "message": "User register successfully."
    }
```

- /api/login - авторизация<br>
Роут: 
```
    Route::post('login', 'API\LoginController@login')->name('login_api');
```
Заголовок POST-запроса: Accept - application/json<br>
Тело запроса:
```
    {
        "email" : "email@email.com",
        "password" : "123456"
    }
```
Ответ:
```
    {
        "success": true,
        "data": {
            "token_type": "Bearer ",
            "token": "token"
        },
        "message": "User authorizate successfully."
    }
```

- /api/all_posts - получение списка всех постов<br>
Роут: 
```
    Route::get('all_posts', 'API\PostController@getAllPosts');
```
Заголовок GET-запроса: Accept - application/json<br>
Ответ:
```
    {
        "success": true,
        "data": [
            {
                "id": 1,
                "title": "Заголовок",
                "content": "Текст поста",
                "user_id": 1,
                "created_at": "",
                "updated_at": ""
            },
            ...
        ],
        "message": "All posts retrieved successfully."
    }
```

- /api/posts - получение списка постов авторизированного пользователя<br>
Роут: 
```
    Route::resource('posts', 'API\PostController');
```
Заголовоки GET-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Ответ:
```
    {
        "success": true,
        "data": [
            {
                "id": 1,
                "title": "Заголовок",
                "content": "Текст поста",
                "user_id": 1,
                "created_at": "2020-07-03T12:35:54.000000Z",
                "updated_at": "2020-07-03T12:35:54.000000Z"
            },
            ...
        ],
        "message": "My posts retrieved successfully."
    }
```

- /api/posts - создание поста<br>
Роут: 
```
    Route::resource('posts', 'API\PostController');
```
Заголовоки POST-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Тело запроса:
```
    {
        "title": "Заголовок",
        "content": "Текст"
    }
```
Ответ:
```
    {
        "success": true,
        "data": {
            "title": "Заголовок",
            "content": "Текст",
            "user_id": 1,
            "updated_at": "2020-07-03T12:35:54.000000Z",
            "created_at": "2020-07-03T12:35:54.000000Z",
            "id": 1
        },
        "message": "Post created successfully."
    }
```

- /api/posts/{post} - просмотр поста<br>
Роут: 
```
    Route::resource('posts', 'API\PostController');
```
Заголовоки GET-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Ответ:
```
    {
        "success": true,
        "data": {
            "title": "Заголовок",
            "content": "Текст",
            "user_id": 1,
            "updated_at": "2020-07-03T12:35:54.000000Z",
            "created_at": "2020-07-03T12:35:54.000000Z",
            "id": 1
        },
        "message": "Post retrieved successfully."
    }
```

- /api/posts/{post} - изменение поста<br>
Роут: 
```
    Route::resource('posts', 'API\PostController');
```
Заголовоки PUT-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Тело запроса:
```
    {
        "title": "Новый заголовок",
        "content": "Новый текст"
    }
```
Ответ:
```
    {
        "success": true,
        "data": {
            "title": "Заголовок",
            "content": "Текст",
            "user_id": 1,
            "updated_at": "2020-07-03T12:35:54.000000Z",
            "created_at": "2020-07-03T12:35:54.000000Z",
            "id": 1
        },
        "message": "Post updated successfully."
    }
```

- /api/posts/{post} - удаление поста<br>
Роут: 
```
    Route::resource('posts', 'API\PostController');
```
Заголовоки DELETE-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Ответ:
```
    {
        "success": true,
        "data": {
            "title": "Заголовок",
            "content": "Текст",
            "user_id": 1,
            "updated_at": "2020-07-03T12:35:54.000000Z",
            "created_at": "2020-07-03T12:35:54.000000Z",
            "id": 1
        },
        "message": "Post deleted successfully."
    }
```

- /api/comments - просмотр всех комментариев<br>
Роут: 
```
    Route::get('/comments', 'API\CommentController@showAllComments');
```
Заголовоки GET-запроса:<br>
Accept - application/json<br>
Ответ:
```
    {
    "success": true,
    "data": [
        {
            "id": 1,
            "text": "Текст комментария",
            "post_id": 1,
            "user_id": 1,
            "created_at": "2020-07-02T08:48:09.000000Z",
            "updated_at": "2020-07-02T08:48:09.000000Z"
        },
        ...
    ],
    "message": "All comments retrieved successfully."
}
```

- /api/posts/{post}/comments - просмотр комментариев определённого поста<br>
Роут: 
```
    Route::get('posts/{post}/comments', 'API\CommentController@showCommentsSinglePost');
```
Заголовоки GET-запроса:<br>
Accept - application/json<br>
Ответ:
```
    {
    "success": true,
    "data": [
        {
            "id": 1,
            "text": "Текст комментария",
            "post_id": 1,
            "user_id": 1,
            "created_at": "2020-07-02T08:48:09.000000Z",
            "updated_at": "2020-07-02T08:48:09.000000Z"
        },
        ...
    ],
    "message": "Comments of post - 15(id поста) retrieved successfully.."
}
```

- /api/posts/{post}/comment - создание комментария<br>
Роут: 
```
    Route::resource('/posts/{post}/comment', 'API\CommentController')->except(['edit', 'show', 'index']);
```
Заголовоки POST-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Тело запроса:
```
    {
        "text": "Текст комментария"
    }
```
Ответ:
```
    {
        "success": true,
        "data": {
            "text": "Текст комментария",
            "post_id": "1",
            "user_id": 1,
            "updated_at": "2020-07-03T11:16:24.000000Z",
            "created_at": "2020-07-03T11:16:24.000000Z",
            "id": 55,
            "user": {
                "id": 1,
                "name": "Иван",
                "email": "email@email.com",
                "email_verified_at": null,
                "created_at": "2020-06-30T08:21:43.000000Z",
                "updated_at": "2020-06-30T08:21:43.000000Z",
                "address": "Тамбов"
            }
        },
        "message": "Comment created successfully."
    }
```

- /api/posts/{post}/comment/{comment} - изменение комментария<br>
Роут: 
```
    Route::resource('/posts/{post}/comment', 'API\CommentController')->except(['edit', 'show', 'index']);
```
Заголовоки PUT-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Тело запроса:
```
    {
        "text": "Новый текст комментария"
    }
```
Ответ:
```
    {
       "success": true,
        "data": {
            "text": "Новый текст комментария",
            "post_id": "1",
            "user_id": 1,
            "updated_at": "2020-07-03T11:16:24.000000Z",
            "created_at": "2020-07-03T11:16:24.000000Z",
            "id": 55,
            "user": {
                "id": 1,
                "name": "Иван",
                "email": "email@email.com",
                "email_verified_at": null,
                "created_at": "2020-06-30T08:21:43.000000Z",
                "updated_at": "2020-06-30T08:21:43.000000Z",
                "address": "Тамбов"
            }
        },
        "message": "Comment update successfully."
    }
```

- /api/posts/{post}/comment/{comment} - удаление комментария<br>
Роут: 
```
    Route::resource('/posts/{post}/comment', 'API\CommentController')->except(['edit', 'show', 'index']);
```
Заголовоки DELETE-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Ответ:
```
    {
       "success": true,
        "data": {
            "text": "Новый текст комментария",
            "post_id": "1",
            "user_id": 1,
            "updated_at": "2020-07-03T11:16:24.000000Z",
            "created_at": "2020-07-03T11:16:24.000000Z",
            "id": 55,
            "user": {
                "id": 1,
                "name": "Иван",
                "email": "email@email.com",
                "email_verified_at": null,
                "created_at": "2020-06-30T08:21:43.000000Z",
                "updated_at": "2020-06-30T08:21:43.000000Z",
                "address": "Тамбов"
            }
        },
        "message": "Comment delete successfully."
    }
```

- /api/profile - получение данных пользователя<br>
Роут: 
```
    Route::get('profile', 'API\ProfileController@show');
```
Заголовоки GET-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Ответ:
```
    {
        "success": true,
        "data": {
            "id": 1,
            "name": "Иван",
            "email": "email@email.com",
            "email_verified_at": null,
            "created_at": "2020-06-26T06:55:12.000000Z",
            "updated_at": "2020-06-29T05:30:35.000000Z",
            "address": "Тамбов"
        },
        "message": "User retrieved successfully."
    }
```

- /api/profile - изменение данных пользователя<br>
Роут: 
```
    Route::post('profile', 'API\ProfileController@update')->name('profile_api');
```
Заголовоки POST-запроса:<br>
Accept - application/json<br>
Authorization - Bearer token<br>
Тело запроса:
```
    {
        "name" : "Иван",
        "email" : "email@email.com",
        "password": "000000",
        "c_password": "000000",
        "address": "Москва"
    }
```
Ответ:
```
    {
        "success": true,
        "data": {
            "id": 1,
            "name": "Иван",
            "email": "email@email.com",
            "email_verified_at": null,
            "created_at": "2020-06-26T06:55:12.000000Z",
            "updated_at": "2020-07-03T13:24:45.000000Z",
            "address": "Москва"
        },
        "message": "Profile updated successfully."
    }
```
