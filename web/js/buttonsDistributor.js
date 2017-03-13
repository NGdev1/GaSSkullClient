/**
 * Created by Михаил on 15.03.16.
 */

var layout = null;
var buttons = null;
var finder = new Finder();
var buttonsContainer;
var leftButtonContainer;
var rightButtonContainer;
var contentContainer;
var titleContainer;
var pathContainer;

function init() {
    $.getJSON('layout.json', function (data) {
        layout = data;
        finder.setLayout(layout);
        $.getJSON('buttons.json', function (data) {
            buttons = data;
            reloadInterface();
        });
    });
}

function reloadInterface() {
    buildInterface(finder.getCurrentMenu(), finder.getFoldersArray());
}

function clearButtonsContainer() {
    buttonsContainer.html('');
}

function buildInterface(menu, path) {
    var title = titleContainer;
    title.fadeTo(200, 0.3, function () {
        title.html(menu.title);
        title.fadeTo(200, 1);
    });

    pathContainer.html('');
    var i;
    var pathItemClass = 'pathItem';
    for(i = 0; i < path.length; i++){
        if(i == path.length - 1) pathItemClass += ' bold';

        var pathItem = $('<a/>', {
            'text': path[i],
            'onclick': 'setDepth(' + i + ')',
            'class': pathItemClass
        });

        pathContainer.append(pathItem);
        pathContainer.append('/');
    }


    clearButtonsContainer();
    if(menu.menu != undefined) {
        buttonsContainer.hide(200);
        for (i = 0; i < menu.menu.length; i++) {
            var button = $('<a/>', {
                'class': 'button-center-oval',
                'onclick': 'goDeeper(' + i + ')',
                'text': menu.menu[i].title
            });

            buttonsContainer.append(button);
        }
        buttonsContainer.show(200);
    }


    rightButtonContainer.html(getButtonWIthType(menu.rightButton));
    leftButtonContainer.html(getButtonWIthType(menu.leftButton));

    $.ajax({
        url: menu.url,
        type: "GET"
    }).done(function (data) {
        contentContainer.html(data);
    });
}

function getButtonWIthType(type) {
    for (var i = 0; i < buttons.length; i++) {
        if (type == buttons[i].type) {
            return $('<a/>', {
                'class': buttons[i].class,
                'text': buttons[i].text,
                'onclick': buttons[i].onclick
            });
        }
    }

    return $('<a/>', {
        'class': 'empty'
    })
}

$(document).ready(function () {
    init();

    buttonsContainer = $('#buttonsContainer');
    leftButtonContainer = $('#leftButtonContainer');
    rightButtonContainer = $('#rightButtonContainer');
    contentContainer = $('#content');
    titleContainer = $('#title');
    pathContainer = $('#pathContainer');
});
