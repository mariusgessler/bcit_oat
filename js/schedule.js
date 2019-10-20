let todaysSlide ;
jQuery(document).ready(function($){

    /////////// Getting to todays class on mobile
    let d       = new Date();
    let month   = d.getMonth();
    let day     = d.getDate();
    let year    = d.getFullYear()

    if (day < 10 ){
        day = "0" + day;
    }

    month = month+1
    let todaysDate = "D" + year + "-" + month + "-" + day;   

    

    $("[id='" + todaysDate + "'").css("border","3px solid rgb(255, 166, 0)");
        let todaysSlide = $(".swiper-slide").find("#"+todaysDate).parent().parent().attr("slide_index");
    mySwiper.slideToLoop(todaysSlide, 900,false);


    /////////// Only show "Go to today"-button when today is on the schedule

    if ($("#" + todaysDate).length <= 0 ){
      $("button").css("display", "none") 
    }

    ////////// Scroll to todays date without weird offset

    document.querySelector(".goto").addEventListener("click",function(e){
    // dynamically determining the height of your navbar
    let navbar = document.querySelector("nav");
    let navbarheight = parseInt(window.getComputedStyle(navbar).height,10);
    // show 5 pixels of previous section just for illustration purposes 
    let scrollHeight = document.querySelector("[id='" + todaysDate + "'").offsetTop - navbarheight - 5;
    window.scroll(0,scrollHeight);
    /*properly updating the window location*/
    // window.location.hash = e.target.hash;
    /* do not execute default action*/
    e.preventDefault();
});

})
