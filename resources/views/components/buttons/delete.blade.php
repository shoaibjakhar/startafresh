<a {{ $attributes->merge(['class' => "btn btn-sm btn-danger"]) }} >
    
    <i class="bi bi-trash"></i> 
    
    {{ $slot }}

</a>