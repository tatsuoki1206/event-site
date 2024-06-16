<x-mail::message>
# {{ $name }} 様

ユーザー登録が完了しました。ログイン出来るかお試しください。

<x-mail::button :url="$url ">
ログイン画面へ
</x-mail::button>

本システムをご登録いただきありがとうございます。<br>
{{ config('app.name') }}
</x-mail::message>