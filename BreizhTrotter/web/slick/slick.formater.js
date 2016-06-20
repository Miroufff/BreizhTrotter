//--------------------------------------------------------------------------------------------------
// Formater Slick
//--------------------------------------------------------------------------------------------------

function connectedFormatter(row, cell, value, columnDef, dataContext) {
    if (value == '1') {
        value = '<span class="sprite planning active"></span>';
    } else {
        value = '<span class="sprite planning abandoned"></span>';
    }

    return value;
}

function priceFormatter(row, cell, value, columnDef, dataContext) {

    if (value == '') {
        value = '';
    } else {
        value = formatNumber(value, 2, ' ') + " €";
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function checkmarkFormatter(row, cell, value, columnDef, dataContext) {

    if (value == '') {
        value = '';
    } else {
        value = '<span class="sprite planning ok" style="margin-left : 25px;"></span>';
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function targetFormatter(row, cell, value, columnDef, dataContext) {

    if (value == '' || value == 'non') {
        value = '';
    } else {
        value = '<span class="icon-ok-circle" cible  ></span>';
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function enabledUserFormatter(row, cell, value, columnDef, dataContext) {

    if (value == '' || value == 'false') {
        value = '';
    } else {
        value = '<span class="icon-ok-circle"></span>';
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function checkFormatter(row, cell, value, columnDef, dataContext) {

    if (value == '') {
        value = '';
    } else {
        value = '<span class="icon-ok-circle"></span>';
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function periodFormatter(row, cell, value, columnDef, dataContext) {

    if (value == '') {
        value = '';
    } else {
        value = '<span class="sprite planning ' + value  + '"></span>';
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function dateFormatter(row, cell, value, columnDef, dataContext) {
    if (value == '') {
        return '';
    } else {
        var splitedDate = value.split('-');

        return  splitedDate[2] + '/' + splitedDate[1] + '/' + splitedDate[0];
    }
}

/**
 * Méthode permettant de formater un float en pourcentage avec 2 chiffres après la virgule (ex: 4.52 %)
 *
 * @param row
 * @param cell
 * @param value
 * @param columnDef
 * @param dataContext
 * @returns {*}
 */
function percentFormatter(row, cell, value, columnDef, dataContext) {

    if (value === '') {
        value = '';
    } else {
        value = formatNumber(value, 2, ' ') + " %";
    }

    return defaultFormatter(row, cell, value, columnDef, dataContext);
}

function defaultFormatter(row, cell, value, columnDef, dataContext) {
    if (dataContext.er != null &&  dataContext['er'][columnDef.id]) {
        return '<div class="slick-cell-error" style="width:100%; min-height:20px" title="' + dataContext['er'][columnDef.id] + '">' + value + '</div>';
    } else {
        //pour indiquer les différences
        if (dataContext.diff != null &&  dataContext['diff'][columnDef.id]) {
            return '<div class="slick-cell-diff" style="width:100%; min-height:20px;" title="' + dataContext['diff'][columnDef.id] + '">' + value + '</div>';
        }
    }

    return value;
}

/**
 * Lien permettant de téléchager un fichier en cliquand sur une icone pdf si le fichier existe.
 * Si le fichier n'existe pas l'icone est mise en grisée.
 *
 * @param value
 * @param url
 * @returns {string}
 */
function linkDownloadFormatter(value, url) {
    if (value == '') {
        return '';
    } else if (value == '-1') {
        return '<span class="sprite icone gray-pdf"></span>';
    } else {
        return '<a target="_new" href="' + url + '"><span class="sprite icone pdf"></span></a>';
    }
}

/**
 * formate un chiffre avec 'decimal' chiffres après la virgule et un separateur
 *
 * @param valeur
 * @param decimal
 * @param separateur
 * @returns {string}
 */
function formatNumber(valeur,decimal,separateur)
{
    var deci=Math.round( Math.pow(10,decimal)*(Math.abs(valeur)-Math.floor(Math.abs(valeur)))) ;
    var val=Math.floor(Math.abs(valeur));
    if ((decimal==0)||(deci==Math.pow(10,decimal))) {val=Math.floor(Math.abs(valeur)); deci=0;}
    var val_format=val+"";
    var nb=val_format.length;
    for (var i=1;i<4;i++) {
        if (val>=Math.pow(10,(3*i))) {
            val_format=val_format.substring(0,nb-(3*i))+separateur+val_format.substring(nb-(3*i));
        }
    }
    if (decimal>0) {
        var decim="";
        for (var j=0;j<(decimal-deci.toString().length);j++) {decim+="0";}
        deci=decim+deci.toString();
        val_format=val_format+"."+deci;
    }
    if (parseFloat(valeur)<0) {val_format="-"+val_format;}
    return val_format;
}
