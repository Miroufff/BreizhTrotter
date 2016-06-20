(function ($) {
    $.extend(true, window, {
        "Ext": {
            "Plugins": {
                "HeaderFilter": HeaderFilter
            }
        }
    });

    /*
     Based on SlickGrid Header Menu Plugin (https://github.com/mleibman/SlickGrid/blob/master/plugins/slick.headermenu.js)

     (Can't be used at the same time as the header menu plugin as it implements the dropdown in the same way)


     */

    function HeaderFilter(options) {
        var grid;
        var self = this;
        var handler = new Slick.EventHandler();
        var defaults = {
            buttonImage: "down.png",
            filterImage: "filter.png",
            sortAscImage: "sort-asc.png",
            sortDescImage: "sort-desc.png"
        };
        var $menu;

        function init(g) {
            options = $.extend(true, {}, defaults, options);
            grid = g;
            handler.subscribe(grid.onHeaderCellRendered, handleHeaderCellRendered)
                .subscribe(grid.onBeforeHeaderCellDestroy, handleBeforeHeaderCellDestroy)
                .subscribe(grid.onClick, handleBodyMouseDown)
                .subscribe(grid.onColumnsResized, columnsResized);

            grid.setColumns(grid.getColumns());

            $(document.body).bind("mousedown", handleBodyMouseDown);
        }

        function destroy() {
            handler.unsubscribeAll();
            $(document.body).unbind("mousedown", handleBodyMouseDown);
        }

        function handleBodyMouseDown(e) {
            if ($menu && $menu[0] != e.target && !$.contains($menu[0], e.target)) {
                hideMenu();
            }
        }

        function hideMenu() {
            if ($menu) {
                $menu.remove();
                $menu = null;
            }
        }

        function handleHeaderCellRendered(e, args) {
            var column = args.column;
            if (column.filter) {
                var $el = $("<div></div>")
                    .addClass("slick-header-menubutton")
                    .data("column", column);

                if (options.buttonImage) {
                    $el.css("background-image", "url(" + options.buttonImage + ")");
                }

                $el.bind("click", showFilter).appendTo(args.node);
            }
        }

        function handleBeforeHeaderCellDestroy(e, args) {
            $(args.node)
                .find(".slick-header-menubutton")
                .remove();
        }

        function addMenuItem(menu, columnDef, title, command, image) {
            var $item = $("<div class='slick-header-menuitem'>")
                .data("command", command)
                .data("column", columnDef)
                .bind("click", handleMenuItemClick)
                .appendTo(menu);


            var $icon = $("<div class='slick-header-menuicon'>")
                .appendTo($item);

            if (image) {
                $icon.css("background-image", "url(" + image + ")");
            }

            $("<span>")
                .text(title)
                .appendTo($item);
        }

        function getFilterLabel(filterLabel, columnDef) {
            if (columnDef.filterList) {
                if (columnDef.filterList[filterLabel]) {
                    return columnDef.filterList[filterLabel];
                }
            }

            if (filterLabel == '') {
                return '--vide--';
            }

            return filterLabel;
        }

        function showFilter(e) {
            var $menuButton = $(this);
            var columnDef = $menuButton.data("column");

            columnDef.filterValues = columnDef.filterValues || [];

            // WorkingFilters is a copy of the filters to enable apply/cancel behaviour
            var workingFilters = columnDef.filterValues.slice(0);
            var suggestboxValue =  columnDef.filterSuggestbox || '';

            var filterItems;

            if (workingFilters.length === 0) {
                // Filter based all available values
                filterItems = getFilterValues(grid.getData(), columnDef);
            }
            else {
                // Filter based on current dataView subset
                filterItems = getAllFilterValues(grid.getData().getItems(), columnDef);
            }

            if (!$menu) {
                $menu = $("<div class='slick-header-menu'>").appendTo(document.body);
            }

            $menu.empty();

            addMenuItem($menu, columnDef, 'Tri croissant', 'sort-asc', options.sortAscImage);
            addMenuItem($menu, columnDef, 'Tri décroissant', 'sort-desc', options.sortDescImage);

            var $filter;

            if (columnDef.filter == 'check') {
                var filterOptions = "<label for='"+columnDef.id+"-all'><input id='"+columnDef.id+"-all' type='checkbox' value='-1' />(Tout sélectionner)</label>";

                for (var i = 0; i < filterItems.length; i++) {
                    var filtered = _.contains(workingFilters, filterItems[i]);

                    filterOptions += "<label><input type='checkbox' value='" + i + "'"
                        + (filtered ? " checked='checked'" : "")
                        + "/>" + getFilterLabel(filterItems[i], columnDef) + "</label>";
                }
            } else if(columnDef.filter == 'checkWithInput') {

                var valuesFiltered = getValuesMatchingSuggestbox(filterItems, suggestboxValue);

                var checkedAll = false;
                if (valuesFiltered.length == workingFilters.length){
                    checkedAll = true;
                }

                var filterOptions = "<div class='filter filter-" + columnDef.filter + "'>";

                //Suggestbox contenant le filtre appliquer sur les checkbox
                filterOptions += "<div class='filter-input'><input type='text' value='" + suggestboxValue + "' /></div>";

                //Div contenant l'ensemble des checkbox
                filterOptions += "<div class='filter-check'>";

                //Champs tout sélectionner
                filterOptions += "<label for='"+columnDef.id+"-all'>";
                filterOptions += "<input type='checkbox' id='"+columnDef.id+"-all' value='-1' " + (checkedAll ? " checked='checked'" : "") + " />";
                filterOptions += "(Tout sélectionner)";
                filterOptions += "</label>";

                for (var i = 0; i < filterItems.length; i++) {

                    //Détermine si on a coché cette checkbox dans le passé
                    var checked = _.contains(workingFilters, filterItems[i]);

                    //Permet de savoir quelles sont les valeurs à afficher
                    var filtered = _.contains(valuesFiltered, filterItems[i]);

                    // On affiche que les champs filtrés
                    var showLabel = "";

                    if(!filtered){
                        showLabel = ' style="display: none;" ';
                    }

                    filterOptions += "<label " + showLabel + " for='"+columnDef.id+"-"+i+"'>";
                    filterOptions += "<input type='checkbox' id='"+columnDef.id+"-"+i+"' value='" + i + "'" + (checked ? " checked='checked'" : "") + "/>" ;
                    filterOptions += getFilterLabel(filterItems[i], columnDef);
                    filterOptions += "</label>";
                }

                filterOptions += "</div>";
                filterOptions += "</div>";

                $filter = $menu.append(filterOptions);

            } else {
                var checkEmpty = false;
                var checkNotEmpty = false;

                if (workingFilters.length == 1) {
                    checkEmpty = (workingFilters[0] == 'EMPTY');
                    checkNotEmpty = (workingFilters[0] == 'NOT_EMPTY');
                }

                var filterOptions = "<label><input type='checkbox' inputFilter='0'" + (checkEmpty ? " checked='checked'" : "") + " value='0' />--vide--</label>";
                filterOptions += "<label><input type='checkbox' inputFilter='1'" + (checkNotEmpty ? " checked='checked'" : "") + " value='1' />--non vide--</label>";

                if (checkEmpty || checkNotEmpty) {
                    filterOptions += "<input type='text' value='' />";
                } else {
                    filterOptions += "<input type='text' value='" + workingFilters + "' />";
                }

            }


            if(columnDef.filter != 'checkWithInput') {
                $filter = $("<div class='filter filter-" + columnDef.filter + "'>")
                    .append($(filterOptions))
                    .appendTo($menu);
            }

            $('<button>OK</button>')
                .appendTo($menu)
                .bind('click', function (ev) {
                    columnDef.filterValues = workingFilters;
                    columnDef.filterSuggestbox = (workingFilters.length == 0 ? '' : suggestboxValue);

                    workingFilters = [];

                    if (grid.getOptions().saveColumnFilters) {
                        setSessionColumnFilter(columnDef);
                    }

                    setButtonImage($menuButton, columnDef.filterValues.length > 0);
                    handleApply(ev, columnDef);
                });

            $('<button>Clear</button>')
                .appendTo($menu)
                .bind('click', function (ev) {
                    columnDef.filterValues.length = 0;
                    columnDef.filterSuggestbox = '';

                    if (grid.getOptions().saveColumnFilters) {
                        setSessionColumnFilter(columnDef);
                    }

                    setButtonImage($menuButton, false);
                    handleApply(ev, columnDef);
                });

            $('<button>Cancel</button>')
                .appendTo($menu)
                .bind('click', hideMenu);

            $(':checkbox', $filter).bind('click', function () {
                if ($(this).attr('inputFilter')) {

                    if ($(this).attr('inputFilter') == 0) {
                        workingFilters[0] = "EMPTY";
                        $('input[inputFilter="1"]', $filter).prop('checked', false);
                    } else if ($(this).attr('inputFilter') == 1) {
                        workingFilters[0] = "NOT_EMPTY";
                        $('input[inputFilter="0"]', $filter).prop('checked', false);
                    }

                } else {
                    workingFilters = changeWorkingFilter(filterItems, workingFilters, $(this), suggestboxValue);
                }

            });


            // New selector
            jQuery.expr[':'].Contains = function(a, i, m) {
                return contain(m[3], jQuery(a).text());
            };

            // Overwrites old selecor
            jQuery.expr[':'].contains = function(a, i, m) {
                return contain(m[3], jQuery(a).text());
            };


            $(':text', $filter).on('keyup', function(){

                if(columnDef.filter != 'checkWithInput'){
                    workingFilters = changeWorkingFilterInput(filterItems, workingFilters, $(this));
                } else {

                    suggestboxValue = $(this).val();

                    var valuesExcluded = [];

                    $('label', '.filter-check').show();
                    $('input', '.filter-check').prop('checked', true);

                    if(suggestboxValue != '') {
                        var valueExcluded = null;
                        valuesExcluded.push("");
                        $('label', '.filter-check').not(":contains('" +suggestboxValue  + "')").each(function( index ) {
                            $( this ).hide();
                            $('input', $( this )).prop('checked', false);

                            valueExcluded = $( this).text();

                            if (!isNaN(valueExcluded)) {
                                valueExcluded = Number(valueExcluded);
                            }

                            valuesExcluded.push(valueExcluded);
                        });
                    }

                    $('label[for="'+columnDef.id+'-all"]', '.filter-check').show();
                    $('input[id="'+columnDef.id+'-all"]', '.filter-check').prop('checked', true);


                    var currentValue = null;
                    workingFilters = [];
                    for (var idx = 0; idx < filterItems.length; idx++) {
                        currentValue = filterItems[idx];

                        if(! (currentValue == "")) {
                            if (!isNaN(currentValue)) {
                                currentValue = Number(currentValue);
                            }
                        }

                        if (!_.contains(valuesExcluded, currentValue)) {
                            workingFilters.push(filterItems[idx]);
                        }
                    }
                }

            });

            var offset = $(this).offset();
            var left = offset.left - $menu.width() + $(this).width() - 8;

            $menu.css("top", offset.top + $(this).height())
                .css("left", (left > 0 ? left : 0));
        }


        /**
         * Fonction qui permet de tester qu'un string est contenu dans un autre
         *
         * @param pattern
         * @param value
         * @returns {boolean}
         */
        function contain(pattern, value){
            var tmpValue = "" + value;
            var upValue = tmpValue.toUpperCase();
            var upSearch = pattern.toUpperCase();
            var regExp = new RegExp(upSearch);

            return regExp.test(upValue);
        }


        /**
         * Méthode permettant récupérer la liste des valeurs correspondantes au filtre de la suggestbox appliquer sur les cases a cocher
         *
         * @param filterItems
         * @param suggestboxValue
         * @returns {Array}
         */
        function getValuesMatchingSuggestbox(filterItems, suggestboxValue){
            var values = [];

            for(var i=0; i< filterItems.length; i++){

                if(contain(suggestboxValue,filterItems[i])) {
                    values.push(filterItems[i]);
                }
            }

            return values;
        }

        function columnsResized() {
            hideMenu();
        }

        function changeWorkingFilter(filterItems, workingFilters, $checkbox, suggestboxValue) {
            var value = $checkbox.val();
            var $filter = $checkbox.parent().parent();

            if ($checkbox.val() < 0) {

                //On ne traite que les éléments filtrés
                if (suggestboxValue != '') {
                    // Select All
                    if ($checkbox.prop('checked')) {
                        $(':checkbox', $filter).prop('checked', true);
                        workingFilters = getValuesMatchingSuggestbox(filterItems, suggestboxValue);
                    } else {
                        $(':checkbox', $filter).prop('checked', false);
                        workingFilters.length = 0;
                    }
                } else {
                    // Select All
                    if ($checkbox.prop('checked')) {
                        $(':checkbox', $filter).prop('checked', true);
                        workingFilters = filterItems.slice(0);
                    } else {
                        $(':checkbox', $filter).prop('checked', false);
                        workingFilters.length = 0;
                    }
                }

            } else {

                //on décoche la casse sélectionner tout si
                if(filterItems.length != workingFilters.length){
                    $('input[id$="-all"]', $filter).prop('checked', false);
                }else {
                    $('input[id$="-all"]', $filter).prop('checked', true);
                }

                var index = _.indexOf(workingFilters, filterItems[value]);

                if ($checkbox.prop('checked') && index < 0) {
                    workingFilters.push(filterItems[value]);
                }
                else {
                    if (index > -1) {
                        workingFilters.splice(index, 1);
                    }
                }
            }

            return workingFilters;
        }

        function changeWorkingFilterInput(filterItems, workingFilters, $input) {
            var value = $input.val();
            var $filter = $input.parent().parent();

            workingFilters[0] = value;

            return workingFilters;
        }

        function setButtonImage($el, filtered) {
            var image = "url(" + (filtered ? options.filterImage : options.buttonImage) + ")";

            $el.css("background-image", image);
        }

        function handleApply(e, columnDef) {
            hideMenu();

            self.onFilterApplied.notify({ "grid": grid, "column": columnDef }, e, self);

            e.preventDefault();
            e.stopPropagation();
        }

        function getFilterValues(dataView, column) {
            var seen = [];
            for (var i = 0; i < dataView.getLength() ; i++) {
                if (!dataView.getItem(i).__group) {
                    var value = dataView.getItem(i)[column.field];

                    if (typeof value == 'object') {
                        _.each(value, function(filterValue) {
                            if (!_.contains(seen, filterValue)) {
                                seen.push(filterValue);
                            }
                        });
                    } else {
                        if (!_.contains(seen, value)) {
                            seen.push(value);
                        }
                    }
                }
            }

            return _.sortBy(seen, function (v) { return v; });
        }

        function getAllFilterValues(data, column) {
            var seen = [];
            for (var i = 0; i < data.length; i++) {
                var value = data[i][column.field];

                if (typeof value == 'object') {
                    _.each(value, function(filterValue) {
                        if (!_.contains(seen, filterValue)) {
                            seen.push(filterValue);
                        }
                    });
                } else {
                    if (!_.contains(seen, value)) {
                        seen.push(value);
                    }
                }
            }

            return _.sortBy(seen, function (v) { return v; });
        }

        function handleMenuItemClick(e) {
            var command = $(this).data("command");
            var columnDef = $(this).data("column");

            if (command == 'sort-asc' || command == 'sort-desc') {

                if (grid.getOptions().saveColumnSort) {
                    setSessionColumnSort(columnDef.field, command);
                }

            }

            hideMenu();

            self.onCommand.notify({
                "grid": grid,
                "column": columnDef,
                "command": command
            }, e, self);

            e.preventDefault();
            e.stopPropagation();
        }

        /**
         * Méthode permettant de stoquer dans l'espace de stockage du navigateur la colonne trié et l'ordre de tri
         *
         * @param columnId l'id de la colonne sur laquelle est effectuée le trie
         * @param order l'ordre dans lequel la colonne est triée
         */
        function setSessionColumnSort(columnId, order) {
            var storageName = grid.getLocalStorageName();

            if (storageName != null) {
                var sortStorage = { "column" : columnId, "order" : order };
                var contentStorage;

                if (localStorage.getItem(storageName) != null && localStorage.getItem(storageName) != 'null'
                    && localStorage.getItem(storageName) != undefined && localStorage.getItem(storageName) != "undefined") {

                    contentStorage = JSON.parse(localStorage.getItem(storageName));

                    if (contentStorage.column_sort != undefined) {
                        contentStorage.column_sort = sortStorage;
                    } else {
                        contentStorage.column_sort = sortStorage;
                    }

                } else {
                    contentStorage = { "column_sort" : { "column" : columnId, "order" : order } };
                }

                localStorage.setItem(storageName, JSON.stringify(contentStorage));
            }
        }


        /**
         * Méthode permettant stoquer la colonne filtrer et les valeurs
         *
         * @param columnDef la colonne a filtrer
         */
        function setSessionColumnFilter(columnDef) {

            var storageName = grid.getLocalStorageName();

            if (storageName != null) {
                var filters = { "id" : columnDef.id, "values" : columnDef.filterValues, "suggestbox" : columnDef.filterSuggestbox };
                var contentStorage;

                if (localStorage.getItem(storageName) != null && localStorage.getItem(storageName) != 'null'
                    && localStorage.getItem(storageName) != undefined && localStorage.getItem(storageName) != "undefined") {

                    contentStorage = JSON.parse(localStorage.getItem(storageName));

                    if (contentStorage.column_filter != undefined) {

                        if (contentStorage.column_filter.length > 0) {
                            var idxFound = -1;

                            for (var k = 0; k < contentStorage.column_filter.length; k++){
                                if(contentStorage.column_filter[k].id == columnDef.id){
                                    idxFound = k;
                                    break;
                                }
                            }

                            if (idxFound >= 0) {

                                if(columnDef.filterValues.length > 0){
                                    contentStorage.column_filter[idxFound] = filters;
                                } else {
                                    //supprimer le filtre du tableau JSON
                                    contentStorage.column_filter.splice(idxFound,1);
                                }

                            } else {
                                if (columnDef.filterValues.length > 0) {
                                    contentStorage.column_filter[contentStorage.column_filter.length] = filters;
                                }
                            }

                        } else {
                            if (columnDef.filterValues.length > 0) {
                                contentStorage.column_filter[0] = filters;
                            }
                        }

                    } else {
                        if (columnDef.filterValues.length > 0) {
                            contentStorage.column_filter = [filters] ;
                        }
                    }
                } else {
                    if (columnDef.filterValues.length > 0) {
                        contentStorage = { "column_filter" : [{ "id" : columnDef.id, "values" : columnDef.filterValues, "suggestbox" : columnDef.filterSuggestbox }] };
                    }
                }

                localStorage.setItem(storageName, JSON.stringify(contentStorage));
            }

         }

        function setColumnFiltered(index)
        {
            var $menuButton = $('.slick-header-columns .slick-header-menubutton:eq(' + index + ')');
            setButtonImage($menuButton, true);
        }

        $.extend(this, {
            "init": init,
            "destroy": destroy,
            "onFilterApplied": new Slick.Event(),
            "onCommand": new Slick.Event(),
            "setColumnFiltered": setColumnFiltered
        });
    }
})(jQuery);
