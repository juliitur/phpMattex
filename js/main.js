/**
 * Main js file for MATTEX INTERNATIONAL
 * https://daneden.github.io/animate.css/ -> Website to look for animations
 */

// Javascript for search function in admin_panel:
// function showSuggestion(str){
//   if(str.length == 0){
//     document.getElementById('users').innerHTML = "";
//   }else{
//     // AJAX Request
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function(){
//       if(this.readyState == 4 && this.status == 200){
//         // Ready for output.
//         document.getElementById('users').innerHTML = this.responseText;
//       }
//     }
//     xmlhttp.open("GET", "admin_panel.php?searchName=" + str, true);
//     xmlhttp.send();

//     document.getElementById('userSearch').focus();
//   }
// }


// Wait for the web page to be ready
function tksubscribing() {
  alert("Thank you for Subscribing!");
}

// Wait for the web page to be ready
function tkcontact() {
  alert("Thank you for Contacting Us!");
}

// Wait for the web page to be ready
function placeorder() {
  alert("Your order was successfully placed!");
}

// Wait for the web page to be ready
// SHIFT F5!!!!!!!!!!!!!!!!!
$(document).ready(function() {

    $("#image").change(function (){
      var fileName = $('#image').val();
      $('#path').html(fileName);
      $('#hpath').val(fileName);
    });



      /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    $('#rating').val(onStar);
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });

  function responseMessage(msg) {
    $('.success-box').fadeIn(200);  
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
  }

  

    //Popovers:
    //Select the tags with a toggle value of popover. 
    $('[data-toggle="popover"]').popover({
        html: true,
        container: 'body',
        placement: function(){return $(window).width()>768 ? "left":"auto";},
        trigger: 'hover',
        //Then add their img value to the html tag.
        content: function(){
          return '<img class="img-fluid" src="' + $(this).data('img') + '"/>';
      }
    });

    //Animations, inspired by: https://codepen.io/benoitboucart/full/yJoqz
    $(function() {
        var $window = $(window),
          win_height_padded = $window.height() * 1.1,
          isTouch = Modernizr.touch;
      
        if (isTouch) {
          $(".revealOnScroll").addClass("animated");        //Check if the user is using a touch screen.
        }
      
        $window.on("scroll", revealOnScroll);               //Create event listener for the scroll event

        //revealOnScroll checks if the item we are animating has entered in the screen.
        function revealOnScroll() {
          var scrolled = $window.scrollTop(),
            win_height_padded = $window.height() * 1.1;
      
          // Show the animations
          $(".revealOnScroll:not(.animated)").each(function() {
            var $this = $(this),
              offsetTop = $this.offset().top;
      
            if (scrolled + win_height_padded > offsetTop) {
              if ($this.data("timeout")) {
                window.setTimeout(function() {
                  $this.addClass("animated " + $this.data("animation"));
                }, parseInt($this.data("timeout"), 10));
              } else {
                $this.addClass("animated " + $this.data("animation"));
              }
            }
          });
          // Hide the animations
          $(".revealOnScroll.animated").each(function(index) {
            var $this = $(this),
              offsetTop = $this.offset().top;
            if (scrolled + win_height_padded < offsetTop) {
              $(this).removeClass("animated " + $this.data("animation"));
            }
          });
        }
      
        revealOnScroll();
      });

    // Video Play
    $(function () {
      // Auto play modal video
      $(".video").click(function () {
        var theModal = $(this).data("target"),
          videoSRC = $(this).attr("data-video"),
          videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
        $(theModal + ' iframe').attr('src', videoSRCauto);
        $(theModal + ' button.close').click(function () {
          $(theModal + ' iframe').attr('src', videoSRC);
        });
      });
    });

    //Configure Slider
    $('.carousel').carousel({
      interval:5000,
      pouse: 'hover'
    });

    // Testimonials
    $('.slider').slick({
      infinite: true,
      slideToShow: 1,
      slideToScroll: 1
    });

    // get full year for footer
    $('#year').text(new Date().getFullYear());

    // Send info to modal:
    $(".editUser").click(function(){
      var user = $(this).attr("id");
      var email = $(this).attr("email");

      $.ajax({
        url:"admin_panel.php",
        method:"POST",
        data:
        {
          'user':user,
          'Email':email,
        },

        success:function(data){
          console.log(data);
          $('#user').val(user);
          $('#email').val(email);
          $('#addUserModal').modal('show');
        },
        error: function(html, err){
          console.log(err);
        }
      });
    });

    // Focus on password field on load.
    $('#addUserModal').on('shown.bs.modal', function(){
      $('#password').focus();
    })
});


