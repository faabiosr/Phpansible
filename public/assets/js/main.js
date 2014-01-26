
function Main() {

}

Main.prototype.form = function() {

    var checkbox  = $('.ui.checkbox'),
        dropdown  = $('.ui.selection.dropdown')
        toggle    = $('.ui.toggle.button')
        buttons   = $('.ui.buttons .button')
        addButton = $('i.add').closest('a.button');

    checkbox.checkbox();
    dropdown.dropdown();

    toggle.filter('.phpmyadmin').state({
        text: {
            active: 'Enabled',
            inactive: 'Disabled'
        },
        onActivate: function() {
            $('input[name=phpmyadmin]').val(1);
        },
        onDeactivate: function() {
            $('input[name=phpmyadmin]').val(0);
        }
    });

    toggle.filter('.composer').state({
        text: {
            active: 'Enabled',
            inactive: 'Disabled'
        },
        onActivate: function() {
            $('input[name=composer]').val(1);
        },
        onDeactivate: function() {
            $('input[name=composer]').val(0);
        }
    });

    buttons.filter('.phpversion').on('click', function(){
        $(this)
            .addClass('active')
            .addClass('green')
            .siblings()
            .removeClass('active')
            .removeClass('green')
            .addClass('black');

        $('input[name=php_version]').val($(this)
            .data('value'));
    });

    addButton.on('click', this.addSegment);
    this.removePort();

    $('input.selectized').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        createOnBlur: true,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });

    $('select.selectized').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        },
        maxItems: null,
        valueField: 'value',
        labelField: 'text',
        searchField: 'value'
    });
}

Main.prototype.waypoints = function() {

    var peek      = $('.peek'),

        peekItem  = peek.children('.menu')
                        .children('a.item'),

        waypoints = peek.closest('.container')
                        .find('h2')
                        .first()
                        .siblings('h2')
                        .addBack();

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

Main.prototype.addSegment = function() {

    var segments = $(this).closest('.ui.segment')
                        .find('.ui.segment');

    var clone = segments.first()
                    .clone(true, true);

    clone.find('input')
        .val('');

    segments.last()
        .after(clone);
}

Main.prototype.removePort = function() {

    $('a.ui.right.corner').on('click', function() {

        if ($(this).closest('.field > .ui.segment').find('.ui.segment').length === 1) {

            $(this).closest('.ui.segment')
                .find('input')
                .val('');

            return;
        }

        $(this).closest('.ui.segment')
            .remove();
    });
}

Main.prototype.validation = function() {

    var validationRules = {
        name: {
            identifier: 'name',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter VM name'
                }
            ]
        },
        ipAddress: {
            identifier: 'ip_address',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter VM ip address'
                }
            ]
        },
        memory: {
            identifier: 'memory',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter VM memory'
                }
            ]
        },
        webserverModules: {
            identifier: 'webserver_modules',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter Webserver modules'
                }
            ]
        },
        webserverName: {
            identifier: 'webserver_name',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter Webserver name'
                }
            ]
        },
        webserverDocRoot: {
            identifier: 'webserver_docroot',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter Webserver document root'
                }
            ]
        },
        webserverPort: {
            identifier: 'webserver_port',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter Webserver port'
                }
            ]
        },
        mysqlPass: {
            identifier: 'myqsl_password',
            rules: [{
                    type: 'empty',
                    prompt: 'Please enter MySQL password'
                }
            ]
        }
    };

    $('.ui.form').form(validationRules, {
        inline: true,
        on: 'blur'
    });
}

$(document).ready(function(){
    var main = new Main();

    main.form();
    main.validation();
    main.waypoints();
});