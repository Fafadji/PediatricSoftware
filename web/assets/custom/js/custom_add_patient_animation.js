// Begin Custom

$(function () {

    var activeTimer = 2000;
    var delayTimer = 1000;

    $('#panel_create_mother label').first().append('<span class="appended"> * </span>');
    $('#panel_create_father label').first().append('<span class="appended"> * </span>');

    addParentAnimation(
            '#panel_list_mother',
            '#panel_create_mother',
            '#ps_customerbundle_patient_mother_action_selector'
            );

    addParentAnimation(
            '#panel_list_father',
            '#panel_create_father',
            '#ps_customerbundle_patient_father_action_selector'
            );

    function addParentAnimation(listSel, createSel, createCbSel)
    {
        var listParentDom = $(listSel);
        var createParentDom = $(createSel);
        var parentActionDom = $(createCbSel);
        var createParentNameInputDom = $(createSel + " input").first();

        showCorrectForm();
        parentActionDom.change(showCorrectForm);

        function showCorrectForm() {
            if (parentActionDom.val() == 'none') {
                hideAll();
            } else if (parentActionDom.val() == 'select')
                selectExistingParentForm();
            else {
                createNewParentForm();
            }
        }

        function selectExistingParentForm() {
            createParentDom.slideUp(activeTimer);
            listParentDom.delay(delayTimer).slideDown(activeTimer);
            createParentNameInputDom.removeAttr("required");
        }

        function createNewParentForm() {
            listParentDom.slideUp(activeTimer);
            createParentDom.delay(delayTimer).slideDown(activeTimer);
            createParentNameInputDom.attr("required", "required");
        }

        function hideAll() {
            listParentDom.slideUp(activeTimer);
            createParentDom.slideUp(activeTimer);
            createParentNameInputDom.removeAttr("required");
        }

    }

});

// End Custom

