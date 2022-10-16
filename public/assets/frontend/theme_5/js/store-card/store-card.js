// tabActive sẽ là biến để xác định người dùng đang ở tab nào ( thẻ game or thẻ điện thoại )


//select the first card radio
if ($(document).width() >= 992 ){
    $('#cardGameList .card-type-form:first-child input').prop('checked',true);
    $('#cardPhoneList .card-type-form:first-child input').prop('checked',true);
} else {
    $('#slider-card-game .card-type-form:first-child input').prop('checked',true);
    $('#slider-card-phone .card-type-form:first-child input').prop('checked',true);
}

$(document).ready(function () {
    var swiper_card = new Swiper(".slider--card", {
        slidesPerView: 1,
        spaceBetween: 16,
        freeMode: true,
        observer: true,
        observeParents: true,
    });

    var storeDataSend = {
        amount: 0,
        telecom: '',
        quantity: 0,
        _token: $('meta[name="csrf-token"]').attr('content'),
    }

    $('input[name="card-type-game"]').on('change',function (e) {
        e.preventDefault();
        getCardAmount($(this).val(), 1);
    });

    $('input[name="card-type-mobile"]').on('change',function (e) {
        e.preventDefault();
        getCardAmount($(this).val(), 2);
    });

    $('input[name="card-type-game"]:checked').trigger('change');
    $('input[name="card-type-mobile"]:checked').trigger('change');

    $('#btn-confirm, #btn-confirm-mobile').on('click', function (e) {
        e.preventDefault();

        let tabActive = getTabActive();

        resetConfirmModal();
        prepareConfirmModal(tabActive);
        resetMobileConfirm();
        prepareMobileConfirm(tabActive);
        prepareDataSend(tabActive);
    });

    $('#gameCardNav').on('click', function(e) {
        prepareAmountWidget(1);
        checkCardAvailable(1);
    });

    $('#mobileCardNav').on('click', function(e) {
        prepareAmountWidget(2);
        checkCardAvailable(2);
    });

    $(document).on('click', '#modalConfirmPayment #confirmSubmitButton', function(e) {
        e.preventDefault();
        $.ajax({
            url:'/ajax/mua-the',
            type:'POST',
            data: storeDataSend,
            beforeSend: function () {
                $('#modalConfirmPayment #confirmSubmitButton').prop("disabled", true);
                $('#modalConfirmPayment #confirmSubmitButton').text("Đang xử lý");
                resetSuccessModal();
            },
            success:function (res) {
                // handle data callback
                $('#modalConfirmPayment').modal('hide');
                if(res.status && res.status != 401){
                    let data = res.data;
                    let cardImage = $('input[name="card-type"]:checked').data('img');
                    let cardName = $('input[name="card-type"]:checked').val();
                    let confirmTitle = $('input[name="card-type"]:checked').data('title');

                    $('#modal--success__payment #successCard').text(confirmTitle);
                    $('#modal--success__payment #successPrice').text(formatNumber(storeDataSend.amount) + ' đ');
                    $('#modal--success__payment #successQuantity').text(storeDataSend.quantity);
                    if (data.length > 0){

                        //Append HTML for desktop layout
                        data.forEach(function (card) {
                            let html_card = '';
                            html_card += `<div class="swiper-slide card__detail swiper-slide-active">`;
                            html_card += `  <div class="card--header__detail c-p-12">`;
                            html_card += `      <div class="card--info__wrap">`;
                            html_card += `          <div class="card--logo d-flex c-mr-8">`;
                            html_card += `            <img src="${cardImage}" alt="telecom_logo">`;
                            html_card += `          </div>`;
                            html_card += `          <div class="card--info">`;
                            html_card += `              <div class="card--info__name fw-400 fz-13 text-left">`;
                            html_card += `                  ${cardName}`;
                            html_card += `              </div>`;
                            html_card += `               <div class="card--info__value fz-13 fw-500">`;
                            html_card += `                    <a href="javascript:void(0)" class="text-primary">${formatNumber(storeDataSend.amount)} đ </a>`;
                            html_card += `                </div>`;
                            html_card += `            </div>`;
                            html_card += `        </div>`;
                            html_card += `    </div>`;
                            html_card += `    <div class="card--gray c-m-10 c-mb-10">`;
                            html_card += `      <div class="card--attr justify-content-between d-flex c-pb-8 c-pt-12 c-pl-12 c-pr-12 text-center">`;
                            html_card += `            <div class="card--attr__name fw-400 fz-13 text-center">`;
                            html_card += `              Mã thẻ`;
                            html_card += `            </div>`;
                            html_card += `            <div class="card--attr__value fz-13 fw-500 d-flex">`;
                            html_card += `              <div class="card__info c-mr-8">`;
                            html_card += `                  ${card.pin}`;
                            html_card += `               </div>`;
                            html_card += `               <div class="icon--coppy js-copy-text">`;
                            html_card += `                    <img class="c-cursor" src="/assets/frontend/theme_5/image/son/copy.svg" alt="icon__copy">`;
                            html_card += `                </div>`;
                            html_card += `            </div>`;
                            html_card += `        </div>`;
                            html_card += `        <div class="card--attr justify-content-between c-pb-8 pt-0 c-pl-12 c-pr-12 d-flex text-center">`;
                            html_card += `             <div class="card--attr__name fw-400 fz-13 text-center">`;
                            html_card += `                 Số Series`;
                            html_card += `              </div>`;
                            html_card += `              <div class="card--attr__value fz-13 fw-500 d-flex">`;
                            html_card += `                  <div class="card__info c-mr-8">`;
                            html_card += `                      ${card.serial}`;
                            html_card += `                   </div>`;
                            html_card += `                   <div class="icon--coppy js-copy-text">`;
                            html_card += `                      <img class="c-cursor" src="/assets/frontend/theme_5/image/son/copy.svg" alt="icon__copy">`;
                            html_card += `                   </div>`;
                            html_card += `               </div>`;
                            html_card += `         </div>`;
                            html_card += `    </div>`;
                            html_card += `</div>`;

                            $('#modal--success__payment .swiper-wrapper').append(html_card);
                        });
                    }

                    if (data.length > 1){
                        swiper_card.params.slidesPerView = 1.25;
                    } else {
                        swiper_card.params.slidesPerView = 1;
                    }

                    swiper_card.update();

                    $('#modal--success__payment').modal('show');
                }
                else {
                    $('#message--error--buy').text(res.message);
                    $('#modal--fail__payment').modal('show');
                }
            },
            error: function (res) {
                $('#modalConfirmPayment').modal('hide');
                $('#message--error--buy').text('');
                $('#modal--fail__payment').modal('show');
            },
            complete: function () {
                $('#confirmSubmitButton').prop("disabled", false);
                $('#confirmSubmitButton').text("Xác nhận");
            }
        });

        $('#modal--confirm__payment').modal('hide');
    });

    $('#confirmMobileButton').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url:'/ajax/mua-the',
            type:'POST',
            data: storeDataSend,
            beforeSend: function () {
                $('#confirmMobileButton').prop("disabled", true);
                $('#confirmMobileButton').text("Đang xử lý");
                resetSuccessMobile();
            },
            success:function (res) {
                // handle data callback
                if(res.status && res.status != 401) {
                    let data = res.data;
                    let cardImage = $('input[name="card-type"]:checked').data('img');
                    let cardName = $('input[name="card-type"]:checked').val();

                    $('#successMobileCard').text(cardName);
                    $('#successMobilePrice').text(formatNumber(storeDataSend.amount) + ' đ');
                    $('#successMobileQuantity').text(storeDataSend.quantity);
                    if (data.length > 0){

                        //Append HTML for mobile layout
                        data.forEach(function (card) {
                            let html_card_mobile = '';
                            html_card_mobile += `<div class="card__detail c-mb-16">`;
                            html_card_mobile += `<div class="card--header__detail c-p-12">`;
                            html_card_mobile += `<div class="card--info__wrap">`;
                            html_card_mobile += `<div class="card--logo d-flex c-mr-8">`;
                            html_card_mobile += `<img src="${cardImage}" alt="telecom_logo">`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="card--info">`;
                            html_card_mobile += `<div class="card--info__name fw-400 fz-13 text-left">`;
                            html_card_mobile += `${cardName}`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="card--info__value fz-13 fw-500">`;
                            html_card_mobile += ` <a href="javascript:void(0)" class="text-primary">${formatNumber(storeDataSend.amount)} đ </a>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="card--gray c-m-10 c-mb-10">`;
                            html_card_mobile += `<div class="card--attr justify-content-between d-flex c-pb-8 c-pt-12 c-pl-12 c-pr-12 text-center">`;
                            html_card_mobile += `<div class="card--attr__name">`;
                            html_card_mobile += `Mã thẻ`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="card--attr__value fz-13 fw-500 d-flex">`;
                            html_card_mobile += `<div class="card__info c-mr-8">`;
                            html_card_mobile += `${card.pin}`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="icon--coppy js-copy-text">`;
                            html_card_mobile += `<img class="c-cursor" src="/assets/frontend/theme_5/image/son/copy.svg" alt="icon__copy">`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="card--attr justify-content-between c-pb-8 pt-0 c-pl-12 c-pr-12 d-flex text-center">`;
                            html_card_mobile += `<div class="card--attr__name fw-400 fz-13 text-center">`;
                            html_card_mobile += `Số Series`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="card--attr__value fz-13 fw-500 d-flex">`;
                            html_card_mobile += `<div class="card__info c-mr-8">`;
                            html_card_mobile += `${card.pin}`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `<div class="icon--coppy js-copy-text">`;
                            html_card_mobile += `<img class="c-cursor" src="/assets/frontend/theme_5/image/son/copy.svg" alt="icon__copy">`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;
                            html_card_mobile += `</div>`;

                            $('#cardList').append(html_card_mobile);
                        });
                    }

                    $('#step3').css('transform', 'translateX(0px)');
                }
                else {
                    $('#message--error--buy').text(res.message);
                    $('#modal--fail__payment').modal('show');
                }
            },
            error: function (res) {
                $('#message--error--buy').text('');
                $('#modal--fail__payment').modal('show');
            },
            complete: function () {
                $('#confirmMobileButton').prop("disabled", false);
                $('#confirmMobileButton').text("Xác nhận");
            }
        });

    });

    function getTabActive() {
        if ($('#gameCardNav').hasClass('active')) {
            return 1;
        }
        if ($('#mobileCardNav').hasClass('active')) {
            return 2;
        }

        return 1;
    }

    function checkCardAvailable(tabActive) {
        if ( tabActive == 1 ) {
            if ( $("#cardAmountListGame .card-price-form").length ) {
                $('#btn-confirm').prop('disabled', false);
                $('#btn-confirm-mobile').prop('disabled', false);
            } else {
                $('#btn-confirm').prop('disabled', true);
                $('#btn-confirm-mobile').prop('disabled', true);
            }
        } else if ( tabActive == 2 ) {
            if ( $("#cardAmountListMobile .card-price-form").length ) {
                $('#btn-confirm').prop('disabled', false);
                $('#btn-confirm-mobile').prop('disabled', false);
            } else {
                $('#btn-confirm').prop('disabled', true);
                $('#btn-confirm-mobile').prop('disabled', true);
            }
        }
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }

    function getListCard () {
        $.ajax({
            url: '/ajax/store-card/get-telecom',
            type: 'GET',
            success: function (res) {
                if (res.status) {
                    let data = res.data;
                    let loop_index = 0;
                    data.forEach(function (card) {
                        let html = '';
                        html += `<div class="col-4 c-px-4 c-py-0 card-type-form">`;
                        //Check if it is the first loop
                        if (loop_index === 0) {
                            html += `<input type="radio" id="card-${card.id}" value="${card.key}" name="card-type" data-img="${card.image}" data-title="${card.title}" checked hidden>`;
                            //Increase loop index
                            loop_index++;
                        } else {
                            html += `<input type="radio" id="card-${card.id}" value="${card.key}" name="card-type" data-img="${card.image}" data-title="${card.title}" hidden>`;
                        }
                        html += `<label for="card-${card.id}" class="brs-8 c-mb-8">`;
                        html += `<img src="${card.image}" alt="${card.title}">`;
                        html += `</label>`;
                        html += `</div>`;


                        if (card.params && card.params.teltecom_type) {
                            //Apepnd HTML
                            if (card.params.teltecom_type == 2) {
                                $('#cardGameList').append(html);
                            }
                            if (card.params.teltecom_type == 1) {
                                $('#cardPhoneList').append(html);
                            }

                        } else {
                            $('#cardPhoneList').append(html);
                        }
                    });

                    //Get amount of the card just been choosen when render
                    getCardAmount($('input[name="card-type"]').val());

                    //Listen to onchange event in input card-type
                    $('input[name="card-type"]').change(function (e) {
                        e.preventDefault();
                        getCardAmount($(this).val());
                    });

                    $('#cardPriceInfo').removeClass('d-none');
                }
            },
            error: function () {
                console.log("Đã xảy ra lỗi khi load dữ liệu! Vui lòng load lại trang!");
            },
            complete: function () {
                $('#cardGameList .loader').remove();
            }
        });
    };

    function getCardAmount (cardKey, tabActive) {
        $.ajax({
            url: '/ajax/store-card/get-amount',
            type: 'GET',
            data: {
                telecom: cardKey
            },
            beforeSend: function () {
                resetAmountWidget();
                $('#btn-confirm').prop('disabled', true);
                $('#btn-confirm-mobile').prop('disabled', true);
                if ( tabActive == 1) {
                    $('#cardAmountListGame').empty();
                    $('#gameCard .amount-card-section .loader').removeClass('d-none');
                } else if ( tabActive == 2 ) {
                    $('#cardAmountListMobile').empty();
                    $('#mobileCard .amount-card-section .loader').removeClass('d-none');
                }
            },
            success: function (res) {
                if (res.status) {
                    let data = res.data;

                    //Empty element
                    if ( tabActive == 1 ) {
                        $('#cardAmountListGame').empty();
                        if (!data.length) {
                            $('#cardAmountListGame').append('<p class="text-center c-mb-0" style="padding-left: 4px;">Chưa có mệnh giá của thẻ</p>');
                        }
                    } else if ( tabActive == 2 ) {
                        $('#cardAmountListMobile').empty();
                        if (!data.length) {
                            $('#cardAmountListMobile').append('<p class="text-center c-mb-0" style="padding-left: 4px;">Chưa có mệnh giá của thẻ</p>');
                        }
                    }
                    
                    if (data.length) {
                        let loop_index = 0;

                        data.forEach(function (card) {
                            if ( tabActive == 1) {
                                let html = '';
                                html += `<div class="col-4 col-lg-2 c-px-4 card-price-form">`;
                                //Check if it is the first loop
                                if (loop_index === 0) {
                                    html += `<input type="radio" id="amount-${card.id}" value="${card.amount}" data-discount="${card.ratio_default}" name="card-value-game" checked hidden>`;
                                    //Increase loop index
                                    loop_index++;
                                } else {
                                    html += `<input type="radio" id="amount-${card.id}" value="${card.amount}" data-discount="${card.ratio_default}" name="card-value-game" hidden>`;
                                }
                                html += `<label for="amount-${card.id}" class="c-py-21 c-px-8 c-mb-8 brs-8">`;
                                html += `<p class="fw-500 fs-15 mb-0">${formatNumber(card.amount)} đ</p>`;
                                html += `</label>`;
                                html += `</div>`;

                                // Append new HTML amount
                                $('#cardAmountListGame').append(html);
                            } else if ( tabActive == 2 ) {
                                let html = '';
                                html += `<div class="col-4 col-lg-2 c-px-4 card-price-form">`;
                                //Check if it is the first loop
                                if (loop_index === 0) {
                                    html += `<input type="radio" id="amount-${card.id}" value="${card.amount}" data-discount="${card.ratio_default}" name="card-value-mobile" checked hidden>`;
                                    //Increase loop index
                                    loop_index++;
                                } else {
                                    html += `<input type="radio" id="amount-${card.id}" value="${card.amount}" data-discount="${card.ratio_default}" name="card-value-mobile" hidden>`;
                                }
                                html += `<label for="amount-${card.id}" class="c-py-21 c-px-8 c-mb-8 brs-8">`;
                                html += `<p class="fw-500 fs-15 mb-0">${formatNumber(card.amount)} đ</p>`;
                                html += `</label>`;
                                html += `</div>`;

                                $('#cardAmountListMobile').append(html);
                            }
                        });

                        //prepare the input field and update price related value
                        $('input[name="card-amount"]').val(1);
                        prepareAmountWidget(tabActive);

                        //Activate onchange, oninput function for input field inside
                        $('input[name="card-value-game"]').change(function (e) {
                            e.preventDefault();
                            prepareAmountWidget(1);
                        });
                        $('input[name="card-value-mobile"]').change(function (e) {
                            e.preventDefault();
                            prepareAmountWidget(2);
                        });
                        $('input[name="card-amount"]').on('input change', function (e) {
                            e.preventDefault();
                            if ( getTabActive() == 1 ) {
                                prepareAmountWidget(1);
                            } else if ( getTabActive() == 2 ) {
                                prepareAmountWidget(2);
                            }
                        });

                        //Make btn no longer disable when failed get data
                        checkCardAvailable(tabActive);

                    }
                }
            },
            complete: function () {
                if ( tabActive == 1) {
                    $('#gameCard .amount-card-section .loader').addClass('d-none');
                } else if ( tabActive == 2 ) {
                    $('#mobileCard .amount-card-section .loader').addClass('d-none');
                }
            }
        });
    };

    function prepareAmountWidget (tabActive) {
        let discountCardValue, price;
        if (tabActive == 1) {
            discountCardValue = $('input[name="card-value-game"]:checked').data('discount');
        } else if ( tabActive == 2 ) {
            discountCardValue = $('input[name="card-value-mobile"]:checked').data('discount');
        }
        $('input[name="card-discount"]').val(discountCardValue);

        if (isNaN(100 - discountCardValue)) {
            $('.buy-card-discount').text(`0%`);
        } else {
            $('.buy-card-discount').text(`${100 - discountCardValue}%`);
        }

        price = calculatePrice(tabActive);
        
        if (isNaN(price)) {
            $('.buy-card-total').text(`0 đ`);
        } else {
            $('.buy-card-total').text(`${formatNumber( price )} đ`);
        }
    }

    function resetAmountWidget () {
        $('.buy-card-discount').text(`0%`);
        $('.buy-card-total').text(`0 đ`);
    }

    //Calculate price
    function calculatePrice (tabActive) {
        let amount;
        if (tabActive == 1) {
            amount = $('input[name="card-value-game"]:checked').val();
        } else if (tabActive == 2) {
            amount = $('input[name="card-value-mobile"]:checked').val();
        }
        let quantity = $('input[name="card-amount"]').val();
        let discount = $('input[name="card-discount"]').val();

        let discountPerCard = amount - (amount * discount /100);
        let totalPrice = (amount - discountPerCard) * quantity;
        let totalNotSale = amount * quantity;

        if (discountPerCard) {
            return totalPrice;
        }

        return totalNotSale;
    }

    //Reset data in confirm modal
    function resetMobileConfirm () {
        $('#confirmMobileCard').empty();
        $('#confirmMobilePrice').text('');
        $('#confirmMobileQuantity').text('');
        $('#confirmMobileDiscount').text('');
        $('#confirmMobileTotal').text('');
        $('#totalMobileBill').text('');
    }

    function resetConfirmModal () {
        $('#modalConfirmPayment #confirmTitle').text('');
        $('#modalConfirmPayment #confirmPrice').text('');
        $('#modalConfirmPayment #confirmQuantity').text('');
        $('#modalConfirmPayment #confirmDiscount').text('');
        $('#modalConfirmPayment #confirmTotal').text('');
        $('#modalConfirmPayment #totalBill').text('');
    }

    function resetSuccessModal () {
        $('#modal--success__payment #successCard').text('');
        $('#modal--success__payment #successPrice').text('');
        $('#modal--success__payment #successQuantity').text('');
        $('#modal--success__payment .swiper-wrapper').empty();
        swiper_card.update();
    }

    function resetSuccessMobile () {
        $('#successMobileCard').text('');
        $('#successMobilePrice').text('');
        $('#successMobileQuantity').text('');
        $('cardList').empty();
    }

    //append new data into confirm modal
    function prepareConfirmModal(tabActive) {
        let confirmTitle, confirmPrice, confirmQuantity, confirmDiscount;

        if ( tabActive == 1 ) {
            confirmTitle = $('input[name="card-type-game"]:checked').data('title');
            confirmPrice = $('input[name="card-value-game"]:checked').val();
            confirmDiscount = $('input[name="card-value-game"]:checked').data('discount');
        } else if ( tabActive == 2 ) {
            confirmTitle = $('input[name="card-type-mobile"]:checked').data('title');
            confirmPrice = $('input[name="card-value-mobile"]:checked').val();
            confirmDiscount = $('input[name="card-value-mobile"]:checked').data('discount');
        }
        
        confirmQuantity = $('input[name="card-amount"]').val();

        $('#modalConfirmPayment #confirmTitle').text(confirmTitle);
        $('#modalConfirmPayment #confirmPrice').text(`${formatNumber( confirmPrice )} đ`);
        $('#modalConfirmPayment #confirmQuantity').text(confirmQuantity);
        $('#modalConfirmPayment #confirmDiscount').text(`${100 - confirmDiscount}%`);
        $('#modalConfirmPayment #confirmTotal').text(`${formatNumber( calculatePrice(tabActive) )} đ`);
        $('#modalConfirmPayment #totalBill').text(`${formatNumber( calculatePrice(tabActive) )} đ`);
    }

    function prepareMobileConfirm (tabActive) {
        let confirmTitle, confirmPrice, confirmQuantity, confirmDiscount;
        if ( tabActive == 1 ) {
            confirmTitle = $('input[name="card-type-game"]:checked').data('title');
            confirmPrice = $('input[name="card-value-game"]:checked').val();
            confirmDiscount = $('input[name="card-value-game"]:checked').data('discount');
        } else if ( tabActive == 2 ) {
            confirmTitle = $('input[name="card-type-mobile"]:checked').data('title');
            confirmPrice = $('input[name="card-value-mobile"]:checked').val();
            confirmDiscount = $('input[name="card-value-mobile"]:checked').data('discount');
        }

        confirmQuantity = $('input[name="card-amount"]').val();

        $('#confirmMobileCard').text(confirmTitle);
        $('#confirmMobilePrice').text(`${formatNumber( confirmPrice )} đ`);
        $('#confirmMobileQuantity').text(confirmQuantity);
        $('#confirmMobileDiscount').text(`${100 - confirmDiscount}%`);
        $('#confirmMobileTotal').text(`${formatNumber( calculatePrice(tabActive) )} đ`);
        $('#totalMobileBill').text(`${formatNumber( calculatePrice(tabActive) )} đ`);
    }

    //Append new data to submit to backend
    function prepareDataSend(tabActive) {
        let amount, telecom, quantity;
        if ( tabActive == 1 ) {
            amount = $('input[name="card-value-game"]:checked').val();
            telecom = $('input[name="card-type-game"]:checked').val();
        } else if ( tabActive == 2 ) {
            amount = $('input[name="card-value-mobile"]:checked').val();
            telecom = $('input[name="card-type-mobile"]:checked').val();
        }

        quantity = $('input[name="card-amount"]').val();
        
        storeDataSend.amount = amount;
        storeDataSend.telecom = telecom.toUpperCase();
        storeDataSend.quantity = quantity;
    }

});
