// begin DataTable
$(document).ready(function() {
    currentLocaleFull = navigator.languages[0];
    currentLocale = "fr";
    if ( currentLocaleFull.indexOf("en") !== -1) {
        currentLocale = "en";
    }
    full_url = '/'+currentLocale + '/datatable_lang' ;

    /*
    // Setup - add a text input to each footer cell
    $('#listPatients tfoot th').each( function () {
        var title = $(this).text();
        if(title) {
            $(this).html( '<input type="text" placeholder="Recherche '+title+'" />' );
        }
    } );
    */
    
    
    table = $('#listPatients').DataTable({
            language: {
                'url': full_url
            },
            order: [[ 0, "asc" ]],
            columnDefs: [ { "orderable": false, "targets": [1, 2, 3] } ],
            colReorder: {
                fixedColumnsLeft: 4
            },
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    columns: ':not(thead .viewIcon, thead .editIcon, thead .deleteIcon, thead .IDPatient)',
                    text : 'colonnes'
                },
                {
                    text: 'configuration par défaut',
                    action: function ( e, dt, node, config ) {                   
                        table.state.clear();
                        window.location.reload();
                    }
                }
            ],
            fixedHeader: {
                header: true,
                footer: true
            }
        });
        
    /*    
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } ); */
} );

// End DataTable

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

