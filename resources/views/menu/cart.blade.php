@extends('layouts.frontend')
@section('content')
@php
    $total = 0;
@endphp
<div class="container">
   <div class="checkout-style-2">
            <div class="checkout-header d-flex justify-content-between">
               <h6 class="title">Shopping Cart</h6>
            </div>
         @if(session('cart'))
            <div class="checkout-table">
               <table class="table">
                     <tbody>
                     
                        @foreach (session('cart') as $id => $details)
                           @php
                                 $total += $details['price'] * $details['quantity'];
                           @endphp
                           <tr>
                                 <td class="checkout-product">
                                    <div class="product-cart d-flex">
                                       <div class="product-thumb">
                                             <img src="{{ asset('images/'.$details['image']) }}" alt="Product" height="300" width="300"/>
                                       </div>
                                       <div class="product-content media-body">
                                             <h5 class="title">
                                                <a href="product-details-page.html">{{ $details['name'] }}</a>
                                             </h5>
                                             <ul>
                                                <li>
                                                   <a class="delete" href="javascript:void(0)">
                                                         <i class="mdi mdi-delete"></i>
                                                   </a>
                                                </li>
                                             </ul>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="checkout-quantity">
                                    <div class="product-quantity d-inline-flex">
                                       <button type="button" id="sub" class="sub">
                                             <i class="mdi mdi-minus"></i>
                                       </button>
                                       <input type="text" value="{{ $details['quantity'] }}">
                                       <button type="button" id="add" class="add">
                                             <i class="mdi mdi-plus"></i>
                                       </button>
                                    </div>
                                 </td>
                                 <td class="checkout-price">
                                    <p class="price">Rp.{{ $details['price'] * $details['quantity'] }}</p>
                                 </td>
                           </tr>
                        @endforeach
                     </tbody>
               </table>
            </div>

            <div class="checkout-footer">
               <div class="checkout-sub-total d-flex justify-content-between">
                     <p class="value">Subtotal Price:</p>
                     <p class="price">Rp.{{ $total }}</p>
               </div>
               <div class="checkout-btn">
                     <a href="#" class="main-btn primary-btn-border">View
                        Cart</a>
                     <a href="#" class="main-btn primary-btn">Checkout</a>
               </div>
            </div>
         @endif
         </div>
   </div>
</div>
@endsection