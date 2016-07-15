//--------------------------------------------------------------------------------------------------
// Validators Slick
//--------------------------------------------------------------------------------------------------

/**
 * Méthode permettant de vérifier la saisi d'un champ obligatoire
 *
 * @param value
 * @returns {*}
 */
function requiredFieldValidator(value) {
    if (value == null || value == undefined || !value.length) {
        return {valid: false, msg: "Ce champ est obligatoire."};
    } else {
        return {valid: true, msg: null};
    }
}

/**
 * Méthode permettant de valider le format itm8
 *
 * @param value
 * @returns {*}
 */
function itm8FieldValidator(value) {
    if ( value != null && value != undefined) {

        if(value.length != 8){
            return {valid: false, msg: "La taille de l'ITM8 doit être de 8 chiffres."};
        }

        if (isNaN(value)) {
            return {valid: false, msg: "L'ITM8 doit être un entier."};
        }
    }

    return {valid: true, msg: null};
}

/**
 * Méthode permettant de valider le format cnuf
 *
 * @param value
 * @returns {*}
 */
function cnufFieldValidator(value) {
    if ( value != null && value != undefined) {

        if(value.length != 5){
            return {valid: false, msg: "La taille du CNUF doit être de 5 chiffres."};
        }

        if (isNaN(value)) {
            return {valid: false, msg: "Le CNUF doit être un entier."};
        }
    }

    return {valid: true, msg: null};
}

/**
 * Méthode permettant de valider le format de ean13
 *
 * @param value
 * @returns {*}
 */
function ean13FieldValidator(value) {
    if ( value != null && value != undefined) {

        if(value.length != 13){
            return {valid: false, msg: "La taille du CNUF doit être de 13 chiffres."};
        }

        if (isNaN(value)) {
            return {valid: false, msg: "L'EAN13 doit être un entier."};
        }

    }

    return {valid: true, msg: null};
}

/**
 * Méthode permettant de s'assurer que le numéro de la semaine est un entier
 *
 * @param value
 * @returns {*}
 */
function weekPacFieldValidator(value) {
    if ( value != null && value != undefined) {
        if (isNaN(value)) {
            return {valid: false, msg: "Le numero de la semaine doit être un entier."};
        }
    }

    return {valid: true, msg: null};
}
/**
 * Vérifie qu'un champs date soit renseigné et que la date est valide
 *
 * @param value
 * @returns {*}
 */
function requiredDateFieldValidator(value) {
    if (value == null || value == undefined || !value.length) {
        return {valid: false, msg: "Ce champ est obligatoire."};
    } else {
        //todo check format a faire

        return {valid: true, msg: null};
    }
}


/**
 * Méthode permettant de valider le format de saisie des semaines de plannification
 *
 * @param value
 * @returns {*}
 */
function weekPlanningValidator(value)
{
    var weeks = value.split(',');
    for (var i=0; i< weeks.length; i++) {
        if (weeks[i] == '' || isNaN(weeks[i])) {
            return {valid: false, msg: "Le format des semaines n'est pas correcte."};
        }
    }

    return {valid: true, msg: null};
}


/**
 * Méthode permettant de vérifier le format du commentaire qualité
 *
 * @param value
 * @returns {*}
 */
function quantityCommentFieldValidator(value)
{
    var pattern = /^(([B|C|D]|CT){1}[0-9]+(\+T)?_)*(([B|C|D]|CT){1}[0-9]+(\+T)?){1}$/i;

    if (value != null && value != undefined && value.length > 0) {
        if (!pattern.test(value)) {
            return {valid: false, msg: "Le format du commentaire qualité est incorrect"};
        }
    }

    return {valid: true, msg: null};
}


/**
 * Vérification d'une date au format fr obligatoire
 *
 * @param value
 * @returns {*}
 */
function dateFieldValidator(value)
{
    // Regular expression used to check if date is in correct format
    var pattern = /^(([1-9]){1}|([0-2][1-9]){1}|10|30|31){1}\/((0[1-9]){1}|([1-9]){1}|10|11|12){1}\/([0-9]){4}/i;

    if (pattern.test(value))
    {
        var date_array = value.split('/');
        var day = date_array[0];

        // Attention! Javascript consider months in the range 0 - 11
        var month = date_array[1] - 1;
        var year = date_array[2];

        // This instruction will create a date object
        source_date = new Date(year,month,day);

        if(year != source_date.getFullYear())
        {
            return {valid: false, msg: "La date est invalide"};
        }

        if(month != source_date.getMonth())
        {
            return {valid: false, msg: "La date est invalide"};
        }

        if(day != source_date.getDate())
        {
            return {valid: false, msg: "La date est invalide"};
        }
    }
    else
    {
        return {valid: false, msg: "Le format de la date est incorrect (JJ/MM/AAAA)"};
    }

    return {valid: true, msg: null};
}