/**
 * Created by Yip on 14-4-27.
 */
$(function() {
    $("#more_shop").click(function() {
        var index   = $(".preferential-pic").length + 9;//下标从0开始，微信已经显示了9条数据，当前条数的下一条就是： -1 + 9 + 1 = 9
        var amount  = 8;//每次获取数据个数: 8个
        var type    = $("#type").val();
        $.ajax({
            type        : "post",
            url			: "data.php?action=shop",
            dataType	: "json",
            data 		: {
                index	: index,
                amount	: amount,
                type    : type
            },
            success		: function(data) {
                if("0" != data) {

                    var htmlCode = "";
                    for(var i = 0; i < data.length; i++){

                        htmlCode += "<div class = 'preferential-pic'>";

                            htmlCode += "<img src = '";
                            htmlCode += data[i].articleImgPath;
                            htmlCode += "' class='pre-picture'>";

                            htmlCode += "<div class = 'preferential-info'>";
                                htmlCode += "<span class = 'product-name'>";
                                htmlCode += data[i].articleTitile;
                                htmlCode += "</span>";
                            htmlCode += "</div>";

                            htmlCode += "<div class = 'link-pic'>";
                                htmlCode += "<a href = 'index.php?sid=";
                                htmlCode += data[i].sid;
                                htmlCode += "' class = 'links'>";
                                htmlCode += "<img src = '../static/images/links.png'>";
                                htmlCode += "</a>";
                            htmlCode += "</div>";

                        htmlCode +="</div>";
                    }
                    $(".preferential-list").append(htmlCode);
                }
                else {
                    $("#more_shop").text("没有啦~");
                    $("#add-load").fadeOut(2000);

                }
            }
        });
        return false;
    })
})