<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>{{ $band->name }}</title>
</head>
<body>

    <h1>{{ $band->name }}</h1>

    <h2>Discografia</h2>

    <p>Total de álbuns: {{ $band->albums->count() }}</p>

    <table width="100%" border="1" cellpadding="8">
        <tr>
            <th>Álbum</th>
            <th>Data de lançamento</th>
        </tr>

        @foreach ($band->albums as $album)
            <tr>
                <td>{{ $album->name }}</td>
                <td>{{ $album->release_date }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
