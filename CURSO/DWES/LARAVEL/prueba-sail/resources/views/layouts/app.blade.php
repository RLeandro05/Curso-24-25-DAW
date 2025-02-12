<!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
<head>
    </script>
</head>
<body style="font-family: 'figtree', sans-serif;">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <!--Cabecera de página-->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{$header}}
                </div>
            </header>
        @endisset
        <!--Contenido de página-->
        <main>
            {{$slot}}
        </main>
    </div>
</body></html>