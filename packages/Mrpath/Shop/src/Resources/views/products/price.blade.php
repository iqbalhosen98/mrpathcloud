{!! view_render_event('mrpath.shop.products.price.before', ['product' => $product]) !!}

<div class="product-price">
    {!! $product->getTypeInstance()->getPriceHtml() !!}
</div>

{!! view_render_event('mrpath.shop.products.price.after', ['product' => $product]) !!}