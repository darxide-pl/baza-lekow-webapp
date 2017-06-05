$(document).ready(function() {
    /*--------------------------------------
        Header Color
    ---------------------------------------*/
    $('body').on('click', '.hc-trigger', function() {
        $(this).parent().toggleClass('toggled');
    });
    
    $('body').on('click', '.hc-item', function() {
        var v = $(this).data('ma-header-value');

        $('.hc-item').removeClass('selected');
        $(this).addClass('selected');


        $('body').attr('data-ma-header', v);
    });

    /*--------------------------------------
        Animation
     ---------------------------------------*/
    $('body').on('click', '.animation-demo .btn', function(){
        var animation = $(this).text();
        var cardImg = $(this).closest('.card').find('img');
        if (animation === "hinge") {
            animationDuration = 2100;
        }
        else {
            animationDuration = 1200;
        }

        cardImg.removeAttr('class');
        cardImg.addClass('animated '+animation);

        setTimeout(function(){
            cardImg.removeClass(animation);
        }, animationDuration);
    });

    /*--------------------------------------
        Components
     ---------------------------------------*/
    $('body').on('click', '#btn-color-targets > .btn', function(){
        var color = $(this).data('target-color');
        $('#modalColor').attr('data-modal-color', color);
    });
});


const flash = {
    success : function(msg) {
        $.growl({
            message:msg
        },{
            allow_dismiss: true,
            'placement':{
                from:'bottom',
                align:'left'
            }
        })  
    }, 

    error : function(msg) {
        $.growl({
            message:msg
        },{
            type:'danger',
            allow_dismiss: true,
            'placement':{
                from:'bottom',
                align:'left'
            }
        })  
    }, 

    auto : function() {
        $( document ).ajaxComplete(function( event, xhr, settings ) {
            try {
                let response = JSON.parse(xhr.responseText)
                flash.parse(response)
            } catch(Exception) {
                console.log('Cant read input as JOSN')
            }
        })  

        $( document ).ajaxError(function( event, request, settings ) {
            if (request.statusText =='abort') {
                return;
            }           
            flash.error('Server fault')
        })
    }, 

    parse : function(response) {
        if(typeof response.error !== 'undefined') {
            flash.error(response.error)
        }

        if(typeof response.success !== 'undefined') {
            flash.success(response.success)
        }       
    }
}

flash.auto()