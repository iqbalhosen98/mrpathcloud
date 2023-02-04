@extends('shop::customers.account.index')

@include('shop::guest.compare.compare-products')

@section('page_title')
    {{ __('shop::app.customer.compare.compare_similar_items') }}
@endsection

@section('account-content')
    <div class="account-layout">
        {!! view_render_event('mrpath.shop.customers.account.comparison.list.before') !!}

        <div class="account-items-list">
            <div class="account-table-content">
                <compare-product></compare-product>
            </div>
        </div>

        {!! view_render_event('mrpath.shop.customers.account.comparison.list.after') !!}
    </div>
@endsection
