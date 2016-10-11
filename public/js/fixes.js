$('a.vote').hover(function () {
  $(this).css("color", 'red');
  console.log("test");
})
$('a.vote').on('mouseover',  function() {
    $(this).css("color", 'red');
});
