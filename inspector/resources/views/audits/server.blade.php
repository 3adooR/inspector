@if(!empty($data))
    <table class="table">
        <tbody>
        <tr>
            <th scope="row">IP</th>
            <td>{{ $ip }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('app.lat') }}</th>
            <td>{{ $lat }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('app.long') }}</th>
            <td>{{ $long }}</td>
        </tr>
        @if(!empty($data['city']))
            <tr>
                <th scope="row">{{ __('app.city') }}</th>
                <td>{{ $data['city'] }}</td>
            </tr>
        @endif
        @if(!empty($data['region']))
            <tr>
                <th scope="row">{{ __('app.region') }}</th>
                <td>{{ $data['region'] }}</td>
            </tr>
        @endif
        </tbody>
    </table>
@endif
