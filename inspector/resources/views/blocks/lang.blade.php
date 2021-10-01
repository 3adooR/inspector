<div class="lang">
    <a href="{{ ($lang === 'en') ? str_replace('/en/', '/ru/', url()->current()) : '#' }}"
       class="small @if($lang === 'ru') active @endif">RU</a>
    <a href="{{ ($lang === 'ru') ? str_replace('/ru/', '/en/', url()->current()) : '#' }}"
       class="small @if($lang === 'en') active @endif">EN</a>
</div>
