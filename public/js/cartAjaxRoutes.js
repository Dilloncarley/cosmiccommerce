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
                    
                        default:
                        console.log(res)
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
  