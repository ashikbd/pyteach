// Back to Top
$(window).scroll(function(){
	if ($(this).scrollTop() > 1) {
			$('.backTop').css({bottom:"25px"});
		} else {
			$('.backTop').css({bottom:"-100px"});
		}
	});
	$('.backTop').click(function(){
		$('html, body').animate({scrollTop: '0px'}, 800);
		return false;
});


// navbar fix to top
$(window).scroll(function () {
	//if you hard code, then use console
	//.log to determine when you want the
	//nav bar to stick.
	// console.log($(window).scrollTop())
	if ($(window).scrollTop() > 150) {
			$('.main-menu').addClass('fixed-top clearfix');
			$("#mini-logo").removeClass('invisible');
	}
	if ($(window).scrollTop() < 151) {
		$('.main-menu').removeClass('fixed-top clearfix');
		$("#mini-logo").addClass('invisible');
	}
	/*if ($(window).width() < 767) {
		if ($(window).scrollTop() > 120) {
			$('.white-transparant').addClass('fixed-top clearfix');
		}
		if ($(window).scrollTop() < 119) {
			$('.white-transparant').removeClass('fixed-top clearfix');
		}
	}
	else {
		if ($(window).scrollTop() > 182) {
			$('.main-menu').addClass('fixed-top clearfix');
		}
		if ($(window).scrollTop() < 181) {
			$('.main-menu').removeClass('fixed-top clearfix');
		}
	}*/
});// JavaScript Document



$(document).ready(function() {
	$('.tooltips').tooltipster({
		theme: 'tooltipster-borderless'
	});

  var sync1 = $("#sync1");
  var sync2 = $("#sync2");

  sync1.owlCarousel({
	singleItem : true,
	slideSpeed : 1000,
	navigation: false,
	pagination:false,
	afterAction : syncPosition,
	responsiveRefreshRate : 200,
  });

  sync2.owlCarousel({
	items : 4,
	itemsDesktop      : [1199,4],
	itemsDesktopSmall     : [979,4],
	itemsTablet       : [768,4],
	itemsMobile       : [479,2],
	pagination:false,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	}
  });

  function syncPosition(el){
	var current = this.currentItem;
	$("#sync2")
	  .find(".owl-item")
	  .removeClass("synced")
	  .eq(current)
	  .addClass("synced")
	if($("#sync2").data("owlCarousel") !== undefined){
	  center(current)
	}
  }

  $("#sync2").on("click", ".owl-item", function(e){
	e.preventDefault();
	var number = $(this).data("owlItem");
	sync1.trigger("owl.goTo",number);
  });

  function center(number){
	var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
	var num = number;
	var found = false;
	for(var i in sync2visible){
	  if(num === sync2visible[i]){
		var found = true;
	  }
	}

	if(found===false){
	  if(num>sync2visible[sync2visible.length-1]){
		sync2.trigger("owl.goTo", num - sync2visible.length+2)
	  }else{
		if(num - 1 === -1){
		  num = 0;
		}
		sync2.trigger("owl.goTo", num);
	  }
	} else if(num === sync2visible[sync2visible.length-1]){
	  sync2.trigger("owl.goTo", sync2visible[1])
	} else if(num === sync2visible[0]){
	  sync2.trigger("owl.goTo", num-1)
	}

  }

    // plus and minus input
	$('.qty_input').prop('disabled', true);
		$(document).on('click','.plus-btn',function(e){
			e.preventDefault();
			var qty_input = $(this).parents('div.input-group').find('.qty_input').val();
			$(this).parents('div.input-group').find('.qty_input').val(parseInt(qty_input) + 1 );
			if($(this).hasClass('plus-btn-sidebar')){
				$(this).parents('.input-group').find('.qty_input_update').trigger('change');
			}
		});
		$(document).on('click','.minus-btn',function(e){
				e.preventDefault();
				var qty_input = $(this).parents('div.input-group').find('.qty_input').val();
				$(this).parents('div.input-group').find('.qty_input').val(parseInt(qty_input) - 1 );
				if ($(this).parents('div.input-group').find('.qty_input').val() == 0) {
					$(this).parents('div.input-group').find('.qty_input').val(1);
				}
				if($(this).hasClass('minus-btn-sidebar')){
					$(this).parents('.input-group').find('.qty_input_update').trigger('change');
				}
		});


	$('li.nav-item.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});

});



// Slide Cart
jQuery(document).ready(function($){
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var $L = 1200,
		$menu_navigation = $('#main-nav'),
		$cart_trigger = $('#cd-cart-trigger'),
		$hamburger_icon = $('#cd-hamburger-menu'),
		$lateral_cart = $('#cd-cart'),
		$shadow_layer = $('#cd-shadow-layer');

	//open lateral menu on mobile
	$hamburger_icon.on('click', function(event){
		event.preventDefault();
		//close cart panel (if it's open)
		$lateral_cart.removeClass('speed-in');
		toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
	});

	//open cart
	$cart_trigger.on('click', function(event){
		event.preventDefault();
		//close lateral menu (if it's open)
		$menu_navigation.removeClass('speed-in');
		toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
	});

	//close lateral cart or lateral menu
	$shadow_layer.on('click', function(){
		$shadow_layer.removeClass('is-visible');
		// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		if( $lateral_cart.hasClass('speed-in') ) {
			$lateral_cart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
			$menu_navigation.removeClass('speed-in');
		} else {
			$menu_navigation.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
			$lateral_cart.removeClass('speed-in');
		}
	});

	//move #main-navigation inside header on laptop
	//insert #main-navigation after header on mobile
	move_navigation( $menu_navigation, $L);
	$(window).on('resize', function(){
		move_navigation( $menu_navigation, $L);

		if( $(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
			$menu_navigation.removeClass('speed-in');
			$shadow_layer.removeClass('is-visible');
			$('body').removeClass('overflow-hidden');
		}

	});
});

