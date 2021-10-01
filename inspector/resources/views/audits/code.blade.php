<table class="table">
    <tbody>
    @if(!empty($link))
        <tr>
            <th scope="row">{{ __('app.validator-link') }}</th>
            <td><a target="_blank" href="{{ $link }}">{{ __('app.validator-link-text') }}</a></td>
        </tr>
    @endif
    @if(isset($valid))
        <tr>
            <th scope="row">{{ __('app.validator-status') }}</th>
            <td>
                @if($valid)
                    {{ __('app.validator-status-valid') }}
                @else
                    {{ __('app.validator-status-invalid') }}
                @endif
            </td>
        </tr>
    @endif
    @if(!empty($errors))
        <tr>
            <th scope="row">{{ __('app.validator-errors') }}</th>
            <td>{{ $errors }}</td>
        </tr>
    @endif
    @if(!empty($warnings))
        <tr>
            <th scope="row">{{ __('app.validator-warnings') }}</th>
            <td>{{ $warnings }}</td>
        </tr>
    @endif
    </tbody>
</table>
