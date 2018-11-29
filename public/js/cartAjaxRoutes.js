  $(function () {

        //edit_quiz.html - when saving general quiz data (title, due date)
        $(".add-to-cart").click(function(e) {
                e.preventDefault();
                var currentObject = e.currentTarget.parentElement;
                var productId = currentObject.product_id.value;
                $.ajax({
                type: 'post',
                url: './cart/add/item/' + productId,
                data: $('.item-form').serialize(),
                success: function (res) {
                   
                    switch (res) {
                        case "0":
                            console.log(res)
                            M.toast({html: 'Something went wrong!', classes: 'failure-toast'}) 
                                break;
                        case "3":
                            M.toast({html: 'Sorry that item is out of stock!', classes: 'failure-toast'}) 

                            e.currentTarget.classList.add("disabled");
                            var cardActionSection = e.currentTarget.offsetParent.offsetParent.getElementsByClassName("card-action")[0];
                            var outOfStockBadge = '<span class="new badge red darken-2" data-badge-caption="out of stock"></span>';
                            cardActionSection.innerHTML =  cardActionSection.innerHTML + outOfStockBadge;

                            console.log(cardActionSection)
                                break;
                        default:
                            var cartNotificationCount = document.getElementById('items-notification').getAttribute("data-badge-caption");
                            var test = parseInt(cartNotificationCount)
                            console.log(test)
                            var cartNotification = document.getElementById('items-notification').setAttribute("data-badge-caption",  test +1 );

                            M.toast({html: 'Item Added to Cart!', classes: 'success-toast'})

                                break;
                    }
                    
                }
                }).fail(function(res) {
                    console.log(res.responseText)
                     M.toast({html: 'Internal Error!', classes: 'failure-toast'}) 
                });
            });


  });
  