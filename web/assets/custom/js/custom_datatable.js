// begin DataTable for listPatients
$(document).ready(function() {
    
    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
            },
            "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            }
            }
    } );
    
    
    
    
    currentLocaleFull = navigator.languages[0];
    currentLocale = "fr";
    if ( currentLocaleFull.indexOf("en") !== -1) {
        currentLocale = "en";
    }
    full_url = '/'+currentLocale + '/datatable_lang' ;
   
   /*
    var defaultNotVisibleColumns, defaultNotVisibleColumnsObject;
    defaultNotVisibleColumns= [];
    defaultNotVisibleColumnsObject = $('#listPatients thead .defaultNotVisColList')
    $( defaultNotVisibleColumnsObject ).each(function( index ) {
        defaultNotVisibleColumns.push(this.cellIndex);
    });
    
    
    var defaultVisibleColumns, defaultVisibleColumnsObject;
    defaultVisibleColumns= [];
    defaultVisibleColumnsObject = $('#listPatients thead .defaultVisColList')
    $( defaultVisibleColumnsObject ).each(function( index ) {
        defaultVisibleColumns.push(this.cellIndex);
    });
    */
   
    var fixedColLeft = $( 'thead .viewIcon, thead .editIcon, thead .deleteIcon, thead .IDPatient, thead .consultationIcon').length;
        
    tablePatient = $('#listPatients').DataTable({
           /* language: {
                'url': full_url
            },*/
            order: [[ 0, "asc" ]],
            colReorder: {
                fixedColumnsLeft: fixedColLeft
            },
            columnDefs: [
                { "visible": false, "targets": 'defaultNotVisColList'},
                { "orderable": false, "targets": 'icon' }
            ],
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                    columns: ':not(thead .viewIcon, thead .editIcon, thead .deleteIcon, thead .IDPatient, thead .consultationIcon)',
                    text : 'Sélection Col.'
                },
                {
                    text: 'Conf. par défaut',
                    action: function ( e, dt, node, config ) {                   
                        tablePatient.state.clear();
                        window.location.reload();
                    }
                },
                {
                    extend: 'columnVisibility',
                    text: 'Toutes les col.',
                    visibility: true
                },
                {
                    extend: 'colvisGroup',
                    text: 'Col. par défaut',
                    show: '.defaultVisColList',
                    hide: '.defaultNotVisColList'
                    
                }
            ],
            fixedHeader: {
                header: true,
                footer: true
            }
        });

} );

// End DataTable for list patients



// begin DataTable for list parent
$(document).ready(function() {
    currentLocaleFull = navigator.languages[0];
    currentLocale = "fr";
    if ( currentLocaleFull.indexOf("en") !== -1) {
        currentLocale = "en";
    }
    full_url = '/'+currentLocale + '/datatable_lang' ;    
    
    $('.list_objects').DataTable({
           /* language: {
                'url': full_url
            },*/
            order: [[ 0, "asc" ]],
            "columnDefs": [
                { "visible": false, "targets": 'defaultNotVisColList'},
                { "orderDataType": "dom-checkbox", "targets": 'radioColumn' }
            ],
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column',
                    columns: ':not(thead .radioColumn)',
                    text : 'Sélection Col.',
                },
                {
                    extend: 'columnVisibility',
                    text: 'Toutes les col.',
                    visibility: true
                },
                {
                    extend: 'colvisGroup',
                    text: 'Col. par défaut',
                    show: '.defaultVisColList',
                    hide: '.defaultNotVisColList'
                }
            ]
        });

} );

// End DataTable for list parent



// begin DataTable for listConsultations
$(document).ready(function() {
    currentLocaleFull = navigator.languages[0];
    currentLocale = "fr";
    if ( currentLocaleFull.indexOf("en") !== -1) {
        currentLocale = "en";
    }
    full_url = '/'+currentLocale + '/datatable_lang' ;
        
    tableConsultation = $('#listConsultations').DataTable({
           /* language: {
                'url': full_url
            },*/
            order: [[ 0, "asc" ]],
            colReorder: {
                fixedColumnsLeft: 3
            },
            "columnDefs": [
                { "visible": false, "targets": 'defaultNotVisColList'},
                { "orderable": false, "targets": 'icon' }
            ],
            dom: 'lBfrtip',
            stateSave: true,
            stateDuration: 0,
            buttons: [
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                    columns: ':not(thead .viewIcon, thead .deleteIcon, thead .IDConsultation)',
                    text : 'Sélection Col.'
                },
                {
                    text: 'Conf. par défaut',
                    action: function ( e, dt, node, config ) {                   
                        tableConsultation.state.clear();
                        window.location.reload();
                    }
                },
                {
                    extend: 'columnVisibility',
                    text: 'Toutes les col.',
                    visibility: true
                },
                {
                    extend: 'colvisGroup',
                    text: 'Col. par défaut',
                    show: '.defaultVisColList',
                    hide: '.defaultNotVisColList'
                    
                }
            ],
            fixedHeader: {
                header: true,
                footer: true
            }
        });

} );

// End DataTable for listConsultations
