
function Main() {
    this.templates = {
        'synced-folders': $('.ui.segment.synced-folders').clone(),
        'fowarded-ports': $('.ui.segment.fowarded-ports').clone(),
        'webserver-vhost': $('.ui.segment.webserver-vhost').clone(),
        'mysql-database': $('.ui.segment.mysql-database').clone()
    }
}

Main.prototype.form = function() {

    var that = this;

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
            $('input#phpmyadmin').val(1);
        },
        onDeactivate: function() {
            $('input#phpmyadmin').val(0);
        }
    });

    toggle.filter('.composer').state({
        text: {
            active: 'Enabled',
            inactive: 'Disabled'
        },
        onActivate: function() {
            $('input#composer').val(1);
        },
        onDeactivate: function() {
            $('input#composer').val(0);
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

    addButton.on('click', function(){
        that.addSegment(this);
    });

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
        maxItems: null,
        valueField: 'value',
        labelField: 'text',
        searchField: 'value'
    });

    $('select.selectized-single').selectize();
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

Main.prototype.addSegment = function(element) {

    var segments = $(element).closest('.ui.segment')
                        .find('.ui.segment');

    var clone;

    if (segments.last().hasClass('synced-folders')) {
        clone = this.templates['synced-folders'].clone(true, true);
    }

    if (segments.last().hasClass('fowarded-ports')) {
        clone = this.templates['fowarded-ports'].clone(true, true);
    }

    if (segments.last().hasClass('webserver-vhost')) {
        clone = this.templates['webserver-vhost'].clone(true, true);
    }

    if (segments.last().hasClass('mysql-database')) {
        clone = this.templates['mysql-database'].clone(true, true);
    }

    var segmentId = segments.length + 1;

    clone.find(':input[name]').each(function(){
        $(this).attr('name', $(this).attr('name').replace(/\d/gi, segmentId));
        $(this).attr('id', $(this).attr('id').replace(/\d/gi, segmentId));
        $(this).closest('.field').find('label').attr('for', $(this).closest('.field').find('label').attr('for').replace(/\d/gi, segmentId));
    });

    clone.find('select.selectized-single').selectize();
    clone.find('select.selectized').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        maxItems: null,
        valueField: 'value',
        labelField: 'text',
        searchField: 'value'
    });

    clone.data('id', segmentId)
        .attr('data-id', segmentId);

    clone.find('input')
        .val('');

    segments.last().after(clone);

    this.removePort();
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
        on: 'blur',
        keyboardShortcuts: false
    });
}

$(document).ready(function(){
    var main = new Main();

    main.form();
    main.validation();
    main.waypoints();
});