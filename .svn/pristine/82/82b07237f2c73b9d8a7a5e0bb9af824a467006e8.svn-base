$(function() {
    $(".add-load").click(function() {
        var index   = $(".preferential-pic").length;//由于下标从0开始，当前条数的下一条就是 -1 + 1 = 0
        var amount  = 8;//每次获取数据个数: 8个
        var sid     = $("#sid").val();

        $.ajax({
            type        : "post",
            url			: "data.php?action=more",
            dataType	: "json",
            data 		: {
                index	: index,
                amount	: amount,
                sid     : sid
            },
            success		: function(data) {
                if("0" != data) {

                    var htmlCode = "";
                    for(var i = 0; i < data.length; i++){
                        htmlCode += "<div class = 'preferential-pic'>";

                            htmlCode += "<div class = 'pre-picture'>";
                                htmlCode += "<img src = '";
                                htmlCode += data[i].imgPath;
                                htmlCode += "'>";
                            htmlCode += "</div>";

                            htmlCode += "<div class = 'preferential-info'>";
                                htmlCode += "<span class = 'product-name'>";
                                htmlCode += data[i].foodname;
                                htmlCode += "</span><br/>";

                                htmlCode += "<span class = 'current-price'> 益米价：<span>";
                                htmlCode += data[i].currentPrice;
                                htmlCode += "元</span></span>";

                                htmlCode +=	"<span class = 'old-price'>";
                                htmlCode += data[i].oldPrice;
                                htmlCode += "</span>";
                            htmlCode += "</div>";

                            htmlCode += "<div class = 'link-pic'>";
                                htmlCode += "<a href = '#' class = 'links'>";
                                htmlCode += "<img src = '../static/images/links.png'>";
                                htmlCode += "</a>";
                            htmlCode += "</div>";

                        htmlCode +="</div>";
                    }
                    $(".preferential-list").append(htmlCode);
                }
                else {
                    $(".add-load").text("没有啦~");
                    $("#add-load").fadeOut(2000);
                }
            }
        });
        return false;
    })
})