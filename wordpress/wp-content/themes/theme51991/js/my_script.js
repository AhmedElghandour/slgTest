$(document).ready(function(){

	jQuery("ul.list_1 li:nth-child(1)").addClass("item_1");
	jQuery("ul.list_1 li:nth-child(2)").addClass("item_2");
	jQuery("ul.list_1 li:nth-child(3)").addClass("item_3");
	jQuery("ul.list_1 li:nth-child(4)").addClass("item_4");

  jQuery(".title-section ul li:nth-child(3n)").addClass("item_2");
  jQuery(".title-section ul li:nth-child(5n)").addClass("item_3");

  jQuery(".filter-wrapper ul li:nth-child(2n)").addClass("item_2");
  jQuery(".filter-wrapper ul li:nth-child(3n)").addClass("item_3");
  jQuery(".filter-wrapper ul li:nth-child(4n)").addClass("item_4");

});

$(document).ready(function(){
$('.list_1').css('display', 'block');

$(window).resize(
   function(){
    $('.list_1').width($(window).width());
    $('.list_1').css({width: $(window).width(), "margin-left": ($(window).width()/-2)});
   }
  ).trigger('resize');
});

$(document).ready(function(){
$('.box').css('display', 'block');

$(window).resize(
   function(){
    $('.box').width($(window).width());
    $('.box').css({width: $(window).width(), "margin-left": ($(window).width()/-2)});
   }
  ).trigger('resize');
});

$(document).ready(function(){
$('.box_1').css('display', 'block');

$(window).resize(
   function(){
    $('.box_1').width($(window).width());
    $('.box_1').css({width: $(window).width(), "margin-left": ($(window).width()/-2)});
   }
  ).trigger('resize');
});