/*
 * All the plugins init are in this file
 *
 */

$(document).ready(function() {
  
  // activate carousels
  $('#iphone-carousel').carousel();
  $('#galaxy-carousel').carousel();
  
  // ajax contact form
  $('.contact-form').submit(function(){
    $.post('contact-form.php', $(this).serialize(), function(data){
      $('.contact-form').html(data);
      $('.contact-form input, .contact-form textarea').val('');
    });				
    return false;
  });

  // ajax subscription
  $('.subsc-form').submit(function(){
    $.post('subscription.php', $(this).serialize(), function(data){
    
      $('.subsc-form > *').fadeIn();
      $('.subsc-form').html(data);
      $('.subsc-form input').val('');
    });				
    return false;
  });

});