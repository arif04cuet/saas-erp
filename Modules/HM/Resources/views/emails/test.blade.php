@component('mail::message')
    # Introduction

    The body of your message.

    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent
    @component('mail::table')
        | Syntax      | Description | Test Text     |
        | :---        |    :----:   |          ---: |
        | Header      | Title       | Here's this   |
        | Paragraph   | Text        | And more      |
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
