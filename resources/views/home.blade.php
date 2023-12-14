<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    @auth
        <p>you are logged in </p>
        <form action="/logout" method="POST">
        @csrf
        <button>log out</button>
        </form>

        <div style="border:3px dotted black ">
            <h2>create a new post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="title" >
                <textarea name="body" placeholder="the post will be written here" ></textarea>
                <button>post</button>
            </form>
        </div>

        <div style="border:3px dotted black;background-color:yellow ">
            <h2>all posts</h2>
            @foreach ($posts as $post)
                <div style="background-color:gray;padding:15px;margin:15px;" >
                    <h3>{{ $post['title']  }} by {{ $post->test->name }}</h3>
                    {{ $post['body'] }}
                    <p><a href="/edit-post/{{ $post['id'] }}">edite</a></p>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endauth

    @guest
    <div style="border:3px dotted black ">
        <h2> Register </h2>
        <form action="register" method="POST">
            @csrf
            <input type="text" name="name" id="" placeholder="name">
            <input type="text" name="email" id="" placeholder="email">
            <input type="password" name="password" id="" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <br>
    <div style="border:3px dotted black ">
        <h2> login </h2>
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="loginname" id="" placeholder="login">
            <input type="password" name="loginPassword" id="" placeholder="password">
            <button>log in</button>
        </form>
    </div>
    @endguest

</body>
</html>
