<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="//api.bitrix24.com/api/v1/"></script>
    @vite('resources/js/index.js')
</head>
<body>
<div id="app"></div>
<script>
    const AUTH_OBJECT = {!! $authObject !!};
    const PLACEMENT_OPTIONS = {!! $placementOptions !!};
</script>
</body>
</html>
