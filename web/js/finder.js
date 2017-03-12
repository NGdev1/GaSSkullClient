/**
 * Created by Михаил on 19.03.16.
 */

function Finder() {
    this.depth = 0;
    this.folders = [];
}

Finder.prototype.upFolder = function () {
    this.depth--;

    return this.folders[this.depth];
};

Finder.prototype.addFolder = function (branch) {
    this.depth++;

    this.folders[this.depth] = branch;
};

Finder.prototype.getCurrentFolderName = function () {
    return this.folders[this.depth];
};

Finder.prototype.getFolderWithIndex = function (index) {
    return this.folders[index];
};

Finder.prototype.getDepth = function () {
    return this.depth;
};

Finder.prototype.getCurrentMenuFromLayout = function (layout) {
    if(this.depth == 0) return layout;

    var currentMenu = layout;

    for (var i = 1; i < this.depth; i++) {
        for (var w = 0; w < currentMenu.menu.length; w++) {
            if (this.getFolderWithIndex(i) == currentMenu.menu[w].title) {

                if (currentMenu.menu[w].menu != undefined) {
                    currentMenu.menu = currentMenu.menu[w].menu;

                    if (i == this.depth - 1) {
                        return currentMenu;
                    }

                    break;
                } else {
                    return null;
                }
            }
        }
    }

    return null;
};

