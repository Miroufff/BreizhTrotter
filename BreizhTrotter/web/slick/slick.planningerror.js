(function ($) {
    // Register namespace
    $.extend(true, window, {
        "Slick": {
            "PlanningError": PlanningError
        }
    });

    /**
     * AutoTooltips plugin to show/hide tooltips when columns are too narrow to fit content.
     * @constructor
     * @param {boolean} [options.enableForCells=true]        - Enable tooltip for grid cells
     * @param {boolean} [options.enableForHeaderCells=false] - Enable tooltip for header cells
     * @param {number}  [options.maxToolTipLength=null]      - The maximum length for a tooltip
     */
    function PlanningError(options) {
        var _grid;
        var _self = this;
        var errorMessages = {};
        var _defaults = {
            planningErrors: {}
        };

        /**
         * Initialize plugin.
         */
        function init(grid) {
            options = $.extend(true, {}, _defaults, options);
            _grid = grid;

            //_grid.onCellCssStylesChanged.subscribe(handleCellCssStylesChanged)
            var cellError = options.planningErrors;
            $.each(cellError, function(rowIndex, cells) {
                $.each(cells, function(cellIndex, message) {
                    if (_.contains(errorMessages, message)) {
                        cellError[rowIndex][cellIndex] = 'ep-' + _.indexOf(errorMessages, message);
                    } else {
                        cellError[rowIndex][cellIndex] = 'ep-' + _.size(errorMessages);
                        errorMessages['ep-' + _.size(errorMessages)] = message;
                    }
                });
            });

            grid.setCellCssStyles('highlight', cellError);

            _grid.onMouseEnter.subscribe(handleMouseEnter);

            /*var rows = options.planningErrors;

            $.each(rows, function(rowIndex, cells) {
                $.each(cells, function(cellIndex, message) {
                    var $node = $(_grid.getCellNode(rowIndex, _grid.getColumnIndex(cellIndex)));
                    $node.addClass("cell-error");
                    $node.attr("title", message);
                });
            })*/
        }

        /*function handleCellCssStylesChanged(e, key, hash) {
            $.each(key.hash, function(rowIndex, cells) {
                $.each(cells, function(cellIndex, message) {
                    var $node = $(_grid.getCellNode(rowIndex, _grid.getColumnIndex(cellIndex)));
                    $node.addClass("cell-error");
                    $node.attr("title", "message");
                });
            })
        }*/

        function handleMouseEnter(e) {
            var cell = _grid.getCellFromEvent(e);
            if (cell) {
                var $node = $(_grid.getCellNode(cell.row, cell.cell));
                var className = $node.attr('class')
                var startPosition = className.indexOf(' ep-');
                if (startPosition >= 0) {
                    var errorClassName = "";
                    startPosition++;
                    var lastPosition = className.indexOf(" ", startPosition);
                    if (lastPosition == -1) {
                        errorClassName = className.substring(startPosition)
                    } else {
                        errorClassName = className.substring(startPosition, lastPosition);
                    }
                    $node.attr("title", errorMessages[errorClassName]);
                }
            }
        }

    // Public API
        $.extend(this, {
            "init": init
        });
    }
})(jQuery);