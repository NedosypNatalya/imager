<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')

<script>
function getDataKeyup($input_id, $datalist_id, $category, $url, $count = 10){
    $($input_id).keyup(function(e) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //e.preventDefault();
        $.ajax({
            type: "POST",
            url: $url,
            data: { 
                _token: CSRF_TOKEN, 
                message:$($input_id).val(),
                count: $count,
                category: $category
            },
            dataType: 'JSON',
            success: function(response){
                res = response.data.suggestions;
                options = "";
                if(res){
                    res.forEach(function(item, i, res) {
                    options += "<option value='"+item.value+"'>";
                    });
                    $($datalist_id).html(options);
                }
            }
       });
    });
}
$(document).ready(function() {
    getDataKeyup("#address", "#items-address", "address", "/register/address");
    getDataKeyup("#email", "#items-email", "email", "/register/email", 5);

   /* $("#form-add-comment").on('submit', function (e) {   
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: '/comment/store',
            data: { 
                _token: CSRF_TOKEN, 
                text:$("#text").val(),
                post_id: $("#post_id").val(),
                user_id: $("#user_id").val(),
            },
            dataType: 'JSON',
            success: function(response){
                result = response.data;
                if(result){
                    $("#comments-block").append("<div class='alert alert-secondary' role='alert'><a href='#' class='alert-link'>"+result.user_id+"</a>"+result->text+"</div>");
                }
            }
       });
    });
*/




    $("#store-comment").click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: '/comment/store',
            data: {
                _token: CSRF_TOKEN, 
                text: $("#text").val(),
                post_id: $('#store-comment').attr('post-id')
            },
            dataType: 'JSON',
            success: function(response){
                result = response.data;
                if(result){
                    $("#comments-block").append(
                    "<div class='alert alert-secondary' role='alert'>"+
                        "<a href='#' class='alert-link'>"+result.user_name+"</a>"+result.text+"</div>");
                }
            }
       });
    })

    $("#store-comment-edit-post").click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: '/comment/store',
            data: {
                _token: CSRF_TOKEN, 
                text: $("#text").val(),
                post_id: $('#store-comment-edit-post').attr('post-id')
            },
            dataType: 'JSON',
            success: function(response){
                result = response.data;
                if(result){
                    $("#comments-block").append(
                    "<div class='alert alert-secondary' role='alert'>"+
                        "<a href='#' class='alert-link'>"+result.user_name+"</a>"+result.text+
                        "<form method='get' action='/comment/"+result.comment_id+"/edit'><input class='btn btn-outline-primary' type='submit' value='Изменить'></form>"+
                        "<form method='post' action='/comment/"+result.comment_id+"'><input class='btn btn-outline-danger' type='submit' value='Удалить'></form>"+
                    "</div>");
                }
            }
       });
    })

   /* $('#address').keyup(function(e) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/register/address',
            data: { 
                _token: CSRF_TOKEN, 
                message:$("#address").val(),
                count: 10,
                category: "address"
            },
            dataType: 'JSON',
            success: function(response){
                res = response.data.suggestions;
                options = "";
                if(res){
                    res.forEach(function(item, i, res) {
                    options += "<option value='"+item.value+"'>";
                    });
                    $('#items-address').html(options);
                }
            }
       });
    });
    $('#email').keyup(function(e) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/register/email',
            data: { 
                _token: CSRF_TOKEN, 
                message:$("#email").val(),
                count: 5,
                category: "email"
            },
            dataType: 'JSON',
            success: function(response){
                res = response.data.suggestions;
                options = "";
                if(res){
                    res.forEach(function(item, i, res) {
                    options += "<option value='"+item.value+"'>";
                    });
                    $('#items-email').html(options);
                }
            }
       });
    });*/
});
</script>
</body>
</html>