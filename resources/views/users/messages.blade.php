<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}"></meta>
    <title>Document</title>
</head>
<body>
<body>

<script src="{{ asset('/js/app.js') }}"></script>
<script>
    Echo.channel('test')
        .listen('MessageEvent', e => {
            console.log(e)
        })
</script>

</body>
</body>
</html>
