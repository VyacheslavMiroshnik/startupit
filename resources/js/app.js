import './bootstrap';
import '../css/app.css';
import jQuery from 'jquery';
window.$ = jQuery;
/**
 * Солянка из js и jquery, управления кнопками карточки товара добавления в корзину,
 * удаления, изменения.  Отправляется post запрос("patch","delete" не заработали )
 * после успешной передачи данных, возвращается обновленная карточка с товаром
 * меняем старую и навешиваем события на новый элемент
 */
document.addEventListener('DOMContentLoaded',()=>{
$(".product__card").click(onClick);
})
function onClick(e){
    let data = {
        id : this.dataset.id
    };
    const parent = this.parentNode;
    let headers = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };
    let url = 'cart/add';
    if(e.target.closest('.btn-add__product')){
        let count = ++this.querySelector(".count").textContent;
        console.log(count)
        data.count=count;
        url = 'cart/update';
    }
    if(e.target.closest('.btn-diff__product')){
        let count = --this.querySelector('.count').textContent
        if(count == 0){
            $('.cart__counter').hide();
            $('.btn-add__cart').show();
            url = 'cart/delete'
        } else {
            data.count = count;
            url = 'cart/update';
        }
    }
    $.ajax({
        method:'POST',
        url: url,
        data: data,
        headers: headers,
        success: function(data) {
            if(data.html) {
                parent.innerHTML = data.html;
                parent.querySelector('.product__card').onclick = onClick
            }
        }
    });
}

function addCount(element){
return ++element.textContent
}

function diffCount(element){
    return --element.textContent
}
