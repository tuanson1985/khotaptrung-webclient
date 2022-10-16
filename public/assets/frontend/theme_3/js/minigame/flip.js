var numrollbyorder = 0;
document.addEventListener('touchmove', function (event) {
    if (event.scale !== 1) { event.preventDefault(); }
}, false);
var lastTouchEnd = 0;
document.addEventListener('touchend', function (event) {
    var now = (new Date()).getTime();
    if (now - lastTouchEnd <= 300) {
        event.preventDefault();
    }
    lastTouchEnd = now;
}, false);

$(document).ready(function(e){
    initial();
    $('.play').click(function(){
        roll_check = true;
        $('.boxflip img.flip-box-front').each(function(){
            $(this).attr('src',$('#image_static').val());
        })
        $('.boxflip .flip-box-front').css({'transform': 'rotateY(0deg)'});
        $('.boxflip .flip-box-front').parent().css({'transform': 'rotateY(0deg)'});
        $('.boxflip .flip-box-front').prev().removeClass('transparent');
        $('.boxflip .flip-box-front').addClass('img_remove');
        $('.num-play-try').hide();
        $('.play').hide();

        //$('.continue').hide();
        $('#type_play').val('real');
    })
    $('.num-play-try').click(function(){
        roll_check = true;
        $('.boxflip img.flip-box-front').each(function(){
            $(this).attr('src',$('#image_static').val());
        })
        $('.boxflip .flip-box-front').css({'transform': 'rotateY(0deg)'});
        $('.boxflip .flip-box-front').parent().css({'transform': 'rotateY(0deg)'});
        $('.boxflip .flip-box-front').prev().removeClass('transparent');
        $('.boxflip img.flip-box-front').addClass('img_remove');
        $('.num-play-try').hide();
        $('.play').hide();
        //$('.continue').hide();
        $('#type_play').val('try');
    })
    function initial(){
        gift_list = [];
        $('.image_gift').each(function(){
            gift_list.push({'image':$(this).val()})
        })
        gift_list = shuffle(gift_list);
        var i=0;
        $('.boxflip img.flip-box-front').each(function(){
            $(this).attr('src',gift_list[i].image);
            i++;
        })
    }
    var saleoffpass = "";
    var saleoffmessage = "";
    var gift_revice="";
    var userpoint = 0;
    var roll_check = true;
    var num_loop = 4;
    var angle_gift = '';
    var num_gift = '';
    var gift_detail = '';
    var gift_list = '';
    var num_roll_remain = 0;
    var angles = 0;
    var free_wheel = 0;
    var arrDiscount = '';
    //Click nút lật
    $('body').delegate('.img_remove', 'click', function(){
        $('.boxflip .flip-box-front').removeClass('img_remove');
        $('.boxflip .flip-box-front').removeClass('active');
        $('.boxflip .flip-box-front').addClass('noactive');
        saleoffpass = $("#saleoffpass").val();
        $(this).removeClass('noactive');
        $(this).addClass('active');
        if(roll_check){
            roll_check = false;
            numrolllop = $("#numrolllop").val();
            $.ajax({
                url: '/minigame-play',
                datatype:'json',
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: $('#group_id').val(),
                    numrollbyorder: numrollbyorder,
                    typeRoll : $('#type_play').val(),
                    saleoffpass:saleoffpass,
                    numrolllop:numrolllop,
                },
                type: 'post',
                success: function (data) {
                    gift_detail = data.gift_detail;
                    setTimeout(function(){
                        if(gift_detail != undefined){
                            $('.boxflip .active').attr('src',gift_detail.image);
                            $('.boxflip .active').css({'transform': 'rotateY(180deg)'});
                            $('.boxflip .active').prev().addClass('transparent');
                            $('.boxflip .active').parent().css({'transform': 'rotateY(180deg)'});
                        }
                        $('.boxflip .flip-box-front').prev().removeClass('transparent');
                        $('.boxflip .flip-box-front').removeClass('active');
                    },1000);
                    if (data.status == 4) {
                        location.href='/login';
                    } else if (data.status == 3) {
                        roll_check = true;
                        $('#naptheModal').modal('show');
                    } else if (data.status == 0) {
                        roll_check = true;
                        $("#btnWithdraw").hide();
                        $('#noticeModal .content-popup').text(data.msg);
                        $('#noticeModal').modal('show');
                        $('.num-play-try').show();
                        $('.play').show();
                        //$('.continue').show();
                        // if($('#type_play').val() == "real")
                        // {
                        //     $('.continue').html("Chơi tiếp");
                        // }
                        // else
                        // {
                        //     $('.continue').html("Chơi thử tiếp");
                        // }
                        return;
                    }
                    numrollbyorder = parseInt(data.numrollbyorder) + 1;
                    free_wheel = data.free_wheel;
                    //arrDiscount = data.arrDiscount;
                    gift_list = data.listgift;
                    gift_list = shuffle(gift_list);
                    gift_revice = data.arr_gift;
                    arrxgt = data.xgt;
                    if (data.xgt > 0) {
                        xvalue = data.xgt[data.xgt.length - 1];
                    } else {
                        xvalue = 0;
                    }
                    value_gif_bonus = data.value_gif_bonus;
                    msg_random_bonus = data.msg_random_bonus;
                    xvalueaDD = data.xValue;
                    free_wheel = data.free_wheel;
                    num_roll_remain = gift_detail.num_roll_remain;

                    if($('#type_play').val()=='real'){
                        userpoint = data.userpoint;
                        if(userpoint<100){
                            $(".progress-bar").css("width", userpoint + "%");
                        }else{
                            $(".pyro").show();
                            setTimeout(function(){
                                $(".pyro").hide();
                            },6000)
                            $(".progress-bar").css("width", "100%");
                            $(".progress-bar").addClass('clickgif');
                        }
                        $('.progress-tooltip').text(`Điểm của bạn: ${userpoint}/100`);
                        $("#saleoffpass").val("");
                        //saleoffmessage = data.saleMessage;
                    }

                    setTimeout(function(){
                        var i=0;
                        $('.boxflip img.noactive').each(function(){
                            $(this).attr('src',gift_list[i].image);
                            $(this).css({'transform': 'rotateY(180deg)'});
                            $(this).prev().addClass('transparent');
                            $(this).parent().css({'transform': 'rotateY(180deg)'});
                            i++;
                        });
                    }, 1500);

                    $("#btnWithdraw").show();
                    if (gift_detail.winbox == 0) {
                        $("#btnWithdraw").hide();
                    } else {
                        if (gift_detail.gift_type == 0) {
                            $("#btnWithdraw").html("Rút " + $("#withdrawruby_" + gift_detail.game_type).val());
                            $("#btnWithdraw").attr('href', '/withdrawitem-' + gift_detail.game_type);
                        } else if (gift_detail.gift_type == 1) {
                            $("#btnWithdraw").html("Kiểm tra nick trúng");
                            $("#btnWithdraw").attr('href', '/minigame-logacc-' + $('#group_id').val());
                            // } else if (gift_detail.gift_type == 'nrocoin') {
                            //     $("#btnWithdraw").html("Rút vàng");
                            //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NROCOIN").val());
                            // } else if (gift_detail.gift_type == 'nrogem') {
                            //     $("#btnWithdraw").html("Rút ngọc");
                            //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NROGEM").val());
                            // } else if (gift_detail.gift_type == 'nroxu') {
                            //     $("#btnWithdraw").html("Rút xu");
                            //     $("#btnWithdraw").attr('href', '/withdrawservice?id=' + $("#ID_NINJAXU").val());
                        } else if (gift_detail.gift_type == 2) {
                            $("#btnWithdraw").html("Load lại trang");
                            $("#btnWithdraw").removeAttr("href");
                            $("#btnWithdraw").addClass('reLoad');
                        } else {
                            $("#btnWithdraw").hide();
                        }

                    }
                    if (gift_revice.length > 0) {
                        $html = "";
                        $strDiscountcode="";
                        // if(saleoffmessage.length > 0)
                        // {
                        //     $html += "<br/><span style='font-size: 14px;color: #f90707;font-style: italic;display: block;text-align: center;'>"+saleoffmessage+"</span><br/>";
                        // }

                        if($('#type_play').val() == "real")
                        {
                            if(gift_revice.length == 1)
                            {
                                // if(arrDiscount[0] != "")
                                // {
                                //     $strDiscountcode="<span>Bạn nhận được 1 mã giảm giá khuyến mãi đi kèm: <b>"+arrDiscount[0]+"</b></span>";
                                // }
                                $html += "<span>Kết quả: "+gift_revice[0]["title"]+"</span><br/>";
                                if(gift_detail.winbox == 1){
                                    $html += "<span>Mua X1: Nhận được "+gift_revice[0]['parrent'].title+"</span><br/>";
                                    //$html += "<span>Lật được "+(xvalue+3)+" hình trùng nhau. Nhận X"+(xvalueaDD[0])+" giải thưởng: "+gift_revice[0]["parrent"].params.value*(xvalueaDD[0])+""+msg_random_bonus[0]+"</span><br/>"+$strDiscountcode;
                                    $html += "<span>Tổng cộng: "+parseInt(gift_revice[0]["parrent"].params.value)*(parseInt(xvalueaDD[0]))+"</span>";
                                }
                            }
                            else
                            {
                                $totalRevice = 0;
                                $html += "<span>Kết quả: Nhận "+gift_revice.length+" phần thưởng cho "+gift_revice.length+" lượt lật.</span><br/>";
                                $html += "<span><b>Mua X"+gift_revice.length+":</b></span><br/>";
                                for($i=0;$i<gift_revice.length;$i++)
                                {
                                    // if(arrDiscount[$i] != "")
                                    // {
                                    //     $strDiscountcode="<span>Bạn nhận được 1 mã giảm giá khuyến mãi đi kèm: <b>"+arrDiscount[$i]+"</b></span>";
                                    // }
                                    $html += "<span>Lần lật "+($i + 1)+": "+gift_revice[$i]["title"];
                                    if(gift_revice[$i].winbox == 1){
                                        $html +=" - nhận được: "+gift_revice[$i]['parrent'].title+" X"+(parseInt(xvalueaDD[$i]))+" = "+parseInt(gift_revice[$i]['parrent'].title)*(parseInt(xvalueaDD[$i]))+""+msg_random_bonus[$i]+"</span><br/>"+$strDiscountcode+"<br/>";
                                    }
                                    else
                                    {
                                        $html +=""+msg_random_bonus[$i]+"<br/>"+$strDiscountcode+"<br/>";
                                    }
                                    $totalRevice +=  parseInt(gift_revice[$i]['parrent'].params.value)*(parseInt(xvalueaDD[$i]))+ parseInt(value_gif_bonus[$i]);
                                }

                                $html += "<span><b>Tổng cộng: "+$totalRevice+"</b></span>";
                            }
                        }
                        else
                        {
                            $("#btnWithdraw").hide();
                            if(gift_revice.length == 1)
                            {
                                $html += "<span>Kết quả chơi thử: "+gift_revice[0]["title"]+"</span><br/>";
                                if(gift_detail.winbox == 1){
                                    $html += "<span>Mua X1: Nhận được "+gift_revice[0]["parrent"].params.value+"</span><br/>";
                                    //$html += "<span>Lật được "+(xvalue+3)+" hình trùng nhau. Nhận X"+(xvalueaDD[0])+" giải thưởng: "+gift_revice[0]["parrent"].params.value*(xvalueaDD[0])+""+msg_random_bonus[0]+"</span><br/>";
                                    $html += "<span>Tổng cộng: "+parseInt(gift_revice[0]["parrent"].params.value)*(parseInt(xvalueaDD[0]))+"</span>";
                                }
                            }
                            else
                            {
                                $totalRevice = 0;
                                $html += "<span>Kết quả chơi thử: Nhận "+gift_revice.length+" phần thưởng cho "+gift_revice.length+" lượt lật.</span><br/>";
                                $html += "<span><b>Mua X"+gift_revice.length+":</b></span><br/>";
                                for($i=0;$i<gift_revice.length;$i++)
                                {
                                    $html += "<span>Lần lật "+($i + 1)+": "+gift_revice[$i]["title"];
                                    if(gift_revice[$i].winbox == 1){
                                        $html +=" - nhận được: "+gift_revice[$i]['parrent'].title+" X"+(parseInt(xvalueaDD[$i]))+" = "+parseInt(gift_revice[$i]['parrent'].title)*(parseInt(xvalueaDD[$i]))+""+msg_random_bonus[$i]+"</span><br/>";
                                    }
                                    else
                                    {
                                        $html +=""+msg_random_bonus[$i]+"<br/>";
                                    }
                                    $totalRevice +=  parseInt(gift_revice[$i]['parrent'].params.value)*(parseInt(xvalueaDD[$i]))+ parseInt(value_gif_bonus[$i]);
                                }

                                $html += "<span><b>Tổng cộng: "+$totalRevice+"</b></span>";
                            }
                        }
                    }

                    $('#noticeModal .content-popup').html($html);
                    if (userpoint > 99) {
                        getgifbonus();
                    }
                    setTimeout(function(){
                        $('#noticeModal').modal('show');
                        //$('.continue').show();
                        $('.num-play-try').show();
                        $('.play').show();
                        // if($('#type_play').val() == "real")
                        // {
                        //     $('.continue').html("Chơi tiếp");
                        // }
                        // else
                        // {
                        //     $('.continue').html("Chơi thử tiếp");
                        // }
                    },2500);
                },
                error: function(){
                    $('#noticeModal .content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                    $('#noticeModal').modal('show');
                    roll_check = true;
                    $('.play').show();
                }
            })
        }
    });


    function getgifbonus() {
        if($('#checkPoint').val() != "1"){
            return;
        }
        $.ajax({
            url: '/minigame-bonus',
            datatype: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: $('#group_id').val(),
            },
            type: 'POST',
            success: function(data) {
                if (data.status == 0) {
                    $('#noticeModal .content-popup').text(data.msg);
                    $('#noticeModal').modal('show');
                    return;
                }
                $('#noticeModal .content-popup').append(data.msg + " - " + data.arr_gift[0].title);
                //$("#noticeModalNoHu #btnWithdraw").hide();
                $('#noticeModal').modal('show');
                var userpoint = data.userpoint;
                if(userpoint<100){
                    $(".item_spin_progress_bubble").css("width", data.userpoint + "%");
                    $(".item_spin_progress_bubble").removeClass('clickgif');
                }else{
                    $(".item_spin_progress_bubble").css("width", "100%");
                    $(".item_spin_progress_bubble").addClass('clickgif');
                }
                $(".item_spin_progress_percent").html(data.userpoint + "/100 point");
                $(".pyro").show();
                setTimeout(function(){
                    $(".pyro").hide();
                },6000)
            },
            error: function() {
                $('#noticeModal .content-popup').text('Có lỗi xảy ra. Vui lòng thử lại!');
                $('#noticeModal').modal('show');
            }
        })
    }

    $('body').delegate('.reLoad','click',function(){
        location.reload();
    })

    function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex;
        while (0 !== currentIndex) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }
        return array;
    }

    // $('.continue').click(function(){
    //     $('.boxflip').html(document.getElementById('boxfliphide').innerHTML);
    //     $('.continue').hide();
    //     $('.play').hide();
    //     $('.num-play-try').hide();
    //     roll_check = true;
    // });
});
