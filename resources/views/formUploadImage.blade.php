<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route('upload_file') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="file" multiple name="file[]">
        <button type="submit">Загрузить</button>
    </form>

    <img width="200px" src="/storage/images/1593067438_picture.jpg" alt="dsfdf">
</body>
</html>