// Begin Wizard
// http://bootsnipp.com/snippets/featured/form-wizard-and-validation

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        
        //added to check validation
        var activeTab =  $(this).closest(".tab-pane"),
            curInputs = activeTab.find("input[type='text'],input[type='url'],input[type='radio']"),
            isValid = true;
            
        for(var i=0; i<curInputs.length; i++){
            $(curInputs[i]).validate();
            if (!$(curInputs[i]).valid()){
                isValid = false;
            }
        }
        
        
        if (isValid) {
            // original
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
        }

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

// End Wizard