function toggle_panel_visibility ($lateral_panel, $background_layer, $body) {
	if( $lateral_panel.hasClass('speed-in') ) {
		// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		$lateral_panel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$body.removeClass('overflow-hidden');
		});
		$background_layer.removeClass('is-visible');

	} else {
		$lateral_panel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$body.addClass('overflow-hidden');
		});
		$background_layer.addClass('is-visible');
	}
}

function move_navigation( $navigation, $MQ) {
	if ( $(window).width() >= $MQ ) {
		$navigation.detach();
		$navigation.appendTo('header');
	} else {
		$navigation.detach();
		$navigation.insertAfter('header');
	}
}

// Search
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}

$(document).on("click","#openSearch",function(e){
	e.preventDefault();
	openSearch();
});
/*
$(document).on("click",".add_to_cart",function(e){
	e.preventDefault();
	var id = $(this).data('id');

});
*/
function add_to_cart(id,qty,addons=""){
	var csrftoken = $('meta[name=csrf-token]').attr("content");
	$.ajax({
		url: base_url+'/add_to_cart',
		type: "post",
		data: {id:id,qty:qty,addons:addons,_token:csrftoken},
		success: function(result){
			load_cart_sidebar();
			$.notify("Item is added to cart!",{globalPosition:'top right','className':'success'});

		}
	});
}

function update_cart_item(id,qty){
	var csrftoken = $('meta[name=csrf-token]').attr("content");
	$.ajax({
		url: base_url+'/update_cart_item',
		type: "post",
		data: {id:id,qty:qty,_token:csrftoken},
		success: function(result){
			load_cart_sidebar();
			//$.notify("Item is added to cart!",{globalPosition:'top right','className':'success'});
		}
	});
}

$(document).on("change",".qty_input_update",function(e){
		//e.preventDefault();
		var id = $(this).data('id');
		var qty = $(this).val();
		update_cart_item(id,qty);
});
/*
$(document).on("click",".minus-btn-sidebar,.plus-btn-sidebar",function(){
		$(this).parents('.input-group').find('.qty_input_update').trigger('change');
		//var id = $(this).parents('.input-group').find('.qty_input_update').data('id');
		//var qty = $(this).parents('.input-group').find('.qty_input_update').val();
		//update_cart_item(id,qty);
});
*/
$(document).on("click",".add_to_wishlist",function(e){
	e.preventDefault();
	var id = $(this).data('id');
	var csrftoken = $('meta[name=csrf-token]').attr("content");
	var link = $(this);
	$.ajax({
		url: base_url+'/add_to_wishlist',
		type: "post",
		data: {id:id,_token:csrftoken},
		success: function(result){
			if(result == 'ok'){
				$.notify("Item is added to wishlist!",{globalPosition:'top right','className':'success'});
				link.addClass('wishlisted');
				link.parents('li').tooltipster('content', 'Remove from Wishlist');
			}else if(result == 'nok'){
				$.notify("Item is removed from wishlist!",{globalPosition:'top right','className':'error'});
				link.removeClass('wishlisted');
				link.parents('li').tooltipster('content', 'Add to Wishlist');
				link.parents('div.wishlisted_product').remove();
			}


		}
	});
});

$(document).on("click",".add_to_wishlist_logout",function(e){
	e.preventDefault();
	//$.notify("Please login to add this item to wishlist",{globalPosition:'top right','className':'error'});
	swal({
		title: "",
		text: "Please login to add this item to wishlist",
		type: "error",
		closeOnConfirm: true
	});
});

$(document).on("click",".cd-item-remove",function(e){
	e.preventDefault();
	var id = $(this).data('id');
	if(id){
		remove_item_from_cart(id);
	}
});

$(document).on("click",".cart-item-remove",function(e){
	e.preventDefault();
	var id = $(this).data('id');
	if(id){
		remove_item_from_cart(id);
		location.reload();
	}
});

function remove_item_from_cart(id){
	var csrftoken = $('meta[name=csrf-token]').attr("content");
	$.ajax({
		url: base_url+'/remove_item_from_cart',
		type: "post",
		data: {id:id,_token:csrftoken},
		success: function(result){
			$.notify("Item is removed from cart!",{globalPosition:'top right','className':'error'});
			load_cart_sidebar();
		}
	});
}

function load_cart_sidebar(){
	$.ajax({
		url: base_url+'/load_cart_sideBar',
		type: "get",
		data: {},
		success: function(result){
			$("#cd-cart").html(result);
		}
	});
}

load_cart_sidebar();

$.notify.addStyle("bootstrap", {
	html: "<div>\n<span data-notify-text></span>\n</div>",
	classes: {
		base: {
			"font-weight": "bold",
			"padding": "8px 15px 8px 14px",
			"text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
			"background-color": "#e7cfc7",
			"border": "1px solid #d0b2a8",
			"border-radius": "4px",
			"white-space": "nowrap",
			"padding-left": "25px",
			"background-repeat": "no-repeat",
			"background-position": "3px 7px"
		},
		error: {
			"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)"
		},
		success: {
			"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"
		},
		info: {
			"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"
		},
		warn: {
			"background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)"
		}
	}
});
