// Begin Custom

$(function () {
    
    var listMotherDom = $('#panel_list_mother');
    var createMotherDom = $('#panel_create_mother');
    var createNewMotherCB = $('#ps_customerbundle_patient_create_new_mother_cb');
    
    var listFatherDom = $('#panel_list_father');
    var createFatherDom = $('#panel_create_father');
    var createNewFatherCB = $('#ps_customerbundle_patient_create_new_father_cb');
    
    var activeTimer = 2000;
    var delayTimer = 1000;
    
    selectExistingMotherForm();
    selectExistingFatherForm();
    
    createNewMotherCB.click(function() {        
        if(createNewMotherCB.prop('checked') ) {
            createNewMotherForm();
        } else {
            selectExistingMotherForm();
        }

    });
    
    createNewFatherCB.click(function() {        
        if(createNewFatherCB.prop('checked') ) {
            createNewFatherForm();
        } else {
            selectExistingFatherForm();
        }

    });
    
    function selectExistingMotherForm() {    
        createMotherDom.hide(activeTimer);
        listMotherDom.delay(delayTimer).show(activeTimer);
    }
    
    function createNewMotherForm(){
        listMotherDom.hide(activeTimer);
        createMotherDom.delay(delayTimer).show(activeTimer);
    }
    
    function selectExistingFatherForm() {    
        createFatherDom.hide(activeTimer);
        listFatherDom.delay(delayTimer).show(activeTimer);
    }
    
    function createNewFatherForm(){
        listFatherDom.hide(activeTimer);
        createFatherDom.delay(delayTimer).show(activeTimer);
    }

    
});

// End Custom

