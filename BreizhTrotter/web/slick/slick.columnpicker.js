(function ($) {


    // Slick.Controls.ColumnPicker
    $.extend(true, window, {
        Slick:{
            Controls:{
                ColumnPicker:SlickColumnPicker
            }
        }
    });


    function SlickColumnPicker(columns, grid, options) {
        var self = this;
        var $menu;
        var columnCheckboxes;

        var defaults = {
            fadeSpeed:250
        };

        function init() {
            grid.onHeaderContextMenu.subscribe(handleHeaderContextMenu);
            grid.onColumnsReordered.subscribe(updateColumnOrder);
            options = $.extend({}, defaults, options);

            $menu = $("<span class='slick-columnpicker' style='display:none;position:absolute;z-index:20;' />").appendTo(document.body);

            $menu.bind("mouseleave", function (e) {
                $(this).fadeOut(options.fadeSpeed)
            });

            $menu.bind("click", updateColumn);
        }

        function handleHeaderContextMenu(e, args) {
            e.preventDefault();
            $menu.empty();
            updateColumnOrder();
            columnCheckboxes = [];

            var $li, $input;

            for (var i = 0; i < columns.length; i++) {
                if (typeof columns[i] == 'object') {
                    $li = $("<li />").appendTo($menu);
                    $input = $("<input type='checkbox' />").data("column-id", columns[i].id);
                    columnCheckboxes.push($input);

                    if (grid.getColumnIndex(columns[i].id) != null) {
                        $input.attr("checked", "checked");
                    }

                    $("<label />")
                        .text(columns[i].name)
                        .prepend($input)
                        .appendTo($li);
                }
            }

            $("<hr/>").appendTo($menu);
            $li = $("<li />").appendTo($menu);
            $("<label />")
                .html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clear filters").on('click', function() {
                    grid.clearLocalStorage();
                })
                .appendTo($li);

            $li = $("<li />").appendTo($menu);

            $input = $("<input type='checkbox' />").data("option", "autoresize");

            $("<label />")
                  .text("Force fit columns")
                  .prepend($input)
                  .appendTo($li);
            if (grid.getOptions().forceFitColumns) {
                $input.attr("checked", "checked");
            }

            $li = $("<li />").appendTo($menu);

            $input = $("<input type='checkbox' />").data("option", "syncresize");

            $("<label />")
                .text("Synchronous resize")
                .prepend($input)
                .appendTo($li);
            if (grid.getOptions().syncColumnCellResize) {
                $input.attr("checked", "checked");
            }


            $menu
                .css("top", e.pageY - 10)
                .css("left", e.pageX - 10)
                .fadeIn(options.fadeSpeed);
        }

        function updateColumnOrder() {
            // Because columns can be reordered, we have to update the `columns`
            // to reflect the new order, however we can't just take `grid.getColumns()`,
            // as it does not include columns currently hidden by the picker.
            // We create a new `columns` structure by leaving currently-hidden
            // columns in their original ordinal position and interleaving the results
            // of the current column sort.

            var current = grid.getColumns().slice(0);
            var ordered = new Array(columns.length);

            for (var i = 0; i < ordered.length; i++) {
                if (typeof columns[i] == 'object' && grid.getColumnIndex(columns[i].id) === undefined ) {
                    // If the column doesn't return a value from getColumnIndex,
                    // it is hidden. Leave it in this position.
                    ordered[i] = columns[i];
                } else {
                    // Otherwise, grab the next visible column.
                    ordered[i] = current.shift();
                }
            }

            columns = ordered;
        }

        function updateColumn(e) {

            if ($(e.target).data("option") == "autoresize") {

                if (e.target.checked) {
                  grid.setOptions({forceFitColumns:true});
                  grid.autosizeColumns();
                } else {
                  grid.setOptions({forceFitColumns:false});
                }

                return;
            }

            if ($(e.target).data("option") == "syncresize") {

                if (e.target.checked) {
                  grid.setOptions({syncColumnCellResize:true});
                } else {
                  grid.setOptions({syncColumnCellResize:false});
                }

                return;
            }

            if ($(e.target).is(":checkbox")) {

                var visibleColumns = [];
                var hiddenColumns = [];

                $.each(columnCheckboxes, function (i, e) {

                    if ($(this).is(":checked")) {
                        visibleColumns.push(columns[i]);
                    } else {
                        hiddenColumns.push(columns[i]);
                    }
                });

                if (!visibleColumns.length) {
                    $(e.target).attr("checked", "checked");
                    return;
                }

                if (grid.getOptions().saveColumnHidden) {
                    setSessionColumnHidden(hiddenColumns);
                }

                self.onHideColumn.notify({ "grid": grid, "hiddenColumns": hiddenColumns }, e, self);

                grid.setColumns(visibleColumns);
            }
        }


        /**
         * Méthode permettant de stoquer dans l'espace de stockage du navigateur la colonne masquer
         *
         * @param jsonHiddenColumns tableau json des colonnes masqués
         */
        function setSessionColumnHidden(jsonHiddenColumns) {

            var storageName = grid.getLocalStorageName();

            if (storageName != null) {

                var contentStorage;

                var hiddenColumns = [];

                if (jsonHiddenColumns.length > 0) {

                    for(var k = 0; k < jsonHiddenColumns.length; k++){
                        hiddenColumns.push(jsonHiddenColumns[k].id);
                    }

                }

                if (localStorage.getItem(storageName) != null && localStorage.getItem(storageName) != 'null'
                    && localStorage.getItem(storageName) != undefined && localStorage.getItem(storageName) != "undefined") {

                    contentStorage = JSON.parse(localStorage.getItem(storageName));
                    contentStorage.column_hidden = hiddenColumns;

                } else {
                    contentStorage = { "column_hidden" : hiddenColumns };
                }

                localStorage.setItem(storageName, JSON.stringify(contentStorage));
            }
        }



        function getAllColumns() {
            return columns;
        }

        init();

        $.extend(this, {
              "init": init,
              "getAllColumns": getAllColumns,
              "onHideColumn": new Slick.Event()
        });

    }

})(jQuery);
