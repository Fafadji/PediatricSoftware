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

