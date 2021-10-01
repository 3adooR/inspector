@if(!empty($data))
    <table class="table">
        <tbody>
        @foreach($data as $dataKey => $dataItem)
            <tr>
                <th scope="row">{{ $dataItem['name'][$lang] }}</th>
                <td>{{ $dataItem['value'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
