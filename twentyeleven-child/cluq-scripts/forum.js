 $jQ(window).load(function() {
  prepareList();
});

function prepareList() {
   $jQ ('#expList').find('li:has(ul)')
  .click(function(event) {
    if (this == event.target) {
       $jQ (this).toggleClass('expanded');
      $jQ (this).children('ol').toggle('medium');
    }
    return false;
  })
  .addClass('collapsed')
  .children('ol').hide();

  //Create the button funtionality
   $jQ ('#expandList')
  .unbind('click')
  .click(function() {
    $jQ ('.collapsed').addClass('expanded');
    $jQ ('.collapsed').children().show('medium');
  })
   $jQ('#collapseList')
  .unbind('click')
  .click(function() {
    $('.collapsed').removeClass('expanded');
    $('.collapsed').children().hide('medium');
  });
};