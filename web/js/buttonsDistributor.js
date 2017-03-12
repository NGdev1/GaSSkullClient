/**
 * Created by Михаил on 15.03.16.
 */

$(document).ready(function () {
    var layout = null;
    var buttons = null;
    var finder = new Finder();
    var buttonsContainer = $('#buttonsContainer');

    init();

    function init() {
        $.getJSON('layout.json', function (data) {
            layout = data;
            $.getJSON('buttons.json', function (data) {
                buttons = data;
                reloadInterface();
            });
        });
    }


    function reloadInterface() {
        var menu = finder.getCurrentMenuFromLayout(layout);

        if (menu == null) clearButtonsContainer();
        else buildInterface(menu);
    }

    function clearButtonsContainer() {
        buttonsContainer.hide(200);
    }

    function buildInterface(menu) {
        var title = $('#title');
        title.fadeTo(200, 0.3, function () {
            title.html(menu.title);
            title.fadeTo(200, 1);
        });


        buttonsContainer.hide(200);
        for (var i = 0; i < menu.menu.length; i++) {
            var button = $('<a/>', {
                'class': 'button-center-oval',
                'onclick': 'onClick()'
            });
            button.append(menu.menu[i].title);

            buttonsContainer.append(button);
        }
        buttonsContainer.show(200);

        $.ajax({
            url: menu.url,
            type: "GET"
        }).done(function (data) {
            $('#content').html(data);
        });
    }

    function getButtonWIthType(type, options) {
        if(type == 'logout'){

        }
    }
});
