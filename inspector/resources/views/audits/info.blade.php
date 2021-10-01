<table class="table">
    <tbody>
    <tr>
        <th scope="row">HOST</th>
        <td>{{ $site->host }}</td>
    </tr>
    <tr>
        <th scope="row">Протокол</th>
        <td>{{ $site->https ? 'HTTPS' : 'HTTP' }}</td>
    </tr>
    <tr>
        <th scope="row">Добавлен</th>
        <td>{{ date('d.m.Y', strtotime($site->created_at)) }}</td>
    </tr>
    </tbody>
</table>
