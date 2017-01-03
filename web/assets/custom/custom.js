// Begin Wizard

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
            errorClass="alert alert-danger",
            isValid = true;

            
        $(".form-group").removeClass(errorClass);
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass(errorClass);
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
// Begin Custom

$(function () {
    selectExistingMotherForm();
    var createNewMotherCB = $('#ps_customerbundle_patient_createNewMotherCB');
    
    createNewMotherCB.click(function() {        
        if(createNewMotherCB.prop('checked') ) {
            createNewMotherForm();
        } else {
            selectExistingMotherForm();
        }

    });
     
    
    function selectExistingMotherForm() {    
        // enable select existing mother
        $('#fieldsetSEM').css('color','#333333').css('background','white');
        $('#fieldsetSEM legend').css('color','#333333');
        $('#fieldsetSEM select').attr('disabled',false);
        
        //disable create new mother form
        $('#fieldsetCNM').css('color','gray').css('background','#DCDCDC');
        $('#fieldsetCNM legend').css('color','gray');
        $('#fieldsetCNM input').prop('readonly',true);
        $('#fieldsetCNM select').attr('disabled',true);
    }
    
    function createNewMotherForm(){
        // disable select existing mother
        $('#fieldsetSEM').css('color','#gray').css('background','#DCDCDC');
        $('#fieldsetSEM legend').css('color','gray');
        $('#fieldsetSEM select').attr('disabled',true);
        
        //enable create new mother form
        $('#fieldsetCNM').css('color','#333333').css('background','white');
        $('#fieldsetCNM legend').css('color','#333333');
        $('#fieldsetCNM input').prop('readonly',false);
        $('#fieldsetCNM select').attr('disabled',false);
    }
    
});

// End Custom