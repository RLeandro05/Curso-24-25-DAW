<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">

<head>
</head>

<body style="font-family: 'figtree', sans-serif;">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <main>
            {{$slot}}
        </main>
    </div>
</body>

</html>