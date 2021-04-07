<h2 style="float:left">Basket</h2>
<a href="#" class="btn-cart-close tooltips" title="Hide Basket" data-id="1" style="position: relative;float: right; top:0px; margin-top: 0px;padding: 0px;border: 1px solid #ddd;width: 31px;height: 32px;border-radius: 50%;text-align: center;line-height: 30px;right: 2em;    margin-bottom: 8px;"><i class="fa fa-times"></i></a>
<div class="clearfix"></div>
<ul class="cd-cart-items">
  @if(count($items))
    @foreach($items as $row)
    <li>
      <img src="{{url('uploads/products/thumbs/'.$row->attributes->data->images()->ordered()[0]->file_name)}}" style="max-width:98px; float: left; border: 1px solid rgb(216,186,177);" />
      <div style="float: left; padding-left: 10px;">
        <a href="{{url('product/'.$row->attributes->data->slug)}}">{{$row->name}}</a> <br />
        <a href="{{url('category/'.$row->attributes->data->category()->first()->slug)}}">{{$row->attributes->data->category()->first()->name}}</a>
        @if($row->attributes->data->subcategory()->count())
        > <a href="{{url('subcategory/'.$row->attributes->data->subcategory()->first()->slug)}}">{{$row->attributes->data->subcategory()->first()->name}}</a>
        @endif
        <div class="cd-price">${{$row->price}}</div>
        <div class="input-group" style="float:left; width: 100px;">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary btn-sm minus-btn minus-btn-sidebar"><i class="fa fa-minus" style="font-weight:normal; font-size:10px;"></i></button>
          </div>
          <input type="text" class="form-control form-control-sm qty_input qty_input_update" data-id="{{$row->id}}" value="{{$row->quantity}}"  min="1" style="background-color: #FFF">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary btn-sm plus-btn plus-btn-sidebar"><i class="fa fa-plus" style="font-weight:normal; font-size:10px;"></i></button>
          </div>
        </div>
        <a href="#0" class="cd-item-remove cd-img-replace" data-id="{{$row->id}}"><i class="fa fa-times"></i></a>
      </div>
    </li>
    @endforeach
  @else
    <li><i>No Item In Cart</i></li>
  @endif
</ul> <!-- cd-cart-items -->
<div class="cd-cart-total">
  <p>TOTAL <span>USD {{$total}}</span></p>
</div> <!-- cd-cart-total -->
<div class="clearfix"></div>
<a href="{{url('checkout')}}" class="btn btn-secondary btn-block checkout-btn">Checkout</a>
<a href="{{url('shopping_cart')}}" class="btn btn-secondary btn-block checkout-btn">View Basket</a>
<!--<p class="cd-go-to-cart"><a href="#" class='btn-cart-close tooltips' title="Hide Basket"><i class="fa fa-times"></i></a></p>-->

<script>
@if(Cart::getTotalQuantity())
$(".cart-count").html('{{Cart::getTotalQuantity()}}').css('display','block');
@else
$(".cart-count").html('0').css('display','none');
@endif

$('.tooltips').tooltipster({
  theme: 'tooltipster-borderless'
});

$(document).on("click",".btn-cart-close",function(e){
  e.preventDefault();
  $("#cd-cart-trigger").trigger('click');
});
</script>
