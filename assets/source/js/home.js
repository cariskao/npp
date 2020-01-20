$(function () {
   $('.carousel').carousel({
      interval: 2000, // false
      pause: "hover", // false
   });
});

$(".carousel-indicators li:first").addClass("active");
$(".carousel-inner div:first").addClass("active");