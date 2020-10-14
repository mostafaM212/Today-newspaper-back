<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
    <div class="w-1/2 flex justify-center items-center">
        <div class="flex flex-col rounded-lg  border-dashed border-red-20">
            <div class="h-12 bg-red-800 rounded-lg0 justify-center text-3xl">
                <h1>Today</h1>
            </div>
            <div class="">
                Welcome {{$user->name}} to Today if you forget your password your password is
                <p class="text-green-600">Password : {{ $password }}</p>
            </div>
        </div>
    </div>
</body>
</html>
