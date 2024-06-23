<x-mail::message>
# {{ $name }} 様

予約登録が完了しました。変更がある場合は下記より押下してください。

<x-mail::button :url="$url ">
予約情報変更
</x-mail::button>

本システムをご登録いただきありがとうございます。<br>
{{ config('app.name') }}
</x-mail::message>