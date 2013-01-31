$(function() {
    $( "#tabs" ).tabs({
        beforeLoad: function( event, ui ) {
            ui.jqXHR.error(function() {
                ui.panel.html( "Couldn't load this tab. We'll try to fix this as soon as possible." );
            });
        }
    });
    
    function split( val ) {
        return val.split( /,\s*/ );
    }
    
    function extractLast( term ) {
        return split( term ).pop();
    }
    
    $.widget( "custom.catcomplete", $.ui.autocomplete, {
        _renderMenu: function( ul, items ) {
            var that = this,
            currentCategory = "";
            $.each( items, function( index, item ) {
                if ( item.category != currentCategory ) {
                    ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
                    currentCategory = item.category;
                }
                that._renderItemData( ul, item );
            });
        }
    });
    
    $( "#search" )
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "autocomplete" ).menu.active ) {
                event.preventDefault();
            }
        })
        .catcomplete({
            delay: 0,
            source: function( request, response ) {
                $.getJSON( "/search", {
                    term: extractLast( request.term ),
                    where_search: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );
                if ( term.length < 2 ) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                terms.push( "" );
                this.value = terms.join( "" );
                $('#search-result').load(
                    'get-details/?term=' + encodeURIComponent(ui.item.value) + '&where_search=' + encodeURIComponent(ui.item.category)
                )
                return false;
            }
    });
});