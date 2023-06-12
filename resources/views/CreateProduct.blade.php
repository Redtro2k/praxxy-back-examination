<x-mail::message>
# Successfully Created new Product
 
{{$author}} has Created a new products to our company
 
<x-mail::button :url="$url">
View Product
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>