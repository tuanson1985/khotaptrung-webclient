$(document).ready(function(){
    // get tele
    function getIdCode(){
        var url = '/transfer-code';
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                if(data.status == 1){

                    // html += '<p class="text-danger">'+ data.data +'</p>  <span style="padding-left: 8px;cursor: pointer"><i class="fas fa-copy"  data-id="'+ data.data +'"></i></span>';
                    $('.transfer-code').html(data.data)

                    $('.error_transfer_code').hide()
                    $('#atm_card .card--gray .card--attr.transfer-title').css('display','flex')
                }else {
                    $('.transfer-code').html( '<p style="text-align: center; margin: auto; color: red;font-weight: 600;font-size: 14px"> Vui lòng đăng nhập để nhận được nội dung chuyển tiền </p>')
                }

            },
            error: function (data) {
                swal({
                    title: "Lỗi !",
                    text: "Có lỗi phát sinh vui lòng liên hệ QTV để kịp thời xử lý.",
                    icon: "error",
                    buttons: {
                        cancel: "Đóng",
                    },
                })
            },
            complete: function (data) {
            }
        });
    }
    getIdCode();



})
