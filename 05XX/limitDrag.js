function limitDrag(id) {
    //继承属性 构造函数的伪装
    Drag.apply(this, [id]);
}

//继承方法 原型链
for (var funcName in Drag.prototype) {
    limitDrag.prototype[funcName] = Drag.prototype[funcName];
}
limitDrag.prototype.funcMove = function (ev) {
    var e = ev || window.event;
    var l = e.clientX - this.offsetX;
    var windowWidth = document.documentElement.clientWidth || document.body.clientWidth;
    if (l <= 0) {
        l = 0;
    }
    if (l >= windowWidth - this.oDiv.offsetWidth) {
        l = windowWidth - this.oDiv.offsetWidth;
    }
    var t = e.clientY - this.offestY;
    var windowHeight = document.documentElement.clientHeight || document.body.clientHeight;
    if (t <= 0) {
        t = 0;
    }
    if (t >= windowHeight - this.oDiv.offsetHeight) {
        t = windowHeight - this.oDiv.offsetHeight;
    }
        this.oDiv.style.left = l + 'px';
        this.oDiv.style.top = t + 'px';
    }