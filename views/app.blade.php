<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="theme-color" content="{{ $forum->attributes->themePrimaryColor }}">

    @foreach ($styles as $file)
      <link rel="stylesheet" href="{{ str_replace(public_path(), '', $file) }}">
    @endforeach

    {!! $head !!}
  </head>

  <body>
    {!! $layout !!}

    <div id="modal"></div>
    <div id="alerts"></div>

    @foreach ($scripts as $file)
      <script src="{{ str_replace(public_path(), '', $file) }}"></script>
    @endforeach

    <script>
      try {
        var app = System.get('flarum/app').default;
        app.preload = {
          data: {!! json_encode($data) !!},
          document: {!! json_encode($document) !!},
          session: {!! json_encode($session) !!}
        };

        @foreach ($bootstrappers as $bootstrapper)
          System.import('{{ $bootstrapper }}');
        @endforeach

        app.boot();
      } catch (e) {
        document.write('<div class="container">Something went wrong.</div>');
        throw e;
      }
    </script>

    @if ($content)
      <noscript>
        {!! $content !!}
      </noscript>
    @endif

    {!! $foot !!}
  </body>
</html>