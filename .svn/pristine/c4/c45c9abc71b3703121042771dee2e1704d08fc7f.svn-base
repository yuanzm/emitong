/**
 * Created by Yip on 14-4-9.
 */
//时间选择控件
$(function(){
    var begin_time = new Date($('#begin_time').val());
    var end_time = new Date($('#end_time').val());
    $('#dp4').datepicker()
        .on('changeDate', function(ev){
            if (ev.date.valueOf() >= end_time.valueOf()){
                $('#alert').show().find('strong').text('开始时间不能大于等于结束时间');
            } else {
                $('#alert').hide();
                begin_time = new Date(ev.date);
                $('#begin_time').val($('#dp4').data('date'));
            }
            $('#dp4').datepicker('hide');
        });
    $('#dp5').datepicker()
        .on('changeDate', function(ev){
            if (ev.date.valueOf() <= begin_time.valueOf()){
                $('#alert').show().find('strong').text('结束时间不能小于等于开始时间');
            } else {
                $('#alert').hide();
                end_time = new Date(ev.date);
                $('#end_time').val($('#dp5').data('date'));
            }
            $('#dp5').datepicker('hide');
        });
});