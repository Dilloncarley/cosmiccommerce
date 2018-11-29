  $(function () {
     
        //edit_quiz.html - when saving general quiz data (title, due date)
        $(".add-to-cart").click(function(e){
                e.preventDefault();
                var currentObject = e.currentTarget.parentElement;
                var productId = currentObject.product_id.value;
                $.ajax({
                type: 'post',
                url: '/cart/add/item/' + productId,
                data: $('.item-form').serialize(),
                success: function (res) {
                  res = JSON.parse(res);
                 
                    switch (res.status) {
                        case "0":
                            M.toast({html: 'Something went wrong!', classes: 'failure-toast'}) 
                            break;
                        case "3":
                            itemOutOfStock(e, res.productId);
                            break;
                        default:
                         
                            updateCart(e, res.cartItem[0]);
                            break;
                    }
                    
                }
                }).fail(function(res) {
                   
                     M.toast({html: 'Internal Error!', classes: 'failure-toast'}) 
                });
            });
        //        $(".delete").click(function(e){
        //     console.log("test")
        //     // e.preventDefault();
        //     var currentObject = e.currentTarget.parentElement;
        //     var productId = currentObject.product_id.value;
        //     var amount = currentObject.amount.value
        //     $.ajax({
        //         type: 'post',
        //         url: '/cart/delete/cart/item/' + productId + "/" + amount,
        //         data: $('.delete-item-form').serialize(),
        //          success: function (res) {
        //              console.log(res)
        //          }
        //     }).fail(function(res) {
                   
        //             //  M.toast({html: 'Internal Error!', classes: 'failure-toast'}) 
        //         });
        // });
            


var cart_item_element = function(item){
    var price = Number(item.price).toFixed(2);
    price = formatMoney(price, 0, ".", ",");

    const cart_item = {
        id: item.product_id,
        name: item.item_name,
        product_image: item.product_image,
        sub_descrip: item.sub_descrip,
        item_type: item.item_type,
        price: price,
        amount: 1
    }
    const markup = `<li class="collection-item avatar">
                
                <div class="col s12"> <img src="${cart_item.product_image}" alt="" class="circle cart-image "><span class="title"> ${cart_item.name}</span></div>
                <div class="col s12">  <p class="subD truncate">${cart_item.sub_descrip}</p></div>
                <div class="col s12"> <p><span class="new badge deep-purple darken-3" data-badge-caption="${cart_item.item_type}"></span></p>
                 <form class="delete-item-form" action="/cart/delete/cart/item/${cart_item.id}/all" method="POST">
                    <input class="hide" id="product_id" name="product_id" value="${cart_item.id}">
                    <input class="hide" id="amount" name="amount" value="all">
                     <button class="btn-floating btn-small waves-effect waves-light red right delete delete" type="submit"  ><i class="material-icons">delete</i></button>
                  </form>
                </div>
                
                
                    <div class="secondary-content">
                    
                        <div class="col m12 s12">
                            <p  class="center-align amount">
                             
                            <span id="${cart_item.id}amount">${cart_item.amount} </span>
                            </p>
                            <p><span class="price new badge green accent-4" data-badge-caption= "${cart_item.price}"></span></p>
                    </div>
        </li>`;
    return markup;
    };

    var itemOutOfStock = function(e, productId, shouldToast){
      
        e.currentTarget.classList.add("disabled");
        var cardActionSection = document.getElementsByClassName("badge-section" + productId)[0];
        var outOfStockBadge = '<span class="new badge red darken-2" data-badge-caption="out of stock"></span>';
        cardActionSection.innerHTML =  cardActionSection.innerHTML + outOfStockBadge;
        if(shouldToast){
              M.toast({html: 'Sorry that item is out of stock!', classes: 'failure-toast'})
        }
       
    };

    var updateCart = function(e, item) {
        
        var cartNotificationCount = document.getElementById('items-notification').getAttribute("data-badge-caption");
        var badgeCount = parseInt(cartNotificationCount)
    
        var cartNotification = document.getElementById('items-notification').setAttribute("data-badge-caption",  badgeCount +1 );

   
        if(document.getElementById(item.product_id + "amount") == null){
             console.log("new element in cart")
             var cartCollection = document.getElementsByClassName("collection")[0];
             cartCollection.innerHTML += cart_item_element(item);

            var existingTotal = document.getElementById("total");
            var firstReplace = existingTotal.innerHTML.replace('$','');
            console.log(firstReplace)
            var replaceCommas = firstReplace.replace(/,/g, '')
       
            var nextReplace = Number(replaceCommas);

            var existingTotalNumber = nextReplace

            console.log(nextReplace)
            var total = Number(item.price);

            existingTotalNumber = existingTotalNumber + total;
            existingTotalNumber = formatMoney(existingTotalNumber, 0, ".", ",");
            existingTotal.innerHTML = existingTotalNumber;

            
            
            
        } else {
           console.log("existing element in cart")
            var existingItemInCart = document.getElementById(item.product_id + "amount");
            var existingItemAmount = parseInt(existingItemInCart.innerHTML) -1;
           

            var existingTotal = document.getElementById("total");
            var firstReplace = existingTotal.innerHTML.replace('$','');
            console.log(firstReplace)
            var replaceCommas = firstReplace.replace(/,/g, '')
             var nextReplace = Number(replaceCommas);

            var total = parseInt(existingItemInCart.innerHTML) * Number(item.price);

            total = total + nextReplace;

            total = formatMoney(total, 0, ".", ",");
            existingTotal.innerHTML = total ;
            console.log(total)
             existingItemInCart.innerHTML  = existingItemAmount  +2;
        }
        
       
       
    


        M.toast({html: 'Item Added to Cart!', classes: 'success-toast'})
    
        if(item.quantity === "0"){
           itemOutOfStock(e, item.product_id, 0)
       }
    };

    //props to -> @haykam from https://stackoverflow.com/questions/149055/how-can-i-format-numbers-as-dollars-currency-string-in-javascript
    function formatMoney(n, c, d, t) {
            var c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;

        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }; 
   


  });
  