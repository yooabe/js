function Drag(id) {
    this.oDiv = document.getElementById(id);
    var _this = this;
    this.oDiv.onmousedown = function (ev) {
        _this.funcDown(ev);
    };
    document.onmouseup = this.funcUp;
}

Drag.prototype.funcDown = function (ev) {
    var e = ev || window.event;
    this.offsetX = e.clientX - this.oDiv.offsetLeft;
    this.offestY = e.clientY - this.oDiv.offsetTop;
    var _this = this;
    document.onmousemove = this.funcMove.bind(this);
}
Drag.prototype.funcMove = function (ev) {
    var e = ev || window.event;
    this.oDiv.style.left = e.clientX - this.offsetX + 'px';
    this.oDiv.style.top = e.clientY - this.offestY + 'px';
}
Drag.prototype.funcUp = function () {
    document.onmousemove = null;
}