jQuery('.careersBtn').click(function(){
    jQuery(this).find('i.fa-chevron-down').toggleClass('active')
   jQuery(this).next().slideToggle();
})