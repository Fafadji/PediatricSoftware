 $(function () {
    
    jQuery.validator.addMethod(
        "dateFR",
        function(value, element) {
            var check = false;
            var re = /^\d{2}\/\d{2}\/\d{4}$/;
            if( re.test(value)){
                var adata = value.split('/');
                var dd = parseInt(adata[0],10);
                var mm = parseInt(adata[1],10);
                var yyyy = parseInt(adata[2],10);
                var xdata = new Date(yyyy,mm-1,dd);
                if ( ( xdata.getFullYear() == yyyy ) && ( xdata.getMonth () == mm - 1 ) && ( xdata.getDate() == dd ) )
                    check = true;
                else
                    check = false;
            } else {
                check = false;
            }
            return this.optional(element) || check;
        },
        "Entrer une date valide et au format dd/mm/yyyy"
    );
    
    jQuery.validator.addMethod(
        "phoneSN",
        function(value, element) {
            var check = false;
            var re = /^(33|77|76) \d{3} \d{2} \d{2}$/;
            if( re.test(value)){
                check = true;
            }
            return this.optional(element) || check;
        },
        "Entrer un numéro au format 33|77|76 xxx xx xx"
    );
    
    var sex_patient = $('input[name*=sex]:checked').val();
    var codeSiblingsRegex = /^\dR\d(M|F)\d$/;
    var codeSiblingsErrorMsg = "Entrer un code au format xRxMx ou bien xRxFx où x est un chiffre";
    
    $('input[name*=sex]').change(function() {
        sex_patient = $('input[name*=sex]:checked').val();
        if(sex_patient == "male") {
            codeSiblingsRegex = /^\dR\dM\d$/;
            codeSiblingsErrorMsg = "Entrer un code au format xRxMx où x est un chiffre";
        } else if (sex_patient == "female") {
            codeSiblingsRegex = /^\dR\dF\d$/;
            codeSiblingsErrorMsg = "Entrer un code au format xRxFx où x est un chiffre";
        }
        $('.patientCodeSiblings').validate();
        $('.patientCodeSiblings').valid();
        
    });
    
    
    jQuery.validator.addMethod(
        "patientCodeSiblings",
        function(value, element) {
            var check = false;
            if( codeSiblingsRegex.test(value)){
                check = true;
            }
            return this.optional(element) || check;
        },
       function() {
            return codeSiblingsErrorMsg;
        }
    );
 });