/* 
method
url
data
success 数据下载成功以后
error 数据下载失败后
 */

function $ajax({ method = "get", url, data, success, error }) {
    //1.创建ajax对象
    var xhr = null;
    try {
        xhr = new XMLHttpRequest();
    } catch (error) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (data)
        data = querystring(data);

    if (method == "get" && data) {
        url += "?" + data;
    }
    xhr.open(method, url, true);

    if (method == "get") {
        xhr.send();
    } else {
        //必须在send方法之前去设置请求的格式
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")
        xhr.send(data);
    }

    //4.等待数据响应
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            //判断状态码
            if (xhr.status == 200) {
                if (success) {
                    success(xhr.responseText);
                }
            } else {
                if (error) {
                    error("error:" + xhr.status)
                }
            }
        }
    }
}
function querystring(obj) {
    var str = "";
    for (var attr in obj) {
        str += attr + "=" + obj[attr] + "&";
    }
    return str.substring(0, str.length - 1);
}