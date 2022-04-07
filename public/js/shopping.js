$('.btn-addtocart').on('click', function(){
  // alert($('.extra').serialize());
    $.ajax({
        url:'/cart',
        method:'POST',
        data:{
            product_id:$(this).data('id'),
            quantity:$('input[name="quantity"]').val() || 1,
            extras:$('.extra').serialize()
        },
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:()=>{
            $('#alert-success').fadeIn();
            $(this).addClass('bg-lime-300');
            setTimeout(()=>{
                $(this).removeClass('bg-lime-300');
                $('#alert-success').fadeOut()
            }, 5000)
        }
    });
});
function decrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value--;
    target.value = Math.max(value, 1);
    $('#btn_update_cart').removeClass('bg-red-200');
    $('#btn_update_cart').addClass('bg-red-500');
    $('#btn_update_cart').prop('disabled', false);
  }

  function increment(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value++;
    target.value = value;
    $('#btn_update_cart').addClass('bg-red-500');
    $('#btn_update_cart').removeClass('bg-red-200');
    $('#btn_update_cart').prop('disabled', false);

  }

  const decrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`
  );

  const incrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`
  );

  decrementButtons.forEach(btn => {
    btn.addEventListener("click", decrement);
  });

  incrementButtons.forEach(btn => {
    btn.addEventListener("click", increment);
  });