var Main = {};

Main.ready = function() {

    var checkbox  = $('.ui.checkbox'),
        dropdown  = $('.ui.selection.dropdown');
        toggle    = $('.ui.toggle.button');
        buttons   = $('.ui.buttons .button')
        peek      = $('.peek'),
        peekItem  = peek.children('.menu').children('a.item'),
        waypoints = peek.closest('.container').find('h2').first().siblings('h2').addBack();

    checkbox.checkbox();
    dropdown.dropdown();

    toggle.state({
        text: {
            active: 'Enabled',
            inactive: 'Disabled'
        }
    });

    buttons.on('click', function(){
        $(this)
            .addClass('active')
            .addClass('green')
            .siblings()
            .removeClass('active')
            .removeClass('green')
    });

    waypoints.waypoint({
        continuos: false,
        offset: 100,
        handler: function(direction) {
            var index = 0;

            if (direction == 'down') {
                index = waypoints.index(this);
            } else {
                if (waypoints.index(this) - 1 >= 0) {
                    index = waypoints.index(this) - 1;
                }
            }

            peekItem
                .removeClass('active')
                .eq(index)
                .addClass('active');
        }
    });

    peek.waypoint('sticky', {
        offset: 85,
        stuckClass: 'stuck'
    });
}

$(document).ready(Main.ready);