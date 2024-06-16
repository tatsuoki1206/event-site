<x-mail::message>
# {{ $name }} 様

ユーザー退会が完了しました。またのご利用をお待ちしております。

<x-mail::button :url="$url ">
イベント管理システム
</x-mail::button>

本システムをご登録いただきありがとうございました。<br>
{{ config('app.name') }}
</x-mail::message>